<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (
        isset($_GET['nombre_cliente']) &&
        isset($_GET['nit_cliente']) &&
        isset($_GET['correo']) &&
        isset($_GET['placa_auto']) &&
        isset($_GET['placa_auto_dos']) &&
        isset($_GET['nit_compartido'])
    ) {
        $nombre_cliente = $_GET['nombre_cliente'];
        $nit_cliente = $_GET['nit_cliente'];
        $correo = $_GET['correo'];
        $placa_auto = $_GET['placa_auto'];
        $placa_auto_dos = $_GET['placa_auto_dos'];
        $nit_compartido = $_GET['nit_compartido'];

        // Validar el nombre del cliente (solo letras sin números ni signos)
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

        // Insertar o actualizar los datos del cliente en la tabla
        $query = $pdo->prepare("INSERT INTO tb_clientes (nombre_cliente, nit_cliente, correo, placa_auto, placa_auto_dos, nit_compartido, map_id, fyh_creacion, fyh_actualizacion, fyh_eliminacion, estado)
                               VALUES (:nombre_cliente, :nit_cliente, :correo, :placa_auto, :placa_auto_dos, :nit_compartido, NULL, NOW(), NULL, NULL, '1')
                               ON DUPLICATE KEY UPDATE
                               nombre_cliente = VALUES(nombre_cliente),
                               correo = VALUES(correo),
                               placa_auto = VALUES(placa_auto),
                               placa_auto_dos = VALUES(placa_auto_dos),
                               nit_compartido = VALUES(nit_compartido),
                               fyh_actualizacion = NOW()");

        $query->bindParam(':nombre_cliente', $nombre_cliente);
        $query->bindParam(':nit_cliente', $nit_cliente);
        $query->bindParam(':correo', $correo);
        $query->bindParam(':placa_auto', $placa_auto);
        $query->bindParam(':placa_auto_dos', $placa_auto_dos);
        $query->bindParam(':nit_compartido', $nit_compartido);

        if ($query->execute()) {
            // Éxito al insertar o actualizar los datos del cliente
            ?>
            <script>
                alert("Cliente guardado exitosamente");
                location.href = "index.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Error al guardar el cliente. Por favor, inténtelo de nuevo.");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Por favor, complete todos los campos del formulario");
        </script>
        <?php
    }
}
