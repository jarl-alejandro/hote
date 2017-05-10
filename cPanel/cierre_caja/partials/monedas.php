<div class="card monedas-cuadre">
  <div class="input-field col s12">
    <select id="monedas">
      <option value="" disabled selected>Selecione la moneda</option>
    <?php
    $monedas = $pdo->query("SELECT * FROM hotel_moneda");
    foreach ($monedas as $moneda) :?>
    <option value="<?= $moneda["codigo_moneda"] ?>" data-desc="<?= $moneda["desc_moneda"] ?>"
      data-cat="<?= $moneda["categoria_moneda"] ?>" class="moneda-item">
      <?= $moneda["desc_moneda"]." ".$moneda["categoria_moneda"] ?>
    </option>
    <?php endforeach ?>
    </select>
    <label>Elige la moneda</label>
  </div>
  <div class="input-field col s6">
    <i class="material-icons prefix">format_list_numbered</i>
    <input id="cant" type="text" class="validate" onkeypress="ValidaSoloNumeros()"
      maxlength="4" length="4">
    <label for="cant">Monto</label>
  </div>
  <div class="flex" style="justify-content: space-around;">
    <button class="btn waves-effect waves-light cerrar-moneda red darken-4">Cancelar</button>

    <button class="btn waves-effect waves-light aceptar-moneda color-toolbar">Aceptar</button>
  </div>
</div>
