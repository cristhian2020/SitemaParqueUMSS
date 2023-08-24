<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');


if ($parqueo !== 'on') {
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

                <br>
                <br>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">

                            <div class="card-header bg-primary text-white">
                                <h3>Agregar un nuevo sitio</h3>
                            </div>
                            <div class="card-body">
                                <p>Seleccione la sección donde desee agregar el sitio </p>
                                <div class="form-group">
                                    <label for="">Sección</label>
                                    <select name="seccion" id="seccion" class="form-control col-md-3">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div>
                                <br>
                                <div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button class="btn btn-primary btn-block" id="btn_registrar">Guardar</button>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="../parqueo/mapeo-de-vehiculos.php" class="btn btn-secondary btn-block">Cancelar</a>
                                        </div>
                                        <br>
                                    </div>
                                    <div id="respuesta"></div>
                                </div>
                            </div>
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
    $('#btn_registrar').click(function() {
        var seccion = $('#seccion').val();
        var estado_espacio = 'LIBRE';

        var url = 'controller_create.php';
        $.get(url, {
            seccion: seccion,
            estado_espacio: estado_espacio
        }, function(datos) {
            $('#respuesta').html(datos);
        });
    });
</script>