<article class="z-depth-1 Habitaciones col s4">
  <header class="Habitaciones-header">
    <h4 class="center color-toolbar white-text u-no-margin">Clientes</h4>
  </header>
  <div class="Habitaciones-body">
    <ul>
      <li></li>
      <?php include '../../bd/db.php';
      $habitaciones = $pdo->query("SELECT * FROM hotel_cliente");
      $count = $habitaciones->rowCount();
      if($count == 0) { ?>
        <li class="Habitacion-item flex space">
          <a>No hay Clientes</a>
        </li>
      <?php }
        foreach ($habitaciones as $habitacion):?>
          <li class="Habitacion-item flex space">
            <a style="width: 70%;"><?= $habitacion["apellido_cliente"]." ".$habitacion["nombre_cliente"] ?></a>
            <button class="btn-floating btn color-acent waves-effect waves-light btn-habitacion" style="margin-bottom:3px"
              data-codigo="<?= $habitacion["cedula_cliente"] ?>" data-direccion="<?= $habitacion["direccion_cliente"] ?>"
              data-nombre="<?= $habitacion["nombre_cliente"]." ".$habitacion["apellido_cliente"] ?>">
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
<script>
  $.getScript("restaurante/static/js/actions.js")
</script>