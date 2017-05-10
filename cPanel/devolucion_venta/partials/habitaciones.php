<article class="z-depth-1 Habitaciones col s4">
  <header class="Habitaciones-header">
    <h4 class="center color-toolbar white-text u-no-margin">Habitaciones</h4>
  </header>
  <div class="Habitaciones-body">
    <ul>
    <?php include '../../bd/db.php';
    $habitaciones = $pdo->query("SELECT * FROM vista_reservacion_habitacion WHERE estado_reservacion='1'");
    $count = $habitaciones->rowCount();
    if($count == 0) { ?>
      <li class="Habitacion-item flex space">
        <a>No hay habitaciones</a>
      </li>
    <?php }
      foreach ($habitaciones as $habitacion):?>
        <li class="Habitacion-item flex space">
          <a>Habitacion N° <?= $habitacion["nombre_habitacion"] ?></a>
          <button class="btn-floating btn color-acent waves-effect waves-light btn-habitacion" style="margin-bottom:3px"
            data-nombre="<?= $habitacion["nombre_habitacion"] ?>" data-cant="<?= $habitacion["cant_detalle"] ?>"
            data-codigo="<?= $habitacion["codigo_habitacion"] ?>">
            <i class="material-icons">done</i>
          </button>
        </li>
      <?php endforeach  ?>
    </ul>
    <button class="red darken-4 btn waves-effect waves-light cerrar-habitacion" style="margin:0 auto;display:block;margin-bottom:1em">Cancelar
      <i class="material-icons right">clear</i>
    </button>
  </div>
</article>
