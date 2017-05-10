<?php
session_start();

include '../bd/db.php';

$id = $_POST["id"];
$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$celular = $_POST["celular"];
$direccion = $_POST["direccion"];
$password = sha1($_POST["password"]);


$row = $pdo->query("SELECT * FROM hotel_cliente WHERE cedula_cliente='$cedula'");

if($row->rowCount() > 0){
  echo 1;
  return false;
}

$new = $pdo->query("INSERT INTO hotel_cliente (cedula_cliente, nombre_cliente, apellido_cliente, email_cliente, telefono_cliente, celular_cliente, direccion_cliente, password_cliente)
  VALUES ('$cedula', '$nombre', '$apellido', '$email', '$telefono', '$celular', '$direccion', '$password')");

if($new) {

  $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"] = $cedula;
  $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"] = $nombre." ".$apellido;
  $_SESSION["a88b7dcd1a9e3e17770bbaa6d7515b31a2d7e85d"] = $email;
  $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"] = "socio";

  echo 2;
}

