<?php
session_start();
include 'conexion.php';

// recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$institucion = $_POST['institucion'];
$tipo_usuario = $_POST['tipo_usuario'];

// generar usuario a partir del correo
$usuario = explode('@', $correo)[0];
// asegurar que el usuario sea único
$contador = 1;
$usuario_original = $usuario;
while (true) {
    $verificar = $conn->query("SELECT id FROM usuarios WHERE usuario = '$usuario'");
    if ($verificar->num_rows == 0) break;
    $usuario = $usuario_original . $contador;
    $contador++;
}

// password temporal
$password_temporal = substr(md5(rand()), 0, 8);
$password_hash = md5($password_temporal);

// insertar en tabla usuarios
$sql = "INSERT INTO usuarios (usuario, password, nombre_completo, correo, telefono, institucion, tipo_usuario) 
        VALUES ('$usuario', '$password_hash', '$nombre', '$correo', '$telefono', '$institucion', '$tipo_usuario')";

if ($conn->query($sql) === TRUE) {
    $usuario_id = $conn->insert_id;
    
    // si es ponente guardar el archivo
    if ($tipo_usuario == 'ponente' && isset($_FILES['archivo_ponencia']) && $_FILES['archivo_ponencia']['error'] == 0) {
        $categoria = $_POST['categoria_archivo'];
        $archivo = $_FILES['archivo_ponencia'];
        $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
        $nombre_archivo = "ponente_" . $usuario_id . "_" . date('Ymd_His') . "." . $extension;
        $ruta_destino = "uploads/" . $nombre_archivo;
        
        if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
            $sql_archivo = "INSERT INTO archivos_ponentes (usuario_id, tipo_envio, archivo_ruta) 
                            VALUES ('$usuario_id', '$categoria', '$ruta_destino')";
            $conn->query($sql_archivo);
        }
    }
    
    // guardar datos en sesion para el pago
    $_SESSION['registro_exitoso'] = true;
    $_SESSION['usuario_id'] = $usuario_id;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['tipo_usuario'] = $tipo_usuario;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['password_temporal'] = $password_temporal;
    
    // redirigir al pago simulado
    header("Location: simular_pago.php");
    
} else {
    echo "Error al registrar: " . $conn->error;
}

$conn->close();
?>