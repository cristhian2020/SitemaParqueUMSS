<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
// Verificar si el usuario ha iniciado sesión
if ($guardia !== 'on') {
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
                <h2>Listado de reportes</h2>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">
                                    <center>Nro</center>
                                </th>
                                <th scope="col">
                                    <center>Placa</center>
                                </th>
                                <th scope="col">
                                    <center>Descripción</center>
                                </th>
                                <th scope="col">
                                    <center>Autor</center>
                                </th>
                                <th scope="col">
                                    <center>Acción</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            $query_reporte = $pdo->prepare("SELECT r.*, c.placa_auto
                                      FROM tb_reportes_g r
                                      INNER JOIN tb_clientes c ON r.cliente_id = c.id_cliente
                                      WHERE r.estado = '1';");
                            $query_reporte->execute();
                            $reportes = $query_reporte->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($reportes as $reporte) {
                                $id_reporte_g = $reporte['id_reporte_g'];
                                $placa_auto = $reporte['placa_auto'];
                                $descripcion = $reporte['descripcion'];
                                $autor = $reporte['autor'];

                                $contador = $contador + 1;
                            ?>

                                <tr>
                                    <td>
                                        <center><?php echo $contador; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $placa_auto; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $descripcion; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $autor; ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="delete.php?id=<?php echo $id_reporte_g; ?>" class="btn btn-danger">Eliminar</a>
                                        </center>
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
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>

</body>

</html>