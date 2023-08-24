<?php
include('../app/config.php');

$nro_factura = $_GET['nro_factura'];

date_default_timezone_set("America/Caracas");
$fechaHora = date("Y-m-d H:i:s");

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

// Verificar si el número de factura ya existe
$consulta = $pdo->prepare("SELECT COUNT(*) AS count FROM tb_facturaciones WHERE nro_factura = :nro_factura");
$consulta->bindParam(':nro_factura', $nro_factura);
$consulta->execute();
$resultado = $consulta->fetch(PDO::FETCH_ASSOC);
$count = $resultado['count'];

if ($count > 0) {
    // Verificar si el número de factura ya está registrado en la tabla tb_pagos
    $consulta_pago = $pdo->prepare("SELECT COUNT(*) AS count FROM tb_pagos WHERE nro_factura = :nro_factura");
    $consulta_pago->bindParam(':nro_factura', $nro_factura);
    $consulta_pago->execute();
    $resultado_pago = $consulta_pago->fetch(PDO::FETCH_ASSOC);
    $count_pago = $resultado_pago['count'];

    if ($count_pago > 0) {
        // El número de factura ya ha sido registrado en la tabla tb_pagos, mostrar mensaje de error
        ?>
        <script>
            alert("El número de recibo que desea ingresar ya fue pagado");
            location.href = "../index.php";
        </script>
        <?php
        exit; // Detener la ejecución del código restante
    }

    // El número de factura no está registrado en la tabla tb_pagos, continuar con el proceso

    // Actualizar el campo estado_factura a "SI"
    $estado_factura = "PAGADO";

    // Insertar el registro en la tabla tb_pagos
    $sentencia_insertar_pago = $pdo->prepare("INSERT INTO tb_pagos (nro_factura, fyh_creacion, estado)
                                             VALUES (:nro_factura, NOW(), :estado)");
    $sentencia_insertar_pago->bindParam(':nro_factura', $nro_factura);
    $sentencia_insertar_pago->bindParam(':estado', $estado_factura);

    // Actualizar el campo estado_factura en la tabla tb_facturaciones
    $sentencia_actualizar_factura = $pdo->prepare("UPDATE tb_facturaciones SET estado_factura = :estado_factura
                                                  WHERE nro_factura = :nro_factura");
    $sentencia_actualizar_factura->bindParam(':estado_factura', $estado_factura);
    $sentencia_actualizar_factura->bindParam(':nro_factura', $nro_factura);

    // Ejecutar ambas consultas dentro de una transacción
    $pdo->beginTransaction();

    try {
        $sentencia_insertar_pago->execute();
        $sentencia_actualizar_factura->execute();
        $pdo->commit();
        ?>
        <script>
            alert("Su pago ha sido recibido exitosamente.");
            location.href = "../index.php";
        </script>
        <?php
    } catch (PDOException $e) {
        $pdo->rollback();
        ?>
        <script>
            alert("Hubo un error al procesar su pago. Por favor, inténtelo nuevamente");
            location.href = "../index.php";
        </script>
        <?php
    }
} else {
    // El número de factura no existe, mostrar mensaje de error
    ?>
    <script>
        alert("El número de recibo no existe");
        location.href = "../index.php";
    </script>
    <?php
}
?>
