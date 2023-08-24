<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($buzon !== 'on') {
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
                <h2>Enviar correo electrónico</h2>
                <br>

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Clientes</h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body collapsed" style="display: none;">
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
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <br>
                    </div>
                </div>


                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Usuarios</h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body collapsed" style="display: none;">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    $query_usuario = $pdo->prepare("SELECT u.id, u.nombres, u.email, r.nombre_rol
                                        FROM tb_usuarios u
                                        JOIN tb_roles r ON u.rol_id = r.id_rol;");

                                    $query_usuario->execute();
                                    $usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($usuarios as $usuario) {
                                        $id = $usuario['id'];
                                        $nombres = $usuario['nombres'];
                                        $email = $usuario['email'];
                                        $nombre_rol = $usuario['nombre_rol'];

                                        $contador = $contador + 1;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nombres; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $email; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nombre_rol; ?></center>
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


                <form action="correo_multiple.php" method="post">
                    <div class="form-group">
                        <label for="to">Destinatario:</label>
                        <textarea class="form-control" id="to" name="to" rows="3" required></textarea>
                        <small class="form-text text-muted">Si usted desea mandar a más de una persona el mismo mensaje, ingrese los correos electrónicos separados por comas. (Ejemplo: user1@gmail.com, user2@gmail.com, user1@gmail.com, user2@gmail.com)</small>
                    </div>

                    <div class="form-group">
                        <label for="titulo">Asunto:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <a href="index.php" class="btn btn-secondary"> Cancelar</a>

                </form>

            </div>
        </div>
        <script>
            const asuntoInput = document.getElementById('titulo');
            const mensajeInput = document.getElementById('mensaje');






            asuntoInput.addEventListener('input', function() {
                if (asuntoInput.value.length >= 70) {
                    alert('Asunto demasiado largo');
                }
            });
            mensajeInput.addEventListener('input', function() {
                if (mensajeInput.value.length >= 500) {
                    alert('Mensaje demasiado largo');
                }
            });
        </script>
        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>


    </div>

</body>

</html>