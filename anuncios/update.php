<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($anuncios !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = $_FILES['imagen'];

    if ($titulo == "") {
        echo "Debe llenar el campo titulo";
    } elseif ($descripcion == "") {
        echo "Debe llenar el campo descripcion";
    } elseif ($imagen['error'] == 4) {
        echo "Debe subir una imagen";
    } else {
        // Ruta de destino para guardar la imagen
        $destino = '../ruta/donde/guardar/la/imagen.jpg';

        // Obtener las dimensiones de la imagen original
        $imagen_original = imagecreatefromjpeg($imagen['tmp_name']);
        $ancho_original = imagesx($imagen_original);
        $alto_original = imagesy($imagen_original);

        // Calcular las nuevas dimensiones para redimensionar la imagen
        $nuevo_ancho = 1920;
        $nuevo_alto = 1080;

        // Crear una nueva imagen con las dimensiones redimensionadas
        $imagen_redimensionada = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

        // Redimensionar la imagen original a la nueva imagen
        imagecopyresampled($imagen_redimensionada, $imagen_original, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);

        // Guardar la imagen redimensionada en el destino
        imagejpeg($imagen_redimensionada, $destino, 100);

        // Guardar el título, descripción y ruta de la imagen en la base de datos u otro proceso necesario
        // ...

        echo "Imagen subida y redimensionada correctamente";
    }

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
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">


                            <?php
                            $id_anuncio_get = $_GET['id_anuncio'];
                            $query_anuncios = $pdo->prepare("SELECT *
                                FROM tb_anuncios 
                                WHERE id_anuncio = :id_anuncio AND estado = '1'");

                            $query_anuncios->bindParam(':id_anuncio', $id_anuncio_get, PDO::PARAM_INT);
                            $query_anuncios->execute();
                            $datos_anuncios = $query_anuncios->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($datos_anuncios as $datos_anuncio) {
                                $id_anuncio = $datos_anuncio['id_anuncio'];
                                $titulo = $datos_anuncio['titulo'];
                                $descripcion = $datos_anuncio['descripcion'];
                                $imagen = $datos_anuncio['imagen'];
                                $fyh_creacion = $datos_anuncio['fyh_creacion'];
                                $fyh_actualizacion = $datos_anuncio['fyh_actualizacion'];
                                $fyh_eliminacion = $datos_anuncio['fyh_eliminacion'];
                                $estado = $datos_anuncio['estado'];
                            }
                            ?>


                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h3> Actualizar anuncio </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Título </label>
                                        <input type="text" class="form-control" id="titulo" value="<?php echo $titulo; ?>" oninput="verificarLongitudTitulo()">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Descripción </label>
                                        <input type="text" class="form-control" id="descripcion" value="<?php echo $descripcion; ?>" oninput="verificarLongitudDescripcion()">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Imagen</label>
                                        <center><img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen del anuncio" width="260" height="170" class="img-fluid"></center>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Suba una imagen</label>
                                        <input type="file" class="form-control-file" id="imagen">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-success" id="btn_guardar"> Actualizar </button>
                                        <a href="<?php echo $URL; ?>/anuncios/index.php" class="btn btn-secondary">Cancelar</a>
                                    </div>

                                    <div id="respuesta"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../layout/admin/footer.php'); ?>
        <?php include('../layout/admin/footer_links.php'); ?>
    </div>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn_guardar').click(function(e) {
            e.preventDefault();

            var titulo = $('#titulo').val();
            var descripcion = $('#descripcion').val();
            var imagen = $('#imagen')[0].files[0];

            if (titulo == "") {
                alert('Debe llenar el campo Título');
                $('#titulo').focus();
            } else if (descripcion == "") {
                alert('Debe llenar el campo Descripción');
                $('#descripcion').focus();
            
            } else {
                var formData = new FormData();
                formData.append('titulo', titulo);
                formData.append('descripcion', descripcion);
                formData.append('imagen', imagen);

                $.ajax({
                    url: 'controller_update.php?id_anuncio=<?php echo $id_anuncio; ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#respuesta').html(response);
                    },
                    error: function() {
                        alert('Error al enviar la solicitud AJAX');
                    }
                });
            }
        });
    });


    function verificarLongitudTitulo() {
        var titulo = document.getElementById('titulo').value;

        if (titulo.length > 100) {
            alert("El título no debe exceder los 100 caracteres");
        }
    }

    function verificarLongitudDescripcion() {
        var descripcion = document.getElementById('descripcion').value;

        if (descripcion.length > 500) {
            alert("La descripción no debe exceder los 500 caracteres");
        }
    }
</script>