<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($recibos !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
    exit();
}

// Obtener el último precio de la tabla tb_precios
$sql = "SELECT precio FROM tb_precios ORDER BY id_precio DESC LIMIT 1";
$resultado = $pdo->query($sql);
$ultimoPrecio = $resultado->fetchColumn();

if (isset($_GET['id'])) {
    $id_precio = $_GET['id'];

    // Eliminar el registro de la tabla tb_precios
    $sentencia_eliminar = $pdo->prepare("DELETE FROM tb_precios WHERE id = :id");
    $sentencia_eliminar->bindParam(':id', $id_precio);

    try {
        $sentencia_eliminar->execute();
        // Redirigir a la página actual para actualizar la tabla
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } catch (PDOException $e) {
        echo "Error al eliminar el registro: " . $e->getMessage();
        exit();
    }
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
                                    <h3> Agregar un nuevo precio </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <h5>El último precio fijado en bolivianos es: <?php echo $ultimoPrecio; ?></h5>
                                        <label for="precio">Precio</label>
                                        <input type="number" class="form-control col-md-3" id="precio" pattern="[0-9]{1,4}" inputmode="numeric" min="0" max="9999">
                                    </div>



                                    <br>
                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btn_guardar"> Guardar </button>
                                    </div>
                                    <div id="respuesta"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <br>
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">
                                            <center>Nro</center>
                                        </th>
                                        <th scope="col">
                                            <center>Precio</center>
                                        </th>
                                        <th scope="col">
                                            <center>Acción</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    $query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE estado = '1'");
                                    $query_precios->execute();
                                    $precios = $query_precios->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($precios as $precio) {
                                        $id_precio = $precio['id_precio'];
                                        $precio = $precio['precio'];

                                        $contador = $contador + 1;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $precio; ?></center>
                                            </td>

                                            <td>
                                                <center>
                                                    <a href="delete.php?id=<?php echo $id_precio; ?>" class="btn btn-danger">Eliminar</a>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
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
    $('#btn_guardar').click(function() {
        var precio = $('#precio').val();

        if (precio == "") {
            alert('Debe llenar el campo Precio');
            $('#precio').focus();
        } else {
            var url = 'controller_create.php';
            $.get(url, {
                precio: precio
            }, function(datos) {
                $('#respuesta').html(datos);
                // Redirigir a la página actual para actualizar la tabla
                location.reload();
            });
        }
    });
</script>