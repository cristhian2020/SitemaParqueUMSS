<?php
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php');


//consulta para cargar el encabezado
$query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' ");
$query_informacions->execute();
$informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);
foreach ($informacions as $informacion) {
    $id_informacion = $informacion['id_informacion'];
    $nombre_parqueo = $informacion['nombre_parqueo'];
    $actividad_empresa = $informacion['actividad_empresa'];
    $sucursal = $informacion['sucursal'];
    $direccion = $informacion['direccion'];
    $zona = $informacion['zona'];
    $telefono = $informacion['telefono'];
    $departamento_ciudad = $informacion['departamento_ciudad'];
    $pais = $informacion['pais'];
}
//cargar la informacion del ticket
$query_facturaciones = $pdo->prepare("SELECT * FROM tb_facturaciones WHERE estado = '1' ");
$query_facturaciones->execute();
$facturaciones = $query_facturaciones->fetchAll(PDO::FETCH_ASSOC);
foreach ($facturaciones as $factura) {
    $id_factura = $factura['id_factura'];
    $nro_factura = $factura['nro_factura'];
    $mes = $factura['mes'];
    $ultimo_precio = $factura['ultimo_precio'];
    $fyh_creacion = $factura['fyh_creacion'];
    $cliente_id = $factura['cliente_id'];
}

//cargar la informacion del cliente
$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = :cliente_id AND estado = '1' ");
$query_clientes->bindParam(':cliente_id', $cliente_id);
$query_clientes->execute();
$clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
foreach ($clientes as $cliente) {
    $nombre_cliente = $cliente['nombre_cliente'];
    $nit_cliente = $cliente['nit_cliente'];
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(70, 180), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(4, 1, 4);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 1);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->AddPage();

$html = '
    <div>
      <p style="text-align: center">
          <b>' . $nombre_parqueo . '</b> <br>
          ' . $actividad_empresa . ' <br>
         SUCURSAL No ' . $sucursal . ' <br>
             ' . $direccion . ' <br>
           ZONA: ' . $zona . ' <br>
           TELÉFONO: ' . $telefono . ' <br>
          ' . $departamento_ciudad . ' - ' . $pais . ' <br>
    ------------------------------------------ 
    <div style="text-align: left">
            <b>DATOS DEL CLIENTE</b> <br>
            <b>Señor(a): </b> ' . $nombre_cliente . ' <br>
            <b>Nit/Ci.: </b> ' . $nit_cliente . '  <br>
    -----------------------------------------<br>
        <b>Nro Recibo:</b> ' . $nro_factura . ' <br>
        <b>Mes: </b> ' . $mes . ' <br>
        <b>Monto total: </b> ' . $ultimo_precio . ' <br>
        <b>Fecha: </b> ' . $fyh_creacion . ' <br>
        
    -----------------------------------------<br>

           

    </div>
    </p>
   

</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'module_width' => 1,
    'module_height' => 1
);


$QR = $ultimo_precio;
$pdf->write2DBarcode($QR,'QRCODE,L',  18,110,35,35, $style);



// Close and output PDF document
$pdf->Output('example_002.pdf', 'I');
