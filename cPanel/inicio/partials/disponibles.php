<article class="col s4 Reservas-active MapaDisponible">
  <div class="card activo-card sticky-action card_<?= $row["codigo_habitacion"]?>" style="background: #4CAF50">
    <div class="card-image image-active waves-effect waves-block waves-light cd_<?= $row["codigo_habitacion"] ?>">
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
      <span class="card-title grey-text text-darken-4 title_<?= $row["codigo_habitacion"] ?>">
        <span class="nombre_categoria-reservaciones"><?= $row["nombre_categoria"] ?></span>
        <i class="material-icons right">close</i>
      </span>
      <p><?= $row["detalle_habitacion"] ?></p>
      <div class="flex space">
        <button class="btn color-toolbar waves-effect waves-red reservarHabitacion activo-reservar boton<?= $row["codigo_habitacion"] ?>"
        data-codigo="<?= $row["codigo_habitacion"] ?>" data-categoria="<?= $row["nombre_categoria"] ?>"
        data-habitacion="<?= $row["nombre_habitacion"] ?>"
        data-valor="<?= $row["valor_habitacion"] ?>" data-cant="<?= $row["cant_habitacion"] ?>">ALQUILAR</button>
      </div>
    </div>
    <!-- <div class="card-action"></div> -->
  </div>
</article>
