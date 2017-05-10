<?php 
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$eliminar = $pdo->query("DELETE FROM hotel_producto WHERE codigo_producto='$codigo'");

if($eliminar) {
  echo 2;
}