<?php 
include '../../../bd/db.php';

$cedula = $_POST["cedula"];

$eliminar = $pdo->query("DELETE FROM hotel_empleado WHERE cedula_empleado='$cedula'");

if($eliminar) {
  echo 2;
}