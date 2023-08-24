<?php
include('../app/config.php');

$espacio = $_GET['espacio'];
$estado_espacio = "LIBRE";

date_default_timezone_set("America/Caracas");
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare("UPDATE  tb_mapeos SET 
                         
                          estado_espacio=:estado_espacio,
                          fyh_actualizacion = :fyh_actualizacion
                          WHERE id_map= :id_map");
                               
                           
                        
                        $sentencia->bindParam('estado_espacio',$estado_espacio);
                        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
                        $sentencia->bindParam('id_map',$espacio);


                        if($sentencia->execute() ){
                            echo 'se actualizo de manera satisfactoria';
                            ?>
        <!--<script>location.href = "index.php";</script>

    <?php
                        }else{
                            echo "no se pudo actualizar con la BD";
                        }
?>