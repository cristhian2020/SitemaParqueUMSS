<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($usuarios !== 'on') {
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
                            <div class="card border-dark">
                                <div class="card-header bg-primary text-white">
                                    <h3>Agregar un nuevo usuario</h3>
                                </div>
                                <div class="card-body">
                                    <form id="formulario">
                                        <div class="form-group">
                                            <label for="nombres">Nombre y apellido</label>
                                            <input type="text" class="form-control" id="nombres" oninput="validarNombre()">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Correo electrónico</label>
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_user">Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password_user">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button" id="show-password" onclick="mostrarContrasena()">Mostrar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="turno">Turno</label>
                                            <select class="form-control" id="turno">
                                                <option value=""></option>
                                                <option value="MAÑANA">MAÑANA</option>
                                                <option value="TARDE">TARDE</option>
                                                <option value="NOCHE">NOCHE</option>
                                            </select>
                                        </div>

                                        <p> <b>Rol</b> </p>



                                        <select name="rol" id="rol_select" class="form-control">
                                            <?php
                                            $query_roles = $pdo->prepare("SELECT * FROM tb_roles WHERE estado = '1' ");
                                            $query_roles->execute();
                                            $roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($roles as $role) {
                                                $rol_id = $role['rol_id'];
                                                $nombre = $role['nombre_rol'];
                                            ?>
                                                <option value="<?php echo $rol_id; ?>"><?php echo $nombre; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <br>

                                        <div class="form-group d-none">
                                            <label for="email">Rol</label>
                                            <input type="text" class="form-control" id="nombre_rol" readonly>
                                        </div>


                                        <script>
                                            const nombreInput = document.getElementById('nombres');
                                           
                                           
                                            const correoInput = document.getElementById('email');





                                            nombreInput.addEventListener('input', function() {
                                                if (nombreInput.value.length >= 50) {
                                                    alert(' Nombre y apellido demasiado largo');
                                                }
                                            });
                                           
                
                                            correoInput.addEventListener('input', function() {
                                                if (correoInput.value.length >= 60) {
                                                    alert('Correo electrónico demasiado largo');
                                                }
                                            });

                                            function validarNombre() {
                                                const nombreInput = document.getElementById('nombres');
                                                // Expresión regular que permite solo letras minúsculas y mayúsculas, sin caracteres especiales ni números.
                                                const regex = /^[a-zA-Z\s]*$/;
                                                if (!regex.test(nombreInput.value)) {
                                                    alert('Ingrese solo letras en el campo nombre y apellido');
                                                    nombreInput.value = nombreInput.value.replace(/[^a-zA-Z\s]/g, '');
                                                }
                                                nombreInput.value = nombreInput.value.toUpperCase();
                                            }

                                         
                                            $(document).ready(function() {
                                                // Obtener el valor seleccionado del select al cargar la página
                                                var selectedRol = $("#rol_select option:selected").text();

                                                // Asignar el valor al campo de texto y bloquearlo
                                                $("#nombre_rol").val(selectedRol).prop("readonly", true);

                                                // Controlador de evento para actualizar el campo de texto cuando se cambia la opción seleccionada
                                                $("#rol_select").change(function() {
                                                    var selectedRol = $("#rol_select option:selected").text();
                                                    $("#nombre_rol").val(selectedRol);
                                                });
                                            });

                                            function validarNombre() {
                                                const nombreInput = document.getElementById('nombres');
                                                // Expresión regular que permite solo letras minúsculas y mayúsculas, sin caracteres especiales ni números.
                                                const regex = /^[a-zA-Z\s]*$/;
                                                if (!regex.test(nombreInput.value)) {
                                                    alert('Ingrese solo letras al campo Nombre y apellido');
                                                    nombreInput.value = nombreInput.value.replace(/[^a-zA-Z\s]/g, '');
                                                }
                                                nombreInput.value = nombreInput.value.toUpperCase();
                                            }

                                            function mostrarContrasena() {
                                                var x = document.getElementById("password_user");
                                                var btn = document.getElementById("show-password");
                                                if (x.type === "password") {
                                                    x.type = "text";
                                                    btn.innerHTML = "Ocultar";
                                                } else {
                                                    x.type = "password";
                                                    btn.innerHTML = "Mostrar";
                                                }
                                            }

                                            $(document).ready(function() {
                                                $('#formulario').submit(function(e) {
                                                    e.preventDefault(); // Evitar el envío del formulario por defecto

                                                    var nombres = $('#nombres').val();
                                                    var email = $('#email').val();
                                                    var password_user = $('#password_user').val();
                                                    var turno = $('#turno').val();
                                                    var nombre_rol = $('#nombre_rol').val();

                                                    if (nombres === "") {
                                                        alert('Debe llenar el campo Nombre y apellido');
                                                        $('#nombres').focus();
                                                        return;
                                                    } else if (email === "") {
                                                        alert('Debe llenar el campo Correo electrónico');
                                                        $('#email').focus();
                                                        return;
                                                    } else if (password_user === "") {
                                                        alert('Debe llenar el campo Contraseña');
                                                        $('#password_user').focus();
                                                        return;
                                                    } else if (turno === "") {
                                                        alert('Debe llenar el campo turno');
                                                        $('#turno').focus();
                                                        return;
                                                    } else if (nombre_rol === "") {
                                                        alert('Debe llenar el campo Rol');
                                                        $('#nombre_rol').focus();
                                                        return;
                                                    }

                                                    var url = 'controller_create.php';
                                                    $.ajax({
                                                        type: 'GET',
                                                        url: url,
                                                        data: {
                                                            nombres: nombres,
                                                            email: email,
                                                            password_user: password_user,
                                                            turno: turno,
                                                            nombre_rol: nombre_rol,
                                                        },
                                                        success: function(response) {
                                                            $('#respuesta').html(response);
                                                        }
                                                    });
                                                });
                                            });
                                        </script>

                                        <br>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" id="btn_guardar">Guardar</button>
                                            <a href="<?php echo $URL; ?>/usuarios/" class="btn btn-secondary">Cancelar</a>
                                        </div>
                                    </form>
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
        <?php include('../layout/admin/footer_links.php'); ?>


    </div>

</body>

</html>