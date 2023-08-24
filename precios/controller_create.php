<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if (!isset($_SESSION['usuario_sesion'])) {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: '.$URL.'/login');
    exit();
}

if (isset($_GET['precio'])) {
    $precio = $_GET['precio'];

    // Validar que el precio no esté vacío
    if (empty($precio)) {
        echo 'El campo Precio es obligatorio.';
        exit();
    }

    $estado = 1; // Establecer el valor 1 en el campo estado
    $fyh_creacion = date('Y-m-d'); // Obtener la fecha actual

    // Obtener la fecha límite de pago de la tabla tb_fechas_limite
    $consulta_fecha_limite = $pdo->prepare('SELECT fecha_limite_pago FROM tb_fechas_limite ORDER BY id_fecha DESC LIMIT 1');
    $consulta_fecha_limite->execute();
    $resultado_fecha_limite = $consulta_fecha_limite->fetch(PDO::FETCH_ASSOC);

    if ($resultado_fecha_limite) {
        $fecha_limite_pago = $resultado_fecha_limite['fecha_limite_pago'];

        // Comparar fyh_creacion con fecha_limite_pago
        if ($fyh_creacion <= $fecha_limite_pago) {
            // Insertar el precio en la tabla tb_precios
            $sentencia_insertar_precio = $pdo->prepare('INSERT INTO tb_precios (precio, estado, fyh_creacion)
            VALUES (:precio, :estado, :fyh_creacion)');
            $sentencia_insertar_precio->bindParam(':precio', $precio);
            $sentencia_insertar_precio->bindParam(':estado', $estado);
            $sentencia_insertar_precio->bindParam(':fyh_creacion', $fyh_creacion);

            if ($sentencia_insertar_precio->execute()) {
                echo '<script>alert("Precio guardado correctamente.");</script>';
                exit();
            } else {
                echo 'Error al guardar el precio en la base de datos.';
                exit();
            }
        } else {
            ?>
            <script>
                alert("No se puede crear un nuevo precio después de la fecha límite de pago.");
            </script>
            <?php
            exit();
        }
    } else {
        echo 'No se encontró la fecha límite de pago en la tabla tb_fechas_limite.';
        exit();
    }
}
?>
