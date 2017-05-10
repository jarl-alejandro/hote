
<table class=" highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Codigo</th>
     <th data-field="Nombre">Nombre</th>
     <th data-field="Cantidad">Cantidad</th>
     <th data-field="Valor">Valor</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
  <?php
   include '../../../bd/db.php';
   $producto = $pdo->query("SELECT * FROM hotel_producto WHERE estado_producto='1'");
   if($producto->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay productos</td>
    </tr>";
   }
   else{
   foreach ($producto as $row) :
  ?>
   <tr>
     <td><?= $row["codigo_producto"] ?></td>
     <td><?= $row["nombre_producto"] ?></td>
     <td><?= $row["cantidad_producto"] ?></td>
     <td><?= $row["valor_producto"] ?></td>
     <td>
       <button class="btn waves-effect waves-light orange darken-4 reporte-table"
        data-codigo="<?= $row["codigo_producto"] ?>"><i class="material-icons">polymer</i>
        </button>
     </td>
   </tr>
 <?php endforeach; 
   }
 ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("pedidos/static/js/actions.js")

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
