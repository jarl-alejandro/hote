<?php
 // session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Hotel Madison</title>

  <!-- Google fonts-->
  <!-- <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800|Old+Standard+TT' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800' rel='stylesheet' type='text/css'>
 -->
  <!-- font awesome -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">



  <!-- bootstrap -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

  <!-- uniform -->
  <!-- <link type="text/css" rel="stylesheet" href="assets/uniform/css/uniform.default.min.css" />
 -->
  <!-- animate.css -->
  <!-- <link rel="stylesheet" href="assets/wow/animate.css" /> -->



  <!-- gallery -->
  <!-- <link rel="stylesheet" href="assets/gallery/blueimp-gallery.min.css"> -->


  <!-- favicon -->
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

  <link rel="stylesheet" href="assets/style.css">

  <link rel="stylesheet" type="text/css" href="cPanel/static/css/materialize.css">
  <link rel="stylesheet" type="text/css" href="cPanel/static/css/fonts.css">
  <link rel="stylesheet" type="text/css" href="cPanel/static/css/style.css">

  <script type="text/javascript" src="cPanel/static/js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="cPanel/static/js/materialize.js"></script>
  <script type="text/javascript" src="cPanel/static/js/validaciones.js"></script>

  <style>
    .caret{
     border-right: none;
     border-left: none;
   }
   .HabitacionForm{
    position: fixed !important;
    top: 12em !important;
  }
  button{
    outline: none !important;
  }
  .pagination>li>a{
    border: none !important;
  }
</style>


</head>

<body id="home">


<!-- top
  <form class="navbar-form navbar-left newsletter" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Your Email Id Here">
        </div>
        <button type="submit" class="btn btn-inverse">Subscribe</button>
    </form>
    top -->

    <!-- header -->
    <nav class="navbar  navbar-default" role="navigation" style="box-shadow: none;height: 5.5em;">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php
          if (isset($_SESSION['usuarios']))
           {}else{

            ?>
            <a class="navbar-brand" href="index.php"><img src="cPanel/static/img/header.png"  alt="holiday crown"></a><?php
          }

          ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav rigth-menu">
            <?php if (isset($_SESSION['usuarios'])) { ?>
            <li><a href="index.php">Inicio </a></li>
            <li><a href="index.php?page=cPanel/anularcompra">Anular Compra</a></li>
            <li><a href="cerrarlogin.php">Cerrar sesión</a></li>
          <?php }else{ ?>
            <li class="notification__btn">
              <a href="index.php">Inicio </a>
            </li>
            <li class="notification__btn">
              <a href="habitaciones.php">Galeria</a>
            </li>
            <li class="notification__btn">
              <a href="introduction.php">Quienes somos</a>
            </li>
            <li class="notification__btn">
              <a href="contact.php">Contactos</a>
            </li>
            <?php if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){ ?>
            <li class="btn waves-effect waves-ligh" 
								style="position: absolute;right: 1em;position: absolute;right: 1em;width: 1em;display: flex;justify-content: center;align-items: center;top: 2.2em;">
							<a href="login.php">
							<i class="material-icons">vpn_key</i></a></li>
            <?php } else { ?>
              <li class="notification__btn"><a href="servicios/salir.php">Cerrar sesión</a>
            <?php } ?>
              </li>
          <?php } ?>
          </ul>
        </div><!-- Wnavbar-collapse -->
        </div><!-- container-fluid -->
        <?php
        if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){ ?>
        <div class="menu-login">
          <a href="#"
            class="btn waves-effect waves-ligh login-cliente">
            Iniciar Sessión
          </a>
          <a href="#"
            class="btn waves-effect waves-ligh create-cliente">
            Registrarme
          </a>
        </div>
        <?php } ?>
      </nav>
      <!-- header -->
<?php
  if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){
    echo '<input type="hidden" id="sessionInit" value="noSession">';
  }
  else{
    echo '<input type="hidden" id="sessionInit" value="Session">';
  }
?>
