<?php
// config de la bd
$host = "localhost";
$user = "root";
$password = "";
$database = "congreso_db";

// crear conexion
$conn = new mysqli($host, $user, $password, $database);

// verificar error
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}

?>