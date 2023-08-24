<?php
include('../app/config.php');

$id = $_GET['id'];

$sentencia = $pdo->prepare("DELETE FROM tb_usuarios WHERE id = :id");

$sentencia->bindParam(':id', $id);

if ($sentencia->execute()) {
    echo "El registro se eliminó correctamente.";
    ?>
    <script>location.href = "index.php";</script>
    <?php
} else {
    echo "Error al eliminar el registro.";
}
?>
