  <article class="col s6 m2 Reservas-active">
    <div class="card activo-card sticky-action card_<?= $row["codigo_habitacion"]?>">
      <div class="cinta activo-cinta z-depth-3 red darken-4 white-text reservado_<?= $row["codigo_habitacion"] ?>">RESERVADO</div>
      <div class="card-image image-active waves-effect waves-block waves-light cd_<?= $row["codigo_habitacion"] ?>">
        <img class="activator" src="media/habitaciones/<?= $row["imagen_habitacion"] ?>" style="height: 7em;" />
      </div>
      <div class="card-content" style="padding:10px !important;margin-bottom: 1em;">
        <span class="title--card card-title activator grey-text text-darken-4 title_<?= $row["codigo_habitacion"] ?>"><?= $row["nombre_categoria"] ?>
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
          <span class="title--card nombre_categoria-reservaciones"><?= $row["nombre_categoria"] ?></span>
          <i class="material-icons right">close</i>
        </span>
        <p class="desc_habi"><?= $row["detalle_habitacion"] ?></p>
        <a href="habitacion.php?id=<?= $row["codigo_habitacion"] ?>"
        class="waves-effect waves-light btn blue" style="position: relative;top: -4em;">Ver mas</a>
      </div>
      <div class="card-action">
        <?php
          if (!isset($_SESSION['1a0b858b9a63f19d654116c9f37ae04194ccfdd0'])){ ?>
            <button class="btn color-toolbar waves-effect waves-red reservarHabitacion activo-reservar" disabled>
              Reservar
            </button>
        <?php } else { ?>
          <button class="btn color-toolbar waves-effect waves-red reservarHabitacion activo-reservar
          button<?= $row["codigo_habitacion"] ?>"
          data-codigo="<?= $row["codigo_habitacion"] ?>" data-categoria="<?= $row["nombre_categoria"] ?>"
          data-habitacion="<?= $row["nombre_habitacion"] ?>" id="boton<?= $row["codigo_habitacion"] ?>"
          data-valor="<?= $row["valor_habitacion"] ?>" data-cant="<?= $row["cant_habitacion"] ?>">Reservar</button>
        <?php } ?>
      </div>
    </div>
  </article>
