<?php
  $desde = $_GET["desde"];
  $hasta = $_GET["hasta"]; 
?>
<table class=" highlight responsive-table bordered z-depth-1 centered"
        id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">#</th>
     <th data-field="Cliente">Cliente</th>
     <th data-field="Fecha">Fecha</th>
     <th data-field="Precio">Precio</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
<?php
  include '../../../bd/db.php';
  $pagos = $pdo->query("SELECT * FROM v_pagos_mensuales WHERE mensual_fecha 
                                        BETWEEN '$desde' AND '$hasta'");
  $id = 0;

  if($pagos->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay pagos mensuales para las fechas indica</td>
    </tr>";
  }
  else{
    foreach ($pagos as $row) :
      $id++;
?>
   <tr>
     <td><?= $id ?></td>
     <td><?= $row["cliente"] ?></td>
     <td><?= $row["mensual_fecha"] ?></td>
     <td><?= $row["mensual_precio"] ?></td>
     <td>
      <button class="btn waves-effect waves-light orange darken-4 reporte-table"
        data-codigo="<?= $row["mensual_id"] ?>"><i class="material-icons">polymer</i>
      </button>
     </td>
   </tr>
 <?php endforeach ?>
 <?php } ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>
<button class="waves-effect waves-light btn btn-primary" id="CerrarFecha">Cerrar</button>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("pagos_mensuales/static/js/actions.js")

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
