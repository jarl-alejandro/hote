<?php } else if ($row["estado_cliente"] == 3) { ?>
 <button class="btn waves-effect waves-light color-toolbar ingresar" data-cedula="<?= $row["cedula_cliente"] ?>"><i class="material-icons">trending_flat</i></button>
 <?php } ?>
 <?php if ($row["estado_cliente"] == 1){ ?>
