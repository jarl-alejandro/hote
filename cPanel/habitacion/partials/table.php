
<section id="Tab_Filter" class="row cards_habitacion">
<article></article>
 <?php
 include '../../../bd/db.php';
 $habitacion = $pdo->query("SELECT * FROM hotel_habitacion
                              ORDER BY nombre_habitacion ASC");
 if($habitacion->rowCount() == 0){
  echo "<tr>
    <td colspan='5'>No hay habitaciones</td>
  </tr>";
 }
 else {
 foreach ($habitacion as $row) :?>
 <div class="col s6 m4">
   <article class="z-depth-3 card"
          style="border: 10px double #bc0c09;">
    <div class="card-image">
      <img src="../media/habitaciones/<?= $row["imagen_habitacion"] ?>" class="img_hab">
      <span class="card-title nombre-card">Nº <?= $row["nombre_habitacion"] ?></span>
    </div>
    <div class="relative">
      <div class="fixed-action-btn horizontal u-absolute" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large color-toolbar">
          <i class="large material-icons">attach_file</i>
        </a>
        <ul>
          <li data-type="limpieza" class="hab-over">
            <a class="btn-floating blue-grey limpieza" data-codigo="<?= $row["codigo_habitacion"] ?>">
              <i class="material-icons">brush</i>
            </a>
          </li>
          <li data-type="mantenimiento" class="hab-over">
            <a class="btn-floating blue darken-2 build" data-codigo="<?= $row["codigo_habitacion"] ?>" data-build="<?= $row["estado_habitacion"] ?>">
              <i class="material-icons">build</i>
            </a>
          </li>
          <li data-type="imprimir reporte" class="hab-over">
            <a class="btn-floating yellow darken-1 reporte-table" data-codigo="<?= $row["codigo_habitacion"] ?>">
              <i class="material-icons">picture_as_pdf</i>
            </a>
          </li>
          <li data-type="eliminar" class="hab-over">
            <a class="btn-floating red eliminar" data-codigo="<?= $row["codigo_habitacion"] ?>">
              <i class="material-icons">delete</i>
            </a>
          </li>
          <li data-type="editar" class="hab-over">
            <a class="btn-floating blue editar" data-codigo="<?= $row["codigo_habitacion"] ?>"><i class="material-icons">mode_edit</i></a></li>

          <?php if($row["estado_promocion"] != "promocion"){ ?>
            <li data-type="promoción" class="hab-over">
              <a class="btn-floating blue-gray promocionar"
                data-codigo="<?= $row["codigo_habitacion"] ?>"
                data-valor="<?= $row["valor_habitacion"] ?>">
                <i class="material-icons">whatshot</i>
              </a>
            </li>
          <?php } else {?>
            <li data-type="Eliminar promoción" class="hab-over">
              <a class="btn-floating blue-gray promocionarEliminar"
                data-codigo="<?= $row["codigo_habitacion"] ?>"
                data-valor="<?= $row["valor_promocion"] ?>">
                <i class="material-icons">whatshot</i>
              </a>
            </li>
         <?php } ?> 
        </ul>
      </div>
    </div>
  </article>
</div>
<?php endforeach ?>
<?php } ?>
</section>
<?php include 'promocion.php'; ?>
<ul class="pagination" id="NavPosicion_b"
  style="margin: 0;margin-bottom: 2.5em;"></ul>

<script src="static/js/paging_article.js"></script>
<script src="static/js/search_article.js"></script>
<script>
  $.getScript("habitacion/static/js/actions.js")
  $.getScript("habitacion/static/js/promocionar.js")
  var pager = new Pager('Tab_Filter', 6);
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
