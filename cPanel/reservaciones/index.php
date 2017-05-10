<?php
date_default_timezone_set('America/Guayaquil');
$hoy = date("Y-m-d");
?>
<style>.Layout{ width: 100%; top: 3em !important; }
.col{margin:0 !important;} .row{margin-bottom: 0em !important}
.min-sig{ display: flex; }
.Header-buscador{ display:none; }
</style>
<input type="hidden" id="fecha_actual" value="<?= $hoy ?>" />
<input type="hidden" id="totalHab" />
<section class="row">
  <section class="Reservas-Habitaciones col s12 m6">
    <?php
    include '../../bd/db.php';
    $habitacion = $pdo->query("SELECT * FROM vista_habitacion WHERE es_habitacion='0' ORDER BY nombre_habitacion ASC");
    foreach ($habitacion as $row) :
      include 'partials/numero.php';
    endforeach ?>
  </section>
  <div class="habitacion-modal"></div>

  <section class="col s12 m6 ReservasForm" style="position:relative;top:-3em;">
    <div class="form-cliente row white z-depth-1">
      <div class="input-field col s12">
        <i class="material-icons prefix">account_circle</i>
        <select id="cliente">
          <option value="" disabled selected>Elige tu opcion</option>
          <?php
            $socios = $pdo->query("SELECT * FROM hotel_cliente WHERE cedula_cliente != 'xxxxxxxxxx'");
            if($habitacion->rowCount() == 0){
              echo "<h2>No hay habitaciones</h2>";
            }
            foreach ($socios as $socio): ?>
              <option value="<?= $socio["cedula_cliente"] ?>"><?= $socio["nombre_cliente"] ?></option>
            <?php endforeach ?>
        </select>
        <label>Cliente</label>
      </div>

      <div class="col-12">
        <div class="input-field col s6">
          <input type="date" id="fecha" class="datepicker" min="<?= $hoy ?>">
          <label class="label-fecha" for="fecha">Fecha de ingreso</label>
        </div>
        <div class="input-field col s6">
          <input type="text" id="dias--quedar" maxlength="2"
            onkeypress="ValidaSoloNumeros()" />
          <label class="label-fecha" for="dias--quedar">Hasta</label>
        </div>
        <div class="col s12">
          <p class="msg-day-hosped">Se hospedara hasta
            <span id="dayHosped"><?= $hoy ?></span>
          </p>
        </div>
      </div>

      <div class="space flex">
        <button class="btn red darken-4 waves-effect waves-red cancelar-btn">Cancelar</button>
        <button class="btn color-toolbar waves-effect waves-teal reservacion-btn">Reservar</button>
        <button class="btn color-toolbar waves-effect waves-teal update-btn u-none">Reservar</button>
        <a id="table-reservaciones" class="btn btn-primary waves-effect waves-teal modal-trigger">
          Ver Reservaciones
        </a>
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
<?php include 'partials/form.php'; ?>
<?php include 'partials/table-reservaciones.php'; ?>

 <script src="static/js/jquery_searchtable.js"></script>
<script src="static/js/paging.js"></script>
<script>
  $.getScript("reservaciones/static/js/paginator.js")
  $.getScript("reservaciones/static/js/reservaciones.js")
  $.getScript("reservaciones/static/js/editar.js")
</script>
