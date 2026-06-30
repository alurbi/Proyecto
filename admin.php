<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

// contar datos
$total_usuarios = $conn->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()['total'];
$total_ponentes = $conn->query("SELECT COUNT(*) as total FROM usuarios WHERE tipo_usuario = 'ponente'")->fetch_assoc()['total'];
$total_participantes = $conn->query("SELECT COUNT(*) as total FROM usuarios WHERE tipo_usuario = 'participante'")->fetch_assoc()['total'];

$ponentes = $conn->query("SELECT u.nombre_completo, u.correo, u.institucion, a.tipo_envio, a.archivo_ruta FROM usuarios u LEFT JOIN archivos_ponentes a ON u.id = a.usuario_id WHERE u.tipo_usuario = 'ponente' ORDER BY u.id DESC");

$participantes = $conn->query("SELECT nombre_completo, correo, telefono, institucion FROM usuarios WHERE tipo_usuario = 'participante' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrador - Congreso 2026</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylesP.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1 class="titulo">Panel <span>Administrativo</span></h1>
    </header>

    <main class="contenedor sombra">
        <h2>Resumen del Evento</h2>

        <div class="admin-stats">
            <div class="card">
                <h3>Total Asistentes</h3>
                <p class="numero"><?php echo $total_usuarios; ?></p>
            </div>
            <div class="card">
                <h3>Ponentes</h3>
                <p class="numero"><?php echo $total_ponentes; ?></p>
            </div>
            <div class="card">
                <h3>Participantes</h3>
                <p class="numero"><?php echo $total_participantes; ?></p>
            </div>
        </div>


        <!-- EN ESTA PARTE SE VA A MOSTRAR LO DE LA BASE, ESO QUE ESTA AHI ES NOMAS PARA RELLENAR -->


        <section>
            <h2>Listado de Ponentes</h2>
            <div class="contenedor-tabla">
                <table class="tabla-admin">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Institución</th>
                            <th>Categoría</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($p = $ponentes->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $p['nombre_completo']; ?></td>
                                <td><?php echo $p['correo']; ?></td>
                                <td><?php echo $p['institucion']; ?></td>
                                <td><?php echo ucfirst($p['tipo_envio'] ?? '---'); ?></td>
                                <td><?php if($p['archivo_ruta']) echo '<a href="'.$p['archivo_ruta'].'" class="enlace-tabla" target="_blank">Ver Archivo</a>'; else echo '---'; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                </table>
            </div>
        </section>

        <section>
            <h2>Listado de Participantes</h2>
            <div class="contenedor-tabla">
                <table class="tabla-admin">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Institución</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($part = $participantes->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $part['nombre_completo']; ?></td>
                                <td><?php echo $part['correo']; ?></td>
                                <td><?php echo $part['telefono']; ?></td>
                                <td><?php echo $part['institucion']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                </table>
            </div>
        </section>

        <div class="alinear-derecha">
            <a href="cerrar_sesion.php" class="boton">Cerrar Sesión</a>
        </div>
    </main>
</body>

</html>