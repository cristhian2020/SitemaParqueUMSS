<?php
include('../app/config.php');



$fecha_limite_asignacion = $_GET['fecha_limite_asignacion'];
$fecha_limite_pago= $_GET['fecha_limite_pago'];



$sentencia = $pdo->prepare("INSERT INTO tb_fechas_limite
                                (fecha_limite_asignacion, fecha_limite_pago) 
                           VALUES (:fecha_limite_asignacion, :fecha_limite_pago)");
                           
$sentencia->bindParam(':fecha_limite_asignacion', $fecha_limite_asignacion);
$sentencia->bindParam(':fecha_limite_pago', $fecha_limite_pago);



if ($sentencia->execute()) {

    ?>
    <script>
        alert("Las fechas fueron registradas exitosamente");
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
