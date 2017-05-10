<section class="reservas">
    
  <table class="highlight responsive-table bordered z-depth-1 centered" id="Tab_Filter">
   <thead class="red darken-4 white-text">
     <tr>
       <th data-field="id" style="width: 3%;">#</th>
       <th data-field="fecha" style="width: 10%;">Desde</th>
       <th data-field="fecha" style="width: 10%;">Hasta</th>
       <th data-field="Descripcion" style="width: 70%;">Cliente</th>
       <th data-field="accion" style="width: 7%;">Accion</th>
     </tr>
   </thead>
   <tbody class="white">
     <?php
     $count = 0;
     include '../../bd/db.php';
     $reservas = $pdo->query("SELECT * FROM vista_reservacion WHERE estado_cliente='1'");
     foreach ($reservas as $row) :
      $count++;
    ?>
     <tr>
       <td><?= $count ?></td>
       <td><?= $row["fecha_habitacion"] ?></td>
       <td><?= $row["hasta_habitacion"] ?></td>
       <td><?= $row["nombre_cliente"]." ".$row["apellido_cliente"] ?></td>
       <td>
         <button class="btn waves-effect waves-light orange darken-4 anular" data-codigo="<?= $row["codigo_reservacion"] ?>"><i class="material-icons">polymer</i></button>
       </td>
     </tr>
   <?php endforeach ?>
  </tbody>
  </table>
  <ul class="pagination" id="NavPosicion_b"></ul>

  <script src="static/js/paging.js"></script>
  <script src="static/js/jquery_searchtable.js"></script>
  <script>
    $.getScript("anular_reservas/static/js/app.js")

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
</section>
<?php include 'partials/alerta.php'; ?>