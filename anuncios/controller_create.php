<?php
include('../app/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $imagen_blob = file_get_contents($_FILES['imagen']['tmp_name']);

    date_default_timezone_set("America/Caracas");
    $fechaHora = date("Y-m-d h:i:s");

    $sentencia = $pdo->prepare("INSERT INTO tb_anuncios
                                    (titulo, descripcion, imagen, fyh_creacion, estado) 
                               VALUES (:titulo, :descripcion, :imagen, :fyh_creacion, :estado)");

    $sentencia->bindParam(':titulo', $titulo);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':imagen', $imagen_blob, PDO::PARAM_LOB);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindValue(':estado', '1');

    if ($sentencia->execute()) {
?>
        <script>
            alert("Anuncio guardado exitosamente");
            location.href = "index.php";
        </script>
<?php
    } else {
        echo "No se pudo registrar en la base de datos";
    }
}
?>