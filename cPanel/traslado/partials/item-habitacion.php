<article class="col s6 m4 Reservas-active">
  <div class="card activo-card sticky-action">
    <div class="card-image image-active waves-effect waves-block waves-light" id="cd_<?= $row["codigo_habitacion"] ?>">
      <img class="activator" src="../media/habitaciones/<?= $row["imagen_habitacion"] ?>" />
    </div>
    <div class="card-content" style="padding:10px !important">
      <span class="card-title activator grey-text text-darken-4"><?= $row["nombre_categoria"] ?>
        <i class="material-icons right">more_vert</i>
      </span>
      <p>
        <a href="#">N° <?= $row["nombre_habitacion"] ?></a>
        <a href="#" style="float:right">Precio $<?= $row["valor_habitacion"] ?></a>
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
      <button class="btn-flat waves-effect waves-light blue-text">Trasladar</button>
    </div>
  </div>
</article>