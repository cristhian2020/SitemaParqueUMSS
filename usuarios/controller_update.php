<?php
include('../app/config.php');

$nombres = $_GET['nombres'];
$email = $_GET['email'];
$password_user = $_GET['password_user'];
$turno = $_GET['turno'];
$id_user = $_GET['id_user'];
$nombre_rol = $_GET['nombre_rol'];

if (!preg_match('/^[A-Za-z\s]+$/', $nombres)) {
  echo '<script>alert("El nombre del cliente solo debe contener letras.");</script>';
  exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo '<script>alert("Ingrese un correo electrónico válido.");</script>';
  exit();
}

if (strlen($password_user) < 8) {
  ?>
  <script>
    alert("La contraseña ingresada es demasiado corta. Debe tener al menos 8 caracteres.");
  </script>
  <?php
  exit();
}

// Validar que la contraseña contenga mayúsculas, minúsculas, números y caracteres especiales
if (!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z0-9]).{8,}$/', $password_user)) {
  ?>
  <script>
    alert("La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un caracter especial.");
  </script>
  <?php
  exit();
}

date_default_timezone_set("America/caracas");
$fechaHora = date("Y-m-d h:i:s");

// Consultar el ID del nuevo rol
$stmt = $pdo->prepare("SELECT id_rol FROM tb_roles WHERE nombre_rol = ?");
$stmt->execute([$nombre_rol]);
$rol_id = $stmt->fetchColumn();

// Obtener correo electrónico existente
$stmt = $pdo->prepare("SELECT email FROM tb_usuarios WHERE id = ?");
$stmt->execute([$id_user]);
$existing_email = $stmt->fetchColumn();

// Validar correo electrónico
if ($email !== $existing_email) {
  $stmt = $pdo->prepare("SELECT COUNT(*) FROM tb_usuarios WHERE email = ?");
  $stmt->execute([$email]);
  $count = $stmt->fetchColumn();

  if ($count > 0) {
    ?>
    <script>
      alert("El correo electrónico ya está registrado en otro usuario.");
    </script>
    <?php
    exit();
  }
}

$sentencia = $pdo->prepare("UPDATE tb_usuarios SET
    nombres = :nombres,
    email = :email,
    password_user = :password_user,
    turno = :turno,
    rol_id = :rol_id,
    fyh_actualizacion = :fyh_actualizacion 
WHERE id = :id_user");

$sentencia->bindParam(':nombres', $nombres);
$sentencia->bindParam(':email', $email);
$sentencia->bindParam(':password_user', $password_user);
$sentencia->bindParam(':turno', $turno);

$sentencia->bindParam(':rol_id', $rol_id);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_user', $id_user);

if ($sentencia->execute()) {
  ?>
  <script>
    alert("Se actualizó correctamente.");
    location.href = "index.php";
  </script>
  <?php
} else {
  ?>
  <script>
    alert("No se pudo actualizar el registro.");
  </script>
  <?php
}
?>
