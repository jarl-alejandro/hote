<?php
session_start();
include '../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$user = $_POST["user"];
$pass = sha1($_POST["password"]);

$count_socio = $pdo->query("SELECT * FROM hotel_cliente WHERE cedula_cliente='$user' AND password_cliente='$pass'");

if ($count_socio->rowCount() == 0) {
  echo 1;
  return false;
} 
else {
  $socio = $count_socio->fetch();
  $username = $socio['nombre_cliente'] . " " . $socio['apellido_cliente'];

  $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"] = $socio['cedula_cliente'];
  $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"] = $username;
  $_SESSION["a88b7dcd1a9e3e17770bbaa6d7515b31a2d7e85d"] = $socio['email_cliente'];
  $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"] = "socio";
  echo 2;
  return false;
}

