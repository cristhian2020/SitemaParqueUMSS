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
        echo "Debe llenar el campo título";
    } elseif ($descripcion == "") {
        echo "Debe llenar el campo descripción";
    } elseif ($imagen['error'] == 4) {
        echo "Debe subir una imagen";
    } else {
        // Ruta de destino para guardar la imagen
        $nombre_archivo = $imagen['name'];
        $destino = '../ruta/donde/guardar/' . $nombre_archivo;

        // Obtener la extensión del archivo
        $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

        // Validar la extensión del archivo
        $extensiones_permitidas = array('jpg', 'jpeg');
        if (!in_array($extension, $extensiones_permitidas)) {
            echo "La extensión del archivo no es válida. Se permiten solo archivos JPG o JPEG.";
            exit();
        }

        // Redimensionar la imagen utilizando la biblioteca GD
        $imagen_original = imagecreatefromjpeg($imagen['tmp_name']);
        $ancho_original = imagesx($imagen_original);
        $alto_original = imagesy($imagen_original);
        $nuevo_ancho = 320;
        $nuevo_alto = 320;
        $imagen_redimensionada = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
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
                            <div class="card">
                                <div class="card-header" style="background-color: #007bff; color:#ffff;">
                                    <h3> Nuevo anuncio </h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="titulo">Título</label>
                                        <input type="text" class="form-control" id="titulo" oninput="verificarLongitudTitulo()">
                                    </div>

                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input type="text" class="form-control" id="descripcion" oninput="verificarLongitudDescripcion()">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Suba una imagen</label>
                                        <input type="file" class="form-control-file" id="imagen" accept="image/jpeg">
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" id="btn_guardar"> Guardar </button>
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
                    url: 'controller_create.php',
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