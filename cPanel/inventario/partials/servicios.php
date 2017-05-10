<table class=" highlight responsive-table bordered z-depth-1 centered" id="Tab_FilterB">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Codigo</th>
     <th data-field="Servicios">Servicios</th>
     <th data-field="Valor">Valor</th>
     <th data-field="Cantidad">Cantidad</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
   <?php
   include '../../bd/db.php';
   $productos = $pdo->query("SELECT * FROM hotel_producto WHERE tipo_producto='servicios'");
   foreach ($productos as $row) :?>
   <tr>
     <td><?= $row["codigo_producto"] ?></td>
     <td><?= $row["nombre_producto"] ?></td>
     <td><?= $row["valor_producto"] ?></td>
     <td><?= $row["cantidad_producto"] ?></td>
     <td>
      <button class="btn waves-effect waves-light orange darken-4 reporte-servicio" data-codigo="<?= $row["codigo_producto"] ?>"><i class="material-icons">polymer</i></button>
     </td>
   </tr>
 <?php endforeach ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_a"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>

  var pager = new Pager('Tab_FilterB', 5);
  pager.init();
  pager.showPageNav('pager', 'NavPosicion_a');
  pager.showPage(1);

  $(document).ready(function() {
    $(function() {
      theTable = $("#Tab_FilterB");
      $("#buscador").keyup(function() {
        $.uiTableFilter(theTable, this.value);
      });
    });
  });
</script>