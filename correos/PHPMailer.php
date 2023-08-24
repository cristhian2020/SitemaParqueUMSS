<?php
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destinatarios = $_POST["destinatarios"];
    $asunto = $_POST["asunto"];
    $cuerpo = $_POST["cuerpo"];

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
        $destinatariosArray = explode(',', $destinatarios);
        foreach ($destinatariosArray as $destinatario) {
            $mail->addAddress(trim($destinatario));
        }

        // Configurar el contenido del correo electrónico
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;

        // Enviar el correo electrónico
        $mail->send();
        echo 'El correo electrónico fue enviado correctamente.';
    } catch (Exception $e) {
        echo 'Ocurrió un error al enviar el correo electrónico: ' . $mail->ErrorInfo;
    }
}
?>
