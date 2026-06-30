<?php
session_start();

// verificar que sea participante
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'participante') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Participante - Congreso 2026 - MI CAMBIO 222</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylesP.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="titulo">Panel de <span>Participante</span></h1>
    </header>

    <main class="contenedor sombra">
        <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
        
        <div class="info-usuario">
            <p><strong>Usuario:</strong> <?php echo $_SESSION['usuario']; ?></p>
            <p><strong>Tipo:</strong> Participante</p>
        </div>

        <div class="opciones">
            <a href="ver_mi_recibo.php" class="boton">Ver mi Recibo de Pago</a>
            <a href="descargar_constancia.php" class="boton">Descargar Constancia</a>
            <a href="cambiar_password.php" class="boton">Cambiar Contraseña</a>
        </div>

        <div class="regresar">
            <a href="HOME.html" class="enlace-negro">← Volver al Inicio</a>
        </div>
    </main>
</body>
</html>