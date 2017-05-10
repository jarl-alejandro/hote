<?php
session_start();

include '../bd/db.php';
$cliente = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
date_default_timezone_set('America/Guayaquil');
$delete = $pdo->query("DELETE FROM tmp_carrito WHERE user_id='$cliente'");

if($delete) {
  echo 2;
}
else{
  print_r($pdo->errorInfo());
}
