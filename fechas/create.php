<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($fecha !== 'on') {
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

// Obtener la última fila de la tabla tb_fechas_limite
$stmt_last_date = $pdo->query("SELECT fecha_limite_asignacion, fecha_limite_pago FROM tb_fechas_limite ORDER BY id_fecha DESC LIMIT 1");
$last_date_row = $stmt_last_date->fetch(PDO::FETCH_ASSOC);
$fecha_limite_asignacion = $last_date_row['fecha_limite_asignacion'];
$fecha_limite_pago = $last_date_row['fecha_limite_pago'];

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
                                    <h3> Fijar límite de fechas  </h3>
                                    <span>Agregue las fechas límites para realizar una asignación de sitio y monto del recibo</span>
                                </div>
                                <div class="card-body">
                                    <p>La ultima fecha fiajada para asignar un sitios es: <?php echo $fecha_limite_asignacion; ?></p>
                                    <p>La ultima fecha fiajada para asignar el precio es: <?php echo $fecha_limite_pago; ?></p>

                                    <div class="form-group">
                                        <label for="">Fecha asignacion</label>
                                        <input type="date" class="form-control col-md-6" id="fecha_limite_asignacion" pattern="[0-9]*" inputmode="numeric">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Fecha monto</label>
                                        <input type="date" class="form-control col-md-6" id="fecha_limite_pago" pattern="[0-9]*" inputmode="numeric">
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
                                            <center>Límite asignar sitios</center>
                                        </th>
                                        <th scope="col">
                                            <center>Límite cambiar monto</center>
                                        </th>
                                        <th scope="col">
                                            <center>Acción</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 0;
                                    $query_fechas = $pdo->prepare("SELECT * FROM tb_fechas_limite ");
                                    $query_fechas->execute();
                                    $fechas = $query_fechas->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($fechas as $fecha) {
                                    
                                        $id_fecha = $fecha['id_fecha'];

                                        $fecha_limite_asignacion = $fecha['fecha_limite_asignacion'];
                                        $fecha_limite_pago = $fecha['fecha_limite_pago'];


                                        $contador = $contador + 1;
                                    ?>
                                        <tr>
                                            <td>
                                                <center><?php echo $contador; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fecha_limite_asignacion; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $fecha_limite_pago; ?></center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="delete.php?id=<?php echo $id_fecha; ?>" class="btn btn-danger">Eliminar</a>
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
        var fecha_limite_asignacion = $('#fecha_limite_asignacion').val();
        var fecha_limite_pago = $('#fecha_limite_pago').val();

        


        if (fecha_limite_asignacion == "") {
            alert('Debe llenar el campo fecha asignacion');
            $('#fecha_limite_asignacion').focus();
        }if (fecha_limite_pago == "") {
            alert('Debe llenar el campo fecha monto');
            $('#fecha_limite_pago').focus();
        } else {
            var url = 'controller_create.php';
            $.get(url, {
                fecha_limite_asignacion: fecha_limite_asignacion,
                fecha_limite_pago: fecha_limite_pago

            }, function(datos) {
                $('#respuesta').html(datos);
                // Redirigir a la página actual para actualizar la tabla
                location.reload();
            });
        }
    });
</script>