<?php
date_default_timezone_set('America/Guayaquil');
$hoy = date("Y-m-d");

if(isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){
  $user =  $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"];
}
else {
  $user = "Invitado";
}
?>
<style>
.Layout{ width: 100% } .col{margin:0 !important;}
.row{margin-bottom: 0em !important}
</style>
<input type="hidden" id="fecha_actual" value="<?= $hoy ?>" />
<section class="row">
  <div class="input-field col s4">
    <i class="material-icons prefix">bookmark_border</i>
    <select class"browser-default" id="categorias">
      <option value="" disabled selected>Seleciona tu habitación.</option>
      <option value="todos">Habitaciones</option>
      <?php
      $categorias_select = $pdo->query("SELECT * FROM hotel_categoria");
      while ($row = $categorias_select->fetch()){ ?>
        <option value="<?= $row["codigo_categoria"] ?>">
          <?= $row["nombre_categoria"] ?>
        </option>
      <?php } ?>
    </select>
    <label>Habitaciónes</label>
  </div>

  <section class="Reservas-Habitaciones">
    <?php
    $categorias_hab = $pdo->query("SELECT * FROM hotel_categoria");
    while ($cat = $categorias_hab->fetch()) {
      $cod = $cat["codigo_categoria"];
    ?>
    <section class="col s12">
      <input type="hidden" id="catInput<?=$cod?>" value="<?=$cod?>" />
      <h2 class="center-align nombre_categoria">HABITACIÓN <?= $cat["nombre_categoria"] ?></h2>
    <?php
      $habitaciones = $pdo->query("SELECT * FROM vista_habitacion WHERE categoria_habitacion='$cod' 
                                      AND es_habitacion='0'");
      if($habitaciones->rowCount() == 0){?>
        <h4 class="center-align" style="width: 100%;">No hay habitación <?= $cat["nombre_categoria"] ?></h4>
      <?php }
      while ($row = $habitaciones->fetch()) {
        if($row["estado_habitacion"] != "5" || $row["estado_habitacion"] != "6"
          || $row["estado_habitacion"] != "10") {
          include './partials/habitacion.php';
        }
      }?>
    </section>
  <?php } ?>
  </section>

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
          <input type="text" id="dias--quedar" maxlength="2"
            onkeypress="ValidaSoloNumeros()" />
          <label class="label-fecha">Dias de hospedaje</label>
        </div>
      </div>
      <div class="col s12">
        <p class="msg-day-hosped">Se hospedara
          <span id="dayHosped"></span>
        </p>
      </div>
      <div class="space flex">
        <button class="btn red darken-4 waves-effect waves-red cancelar-btn">Cancelar</button>
        <button class="btn color-toolbar waves-effect waves-teal reservacion-btn">Reservar</button>
        <button class="btn-flat waves-effect waves-light retornar">
          mas habitaciónes
        </button>
      </div>
    </div>
    <section class="col s12 white z-depth-1" style="padding-bottom:1em !important;margin-top:1em !important;">
      <table class="table striped centered bordered" id="Tab_Filter">
        <thead>
          <tr>
            <th>Categoria</th>
            <th>Habitación</th>
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
<?php include 'partials/form.php'; ?>

<!-- <script src="static/js/jquery_searchtable.js"></script> -->
<!-- <script src="cPanel/static/js/paging.js"></script> -->
<script src="assets/js/paginator.js"></script>
<script src="assets/js/reservaciones.js"></script>
