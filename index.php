<?php include('app/config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>FCyT</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #003785;  ">
        <a class="navbar-brand" href="#">
            <h1 href="index.php" width="20" height="30">
                <img src="<?php echo $URL; ?>/public/imagenes/saga.png" width="70" height="80" alt="" loading="lazy">
                FCyT
            </h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="anuncios/ver_anuncio.php">ANUNCIOS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="buzon/buzon.php">CONTACTANOS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="pagos/pagos.php">PAGOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="parqueo/index.php">ESPACIOS PARQUEO</a>
                </li>
            </ul>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                Ingresar
            </button>
        </div>
    </nav>

    <br>
    <br>

    <style>
        body {
            background-image: url('public/imagenes/campus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        /* Media query para dispositivos con un ancho máximo de 768px */
        @media (max-width: 768px) {
            body {
                background-size: cover;
                /* Ajuste para mantener el tamaño de fondo en dispositivos móviles */
                background-position: top;
                /* Ajuste para posicionar el fondo en la parte superior en dispositivos móviles */
            }
        }
    </style>




    <div class="container">
        <br>
        <br>
        <br>
        <center>
            <style>
                h2 {
                    color: #dfdfdf;
                    font-size: 50px;
                    /* Tamaño de fuente base para pantallas grandes */
                    text-align: center;
                }

                @media (max-width: 768px) {
                    h2 {
                        font-size: 20px;
                        margin-top: 5px;
                        /* Tamaño de fuente reducido para pantallas más pequeñas */
                    }
                }

                h4 {
                    color: #dfdfdf;
                    font-size: 30px;
                    text-align: center;
                    margin-top: 50px;
                }

                /* Media query para pantallas más pequeñas */
                @media (max-width: 768px) {
                    h4 {
                        font-size: 20px;
                        margin-top: 20px;
                        /* Ajuste el margen superior para dispositivos móviles */
                    }
                }
            </style>

            <h2>

                ¡Bienvenido al Parqueo de la FCyT - UMSS! Tu lugar seguro y conveniente para estacionar en la Facultad de Ciencias y Tecnología. ¡Disfruta tu estancia!
            </h2>

            <h4>Nos complace darte la más cordial bienvenida a nuestro parqueo, un espacio diseñado para brindarte comodidad, seguridad y tranquilidad mientras disfrutas de tus actividades en la Facultad de Ciencias y Tecnología.</h4>

        </center>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inicio de sesión</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body  ">
                    <center>
                        <img src="<?php echo $URL; ?>/public/imagenes/umssimagen.jpeg" width="200px" height="" alt=""> <br><br>
                    </center>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Correo electrónico</label>
                                <input type="email" id="usuario" class="form-control">

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <div class="input-group">

                                    <input type="password" id="password" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="show-password" onclick="mostrarContrasena()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
  <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
  <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
  <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
</svg></button>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div id="respuesta">

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn_ingresar">Ingresar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </div>
    </div>



    <script>
        function mostrarContrasena() {
        var x = document.getElementById("password");
        var btn = document.getElementById("show-password");
        if (x.type === "password") {
            x.type = "text";
           // btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            x.type = "password";
            //btn.innerHTML = '<i class="bi bi-eye"></i>';
        }
    }
    </script>


    <script src="public/js/jquery-3.5.1.min.js"></script>
    <script src="public/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


    <style>
        footer {
            background-color: #003785;
            color: #ffffff;
            padding: 10px;
            position: relative;
            width: 100%;
            margin-top: 20px;
        }
    </style>



    <footer class="fixed-bottom">
        <div class="container-fluid">
            <?php include('layout/admin/footer.php'); ?>
        </div>
    </footer>
</body>

</html>



<script>
    $('#btn_ingresar').click(function() {
        login();
    });

    $('#password').keypress(function(e) {
        if (e.which == 13) {
            login();
        }
    });

    function login() {

        var usuario = $('#usuario').val();
        var password_user = $('#password').val();
        if (usuario == "") {
            alert("Introduzca un correo electrónico");
            $('#usuario').focus();
        } else if (password_user == "") {
            alert("Introduzca una contraseña");
            $('#password').focus();
        } else {
            var url = 'login/controller_login.php'
            $.post(url, {
                usuario: usuario,
                password_user: password_user
            }, function(datos) {
                $('#respuesta').html(datos);
            });
        }

    }
</script>