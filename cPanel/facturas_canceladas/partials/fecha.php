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
  $facturas = $pdo->query("SELECT * FROM v_facturas_canceladas WHERE fecha_facturam 
                                        BETWEEN '$desde' AND '$hasta'");
  $id = 0;

  if($pagos->rowCount() == 0 && $facturas->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay facturas canceladas para las fechas indicada</td>
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
        data-codigo="<?= $row["mensual_id"] ?>" data-type="mensual"><i class="material-icons">polymer</i>
      </button>
     </td>
   </tr>
 <?php endforeach;
 while($row = $facturas->fetch()){
   $id++;
  ?>
  <tr>
    <td><?= $id ?></td>
    <td><?= $row["cliente"] ?></td>
    <td><?= $row["fecha_facturam"] ?></td>
    <td><?= $row["total_facturam"] ?></td>
    <td>
      <button class="btn waves-effect waves-light orange darken-4 reporte-table"
        data-codigo="<?= $row["codigo_facturam"] ?>" data-type="factura"><i class="material-icons">polymer</i>
      </button>
    </td>
  </tr>
 <?php } 
 }?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>
<button class="waves-effect waves-light btn btn-primary" id="CerrarFecha">Cerrar</button>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("facturas_canceladas/static/js/actions.js")

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
