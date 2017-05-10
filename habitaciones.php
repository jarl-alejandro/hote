<?php
session_start();
  if(isset($_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"])){
    $tipo = $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"];

    if ($tipo == "socio"){
      // header("Location: index.php");

    } else if ($tipo == "empleado"){
      header("Location: cPanel");
    }
  }
  include 'header.php';
  include 'bd/db.php';
?>
<div class="" style="width: 100%">
  <div class="u-relative items__alquiler" id="ShowPanel">
    <button class="margin-bottom btn-floating btn-large waves-effect waves-light color-acent"
      style="position: absolute;z-index: 1111;right: 1em;">
      <i class="material-icons">local_grocery_store</i>
    </button>
    <span class="blue notify-front">0</span>
  </div>
  <div class="col s12">
  <?php include './partials/reservas.php'; ?>
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
