<article class="Productos-Acabados">
<?php 
 include '../../bd/db.php';

  $productos = $pdo->query("SELECT * FROM hotel_producto WHERE estado_producto='1'");

  foreach ($productos as $producto) :?>  
  <div class="panel red darken white-text z-depth-1 panel-productos u-pointer" 
    data-codigo="<?= $producto["codigo_producto"] ?>">
    <?= $producto["nombre_producto"] ?>
  </div>
<?php endforeach ?>
</article>
<article class="FormProductoAcabados u-none white"></article>
<script>
  $(".panel-productos").on("click", onProductos)

  function onProductos (e) {
    var codigo = e.currentTarget.dataset.codigo
    $(".FormProductoAcabados").load(`partials/form-producto.php?codigo=${codigo}`)

    setTimeout(function() {
      $(".u-oculto").slideDown()
      $(".FormProductoAcabados").slideDown()      
    }, 200)
  }
</script>