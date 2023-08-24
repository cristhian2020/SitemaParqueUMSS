<?php
include('../app/config.php');

$placa = $_GET['placa'];
$descripcion = $_GET['descripcion'];
$autor = $_GET['autor'];

date_default_timezone_set("America/Caracas");
$fechaHora = date("Y-m-d H:i:s");
$estado_del_registro = "1";

// Verificar si la placa existe en la tabla tb_clientes y obtener el ID del cliente
$query_verificar = $pdo->prepare("SELECT id_cliente FROM tb_clientes WHERE placa_auto = :placa OR placa_auto_dos = :placa");
$query_verificar->bindParam(':placa', $placa);
$query_verificar->execute();
$cliente = $query_verificar->fetch(PDO::FETCH_ASSOC);

if ($cliente) {
    $cliente_id = $cliente['id_cliente'];

    // La placa existe en la tabla tb_clientes, realizar el registro en tb_reportes_g
    $sentencia = $pdo->prepare("INSERT INTO tb_reportes_g (descripcion, cliente_id, autor, fyh_creacion, estado) 
                                VALUES (:descripcion, :cliente_id, :autor, :fyh_creacion, :estado)");
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':cliente_id', $cliente_id);
    $sentencia->bindParam(':autor', $autor);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindParam(':estado', $estado_del_registro);

    if ($sentencia->execute()) {
        echo 'Registro satisfactorio';
        ?>
        <script>
            alert("Reporte enviado exitosamente");
            location.href = "../guardia/reportes.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Error al ingresar el reporte");
        </script>
        <?php
    }
} else {
    // La placa no existe en la tabla tb_clientes, mostrar mensaje de error
    echo "La placa ingresada no existe en la tabla de clientes.";
}
?>
