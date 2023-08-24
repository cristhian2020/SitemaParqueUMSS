<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($roles !== 'on') {
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
                <div class="container">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h3> Agregar un nuevo rol </h3>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="">Nombre </label>
                                        <input type="text" class="form-control" id="nombre_rol" oninput="validarNombre()">
                                    </div>
                                    <!--
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="principal">
                                        <label class="form-check-label" for="exampleCheck1">principal</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="principal2">
                                        <label class="form-check-label" for="exampleCheck1">principal2</label>
                                    </div>
-->
                                    <!-- Button trigger modal -->
                                  

                                    <!-- Modal -->
                                    
                                    <p>Selecciona los modulos que quieres asignar al rol</p>                                                        
                                   
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="usuarios">
                                        <label class="form-check-label" for="exampleCheck1">Usuarios</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="roles">
                                        <label class="form-check-label" for="exampleCheck1">Roles</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="parqueo">
                                        <label class="form-check-label" for="exampleCheck1">Parqueo</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="clientes">
                                        <label class="form-check-label" for="exampleCheck1">Clientes</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="recibos">
                                        <label class="form-check-label" for="exampleCheck1">Recibos</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="pagos">
                                        <label class="form-check-label" for="exampleCheck1">Pagos</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="anuncios">
                                        <label class="form-check-label" for="exampleCheck1">Anuncios</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="guardia">
                                        <label class="form-check-label" for="exampleCheck1">Guardia</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="buzon">
                                        <label class="form-check-label" for="exampleCheck1">Buzon</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="fecha">
                                        <label class="form-check-label" for="exampleCheck1">Fechas</label>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btn_guardar"> Guardar </button>
                                        <a href="<?php echo $URL; ?>/roles/" class="btn btn-secondary">Cancelar</a>
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
            const nombreInput = document.getElementById('nombre_rol');


            nombreInput.addEventListener('input', function() {
                if (nombreInput.value.length > 30) {
                    alert('Nombre demasiado largo');
                }
            });

            function validarNombre() {
                const nombreInput = document.getElementById('nombre_rol');
                // Expresión regular que permite solo letras minúsculas y mayúsculas, sin caracteres especiales ni números.
                const regex = /^[a-zA-Z\s]*$/;
                if (!regex.test(nombreInput.value)) {
                    alert('Ingrese solo letras al campo Nombre ');
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
        var nombre_rol = $('#nombre_rol').val();

        var principal = $('#principal').prop('checked') ? 'on' : 'off';
        var principal2 = $('#principal2').prop('checked') ? 'on' : 'off';
        var usuarios = $('#usuarios').prop('checked') ? 'on' : 'off';
        var roles = $('#roles').prop('checked') ? 'on' : 'off';
        var parqueo = $('#parqueo').prop('checked') ? 'on' : 'off';
        var clientes = $('#clientes').prop('checked') ? 'on' : 'off';
        var recibos = $('#recibos').prop('checked') ? 'on' : 'off';
        var pagos = $('#pagos').prop('checked') ? 'on' : 'off';
        var anuncios = $('#anuncios').prop('checked') ? 'on' : 'off';
        var guardia = $('#guardia').prop('checked') ? 'on' : 'off';
        var buzon = $('#buzon').prop('checked') ? 'on' : 'off';
        var fecha = $('#fecha').prop('checked') ? 'on' : 'off';



        if (nombre_rol == "") {
            alert('Debe de llenar el campo nombre');
            $('#nombre_rol').focus();
        } else {
            var url = 'controller_create.php';
            $.get(url, {
                nombre_rol: nombre_rol,
                principal: principal,
                principal2: principal2,
                usuarios: usuarios,
                roles: roles,
                parqueo: parqueo,
                clientes: clientes,
                recibos: recibos,
                pagos: pagos,
                anuncios: anuncios,
                guardia: guardia,
                buzon: buzon,
                fecha: fecha

            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>