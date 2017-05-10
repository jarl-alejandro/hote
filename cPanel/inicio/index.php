<?php
session_start();

include '../../bd/db.php';
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y/m/d");

$avatar = $_SESSION["a31220bbe4802f5451332e38ef5c879ca5f0e91a"];
$username = $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"];
$cedula = $_SESSION["1a0b858b9a63f19d654116c9f37ae04194ccfdd0"];
$level = $_SESSION["e0d6ae5cf2a2d0c1075943593a36cc5377382a05"];
$query_empelado = $pdo->query("SELECT avatar_empleado FROM hotel_empleado 
                                WHERE cedula_empleado='$cedula'");
$row_employ = $query_empelado->fetch();

$hoy = date("Y-m-d");
$ahora = date("h:i a");

$primer_dia = mktime();
$ultimo_dia = mktime();

while(date("w",$primer_dia)!=1){
  $primer_dia -= 3600;
}

while(date("w",$ultimo_dia)!=0){
  $ultimo_dia += 3600;
}

$lunes = date("Y-m-d", $primer_dia);
$domingo = date("Y-m-d", $ultimo_dia);

$semana = $pdo->query("SELECT COUNT(*) as 'count' FROM vista_reservacion WHERE (
  (fecha_habitacion <='$lunes' AND hasta_habitacion >= '$domingo')
  OR fecha_habitacion BETWEEN '$lunes' AND '$domingo'
  OR hasta_habitacion BETWEEN '$lunes' AND '$domingo') AND estado_habitacion='reservado'");
?>
<style>
  .Layout{ top:0em !important; }
  .col{margin:0 !important;} .row{margin-bottom: 0em !important}
  .Header-buscador{display:none;}
  .min-sig{
    display: flex;
  }
</style>
<input type="hidden" id="totalHab" />
<section class="inicio-alquiler">
  <input type="hidden" id="fecha_actual" value="<?= $hoy ?>" />
  <section class="row">
    <section class="col s8" style="position: relative;top: 2.5em;">

    <section class="Reservas-Habitaciones col s12">
      <?php
      include '../../bd/db.php';
      $habitacion = $pdo->query("SELECT * FROM vista_habitacion WHERE es_habitacion='0' ORDER BY nombre_habitacion ASC");
      if($habitacion->rowCount() == 0){
        echo "<h2>No hay habitaciones</h2>";
      }
      foreach ($habitacion as $row) :
        include 'partials/numero.php';
      endforeach ?>
    </section>

    <div class="habitacion-modal"></div>

    <section class="col s12 m10 Reservas-formularios" style="display:none">
      <div class="form-cliente row white z-depth-1">
        <a class="waves-effect waves-teal btn-flat tooltipped" href="#newClient" id="new-client" data-position="left" data-delay="50" data-tooltip="Agrega nuevo usuario">
          <i class="material-icons">account_circle</i>
        </a>
        <div class="input-field col s12" id="clientes-select"></div>
      <div class="col-12">
        <div class="input-field col s6">
          <input type="text" disabled id="fecha"
            min="<?= $hoy ?>" value="<?= $fecha ?>">
          <label class="active" id="fecha_active">Fecha</label>
        </div>
        <div class="input-field col s6">
          <input type="text" id="dias--quedar" maxlength="2"
            onkeypress="ValidaSoloNumeros()" />
          <label class="label-hasta" for="dias--quedar">Dias de hospedaje</label>
        </div>
        <div class="input-field col s6 offset-s3">
          <input type="text" id="abonoPagar" maxlength="5"
            onkeypress="ValidaSoloDecimal()" />
          <label class="label-abono" for="abonoPagar">Abono</label>
        </div>
        <div class="col s12">
          <p class="msg-day-hosped">Fecha de salida
            <span id="dayHosped"><?= $hoy ?></span>
          </p>
        </div>
      </div>
      <div class="space flex">
        <button class="btn red darken-4 waves-effect waves-red cancelar-btn">Cancelar</button>
        <button class="btn color-toolbar waves-effect waves-teal reservacion-btn">Alquilar</button>
        <button class="btn-flat waves-effect waves-light retornar">
          mas habitaciones
        </button>
      </div>
    </div>
    <section class="col s12 white z-depth-1" style="padding-bottom:1em !important;margin-top:1em !important;">
      <table class="table striped centered bordered" id="Tab_Filter">
        <thead>
          <tr>
            <th>Categoria</th>
            <th>Habitacion</th>
            <th>Adultos</th>
            <th>Niños</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="habitaciones_reservadas">
        </tbody>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total $</td>
            <td id="total_price">0.00</td>
          </tr>
        </tbody>
      </table>
      <ul class="pagination" id="NavPosicion_b"></ul>
    </section>
  </section>

</section>

<section class="col s4" style="background: white;">
  <ul class="list-options">
    <li class="items__alquiler" id="shoMapa">
      <button class="margin-bottom btn-floating btn-large waves-effect waves-light color-toolbar modal-trigger"
        href="#mapaHabitaciones">
        <img src="static/img/maps-icon.png" alt="" />
      </button>
      <p>Mapa de Habitaciones</p>
    </li>
    <li class="u-relative items__alquiler over-hab" id="ShowPanel"
      data-type="Reservar mas habitaciones">
      <button class="margin-bottom btn-floating btn-large waves-effect waves-light color-acent" style="position: relative;z-index: 111">
        <i class="material-icons">local_grocery_store</i>
      </button>
      <span class="blue notify">0</span>
      <p>Carrito</p>
    </li>
    <li class="items__alquiler u-pointer u-relative" id="porSalir">
      <button class="margin-bottom btn-floating btn-large waves-effect waves-light blue">
        <i class="material-icons">print</i>
      </button>
      <span class="color-acent notify-salir">
        <?php
          $salir = $pdo->query("SELECT COUNT(*) as 'count' FROM vista_reservacion
                WHERE hasta_habitacion='$hoy' AND estado_habitacion='ocupado'");
          $squery = $salir->fetch();
          print $squery ["count"];
        ?>
      </span>
      <p>Por Salir</p>
    </li>
    <li class="items__alquiler u-relative" id="reservacionesSemanales">
    <button class="margin-bottom btn-floating btn-large waves-effect waves-light blue-grey darken-3">
        <i class="material-icons">print</i>
      </button>
      <span class="blue notify-salir">
        <?php
          $semquery = $semana->fetch();
          print $semquery["count"];
        ?>
      </span>
      <p>Reservaciones semanales</p>
    </li>
  </ul>

  <div class="userProfile">
    <figure>
      <?php if($row_employ["avatar_empleado"] == "") { ?>
        <img src="static/img/avatar.png" class="imageAvatar">
      <?php } else {?>
        <img src="../media/avatar/<?= $row_employ["avatar_empleado"] ?>"
            class="imageAvatar">
      <?php } ?>
      <figcaption>
        <div class="upload-avatar">
          <input type="file" id="avatar_input" accept="image/*" class="u-none">
          <label for="avatar_input" class="label-avatar waves-effect waves-light">
            Subir imagen
            <i class="material-icons">file_upload</i>
          </label>
        </div>
      </figcaption>
    </figure>
    <div class="info">
      <h5 class="username"><?= $username ?></h5>
      <h5 class="nivel">nivel: <?= $level ?></h5>
    </div>
    <div class="col s8 FormPassword">
      <div class="row">
        <button class="btn waves-effect waves-ligth blue-grey darken-3"
          id="showPassword">
          Cambiar Contraseña
        </button>
      </div>
    </div>
  </div>

</section>
<h5 id="message-reservas">Reserve habitaciones</h5>

</section>
<div class="row">
  <section class="habitacionesContainer z-depth-1 col s12 m7"></section>
</div>

<?php include 'partials/form.php'; ?>
</section>

<div id="newClient" class="modal modal-fixed-footer">
  <div class="modal-content">
    <?php include 'partials/form_cliente.php'; ?>
    <div class="formCliente">
    </div>
  </div>
</div>

<div id="mapaHabitaciones" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="center-align acent-text">Mapa de Habitaciones</h4>
    <ul class="mapa-min u-center-flex">
      <li>
        <a href="#" class="btn-flat waves-effect waves-ligth disponible-map">
          <span style="background: #4CAF50"></span> <strong>Disponibles</strong>
        </a>
      </li>
      <li>
        <a href="#" class="btn-flat waves-effect waves-ligth ocupados-map">
          <span class="red darken-4"></span> <strong>Ocupados</strong>
        </a>
      </li>
      <li>
        <a href="#" class="btn-flat waves-effect waves-ligth reservadas-map">
          <span class="color-toolbar"></span> <strong>Reservadas</strong>
        </a>
      </li>
      <li>
        <a href="#" class="btn-flat waves-effect waves-ligth mantenimiento-map">
          <span class="color-acent"></span> <strong>Mantenimiento</strong>
        </a>
      </li>
      <li>
        <a href="#" class="btn-flat waves-effect waves-ligth limpieza-map">
          <span class="blue"></span> <strong>Limpieza</strong>
        </a>
      </li>
      <li>
        <a href="#" class="btn-flat waves-effect waves-ligth todos-map">
          <span class=""></span> <strong>Todo</strong>
        </a>
      </li>
    </ul>
    <div class="MapaHabitacionesSection row">
      <?php $habitacion = $pdo->query("SELECT * FROM vista_habitacion");
      foreach ($habitacion as $row) :
        if($row["estado_habitacion"] == 0)
          include 'partials/disponibles.php';
        else if($row["estado_habitacion"] == 1)
          include 'partials/reservadas.php';
        else if($row["estado_habitacion"] == 5)
          include 'partials/mantenimiento.php';
        else if($row["estado_habitacion"] == 6)
          include 'partials/limpieza.php';
        else if($row["estado_habitacion"] == 10)
          include 'partials/ocupados.php';
        endforeach
        ?>
      </div>
    </div>

    <div class="modal-footer">
      <button class="btn-flat modal-action modal-close waves-effect waves-red btn-flat" id="cerrarMapa">Cerrar</button>
    </div>
  </div>
</div>

<section class="PasswordSection white z-depth-1 col-xs-7">
  <div class="row">
    <h3 class="PasswordSection-title">Cambia tu contraseñas</h3>
    <div class="input-field col s12">
      <input id="password" type="password" class="validate">
      <label for="password" id="pass-label">Escriba su nueva contraseña</label>
    </div>
    <div class="flex space col s12">
      <button class="btn waves-effect waves-ligth blue-grey darken-3"
        id="password-input">
        <span>Guardar</span>
        <i class="material-icons right">send</i>
      </button>
      <button class="btn waves-effect waves-ligth red darken-3"
        id="password-close">
        <span>Cerrar</span>
        <i class="material-icons right">close</i>
      </button>
    </div>
  </div>
</section>
<script src="static/js/paging.js"></script>
<script>
    $.getScript("inicio/static/js/componente.js")
    $.getScript("inicio/static/js/cliente.js")
    $.getScript("inicio/static/js/paginator.js")
  $.getScript("inicio/static/js/reservaciones.js")
</script>
