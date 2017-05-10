<?php 
include '../../../bd/db.php';

$cedula = $_POST["cedula"];
$desbloq = $pdo->query("UPDATE hotel_cliente SET estado_cliente='0' WHERE cedula_cliente='$cedula'");

if($desbloq) {
  echo 2;
} else {
  echo 1;
}
