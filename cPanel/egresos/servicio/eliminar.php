<?php 
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$eliminar = $pdo->query("DELETE FROM hotel_egreso WHERE codigo_egreso='$codigo'");

if($eliminar) {
  echo 2;
}