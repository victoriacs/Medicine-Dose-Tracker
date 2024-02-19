<?php

$host = 'localhost'; // Cambiar según el servidor de tu base de datos
$dbname = 'medicine_dose'; // Cambiar según el nombre de tu base de datos
$username = 'root'; // Cambiar según el nombre de usuario de tu base de datos
$password = ''; // Cambiar según la contraseña de tu base de datos

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejar errores de conexión a la base de datos
    echo "Error de conexión: " . $e->getMessage();
    die(); // Detener la ejecución del script
}
?>