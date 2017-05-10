<?php if($row["estado_habitacion"] == 0){ ?>
  <!-- Libre -->
  <input type="checkbox" class="number--hab"
        id="check_<?=$row["codigo_habitacion"]?>" />
  <label class="numeroHabitacion card col s1 over-hab ckecklabel"
    style="margin-right: 1em !important" data-id='<?=$row["codigo_habitacion"]?>'
    data-type="Libre" for="check_<?=$row["codigo_habitacion"]?>"
    data-codigo="<?= $row["codigo_habitacion"] ?>" 
    data-categoria="<?= $row["nombre_categoria"] ?>"
    data-habitacion="<?= $row["nombre_habitacion"] ?>"
    data-valor="<?= $row["valor_habitacion"] ?>" 
    data-cant="<?= $row["cant_habitacion"] ?>">
    <h4><?= $row["nombre_habitacion"] ?></h4>
  </label>
<?php } else if($row["estado_habitacion"] == 5){ ?>
  <!-- mantenimiento -->
  <article data-type="Mantenimiento desde <?=$row["desde_fecha"]?>" class="numberHabi card col s1 over-hab" style="margin-right:1em !important;border:4px solid #585650"
    data-id='<?= $row["codigo_habitacion"] ?>'>
    <h4><?= $row["nombre_habitacion"] ?></h4>
  </article>
<?php } else if($row["estado_habitacion"] == 6){ ?>
  <!-- Limpieza -->
  <article data-type="Limpieza" class="numberHabi card col s1 over-hab" style="margin-right:1em !important;border:4px solid #2196f3"
    data-id='<?= $row["codigo_habitacion"] ?>'>
    <h4><?= $row["nombre_habitacion"] ?></h4>
  </article>
<?php } else if($row["estado_habitacion"] == 10){ ?>
  <!-- ocupados -->
  <article
    data-type="Ocupados desde <?=$row["desde_fecha"]?> hasta <?=$row["hasta_fecha"]?>"
    class="numberHabi card col s1 over-hab"
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
    class="numberHabi card col s1 over-hab" style="margin-right:1em !important;border:4px solid #F44336"
      data-id='<?= $row["codigo_habitacion"] ?>'>
      <h4><?= $row["nombre_habitacion"] ?></h4>
    </article>

  <?php } else { ?>
    <input type="checkbox" class="number--hab"
          id="check_<?=$row["codigo_habitacion"]?>" />
    <label for="check_<?=$row["codigo_habitacion"]?>"
      class="numeroHabitacion card col s1 over-hab ckecklabel"
      style="margin-right:1em !important"
      data-id='<?= $row["codigo_habitacion"] ?>' data-type="Libre"
      data-codigo="<?= $row["codigo_habitacion"] ?>" 
      data-categoria="<?= $row["nombre_categoria"] ?>"
      data-habitacion="<?= $row["nombre_habitacion"] ?>"
      data-valor="<?= $row["valor_habitacion"] ?>" 
      data-cant="<?= $row["cant_habitacion"] ?>">
      <h4><?= $row["nombre_habitacion"] ?></h4>
    </label>
  <?php } ?>

<?php } ?>
