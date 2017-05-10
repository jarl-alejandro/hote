<?php 
include '../../bd/db.php';

$msg = utf8_decode($_POST["mensaje"]);


$mejores = $pdo->query("SELECT * FROM v_mejores_clientes");
$titulo = "Estamos en promociones";
$flag = false;

while ($row = $mejores->fetch()) {
	$nombre = $row["cliente"];
	$mensaje = "<h2>Sr(a).$nombre</h2><pre>$msg</pre>";
	$email = $row["email_cliente"];

	$headers = "MIME-Version: 1.0\r\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$headers .= "From: Hotel Madison hotelmadisonreservas@hotmail.com\r\n";

	$bool = mail($email, $titulo, $mensaje, $headers);

	if($bool)
		$flag = true;
	else
		$flag = false;
}

if ($flag) {
  echo 2;
} else {
  echo 5;
}