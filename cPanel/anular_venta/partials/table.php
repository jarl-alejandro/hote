  
<table class="highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Codigo</th>
     <th data-field="fecha">fecha</th>
     <th data-field="Descripcion">Descripcion</th>
     <th data-field="Total">Total</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
   <?php
   $count = 0;
   include '../../../bd/db.php';
   $categoria = $pdo->query("SELECT * FROM hotel_ventas WHERE venta_estado != 'pagado'");
   foreach ($categoria as $row) :
    $count++;
  ?>
   <tr>
     <td><?= $count ?></td>
     <td><?= $row["fecha_venta"] ?></td>
     <td><?= $row["detalle_venta"] ?></td>
     <td><?= $row["total_venta"] ?></td>
     <td>
       <button class="btn waves-effect waves-light blue darken-4 factura-see" data-codigo="<?= $row["codigo_venta"] ?>"><i class="material-icons">remove_red_eye</i></button>
       <button class="btn waves-effect waves-light orange darken-4 anular" data-codigo="<?= $row["codigo_venta"] ?>"><i class="material-icons">polymer</i></button>
     </td>
   </tr>
 <?php endforeach ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("anular_venta/static/js/actions.js")

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
