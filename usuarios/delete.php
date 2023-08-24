<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
// Verificar si el usuario ha iniciado sesión
if ($usuarios !== 'on') {
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

                        $id_get = $_GET['id'];
                        $query_usuario = $pdo->prepare("SELECT u.*, r.nombre_rol
FROM tb_usuarios u
INNER JOIN tb_roles r ON u.rol_id = r.id_rol
WHERE u.id = '$id_get' AND u.estado = '1'
 ");
                        $query_usuario->execute();
                        $usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($usuarios as $usuario) {
                            $id = $usuario['id'];
                            $nombres = $usuario['nombres'];
                            $email = $usuario['email'];
                            $password_user = $usuario['password_user'];
                            $turno = $usuario['turno'];

                            $nombre_rol = $usuario['nombre_rol'];
                        }
                ?>
                <br>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <h3>¿Está seguro de eliminar el usuario?</h3>
                                    <span>Advertencia: si elimina la cuenta con la que se encuentra autenticada actualmente, el sistema lo expulsara</span>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nombres">Nombre y apellido</label>
                                        <input type="text" class="form-control" id="nombres" value="<?php echo $nombres; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo electrónico</label>
                                        <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_user">Contraseña</label>
                                        <input type="password" class="form-control" id="password_user" value="<?php echo $password_user; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="turno">Turno</label>
                                        <input type="text" class="form-control" id="turno" value="<?php echo $turno; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_user">Rol</label>
                                        <input type="text" class="form-control" id="nombre_rol" value="<?php echo $nombre_rol; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" id="btn_borrar">Eliminar</button>
                                        <a href="<?php echo $URL; ?>/usuarios/" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                    <div id="respuesta"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('../layout/admin/footer.php'); ?>
    </div>

    <?php include('../layout/admin/footer_links.php'); ?>
    <script>
    $('#btn_borrar').click(function() {
        if (confirm("Si elimina la cuenta con la que se encuentra autenticada actualmente, el sistema lo expulsara")) {
            var id = '<?php echo $id; ?>';
            var url = 'controller_delete.php';
            $.get(url, {
                id: id
            }, function(datos) {
                $('#respuesta_usuarios').html(datos);
                window.location.href = "../usuarios/index.php";
            });
        }
    });
</script>

</body>

</html>
