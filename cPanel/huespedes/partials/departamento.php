<?php
$mes = date("m");
$id_reservacion = $row["codigo_reservacion"];
$mensual_query = $pdo->query("SELECT * FROM hotel_mensual WHERE mensual_mes='$mes' 
    AND mensual_reservacion='$id_reservacion'");
$mensual = $mensual_query->fetch();

if($mensual_query->rowCount() == 0){
?>
<tr>
  <td><?= $row["cedula_cliente"] ?></td>
  <td><?= $row["cliente"] ?></td>
  <td><?= $row["email_cliente"] ?></td>
  <td><?= $row["direccion_cliente"] ?></td>
  <td>
    <button class="btn waves-effect waves-light color-acent pagar"
      data-codigo="<?= $row["codigo_reservacion"] ?>"><i
      class="material-icons">attach_money</i></button>

    <button class="btn waves-effect waves-light orange darken-4 reporte-table"
      data-codigo="<?= $row["codigo_reservacion"] ?>"><i
      class="material-icons">polymer</i></button>

    <?php 
      if($row["aviso_estado"] == "desalojado"){ ?>
      <button class="btn waves-effect waves-light red darken-2 cancelarSalida"
      data-codigo="<?= $row["codigo_reservacion"] ?>"><i class="material-icons">clear</i></button>
    <?php } else { ?>
    <button class="btn waves-effect waves-light blue darken-2 salirHabitacion"
      data-codigo="<?= $row["codigo_reservacion"] ?>"><i class="material-icons">exit_to_app</i></button>
    <?php } ?>

  </td>
</tr>
<?php } ?>  