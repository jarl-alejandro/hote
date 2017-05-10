<?php
session_start();

include '../../../bd/db.php';
require('../../servicios/codigo.php');

$code_image = setCode('Avatar-', 8, 'hotel_empleado', 'cont_imagen');
$cedula = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];

$avatar = $_FILES['avatar']['name'];
$avatar = $code_image . ".png";
$ruta = $_FILES["avatar"]["tmp_name"];
$destino = "../../../media/avatar/" . $avatar;

copy($ruta, $destino);

$update = $pdo->query("UPDATE hotel_empleado SET avatar_empleado='$avatar' WHERE cedula_empleado='$cedula'");

actualizar_parametro('cont_imagen');
