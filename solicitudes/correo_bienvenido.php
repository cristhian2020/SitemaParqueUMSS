<?php 
if(isset($_POST['to'])){
    $to = $_POST['to'];
    $titulo = 'Bienvenido';
    $mensaje = 'Usted a sido registrado en el sistema del parqueo de la FCyT.';

    $from = "From: codecrazesoftwaresolutions@gmail.com";

    if (mail($to, $titulo, $mensaje, $from)) {
        echo "<div class='alert alert-success'>Correo enviado exitosamente a $to </div>";
        echo "<a href='javascript:history.go(-1)' class='btn btn-primary'>Volver</a>";
    } else {
        echo "<div class='alert alert-danger'>Error al enviar el correo electrónico</div>";
        echo "<a href='javascript:history.go(-1)' class='btn btn-primary'>Volver</a>";
    }
}
?>
