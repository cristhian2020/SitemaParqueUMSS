<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($guardia !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
    exit();
}

$id_reporte_g = $_GET['id'];

$query_reporte = $pdo->prepare("SELECT r.*, c.placa_auto
    FROM tb_reportes_g r
    INNER JOIN tb_clientes c ON r.cliente_id = c.id_cliente
    WHERE r.estado = '1' AND r.id_reporte_g = :id_reporte_g;");
$query_reporte->bindParam(':id_reporte_g', $id_reporte_g, PDO::PARAM_INT);
$query_reporte->execute();
$reporte = $query_reporte->fetch(PDO::FETCH_ASSOC);

if (!$reporte) {
    // Si no se encuentra el informe con el ID especificado, puedes redirigir a una página de error o realizar otra acción adecuada
    header("Location: /error.php");
    exit();
}

$placa_auto = $reporte['placa_auto'];
$descripcion = $reporte['descripcion'];
$autor = $reporte['autor'];

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
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <div class="card border-dark">
                                <div class="card-header bg-danger text-white">
                                    <h3> ¿Está seguro de eliminar este reporte? </h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="">Placa</label>
                                        <input type="text" class="form-control col-md-12" id="placa" value="<?php echo $placa_auto; ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Descripcion</label>
                                        <input type="form-text" class="form-control col-md-12" id="descripcion" value="<?php echo $descripcion; ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Autor</label>
                                        <input type="area" class="form-control col-md-12" id="autor" value="<?php echo $nombres_sesion ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" id="btn_eliminar"> Eliminar </button>
                                        <a href="<?php echo $URL; ?>/guardia/reportes.php" class="btn btn-secondary">Cancelar</a>
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
       
        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>
    </div>

    <script>
        $('#btn_eliminar').click(function () {
            var id_reporte_g = '<?php echo $id_reporte_g; ?>';
            var url = 'controller_delete.php';
            $.get(url, {id_reporte_g: id_reporte_g}, function (datos) {
                $('#respuesta').html(datos);
            });
        });
    </script>
</body>
</html>
