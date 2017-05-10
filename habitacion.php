<?php
include 'header.php';

date_default_timezone_set('America/Guayaquil');
$hoy = date("Y-m-d");
if(isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){
  $user =  $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"];
}
else {
  $user = "Invitado";
}

include 'bd/db.php';

$id = $_GET["id"];

$query = $pdo->query("SELECT * FROM vista_habitacion WHERE codigo_habitacion='$id'");
$row = $query->fetch();
?>
<div class="container">
  <div class="u-relative items__alquiler" id="ShowPanel">
    <button class="margin-bottom btn-floating btn-large waves-effect waves-light color-acent"
      style="position: absolute;z-index: 1111;right: 1em;top: 1em">
      <i class="material-icons">local_grocery_store</i>
    </button>
    <span class="blue notify-front" style="top: 3em;">0</span>
  </div>
  <h3 class="title-habitacion">Categoria: <?= $row["nombre_categoria"] ?></h3>
  <article class="Habitacion-imagen z-depth-1">
    <img src="media/habitaciones/<?= $row["imagen_habitacion"] ?>" />
    <h3 class="name-habitacion">Habitacion: <?= $row["nombre_habitacion"] ?></h3>
    <?php
      if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){ ?>
      <a class="btn-floating btn-large waves-effect waves-light blue" disabled>
        <i class="material-icons">add_shopping_cart</i>
      </a>
    <?php } else { ?>
      <a class="btn-floating btn-large waves-effect waves-light blue reservarHabitacion" 
        id="add_shopping_cart" data-codigo="<?= $row["codigo_habitacion"] ?>" 
          data-categoria="<?= $row["nombre_categoria"] ?>" 
          data-habitacion="<?= $row["nombre_habitacion"] ?>" 
          id="boton<?= $row["codigo_habitacion"] ?>" 
          data-valor="<?= $row["valor_habitacion"] ?>" 
          data-cant="<?= $row["cant_habitacion"] ?>">
        <i class="material-icons">add_shopping_cart</i>
      </a>
    <?php } ?>
  </article>
  <?php if($row['estado_promocion'] == "promocion"){ ?>
    <article class="Habitacion-info z-depth-1" style="width: 100%;">
      <h3 style="font-weight:bold;text-align:center;margin:0;">Promocion</h3>
      <p><?= $row["detalle_promocion"] ?></p>
    </article>
  <?php } ?>
  <article class="Habitacion-info z-depth-1">
    <p><?= $row["detalle_habitacion"] ?></p>
  </article>  
  <aside class="Habitacion-costo z-depth-1">
    <p>Valor: $<?= $row["valor_habitacion"] ?> USD</p>
  </aside>
</div>

<section class="col s12 m6 Reservas-formularios-cliente u-none">
  <div class="form-cliente row white z-depth-1">
    <div>
      <h5 class="no-margin" style="text-align: right;margin-right: .5em;">
        Cliente: <strong><?= $user ?></strong>
      </h5>
    </div>
    <div class="col-12">
      <div class="input-field col s6">
        <input type="date" id="fecha" class="datepicker" min="<?= $hoy ?>">
        <label class="label-debe">Fecha de ingreso</label>
      </div>
      <div class="input-field col s6">
        <input type="date" class="datepicker" id="hasta" min="<?= $hoy ?>">
        <label class="label-hasta">Fecha de salida</label>
      </div>
    </div>
    <div class="col s12">
      <p class="msg-day-hosped">Se hospedaran
        <span id="dayHosped">0</span>dias
      </p>
    </div>
    <div class="space flex">
      <button class="btn red darken-4 waves-effect waves-red cancelar-btn">Cancelar</button>
      <button class="btn color-toolbar waves-effect waves-teal reservacion-btn">Reservar</button>
      <button class="btn-flat waves-effect waves-light retornar">
        retornar
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

<?php include 'partials/form.php'; ?>

<?php include 'footer.php';?>
<script src="assets/js/paginator.js"></script>
<script src="assets/js/reservaciones.js"></script>
