<?php
$codigo = $_GET["codigo"];
include '../../../bd/db.php';
date_default_timezone_set('America/Guayaquil');

$query = $pdo->query("SELECT * FROM vista_kardex WHERE codigo_kardex='$codigo'");
$kardex = $query->fetch();
?>

<article class="z-depth-1 white">
  <header class="KardexHeader">

    <div class="KardexHeader-title row">
      <h5>KARDEX Nº <?= $kardex["codigo_kardex"] ?></h5>
    </div>
    <div class="KardexHeader-prod row">
      <h6 class="">Producto: <?= $kardex["nombre_producto"] ?></h6>
    </div>

    <div class="row">
      <div class="col s4">Minimo: <?= $kardex["minimo_producto"] ?></div>
      <div class="col s4">Maximo: <?= $kardex["maximo_producto"] ?></div>
      <div class="col s4">Cantidad: <?= $kardex["cantidad_producto"] ?></div>
    </div>
  </header>
  <table class="bordered highlight responsive-table white">
    <thead>
      <th></th>
      <th></th>
      <th></th>
      <th COLSPAN="3">Entradas</th>
      <th COLSPAN="3">Salidas</th>
      <th COLSPAN="3">Existencia</th>
      <tr>
        <th>Nº</th>
        <th>Detalle</th>
        <th>Cant</th>
        <th>Val</th>
        <th>Sub</th>
        <th>Cant</th>
        <th>Val</th>
        <th>Sub</th>
        <th>Cant</th>
        <th>Val</th>
        <th>Sub</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <?php
        $count = 0;
        $detalles = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$codigo'");
        foreach ($detalles as $detalle):
          $count++
      ?>
        <tr>
          <td><?= $count ?></td>
          <td><?= $detalle["desc_kardex"] ?></td>
          <td><?= $detalle["ent_cant"] ?></td>
          <td><?= $detalle["ent_val"] ?></td>
          <td><?= $detalle["ent_sub"] ?></td>
          <td><?= $detalle["sal_cant"] ?></td>
          <td><?= $detalle["sal_val"] ?></td>
          <td><?= $detalle["sal_sub"] ?></td>
          <td><?= $detalle["exist_cant"] ?></td>
          <td><?= $detalle["exist_val"] ?></td>
          <td><?= $detalle["exist_sub"] ?></td>
        </tr>
      <?php endforeach ?>
      </tr>
    </tbody>
  </table>
  <div class="flex space KardexHeader-footer">
    <button class="btn red darken-4 waves-effect waves-light" onclick="cancelar()">
      <i class="material-icons">close</i>
    </button>
    <button class="btn color-toolbar waves-effect waves-light" onclick="reporte('<?= $codigo ?>')">
      <i class="material-icons">picture_as_pdf</i>
    </button>
  </div>
</article>
<script>
  function cancelar () {
    $(".table-kardex").slideDown()
    $(".form-kardex").slideUp()
  }
  function reporte(codigo) {
    window.open (`./kardex/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

</script>