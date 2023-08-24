<?php
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php');


// create new PDF document
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set default header data

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
<h1 style="text-align: center;">Parqueo UMSS - FCYT</h1>

<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">
                <center>Nro</center>
            </th>
            <th scope="col">
                <center>Nombre y apellido</center>
            </th>
            <th scope="col">
                <center>Correo electrónico</center>
            </th>
            <th scope="col">
                <center>Rol</center>
            </th>
            <th scope="col">
                <center>Turno</center>
            </th>
            
        </tr>
    </thead>
    <tbody>';
$contador = 0;
$query_usuario = $pdo->prepare("SELECT u.id, u.nombres, u.email, u.turno, r.nombre_rol
FROM tb_usuarios u
JOIN tb_roles r ON u.rol_id = r.id_rol;");

$query_usuario->execute();
$usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $id = $usuario['id'];
    $nombres = $usuario['nombres'];
    $email = $usuario['email'];
    $turno = $usuario['turno'];
    $nombre_rol = $usuario['nombre_rol'];

    $contador = $contador + 1;

    $html .= '
<tr>
    <td>
        <center>' . $contador . '</center>
    </td>
    <td>
        <center>' . $nombres . '</center>
    </td>
    <td>
        <center>' . $email . '</center>
    </td>
    <td>
        <center>' . $nombre_rol . '</center>
    </td>
    <td>
        <center>' . $turno . '</center>
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
