<?php
session_start();
include 'conexion.php';

$monto = $_POST['monto'];
$usuario_id = $_SESSION['usuario_id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// guardar el pago en la base de datos
$sql = "INSERT INTO pagos (usuario_id, monto, concepto, estado, fecha_pago) 
        VALUES ('$usuario_id', '$monto', '$tipo_usuario', 'completado', NOW())";

if ($conn->query($sql) === TRUE) {
    $pago_id = $conn->insert_id;
    
    // generar recibo PDF (simulado)
    $nombre_recibo = "recibo_" . $usuario_id . "_" . date('Ymd_His') . ".pdf";
    $ruta_recibo = "uploads/" . $nombre_recibo;
    
    // actualizar el recibo en el pago
    $conn->query("UPDATE pagos SET recibo_pdf = '$ruta_recibo' WHERE id = $pago_id");
    
    // limpiar variables de sesion de registro
    $_SESSION['mensaje_exito'] = "¡Pago completado! Tu registro ha sido exitoso.";
    $_SESSION['usuario'] = $_SESSION['usuario'];
    $_SESSION['password_temporal'] = $_SESSION['password_temporal'];
    
    header("Location: registro_exitoso.php");
} else {
    echo "Error al procesar el pago: " . $conn->error;
}

$conn->close();
?>