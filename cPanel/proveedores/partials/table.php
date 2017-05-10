
<table class=" highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Codigo</th>
     <th data-field="nombre">Nombre del proveedor</th>
     <th data-field="email">E-mail</th>
     <th data-field="direccion">Nombre del Contacto</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
   <?php
   include '../../../bd/db.php';
   $proveedores = $pdo->query("SELECT * FROM hotel_proveedor");
   if($proveedores->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay proveedores</td>
    </tr>";
   }
   else {
   foreach ($proveedores as $row) :?>
   <tr>
     <td><?= $row["codigo_proveedor"] ?></td>
     <td><?= $row["nombre_proveedor"] ?></td>
     <td><?= $row["email_proveedor"] ?></td>
     <td><?= $row["nombre_contacto"] ?></td>
     <td>
       <button class="btn waves-effect waves-light blue darken-4 editar" data-codigo="<?= $row["codigo_proveedor"] ?>"><i class="material-icons">edit</i></button>
       <button class="btn waves-effect waves-light red darken-4 eliminar" data-codigo="<?= $row["codigo_proveedor"] ?>"><i class="material-icons">delete</i></button>
       <button class="btn waves-effect waves-light orange darken-4 reporte-table" data-codigo="<?= $row["codigo_proveedor"] ?>"><i class="material-icons">polymer</i></button>
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
  $.getScript("proveedores/static/js/actions.js")

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
