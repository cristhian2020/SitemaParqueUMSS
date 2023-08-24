<?php
include('../app/config.php');

$id_reporte_g = $_GET['id_reporte_g'];

$sentencia = $pdo->prepare("DELETE FROM tb_reportes_g WHERE id_reporte_g = :id_reporte_g");

$sentencia->bindParam(':id_reporte_g',$id_reporte_g);

if($sentencia->execute()){

    ?>
    <script>
        alert("reporte eliminado exitosamente");
    </script>
    <?php

    ?>
    <script>location.href = "reportes.php";</script>
    <?php
}else{
    ?>
    <script>
        alert("No se puede eliminar un reporte si tiene usuarios asignados");
    </script>
    <?php
}

?>