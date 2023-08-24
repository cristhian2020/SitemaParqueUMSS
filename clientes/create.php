<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($clientes !== 'on') {
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
                                <div class="card-header bg-primary text-white">
                                    <h3> Agregar un nuevo cliente </h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="">Nombre y apellido</label>
                                        <input type="text" class="form-control col-md-12" id="nombre_cliente" oninput="validarNombre()">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nit o Ci</label>
                                        <input type="number" pattern="[0-9]*" oninput="validateInput(this)" class="form-control col-md-12" id="nit_cliente">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Correo electrónico</label>
                                        <input type="text" class="form-control col-md-12" id="correo">
                                    </div>


                                    <div class="form-group">
                                        <label for="">Placa 1</label>
                                        <input type="text" class="form-control col-md-12" id="placa_auto" pattern="[A-Za-z0-9\-]+" onkeyup="this.value = this.value.toUpperCase()">
                                        <br />
                                        <h6><strong>Placa 2 </strong> (Opcional)</h6>
                                        <input type="text" class="form-control col-md-12" id="placa_auto_dos" pattern="[A-Za-z0-9\-]+" onkeyup="this.value = this.value.toUpperCase()">
                                    </div>
                                    <p>En caso de que el cliente comparta el espacio ingresar el nit del compañero</p>
                                    <div class="form-group">
                                        <label for="">Nit o Ci (Compartido)</label>
                                        <input type="number" pattern="[0-9]*" oninput="validateInput(this)" class="form-control col-md-12" id="nit_compartido" value = '0'>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btn_guardar"> Guardar </button>
                                        <a href="<?php echo $URL; ?>/clientes/" class="btn btn-secondary">Cancelar</a>
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
            const nombreInput = document.getElementById('nombre_cliente');
            const nitInput = document.getElementById('nit_cliente');
            const placaInput = document.getElementById('placa_auto');
            const placa2Input = document.getElementById('placa_auto_dos');
            const correoInput = document.getElementById('correo');





            nombreInput.addEventListener('input', function() {
                if (nombreInput.value.length >= 50) {
                    alert(' Nombre y apellido demasiado largo');
                }
            });
            nitInput.addEventListener('input', function() {
                if (nitInput.value.length >= 20) {
                    alert('Nit o Ci demasiado largo');
                }
            });

            placaInput.addEventListener('input', function() {
                if (placaInput.value.length >= 10) {
                    alert('Placa 1 demasiado larga');
                }
            });
            placa2Input.addEventListener('input', function() {
                if (placa2Input.value.length >= 10) {
                    alert('Placa 2 demasiado larga');
                }
            });
            correoInput.addEventListener('input', function() {
                if (correoInput.value.length >= 30) {
                    alert('Correo electrónico demasiado largo');
                }
            });

            function validarNombre() {
                const nombreInput = document.getElementById('nombre_cliente');
                // Expresión regular que permite solo letras minúsculas y mayúsculas, sin caracteres especiales ni números.
                const regex = /^[a-zA-Z\s]*$/;
                if (!regex.test(nombreInput.value)) {
                    alert('Ingrese solo letras en el campo nombre y apellido');
                    nombreInput.value = nombreInput.value.replace(/[^a-zA-Z\s]/g, '');
                }
                nombreInput.value = nombreInput.value.toUpperCase();
            }

            function validateInput(input) {
                var regex = /^[0-9]*$/; // Expresión regular para permitir solo números
                var value = input.value;

                if (!regex.test(value)) {
                    alert("Por favor, ingrese solo números en el campo Espacio.");
                    input.value = value.replace(/[^0-9]/g, ''); // Eliminar los caracteres no numéricos
                }
            }

            function validateInput(input) {
                if (input.value.trim() === '') {
                    input.value = '';
                }
            }
        </script>
        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>


    </div>

</body>

</html>


<script>
    $('#btn_guardar').click(function() {
        var nombre_cliente = $('#nombre_cliente').val();
        var nit_cliente = $('#nit_cliente').val();
        var correo = $('#correo').val();
        var placa_auto = $('#placa_auto').val();
        var placa_auto_dos = $('#placa_auto_dos').val();
        var nit_compartido = $('#nit_compartido').val();

        if (nombre_cliente == "") {
            alert('Debe llenar el campo Nombre y apellido');
            $('#nombre_cliente').focus();
        } else if (correo == "") {
            alert('Debe llenar el campo Correo electrónico');
            $('#correo').focus();
        } else if (nit_cliente == "") {
            alert('Debe llenar el campo Nit o Ci');
            $('#nit_cliente').focus();
        } else if (placa_auto == "") {
            alert('Debe llenar el campo Placa 1');
            $('#placa_auto').focus();
        } else if (placa_auto == placa_auto_dos) {
            alert('Las dos placas no pueden ser iguales');
            $('#placa_auto_dos').focus();
        } else {
            var url = 'controller_create.php';
            $.get(url, {
                nombre_cliente: nombre_cliente,
                nit_cliente: nit_cliente,
                correo: correo,
                placa_auto: placa_auto,
                placa_auto_dos: placa_auto_dos,
                nit_compartido: nit_compartido,
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });

    $('#placa_auto,#placa_auto_dos').on('input', function() {
        var value = $(this).val();
        var regex = /^[A-Za-z0-9\-]+$/;
        if (regex.test(value)) {
            $(this).removeClass('is-invalid');
        } else {
            $(this).addClass('is-invalid');
        }
    });
</script>