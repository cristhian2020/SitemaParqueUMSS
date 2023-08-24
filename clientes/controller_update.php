<?php
include('../app/config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$nit_cliente = $_GET['nit_cliente'];
$correo = $_GET['correo'];
$placa_auto = $_GET['placa_auto'];
$placa_auto_dos = $_GET['placa_auto_dos'];
$nit_compartido = $_GET['nit_compartido'];
$id_cliente = $_GET['id_cliente'];

if (!preg_match('/^[A-Za-z\s]+$/', $nombre_cliente)) {
    echo '<script>alert("El nombre del cliente solo debe contener letras.");</script>';
    exit();
}

// Validar el NIT del cliente (solo números y máximo 20 dígitos)
if (!preg_match('/^\d{1,20}$/', $nit_cliente)) {
    echo '<script>alert("El NIT del cliente debe contener solo números y tener un máximo de 20 dígitos.");</script>';
    exit();
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("Ingrese un correo electrónico válido.");</script>';
    exit();
}

// Verificar si el nit_compartido existe como nit_cliente en la tabla tb_clientes y no es igual al nit_cliente actual
if (!empty($nit_compartido)) {
    $query_check_nit_compartido = $pdo->prepare("SELECT COUNT(*) FROM tb_clientes WHERE nit_cliente = :nit_compartido AND nit_cliente != :nit_cliente");
    $query_check_nit_compartido->bindParam(':nit_compartido', $nit_compartido);
    $query_check_nit_compartido->bindParam(':nit_cliente', $nit_cliente);
    $query_check_nit_compartido->execute();

    if ($query_check_nit_compartido->fetchColumn() == 0) {
        ?>
        <script>
            alert("El NIT compartido no es válido.");
        </script>
        <?php
        exit();
    }
}

// Actualizar los datos del cliente en la tabla
$query_update = $pdo->prepare("UPDATE tb_clientes SET
                             nombre_cliente = :nombre_cliente,
                             nit_cliente = :nit_cliente,
                             correo = :correo,
                             placa_auto = :placa_auto,
                             placa_auto_dos = :placa_auto_dos,
                             nit_compartido = :nit_compartido,
                             fecha_asignacion_comp = :fecha_asignacion_comp,
                             fyh_actualizacion = NOW()
                             WHERE id_cliente = :id_cliente");

$fecha_asignacion_comp = null;
if (!empty($nit_compartido)) {
    $fecha_asignacion_comp = date('Y-m-d H:i:s');
}

$query_update->bindParam(':nombre_cliente', $nombre_cliente);
$query_update->bindParam(':nit_cliente', $nit_cliente);
$query_update->bindParam(':correo', $correo);
$query_update->bindParam(':placa_auto', $placa_auto);
$query_update->bindParam(':placa_auto_dos', $placa_auto_dos);
$query_update->bindParam(':nit_compartido', $nit_compartido);
$query_update->bindParam(':fecha_asignacion_comp', $fecha_asignacion_comp);
$query_update->bindParam(':id_cliente', $id_cliente);

if ($query_update->execute()) {
    // Éxito al actualizar los datos del cliente
    ?>
    <script>
        alert("Cliente actualizado exitosamente");
        location.href = "index.php";
    </script>
    <?php
} else {
    ?>
    <script>
        alert("Error al actualizar el cliente. Por favor, inténtelo de nuevo.");
    </script>
    <?php
}
?>
