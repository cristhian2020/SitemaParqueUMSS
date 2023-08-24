<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($parqueo !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
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
                <center>
                    <h2>Listado de sitios asignados en la sección “B”</h2>

                    <br>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="mapeo-de-vehiculos.php" class="btn btn-primary">Sección "A"</a>
                                <a href="mapeo-de-vehiculosB.php" class="btn btn-primary">Sección "B"</a>
                            </div>
                        </div>
                    </div>
                </center>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-sm table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">
                                            <center>Nro</center>
                                        </th>
                                        <th class="text-center">Nombre y apellido</th>
                                        <th class="text-center">Nit/Ci</th>
                                        <th class="text-center">Placa 1</th>
                                        <th class="text-center">Placa 2</th>
                                        <th class="text-center">Sitio</th>
                                        <th class="text-center">Nit compartido</th>
                                        <th class="text-center">Fecha asignación</th>
                                        <th class="text-center">Fecha asignación compartida</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_cliente = 0;
                                    $query_clientes = $pdo->prepare("SELECT
                  tb_clientes.id_cliente,
                  tb_clientes.nombre_cliente,
                  tb_clientes.nit_cliente,
                  tb_clientes.correo,
                  tb_clientes.placa_auto,
                  tb_clientes.placa_auto_dos,
                  tb_mapeos.espacio,
                  tb_clientes.nit_compartido,
                  tb_clientes.fecha_asignacion,
                  tb_clientes.fecha_asignacion_comp AS fecha_asignacion_compartida
                FROM
                  tb_mapeos
                INNER JOIN
                  tb_clientes ON tb_mapeos.id_map = tb_clientes.map_id
                WHERE
                  tb_mapeos.estado = '1' AND tb_mapeos.seccion = 'B'
                GROUP BY
                  tb_mapeos.espacio;");
                                    $query_clientes->execute();
                                    $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($datos_clientes as $datos_cliente) {
                                        $contador_cliente = $contador_cliente + 1;
                                        $nombre_cliente = $datos_cliente['nombre_cliente'];
                                        $nit_cliente = $datos_cliente['nit_cliente'];
                                        $correo = $datos_cliente['correo'];
                                        $placa_auto = $datos_cliente['placa_auto'];
                                        $placa_auto_dos = $datos_cliente['placa_auto_dos'];
                                        $espacio = $datos_cliente['espacio'];
                                        $id_cliente = $datos_cliente['id_cliente'];
                                        $nit_compartido = $datos_cliente['nit_compartido'];
                                        $fecha_asignacion = $datos_cliente['fecha_asignacion'];
                                        $fecha_asignacion_compartida = $datos_cliente['fecha_asignacion_compartida'];
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $contador_cliente; ?></td>
                                            <td class="text-center"><?php echo $nombre_cliente; ?></td>
                                            <td class="text-center"><?php echo $nit_cliente; ?></td>
                                            <td class="text-center"><?php echo $placa_auto; ?></td>
                                            <td class="text-center"><?php echo $placa_auto_dos; ?></td>
                                            <td class="text-center"><?php echo $espacio; ?></td>
                                            <td class="text-center"><?php echo $nit_compartido; ?></td>
                                            <td class="text-center"><?php echo $fecha_asignacion; ?></td>
                                            <td class="text-center"><?php echo $fecha_asignacion_compartida; ?></td>
                                            <td class="text-center">
                                                <a href="../parqueo/liberar_espacio.php?id=<?php echo $id_cliente; ?>" class="btn btn-info">Liberar</a>
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

        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>