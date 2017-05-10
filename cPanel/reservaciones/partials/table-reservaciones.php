<?php
?>
<div id="reservaciones-editar" class="modal modal-fixed-footer"
    style="top: 2em !important;">
    <div class="modal-content">
        <h4 class="center-align">Reservaciones</h4>
        
        <div class="row">
            <div class="input-field col s12">
                <input id="buscadorTable" type="text" class="validate" />
                <label for="buscadorTable">Buscador</label>
            </div>
        </div>

        <table class="highlight responsive-table bordered z-depth-1 centered" id="TableEditar">
            <thead class="color-acent white-text">
                <tr>
                    <th data-field="id">Cedula</th>
                    <th data-field="nombre">Nombre y Apellido</th>
                    <th data-field="Fecha">Fecha de Ingreso</th>
                    <th data-field="Fecha">Fecha de Salida</th>
                    <th data-field="accion">Accion</th>
                </tr>
            </thead>
            <tbody class="white">
            <?php
            $reservaciones = $pdo->query("SELECT * FROM vista_reservacion WHERE estado_habitacion='reservado'");             
            foreach ($reservaciones as $row) :
            
            ?>
                <tr>
                    <td><?= $row["cedula_cliente"] ?></td>
                    <td><?= $row["nombre_cliente"]." ".$row["apellido_cliente"] ?></td>
                    <td><?= $row["fecha_habitacion"] ?></td>
                    <td><?= $row["hasta_habitacion"] ?></td>
                    <td>
                    <button class="btn waves-effect waves-light color-acent editar-btn" 
                        data-cedula="<?= $row["cedula_cliente"] ?>" data-codigo="<?= $row["codigo_reservacion"] ?>">
                        <i class="material-icons">create</i>
                    </button>
                    <!--<button class="btn waves-effect waves-light orange darken-4 reporte-table" data-cedula="<?= $row["cedula_cliente"] ?>"><i class="material-icons">polymer</i></button>-->
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <ul class="pagination" id="NavPosicion_editar"></ul>        
    </div>
    <div class="modal-footer">
        <a id="cancelar-editar" class="modal-action modal-close waves-effect waves-red btn-flat">Cancelar</a>
    </div>
</div>


<script src="static/js/paging.js"></script>
<script src="static/js/jquery_searchtable.js"></script>
<script>

    var pager = new Pager('TableEditar', 3);
    pager.init();
    pager.showPageNav('pager', 'NavPosicion_editar');
    pager.showPage(1);

    theTable = $("#TableEditar");
    $("#buscadorTable").keyup(function() {
        $.uiTableFilter(theTable, this.value);
    });
</script>