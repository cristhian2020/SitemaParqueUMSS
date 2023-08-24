<?php
  require 'phpqrcode/qrlib.php';

  $dir = 'temp/';

  if(!file_exists($dir))
    mkdir($dir);
    $filename = $dir.'test.png';

    $tamanio = 10;
    $level = 'M';
    $frameSize =3;
    $contenido = "70bs";

    QRcode::png($contenido, $filename, $level, $frameSize);

  echo '<img src="'.$filename.'"/>';
?>