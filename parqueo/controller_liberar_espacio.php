<?php
include('../app/config.php');

$id_cliente = $_GET['id_cliente'];

try {
    // Liberar el espacio de la tabla clientes
    $sentencia = $pdo->prepare("UPDATE tb_clientes SET map_id = NULL, fecha_asignacion_comp = NULL, nit_compartido = '0' WHERE id_cliente = :id_cliente");
    
    $sentencia->bindParam(':id_cliente', $id_cliente);

    if ($sentencia->execute()) {
        echo "El registro se eliminó correctamente.";
        ?>
        <script>
            location.href = "mapeo-de-vehiculos.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Error al eliminar el registro.");
            location.href = "mapeo-de-vehiculos.php";
        </script>
        <?php
    }
} catch (PDOException $e) {
    ?>
    <script>
        alert("Error al eliminar el registro: <?php echo $e->getMessage(); ?>");
        location.href = "mapeo-de-vehiculos.php";
    </script>
    <?php
}
?>
