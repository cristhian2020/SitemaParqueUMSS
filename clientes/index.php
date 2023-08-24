<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($clientes !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
    exit();
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../layout/admin/head.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../layout/admin/menu.php'); ?>
        <div class="content-wrapper">
            <br>
            <br>
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h2>Listado de clientes</h2>
                        <br>
                        <a href="reporte.php" class="btn btn-primary">Generar reporte
                            <i class="fa fa">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
                                    <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v6zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z" />
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg>
                            </i>
                        </a>


                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th class="text-center">Nombre y apellido</th>
                                        <th class="text-center">Nit/Ci</th>
                                        <th class="text-center">Correo electrónico</th>
                                        <th class="text-center">Placa 1</th>
                                        <th class="text-center">Placa 2</th>
                                        <th class="text-center">Compartido</th>
                                        <th>
                                            <center>Acción</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_cliente = 0;
                                    $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1'");
                                    $query_clientes->execute();
                                    $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($datos_clientes as $datos_cliente) {
                                        $contador_cliente = $contador_cliente + 1;
                                        $nombre_cliente = $datos_cliente['nombre_cliente'];
                                        $nit_cliente = $datos_cliente['nit_cliente'];
                                        $correo = $datos_cliente['correo'];
                                        $placa_auto = $datos_cliente['placa_auto'];
                                        $placa_auto_dos = $datos_cliente['placa_auto_dos'];
                                        $nit_compartido = $datos_cliente['nit_compartido'];
                                        $id_cliente = $datos_cliente['id_cliente'];
                                    ?>

                                        <tr>
                                            <td>
                                                <center><?php echo $contador_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nombre_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nit_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $correo; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $placa_auto; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $placa_auto_dos; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nit_compartido; ?></center>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <a href="update.php?id=<?php echo $id_cliente; ?>" class="btn btn-success mr-2">Actualizar</a>
                                                <a href="delete.php?id=<?php echo $id_cliente; ?>" class="btn btn-danger mr-2">Eliminar</a>
                                                <a href="../clientes/asignar_espacio.php?id=<?php echo $id_cliente; ?>" class="btn btn-dark mr-2">Asignar</a>
                                                <a href="../facturacion/create.php?id=<?php echo $id_cliente; ?>" class="btn btn-primary">Emitir</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>





                    </div>
                </div>




            </div>




        </div>
        <!-- /.content-wrapper -->
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>