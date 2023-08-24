<?php
include('../app/config.php');

$nombre_rol = $_GET['nombre_rol'];

date_default_timezone_set("America/caracas");
$fechaHora = date("Y-m-d h:i:s");

// Verificar si el rol ya existe en la base de datos
$sentencia_verificar = $pdo->prepare("SELECT COUNT(*) as total FROM tb_roles WHERE nombre_rol = :nombre_rol");
$sentencia_verificar->bindParam(':nombre_rol', $nombre_rol);
$sentencia_verificar->execute();
$resultado_verificar = $sentencia_verificar->fetch(PDO::FETCH_ASSOC);

if ($resultado_verificar['total'] > 0) {
    // El rol ya existe, mostrar un mensaje de error o redirigir a la página de error
    echo '<script>alert("El rol ya existe.");</script>';
    exit();
}

// Insertar en la tabla de roles
$sentencia = $pdo->prepare("INSERT INTO tb_roles (nombre_rol, fyh_creacion, estado) 
                            VALUES (:nombre_rol, :fyh_creacion, :estado)");
$sentencia->bindParam(':nombre_rol', $nombre_rol);
$sentencia->bindParam(':fyh_creacion', $fechaHora);
$sentencia->bindParam(':estado', $estado_del_registro);

if ($sentencia->execute()) {
    $rol_id = $pdo->lastInsertId(); // Obtener el ID del rol recién insertado

    // Insertar en la tabla de permisos
    $sentencia_permisos = $pdo->prepare("INSERT INTO tb_permisos (principal, principal2, usuarios, roles, parqueo, clientes, recibos, pagos, anuncios, guardia, buzon,fecha, fyh_creacion, rol_id, estado) 
                                        VALUES (:principal, :principal2, :usuarios, :roles, :parqueo, :clientes, :recibos, :pagos, :anuncios, :guardia, :buzon, :fecha, :fyh_creacion, :rol_id, :estado)");

    // Obtener los valores de los checkboxes seleccionados o asignar null si no están seleccionados
    $principal = isset($_GET['principal']) ? $_GET['principal'] : null;
    $principal2 = isset($_GET['principal2']) ? $_GET['principal2'] : null;
    $usuarios = isset($_GET['usuarios']) ? $_GET['usuarios'] : null;
    $roles = isset($_GET['roles']) ? $_GET['roles'] : null;
    $parqueo = isset($_GET['parqueo']) ? $_GET['parqueo'] : null;
    $clientes = isset($_GET['clientes']) ? $_GET['clientes'] : null;
    $recibos = isset($_GET['recibos']) ? $_GET['recibos'] : null;
    $pagos = isset($_GET['pagos']) ? $_GET['pagos'] : null;
    $anuncios = isset($_GET['anuncios']) ? $_GET['anuncios'] : null;
    $guardia = isset($_GET['guardia']) ? $_GET['guardia'] : null;
    $buzon = isset($_GET['buzon']) ? $_GET['buzon'] : null;
    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;


    
    $sentencia_permisos->bindParam(':principal', $principal);
    $sentencia_permisos->bindParam(':principal2', $principal2);
    $sentencia_permisos->bindParam(':usuarios', $usuarios);
    $sentencia_permisos->bindParam(':roles', $roles);
    $sentencia_permisos->bindParam(':parqueo', $parqueo);
    $sentencia_permisos->bindParam(':clientes', $clientes);
    $sentencia_permisos->bindParam(':recibos', $recibos);
    $sentencia_permisos->bindParam(':pagos', $pagos);
    $sentencia_permisos->bindParam(':anuncios', $anuncios);
    $sentencia_permisos->bindParam(':guardia', $guardia);
    $sentencia_permisos->bindParam(':buzon', $buzon);
    $sentencia_permisos->bindParam(':fecha', $fecha);
    $sentencia_permisos->bindParam(':fyh_creacion', $fechaHora);
    $sentencia_permisos->bindParam(':rol_id', $rol_id);
    $sentencia_permisos->bindParam(':estado', $estado_del_registro);

    if ($sentencia_permisos->execute()) {
        // Redirigir a la página de éxito o mostrar un mensaje de éxito
?>
        <script>
            alert("Rol guardado exitosamente");
            location.href = "index.php";
        </script>
<?php
        exit();
    } else {
        // Mostrar un mensaje de error o redirigir a la página de error
        header("Location: ../public/error.php");
        exit();
    }
} else {
    // Mostrar un mensaje de error o redirigir a la página de error
    header("Location: ../public/error.php");
    exit();
}
?>
