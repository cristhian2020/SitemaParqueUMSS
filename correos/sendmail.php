<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($buzon !== 'on') {
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
                <h2>Enviar correo electrónico</h2>
                <br>
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Clientes</h1>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body collapsed" style="display: none;">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th class="text-center">Nombre y apellido</th>
                                        <th class="text-center">Nit/Ci</th>
                                        <th class="text-center">Correo electrónico</th>
                                        <th class="text-center">Placa 1</th>
                                        <th class="text-center">Placa 2</th>
                                        <th class="text-center">Compartido</th>
                                        <th class="text-center">Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    ?>

                                        <tr>
                                            <td>
                                                <center><?php echo $contador_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nombre_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nit_cliente; ?></center>
                                            </td>
                                            <td id="correo_<?php echo $id_cliente; ?>">
                                                <center><?php echo $correo; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $placa_auto; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $placa_auto_dos; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nit_compartido; ?></center>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <center>
                                                        <input class="form-check-input" type="checkbox" name="delete[]" value="<?php echo $id_cliente; ?>">
                                                    </center>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <button id="mandarButton" class="btn btn-primary">Mandar</button>
                        </div>
                        <br>
                    </div>
                </div>
                
                <form action="PHPMailer.php" method="post">
                    <div class="form-group">
                        <label for="destinatarios">Destinatarios:</label>
                        <textarea class="form-control" id="destinatarios" name="destinatarios" rows="5" cols="40" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="asunto">Asunto:</label>
                        <input type="text" class="form-control" id="asunto" name="asunto" required>
                    </div>

                    <div class="form-group">
                        <label for="cuerpo">Cuerpo del correo:</label>
                        <textarea class="form-control" id="cuerpo" name="cuerpo" rows="5" cols="40" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar Correo Electrónico</button>
                </form>

            </div>
        </div>


        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>
    </div>
</body>

</html>

<script>
    // Obtener referencia al textarea del destinatario
    const destinatarioTextarea = document.getElementById('destinatarios');

    // Obtener referencia a todos los botones "Enviar"
    const enviarButtons = document.querySelectorAll('.enviar-btn');

    // Manejar el evento de clic en los botones "Enviar"
    enviarButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Obtener el ID del cliente asociado al botón "Enviar"
            const idCliente = button.getAttribute('data-id');

            // Obtener el correo electrónico asociado al cliente utilizando el ID
            const correoCliente = document.getElementById('correo_' + idCliente).innerText;

            // Agregar el correo electrónico al textarea del destinatario
            if (destinatarioTextarea.value === '') {
                destinatarioTextarea.value = correoCliente;
            } else {
                destinatarioTextarea.value += ', ' + correoCliente;
            }
        });
    });

    // Manejar el evento de clic en el botón "Mandar"
    const mandarButton = document.getElementById('mandarButton');
    mandarButton.addEventListener('click', function() {
        // Obtener todos los checkboxes seleccionados
        const checkboxes = document.querySelectorAll('input[name="delete[]"]:checked');
        let destinatarios = '';

        // Recorrer los checkboxes seleccionados y obtener los correos electrónicos
        checkboxes.forEach(function(checkbox) {
            const idCliente = checkbox.value;
            const correoCliente = document.getElementById('correo_' + idCliente).innerText;

            if (destinatarios === '') {
                destinatarios = correoCliente;
            } else {
                destinatarios += ', ' + correoCliente;
            }
        });

        // Agregar los correos electrónicos al textarea del destinatario
        if (destinatarioTextarea.value === '') {
            destinatarioTextarea.value = destinatarios;
        } else {
            destinatarioTextarea.value += ', ' + destinatarios;
        }
    });
</script>