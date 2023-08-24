<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
// Verificar si el usuario ha iniciado sesión
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

                <?php

                $id_cliente_get = $_GET['id'];
                $query_cliente = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = ? AND estado = '1'");
                $query_cliente->execute([$id_cliente_get]);
                $clientes = $query_cliente->fetchAll(PDO::FETCH_ASSOC);

                foreach ($clientes as $cliente) {
                    $id_cliente = $cliente['id_cliente'];
                    $nombre_cliente = $cliente['nombre_cliente'];
                    $nit_cliente = $cliente['nit_cliente'];
                    $correo = $cliente['correo'];
                    $placa_auto = $cliente['placa_auto'];
                    $placa_auto_dos = $cliente['placa_auto_dos'];
                }
                ?>

                <br>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-dark">
                                <div class="card-header bg-dark text-white">
                                    <h3>Asignación de sitio de parqueo</h3>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Nombre y apellido</label>
                                        <input type="text" class="form-control col-md-12" id="nombre_cliente" value="<?php echo $nombre_cliente; ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Nit o CI</label>
                                        <input type="text" class="form-control col-md-12" id="nit_cliente" value="<?php echo $nit_cliente; ?>" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Correo electrónico</label>
                                        <input type="text" class="form-control col-md-12" id="correo" value="<?php echo $correo; ?>" disabled>
                                    </div>



                                    <div class="form-group">
                                        <label for="">Placa 1</label>

                                        <input type="text" class="form-control col-md-12" id="placa_auto" value="<?php echo $placa_auto; ?>" disabled>
                                        <br />
                                        <label for="">Placa 2</label>

                                        <input type="text" class="form-control col-md-12" id="placa_auto_dos" value="<?php echo $placa_auto_dos; ?>" disabled>

                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Sitio</label>
                                                <input type="text" pattern="[0-9]*" oninput="validateInput(this)" class="form-control" id="espacio">
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form group">
                                        <label for="">Sección</label>
                                        <select name="" id="seccion" class="form-control col-md-3">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <button class="btn btn-dark" id="btn_asignar"> Asignar </button>
                                        <a href="<?php echo $URL; ?>/clientes/" class="btn btn-secondary">Cancelar</a>
                                    </div>

                                    <div id="respuesta">
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>



        </div>
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
    </div>

    </div>

</body>
<script>
    $('#btn_asignar').click(function() {
        var nombre_cliente = $('#nombre_cliente').val();
        var nit_cliente = $('#nit_cliente').val();
        var correo = $('#correo').val();
        var placa_auto = $('#placa_auto').val();
        var placa_auto_dos = $('#placa_auto_dos').val();
        //var map_id = $('#map_id').val();
        var espacio = $('#espacio').val();
        var seccion = $('#seccion').val();




        if (nombre_cliente == "") {
            alert('Debe llenar el campo nombre');
            $('#nombre_cliente').focus();
        } else if (nit_cliente == "") {
            alert('Debe llenar el campo nit o ci');
            $('#nit_cliente').focus();
        } else if (placa_auto == "") {
            alert('Debe llenar el campo placa');
            $('#placa_auto').focus();
        } else if (placa_auto == placa_auto_dos) {
            alert('Las dos placas no pueden ser iguales');
            $('#placa_auto_dos').focus();
        } else {
            var url = 'asignar_espacio_controller.php';
            $.get(url, {
                nombre_cliente: nombre_cliente,
                nit_cliente: nit_cliente,
                correo: correo,
                placa_auto: placa_auto,
                placa_auto_dos: placa_auto_dos,
                //map_id: map_id,
                espacio: espacio,
                seccion: seccion


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

    function validateInput(input) {
        var regex = /^[0-9]*$/; // Expresión regular para permitir solo números
        var value = input.value;
        
        if (!regex.test(value)) {
            alert("Por favor, ingrese solo números en el campo Espacio.");
            input.value = value.replace(/[^0-9]/g, ''); // Eliminar los caracteres no numéricos
        }
    }
</script>

</html>