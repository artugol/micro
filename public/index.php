<?php
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../config/database.php';

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
