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
                <h2>Listado de guardias</h2>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">
                                    <center>Nro</center>
                                </th>
                                <th scope="col">
                                    <center>Nombre y apellido</center>
                                </th>
                                <th scope="col">
                                    <center>Correo electrónico</center>
                                </th>
                                <th scope="col">
                                    <center>Rol</center>
                                </th>
                                <th scope="col">
                                    <center>Turno</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            $query_usuario = $pdo->prepare("SELECT u.id, u.nombres, u.email, u.turno, r.nombre_rol
                                      FROM tb_usuarios u
                                      JOIN tb_roles r ON u.rol_id = r.id_rol
                                      WHERE r.nombre_rol = 'GUARDIA';");

                            $query_usuario->execute();
                            $usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($usuarios as $usuario) {
                                $id = $usuario['id'];
                                $nombres = $usuario['nombres'];
                                $email = $usuario['email'];
                                $turno = $usuario['turno'];
                                $nombre_rol = $usuario['nombre_rol'];

                                $contador = $contador + 1;
                            ?>

                                <tr>
                                    <td>
                                        <center><?php echo $contador; ?> </center>
                                    </td>
                                    <td>
                                        <center><?php echo $nombres; ?></center>
                                    </td>
                                    <td>
                                        <center><?php echo $email; ?> </center>
                                    </td>
                                    <td>
                                        <center><?php echo $nombre_rol; ?> </center>
                                    </td>
                                    <td>
                                        <center><?php echo $turno; ?> </center>
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