<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($recibos !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../layout/admin/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../layout/admin/menu.php'); ?>
        <div class="content-wrapper">
            <br>
            <div class="container">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $id_cliente_get = $_GET['id'];
                        $query_clientes = $pdo->prepare("SELECT *
                                                     FROM tb_clientes 
                                                     WHERE id_cliente = '$id_cliente_get' AND estado = '1'");
                        $query_clientes->execute();
                        $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($datos_clientes as $datos_cliente) {
                            $id_cliente = $datos_cliente['id_cliente'];
                            $nombre_cliente = $datos_cliente['nombre_cliente'];
                            $nit_cliente = $datos_cliente['nit_cliente'];
                            $placa_auto = $datos_cliente['placa_auto'];
                            $placa_auto_dos = $datos_cliente['placa_auto_dos'];
                        }

                        // Obtener el último precio de la tabla tb_precios
                        $query_ultimo_precio = $pdo->prepare("SELECT precio FROM tb_precios ORDER BY id_precio DESC LIMIT 1");
                        $query_ultimo_precio->execute();
                        $ultimo_precio = $query_ultimo_precio->fetchColumn();

                        ?>

                        <div class="card card-outline card-primary">
                            <div class="card-header bg-primary text-white">
                                <h3>Emisión de un recibo</h3>
                            </div>

                            <div class="card-body" style="display: block;">
                                <p>Llene todos los datos</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nombre y apellido<span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="nombre_cliente" value="<?php echo $nombre_cliente; ?>" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Nit<span style="color: red"><b>*</b></span></label>
                                        <input type="number" class="form-control" id="nit_cliente" value="<?php echo $nit_cliente; ?>" disabled>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form group">
                                            <label for="">Mes <span style="color: red"><b>*</b></span></label>
                                            <select name="" id="mes" class="form-control col-md-3">
                                                <option value="ENERO">Enero</option>
                                                <option value="FEBRERO">Febrero</option>
                                                <option value="MARZO">Marzo</option>
                                                <option value="ABRIL">Abril</option>
                                                <option value="MAYO">Mayo</option>
                                                <option value="JUNIO">Junio</option>
                                                <option value="JULIO">Julio</option>
                                                <option value="AGOSTO">Agosto</option>
                                                <option value="SEPTIEMBRE">Septiembre</option>
                                                <option value="OCTUBRE">Octubre</option>
                                                <option value="NOVIEMBRE">Noviembre</option>
                                                <option value="DICIEMBRE">Diciembre</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Monto total<span style="color: red"><b>*</b></span></label>
                                        <input type="text" class="form-control" id="ultimo_precio" value="<?php echo $ultimo_precio; ?>" disabled>
                                    </div>
                                </div>

                                <br>

                                <div class="row">
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-block" id="btn_emitir" onclick="abrirEnOtraPestania()">
                                            Emitir
                                            <script>
                                                $('#btn_emitir').click(function() {
                                                    var nombre_cliente = $('#nombre_cliente').val();
                                                    var nit_cliente = $('#nit_cliente').val();
                                                    var nro_factura = $('#nro_factura').val();
                                                    var mes = $('#mes').val();
                                                    var ultimo_precio = $('#ultimo_precio').val();
                                                    var estado_factura = $('#estado_factura').val();

                                                    if (nombre_cliente == "") {
                                                        alert('Debe de llenar el campo nombre');
                                                        $('#nombre_cliente').focus();
                                                    } else if (nit_cliente == "") {
                                                        alert('Debe de llenar el campo nit');
                                                        $('#nit_cliente').focus();
                                                    } else if (nro_factura == "") {
                                                        alert('Debe de llenar el campo Nro de factura');
                                                        $('#nro_factura').focus();
                                                    } else if (mes == "") {
                                                        alert('Debe seleccionar un Mes');
                                                        $('#mes').focus();
                                                    } else {
                                                        //alert("esta listo para el controlador");
                                                        var url = 'controller_create_factura.php';
                                                        $.get(url, {
                                                            nombre_cliente: nombre_cliente,
                                                            nit_cliente: nit_cliente,
                                                            nro_factura: nro_factura,
                                                            mes: mes,
                                                            ultimo_precio: ultimo_precio,
                                                        }, function(datos) {
                                                            $('#respuesta_factura').html(datos);
                                                        });
                                                    }
                                                });

                                                function abrirEnOtraPestania() {
                                                    window.open("generar_factura.php", "_blank");
                                                }
                                            </script>
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="../facturacion/index.php" class="btn btn-secondary btn-block">Cancelar</a>
                                    </div>
                                </div>

                                <div id="respuesta_factura">

                                </div>

                            </div>
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