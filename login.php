<?php
session_start();
if(isset($_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"])){
  $tipo = $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"];

  if ($tipo == "socio"){
    header("Location: index.php");

  } else if ($tipo == "empleado"){
    header("Location: cPanel");
  }
}

?>
<!DOCTYPE html>
<html lang="es" class="full-height">
<head>
  <meta charset="utf-8">
  <title>Hotel Madison</title>
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="icon" href="images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="cPanel/static/css/materialize.css">
  <link rel="stylesheet" type="text/css" href="cPanel/static/css/fonts.css">
  <link rel="stylesheet" type="text/css" href="cPanel/static/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="full-height">
  <header class="Header">
    <div class="Header-title">
     <a href="index.php" class="white-text">
				<img src="cPanel/static/img/header.png" alt="Hotel Madison" 
						style="width: 238px;height: 4.2em;position: relative;top: .7em;">
			</a>
    </div>
  </header>
  <section class="Layout-Login">
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
      <button class="btn waves-effect waves-light center-block color-toolbar login">Iniciar Sessión
         <i class="material-icons right">send</i>
      </button>
    </form>
  </section>
  <script type="text/javascript" src="cPanel/static/js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="cPanel/static/js/materialize.js"></script>
  <script type="text/javascript" src="cPanel/static/js/validaciones.js"></script>
  <script type="text/javascript" src="assets/js/login.js"></script>
</body>
</html>
