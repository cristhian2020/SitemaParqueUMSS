<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_sesion'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: '.$URL.'/login');
    exit();
}

?>

<!DOCTYPE html>

<html lang="es">

<head>
    <?php include('../layout/admin/head.php'); ?>
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include('../layout/admin/menu.php'); ?>

        <div class="content-wrapper">
            <br>
            <div class="container">

                <?php
                $id_cliente_get = $_GET['id'];

                $query_cliente = $pdo->prepare("SELECT c.*, m.espacio, m.seccion
                                FROM tb_clientes c
                                JOIN tb_mapeos m ON c.map_id = m.id_map
                                WHERE c.id_cliente = ? AND c.estado = '1'");
                $query_cliente->execute([$id_cliente_get]);
                $clientes = $query_cliente->fetchAll(PDO::FETCH_ASSOC);

                foreach ($clientes as $cliente) {
                    $id_cliente = $cliente['id_cliente'];
                    $nombre_cliente = $cliente['nombre_cliente'];
                    $nit_cliente = $cliente['nit_cliente'];
                    $correo = $cliente['correo'];
                    $placa_auto = $cliente['placa_auto'];
                    $placa_auto_dos = $cliente['placa_auto_dos'];
                    $espacio = $cliente['espacio'];
                    $seccion = $cliente['seccion'];
                }
                ?>


                <br>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h3>Liberar espacio</h3>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Nombre y apellido</label>
                                        <input type="text" class="form-control col-md-12" id="nombre_cliente" value="<?php echo $nombre_cliente; ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nit o CI</label>
                                        <input type="text" class="form-control col-md-12" id="nit_cliente" value="<?php echo $nit_cliente; ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Correo electrónico</label>
                                        <input type="text" class="form-control col-md-12" id="correo" value="<?php echo $correo; ?>" disabled>
                                    </div>



                                    <div class="form-group">
                                        <label for="">Placas</label>

                                        <input type="text" class="form-control col-md-12" id="placa_auto" value="<?php echo $placa_auto; ?>" disabled>
                                        <br />
                                        <input type="text" class="form-control col-md-12" id="placa_auto_dos" value="<?php echo $placa_auto_dos; ?>" disabled>

                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Sitio</label>
                                        <input type="text" class="form-control col-md-12" id="espacio" value="<?php echo $espacio; ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Sección</label>
                                        <input type="text" class="form-control col-md-12" id="seccion" value="<?php echo $seccion; ?>" disabled>
                                    </div>


                    
                                    <br>
                                    <div class="form-group">
                                        <button class="btn btn-info" id="btn_liberar"> Liberar </button>
                                        <a href="<?php echo $URL; ?>/parqueo/mapeo-de-vehiculos.php" class="btn btn-secondary">Cancelar</a>
                                    </div>

                                    <div id="respuesta">
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>



        </div>
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
    </div>
 
    </div>

</body>
<script>
        $('#btn_liberar').click(function() {
    
            var id_cliente = '<?php echo $id_cliente_get = $_GET['id']; ?>';
    
            var url = 'controller_liberar_espacio.php';
            $.get(url, {
                id_cliente: id_cliente
            }, function(datos) {
                $('#respuesta').html(datos);
            });
    
        });
    </script>


</html>
