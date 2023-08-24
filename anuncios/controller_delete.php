<?php

include('../app/config.php');

$id_anuncio = $_GET['id_anuncio'];
$estado_inactivo = "0";

date_default_timezone_set("America/caracas");
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare("UPDATE tb_anuncios SET
estado = :estado,
fyh_eliminacion = :fyh_eliminacion 
WHERE id_anuncio = :id_anuncio");

$sentencia->bindParam(':estado',$estado_inactivo);
$sentencia->bindParam(':fyh_eliminacion',$fechaHora);
$sentencia->bindParam(':id_anuncio',$id_anuncio);

if($sentencia->execute()){
    echo "se elimino el registro de la manera correcta";
    ?>
    <script>location.href = "index.php";</script>
    <?php

}else{
    echo "error al eliminar el registro";
}