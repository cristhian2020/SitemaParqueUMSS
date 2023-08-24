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
                <h2>Enviar Correo</h2>
                <br>
                <form action="enviar_correo.php" method="post">
                    <div class="form-group">
                        <label for="to">Destinatario:</label>
                        <input type="email" class="form-control" id="to" name="to" required>
                    </div>

                    <div class="form-group">
                        <label for="titulo">Asunto:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>

                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" cols="50" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Enviar</button>

                </form>


                
            </div>
        </div>
        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>


    </div>

</body>

</html>
