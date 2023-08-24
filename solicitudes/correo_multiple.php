<?php 
if(isset($_POST['to']) && isset($_POST['titulo']) && isset($_POST['mensaje'])){
  $to = $_POST['to'];
  $titulo = $_POST['titulo'];
  $mensaje = $_POST['mensaje'];

  // Separar los correos electrónicos en un array
  $emailArray = explode(",", $to);

  // Recorrer el array de correos electrónicos y enviar el correo a cada uno
  foreach ($emailArray as $email) {
    $email = trim($email);
    $from = "From: codecrazesoftwaresolutions@gmail.com";

    if(mail($email,$titulo,$mensaje,$from)){
      
      echo "<div class='alert alert-success'>Correo enviado exitosamente a $email</div>";
    }else{
      echo "<div class='alert alert-danger'><h1>Error al enviar el correo electrónico a</h1> $email </div>";
    }
  }

  echo "<a href='javascript:history.go(-1)' class='btn btn-primary' style='margin-right: 10px;'> <h2>Volver</h2></a>";
}
?>
