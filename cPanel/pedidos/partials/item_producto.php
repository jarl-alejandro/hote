<li class="Productos-item row flex space u-center-flex" style="margin-bottom: 0 !important">
  <a class="col s6"><?= $producto["nombre_producto"] ?></a>
  <div class="input-field col s4">
    <input id="cant_<?= $producto["codigo_producto"] ?>" class="validate input-producto" type="text" 
    onkeypress="ValidaSoloNumeros()" />
    <label for="cant_<?= $producto["codigo_producto"] ?>" id="label_<?= $producto["codigo_producto"] ?>" class="cant_producto">Cant</label>
  </div>
  <button class="btn color-acent waves-effect waves-light btn-producto col s2" style="margin-bottom:3px" 
  data-nombre="<?= $producto["nombre_producto"] ?>" data-codigo="<?= $producto["codigo_producto"] ?>" 
  data-valor="<?= $producto["valor_producto"] ?>" data-max="<?= $producto["maximo_producto"] ?>">
  <i class="material-icons">add</i>
</button>
</li>