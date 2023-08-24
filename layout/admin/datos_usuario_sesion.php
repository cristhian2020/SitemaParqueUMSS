<?php
session_start();
if (isset($_SESSION['usuario_sesion'])) {
    $usuario_sesion = $_SESSION['usuario_sesion'];

    $query_usuario_sesion = $pdo->prepare("SELECT u.*, r.nombre_rol, r.id_rol, p.* FROM tb_usuarios u JOIN tb_roles r ON u.rol_id = r.id_rol JOIN tb_permisos p ON r.id_rol = p.rol_id WHERE u.email = '$usuario_sesion' AND u.estado = '1'");
    $query_usuario_sesion->execute();
    $usuarios_sesions = $query_usuario_sesion->fetchAll(PDO::FETCH_ASSOC);

    foreach ($usuarios_sesions as $usuarios_sesion) {
        $id_user_sesion = $usuarios_sesion['id'];
        $nombres_sesion = $usuarios_sesion['nombres'];
        $email_sesion = $usuarios_sesion['email'];
        $nombre_rol_sesion = $usuarios_sesion['nombre_rol'];
        $id_rol_sesion = $usuarios_sesion['id_rol'];
        
        // Aquí puedes utilizar los valores de las columnas de tb_permisos para realizar la lógica deseada
        $principal = $usuarios_sesion['principal'];
        $principal2 = $usuarios_sesion['principal2'];
        $usuarios = $usuarios_sesion['usuarios'];
        $roles = $usuarios_sesion['roles'];
        $parqueo = $usuarios_sesion['parqueo'];
        $clientes = $usuarios_sesion['clientes'];
        $recibos = $usuarios_sesion['recibos'];
        $pagos = $usuarios_sesion['pagos'];
        $anuncios = $usuarios_sesion['anuncios'];
        $guardia = $usuarios_sesion['guardia'];
        $buzon = $usuarios_sesion['buzon'];
        $fecha = $usuarios_sesion['fecha'];

        $fyh_creacion = $usuarios_sesion['fyh_creacion'];
        $fyh_actualizacion = $usuarios_sesion['fyh_actualizacion'];
        $fyh_eliminacion = $usuarios_sesion['fyh_eliminacion'];
        $rol_id = $usuarios_sesion['rol_id'];
        $estado = $usuarios_sesion['estado'];
        
        // Aquí puedes utilizar los valores de las columnas de tb_permisos para realizar la lógica deseada
    }
} else {
    // echo "no existe sesion";
    header('Location: ' . $URL . '/login');
}
?>
