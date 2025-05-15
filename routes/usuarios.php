<?php

require_once BASE_PATH . '/models/Usuario.php'; // Usa la ruta absoluta

$usuario = new Usuario($conn);

switch ($method) {
    case 'GET':
        if (isset($request[1])) {
            $id = $request[1];
            $data = $usuario->getById($id);
        } else {
            $data = $usuario->getAll();
        }
        echo json_encode($data);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if ($usuario->create($input)) {
            http_response_code(201);
            echo json_encode(["mensaje" => "Usuario creado"]);
        } else {
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crear usuario"]);
        }
        break;

    case 'PUT':
        // Put request to update a user
        // Se obtiene el ID del usuario a actualizar
        if (isset($request[1])) {
            $id = $request[1];
            $input = json_decode(file_get_contents('php://input'), true);
            if ($usuario->update($id, $input)) {
                echo json_encode(["mensaje" => "Usuario actualizado"]);
            } else {
                http_response_code(500);
                echo json_encode(["mensaje" => "Error al actualizar"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "ID requerido"]);
        }
        break;

    case 'DELETE':
        if (isset($request[1])) {
            $id = $request[1];
            if ($usuario->delete($id)) {
                echo json_encode(["mensaje" => "Usuario eliminado"]);
            } else {
                http_response_code(500);
                echo json_encode(["mensaje" => "Error al eliminar"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["mensaje" => "ID requerido"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["mensaje" => "Método no permitido"]);
        break;
}