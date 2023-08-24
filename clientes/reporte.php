<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
if ($clientes !== 'on') {
    
    header('Location: ' . $URL . '/login');
    exit();
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
            <br>
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h2>Reporte de clientes</h2>
                        <br>

                        <button type="button" class="btn btn-primary" id="exportarPdfBtn">Exportar como PDF</button>
                        <a href="index.php" class="btn btn-info">Regresar</a>
                        </a>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>
                                            <center>Nro</center>
                                        </th>
                                        <th class="text-center">Nombre y apellido</th>
                                        <th class="text-center">Nit/Ci</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Placa 1</th>
                                        <th class="text-center">Placa 2</th>
                                        <th class="text-center">Compartido</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
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
                                    ?>

                                        <tr>
                                            <td>
                                                <center><?php echo $contador_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nombre_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nit_cliente; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $correo; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $placa_auto; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $placa_auto_dos; ?></center>
                                            </td>
                                            <td>
                                                <center><?php echo $nit_compartido; ?></center>
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




            </div>




        </div>
        <!-- /.content-wrapper -->
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>


<script>
    
    function exportarComoPdf() {
        // Obtener el elemento contenedor de la tabla
        const contenedorTabla = document.querySelector('.table');

        // Opciones de captura para aumentar la calidad
        const opciones = {
            scale: 2, 
            useCORS: true 
        };

        // Capturar la imagen del contenedor utilizando html2canvas con las opciones
        html2canvas(contenedorTabla, opciones).then(function(canvas) {
            // Convertir el canvas a imagen base64
            const imagenBase64 = canvas.toDataURL("image/png");

            // Crear un objeto jsPDF
            const doc = new jsPDF();

            // Agregar el encabezado al documento PDF
            doc.setFontSize(14); 
            doc.text("Parqueo UMSS - FCYT", 105, 20, {
                align: "center"
            }); 

            
            doc.addImage(imagenBase64, 'PNG', 10, 30, 190, 0);



            // Guardar el documento PDF
            doc.save('tabla_clientes.pdf');

        });
    }

    
    const exportarPdfBtn = document.getElementById('exportarPdfBtn');
    exportarPdfBtn.addEventListener('click', exportarComoPdf);
</script>