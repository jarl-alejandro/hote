<table class=" highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Nº</th>
     <th data-field="nombre">Producto</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
   <?php
   include '../../../bd/db.php';
   date_default_timezone_set('America/Guayaquil');
   $kardex = $pdo->query("SELECT * FROM vista_kardex");
   $count = 0;
   
   foreach ($kardex as $row) :
    $count++
  ?>
   <tr>
     <td><?= $count ?></td>
     <td><?= $row["nombre_producto"] ?></td>
     <td>
        <button class="btn waves-effect waves-light color-toolbar kardex" data-codigo="<?= $row["codigo_kardex"] ?>"><i class="material-icons">trending_flat</i></button>
       <button class="btn waves-effect waves-light orange darken-4 reporte-table" data-codigo="<?= $row["codigo_kardex"] ?>"><i class="material-icons">polymer</i></button>
     </td>
   </tr>
 <?php endforeach ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("kardex/static/js/actions.js")

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
