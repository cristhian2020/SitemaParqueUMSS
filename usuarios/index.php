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
        <h2>Listado de usuarios</h2>
        <br>
        <a href="reporte.php" class="btn btn-primary">Generar reporte
          <i class="fa fa">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-bar-graph" viewBox="0 0 16 16">
              <path d="M10 13.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-6a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v6zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z" />
              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z" />
            </svg>
          </i>
        </a>

        <!-- Agregar el botón de exportar como PDF -->

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
                <th scope="col">
                  <center>Acción</center>
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
                  <td class="d-flex justify-content-center">
                    <a href="update.php?id=<?php echo $id; ?>" class="btn btn-success mr-2">Actualizar</a>
                    <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Eliminar</a>
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