<table class=" highlight responsive-table bordered z-depth-1 centered"
        id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">#</th>
     <th data-field="Compra">Compra</th>
     <th data-field="Fecha">Fecha</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
<?php
  include '../../../bd/db.php';
  $compras = $pdo->query("SELECT * FROM tmp_compra");
  $id = 0;

  if($compras->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay compras</td>
    </tr>";
  }
  else{
    foreach ($compras as $row) :
      $id++;
?>
   <tr>
     <td><?= $id ?></td>
     <td>Compra segun factura #<?= $row["comp_factura"] ?></td>
     <td><?= $row["comp_fecha"] ?></td>
     <td>     
      <button class="btn waves-effect waves-light orange darken-4 reporte-table"
        data-codigo="<?= $row["comp_id"] ?>" data-type="mensual"><i class="material-icons">polymer</i>
      </button>
     </td>
   </tr>
 <?php endforeach;
 }?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("compras-fecha/static/js/actions.js")

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
