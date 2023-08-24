<?php
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php');

if (isset($_GET['id'])) {
    $factura_id = $_GET['id'];

    // Consulta para cargar el encabezado
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

    // Consulta para cargar la información de la factura
    $query_facturaciones = $pdo->prepare("SELECT * FROM tb_facturaciones WHERE id_factura = :factura_id AND estado = '1' ");
    $query_facturaciones->bindParam(':factura_id', $factura_id);
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

    // Consulta para cargar la información del cliente
    $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = :cliente_id AND estado = '1' ");
    $query_clientes->bindParam(':cliente_id', $cliente_id);
    $query_clientes->execute();
    $clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
    foreach ($clientes as $cliente) {
        $nombre_cliente = $cliente['nombre_cliente'];
        $nit_cliente = $cliente['nit_cliente'];
    }

    // Crear nuevo documento PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(70, 170), true, 'UTF-8', false);

    // Establecer información del documento
    $pdf->setCreator(PDF_CREATOR);
    $pdf->setAuthor('Nicola Asuni');
    $pdf->setTitle('Reimpresión de Factura');
    $pdf->setSubject('Reimpresión de Factura');
    $pdf->setKeywords('TCPDF, PDF, factura, reimpresión');

    // Eliminar encabezado/pie de página predeterminados
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Establecer fuente monoespaciada predeterminada
    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Establecer márgenes
    $pdf->setMargins(4, 1, 4);

    // Habilitar salto de página automático
    $pdf->setAutoPageBreak(TRUE, 1);

    // Establecer escala de imagen
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Configurar algunas cadenas dependientes del idioma (opcional)
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // Agregar una página al PDF
    $pdf->AddPage();

    // Construir HTML para el contenido del PDF
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

    // Agregar el contenido HTML al PDF
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
    $pdf->write2DBarcode($QR, 'QRCODE,L',  18, 110, 35, 35, $style);

    // Cerrar y generar el documento PDF
    $pdf->Output('reimpresion_factura.pdf', 'I');
} else {
    echo "ID de factura no especificado.";
}
?>
