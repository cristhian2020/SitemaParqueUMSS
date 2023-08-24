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
                                    <h3> Agregar clientes  </h3>
                                </div>
                                <div class="card-body">


                                    <form action="importar.php" method="POST" enctype="multipart/form-data">
                                        <div class="file-input text-center">
                                            <input type="file" name="dataCliente" id="file-input" class="form-control-file" />
                                            <label class="file-input__label" for="file-input">
                                                <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
                                                <br>
                                                <span>Elegir Archivo Excel en formato CSV(separado por comas)</span></label>
                                        </div>
                                        <div class=" mt-5">
                                            <input type="submit" name="subir" class="btn-enviar btn btn-info" value="Subir Excel" />
                                        </div>
                                    </form>








                                    <div id="respuesta">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
                <?php
                $contador_cliente = 0;
                $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1'");
                $query_clientes->execute();
                $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                foreach ($datos_clientes as $datos_cliente) {
                    $contador_cliente = $contador_cliente + 1;
                    $nombre_cliente = $datos_cliente['nombre_cliente'];
                    $nit_cliente = $datos_cliente['nit_cliente'];
                    $correo = $datos_cliente['correo'];
                    $placa_auto = $datos_cliente['placa_auto'];
                    $placa_auto_dos = $datos_cliente['placa_auto_dos'];
                    $nit_compartido = $datos_cliente['nit_compartido'];
                    $id_cliente = $datos_cliente['id_cliente'];
                }
                ?>


            </div>
        </div>



        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>


    </div>

</body>

</html>