<?php 
include('../app/config.php');

if ($buzon !== 'on') {
    // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: ' . $URL . '/login');
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
        
            <h2>Hacer una Solicitud</h2>
            
            <br>
            <div class="container"> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="border:1px solid #606060;">
                            <div class="card-header" style="background-color: #007bff; color:#ffff;">
                            <h3> Nueva Solicitud </h3>
                            </div>
                            <div class="card-body">

                            <div class="form-group">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="nombre">
                            </div>

                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="email" class="form-control" id="email">
                            </div>

                            <div class="form-group">
                                <label for="">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion">
                            </div>

     
                            <div class="form-group">
                                <button class="btn btn-primary" id="btn_mandar"> Mandar </button>
                                <a href="<?php echo $URL;?>//"  class="btn btn-default">Cancelar</a>
                            </div>

                            <div id="respuesta">
                            </div>
                            
                            </div>
                        </div>
                    </div>    
                    <div class="col-md-6"></div>
                </div>  
            </div>


    
        </div>
  </div>
  <?php include('../layout/admin/footer.php');?>
  <?php include('../layout/admin/footer_links.php');?>


</div>

</body>
</html>

<script>
    $('#btn_mandar').click(function(){
        var nombre = $ ('#nombre').val();
        var correo = $ ('#correo').val();
        var descripcion = $ ('#descripcion').val();


      if (nombre =="") {
              alert ('Debe llenar el campo nombre');
              $('#nombre').focus();
      }else if (correo ==""){
              alert ('Debe llenar el campo correo');
              $('#correo').focus();
      }else if (descripcion ==""){
              alert ('Debe subir una descripcion');
              $('#descripcion').focus();
      }
      else{
              var url = 'controller_create.php';
              $.get(url , {nombre:nombre , correo:correo , descripcion:descripcion}, function(datos){
                    $('#respuesta').html(datos);
        });
      }
    });
</script>