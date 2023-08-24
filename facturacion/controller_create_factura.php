<?php
include('../app/config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$nit_cliente = $_GET['nit_cliente'];
$mes = $_GET['mes'];
$ultimo_precio = $_GET['ultimo_precio'];
$fechaHora = date("Y-m-d H:i:s");
$estado_del_registro = 1;
$estado_factura = "NO PAGADO";

// Obtener el último número de factura almacenado en la base de datos
$query_ultima_factura = $pdo->prepare("SELECT MAX(nro_factura) AS ultimo_nro_factura FROM tb_facturaciones");
$query_ultima_factura->execute();
$ultimo_nro_factura = $query_ultima_factura->fetch(PDO::FETCH_ASSOC)['ultimo_nro_factura'];

// Incrementar el último número de factura en 1 para generar el siguiente número de factura
$nuevo_nro_factura = $ultimo_nro_factura + 1;

// Buscar el cliente correspondiente
$sentencia_buscar_cliente = $pdo->prepare('SELECT id_cliente FROM tb_clientes WHERE nombre_cliente = :nombre_cliente AND nit_cliente = :nit_cliente');
$sentencia_buscar_cliente->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia_buscar_cliente->bindParam(':nit_cliente', $nit_cliente);
$sentencia_buscar_cliente->execute();
$resultado_buscar_cliente = $sentencia_buscar_cliente->fetch();
$id_cliente = $resultado_buscar_cliente['id_cliente'];

// Insertar factura en tb_facturaciones
$sentencia_insertar_factura = $pdo->prepare('INSERT INTO tb_facturaciones (nro_factura, mes, ultimo_precio, cliente_id, fyh_creacion, estado_factura, estado)
VALUES (:nro_factura, :mes, :ultimo_precio, :cliente_id, NOW(), :estado_factura, :estado)');
$sentencia_insertar_factura->bindParam(':nro_factura', $nuevo_nro_factura);
$sentencia_insertar_factura->bindParam(':mes', $mes);
$sentencia_insertar_factura->bindParam(':ultimo_precio', $ultimo_precio);
$sentencia_insertar_factura->bindParam(':cliente_id', $id_cliente);
$sentencia_insertar_factura->bindParam(':estado_factura', $estado_factura);
$sentencia_insertar_factura->bindParam(':estado', $estado_del_registro);

if ($sentencia_insertar_factura->execute()) {
   // echo 'Registro satisfactorio';
?>
    <script>
       // location.href = "generar_factura.php";
    </script>
<?php
} else {
    ?>
    <script>
        alert("No se pudo registrar en la base de datos");
    </script>
    <?php
}
?>
