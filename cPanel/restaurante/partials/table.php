
<table class="highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Codigo</th>
     <th data-field="fecha">fecha</th>
     <th data-field="Total">Total</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
   <?php
   $count = 0;
   include '../../../bd/db.php';
   $categoria = $pdo->query("SELECT * FROM hotel_restaurante");
   if($categoria->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay pedidos</td>
    </tr>";
   }
   else {
   foreach ($categoria as $row) :
    $count++;
  ?>
   <tr>
     <td><?= $count ?></td>
     <td><?= $row["fecha_restaurante"] ?></td>
     <td><?= $row["total_restaurante"] ?></td>
     <td>
       <button class="btn waves-effect waves-light blue darken-4 factura-see" data-codigo="<?= $row["codigo_restaurante"] ?>"><i class="material-icons">edit</i></button>
       <button class="btn waves-effect waves-light orange darken-4 reporte-table" data-codigo="<?= $row["codigo_restaurante"] ?>"><i class="material-icons">polymer</i></button>
     </td>
   </tr>
 <?php endforeach ?>
 <?php } ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("restaurante/static/js/actions.js")

  var pager = new Pager('Tab_Filter', 5);
  pager.init();
  pager.showPageNav('pager', 'NavPosicion_b');
  pager.showPage(1);

  $(document).ready(function() {
    $(function() {
      theTable = $("#Tab_Filter");
      $("#buscador").keyup(function() {
        $.uiTableFilter(theTable, this.value);
      });
    });
  });
</script>
