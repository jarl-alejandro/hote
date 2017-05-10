<?php
  $desde = $_GET["desde"];
  $hasta = $_GET["hasta"]; 
?>

<table class=" highlight responsive-table bordered z-depth-1 centered"
        id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">#</th>
     <th data-field="Cliente">Habitacion Nueva</th>
     <th data-field="Fecha">Habitacion Vieja</th>
     <th data-field="Precio">Fecha</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
<?php
  include '../../../bd/db.php';
  $traslado = $pdo->query("SELECT * FROM vista_traslado  WHERE tras_fecha 
                                        BETWEEN '$desde' AND '$hasta'");
  $id = 0;

  if($traslado->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay traslado</td>
    </tr>";
  }
  else{
    foreach ($traslado as $row) :
      $id++;
?>
  <tr>
    <td><?= $id ?></td>
    <td>N° <?= $row["nombre_habitacion"] ?></td>
    <td>N° <?= $row["tras_hvie"] ?></td>
    <td><?= $row["tras_fecha"] ?></td>
    <td>
      <button class="btn waves-effect waves-light orange darken-4 reporte-table" 
        data-codigo="<?= $row["tras_id"] ?>"><i class="material-icons">polymer</i>
      </button>
    </td>
  </tr>
 <?php endforeach;
 }?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>
<button class="waves-effect waves-light btn btn-primary" id="CerrarFecha">Cerrar</button>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("traslado-fecha/static/js/actions.js")

  var pager = new Pager('Tab_Filter', 5);
  pager.init();
  pager.showPageNav('pager', 'NavPosicion_b');
  pager.showPage(1);

  $(document).ready(function() {
    var theTable = $("#Tab_Filter");
    $("#buscador").keyup(function() {
      $.uiTableFilter(theTable, this.value);
    });
  });
</script>
