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

    <style>
        body {
            background: linear-gradient(to bottom right, #ffff, #003785);
        }
    </style>
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
            color: #FFFF;
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

                <h1 style="color:black;">Espacios parqueo "A"</h1>
                <br>
                <img src="../public/imagenes/auto2.png" width="100px" class="img-fluid" alt="Responsive image">

                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-center">
                            <a href="./index.php" class="btn btn-dark" style="background-color: #9fa3a9; margin-right: 10px;">
                                <img src="../public/imagenes/flechaAtras.png" width="30px" alt="">
                            </a>
                            <a href="./index2.php" class="btn btn-dark" style="background-color: #9fa3a9;">
                                <img src="../public/imagenes/flechaAdelante.png" width="30px" alt="">
                            </a>
                        </div>
                        <br>
                        <div class="table-responsive">

                            <table class="table table-bordered table-sm ">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">Espacio</th>

                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Situación</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    $query_mapeos = $pdo->prepare("SELECT id_map, espacio, estado_espacio FROM tb_mapeos WHERE seccion = 'A' AND estado = '1'");
                                    $query_mapeos->execute();
                                    $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($mapeos as $mapeo) {
                                        $id_map = $mapeo['id_map'];
                                        $espacio = $mapeo['espacio'];
                                        $estado_espacio = $mapeo['estado_espacio'];

                                        // Obtener el cliente asociado a este espacio
                                        $query_cliente = $pdo->prepare("SELECT nombre_cliente FROM tb_clientes WHERE map_id = :map_id");
                                        $query_cliente->bindParam(':map_id', $id_map);
                                        $query_cliente->execute();
                                        $cliente = $query_cliente->fetch(PDO::FETCH_ASSOC);

                                        if ($cliente && $cliente['nombre_cliente']) {
                                            // Si se encontró un cliente y el nombre no es nulo
                                            $estado = 'Ocupado';
                                            $eliminar_permitido = false; // Bandera para permitir o denegar la eliminación
                                            $checkbox_disabled = 'disabled'; // Deshabilitar el checkbox
                                        } else {
                                            // Si no se encontró un cliente o el nombre es nulo
                                            $estado = 'Disponible';
                                            $eliminar_permitido = true; // Permitir la eliminación ya que no hay cliente asignado
                                            $checkbox_disabled = ''; // Mantener el checkbox habilitado
                                        }

                                    ?>
                                        <tr style="background-color: #ffffff;">
                                            <td>
                                                <center><?php echo $espacio; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $estado_espacio; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $estado; ?></center>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>


                            </table>

                        </div>

                    </div>
                    <div class="col-md-6">

                        <h5 class="info-anuncio float-sm-start">

                            ¡Descubre nuestros espacios disponibles en la sección "A" del estacionamiento! <br>

                            Encuentra el lugar perfecto para estacionar tu vehículo en nuestra sección dedicada. Disponemos de una amplia variedad de opciones para satisfacer tus necesidades. ¡Reserva ahora y asegura tu espacio!

                            Equipo del Parqueo
                        </h5>
                        <img src="../public/imagenes/IMG20230609090354.jpg" class="img-fluid" alt="">
                        <br>
                        <br>
                    </div>
                    <br>
                    <br>
                </div>
                <br>
                <br>
            </div>

            <br>
            <br>

        </div>
        <br>
        <br>
    </div>

    <br>
    <br>
    </div>

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