<?php

include('../app/config.php');

if(isset($_POST['submit'])) {
    if(isset($_POST['delete'])) {
        $ids = $_POST['delete'];
        foreach($ids as $id) {
            $stmt = $pdo->prepare("DELETE FROM tb_mapeos WHERE id_map = ?");
            $stmt->execute([$id]);
        }
    }
}

header("Location: espacios_creados.php");

?>
