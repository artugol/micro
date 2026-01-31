<?php

// Script de instalación automática de la base de datos

$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'microframework_db';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';

echo "=================================\n";
echo "INSTALADOR DE BASE DE DATOS\n";
echo "=================================\n\n";

try {
    // Conectar sin especificar base de datos para crearla
    echo "1. Conectando al servidor MySQL...\n";
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "   ✓ Conexión exitosa\n\n";

    // Crear la base de datos si no existe
    echo "2. Creando base de datos '$dbname'...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "   ✓ Base de datos creada o ya existe\n\n";

    // Usar la base de datos
    $pdo->exec("USE `$dbname`");

    // Leer y ejecutar el archivo SQL
    echo "3. Ejecutando schema.sql...\n";
    $sqlFile = __DIR__ . '/database/schema.sql';
    
    if (!file_exists($sqlFile)) {
        throw new Exception("No se encuentra el archivo schema.sql");
    }

    $sql = file_get_contents($sqlFile);
    
    // Eliminar comentarios SQL
    $sql = preg_replace('/--[^\n]*\n/', '', $sql);
    
    // Dividir en statements individuales
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        function($stmt) {
            return !empty($stmt) && 
                   !preg_match('/^CREATE DATABASE/', $stmt) &&
                   !preg_match('/^USE /', $stmt);
        }
    );

    $stmtCount = 0;
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
            $stmtCount++;
        }
    }
    echo "   ✓ $stmtCount statements ejecutados\n";
    
    echo "   ✓ Tablas creadas\n";
    echo "   ✓ Datos de ejemplo insertados\n\n";

    // Verificar las tablas creadas
    echo "4. Verificando instalación...\n";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "   Tablas creadas:\n";
    foreach ($tables as $table) {
        $count = $pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
        echo "   - $table ($count registros)\n";
    }

    echo "\n=================================\n";
    echo "✓ INSTALACIÓN COMPLETADA\n";
    echo "=================================\n\n";
    echo "La base de datos está lista para usar.\n";
    echo "Puedes acceder a: http://localhost/microframework/public\n\n";

} catch (PDOException $e) {
    echo "\n✗ ERROR DE BASE DE DATOS:\n";
    echo $e->getMessage() . "\n\n";
    echo "Verifica:\n";
    echo "- MySQL está corriendo\n";
    echo "- Usuario y contraseña son correctos\n";
    echo "- El usuario tiene permisos para crear bases de datos\n";
    exit(1);
} catch (Exception $e) {
    echo "\n✗ ERROR:\n";
    echo $e->getMessage() . "\n";
    exit(1);
}
