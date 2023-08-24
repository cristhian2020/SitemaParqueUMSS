<?php
require '/PHPMailer-master/src/PHPMailer.php';
require '/PHPMailer-master/src/SMTP.php';
require '/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['to']) && isset($_POST['titulo']) && isset($_POST['mensaje'])) {
    $to = $_POST['to'];
    $titulo = $_POST['titulo'];
    $mensaje = $_POST['mensaje'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'servidor_smtp';
        $mail->SMTPAuth = true;
        $mail->Username = 'codecrazesoftwaresolutions@gmail.com';
        $mail->Password = 'Qs78wt9emcV0F2x';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('codecrazesoftwaresolutions@gmail.com', 'Tu Nombre');
        $mail->addAddress($to);
        $mail->Subject = $titulo;
        $mail->Body = $mensaje;

        $mail->send();

        echo "<div class='alert alert-success'>Correo enviado exitosamente a $to </div>";
        echo "<a href='javascript:history.go(-1)' class='btn btn-primary'>Volver</a>";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error al enviar el correo electrónico: " . $mail->ErrorInfo . "</div>";
        echo "<a href='javascript:history.go(-1)' class='btn btn-primary'>Volver</a>";
    }
}
?>
