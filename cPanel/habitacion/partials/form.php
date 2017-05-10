<div class="row">
  <div class="col s12 z-depth-1 red darken-4">
    <h3 class="u-title-form white-text center-align">Registro de Habitacion</h3>
  </div>
  <form class="col s12 z-depth-1 white" enctype="multipart/form-data">
    <input type="hidden" id="habitacion_id">
    <div class="input-field col s12 m4">
      <i class="material-icons prefix">store_mall_directory</i>
      <input id="nombre" type="text" class="validate" maxlength="140" length="140" onkeypress="ValidaSoloNumeros()">
      <label for="nombre" class="field-label">Numero de la Habitacion Ejemplo: 1</label>
    </div>

    <div class="u-bottom-small col s12 m8">
      <div class="input-field col s6 m4">
        <i class="material-icons prefix">attach_money</i>
        <input id="valor" type="text" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloDecimal()">
        <label for="valor" class="field-label price-label">Precio Ejemplo: 10</label>
      </div>
      <div class="input-field col s6 m4">
        <i class="material-icons prefix">format_list_numbered</i>
        <input id="cantidad" type="text" class="validate" maxlength="10" length="10" onkeypress="ValidaSoloNumeros()">
        <label for="cantidad" class="field-label">Maximo Ejemplo: 3</label>
      </div>
      <div class="input-field col s6 m4">
        <i class="material-icons prefix">business</i>
        <input id="piso" type="text" class="validate" maxlength="2" length="2" onkeypress="ValidaSoloNumeros()">
        <label for="piso" class="field-label">Piso Ejemplo: 2</label>
      </div>
    </div>

    <div class="input-field col s12 m6">
      <i class="material-icons prefix">dashboard</i>
      <select id="categoria">
        <option value="" disabled selected>Elija su opción</option>
        <?php
        include '../../bd/db.php';
        $categoria = $pdo->query("SELECT * FROM hotel_categoria");
        foreach ($categoria as $cat): ?>
        <option value="<?= $cat['codigo_categoria'] ?>"><?= $cat['nombre_categoria'] ?></option>
      <?php endforeach ?>
    </select>
    <label>Selecione la categoria</label>
  </div>

  <div class="input-field col s12 m6">
    <div class="file-field input-field">
      <div class="btn z-depth-1 color-toolbar">
        <span>File</span>
        <input type="file" id="imagen">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path" disabled="true" type="text">
      </div>
    </div>
  </div>

  <div class="input-field col s12 m6">
    <i class="material-icons prefix">description</i>
    <textarea id="detalle" class="materialize-textarea"></textarea>
    <label for="detalle" class="field-label">Detalle</label>
  </div>

  <div class="input-field col s12 m6">
    <img class="Imagen-habitacion">
  </div>
  <div class="input-field col s12 m6">
    <p class="depart">
      <input type="checkbox" id="departamento" />
      <label for="departamento">Es departamento</label>
    </p>    
  </div>
  <div class="button-float">
    <a class="btn-floating btn-large waves-effect waves-light tooltipped"
      id="mublesBoton" data-position="left" data-delay="50"
      data-tooltip="Muebles y Enseres">
      <i class="material-icons">weekend</i>
    </a>
  </div>

  <div class="u-bottom-small flex space-between">
    <button class="btn waves-effect waves-light red darken-4 cancelar u-bottom-small">Cancelar
      <i class="material-icons right">close</i>
    </button>
    <button class="btn waves-effect waves-light guardar">Guardar
     <i class="material-icons right">send</i>
   </button>
 </div>

</form>
</div>

<div id="MueblesYEnseresContainer" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="center-align">Mubles y Enseres</h4>
    <p class="center-align">Ingresa los muebles y enseres de esta habitacion</p>
    <a class="btn-floating btn-large waves-effect waves-light tooltipped rigth"
      id="showListEnsere" data-position="left" data-delay="50"
      data-tooltip="Agrega un nuevo muebles y enseres">
      <i class="material-icons">weekend</i>
    </a>
    <table class="bordered striped highlight centered responsive-table">
      <thead>
        <tr>
          <th>Cant</th>
          <th>Muebles y Enseres</th>
          <th>Valor</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tableEnseres"></tbody>
    </table>
  </div>
  <div class="modal-footer">
    <a class="modal-action modal-close waves-effect waves-green btn-flat"
      id="aceptMueblesEnseres">
      Aceptar
    </a>
  </div>
</div>

<article class="card mublesForm u-none">
  <h3 class="mublesForm__title">Selecion el mubles y enseres</h3>
  <ul class="mublesForm__list">
    <?php
      $muebles = $pdo->query("SELECT * FROM hotel_muebles");
      while($row = $muebles->fetch()){
    ?>
    <li class="mublesForm__item row">
      <a class="col s5"><?= $row["desc_mueble"]; ?></a>
      <div class="input-field col s5">
        <input id="input<?=$row['codigo_mueble']?>" type="text"
            class="validate enseres__input" onkeypress="ValidaSoloNumeros()"
            maxlength="3">
        <label for="input<?=$row['codigo_mueble']?>" class="enseres__label">
          Ingresa la cantidad
        </label>
      </div>
      <button class="col s2 btn waves-effect waves-light btnMublesADD"
        data-id="<?=$row['codigo_mueble']?>" data-desc="<?=$row['desc_mueble']?>"
        data-price="<?=$row['precio_mueble']?>">
        <i class="material-icons">done_all</i>
      </button>
    </li>
    <?php } ?>
  </ul>
  <div class="u-center flex">
    <button class="btn waves-effect waves-light red darken-4"
      id="closeEnseres">
      Cerrar
    </button>
  </div>
</article>
