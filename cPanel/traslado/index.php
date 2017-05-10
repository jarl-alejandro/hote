<?php
  include '../../bd/db.php';
  $reser = $pdo->query("SELECT * FROM hotel_habitacion WHERE estado_habitacion='10'");
?>
<section class="white z-depth-1 row" style="padding:1em;">
  <div class="input-field col s6 offset-s3">
    <select id="habitacion">
      <option value="" disabled selected>Selecion la habitacion</option>
      <?php foreach ($reser as $row) : ?>
        <option value="<?= $row["nombre_habitacion"] ?>">N° <?= $row["nombre_habitacion"] ?></option>
      <?php endforeach ?>
    </select>
    <label>Trasladar habitacion</label>
  </div>
  <table class="bordered striped centered responsive-table">
    <thead>
      <tr>
        <th data-field="Codigo">Cedula</th>
        <th data-field="Habitacion">Cliente</th>
        <th data-field="Foto">Valor</th>
      </tr>
    </thead>
    <tbody id="habitaciones"></tbody>
  </table>

  <div class="input-field col s6 offset-s3">
    <select id="habitacion_new">
      <option value="" disabled selected>Selecion la habitacion</option>
      <?php
      $habitaciones = $pdo->query("SELECT * FROM hotel_habitacion WHERE estado_habitacion='0' AND es_habitacion='0'");
      foreach ($habitaciones as $row) : ?>
        <option value="<?= $row["codigo_habitacion"] ?>">N° <?= $row["nombre_habitacion"] ?></option>
      <?php endforeach ?>
    </select>
    <label>Nueva Habitacion</label>
  </div>
  <div class="input-field col s3">
    <input type="checkbox" id="mismoValor" />
     <label for="mismoValor">Seguir con el valor</label>
  </div>
  <div class="flex space">
    <button class="waves-effect waves-light btn-flat" id="trasladar">Transladar
      <i class="material-icons right">send</i>
    </button>
  </div>
</section>
<div class="row">
  <section class="habitacionesContainer z-depth-1 col s12 m7">
    <?php include 'partials/disponibles.php'; ?>
  </section>
</div>
<script>
  $.getScript("traslado/static/js/index.js")
</script>
