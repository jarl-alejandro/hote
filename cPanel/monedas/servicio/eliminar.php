<?php 
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$eliminar = $pdo->query("DELETE FROM hotel_moneda WHERE codigo_moneda='$codigo'");

if($eliminar) {
  echo 2;
}