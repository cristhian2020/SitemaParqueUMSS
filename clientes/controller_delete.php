
<?php
include('../app/config.php');

$id_cliente = $_GET['id_cliente'];

$sentencia = $pdo->prepare("DELETE FROM tb_clientes WHERE id_cliente = :id_cliente");

$sentencia->bindParam(':id_cliente',$id_cliente);

if($sentencia->execute()){
    echo "El registro se eliminó correctamente.";
    ?>
    <script>location.href = "index.php";</script>
    <?php
}else{
    ?>
    <script>
        alert("Error al eliminar el registro.");

    </script> 
    <?php
}

?>
