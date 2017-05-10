  <article class="col s6 m4 Reservas-active" style="left: 10em;">
    <div class="card sticky-action" id="card_<?= $row["codigo_habitacion"]?>" style="box-shadow:none !important">
      <div class="cinta z-depth-3 red darken-4 white-text reservado_<?= $row["codigo_habitacion"] ?>" style="display:block">RESERVADO</div>
      <div class="card-image waves-effect waves-block waves-light" id="cd_<?= $row["codigo_habitacion"] ?>"
        style="-webkit-filter: blur(2px);">
        <img src="../media/habitaciones/<?= $row["imagen_habitacion"] ?>" />
      </div>
      <div class="card-content" style="padding:10px !important">
        <span class="card-title grey-text text-darken-4" id="title_<?= $row["codigo_habitacion"] ?>"><?= $row["nombre_categoria"] ?>
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
        <button class="btn color-toolbar waves-effect waves-red reservarHabitacion" disabled>Reservar</button>
      </div>
    </div>
  </article>
