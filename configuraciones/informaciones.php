<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

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

                <h2>Datos de  recibo</h2>



                <br>
                <div class="col-md-16">
                    <table id="table_id" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <th>
                                <center>Nro</center>
                            </th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Actividad</th>
                            <th class="text-center">Sucursal</th>
                            <th class="text-center">Dirección</th>
                            <th class="text-center">Zona</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Departamento</th>
                            <th class="text-center">País</th>
                            <th>
                                <center>Acción</center>
                            </th>
                        </thead>
                        <?php
                        $contador = 0;
                        $query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' ");
                        $query_informacions->execute();
                        $informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($informacions as $informacion) {
                            $id_informacion = $informacion['id_informacion'];
                            $nombre_parqueo = $informacion['nombre_parqueo'];
                            $actividad_empresa = $informacion['actividad_empresa'];
                            $sucursal = $informacion['sucursal'];
                            $direccion = $informacion['direccion'];
                            $zona = $informacion['zona'];
                            $telefono = $informacion['telefono'];
                            $departamento_ciudad = $informacion['departamento_ciudad'];
                            $pais = $informacion['pais'];
                            $contador = $contador + 1;
                        ?>
                            <tr>
                                <td>
                                    <center><?php echo $contador; ?></center>
                                </td>
                                <td class="text-center"><?php echo $nombre_parqueo; ?></td>
                                <td class="text-center"><?php echo $actividad_empresa; ?></td>
                                <td class="text-center"><?php echo $sucursal; ?></td>
                                <td class="text-center"><?php echo $direccion; ?></td>
                                <td class="text-center"><?php echo $zona; ?></td>
                                <td class="text-center"><?php echo $telefono; ?></td>
                                <td class="text-center"><?php echo $departamento_ciudad; ?></td>
                                <td class="text-center"><?php echo $pais; ?></td>

                                <td>
                                    <center>
                                        <a href="update_configuraciones.php?id=<?php echo $id_informacion; ?>" class="btn btn-success">Actualizar</a>
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
        <!-- /.content-wrapper -->
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>