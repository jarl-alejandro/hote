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
  </td>
</tr>