<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($pagos !== 'on') {
  // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
  header('Location: ' . $URL . '/login');
  exit();
}

$totalPrecios = 0;

// Obtener los meses y años actuales
$meses = array(
  1 => 'Enero',
  2 => 'Febrero',
  3 => 'Marzo',
  4 => 'Abril',
  5 => 'Mayo',
  6 => 'Junio',
  7 => 'Julio',
  8 => 'Agosto',
  9 => 'Septiembre',
  10 => 'Octubre',
  11 => 'Noviembre',
  12 => 'Diciembre'
);

$anioActual = date('Y');
$ultimosAnios = array($anioActual, $anioActual - 1, $anioActual - 2, $anioActual - 3, $anioActual - 4);

$mesSeleccionado = isset($_GET['mes']) ? $_GET['mes'] : null;
$anioSeleccionado = isset($_GET['anio']) ? $_GET['anio'] : null;

$fechaInicio = null;
$fechaFin = null;

if ($mesSeleccionado && $anioSeleccionado) {
  $fechaInicio = $anioSeleccionado . '-' . $mesSeleccionado . '-01';
  $fechaFin = $anioSeleccionado . '-' . $mesSeleccionado . '-31';
}

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
        <h2>Pagos</h2>
        <p>Selecciona el mes y año que desea buscar</p>

        <form action="" method="GET" class="form-inline">
          <div class="form-group">
            <label for="mes" class="mr-2">Mes:</label>
            <select name="mes" id="mes" class="form-control mr-2">
              <?php foreach ($meses as $numeroMes => $nombreMes) {
                $selected = ($mesSeleccionado == $numeroMes) ? 'selected' : '';
                echo '<option value="' . $numeroMes . '" ' . $selected . '>' . $nombreMes . '</option>';
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="anio" class="mr-2">Año:</label>
            <select name="anio" id="anio" class="form-control mr-2">
              <?php foreach ($ultimosAnios as $anio) {
                $selected = ($anioSeleccionado == $anio) ? 'selected' : '';
                echo '<option value="' . $anio . '" ' . $selected . '>' . $anio . '</option>';
              } ?>
            </select>
          </div>
          <div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="index.php" class="btn btn-dark">Refrescar</a>
          </div>
        </form>


        <br>

        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th class="text-center" colspan="7">
                  Todas las fechas
                </th>
              </tr>
              <tr>
                <th class="text-center">Nombre y apellido</th>
                <th class="text-center">Nit o Ci</th>
                <th class="text-center">Nro de factura</th>
                <th class="text-center">Monto total</th>
                <th class="text-center">Fecha de pago</th>
                <th class="text-center">Estado</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $contador_pago = 0;
              $query_pagos = $pdo->prepare("SELECT p.*, c.nombre_cliente, c.nit_cliente, f.fyh_creacion AS fyh_creacion_facturacion, f.ultimo_precio
                        FROM tb_pagos p
                        INNER JOIN tb_facturaciones f ON p.nro_factura = f.nro_factura
                        INNER JOIN tb_clientes c ON f.cliente_id = c.id_cliente
                        WHERE (:fechaInicio IS NULL OR p.fyh_creacion >= :fechaInicio)
                        AND (:fechaFin IS NULL OR p.fyh_creacion <= :fechaFin)");
              $query_pagos->bindParam(':fechaInicio', $fechaInicio);
              $query_pagos->bindParam(':fechaFin', $fechaFin);
              $query_pagos->execute();

              $datos_pagos = $query_pagos->fetchAll(PDO::FETCH_ASSOC);

              foreach ($datos_pagos as $datos_pago) {
                $nombre_cliente = $datos_pago['nombre_cliente'];
                $nit_cliente = $datos_pago['nit_cliente'];
                $nro_factura = $datos_pago['nro_factura'];
                $ultimo_precio = $datos_pago['ultimo_precio'];
                $fyh_creacion = $datos_pago['fyh_creacion'];

                if (date('Y-m', strtotime($fyh_creacion)) === date('Y-m', strtotime($datos_pago['fyh_creacion_facturacion']))) {
                  $estado_pago = 'CORRECTO';
                } elseif (strtotime($fyh_creacion) > strtotime($datos_pago['fyh_creacion_facturacion'])) {
                  $estado_pago = 'DEMORADO';
                } else {
                  $estado_pago = 'ADELANTADO';
                }

                echo '<tr>
                        <td class="text-center">' . $nombre_cliente . '</td>
                        <td class="text-center">' . $nit_cliente . '</td>
                        <td class="text-center">' . $nro_factura . '</td>
                        <td class="text-center">' . $ultimo_precio . '</td>
                        <td class="text-center">' . $fyh_creacion . '</td>
                        <td class="text-center">' . $estado_pago . '</td>
                      </tr>';

                $totalPrecios += $ultimo_precio;
              }
              ?>
            </tbody>

            <tr>
              <td class="text-right" colspan="3"><strong>Total:</strong></td>
              <td class="text-center"><strong><?php echo $totalPrecios; ?></strong></td>
              <td class="text-center" colspan="2"></td>
            </tr>
          </table>
        </div>

        <button id="exportarPdfBtn" class="btn btn-primary">Exportar como PDF</button>
      </div>
    </div>
    <?php include('../layout/admin/footer.php'); ?>
  </div>
  <?php include('../layout/admin/footer_links.php'); ?>
  <script>
    function exportarComoPdf() {
      const contenedorTabla = document.querySelector('.table');

      const opciones = {
        scale: 8,
        useCORS: true,
        logging: true
      };

      html2canvas(contenedorTabla, opciones).then(function(canvas) {
        const pdf = new jsPDF('p', 'mm', 'a4');

        const imgData = canvas.toDataURL('image/png');

        pdf.addImage(imgData, 'PNG', 10, 10, 190, 0);

        pdf.save('pagos.pdf');
      });
    }

    const exportarPdfBtn = document.getElementById('exportarPdfBtn');
    exportarPdfBtn.addEventListener('click', exportarComoPdf);
  </script>
</body>

</html>