<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($roles !== 'on') {
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

                <h2>Listado de roles</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <th>
                                    <center>Nro</center>
                                </th>
                                <th>
                                    <center>Rol</center>
                                </th>
                                <th>
                                    <center>Acción</center>
                                </th>
                            </thead>
                            <tbody>
                                <?php
                                $contador = 0;
                                $query_roles = $pdo->prepare("SELECT * FROM tb_roles WHERE estado = '1' ");
                                $query_roles->execute();
                                $roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($roles as $role) {
                                    $id_rol = $role['id_rol'];
                                    $nombre_rol = $role['nombre_rol'];
                                    $contador = $contador + 1;
                                ?>
                                    <tr>
                                        <td>
                                            <center><?php echo $contador; ?></center>
                                        </td>
                                        <td>
                                            <center><?php echo $nombre_rol; ?></center>
                                        </td>
                                        <td>
                                            <center>

                                                <a href="delete.php?id=<?php echo $id_rol; ?>" class="btn btn-danger">Eliminar</a>

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

        </div>
        <!-- /.content-wrapper -->
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>