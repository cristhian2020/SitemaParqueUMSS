<?php
include('../app/config.php');

$id_fecha = $_GET['id_fecha'];

$sentencia = $pdo->prepare("DELETE FROM tb_fechas_limite WHERE id_fecha = :id_fecha");

$sentencia->bindParam(':id_fecha', $id_fecha);

if ($sentencia->execute()) {
    ?>
    <script>
        alert("Fecha eliminada exitosamente");
        location.href = "../fechas/create.php";
    </script>
    <?php
} else {
    ?>
    <script>
        alert("No se puede eliminar esta fecha");
        history.back();
    </script>
    <?php
}
?>
