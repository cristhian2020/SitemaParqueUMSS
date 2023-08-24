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


                <br>
                <br>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-outline card-success">
                            <div class="card-header bg-success text-white">
                                <h3>Actualización de la información</h3>
                            </div>

                            <?php
                            $id_informacion_get = $_GET['id'];
                            $query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' AND id_informacion = '$id_informacion_get' ");
                            $query_informacions->execute();
                            $informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($informacions as $informacion) {
                                $id_informacion = $informacion['id_informacion'];
                                $nombre_parqueo = $informacion['nombre_parqueo'];
                                $actividad_empresa = $informacion['actividad_empresa'];
                                $sucursal = $informacion['sucursal'];
                                $direccion = $informacion['direccion'];
                                $zona = $informacion['zona'];
                                $telefono = $informacion['telefono'];
                                $departamento_ciudad = $informacion['departamento_ciudad'];
                                $pais = $informacion['pais'];
                            }
                            ?>

                            <div class="card-body" style="display: block;">

                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="">Nombre del parqueo <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="nombre_parqueo" value="<?php echo $nombre_parqueo; ?>" oninput="validarNombre()">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="">Actividad de la empresa <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="actividad_empresa" value="<?php echo $actividad_empresa; ?>" oninput="validarNombre()">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="">Sucursal <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="sucursal" value="<?php echo $sucursal; ?>" oninput="validarNombre()">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Dirección <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="direccion" value="<?php echo $direccion; ?>" oninput="validarNombre()">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Zona <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="zona" value="<?php echo $zona; ?>" oninput="validarNombre()">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Teléfono <span style="color: red"><b>*</b></span></label>
                                        <input type="number" class="form-control" id="telefono" value="<?php echo $telefono; ?>" >
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Departamento o ciudad <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="departamento_ciudad" value="<?php echo $departamento_ciudad; ?>" oninput="validarNombre()">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">País <span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="pais" value="<?php echo $pais; ?>" oninput="validarNombre()">
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-2">
                                        <button class="btn btn-success btn-block" id="btn_actualizar_informacion">
                                            Actualizar
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

    <script>
         const nombreInput = document.getElementById('nombre_parqueo');
            const empresaInput = document.getElementById('actividad_empresa');
            const sucursalInput = document.getElementById('sucursal');
            const direcionInput = document.getElementById('direccion');
            const zonaInput = document.getElementById('zona');
            const telfInput = document.getElementById('telefono');
            const ciudadInput = document.getElementById('departamento_ciudad');
            const paisInput = document.getElementById('pais');




            nombreInput.addEventListener('input', function() {
                if (nombreInput.value.length >= 40) {
                    alert('Nombre del parqueo demasiado largo');
                }
            });
            empresaInput.addEventListener('input', function() {
                if (empresaInput.value.length >= 40) {
                    alert('Actividad de empresa demasiado largo');
                }
            });

            sucursalInput.addEventListener('input', function() {
                if (sucursalInput.value.length >= 30) {
                    alert('sucursal demasiado largo');
                }
            });
            direcionInput.addEventListener('input', function() {
                if (direcionInput.value.length >= 40) {
                    alert('Direccion demasiado largo');
                }
            });
            zonaInput.addEventListener('input', function() {
                if (zonaInput.value.length >= 40) {
                    alert('Zona demasiado largo');
                }
            });
            telfInput.addEventListener('input', function() {
                if (telfInput.value.length >= 15) {
                    alert('telefono demasiado largo');
                }
            }); 
            paisInput.addEventListener('input', function() {
                if (paisInput.value.length >= 20) {
                    alert('Pais demasiado largo');
                }
            });
            ciudadInput.addEventListener('input', function() {
                if (ciudadInput.value.length >= 30) {
                    alert('Ciudad demasiado largo');
                }
            });
 
            function validarNombre() {
    const nombresParqueo = ['nombre_parqueo', 'actividad_empresa','zona','departamento_ciudad','pais'];
    const regex = /^[a-zA-Z\s]*$/;
    
    nombresParqueo.forEach(id => {
        const nombreInput = document.getElementById(id);
        if (!regex.test(nombreInput.value)) {
            alert('Este campo solo admite letras');
            nombreInput.value = nombreInput.value.replace(/[^a-zA-Z\s]/g, '');
        }
        nombreInput.value = nombreInput.value.toUpperCase();
    });
}

    </script>
</body>

</html>


<script>
    $('#btn_actualizar_informacion').click(function() {

        var nombre_parqueo = $('#nombre_parqueo').val().trim().toUpperCase();
        var actividad_empresa = $('#actividad_empresa').val().trim().toUpperCase();
        var sucursal = $('#sucursal').val().trim().toUpperCase();
        var direccion = $('#direccion').val().trim().toUpperCase();
        var zona = $('#zona').val().trim();
        var telefono = $('#telefono').val().trim();
        var departamento_ciudad = $('#departamento_ciudad').val().trim().toUpperCase();
        var pais = $('#pais').val().trim().toUpperCase();
        var id_informacion = '<?php echo $id_informacion_get; ?>';

        

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
            var url = 'controller_update_informaciones.php';
            $.get(url, {
                nombre_parqueo: nombre_parqueo,
                actividad_empresa: actividad_empresa,
                sucursal: sucursal,
                direccion: direccion,
                zona: zona,
                telefono: telefono,
                departamento_ciudad: departamento_ciudad,
                pais: pais,
                id_informacion: id_informacion
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>