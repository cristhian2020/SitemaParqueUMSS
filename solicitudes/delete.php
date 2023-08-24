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
                <?php
                $id_solicitud_get = $_GET['id_solicitud'];
                $query_solicitud = $pdo->prepare("SELECT s.id_solicitud, c.nombre_cliente, c.correo, s.descripcion
                                                FROM tb_solicitudes s
                                                INNER JOIN tb_clientes c ON s.cliente_id = c.id_cliente
                                                WHERE s.id_solicitud = '$id_solicitud_get' AND s.estado = '1'");
                $query_solicitud->execute();
                $solicitudes = $query_solicitud->fetchAll(PDO::FETCH_ASSOC);

                foreach ($solicitudes as $solicitud) {
                    $id_solicitud = $solicitud['id_solicitud'];
                    $nombres = $solicitud['nombre_cliente'];
                    $email = $solicitud['correo'];
                    $descripcion = $solicitud['descripcion'];
                }
                ?>

                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">¿Estás seguro de eliminar este mensaje?</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Nombre y apellido</label>
                                        <input type="text" class="form-control" id="nombre" value="<?php echo $nombres; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Correo electrónico</label>
                                        <input type="text" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Descripción</label>
                                        <input type="text" class="form-control" id="descripcion" value="<?php echo $descripcion; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" id="btn_borrar">Eliminar</button>
                                        <a href="<?php echo $URL; ?>/solicitudes/index_solicitud.php" class="btn btn-secondary">Cancelar</a>
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
</body>
</html>

<script>
    $('#btn_borrar').click(function () {
        var id_solicitud = '<?php echo $id_solicitud = $_GET['id_solicitud']; ?>';
        var url = 'controller_delete.php';
        $.get(url, { id_solicitud: id_solicitud }, function (datos) {
            $('#respuesta').html(datos);
        });
    });
</script>
