<?php
include('app/config.php');
include('layout/admin/datos_usuario_sesion.php');
// Verificar si el usuario ha iniciado sesión



if (!isset($_SESSION['usuario_sesion'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
    exit();
}


?>



<!DOCTYPE html>

<html lang="es">

<head>
    <?php include('layout/admin/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('layout/admin/menu.php'); ?>
        <div class="content-wrapper">
            <br>
            <div class="container">
                <center>
                    <h2>SISTEMA DE PARQUEO - FCyT</h2>
                    <h3>Sección "B"</h3>
                    ¡Bienvenido al Parqueo B!

                    Nos complace recibirte en nuestro moderno y seguro parqueo. Aquí encontrarás un espacio diseñado para brindarte comodidad y tranquilidad mientras estacionas tu vehículo
                </center>
                <br>
                <center>

                    <img src="./public/imagenes/IMG20230609085940.jpg" width="250px" height="100px" alt="" class="img-fluid">
                </center>
                <div class="d-flex justify-content-between">
                    <a href="buscar_placa.php" class="btn btn-info">Buscar placa</a>
                    <a href="principal.php" class="btn btn-dark">Sección "A"</a>
                </div>
                <br>
                <br>




                <!-- /PARQUEO B-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> </h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display:block;">
                                <div class="row">
                                    <?php
                                    $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1' AND seccion = 'B'");
                                    $query_mapeos->execute();
                                    $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($mapeos as $mapeo) {
                                        $id_map = $mapeo['id_map'];
                                        $estado_espacio = $mapeo['estado_espacio'];
                                        $espacio = $mapeo['espacio'];

                                        if ($estado_espacio == "LIBRE") {
                                    ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $espacio; ?></h2>
                                                    <button class="btn btn-success" style="width: 100%;height: 114px" data-toggle="modal" data-target="#modal<?php echo $id_map; ?>">
                                                        <p><?php echo $estado_espacio; ?></p>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal<?php echo $id_map; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Estado del sitio "B": <?php echo "<span style='font-size: 25px;'>" . $espacio . "</span>" ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <?php
                                                                    $query_cliente = $pdo->prepare("SELECT * FROM tb_clientes WHERE map_id = :id_map");
                                                                    $query_cliente->bindParam(':id_map', $id_map, PDO::PARAM_INT);
                                                                    $query_cliente->execute();
                                                                    $cliente = $query_cliente->fetch(PDO::FETCH_ASSOC);
                                                                    if ($cliente) {
                                                                        echo "<h5><b>Nombre del cliente: </b><span style='font-size: 20px;'>" . $cliente['nombre_cliente'] . "</span></h5>";
                                                                        echo "<h5><b>NIT del cliente: </b><span style='font-size: 20px;'>" . $cliente['nit_cliente'] . "</span></h5>";
                                                                        echo "<h5><b>Placa del auto: </b><span style='font-size: 20px;'>" . $cliente['placa_auto'] . "</span></h5>";

                                                                        if (!empty($cliente['nit_compartido'])) {
                                                                            $query_nit_compartido = $pdo->prepare("SELECT nit_cliente, nombre_cliente FROM tb_clientes WHERE nit_cliente = :nit_compartido");
                                                                            $query_nit_compartido->bindParam(':nit_compartido', $cliente['nit_compartido']);
                                                                            $query_nit_compartido->execute();
                                                                            $cliente_nit_compartido = $query_nit_compartido->fetch(PDO::FETCH_ASSOC);

                                                                            if ($cliente_nit_compartido) {
                                                                                echo "<h5><b>Nombre compartido: </b><span style='font-size: 20px;'>" . $cliente_nit_compartido['nombre_cliente'] . "</span></h5>";

                                                                                echo "<h5><b>NIT compartido: </b><span style='font-size: 20px;'>" . $cliente_nit_compartido['nit_cliente'] . "</span></h5>";
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo "No hay cliente asignado";
                                                                    }
                                                                    ?>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" onclick="ocuparEspacio(<?php echo $id_map; ?>)">Ocupar</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                                                    <script>
                                                                        function ocuparEspacio(id_map) {
                                                                            $.ajax({
                                                                                url: "parqueo/controller_cambiar_estado_ocupado.php?espacio=" + id_map,
                                                                                success: function(result) {
                                                                                    location.reload();
                                                                                },
                                                                                error: function(xhr, status, error) {
                                                                                    console.log("Error al ocupar el espacio: " + error);
                                                                                }
                                                                            });
                                                                        }
                                                                    </script>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                        <?php
                                        }

                                        if ($estado_espacio == "OCUPADO") {
                                        ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $espacio; ?></h2>
                                                    <button class="btn btn-warning" id="btn_ocupado<?php echo $id_map; ?>" data-toggle="modal" data-target="#exampleModal<?php echo $id_map; ?>">
                                                        <img src="<?php echo $URL; ?>/public/imagenes/auto1.png" width="60px" alt="">
                                                    </button>
                                                    <div class="modal fade" id="exampleModal<?php echo $id_map; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Estado del sitio "B": <?php echo "<span style='font-size: 25px;'>" . $espacio . "</span>" ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <?php
                                                                    $query_cliente = $pdo->prepare("SELECT * FROM tb_clientes WHERE map_id = :id_map");
                                                                    $query_cliente->bindParam(':id_map', $id_map, PDO::PARAM_INT);
                                                                    $query_cliente->execute();
                                                                    $cliente = $query_cliente->fetch(PDO::FETCH_ASSOC);
                                                                    if ($cliente) {
                                                                        echo "<h5><b>Nombre del cliente: </b><span style='font-size: 20px;'>" . $cliente['nombre_cliente'] . "</span></h5>";
                                                                        echo "<h5><b>NIT del cliente: </b><span style='font-size: 20px;'>" . $cliente['nit_cliente'] . "</span></h5>";
                                                                        echo "<h5><b>Placa del auto: </b><span style='font-size: 20px;'>" . $cliente['placa_auto'] . "</span></h5>";

                                                                        if (!empty($cliente['nit_compartido'])) {
                                                                            $query_nit_compartido = $pdo->prepare("SELECT nit_cliente, nombre_cliente FROM tb_clientes WHERE nit_cliente = :nit_compartido");
                                                                            $query_nit_compartido->bindParam(':nit_compartido', $cliente['nit_compartido']);
                                                                            $query_nit_compartido->execute();
                                                                            $cliente_nit_compartido = $query_nit_compartido->fetch(PDO::FETCH_ASSOC);

                                                                            if ($cliente_nit_compartido) {
                                                                                echo "<h5><b>Nombre compartido: </b><span style='font-size: 20px;'>" . $cliente_nit_compartido['nombre_cliente'] . "</span></h5>";

                                                                                echo "<h5><b>NIT compartido: </b><span style='font-size: 20px;'>" . $cliente_nit_compartido['nit_cliente'] . "</span></h5>";
                                                                            }
                                                                        }
                                                                    } else {
                                                                        echo "No hay cliente asignado";
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" onclick="desocuparEspacio(<?php echo $id_map; ?>)">Desocupar</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <script>
                                                                        function desocuparEspacio(id_map) {
                                                                            $.ajax({
                                                                                url: "parqueo/controller_cambiar_estado_libre.php?espacio=" + id_map,
                                                                                success: function(result) {
                                                                                    location.reload();
                                                                                },
                                                                                error: function(xhr, status, error) {
                                                                                    console.log("Error al desocupar el espacio: " + error);
                                                                                }
                                                                            });
                                                                        }
                                                                    </script>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p><?php echo $estado_espacio; ?></p>
                                                </center>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>








                <hr>
            </div>
        </div>
        <?php include('layout/admin/footer.php'); ?>
    </div>
    <?php include('layout/admin/footer_links.php'); ?>
    <!-- Incluir jQuery y Bootstrap -->

</body>

</html>