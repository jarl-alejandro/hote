<style>
.Header-buscador{display:none;}
</style>

<section class="row"> 
<?php 
include '../../bd/db.php';
$habitacion = $pdo->query("SELECT * FROM vista_habitacion WHERE estado_promocion='promocion'");
foreach ($habitacion as $row) : ?>
  <article class="col s6 m4 Reservas-active">
    <div class="card activo-card sticky-action" id="card_<?= $row["codigo_habitacion"]?>">
      <div class="card-image image-active waves-effect waves-block waves-light" id="cd_<?= $row["codigo_habitacion"] ?>">
        <img class="activator" src="../media/habitaciones/<?= $row["imagen_habitacion"] ?>" />
      </div>
      <div class="card-content" style="padding:10px !important;margin-bottom: 1em;">
        <span class="card-title activator grey-text text-darken-4" id="title_<?= $row["codigo_habitacion"] ?>"><?= $row["nombre_categoria"] ?>
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
        <button class="btn color-toolbar waves-effect waves-red anular_promocion"
        data-codigo="<?= $row["codigo_habitacion"] ?>" 
        data-valor="<?= $row["valor_promocion"] ?>">Anular Promocion</button>
      </div>
    </div>
  </article>

<?php endforeach ?>
</section>

<script>
  $.getScript("anular_promocion/static/js/anular.js")
</script>