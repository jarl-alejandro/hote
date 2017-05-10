<?php
include '../../../bd/db.php';
require('../../servicios/codigo.php');


$id = $_POST["id"];
$nombre = $_POST["nombre"];
$valor = $_POST["valor"];
$categoria = $_POST["categoria"];
$detalle = $_POST["detalle"];
$cant = $_POST["cant"];
$departamento = $_POST["departamento"];
$piso = $_POST["piso"];
$nombreImagen = $_POST["nombre_imagen"];
$enseres = $_POST["enseres"];
$enseres = json_decode($enseres);

$codigo = setCode('HA-', 8, 'hotel_habitacion', 'cont_habitacion');
$imagen_nombre = setCode('IM-', 8, 'hotel_habitacion', 'cont_imagen');

function copy_image ($code_image) {

  $imagen = $_FILES['imagen']['name'];
  $imagen = $code_image . ".png";
  $ruta = $_FILES["imagen"]["tmp_name"];
  $destino = "../../../media/habitaciones/" . $imagen;

  copy($ruta, $destino);

  return $imagen;
}


$row_cant = $pdo->query("SELECT categoria_habitacion FROM hotel_habitacion
    WHERE categoria_habitacion='$categoria'");

$row_name = $pdo->query("SELECT nombre_habitacion FROM hotel_habitacion
    WHERE nombre_habitacion='$nombre'");

$cat_row = $pdo->query("SELECT * FROM hotel_categoria
    WHERE codigo_categoria='$categoria'");

$categoria_fetch = $cat_row->fetch();
$cant_categoria = $categoria_fetch["cant_categoria"];


if($id != "") {
  $hab_old = $pdo->query("SELECT nombre_habitacion, categoria_habitacion FROM hotel_habitacion
    WHERE codigo_habitacion='$id'");

  $fetch = $hab_old->fetch();
  $nombre_old = $fetch["nombre_habitacion"];
  $categoria_old = $fetch["categoria_habitacion"];

  if($nombre != $nombre_old) {
    if($row_name->rowCount() > 0){
      echo 5;
      return false;
    }

  }

  if($categoria != $categoria_old) {

    if($row_cant->rowCount() > $cant_categoria){
      echo 44;
      return false;
    }
  }

  $nameImage = $id . ".png";
  $img_hb = $pdo->query("SELECT imagen_habitacion FROM hotel_habitacion WHERE codigo_habitacion='$id'");
  $hab_img = $img_hb->fetch();
  $imagen_old = $hab_img["imagen_habitacion"];

  if($nombreImagen != $imagen_old) {
    $update_image = copy_image($imagen_nombre);

    $update = $pdo->query("UPDATE hotel_habitacion SET nombre_habitacion='$nombre', 
      valor_habitacion='$valor', imagen_habitacion='$update_image',
      categoria_habitacion='$categoria', detalle_habitacion='$detalle', 
      cant_habitacion='$cant', piso_habitacion='$piso', es_habitacion='$departamento'
      WHERE codigo_habitacion='$id'");

    actualizar_parametro('cont_imagen');

  }
  else {
    $update = $pdo->query("UPDATE hotel_habitacion SET nombre_habitacion='$nombre',
     valor_habitacion='$valor', categoria_habitacion='$categoria', 
     detalle_habitacion='$detalle', cant_habitacion='$cant', 
     piso_habitacion='$piso', es_habitacion='$departamento'
     WHERE codigo_habitacion='$id'");

  }

  $pdo->query("DELETE FROM detalle_habitacion WHERE codigo_habitacion='$id'");

  $detail = $pdo->prepare("INSERT INTO detalle_habitacion (codigo_habitacion,
            codigo_mueble, detalle_cant, detalle_total) VALUES (?, ?, ?, ?)");


  foreach ($enseres as $key) {
    $detail->bindparam(1, $id);
    $detail->bindparam(2, $muble);
    $detail->bindparam(3, $cant);
    $detail->bindparam(4, $total);

    $muble = $key->id;
    $cant = $key->cant;
    $total = $key->total;

    $detail->execute();
  }

  if($update) {
    echo 20;
  }

}
else {
  // Guardar Habitaciones

  if($row_cant->rowCount() > $cant_categoria){
    echo 44;
    return false;
  }

  if($row_name->rowCount() > 0){
    echo 5;
    return false;
  }

  $row = $pdo->query("SELECT * FROM hotel_habitacion WHERE codigo_habitacion='$codigo'");

  if($row->rowCount() > 0){
    echo 1;
    return false;
  }

  $new_image = copy_image($imagen_nombre);

  $new = $pdo->query("INSERT INTO hotel_habitacion (codigo_habitacion, nombre_habitacion, valor_habitacion, imagen_habitacion, categoria_habitacion, detalle_habitacion, cant_habitacion, estado_habitacion, piso_habitacion, es_habitacion)
    VALUES ('$codigo', '$nombre', '$valor', '$new_image', '$categoria', '$detalle', '$cant', '0', '$piso', '$departamento')");

  $detail = $pdo->prepare("INSERT INTO detalle_habitacion (codigo_habitacion,
            codigo_mueble, detalle_cant, detalle_total) VALUES (?, ?, ?, ?)");


  foreach ($enseres as $key) {
    $detail->bindparam(1, $codigo);
    $detail->bindparam(2, $id);
    $detail->bindparam(3, $cant);
    $detail->bindparam(4, $total);

    $id = $key->id;
    $cant = $key->cant;
    $total = $key->total;

    $detail->execute();
  }

  if($new) {
    echo 2;
    actualizar_parametro('cont_habitacion');
    actualizar_parametro('cont_imagen');
  }
  else{
    print_r($pdo->errorInfo());
  }

}
