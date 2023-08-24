<?php
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php');

// cargar el encabezado
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

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 004');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

$PDF_HEADER_TITLE = $nombre_parqueo;
$PDF_HEADER_STRING = $direccion . ' Telf: ' . $telefono;
$PDF_HEADER_LOGO = 'saga.png';


// set default header data
$pdf->setHeaderData($PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// -------------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 11);

// add a page
$pdf->AddPage();

// create the table content with styles
$html = '
<div style="margin-top: 20px;">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">Nombre y apellido</th>
                <th class="text-center">Nit o ci</th>
                <th class="text-center">Nro de recibo</th>
                <th class="text-center">Monto total</th>
                <th class="text-center">Fecha de pago</th>
            </tr>
        </thead>
        <tbody>';

$contador = 0;
$query_pago = $pdo->prepare("SELECT
    c.nombre_cliente,
    c.nit_cliente,
    c.correo,
    f.nro_factura,
    f.ultimo_precio,
    p.fyh_creacion
FROM
    tb_clientes c
JOIN
    tb_facturaciones f ON c.id_cliente = f.cliente_id
JOIN
    (
    SELECT
        nro_factura,
        MAX(fyh_creacion) AS fyh_creacion
    FROM
        tb_pagos
    GROUP BY
        nro_factura
    ) p ON f.nro_factura = p.nro_factura;");
$query_pago->execute();
$pagos = $query_pago->fetchAll(PDO::FETCH_ASSOC);

foreach ($pagos as $pago) {
    $nombre_cliente = $pago['nombre_cliente'];
    $nit_cliente = $pago['nit_cliente'];
    $nro_factura = $pago['nro_factura'];
    $ultimo_precio = $pago['ultimo_precio'];
    $fyh_creacion = $pago['fyh_creacion'];

    $html .= '
    <tr>
        <td class="text-center">' . $nombre_cliente . '</td>
        <td class="text-center">' . $nit_cliente . '</td>
        <td class="text-center">' . $nro_factura . '</td>
        <td class="text-center">' . $ultimo_precio . '</td>
        <td class="text-center">' . $fyh_creacion . '</td>
    </tr>';
}

$html .= '
        </tbody>
    </table>
</div>';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('example_004.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
