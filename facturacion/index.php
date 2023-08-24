<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($recibos !== 'on') {
  // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
  header('Location: ' . $URL . '/login');
  exit();
}


if (isset($_POST['nit_cliente'])) {
  $nit = $_POST['nit_cliente'];
  // Agregar cláusula JOIN y WHERE para filtrar por NIT
  $query_facturas = $pdo->prepare("SELECT f.*, c.nombre_cliente, c.nit_cliente
                                     FROM tb_facturaciones f 
                                     JOIN tb_clientes c ON f.cliente_id = c.id_cliente 
                                     WHERE f.estado = '1' AND c.nit_cliente = :nit
                                     ORDER BY f.fyh_creacion DESC");
  $query_facturas->execute(array(':nit' => $nit));
} else {
  $query_facturas = $pdo->prepare("SELECT f.*, c.nombre_cliente, c.nit_cliente 
                                     FROM tb_facturaciones f 
                                     JOIN tb_clientes c ON f.cliente_id = c.id_cliente 
                                     WHERE f.estado = '1'
                                     ORDER BY f.fyh_creacion DESC");
  $query_facturas->execute();
}
$facturas = $query_facturas->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('../layout/admin/head.php'); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include('../layout/admin/menu.php'); ?>
    <div class="content-wrapper">
      <br>
      <div class="container">
        <h2>Recibos emitidos</h2>
        <form method="post">
          <div class="form-group">
            <label for="nit">Filtrar por NIT:</label>
            <input type="number" class="form-control col-sm-3" id="nit_cliente" name="nit_cliente" maxlength="20" min="0">
          </div>

          <button type="submit" class="btn btn-info">Filtrar</button>
          <a href="" class="btn btn-dark">Mostrar todos</a>
        </form>

        <br>
        <button type="button" class="btn btn-success d-none" id="capturarBtn">Capturar y guardar imagen</button>
        <!-- Agregar el botón de exportar como PDF -->
        <a href="reporte.php" type="button" class="btn btn-primary" id="exportarPdfBtn">Generar Reporte</a>
        <br>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th scope="col">
                  <center>Nombre y apellido</center>
                </th>
                <th scope="col">
                  <center>Nit</center>
                </th>
                <th scope="col">
                  <center>Nro de recibo</center>
                </th>
                <th scope="col">
                  <center>Monto total</center>
                </th>
                <th scope="col">
                  <center>Mes</center>
                </th>
                <th scope="col">
                  <center>Fecha</center>
                </th>
                <th scope="col">
                  <center>Estado</center>
                </th>
                <th scope="col">
                  <center>Acción</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($facturas as $factura) {
                $id_factura = $factura['id_factura'];
                $nombre_cliente = $factura['nombre_cliente'];
                $nit_cliente = $factura['nit_cliente'];
                $nro_factura = $factura['nro_factura'];
                $mes = $factura['mes'];
                $ultimo_precio = $factura['ultimo_precio'];
                $fecha_emision = $factura['fyh_creacion'];
                $estado_factura = $factura['estado_factura'];
              ?>
                <tr>
                  <td>
                    <center><?php echo $nombre_cliente; ?></center>
                  </td>
                  <td>
                    <center><?php echo $nit_cliente; ?> </center>
                  </td>
                  <td>
                    <center><?php echo $nro_factura; ?></center>
                  </td>
                  <td>
                    <center><?php echo $ultimo_precio;  ?> </center>
                  </td>
                  <td>
                    <center><?php echo $mes; ?></center>
                  </td>
                  <td>
                    <center><?php echo $fecha_emision; ?></center>
                  </td>
                  <td>
                    <center><?php echo $estado_factura; ?></center>
                  </td>
                  <td class="d-flex justify-content-center">
                    <a href="reinmprimirFctura.php?id=<?php echo $id_factura; ?>" class="btn btn-info">Reimprimir</a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
    <?php include('../layout/admin/footer.php'); ?>
  </div>
  <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>