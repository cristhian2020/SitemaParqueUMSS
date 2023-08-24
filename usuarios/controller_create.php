<?php


include('../app/config.php');

$nombres = $_GET['nombres'];
$email = $_GET['email'];
$password_user = $_GET['password_user'];
$turno = $_GET['turno'];

$nombre_rol = $_GET['nombre_rol'];

$estado_del_registro = 1;
$fechaHora = date('Y-m-d H:i:s');

try {
    $pdo->beginTransaction();

    // Validar si el nombre solo contiene letras y convertir a mayúsculas
    if (!preg_match('/^[A-Za-z\s]+$/', $nombres)) {
?>
        <script>
            alert("Ingrese solo letras al campo Nombre y apellio");
        </script>
    <?php
        exit();
    }
    $nombres = strtoupper($nombres);

    // Validar si el correo electrónico es válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ?>
        <script>
            alert("El correo electrónico ingresado es inválido.");
        </script>
    <?php
        exit();
    }

    // Validar longitud de la contraseña
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

    // Consultar si el correo electrónico ya está registrado
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tb_usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
    ?>
        <script>
            alert("Este correo electrónico ya está registrado");
        </script>
    <?php
        exit();
    }

    // Verificar que el rol exista en la tabla de roles
    $stmt0 = $pdo->prepare("SELECT id_rol FROM tb_roles WHERE nombre_rol = :nombre_rol");
    $stmt0->bindParam(':nombre_rol', $nombre_rol);
    $stmt0->execute();
    $row = $stmt0->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
    ?>
        <script>
            alert("El rol no existe.");
        </script>
    <?php
        exit();
    }
    $rol_id = $row['id_rol'];

    // Primera sentencia para insertar en tb_usuarios
    $stmt1 = $pdo->prepare("INSERT INTO tb_usuarios
    (nombres, email, password_user,turno, fyh_creacion, estado, rol_id)
    VALUES (:nombres, :email, :password_user, :turno, NOW(), :estado, :rol_id)");

    $stmt1->bindParam(':nombres', $nombres);
    $stmt1->bindParam(':email', $email);
    $stmt1->bindParam(':password_user', $password_user);
    $stmt1->bindParam(':turno', $turno);

    $stmt1->bindParam(':estado', $estado_del_registro);
    $stmt1->bindParam(':rol_id', $rol_id);

    $stmt1->execute();

    $pdo->commit();

    ?>
    <script>
        alert("El usuario se ha creado exitosamente.");
        location.href = "index.php";
    </script>
<?php

} catch (PDOException $e) {
    $pdo->rollback();
    echo "No se pudo registrar en la BD: " . $e->getMessage();
} catch (Exception $e) {
    $pdo->rollback();
    echo "No se pudo registrar en la BD: " . $e->getMessage();
}
?>