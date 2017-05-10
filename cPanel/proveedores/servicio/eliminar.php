<?php 
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$eliminar = $pdo->query("DELETE FROM hotel_proveedor WHERE codigo_proveedor='$codigo'");

if($eliminar) {
  echo 2;
}