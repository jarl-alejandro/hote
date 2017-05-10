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
    date_default_timezone_set('America/Guayaquil');
    $fecha = date("Y/m/d");

    $desde = $_GET["desde"];
    $hasta = $_GET["hasta"];

   $clientes = $pdo->query("SELECT * FROM vista_huespedes WHERE fecha_habitacion BETWEEN '$hasta' AND '$desde'");
   foreach ($clientes as $row) :?>
   <tr>
     <td><?= $row["cedula_cliente"] ?></td>
     <td><?= $row["nombre_cliente"]." ".$row["apellido_cliente"] ?></td>
     <td><?= $row["email_cliente"] ?></td>
     <td><?= $row["direccion_cliente"] ?></td>
     <td>
      <button class="btn waves-effect waves-light color-toolbar ingresar" data-cedula="<?= $row["codigo_reservacion"] ?>"><i class="material-icons">trending_flat</i></button>
       <!--<?php if ($row["estado_cliente"] == 1){ ?>
       <button disabled class="btn waves-effect waves-light color-toolbar ingresar" data-cedula="<?= $row['codigo_reservacion'] ?>"><i class="material-icons">trending_flat</i></button>
       <?php }else { ?>
        <button class="btn waves-effect waves-light color-toolbar ingresar" data-cedula="<?= $row["codigo_reservacion"] ?>"><i class="material-icons">trending_flat</i></button>
       <?php } ?>-->
       <button class="btn waves-effect waves-light orange darken-4 reporte-table" data-cedula="<?= $row["codigo_reservacion"] ?>"><i class="material-icons">polymer</i></button>
     </td>
   </tr>
 <?php endforeach ?>
</tbody>
</table>
<ul class="pagination" id="NavPosicion_b"></ul>

<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>
  $.getScript("pendientes/static/js/actions.js")

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
