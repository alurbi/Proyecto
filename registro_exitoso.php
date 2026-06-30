<?php
session_start();

if (!isset($_SESSION['mensaje_exito'])) {
    header("Location: HOME.html");
    exit();
}

$usuario = $_SESSION['usuario'];
$password = $_SESSION['password_temporal'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Exitoso - Congreso 2026</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylesP.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="titulo">Registro <span>Exitoso</span></h1>
    </header>

    <main class="contenedor sombra">
        <h2>✅ ¡Tu registro ha sido completado!</h2>
        
        <div class="datos-acceso">
            <h3>Tus datos de acceso:</h3>
            <p><strong>Usuario:</strong> <?php echo $usuario; ?></p>
            <p><strong>Contraseña temporal:</strong> <?php echo $password; ?></p>
            <p class="advertencia">* Guarda esta información. Podrás iniciar sesión con estos datos.</p>
        </div>

        <div class="botones">
            <a href="login.php" class="boton">Iniciar Sesión</a>
            <a href="HOME.html" class="boton">Volver al Inicio</a>
        </div>
    </main>
</body>
</html>