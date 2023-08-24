<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if (!isset($_SESSION['usuario_sesion'])) {
  // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
  header('Location: '.$URL.'/login');
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
        <h2>Anuncios</h2>
        <br>
        <div class="row">
          <?php
          $contador = 0;
          $query_anuncio = $pdo->prepare("SELECT * FROM tb_anuncios WHERE estado = '1' ");
          $query_anuncio->execute();
          $anuncios = $query_anuncio->fetchAll(PDO::FETCH_ASSOC);

          foreach ($anuncios as $anuncio) {
            $id_anuncio = $anuncio['id_anuncio'];
            $titulo = $anuncio['titulo'];
            $descripcion = $anuncio['descripcion'];
            $imagen = $anuncio['imagen'];
            $contador = $contador + 1;
          ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <?php if (!empty($imagen)) { ?>
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen del anuncio" width="320" height="320" class="card-img-top">
                <?php } ?>
                <div class="card-body">
                  <h3 class="card-title"><strong><?php echo $titulo; ?></strong></h3>
                  <p class="card-text"><?php echo $descripcion; ?></p>

                  <a href="update.php?id_anuncio=<?php echo $id_anuncio; ?>" class="btn btn-success">Editar</a>
                  <a href="delete.php?id_anuncio=<?php echo $id_anuncio; ?>" class="btn btn-danger">Eliminar</a>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <?php include('../layout/admin/footer.php'); ?>
  </div>
  <?php include('../layout/admin/footer_links.php'); ?>
</body>

</html>
