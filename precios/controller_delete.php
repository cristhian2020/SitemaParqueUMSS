

<?php
include('../app/config.php');

$id_precio = $_GET['id_precio'];

$sentencia = $pdo->prepare("DELETE FROM tb_precios WHERE id_precio = :id_precio");

$sentencia->bindParam(':id_precio',$id_precio);

if($sentencia->execute()){

    ?>
    <script>
        alert("Precio eliminado exitosamente");
    </script>
    <?php

    ?>
    <script>location.href = "../precios/precios.php";</script>
    <?php
}else{
    ?>
    <script>
        alert("No se puede eliminar un precio si tiene usuarios asignados");
    </script>
    <?php
}

?>  



