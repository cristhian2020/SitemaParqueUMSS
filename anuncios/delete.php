<?php 
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

if ($anuncios !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: '.$URL.'/login');
    exit();
  }

  
?>

<!DOCTYPE html>

<html lang="es">
<head>
        <?php include('../layout/admin/head.php');?>
</head>


<body class="hold-transition sidebar-mini">
<div class="wrapper">

 <?php include('../layout/admin/menu.php');?>

  <div class="content-wrapper">
   <br>
     <div class="container">
     <?php

     $id_anuncio_get = $_GET['id_anuncio'];
         $query_anuncio = $pdo->prepare("SELECT * FROM tb_anuncios WHERE id_anuncio ='$id_anuncio_get' AND estado = '1 ' ");
         $query_anuncio->execute();
         $anuncios = $query_anuncio->fetchAll(PDO::FETCH_ASSOC);

            foreach($anuncios as $anuncio){
                $id_anuncio = $anuncio['id_anuncio'];
                $titulo = $anuncio['titulo'];
                $descripcion = $anuncio['descripcion'];
                $imagen = $anuncio['imagen'];
           }
     ?>
        
            
            <br>
            <br>
            <div class="container"> 
                <div class="row">
                    <div class="col-md-6">
                    <div class="card card-danger ">
              <div class="card-header">
                <h3 class="card-title"> ¿Estas seguro de eliminar este anuncio?</h3>
                
              </div>
             
              <div class="card-body">
              <div class="form-group">
                                <label for="">Título</label>
                                <input type="text" class="form-control" id="titulo" value="<?php echo $titulo;?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" value="<?php echo $descripcion;?>"disabled>
                            </div>

                            <div class="form-group">
                                <label for="">Imagen</label>
                                <center><img src="data:image/jpeg;base64,<?php echo base64_encode($imagen); ?>" alt="Imagen del anuncio" width="260" height="170" class="img-fluid" disabled></center>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-danger" id="btn_borrar"> Eliminar </button>
                                <a href="<?php echo $URL;?>/anuncios/index.php" class="btn btn-secondary">Cancelar</a>
                            </div>

                            <div id="respuesta">
                            </div>
                            
                            </div>
              </div>
              
            </div>

                    </div>    
                    <div class="col-md-6"></div>
                </div>  
            </div>


    
        </div>
  <?php include('../layout/admin/footer.php');?>
  </div>

  <?php include('../layout/admin/footer_links.php');?>


</div>

</body>
</html>
<script>
    $('#btn_borrar').click(function () {

        var id_anuncio = '<?php echo $id_anuncio = $_GET['id_anuncio'];?>';

        var url = 'controller_delete.php';
        $.get(url,{id_anuncio:id_anuncio},function (datos) {
            $('#respuesta').html(datos);
        });

    });
    
</script>