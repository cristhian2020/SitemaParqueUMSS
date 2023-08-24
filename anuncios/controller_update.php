<?php
include('../app/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $id_anuncio = $_GET['id_anuncio'];

    $imagen_blob = file_get_contents($_FILES['imagen']['tmp_name']);

    date_default_timezone_set("America/Caracas");
    $fechaHora = date("Y-m-d h:i:s");

    $sentencia = $pdo->prepare("UPDATE tb_anuncios SET 
                                    titulo = :titulo,
                                    descripcion = :descripcion,
                                    imagen = :imagen,
                                    fyh_actualizacion = :fyh_actualizacion
                                WHERE id_anuncio = :id_anuncio");

    $sentencia->bindParam(':titulo', $titulo);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':imagen', $imagen_blob, PDO::PARAM_LOB);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':id_anuncio', $id_anuncio);

    if ($sentencia->execute()) {
?>
        <script>
            alert("Anuncio guardado exitosamente");
            location.href = "index.php";
        </script>
<?php
    } else {
        echo "No se pudo actualizar en la base de datos";
    }
}
?>