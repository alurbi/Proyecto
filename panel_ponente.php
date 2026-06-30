<?php
session_start();

// verificar que sea ponente
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'ponente') {
    header("Location: login.php");
    exit();
}

include 'conexion.php';
$usuario_id = $_SESSION['id_usuario'];

// obtener archivos subidos por este ponente
$sql_archivos = "SELECT * FROM archivos_ponentes WHERE usuario_id = $usuario_id ORDER BY fecha_subida DESC";
$archivos = $conn->query($sql_archivos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Ponente - Congreso 2026 - MI CAMBIO 333</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylesP.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="titulo">Panel de <span>Ponente</span></h1>
    </header>

    <main class="contenedor sombra">
        <h2>Bienvenido, <?php echo $_SESSION['nombre']; ?></h2>
        
        <div class="info-usuario">
            <p><strong>Usuario:</strong> <?php echo $_SESSION['usuario']; ?></p>
            <p><strong>Tipo:</strong> Ponente</p>
        </div>

        <div class="opciones">
            <a href="subir_nuevo_archivo.php" class="boton">📄 Subir Nueva Ponencia/Cartel/Artículo</a>
            <a href="mis_archivos.php" class="boton">📁 Ver Mis Archivos</a>
            <a href="cambiar_password.php" class="boton">🔑 Cambiar Contraseña</a>
        </div>

        <h3>Mis Archivos Subidos</h3>
        <?php if ($archivos->num_rows > 0): ?>
            <table class="tabla">
                <thead>
                    <tr><th>Tipo</th><th>Archivo</th><th>Fecha</th></tr>
                </thead>
                <tbody>
                    <?php while($archivo = $archivos->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo ucfirst($archivo['tipo_envio']); ?></td>
                        <td><a href="<?php echo $archivo['archivo_ruta']; ?>" target="_blank">Ver Archivo</a></td>
                        <td><?php echo $archivo['fecha_subida']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aún no has subido ningún archivo.</p>
        <?php endif; ?>

        <div class="regresar">
            <a href="HOME.html" class="enlace-negro">← Volver al Inicio</a>
        </div>
    </main>
</body>
</html>