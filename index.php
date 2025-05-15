<?php

define('BASE_PATH', __DIR__); // Define la ruta base del proyecto

// Carga la configuración de la base de datos
require_once BASE_PATH . '/db.php';

// Establece el encabezado para devolver JSON
header("Content-Type: application/json");

// Obtiene el método HTTP (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Captura la ruta de la solicitud
$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
$request = explode('/', trim($path_info, '/'));

// Ruteo básico
switch ($request[0]) {
    case 'usuarios':
        require_once BASE_PATH . '/routes/usuarios.php';
        break;
    
    default:
        http_response_code(404);
        echo json_encode(["mensaje" => "Recurso no encontrado"]);
        break;
}
