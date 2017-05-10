<?php
date_default_timezone_set('America/Guayaquil');
$hoy = date("Y-m-d");
?>
<style>.Layout{ width: 100%; top: 3em !important; }
.col{margin:0 !important;} .row{margin-bottom: 0em !important}
.min-sig{
  display: flex;
}
.ckecklabel:before{
  display: none;
}
</style>
<style>.Header-buscador{display:none;}</style>
<input type="hidden" id="fecha_actual" value="<?= $hoy ?>" />

<section class="row">
  <section class="Reservas-Habitaciones col s12 m6">
    <?php
    include '../../bd/db.php';
    $habitacion = $pdo->query("SELECT * FROM vista_habitacion WHERE es_habitacion='1' ORDER BY nombre_habitacion ASC");
    if($habitacion->rowCount() == 0){
      echo "<h2>No hay departamentos</h2>";
    }
    else{
      foreach ($habitacion as $row) {
        include 'partials/numero.php';
      }
    } ?>
  </section>
  <div class="habitacion-modal"></div>

  <section class="col s12 m6 ReservasForm" style="position:relative;top:-2em;">
    <div class="form-cliente row white z-depth-1">
      <div class="input-field col s12">
        <i class="material-icons prefix">account_circle</i>
        <select id="cliente">
          <option value="" disabled selected>Selecion al cliente</option>
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
        <div class="input-field col s6 push-s3 u-none">
          <input type="date" id="fecha" class="datepicker" min="<?= $hoy ?>"
            value="<?= $hoy ?>">
          <label class="label-fecha" for="fecha">Fecha de ingreso</label>
        </div>
      </div>

      <div class="space flex">
        <button class="btn red darken-4 waves-effect waves-red cancelar-btn">Cancelar</button>
        <button class="btn color-toolbar waves-effect waves-teal reservacion-btn">Reservar</button>
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
          </tr>
        </thead>
        <tbody id="habitaciones_reservadas"></tbody>
        <tbody>
          <tr>
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
<script src="static/js/jquery_searchtable.js"></script>
<script src="static/js/paging.js"></script>
<script>
  $.getScript("reservaciones/static/js/paginator.js")
</script>
<script type="text/javascript" src="departamentos/static/grupos.js"></script>
<script type="text/javascript" src="departamentos/static/index.js"></script>
