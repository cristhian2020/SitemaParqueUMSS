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
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 004');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

$PDF_HEADER_TITLE = $nombre_parqueo;
$PDF_HEADER_STRING = $direccion . ' Telf: ' . $telefono;
$PDF_HEADER_LOGO = 'auto4.jpg';
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

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 11);

// add a page
$pdf->AddPage();

// create the table content with styles
$html = '
<table id="table_id" class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>
                <center>Nro</center>
            </th>
            <th>Nombre y apellido</th>
            <th>Nit/Ci</th>
            <th>Correo electrónico</th>
            <th>Placa 1</th>
            <th>Placa 2</th>
            <th>Compartido con:</th>
        </tr>
    </thead>
    <tbody>';

$contador_cliente = 0;
$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1'");
$query_clientes->execute();
$datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
foreach ($datos_clientes as $datos_cliente) {
    $contador_cliente = $contador_cliente + 1;
    $nombre_cliente = $datos_cliente['nombre_cliente'];
    $nit_cliente = $datos_cliente['nit_cliente'];
    $correo = $datos_cliente['correo'];
    $placa_auto = $datos_cliente['placa_auto'];
    $placa_auto_dos = $datos_cliente['placa_auto_dos'];
    $nit_compartido = $datos_cliente['nit_compartido'];
    $id_cliente = $datos_cliente['id_cliente'];

    $html .= '
    <tr>
        <td>
            <center>' . $contador_cliente . '</center>
        </td>
        <td>
            <center>' . $nombre_cliente . '</center>
        </td>
        <td>
            <center>' . $nit_cliente . '</center>
        </td>
        <td>
            <center>' . $correo . '</center>
        </td>
        <td>
            <center>' . $placa_auto . '</center>
        </td>
        <td>
            <center>' . $placa_auto_dos . '</center>
        </td>
        <td>
            <center>' . $nit_compartido . '</center>
        </td>
    </tr>';
}

$html .= '
    </tbody>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('example_004.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
