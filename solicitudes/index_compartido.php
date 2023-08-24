<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($buzon !== 'on') {
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

        <h2>Listado de compartidos</h2>
        <br>

        <div class="col-md-12">
          <a href="index_solicitud.php" class="btn btn-primary">Solicitudes</a>
          <a href="index_reclamo.php" class="btn btn-primary">Reclamos</a>
          <a href="index_compartido.php" class="btn btn-primary">Compartidos</a>
          <a href="index.php" class="btn btn-primary">Otros</a>


        </div>

        <br>
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th>
                  <center>Nro</center>
                </th>
                <th>
                  <center>Nombre</center>
                </th>
                <th>
                  <center>Nit o Ci</center>
                </th>
                <th>
                  <center>Correo electrónico</center>
                </th>
                <th>
                  <center>Descripción</center>
                </th>
                <th>
                  <center>Fecha</center>
                </th>
                <th>
                  <center>Acción</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $contador = 0;
              $query_solicitud = $pdo->prepare("SELECT s.id_solicitud, c.nit_cliente, c.nombre_cliente, c.correo, s.descripcion, s.fyh_creacion
                                        FROM tb_solicitudes s
                                        INNER JOIN tb_clientes c ON s.cliente_id = c.id_cliente
                                        WHERE s.estado = '1' AND s.asunto = 'ESPACIO COMPARTIDO'");
              $query_solicitud->execute();
              $solicitudes = $query_solicitud->fetchAll(PDO::FETCH_ASSOC);

              foreach ($solicitudes as $solicitud) {
                $nombres = $solicitud['nombre_cliente'];
                $email = $solicitud['correo'];
                //$asunto = $solicitud['asunto'];
                $descripcion = $solicitud['descripcion'];
                $nit_cliente = $solicitud['nit_cliente'];
                $fyh_creacion = $solicitud['fyh_creacion'];
                $id_solicitud = $solicitud['id_solicitud'];

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
                    <center><?php echo $nit_cliente; ?></center>
                  </td>
                  <td>
                    <center><?php echo $email; ?> </center>
                  </td>
                  <td>
                    <center><?php echo $descripcion; ?> </center>
                  </td>
                  <td>
                    <center><?php echo $fyh_creacion; ?> </center>
                  </td>
                  <td>
                    <center>
                      <a href="delete.php?id_solicitud=<?php echo $id_solicitud; ?>" class="btn btn-danger">Eliminar</a>
                    </center>
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