<?php
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../config/database.php';

// Auto-setup: crear base de datos si no existen las tablas
try {
    $db = Database::getInstance()->getConnection();
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        // Las tablas no existen, ejecutar setup
        $sql = file_get_contents(__DIR__ . '/../database/schema.sql');
        $sql = preg_replace('/--[^\n]*\n/', '', $sql);
        
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            function($stmt) {
                return !empty($stmt) && 
                       !preg_match('/^CREATE DATABASE/', $stmt) &&
                       !preg_match('/^USE /', $stmt);
            }
        );

        foreach ($statements as $statement) {
            if (!empty($statement)) {
                $db->exec($statement);
            }
        }
    }
} catch (Exception $e) {
    // Ignorar si falla, continuar normalmente
}

// Autoloader simple
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../src/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

$router = new Router();

// Rutas de Artículos
$router->add('GET', '/', 'ArticulosController@index');
$router->add('GET', '/articulos', 'ArticulosController@index');
$router->add('GET', '/articulos/crear', 'ArticulosController@crear');
$router->add('POST', '/articulos/guardar', 'ArticulosController@guardar');
$router->add('GET', '/articulos/editar', 'ArticulosController@editar');
$router->add('POST', '/articulos/actualizar', 'ArticulosController@actualizar');
$router->add('GET', '/articulos/eliminar', 'ArticulosController@eliminar');

// Rutas de Nombres
$router->add('GET', '/nombres', 'NombresController@index');
$router->add('GET', '/nombres/crear', 'NombresController@crear');
$router->add('POST', '/nombres/guardar', 'NombresController@guardar');
$router->add('GET', '/nombres/editar', 'NombresController@editar');
$router->add('POST', '/nombres/actualizar', 'NombresController@actualizar');
$router->add('GET', '/nombres/eliminar', 'NombresController@eliminar');

// API REST
$router->add('GET', '/api/articulos', 'ArticulosController@api');
$router->add('GET', '/api/nombres', 'NombresController@api');

$router->dispatch();
