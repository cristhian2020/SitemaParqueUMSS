<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($roles !== 'on') {
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
            $id_rol = $_GET['id'];
            $query_roles = $pdo->prepare("SELECT * FROM tb_roles WHERE id_rol = '$id_rol' AND estado = '1' ");
            $query_roles->execute();
            $roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);
            foreach($roles as $role){
                $id_rol = $role['id_rol'];
                $nombre_rol = $role['nombre_rol'];
            }
            ?>
            <br>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                                <div class="card-header bg-danger text-white">
                                        <h3>¿Esta seguro de eliminar el rol?</h3>
                                </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Rol</label>
                                    <input type="text" class="form-control" id="nombre" value="<?php echo $nombre_rol; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-danger" id="btn_borrar">Eliminar</button>
                                    <a href="<?php echo $URL;?>/roles/index.php" class="btn btn-secondary">Cancelar</a>
                                </div>
                                <div id="respuesta">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
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



<script>
    $('#btn_borrar').click(function () {

        var id_rol = '<?php echo $id_rol; ?>';

            var url = 'controller_delete.php';
            $.get(url,{id_rol:id_rol},function (datos) {
                $('#respuesta').html(datos);
            });

    });
</script>
