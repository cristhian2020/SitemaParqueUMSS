<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($recibos !== 'on') {
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
                $id_precio = $_GET['id'];
                $query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE id_precio = '$id_precio' AND estado = '1'");
                $query_precios->execute();
                $precios = $query_precios->fetchAll(PDO::FETCH_ASSOC);

                foreach ($precios as $precio) {
                    $id_precio = $precio['id_precio'];
                    $precio = $precio['precio'];

                    
                ?>

                <?php
                }
                ?>
                <br>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <div class="card border-dark">
                                <div class="card-header bg-danger text-white">
                                    <h3> Eliminar precio </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Precio</label>
                                        <input type="text" class="form-control col-md-12" id="precio" pattern="[0-9]*" inputmode="numeric" value="<?php echo $precio ?> " disabled>
                                    </div>

                                    <br>
                                    <div class="form-group">
                                        <button class="btn btn-danger" id="btn_borrar"> Eliminar </button>
                                        <a href="<?php echo $URL; ?>../precios/precios.php" class="btn btn-secondary">Cancelar</a>
                                    </div>
                                    <div id="respuesta"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <br>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>
    </div>
</body>

</html>


<script>
    $('#btn_borrar').click(function () {

        var id_precio = '<?php echo $id_precio; ?>';

            var url = 'controller_delete.php';
            $.get(url,{id_precio:id_precio},function (datos) {
                $('#respuesta').html(datos);
            });

    });
</script>