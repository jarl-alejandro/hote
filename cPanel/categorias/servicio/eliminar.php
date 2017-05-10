<?php 
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$eliminar = $pdo->query("DELETE FROM hotel_categoria WHERE codigo_categoria='$codigo'");

if($eliminar) {
  echo 2;
}