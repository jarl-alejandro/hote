<?php
session_start();
include '../bd/db.php';

date_default_timezone_set('America/Guayaquil');

$email = $_POST["email"];
$mensaje = $_POST["mensaje"];
$titulo = "Mensaje del cliente $email";

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: < $email >\r\n";

$mail = "hotelmadisonreservas@hotmail.com";
// $mail = "jarlalejor@gmail.com";

$bool = mail($mail, $titulo, $mensaje);

if($bool) {
    echo 2;
}
else {
    echo 5;
}