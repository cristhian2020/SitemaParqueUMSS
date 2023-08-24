<?php 
if(isset($_POST['to'])){
    $to = $_POST['to'];
    $titulo = 'Deuda';
    $mensaje = 'Usted no ha pagado la deuda del mes anterior. Le recordamos que la fecha límite de pago vence el último día de cada mes.';

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
