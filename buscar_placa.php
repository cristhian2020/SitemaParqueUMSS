<?php
include('app/config.php');
include('layout/admin/datos_usuario_sesion.php');

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_sesion'])) {
  // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
  header('Location: ' . $URL . '/login');
  exit();
}

// Variable para almacenar el valor de la placa ingresada por el usuario
$placa = '';

// Verificar si se ha enviado el formulario de búsqueda
if (isset($_POST['placa'])) {
  $placa = $_POST['placa'];

  // Agregar cláusula WHERE para filtrar por placa
  $query_clientes = $pdo->prepare("SELECT tb_clientes.id_cliente, tb_clientes.nombre_cliente, tb_clientes.nit_cliente, tb_clientes.correo, tb_clientes.placa_auto, tb_clientes.placa_auto_dos, tb_mapeos.espacio, tb_mapeos.seccion
    FROM tb_mapeos
    INNER JOIN tb_clientes ON tb_mapeos.id_map = tb_clientes.map_id
    WHERE tb_mapeos.estado = '1' AND tb_mapeos.seccion IN ('A', 'B') AND (tb_clientes.placa_auto = :placa OR tb_clientes.placa_auto_dos = :placa)
    GROUP BY tb_mapeos.espacio");

  $query_clientes->execute(array(':placa' => $placa));
} else {
  $query_clientes = $pdo->prepare("SELECT tb_clientes.id_cliente, tb_clientes.nombre_cliente, tb_clientes.nit_cliente, tb_clientes.correo, tb_clientes.placa_auto, tb_clientes.placa_auto_dos, tb_mapeos.espacio, tb_mapeos.seccion
    FROM tb_mapeos
    INNER JOIN tb_clientes ON tb_mapeos.id_map = tb_clientes.map_id
    WHERE tb_mapeos.estado = '1' AND tb_mapeos.seccion IN ('A', 'B')
    GROUP BY tb_mapeos.espacio");

  $query_clientes->execute();
}

$datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php include('layout/admin/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini">

  <div class="wrapper">
    <?php include('layout/admin/menu.php'); ?>
    <div class="content-wrapper">
      <br>
      <div class="container">
        <h2>Placas registradas </h2>
        <br>
        <span >"Recuerde que solo puede buscar placas si el cliente tiene asignado un sitio "</span>
      
        <form method="post" onsubmit="return validarPlaca();">
          <div class="form-group">
            <label for="placa">Filtrar por placa:</label>
            <input type="text" class="form-control col-sm-3" id="placa" name="placa" value="<?php echo $placa; ?>" maxlength="8">
          </div>
          <button type="submit" class="btn btn-info">Buscar</button>
          <a href="" class="btn btn-dark">Mostrar todas</a>
        </form>
        <br>

        <?php
        // Verificar si se han obtenido resultados de la búsqueda
        if (count($datos_clientes) > 0) {
        ?>
          <table id="table_id" class="table table-bordered table-sm table-striped">
            <thead class="thead-dark">
              <th class="text-center">Nro</th>
              <th class="text-center">Nombre y apellido</th>
              <th class="text-center">Nit o Ci</th>
              <th class="text-center">Placa 1</th>
              <th class="text-center">Placa 2</th>
              <th class="text-center">Sitio</th>
              <th class="text-center">Sección</th>
            </thead>

            <tbody>
              <?php
              $contador_cliente = 0;
              foreach ($datos_clientes as $datos_cliente) {
                $contador_cliente++;
                $nombre_cliente = $datos_cliente['nombre_cliente'];
                $nit_cliente = $datos_cliente['nit_cliente'];
                $correo = $datos_cliente['correo'];
                $placa_auto = $datos_cliente['placa_auto'];
                $placa_auto_dos = $datos_cliente['placa_auto_dos'];
                $espacio = $datos_cliente['espacio'];
                $seccion = $datos_cliente['seccion'];
                $id_cliente = $datos_cliente['id_cliente'];
              ?>
                <tr>
                  <td class="text-center"><?php echo $contador_cliente; ?></td>
                  <td class="text-center"><?php echo $nombre_cliente; ?></td>
                  <td class="text-center"><?php echo $nit_cliente; ?></td>
                  <td class="text-center"><?php echo $placa_auto; ?></td>
                  <td class="text-center"><?php echo $placa_auto_dos; ?></td>
                  <td class="text-center"><?php echo $espacio; ?></td>
                  <td class="text-center"><?php echo $seccion; ?></td>
                </tr>

              <?php
              }
              ?>
            </tbody>
          </table>
        <?php
        } else {
          // Mostrar mensaje si no se encontraron resultados de búsqueda
          echo "<p>No se encontraron resultados.</p>";
        }
        ?>

      </div>
    </div>
    <?php include('layout/admin/footer.php'); ?>
  </div>
  <?php include('layout/admin/footer_links.php'); ?>
</body>

</html>

<script>
  function validarPlaca() {
    var placaInput = document.getElementById('placa');
    var placaValue = placaInput.value.trim();
    var placaRegex = /^[A-Za-z0-9]{1,8}$/; // Expresión regular para letras y números con un máximo de 8 caracteres

    if (!placaRegex.test(placaValue)) {
      alert('La placa debe contener solo letras y números, y tener un máximo de 8 caracteres.');
      placaInput.focus();
      return false;
    }

    return true;
  }
</script>
