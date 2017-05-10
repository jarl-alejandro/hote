<i class="material-icons prefix">account_circle</i>
<select id="cliente">
  <option value="" disabled selected>Elige tu opcion</option>
  <?php
  include '../../../bd/db.php';
  $socios = $pdo->query("SELECT * FROM hotel_cliente WHERE cedula_cliente != 'xxxxxxxxxx'");
  foreach ($socios as $socio): ?>
    <option value="<?= $socio["cedula_cliente"] ?>"><?= $socio["nombre_cliente"] ?></option>
  <?php endforeach ?>
</select>
<label>Cliente</label>