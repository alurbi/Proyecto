<?php
session_start();

// si no viene de un registro exitoso, redirigir
if (!isset($_SESSION['registro_exitoso']) || $_SESSION['registro_exitoso'] !== true) {
    header("Location: registro.php");
    exit();
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
$precio = ($tipo_usuario == 'participante') ? 500 : 800;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Simulado - Congreso 2026</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylesP.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="titulo">Simulación de <span>Pago</span></h1>
    </header>

    <main class="contenedor sombra">
        <h2>Pago con PayPal (Simulado)</h2>
        
        <div class="info-pago">
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Tipo:</strong> <?php echo ucfirst($tipo_usuario); ?></p>
            <p><strong>Monto a pagar:</strong> $<?php echo $precio; ?> MXN</p>
        </div>

        <!-- bot de PayPal -->
        <div class="pago-simulado">
            <form action="confirmar_pago.php" method="POST">
                <input type="hidden" name="monto" value="<?php echo $precio; ?>">
                <input type="submit" class="boton" value="✅ Pagar con PayPal (Simulado)">
            </form>
            <p class="nota">* Esto es una simulación. No se realiza un cobro real.</p>
        </div>

        <div class="regresar">
            <a href="HOME.html" class="enlace-negro">← Cancelar y volver al inicio</a>
        </div>
    </main>
</body>
</html>