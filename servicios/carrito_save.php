<?php
session_start();
include '../bd/db.php';

date_default_timezone_set('America/Guayaquil');

$cliente = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
$codigo = $_POST["codigo"];
$valor = $_POST["valor"];
$categoria = $_POST["categoria"];
$habitacion = $_POST["habitacion"];
$adultos = $_POST["adultos"];
$children = $_POST["children"];
$cant = $_POST["cant"];
$ocupado = $_POST["ocupado"];

$detail = $pdo->query("INSERT INTO tmp_carrito (user_id, habitacion_id, valor, categoria, adultos, children, cant, ocupado, habitacion) 
  VALUES ('$cliente', '$codigo', '$valor', '$categoria', '$adultos', '$children', '$cant', '$ocupado', '$habitacion')");


$res = array('status'=>201);

$json = json_encode($res);
echo $json;
