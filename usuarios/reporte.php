<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
// Verificar si el usuario ha iniciado sesión
if ($usuarios !== 'on') {
  // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
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
      <div class="container">
        <h2>Generador de reporte de usuarios</h2>
        <br>

        <button type="button" class="btn btn-primary" id="exportarPdfBtn">Exportar como PDF</button>
        <a href="index.php" class="btn btn-info">Regresar</a>
        <br>
        <br>
        <div class="table-responsive">
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
            <tbody>
              <?php
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

              ?>
                <tr>
                  <td>
                    <center><?php echo $contador; ?> </center>
                  </td>
                  <td>
                    <center><?php echo $nombres; ?></center>
                  </td>
                  <td>
                    <center><?php echo $email; ?> </center>
                  </td>
                  <td>
                    <center><?php echo $nombre_rol; ?> </center>
                  </td>
                  <td>
                    <center><?php echo $turno; ?> </center>
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
<script>
  // Función para exportar la tabla como PDF
  function exportarComoPdf() {
    // Obtener el elemento contenedor de la tabla
    const contenedorTabla = document.querySelector('.table');

    // Opciones de captura para aumentar la calidad
    const opciones = {
      scale: 2, // Aumentar la escala del lienzo de captura (2 para el doble de resolución)
      useCORS: true // Habilitar el uso de CORS para capturar imágenes de otros dominios
    };

    // Capturar la imagen del contenedor utilizando html2canvas con las opciones
    html2canvas(contenedorTabla, opciones).then(function(canvas) {
      // Convertir el canvas a imagen base64
      const imagenBase64 = canvas.toDataURL("image/png");

      // Crear un objeto jsPDF
      const doc = new jsPDF();

      // Agregar el encabezado al documento PDF
      doc.setFontSize(14); // Tamaño de fuente del encabezado
      doc.text("Parqueo UMSS - FCYT", 105, 20, {
        align: "center"
      }); // Agregar el texto centrado en la posición (105, 20)

      // Agregar la imagen al documento PDF (como se muestra en tu código original)
      doc.addImage(imagenBase64, 'PNG', 10, 30, 190, 0);



      // Guardar el documento PDF
      doc.save('tabla_usuarios.pdf');

    });
  }

  // Agregar el evento de clic al botón de exportar como PDF
  const exportarPdfBtn = document.getElementById('exportarPdfBtn');
  exportarPdfBtn.addEventListener('click', exportarComoPdf);
</script>