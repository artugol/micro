<?php

// Credenciales de Railway
$host = 'shinkansen.proxy.rlwy.net';
$port = 53350;
$dbname = 'railway';
$user = 'root';
$password = 'XGwGRHXZRIoGqnbxorTFOTOWyepRggKF';

echo "🚂 Conectando a Railway MySQL...\n";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;charset=utf8mb4",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "✓ Conectado\n\n";
    
    // Seleccionar base de datos
    $pdo->exec("USE `$dbname`");
    
    // Leer schema.sql
    echo "Leyendo schema.sql...\n";
    $sql = file_get_contents(__DIR__ . '/database/schema.sql');
    
    // Limpiar comentarios
    $sql = preg_replace('/--[^\n]*\n/', '', $sql);
    
    // Ejecutar statements
    $statements = array_filter(
        array_map('trim', explode(';', $sql)),
        function($stmt) {
            return !empty($stmt) && 
                   !preg_match('/^CREATE DATABASE/', $stmt) &&
                   !preg_match('/^USE /', $stmt);
        }
    );

    $count = 0;
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            $pdo->exec($statement);
            $count++;
        }
    }
    
    echo "✓ Se ejecutaron $count statements\n\n";
    
    // Verificar
    echo "Verificando tablas:\n";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $rows = $pdo->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
        echo "  - $table: $rows registros\n";
    }
    
    echo "\n✅ ¡LISTO! Base de datos subida a Railway\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Verifica el password en la variable \$password\n";
}
