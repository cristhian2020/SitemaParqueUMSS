<?php
include('../app/config.php');
?>

<!DOCTYPE html>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="public/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Document</title>
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini">
  <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #003785;">
    <a class="navbar-brand" href="../index.php">
      <h1 href="index.php" width="20" height="30">
        <img src="<?php echo $URL; ?>/public/imagenes/saga.png" width="70" height="80" alt="" loading="lazy">
        FCyT
      </h1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../anuncios/ver_anuncio.php">ANUNCIOS</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../buzon/buzon.php">CONTACTANOS</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="../pagos/pagos.php">PAGOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../parqueo/index.php">ESPACIOS PARQUEO</a>
        </li>
      </ul>
    </div>
  </nav>

  <style>
    .info-anuncio {
      color: #005187;
      font-size: 25px;
      word-wrap: break-word;
      overflow-wrap: break-word;
    }

    /* Media query para pantallas más pequeñas */
    @media (max-width: 768px) {
      .info-anuncio {
        text-align: right;
        font-size: 20px;
      }
    }

    .content-wrapper {
      min-height: calc(100vh - 130px);
    }
  </style>

  <div class="wrapper">
    <div class="content-wrapper">
      <br>
      <div class="container">
        <br>
        <h2>Anuncios</h2>
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

                  
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <style>
    footer {
      background-color: #003785;
      color: #ffffff;
      padding: 10px;
      position: relative;
      width: 100%;
      margin-top: 20px;
    }
  </style>

  <footer>
    <div class="container-fluid">
      <?php include('../layout/admin/footer.php'); ?>
    </div>
  </footer>
</body>

</html>