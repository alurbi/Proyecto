<?php
session_start();
include 'conexion.php';

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// buscar en tabla admin
$sql_admin = "SELECT * FROM admin WHERE usuario = '$usuario' AND password = MD5('$password')";
$resultado_admin = $conn->query($sql_admin);

if ($resultado_admin->num_rows > 0) {
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipo'] = 'admin';
    $_SESSION['id_usuario'] = 0;
    header("Location: admin.php");
    exit();
}

// buscar en tabla usuarios (participantes y ponentes)
$sql_usuario = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = MD5('$password')";
$resultado_usuario = $conn->query($sql_usuario);

if ($resultado_usuario->num_rows > 0) {
    $fila = $resultado_usuario->fetch_assoc();
    $_SESSION['usuario'] = $usuario;
    $_SESSION['tipo'] = $fila['tipo_usuario']; // 'participante' o 'ponente'
    $_SESSION['id_usuario'] = $fila['id'];
    $_SESSION['nombre'] = $fila['nombre_completo'];
    
    if ($fila['tipo_usuario'] == 'participante') {
        header("Location: panel_participantes.php");
    } else {
        header("Location: panel_ponente.php");
    }
    exit();
}

// si no encontr nada
header("Location: login.php?error=1");
$conn->close();
?>