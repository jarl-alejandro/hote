<h4 class="center-align" style="color:#585650;margin:0 0 .5em 0">Habitaciones Disponibles</h4>
<div class="col s12">
  <?php
  include '../../bd/db.php';
  $habitacion = $pdo->query("SELECT * FROM vista_habitacion WHERE estado_habitacion=0");

  foreach ($habitacion as $row) :
    include 'partials/item-habitacion.php';
  endforeach 
  ?>
</div>

<div class="flex space" style="margin-bottom:1em !important">
  <button class="btn waves-effect waves-light red darken-3 cancelar-reporte">Cancelar</button>
</div>
<script>
   $(".cancelar-reporte").on("click", function () {
    $(".habitacionesContainer").slideUp()
  })
</script>