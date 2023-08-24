<?php
include('../app/config.php');

?>

<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Parqueos</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="../index.php">
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
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="../anuncios/ver_anuncio.php">ANUNCIOS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../buzon/buzon.php">CONTACTANOS</a>
                </li>
            -->
                <li class="nav-item">
                    <a class="nav-link" href="../ocupados/mapeo.php">PARQUEO</a>
                </li>

            </ul>

            <!-- Button trigger modal -->
            
        </div>
    </nav>
    <br>
    


    <div class="container">
        <h1>SECCION "A"</h1>
        <br>
        <div class="row">
            <?php
            $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1'AND seccion = 'A' ");
            $query_mapeos->execute();
            $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($mapeos as $mapeo) {
                $id_map = $mapeo['id_map'];
                $cuviculo = $mapeo['cuviculo'];
                $estado_espacio = $mapeo['estado_espacio'];
                if ($estado_espacio == "LIBRE") {  ?>
                    <div class="col">
                        <center>
                            <h2><?php echo $cuviculo; ?></h2>
                            <button class="btn btn-success" style="width: 100%; height: 140px;">

                                <p><?php echo $estado_espacio; ?></p>

                            </button>


                        </center>

                    </div>

                <?php

                }
                if ($estado_espacio == "OCUPADO") {  ?>
                    <div class="col">
                        <center>
                            <h2><?php echo $cuviculo; ?></h2>
                            <button class="btn btn-warning">
                                <img src="<?php echo $URL; ?>/public/imagenes/auto1.png" width="60px" alt="">
                            </button>
                            <p><?php echo $estado_espacio; ?></p>

                        </center>

                    </div>

                <?php

                }


                ?>

            <?php
            }
            ?>



        </div>





        <h1>SECCION "B"</h1>

        <div class="row">
            <?php
            $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1'AND seccion = 'B' ");
            $query_mapeos->execute();
            $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
            foreach ($mapeos as $mapeo) {
                $id_map = $mapeo['id_map'];
                $cuviculo = $mapeo['cuviculo'];
                $estado_espacio = $mapeo['estado_espacio'];
                if ($estado_espacio == "LIBRE") {  ?>
                    <div class="col">
                        <center>
                            <h2><?php echo $cuviculo; ?></h2>
                            <button class="btn btn-success" style="width: 100%; height: 140px;">

                                <p><?php echo $estado_espacio; ?></p>

                            </button>


                        </center>

                    </div>

                <?php

                }
                if ($estado_espacio == "OCUPADO") {  ?>
                    <div class="col">
                        <center>
                            <h2><?php echo $cuviculo; ?></h2>
                            <button class="btn btn-warning">
                                <img src="<?php echo $URL; ?>/public/imagenes/auto1.png" width="60px" alt="">
                            </button>
                            <p><?php echo $estado_espacio; ?></p>

                        </center>

                    </div>

                <?php

                }


                ?>

            <?php
            }
            ?>



        </div>



    </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Inicio de sesion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Correo electronico</label>
                                <input type="email" id="usuario" class="form-control">

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <input type="password" id="password" class="form-control">

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

    <script src="public/js/jquery-3.5.1.min.js"></script>
    <script src="public/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="public/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>



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
            alert("deve introducir un usuario");
            $('#usuario').focus();
        } else if (password_user == "") {
            alert("intrdusca la contraceña...");
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