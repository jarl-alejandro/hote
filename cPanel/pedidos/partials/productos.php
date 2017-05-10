<article class="z-depth-1 Productos col s4">
  <header class="Productos-header">
    <h4 class="center color-toolbar white-text u-no-margin">Productos</h4>
  </header>
  <div class="Productos-body">
    <ul style="padding-right: .5em;">
    <?php include '../../bd/db.php'; 
    $productos = $pdo->query("SELECT * FROM hotel_producto WHERE tipo_producto='producto' ORDER BY estado_producto DESC");
    foreach ($productos as $producto):
      if($producto["estado_producto"] == 1){
        include 'partials/item_producto.php';
      } else {
        include 'partials/item_producto.php';
      }
    endforeach ?>     
    </ul>
    <button class="red darken-4 btn waves-effect waves-light cerrar-Productos" style="margin:0 auto;display:block;">Cancelar
      <i class="material-icons right">clear</i>
    </button>
  </div>
</article>
