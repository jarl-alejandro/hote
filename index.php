<?php session_start();
if(isset($_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"])){
  $tipo = $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"];

  if ($tipo == "socio"){
    // header("Location: index.php");

  } else if ($tipo == "empleado"){
    header("Location: cPanel");
  }
}

include 'bd/db.php';
$param = $pdo->query("SELECT * FROM hotel_parametro");
$empleado = $pdo->query("SELECT * FROM hotel_empleado");
$cliente = $pdo->query("SELECT * FROM hotel_cliente");

$count = $param->rowCount();
$count_empleado = $empleado->rowCount();
$count_cliente = $cliente->rowCount();

$cedula = "1234567890";
$nombre = "admin";
$apellido = "admin";
$email = "admin@admin";
$telefono = "1234567890";
$celular = "1234567890";
$direccion = "admin";
$cargo = "administrador";
$password = sha1("admin");

if ($count == 0) {
  $pdo->query("INSERT INTO hotel_parametro (id_parametro, cont_categoria) VALUES ('1', '0')");
}

if ($count_cliente == 0) {
  $pdo->query("INSERT INTO hotel_cliente (cedula_cliente, nombre_cliente, apellido_cliente)
    VALUES ('xxxxxxxxxx', 'Consumidor', 'Final')");
}

if ($count_empleado == 0) {
  $pdo->query("INSERT INTO hotel_empleado (cedula_empleado, nombre_empleado, apellido_empleado, email_empleado, telefono_empleado, celular_empleado, direccion_empleado, cargo_empleado, password_empleado)
    VALUES ('$cedula', '$nombre', '$apellido', '$email', '$telefono', '$celular', '$direccion', '$cargo', '$password')");
}


$_params = $pdo->query("SELECT * FROM hotel_parametro WHERE id_parametro='1'");
$params = $_params->fetch();

?>
<?php include 'header.php';?>

<div class="menssage-cliente"></div>
<div class="container-ralativo front--banner">
  <div class="banner">
    <img src="images/photos/banner.jpg"  class="img-responsive" alt="slide">
    <div class="welcome-message">
      <div class="wrap-info">
        <div class="information">
          <h1  class="animated fadeInDown" style="color:#000">Hotel Madison</h1>
          <p class="animated fadeInUp" style="color:#000">Confort, elegancia y buen trato.</p>
        </div>
        <a href="#information" class="arrow-nav scroll wowload fadeInDownBig"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>

    <a href="#information"><div class="btreserva">Reservar Habitación</div></a>
  </div>
  <!-- banner-->
  <div class="slider-left">
    <?php include "./slide.php" ?>
  </div>
</div>
  <!-- Promociones -->
  <!-- <div id="promociones" class="row"> -->
  <!-- </div> -->
  <!-- Fin Promociones -->

  <!-- reservation-information -->
  <div id="information" class="spacer reserve-info " style="background:#ccc !important;">
    <div class="u-relative items__alquiler" id="ShowPanel">
      <button class="margin-bottom btn-floating btn-large waves-effect waves-light color-acent carrito"
        style="position: absolute;z-index: 1111;right: 1em;">
        <i class="material-icons">local_grocery_store</i>
      </button>
      <span class="blue notify-front">0</span>
    </div>
    <?php
    if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){ ?>
    <div class="no_session">
      <a href="#"
        class="btn-flat waves-effect waves-ligh blue-text login-cliente">
        Iniciar Sessión
      </a>
      <a href="#"
        class="btn-flat waves-effect waves-ligh blue-text create-cliente">
        Registrarme
      </a>
    </div>
    <h4 class="message__no-session">Para reservar debe iniciar sesion o registrarse.</h4>
    <?php } ?>
    <?php include 'partials/reservas.php'; ?>

  </div>

</div>
</div>
<!-- reservation-information -->
<div class="modal-cliente">
  <?php include 'partials/form_cliente.php'; ?>
</div>
<div id="login-modal" class="modal-material">
  <form class="col s6 card form-card">
    <h3 class="title-login">Iniciar Sessión</h3>
    <div class="input-field col s10">
      <i class="material-icons prefix">account_circle</i>
      <input id="user" type="text" class="validate" length="13" maxlength="13" onkeypress="ValidaSoloNumeros()">
      <label for="user">Cedula</label>
    </div>
    <div class="input-field col s10">
      <i class="material-icons prefix">https</i>
      <input id="password" type="password" class="validate">
      <label for="password">Contraseña</label>
    </div>
    <div class="flex space">
      <button class="btn waves-effect waves-light color-toolbar login">Iniciar Sessión
        <i class="material-icons right">send</i>
      </button>
      <button class="btn waves-effect waves-light" id="cerrar">Cerrar
        <i class="material-icons right">close</i>
      </button>
    </div>
  </form>
</div>
<?php include 'footer.php';?>
<div class="wizar">
  <p class="wizar--message">
    <?php
    if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){ ?>
    Para reservar debe iniciar sesion o registrarse.
    <?php }else { ?>
      Seleciona las habitaciónes a reservar.
    <?php } ?>
  </p>
  <img src="assets/img/mago3.gif" />
</div>
