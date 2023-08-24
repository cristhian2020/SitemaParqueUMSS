<?php
include('../app/config.php');



$asunto = $_GET['asunto'];
$descripcion= $_GET['descripcion'];

date_default_timezone_set("America/Caracas");
$fechaHora = date("Y-m-d");

// Verificar si el cliente está registrado en la tabla de clientes
$nitCliente = $_GET['nit_cliente'];
$clienteEncontrado = false;

$consultaCliente = $pdo->prepare("SELECT * FROM tb_clientes WHERE nit_cliente = :nit_cliente");
$consultaCliente->bindParam(':nit_cliente', $nitCliente);
$consultaCliente->execute();

if ($consultaCliente->rowCount() > 0) {
    $cliente = $consultaCliente->fetch(PDO::FETCH_ASSOC);
    $clienteEncontrado = true;
    $clienteId = $cliente['id_cliente'];
}

if (!$clienteEncontrado) {
    echo '<script>alert("El cliente no está registrado en el sistema.");</script>';
    exit();
}

$sentencia = $pdo->prepare("INSERT INTO tb_solicitudes
                                (asunto, descripcion, fyh_creacion, estado, cliente_id) 
                           VALUES (:asunto, :descripcion, :fyh_creacion, :estado, :cliente_id)");
                           
$sentencia->bindParam(':asunto', $asunto);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':fyh_creacion', $fechaHora);
$sentencia->bindParam(':estado', $estado_del_registro);
$sentencia->bindParam(':cliente_id', $clienteId);



if ($sentencia->execute()) {

    ?>
    <script>
        alert("Su mensaje fue recibido exitosamente");
    </script>
    <?php
} else {
    ?>
    <script>
        alert("No se pudo registrar en la base de datos.");
    </script>
    <?php
}
?>
