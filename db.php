<?php 

$host = 'localhost';
$dbname = 'api_db';
$username = 'root';
$password = 'Jafet004'; // Asegúrate de que sea la contraseña correcta

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}