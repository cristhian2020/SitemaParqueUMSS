<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["toDeuda"];

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurar el servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'codecrazesoftwaresolutions@gmail.com';
        $mail->Password = 'pznjeeyiqysenoon';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configurar los detalles del remitente
        $mail->setFrom('codecrazesoftwaresolutions@gmail.com', 'Parqueo');

        // Separar los destinatarios por comas y agregarlos al correo
        $destinatariosArray = explode(',', $to);
        foreach ($destinatariosArray as $destinatario) {
            $mail->addAddress(trim($destinatario));
        }

        // Configurar el contenido del correo electrónico
        $mail->isHTML(true);
        $mail->Subject = 'Recordatorio de deuda';
        $mail->Body = 'Estimado Usuario,<br><br>
                        Le recordamos que tiene una deuda pendiente en nuestro servicio de parqueo. Por favor, realice el pago de su deuda lo antes posible para evitar inconvenientes.<br><br>
                        Si ya ha realizado el pago, por favor, ignore este mensaje.<br><br>
                        Si tiene alguna pregunta o necesita asistencia, no dude en contactarnos.<br><br>
                        ¡Gracias y esperamos recibir su pago pronto!<br>
                        Equipo de Parqueo';

        // Enviar el correo electrónico
        $mail->send();
        echo 'El correo electrónico de recordatorio de deuda fue enviado correctamente.';
    } catch (Exception $e) {
        echo 'Ocurrió un error al enviar el correo electrónico de recordatorio de deuda: ' . $mail->ErrorInfo;
    }
}
?>
