<table class="highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
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
   $clientes = $pdo->query("SELECT * FROM vista_huespedes_pagar ORDER BY fecha_habitacion DESC");
   if($clientes->rowCount() == 0){
    echo "<tr>
      <td colspan='5'>No hay huespuedes</td>
    </tr>";
   }
   else {
    foreach ($clientes as $row) :
      if($row["es_facturam"] == "departamento")
        include "departamento.php";
      else
        include "reservaciones.php";
    endforeach;
  } ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("huespedes/static/js/actions.js")

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
