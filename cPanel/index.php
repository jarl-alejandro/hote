<?php
session_start();
if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){
  header('location: ../index.php');
}
else {
  include '../bd/db.php';

  $cargo = $_SESSION["e0d6ae5cf2a2d0c1075943593a36cc5377382a05"];
  $tipo = $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"];

  $avatar = $_SESSION["a31220bbe4802f5451332e38ef5c879ca5f0e91a"];
  $username = $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"];
  $cedula = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
  $level = $_SESSION["e0d6ae5cf2a2d0c1075943593a36cc5377382a05"];
  $query_empelado = $pdo->query("SELECT avatar_empleado FROM hotel_empleado WHERE cedula_empleado='$cedula'");
  $row_employ = $query_empelado->fetch();

  // include 'servicios/bloquead_clientes.php';
  include 'servicios/desalojaHabitacion.php';
  if ($tipo == "socio"){
    header("Location: ../index.php");
  }


}

$hoy = date("Y-m-d");
$ahora = date("h:i a");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Hotel Madison</title>
  <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
  <link rel="icon" href="../images/favicon.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="static/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="static/css/fonts.css">
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <input type="hidden" id="cargoEmploy" value="<?= $cargo ?>">
	<div class="u-ocultar"></div>
  <div class="u-oculto"></div>
	<header class="Header">
		<button class="Header-button--toolbar">
			<span class="Header-icons--line"></span>
		</button>
		<div class="Header-title">
			<a href="index.php" class="white-text">
				<img src="static/img/header.png" alt="Hotel Madison" 
						style="width: 238px;height: 4.2em;position: relative;top: .7em;">
			</a>
		</div>
    <div class="row-flex">
    <?php if ($cargo == "recepcionista" || $cargo == "administrador") { ?>
      <div class="col s1">
        <button class="waves-effect waves-light btn-flat btn-atajos"
          data-message="Factura" data-url="huespedes" data-title="Factura">
          <i class="material-icons white-text">view_list</i>
        </button>
      </div>
      <div class="col s1">
        <button class="waves-effect waves-light btn-flat btn-atajos" data-message="Arribo del cliente" data-url="arribo-clientes" data-title="Arribo del cliente">
          <i class="material-icons white-text">local_car_wash</i>
        </button>
      </div>
      <div class="col s1">
        <button class="waves-effect waves-light btn-flat btn-atajos"
          data-message="Consumos" data-url="facturas" data-title="Consumos">
          <i class="material-icons white-text">room_service</i>
        </button>
      </div>
      <!-- <div class="col s1">
        <button class="waves-effect waves-light btn-flat btn-atajos"
          data-message="Reservaciones grupales" data-url="grupos" data-title="Reservaciones grupales">
          <i class="material-icons white-text">people</i>
        </button>
      </div> -->
    <?php } ?>
    <?php if ($cargo == "vendedor" || $cargo == "administrador") { ?>
      <div class="col s1">
        <button class="waves-effect waves-light btn-flat btn-atajos"
          data-message="Punto de venta" data-url="restaurante" data-title="Punto de Venta">
          <i class="material-icons white-text">restaurant_menu</i>
        </button>
      </div>
    <?php } ?>
      <div class="col s1">
        <button class="waves-effect waves-light btn-flat btn-atajos"
          data-message="Cierre de caja" data-url="cierre_caja" data-title="Cierre de Caja">
          <i class="material-icons white-text">attach_money</i>
        </button>
      </div>
    <?php if ($cargo == "recepcionista" || $cargo == "administrador") { ?>
      <div class="col s1">
        <button class="waves-effect waves-light btn-flat btn-atajos"
          data-message="Traslado" data-url="traslado" data-title="Trasladar">
          <i class="material-icons white-text">swap_horiz</i>
        </button>
      </div>
    <?php } ?>
    <?php if ($cargo == "contador" || $cargo == "administrador") { ?>
       <div class="col s1">
        <button class="waves-effect waves-light btn-flat" id="parametros"
          data-message="Parametros">
          <i class="material-icons white-text">compare</i>
        </button>
      </div> 
    <?php } ?>
    <?php if ($cargo == "administrador") { ?>
      <div class="col s1">
        <button class="waves-effect waves-light btn-flat printL"
          data-message="Imprimir reportes">
          <i class="material-icons white-text">print</i>
        </button>
      </div>
    <?php } ?>
    <div class="col s1">
      <button class="waves-effect waves-light btn-flat"
        data-message="Perfil" id="profile">
        <i class="material-icons white-text">accessibility</i>
      </button>
    </div>
    </div>
    <div class="u-center-flex Header-buscador">
     <label for="buscador"><i class="material-icons white-text">search</i></label>
     <input id="buscador" class="white-text">
     <i class="material-icons white-text close_buscador">close</i>
   </div>
   <div class="Header-salir">
     <a class="waves-effect waves-light btn z-depth-1" href="../servicios/salir.php">Salir
        <i class="material-icons left">exit_to_app</i>
      </a>
   </div>
  </header>
 <?php include 'menu.php'; ?>
 <h1 class="title-layout blue-text accent-color waves-effect waves-ligth"></h1>
 <section class="Layout"></section>
 <section class="Notificaciones"></section>

 <section class="row ProfileCard white z-depth-1 u-none">
  <article class="col s12">
    <h3 class="acent-text center-align no-margin"
      style="margin-bottom:.5em;">Perfil</h3>
      <div class="ProfileCard--layout">
        <figure>
          <?php if($row_employ["avatar_empleado"] == "") { ?>
            <img src="static/img/avatar.png" class="imageAvatar">
          <?php } else {?>
            <img src="../media/avatar/<?= $row_employ["avatar_empleado"] ?>"
                class="imageAvatar">
          <?php } ?>
          <figcaption>
            <div class="upload-avatar">
              <input type="file" id="avatarInputProf" accept="image/png" class="u-none">
              <label for="avatarInputProf" class="label-avatar waves-effect waves-light">Subir imagen
                <i class="material-icons">file_upload</i>
              </label>
            </div>
          </figcaption>
        </figure>
        <div class="info">
          <h5 class="username"><?= $username ?></h5>
          <h5 class="nivel">nivel: <?= $level ?></h5>
        </div>
        <div class="col s10 FormPassword" style="left: 6em !important;">
          <div class="row">
            <div class="input-field col s12">
              <input id="passwordProfile" type="password" class="validate">
              <label for="passwordProfile" id="pass-labelProf">Escriba su nueva contraseña</label>
            </div>
            <div class="flex space-between">
              <button class="btn waves-effect waves-ligth blue-grey darken-3"
                id="changePassword">
                Cambiar Contraseña
              </button>
              <button class="btn waves-effect waves-ligth red darken-3"
                id="cerrarProfile">Cerrar</button>
            </div>
          </div>
        </div>

      </div>
  </article>
 </section>

  <section class="row ReportList white z-depth-1">
   <article class="col s12" style="padding:0 !important">
    <h3 class="white-text center-align no-margin color-toolbar" style="margin-bottom:.5em;">Reportes</h3>
    <div class="flex space" style="margin-bottom:.5em;">
      <button class="btn waves-effect waves-light print-r" data-r="clientes">Clientes</button>
      <button class="btn waves-effect waves-light print-r" data-r="empleados">Empleados</button>
      <button class="btn waves-effect waves-light print-r" data-r="productos">Productos</button>
      <button class="btn waves-effect waves-light print-r" data-r="proveedores">Provedores</button>
      <button class="btn waves-effect waves-light print-r" data-r="categorias">Categoria</button>
      <button class="btn waves-effect waves-light print-r" data-r="habitacion">Habitacion</button>

      <button class="btn waves-effect waves-light rep--hab" data-r="disponible">Disponible</button>
      <button class="btn waves-effect waves-light rep--hab" data-r="ocupados">Ocupados</button>
      <button class="btn waves-effect waves-light rep--hab" data-r="reservas">Reservados</button>
      <button class="btn waves-effect waves-light rep--hab" data-r="mantenimiento">Mantenimiento</button>
      <button class="btn waves-effect waves-light rep--hab" data-r="reparadas">Reparadas</button>
      <button class="btn waves-effect waves-light rep--hab"
        data-r="limpieza">Limpieza</button>
      <button class="btn waves-effect waves-light print-r margin-top-min"
        data-r="monedas">Monedas</button>
      <button class="btn waves-effect waves-light print-init margin-top-min"
        data-r="precio">Precio Habitacion</button>
    </div>
    <div class="flex space" style="margin-bottom:.5em;">
      <button class="btn waves-effect waves-light print-cerrar red darken-3">Cerrar</button>
    </div>
   </article>
 </section>
 <div id="parametroContainer"></div>
 
 <footer class="z-depth-1">
    <!-- <h4 style="margin-left: 1em">Fecha: <?= $hoy ?></h4>   -->
    <div class="fecha">
      <p id="diaSemana" class="diaSemana">Martes</p>
      <p id="dia" class="dia">27</p>
      <p>de </p>
      <p id="mes" class="mes">Octubre</p>
      <p>del </p>
      <p id="year" class="year">2015</p>
    </div>

    <div class="min-sig">
      <ul class="u-center-flex">
        <li>
          <a href="#" class="btn-flat waves-effect waves-ligth u-center-flex">
          <span style="background: #4CAF50"></span><strong>Disponible</strong>
          </a>
        </li>
        <li>
          <a href="#" class="btn-flat waves-effect waves-ligth u-center-flex">
          <span class="red darken-4"></span><strong>Ocupados</strong>
          </a>
        </li>
        <li>
          <a href="#" class="btn-flat waves-effect waves-ligth u-center-flex">
          <span class="color-toolbar"></span><strong>Reservados</strong>
          </a>
        </li>
        <li>
          <a href="#" class="btn-flat waves-effect waves-ligth u-center-flex">
          <span class="color-acent"></span><strong>Mantenimiento</strong>
          </a>
        </li>
        <li>
          <a href="#" class="btn-flat waves-effect waves-ligth u-center-flex">
          <span class="blue"></span><strong>Limpieza</strong>
          </a>
        </li>
      </ul>
    </div>

    <div class="reloj">
      <p id="horas" class="horas">11</p>
      <p>:</p>
      <p id="minutos" class="minutos">48</p>
      <p>:</p>
        <p id="segundos" class="segundos">12</p>
        <p id="ampm" class="ampm">AM</p>
      <div class="caja-segundos">
      </div>
    </div>
  </footer>
 <script type="text/javascript" src="static/js/jquery-3.1.0.min.js"></script>
 <script type="text/javascript" src="static/js/materialize.js"></script>
 <script type="text/javascript" src="static/js/validaciones.js"></script>
 <script type="text/javascript" src="static/js/app.js"></script>
 <script type="text/javascript" src="static/js/reloj.js"></script>
 <script src="rotacion/static/js/highcharts.js"></script>
 <script src="rotacion/static/js/highcharts-3d.js"></script>
 <script src="rotacion/static/js/exporting.js"></script>
 <script src="rotacion/static/js/theme.js"></script>


</body>
</html>
