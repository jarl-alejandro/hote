<article class="z-depth-1 Productos col s4">
  <header class="Productos-header">
    <h4 class="center color-toolbar white-text u-no-margin">Productos</h4>
  </header>
  <div class="Productos-body">
    <ul>
    <?php include '../../bd/db.php'; 
    $productos = $pdo->query("SELECT * FROM hotel_producto WHERE tipo_producto='producto'");
    foreach ($productos as $producto):?>
      <li class="Productos-item row flex space u-center-flex">
        <a class="col s6"><?= $producto["nombre_producto"] ?></a>
        <div class="input-field col s4">
          <input id="cant_<?= $producto["codigo_producto"] ?>" class="validate input-producto" type="text" 
            onkeypress="ValidaSoloNumeros()" />
          <label for="cant" id="label_<?= $producto["codigo_producto"] ?>" class="cant_producto">Cant</label>
        </div>
        <button class="btn color-acent waves-effect waves-light btn-producto col s2" style="margin-bottom:3px" 
          data-nombre="<?= $producto["nombre_producto"] ?>" data-codigo="<?= $producto["codigo_producto"] ?>" 
          data-valor="<?= $producto["valor_producto"] ?>" data-max="<?= $producto["maximo_producto"] ?>">
          <i class="material-icons">add</i>
        </button>
      </li>
    <?php endforeach ?>
    </ul>
    <button class="red darken-4 btn waves-effect waves-light cerrar-Productos" style="margin:0 auto;display:block;margin-bottom:1em">Cancelar
      <i class="material-icons right">clear</i>
    </button>
  </div>
</article>