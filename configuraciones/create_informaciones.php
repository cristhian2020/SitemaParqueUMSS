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
                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <br>
                        <div class="card card-outline card-primary">
                            <div class="card-header bg-primary text-white">
                                <h3> Agregar una nueva información </h3>
                            </div>

                            <div class="card-body" style="display: block;">

                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Nombre del parqueo <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="nombre_parqueo">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Actividad de la empresa <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="actividad_empresa">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Sucursal <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="sucursal">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Dirección <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="direccion">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Zona <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="zona">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Teléfono <span style="color: red"><b>*</b></span></label>
                                        <input type="number" class="form-control" id="telefono">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Departamento o ciudad <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="departamento_ciudad">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">País <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="pais">
                                    </div>
                                </div>

                                <br>

                                <div class="row">

                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-block" id="btn_registrar_informacion">
                                            Guardar
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="informaciones.php" class="btn btn-secondary btn-block">Cancelar</a>
                                    </div>

                                </div>
                                <div id="respuesta">

                                </div>


                            </div>

                        </div>



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
    $('#btn_registrar_informacion').click(function() {

        var nombre_parqueo = $('#nombre_parqueo').val();
        var actividad_empresa = $('#actividad_empresa').val();
        var sucursal = $('#sucursal').val();
        var direccion = $('#direccion').val();
        var zona = $('#zona').val();
        var telefono = $('#telefono').val();
        var departamento_ciudad = $('#departamento_ciudad').val();
        var pais = $('#pais').val();

        if (nombre_parqueo == "") {
            alert('Debe de llenar el campo nombre del parqueo');
            $('#nombre_parqueo').focus();
        } else if (actividad_empresa == "") {
            alert('Debe de llenar el campo actividad de la empresa');
            $('#actividad_empresa').focus();
        } else if (sucursal == "") {
            alert('Debe de llenar el campo sucursal');
            $('#sucursal').focus();
        } else if (direccion == "") {
            alert('Debe de llenar el campo dirección');
            $('#direccion').focus();
        } else if (zona == "") {
            alert('Debe de llenar el campo zona');
            $('#zona').focus();
        } else if (telefono == "") {
            alert('Debe de llenar el campo telefono');
            $('#telefono').focus();
        } else if (departamento_ciudad == "") {
            alert('Debe de llenar el campo departamento o ciudad');
            $('#departamento_ciudad').focus();
        } else if (pais == "") {
            alert('Debe de llenar el campo país');
            $('#pais').focus();
        } else {
            //alert("esta listo para el controlador");
            var url = 'controller_create_informaciones.php';
            $.get(url, {
                nombre_parqueo: nombre_parqueo,
                actividad_empresa: actividad_empresa,
                sucursal: sucursal,
                direccion: direccion,
                zona: zona,
                telefono: telefono,
                departamento_ciudad: departamento_ciudad,
                pais: pais
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>