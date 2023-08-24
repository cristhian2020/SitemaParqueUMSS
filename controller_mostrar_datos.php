<?php
include('../app/config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$placa_auto = $_GET['placa_auto'];
$nit_ci = $_GET['nit_ci'];
$cuviculo_cliente = $_GET['cuviculo_cliente'];
$id_map = $_GET['id_map'];


date_default_timezone_set("America/Caracas");
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare("SELECT *  tb_clientes WHERE estado = '1' AND parqueo = 'A' 
                         
                         nombre_cliente=:nombre_cliente,
                         placa_auto =:placa_auto,
                         nit_ci = :nit_ci,
                         cuviculo_cliente = :cuviculo_cliente,
                          WHERE id_map= :id_map");
                               
                           
                        
                        $sentencia->bindParam('nombre_cliente',$nombre_cliente);
                        $sentencia->bindParam('placa_auto',$placa_auto);
                        $sentencia->bindParam('nit_ci',$nit_ci);
                        $sentencia->bindParam('cuviculo_cliente',$cuviculo_cliente);

                        $sentencia->bindParam('id_map',$id_map);


                        if($sentencia->execute() ){
                            echo 'se actualizo de manera satisfactoria';
                            ?>
                            <script>location.href = "principal.php";</script>

                        <?php
                        }else{
                            echo "no se pudo actualizar con la BD";
                        }
?>