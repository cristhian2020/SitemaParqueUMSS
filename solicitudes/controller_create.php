<?php
include('../app/config.php');
$nombre = $_GET['nombre'];
$correo = $_GET['correo'];
$descripcion = $_GET['descripcion'];

date_default_timezone_set("America/Caracas");
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare("INSERT INTO tb_solicitudes
                                (nombre, correo, descripcion,fyh_creacion,estado) 
                           VALUES (:nombre,:correo,:descripcion,:fyh_creacion,:estado)");
                           
$sentencia->bindParam('nombre',$nombre);
$sentencia->bindParam('correo',$correo);
$sentencia->bindParam('descripcion',$descripcion);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);



 if($sentencia->execute() ){
    echo 'registro satisfactorio';
    ?>
        <script>location.href = "..//";</script>

    <?php
}else{
    echo "no se pudo registrar con la BD";
}
?>