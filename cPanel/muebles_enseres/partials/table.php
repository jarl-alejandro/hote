<table class=" highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Codigo</th>
     <th data-field="Mubles">Mubles Y Enseres</th>
     <th data-field="Precio">Precio</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
   <?php
   include '../../../bd/db.php';
   $categoria = $pdo->query("SELECT * FROM hotel_muebles");
   if($categoria->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay muebles y enseres</td>
    </tr>";
   }
   else {
   foreach ($categoria as $row) :?>
   <tr>
     <td><?= $row["codigo_mueble"] ?></td>
     <td><?= $row["desc_mueble"] ?></td>
     <td><?= $row["precio_mueble"] ?></td>
     <td>
       <button class="btn waves-effect waves-light blue darken-4 editar" data-codigo="<?= $row["codigo_mueble"] ?>"><i class="material-icons">edit</i></button>

       <button class="btn waves-effect waves-light red darken-4 eliminar" data-codigo="<?= $row["codigo_mueble"] ?>"><i class="material-icons">delete</i></button>

       <button class="btn waves-effect waves-light orange darken-4 reporte-table" data-codigo="<?= $row["codigo_mueble"] ?>"><i class="material-icons">polymer</i></button>
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
  $.getScript("muebles_enseres/static/js/actions.js")

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
