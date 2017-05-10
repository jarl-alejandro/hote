<?php 
include '../../../bd/db.php';

$id = $_POST["id"];
$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$celular = $_POST["celular"];
$direccion = $_POST["direccion"];
$password = sha1($cedula);

if($id != "") {
  $update = $pdo->query("UPDATE hotel_cliente SET nombre_cliente='$nombre', apellido_cliente='$apellido', email_cliente='$email', telefono_cliente='$telefono', celular_cliente='$celular', direccion_cliente='$direccion' WHERE cedula_cliente='$cedula'");

  if($update) {
    echo 20;
  }

} else {
  $row = $pdo->query("SELECT * FROM hotel_cliente WHERE cedula_cliente='$cedula'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_cliente (cedula_cliente, nombre_cliente, apellido_cliente, email_cliente, telefono_cliente, celular_cliente, direccion_cliente, password_cliente)
    VALUES ('$cedula', '$nombre', '$apellido', '$email', '$telefono', '$celular', '$direccion', '$password')");

  if($new) {
    echo 2;
  }
  
}
