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

    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini">
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #003785;">
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
                <li class="nav-item">
                    <a class="nav-link" href="../anuncios/ver_anuncio.php">ANUNCIOS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../buzon/buzon.php">CONTACTANOS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../pagos/pagos.php">PAGOS</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../parqueo/index.php">ESPACIOS PARQUEO</a>
                </li>

            </ul>


        </div>
    </nav>
    <style>
      

        .info-anuncio {
        color: #005187;
        font-size: 25px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Media query para pantallas más pequeñas */
    @media (max-width: 768px) {
        .info-anuncio {
            text-align: right;
            font-size: 20px;
        }
    }
    </style>
    
    <div class="wrapper">

        <div class="content-wrapper">
            <br>
            <div class="container">


                <br>

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nit_cliente">Nit o Ci <span style="color: red"><b>*</b></span></label>
                                        <input type="number" pattern="[0-9]*" oninput="validateInput(this)" class="form-control" id="nit_cliente">
                                    </div>

                                    <div class="form-group">
                                        <label for="asunto">Asunto <span style="color: red"><b>*</b></span></label>
                                        <select name="asunto" id="asunto" class="form-control">
                                            <option value="OTRO">OTRO</option>
                                            <option value="SOLICITUD">SOLICITUD</option>
                                            <option value="RECLAMO">RECLAMO</option>
                                            <option value="ESPACIO COMPARTIDO">ESPACIO COMPARTIDO</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="descripcion">Descripción <span style="color: red"><b>*</b></span></label>
                                        <textarea name="descripcion" id="descripcion" rows="7" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btn_enviar">Enviar</button>
                                        <a href="<?php echo $URL; ?>/index.php" class="btn btn-secondary">Cancelar</a>
                                    </div>

                                    <div id="respuesta"></div>
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-md-6">

                            <h5 class="info-anuncio float-sm-start">
                                
                                ¡Bienvenido a nuestras solicitudes! 

                                Aquí puedes hacer tus solicitudes de forma fácil y rápida. Estamos listos para ayudarte en lo que necesites. <br>

                                Completa el formulario con los detalles necesarios y te responderemos lo más pronto posible.
                                

                                Gracias por elegirnos.

                                Equipo de Atención al Cliente
                            </h5>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <script>
        const correoDescripcion = document.getElementById('descripcion');
        const nit_cliente = document.getElementById('nit_cliente');





        nit_cliente.addEventListener('input', function() {
            if (nit_cliente.value.length >= 20) {
                alert('Nit - Ci demasiado largo');
            }
        });

        correoDescripcion.addEventListener('input', function() {
            if (correoDescripcion.value.length >= 300) {
                alert('Descripcion demasiado larga');
            }
        });
    </script>
    <style>
        footer {
            background-color: #003785;
            color: #ffffff;
            padding: 10px;
            position: relative;
            width: 100%;
        }

        /* Media query para dispositivos con un ancho máximo de 768px */
        @media (max-width: 768px) {
            footer {
                position: static;
                /* Ajuste para que el footer tenga una posición estática en dispositivos móviles */
            }
        }
    </style>

    <footer class="fixed-bottom">
        <div class="container-fluid">
            <?php include('../layout/admin/footer.php'); ?>
        </div>
    </footer>

</body>

</html>

<script>
    $('#btn_enviar').click(function() {

        var nit_cliente = $('#nit_cliente').val();
        var asunto = $('#asunto').val();
        var descripcion = $('#descripcion').val();

        if (nit_cliente == "") {
            alert('Debe llenar el campo Nit o Ci');
            $('#nit_cliente').focus();
        } else if (asunto == "") {
            alert('Debe seleccionar el campo asunto');
            $('#asunto').focus();
        } else if (descripcion == "") {
            alert('Debe llenar el campo descripción ');
            $('#descripcion').focus();
        } else {
            var url = 'controller_buzon.php';
            $.get(url, {
                nit_cliente: nit_cliente,
                asunto: asunto,
                descripcion: descripcion
            }, function(datos) {
                $('#respuesta').html(datos);

                //alert("Su mensaje ha sido recibido");
            });
        }
    });
</script>