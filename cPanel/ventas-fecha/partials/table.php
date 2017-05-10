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
  $mensuales = $pdo->query("SELECT * FROM vh_restaurante");
  $id = 0;

  if($mensuales->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay facturas</td>
    </tr>";
  }
  else{
    foreach ($mensuales as $row) :
      $id++;
?>
  <tr>
    <td><?= $id ?></td>
    <td><?= $row["cliente"] ?></td>
    <td><?= $row["fecha_restaurante"] ?></td>
    <td><?= $row["total_restaurante"] ?></td>
    <td>
      <!--<button class="btn waves-effect waves-light blue darken-4 factura-see" data-codigo="<?= $row["codigo_restaurante"] ?>"><i class="material-icons">edit</i></button>-->
      <button class="btn waves-effect waves-light orange darken-4 reporte-table" data-codigo="<?= $row["codigo_restaurante"] ?>"><i class="material-icons">polymer</i></button>
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
  $.getScript("ventas-fecha/static/js/actions.js")

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
