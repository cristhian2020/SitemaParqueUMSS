<?php
include('../app/config.php');

$id_rol = $_GET['id_rol'];

$sentencia = $pdo->prepare("DELETE FROM tb_roles WHERE id_rol = :id_rol");

$sentencia->bindParam(':id_rol',$id_rol);

if($sentencia->execute()){

    ?>
    <script>
        alert("Rol eliminado exitosamente");
    </script>
    <?php

    ?>
    <script>location.href = "index.php/";</script>
    <?php
}else{
    ?>
    <script>
        alert("No se puede eliminar un rol si tiene usuarios asignados");
    </script>
    <?php
}

?>  