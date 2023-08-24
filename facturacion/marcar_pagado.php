<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
// Verificar si el usuario ha iniciado sesión
if ($recibos !== 'on') {
  // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
  header('Location: ' . $URL . '/login');
  exit();
}

// Obtener el ID de la factura a marcar como pagada
$id_factura = $_GET['id_factura'];

// Actualizar el estado de la factura en la base de datos
$query_actualizar = $pdo->prepare("UPDATE tb_facturaciones SET estado_factura = 'PAGADO' WHERE id_factura = :id_factura");
$query_actualizar->bindParam(':id_factura', $id_factura);
$query_actualizar->execute();

// Redirigir a la página de facturas emitidas
header("Location: index.php");
exit();
?>
