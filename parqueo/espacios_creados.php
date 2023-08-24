<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($parqueo !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../layout/admin/head.php'); ?>
    <link rel="stylesheet" href="../public/css/botones.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../layout/admin/menu.php'); ?>

        <div class="content-wrapper">
            <br>
            <div class="container">
                <h2 class="text-center mb-4">Listado de sitios creados en la sección “A”</h2>
                <br>
                <form action="delete_espacio.php" method="post" class="mb-4">
                    <div class="transRight container">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="espacios_creadosB.php" class="btn btn-primary">Sección "B"</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm ">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center">Sitio</th>
                                            <th class="text-center">Seleccionar</th>
                                            <th class="text-center">Estado</th>
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
                                            <tr>
                                                <td>
                                                    <center><?php echo $espacio; ?></center>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <center>
                                                            <input class="form-check-input" type="checkbox" name="delete[]" value="<?php echo $id_map; ?>" <?php echo $checkbox_disabled; ?>>
                                                            <label class="form-check-label" for="defaultCheck1"></label>
                                                        </center>
                                                    </div>
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
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-danger mb-4" name="submit">Borrar seleccionados</button>
                </form>
            </div>
        </div>

        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>
