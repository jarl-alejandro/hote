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
$cargo = $_POST["cargo"];
$password = sha1($cedula);

if($id != "") {
  $update = $pdo->query("UPDATE hotel_empleado SET nombre_empleado='$nombre', apellido_empleado='$apellido', email_empleado='$email', telefono_empleado='$telefono', celular_empleado='$celular', direccion_empleado='$direccion', cargo_empleado='$cargo' WHERE cedula_empleado='$cedula'");

  if($update) {
    echo 20;
  }

} else {
  $row = $pdo->query("SELECT * FROM hotel_empleado WHERE cedula_empleado='$cedula'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new = $pdo->query("INSERT INTO hotel_empleado (cedula_empleado, nombre_empleado, apellido_empleado, email_empleado, telefono_empleado, celular_empleado, direccion_empleado, cargo_empleado, password_empleado)
    VALUES ('$cedula', '$nombre', '$apellido', '$email', '$telefono', '$celular', '$direccion', '$cargo', '$password')");

  if($new) {
    echo 2;
  }
  
}
