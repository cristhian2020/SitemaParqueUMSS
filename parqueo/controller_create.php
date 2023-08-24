<?php
include('../app/config.php');

$seccion = $_GET['seccion'];
$estado_espacio = $_GET['estado_espacio'];

// Obtener el último espacio creado en la misma sección
$sentencia = $pdo->prepare("SELECT MAX(espacio) FROM tb_mapeos WHERE seccion = :seccion");
$sentencia->bindParam(':seccion', $seccion);
$sentencia->execute();
$ultimoEspacio = $sentencia->fetchColumn();

if ($ultimoEspacio == false) {
    // No se encontró ningún espacio en la misma sección, comenzar desde 1
    $nuevoEspacio = 1;
} else {
    // Encontrar el siguiente espacio en la secuencia
    $nuevoEspacio = $ultimoEspacio +1;
}

// Verificar si el espacio ya está registrado en la misma sección
$sentencia = $pdo->prepare("SELECT COUNT(*) FROM tb_mapeos WHERE espacio = :espacio AND seccion = :seccion");
$sentencia->bindParam(':espacio', $nuevoEspacio);
$sentencia->bindParam(':seccion', $seccion);
$sentencia->execute();
$count = $sentencia->fetchColumn();

if ($count > 0) {
    // El espacio ya está registrado en la misma sección
    ?>
    <script>
        alert("Este espacio ya se encuentra creado en la misma sección.");
    </script>
    <?php
} else {
    // El espacio no está registrado en la misma sección
    date_default_timezone_set("America/Caracas");
    $fechaHora = date("Y-m-d h:i:s");
    $borrar = 'NO';
    $estado_del_registro = 1;

    $sentencia = $pdo->prepare("INSERT INTO tb_mapeos (espacio, estado_espacio, fyh_creacion, estado, seccion, borrar) 
                                VALUES (:espacio, :estado_espacio, :fyh_creacion, :estado, :seccion, :borrar)");
    $sentencia->bindParam(':espacio', $nuevoEspacio);
    $sentencia->bindParam(':estado_espacio', $estado_espacio);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindParam(':estado', $estado_del_registro);
    $sentencia->bindParam(':seccion', $seccion);
    $sentencia->bindParam(':borrar', $borrar);

    if ($sentencia->execute()) {
        // El registro se insertó correctamente
        ?>
        <script>
            alert("Espacio guardado exitosamente.");
        </script>
        <?php
        ?>
        <script>location.href = "create.php";</script>
        <?php
    } else {
        // Ocurrió un error al insertar el registro
        ?>
        <script>
            alert("Ocurrió un error al crear el espacio.");
        </script>
        <?php
    }
}
?>
