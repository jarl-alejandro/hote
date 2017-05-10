<?php 
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$eliminar = $pdo->query("DELETE FROM hotel_habitacion WHERE codigo_habitacion='$codigo'");

if($eliminar) {
  echo 2;
}