
<table class=" highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
 <thead class="red darken-4 white-text">
   <tr>
     <th data-field="id">Cedula</th>
     <th data-field="nombre">Nombre y Apellido</th>
     <th data-field="email">E-mail</th>
     <th data-field="direccion">Direccion</th>
     <th data-field="accion">Accion</th>
   </tr>
 </thead>

 <tbody class="white">
   <?php
   include '../../../bd/db.php';
   $empleado = $pdo->query("SELECT * FROM hotel_empleado");
   if($empleado->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay empleados</td>
    </tr>";
   }
   else {
   foreach ($empleado as $row) :?>
   <tr>
     <td><?= $row["cedula_empleado"] ?></td>
     <td><?= $row["nombre_empleado"]." ".$row["apellido_empleado"] ?></td>
     <td><?= $row["email_empleado"] ?></td>
     <td><?= $row["direccion_empleado"] ?></td>
     <td>
       <?php if($row["cedula_empleado"] == "1234567890") { ?>
        <button class="btn waves-effect waves-light blue darken-4 editar" disabled><i class="material-icons">edit</i></button>
        <button class="btn waves-effect waves-light red darken-4 eliminar" disabled><i class="material-icons">delete</i></button>
       <?php } else { ?>
        <button class="btn waves-effect waves-light blue darken-4 editar" data-cedula="<?= $row["cedula_empleado"] ?>"><i class="material-icons">edit</i></button>
        <button class="btn waves-effect waves-light red darken-4 eliminar" data-cedula="<?= $row["cedula_empleado"] ?>"><i class="material-icons">delete</i></button>
       <?php } ?>
       <button class="btn waves-effect waves-light orange darken-4 reporte-table" data-cedula="<?= $row["cedula_empleado"] ?>"><i class="material-icons">polymer</i></button>
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
  $.getScript("empleados/static/js/actions.js")

  var pager = new Pager('Tab_Filter', 8);
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
