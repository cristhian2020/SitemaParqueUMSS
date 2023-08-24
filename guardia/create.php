<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
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
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <div class="card border-dark">
                                <div class="card-header bg-primary">
                                    <h3 class="text-white">Agregar un reporte</h3>
                                </div>

                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="">Placa</label>
                                        <input type="text" class="form-control col-md-4" id="placa" pattern="[A-Za-z0-9\-]+" onkeyup="this.value = this.value.toUpperCase()">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Descripcion</label>
                                        <input type="form-text" class="form-control col-md-12" id="descripcion">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Autor</label>
                                        <input type="area" class="form-control col-md-12" id="autor" value="<?php echo $nombres_sesion ?>" disabled>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btn_guardar"> Guardar </button>
                                        <a href="<?php echo $URL; ?>/guardia/" class="btn btn-secondary">Cancelar</a>
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
        <script>
         
            const placaInput = document.getElementById('placa');
            const descripcionInput = document.getElementById('descripcion');

          
            placaInput.addEventListener('input', function() {
                if (placaInput.value.length > 10) {
                    alert('Placa demasiado larga');
                }
            });
            descripcionInput.addEventListener('input', function() {
                if (descripcionInput.value.length >300) {
                    alert('Descripción demasiado larga');
                }
            });
          
          
          

            function validarNombre() {
                const nombreInput = document.getElementById('nombre_cliente');
                // Expresión regular que permite solo letras minúsculas y mayúsculas, sin caracteres especiales ni números.
                const regex = /^[a-zA-Z\s]*$/;
                if (!regex.test(nombreInput.value)) {
                    alert('Ingrese solo letras en el campo nombre');
                    nombreInput.value = nombreInput.value.replace(/[^a-zA-Z\s]/g, '');
                }
                nombreInput.value = nombreInput.value.toUpperCase();
            }
        </script>
        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>


    </div>

</body>

</html>


<script>

    $('#btn_guardar').click(function() {
        var placa = $('#placa').val();
        var descripcion = $('#descripcion').val();
        var autor = $('#autor').val();


        if (placa == "") {
            alert('Debe llenar el campo Placa');
            $('#placa').focus();
        } else if (descripcion == "") {
            alert('Debe llenar el campo Descripción');
            $('#descripcion').focus();
        } else if (autor == "") {
            alert('Debe llenar el campo Autor');
            $('#autor').focus();
        } else {
            var url = 'controller_create.php';
            $.get(url, {
                placa: placa,
                descripcion: descripcion,
                autor: autor,

            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });

    $('#placa').on('input', function() {
        var value = $(this).val();
        var regex = /^[A-Za-z0-9\-]+$/;
        if (regex.test(value)) {
            $(this).removeClass('is-invalid');
        } else {
            $(this).addClass('is-invalid');
        }
    });
</script>