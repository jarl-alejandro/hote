<?php
include '../../../bd/db.php';

$codigo = $_POST["codigo"];

$eliminar = $pdo->query("DELETE FROM hotel_muebles WHERE codigo_mueble='$codigo'");

if($eliminar) {
  echo 2;
}
