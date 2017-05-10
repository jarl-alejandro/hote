<?php
  $id = $_GET["id"];
  include '../../../bd/db.php';
  $query = $pdo->query("SELECT * FROM vista_habitacion WHERE codigo_habitacion='$id'");
  $row = $query->fetch();
?>

<article class="Reservas-active habitacion-col">
  <div class="card activo-card sticky-action card_<?= $row["codigo_habitacion"]?>">
    <div class="cinta activo-cinta z-depth-3 red darken-4 white-text reservado_<?= $row["codigo_habitacion"] ?>">ALQUILADO</div>
    <div class="card-image image-active waves-effect waves-block waves-light cd_<?= $row["codigo_habitacion"] ?>">
      <img class="activator" src="../media/habitaciones/<?= $row["imagen_habitacion"] ?>" />
    </div>
    <div class="card-content" style="padding:10px !important;margin-bottom: 1em;">
      <span class="card-title activator grey-text text-darken-4 title_<?= $row["codigo_habitacion"] ?>"><?= $row["nombre_categoria"] ?>
        <i class="material-icons right">more_vert</i>
      </span>
      <p>
        <a href="#">N° <?= $row["nombre_habitacion"] ?></a>
        <a href="#" style="float:right">Precio $<?= $row["valor_habitacion"] ?></a>
      </p>
      <p style="position: relative;">
        <?php if($row["estado_promocion"] == "promocion"){ ?>
        <a href="#" class="promocion-cinta red-text">
          Antes $<?= $row["valor_promocion"] ?>
        </a>
        <span class="antes-cinta red"></span>
        <?php } ?>
      </p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">
        <span class="nombre_categoria-reservaciones"><?= $row["nombre_categoria"] ?></span>
        <i class="material-icons right">close</i>
      </span>
      <p><?= $row["detalle_habitacion"] ?></p>
    </div>
    <div class="card-action">
      <button class="btn color-toolbar waves-effect waves-red reservarHabitacion activo-reservar boton<?= $row["codigo_habitacion"] ?>"
        data-codigo="<?= $row["codigo_habitacion"] ?>" data-categoria="<?= $row["nombre_categoria"] ?>"
        data-habitacion="<?= $row["nombre_habitacion"] ?>"
        data-valor="<?= $row["valor_habitacion"] ?>" data-cant="<?= $row["cant_habitacion"] ?>"><i class="material-icons">done_all</i></button>
        <button class="btn red darken-4" id="closeHabitacion">
          <i class="material-icons">close</i>
        </button>
      </div>
    </div>
  </article>

<script>
  $.getScript("inicio/static/js/habitaciones.js")
</script>
