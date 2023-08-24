<?php
include('../app/config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$nit_cliente = $_GET['nit_cliente'];
$correo = $_GET['correo'];

$placa_auto = $_GET['placa_auto'];
$placa_auto_dos = $_GET['placa_auto_dos'];
$espacio = $_GET['espacio'];
$seccion = $_GET['seccion'];

$estado_del_registro = 1;
$espacio_estado = "LIBRE";
$fechaHora = date('Y-m-d H:i:s');

// Validar campos requeridos
if (empty($nombre_cliente)) {
    ?>
    <script>
        alert("El campo Nombre es obligatorio.");
    </script>
    <?php
    exit;
}

if (empty($nit_cliente)) {
    ?>
    <script>
        alert("El campo Nit o CI es obligatorio.");
    </script>
    <?php
    exit;
}

if (empty($placa_auto)) {
    ?>
    <script>
        alert("El campo Placas es obligatorio.");
    </script>
    <?php
    exit;
}

if ($placa_auto == $placa_auto_dos) {
    ?>
    <script>
        alert("Las dos placas no pueden ser iguales.");
    </script>
    <?php
    exit;
}

try {
    $pdo->beginTransaction();

    // Verificar si el espacio y la sección están disponibles
    $stmt_check = $pdo->prepare("SELECT * FROM tb_mapeos WHERE espacio = :espacio AND seccion = :seccion AND estado = :estado");
    $stmt_check->bindParam(':espacio', $espacio);
    $stmt_check->bindParam(':seccion', $seccion);
    $stmt_check->bindParam(':estado', $estado_del_registro);
    $stmt_check->execute();
    $count = $stmt_check->rowCount();

    if ($count > 0) {
        // Obtener el id_map del registro existente
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $id_map = $row['id_map'];

        // Obtener la fecha límite de asignación de la tabla tb_fechas_limite
        $consulta_fecha_limite = $pdo->prepare('SELECT fecha_limite_asignacion FROM tb_fechas_limite ORDER BY id_fecha DESC LIMIT 1');
        $consulta_fecha_limite->execute();
        $resultado_fecha_limite = $consulta_fecha_limite->fetch(PDO::FETCH_ASSOC);

        if ($resultado_fecha_limite) {
            $fecha_limite_asignacion = $resultado_fecha_limite['fecha_limite_asignacion'];

            // Obtener la fecha actual
            $fecha_actual = date('Y-m-d');

            // Comparar la fecha actual con la fecha límite de asignación
            if ($fecha_actual <= $fecha_limite_asignacion) {
                // Verificar si el espacio ya está asignado a otro cliente
                $stmt_verify = $pdo->prepare("SELECT * FROM tb_clientes WHERE map_id = :id_map");
                $stmt_verify->bindParam(':id_map', $id_map);
                $stmt_verify->execute();
                $count_verify = $stmt_verify->rowCount();

                if ($count_verify > 0) {
                    ?>
                    <script>
                        alert("El espacio seleccionado ya está asignado a otro cliente. Por favor, elija otro.");
                    </script>
                    <?php
                    exit;
                }

                // Asignar la fecha actual al campo fecha_asignacion
                $fecha_asignacion = date('Y-m-d');

                // Actualizar el campo map_id y fecha_asignacion en la tabla de clientes
                $stmt3 = $pdo->prepare("UPDATE tb_clientes SET map_id = :id_map, fecha_asignacion = :fecha_asignacion WHERE nit_cliente = :nit_cliente");
                $stmt3->bindParam(':id_map', $id_map);
                $stmt3->bindParam(':fecha_asignacion', $fecha_asignacion);
                $stmt3->bindParam(':nit_cliente', $nit_cliente);
                $stmt3->execute();

                $pdo->commit();
                ?>
                <script>
                    alert("Se ha asignado el espacio correctamente.");
                    location.href = "index.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("No se puede asignar el espacio después de la fecha límite de asignación.");
                </script>
                <?php
            }
        } else {
            echo 'No se encontró la fecha límite de asignación en la tabla tb_fechas_limite.';
            exit();
        }
    } else {
        ?>
        <script>
            alert("El espacio no existe en la sección seleccionada. Por favor elija otro.");
        </script>
        <?php
    }
} catch (PDOException $e) {
    $pdo->rollback();
    echo "No se pudo registrar en la BD: " . $e->getMessage();
}
?>
