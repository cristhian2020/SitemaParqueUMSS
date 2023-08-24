<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($recibos !== 'on') {
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
                $contador = 0;
                $query_fechas = $pdo->prepare("SELECT * FROM tb_fechas_limite ");
                $query_fechas->execute();
                $fechas = $query_fechas->fetchAll(PDO::FETCH_ASSOC);

                foreach ($fechas as $fecha) {

                    $id_fecha = $fecha['id_fecha'];

                    $fecha_limite_asignacion = $fecha['fecha_limite_asignacion'];
                    $fecha_limite_pago = $fecha['fecha_limite_pago'];
                ?>

                <?php
                }
                ?>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <div class="card border-dark">
                                <div class="card-header bg-danger text-white">
                                    <h3> Eliminar precio </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Fecha asignacion</label>
                                        <input type="int" class="form-control col-md-6" id="fecha_limite_asignacion" pattern="[0-9]*" inputmode="numeric" value="<?php echo $fecha_limite_asignacion ?> " disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Fecha pago</label>
                                        <input type="int" class="form-control col-md-6" id="fecha_limite_pago" pattern="[0-9]*" inputmode="numeric" value="<?php echo $fecha_limite_pago ?> " disabled>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                        <button class="btn btn-danger" id="btn_borrar"> Eliminar </button>
                                        <a href="<?php echo $URL; ?>../fechas/create.php" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                    <div id="respuesta"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>
    </div>
</body>

</html>

<script>
    $('#btn_borrar').click(function () {

        var id_fecha = '<?php echo $id_fecha; ?>';

        var url = 'controller_delete.php';
        $.get(url, { id_fecha: id_fecha }, function (datos) {
            $('#respuesta').html(datos);
        });

    });
</script>
