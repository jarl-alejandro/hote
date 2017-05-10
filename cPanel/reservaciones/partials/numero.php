<?php if($row["estado_habitacion"] == 0){ ?>
  <!-- Libre -->
  <article class="numeroHabitacion card col s1"
    style="margin-right: 1em !important" data-id='<?= $row["codigo_habitacion"] ?>'>
    <h4><?= $row["nombre_habitacion"] ?></h4>
  </article>
<?php } else if($row["estado_habitacion"] == 5){ ?>
  <!-- mantenimiento -->
  <article data-type="Mantenimiento desde <?=$row["desde_fecha"]?>" class="numberHabi card col s1" style="margin-right:1em !important;border:4px solid #585650"
    data-id='<?= $row["codigo_habitacion"] ?>'>
    <h4><?= $row["nombre_habitacion"] ?></h4>
  </article>
<?php } else if($row["estado_habitacion"] == 6){ ?>
  <!-- Limpieza -->
  <article data-type="Limpieza" class="numberHabi card col s1" style="margin-right:1em !important;border:4px solid #2196f3"
    data-id='<?= $row["codigo_habitacion"] ?>'>
    <h4><?= $row["nombre_habitacion"] ?></h4>
  </article>
<?php } else if($row["estado_habitacion"] == 10){ ?>
  <!-- ocupados -->
  <article data-type="Ocupados desde <?=$row["desde_fecha"]?> hasta <?=$row["hasta_fecha"]?>"
    class="numberHabi card col s1"
    style="margin-right:1em !important;border:4px solid #B71C1C"
    data-id='<?= $row["codigo_habitacion"] ?>'>
    <h4><?= $row["nombre_habitacion"] ?></h4>
  </article>
<?php } else if($row["estado_habitacion"] == 1){
  $codigo = $row["codigo_habitacion"];
  $hoy = date("Y-m-d");
  $tmp = $pdo->query("SELECT * FROM tmp_reservacion_h WHERE cod_habit='$codigo'
                  AND fecha_init='$hoy'");

  if($tmp->rowCount() > 0){  ?>
    <article data-type="Reservacion desde <?=$row["desde_fecha"]?> hasta <?=$row["hasta_fecha"]?>" 
      class="numberHabi card col s1"
      style="margin-right:1em !important;border:4px solid #bfa145"
      data-id='<?= $row["codigo_habitacion"] ?>'>
      <h4><?= $row["nombre_habitacion"] ?></h4>
    </article>

  <?php } else { ?>
    <article class="numeroHabitacion card col s1" style="margin-right:1em !important"
      data-id='<?= $row["codigo_habitacion"] ?>'>
      <h4><?= $row["nombre_habitacion"] ?></h4>
    </article>
  <?php } ?>

<?php } ?>
