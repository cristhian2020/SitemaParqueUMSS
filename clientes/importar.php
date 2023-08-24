<?php

include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

// Establecer la conexión a la base de datos
//$con = mysqli_connect('localhost', 'codecraze', 'rKxqHj7f4FwdNjx', 'codecraze_db');
$con = mysqli_connect('localhost', 'root', '', 'parqueo');

// Verificar si la conexión es exitosa
if (mysqli_connect_errno()) {
    echo "Error en la conexión a la base de datos: " . mysqli_connect_error();
    exit();
}

$tipo = $_FILES['dataCliente']['type'];
$tamanio = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas = file($archivotmp);

$i = 0;
$registrosInsertados = 0;
$registrosIgnorados = 0;
$registrosRepetidos = 0;

$registrosUnicos = array(); // Conjunto de valores únicos

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados = ($cantidad_registros - 1);

    if ($i != 0) {
        $campos = str_getcsv($linea, ',', '"');

        // Obtener los campos individualmente
        $nombre_cliente = !empty($campos[0]) ? $campos[0] : '';
        $nit_cliente = !empty($campos[1]) ? $campos[1] : '';
        $correo = !empty($campos[2]) ? $campos[2] : '';
        $placa_auto = !empty($campos[3]) ? $campos[3] : '';
        $estado = !empty($campos[4]) ? $campos[4] : '';
        $nit_compartido = !empty($campos[5]) ? mysqli_real_escape_string($con, $campos[5]) : 0;
        $placa_auto_dos = !empty($campos[6]) ? $campos[6] : '';
       // $fyh_actualizacion = !empty($campos[7]) ? date('Y-m-d H:i:s', strtotime($campos[7])) : null;
        //$fyh_eliminacion = !empty($campos[8]) ? date('Y-m-d H:i:s', strtotime($campos[8])) : null;
        //$fecha_asignacion = !empty($campos[9]) ? date('Y-m-d H:i:s', strtotime($campos[9])) : null;
        //$fecha_asignacion_comp = !empty($campos[10]) ? date('Y-m-d H:i:s', strtotime($campos[10])) : null;


        // Validar correo válido
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $registrosIgnorados++;
            continue; // Ignorar el registro y pasar al siguiente
        }

        // Validar nit_cliente solo contiene números
        if (!ctype_digit($nit_cliente)) {
            $registrosIgnorados++;
            continue; // Ignorar el registro y pasar al siguiente
        }

        // Verificar si el registro ya existe en la base de datos
        $consulta = "SELECT COUNT(*) AS count FROM tb_clientes WHERE nombre_cliente = '$nombre_cliente' AND nit_cliente = '$nit_cliente'";
        $resultado = mysqli_query($con, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        $existeRegistro = $fila['count'] > 0;

        if (!$existeRegistro && !in_array($nombre_cliente . $nit_cliente, $registrosUnicos)) {
            // Escapar los valores para evitar problemas en la consulta SQL
            $nombre_cliente = mysqli_real_escape_string($con, $nombre_cliente);
            $nit_cliente = mysqli_real_escape_string($con, $nit_cliente);
            $correo = mysqli_real_escape_string($con, $correo);
            $placa_auto = mysqli_real_escape_string($con, $placa_auto);
            $estado = mysqli_real_escape_string($con, $estado);
            $nit_compartido = mysqli_real_escape_string($con, $nit_compartido);
            $placa_auto_dos = !empty($placa_auto_dos) ? mysqli_real_escape_string($con, $placa_auto_dos) : null;
            $fyh_actualizacion = date('Y-m-d H:i:s'); 
            $fyh_eliminacion =  date('Y-m-d H:i:s'); 
            $fecha_asignacion = date('Y-m-d H:i:s'); 

            $fecha_asignacion_comp = date('Y-m-d H:i:s'); 

            $fyh_creacion = date('Y-m-d H:i:s'); // Fecha y hora de creación actual

            $insertar = "INSERT INTO tb_clientes( 
                nombre_cliente,
                nit_cliente,
                correo,
                placa_auto,
                estado,
                nit_compartido,
                placa_auto_dos,
                fyh_actualizacion,
                fyh_eliminacion,
                fecha_asignacion,
                fecha_asignacion_comp,
                fyh_creacion
            ) VALUES (
                '$nombre_cliente',
                '$nit_cliente',
                '$correo',
                '$placa_auto',
                '$estado',
                '$nit_compartido',
                '$placa_auto_dos',
                '$fyh_actualizacion',
                '$fyh_eliminacion',
                '$fecha_asignacion',
                '$fecha_asignacion_comp',
                '$fyh_creacion'
            )";

            mysqli_query($con, $insertar);

            if (mysqli_errno($con)) {
                echo "Error en la inserción de registros: " . mysqli_error($con);
                exit();
            }

            $registrosInsertados++;

            $registrosUnicos[] = $nombre_cliente . $nit_cliente;
        } else {
            $registrosIgnorados++;
            $registrosRepetidos++;
        }
    }

    echo '<div>' . $i . "). " . $linea . '</div>';
    $i++;
}

echo '<p style="text-align:center; color:#333;">Total de Registros: ' . $cantidad_regist_agregados . '</p>';
echo '<p style="text-align:center; color:#333;">Registros Insertados: ' . $registrosInsertados . '</p>';
echo '<p style="text-align:center; color:#333;">Registros Ignorados (Repetidos o invalidos): ' . $registrosIgnorados . '</p>';

?>

<a href="index.php">Atras</a>
