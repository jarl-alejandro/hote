<nav class="Toolbar">
	<ul class="Toolbar-menu">
    <?php if ($cargo == "recepcionista" || $cargo == "administrador") { ?>
  		<li class="Toolbar-menu--item">
  			<a href="#" data-url="inicio" data-title="Alquiler de habitaciones">
  				<i class="material-icons">home</i>
  				<span>Inicio</span>
  			</a>
  		</li>
			<li class="Toolbar-menu--item">
  			<a href="#" data-url="pagos_mensuales" data-title="Pagos mensuales">
					<i class="material-icons">attach_money</i>
  				<span>Pagos</span>
  			</a>
  		</li>
    <?php } ?>

    <?php if ($cargo == "vendedor" || $cargo == "administrador" || $cargo == "recepcionista") { ?>
		<li class="Toolbar-menu--item">
			<a href="#" data-url="submenu">
				<i class="material-icons">add_location</i>
				<span>Restaurante</span>
			</a>
			<ul class="Toolbar-submenu">
        <?php if ($cargo == "vendedor" || $cargo == "administrador") { ?>
				<li>
          <a href="#" data-url="restaurante" data-title="Punto de Venta">
            <i class="material-icons">restaurant_menu</i><span>Punto de Venta</span>
          </a>
        </li>
        <?php } ?>
        <?php if ($cargo == "recepcionista" || $cargo == "administrador") { ?>
          <li><a href="#" data-url="facturas" data-title="Consumos">
            <i class="material-icons">view_list</i><span>Consumos</span></a>
          </li>
        <?php } ?>
			</ul>
		</li>
    <?php } ?>

    <?php if ($cargo == "recepcionista" || $cargo == "administrador") { ?>
    <li class="Toolbar-menu--item">
      <a href="#" data-url="reservaciones" data-title="Reservaciones">
        <i class="material-icons">tv</i>
        <span>Reservaciones</span>
      </a>
    </li>
		<li class="Toolbar-menu--item">
      <a href="#" data-url="grupos" data-title="Reservaciones grupales">
        <i class="material-icons">people</i>
        <span>Reservaciones grupales</span>
      </a>
    </li>
    <li class="Toolbar-menu--item">
      <a href="#" data-url="departamentos" data-title="Departamentos">
        <i class="material-icons">tv</i>
        <span>Departamentos</span>
      </a>
    </li>
    <?php } ?>

    <?php if ($cargo == "administrador") { ?>
		<li class="Toolbar-menu--item">
			<a href="#" data-url="submenu">
				<i class="material-icons">build</i>
				<span>Transacciones</span>
			</a>
			<ul class="Toolbar-submenu">
        <li>
          <a href="#" data-url="compras" data-title="Compras">
            <i class="material-icons">shop_two</i><span>Compras</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="pedidos" data-title="Pedidos">
            <i class="material-icons">shop_two</i><span>Pedidos</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="pendientes" data-title="Pendientes">
          <i class="material-icons">adb</i><span>Pendientes</span></a>
        </li>
        <li>
          <a href="#" data-url="kardex" data-title="Kardex">
            <i class="material-icons">receipt</i><span>Kardex</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="devolucion_venta" data-title="Devolución de Venta">
            <i class="material-icons">cached</i><span>Devolución de Venta</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="anular_venta" data-title="Anular Venta">
            <i class="material-icons">fiber_smart_record</i><span>Anular Venta</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="anular_compra" data-title="Anular Compra">
            <i class="material-icons">leak_remove</i><span>Anular Compra</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="anular_promocion" data-title="Anular Promocion">
            <i class="material-icons">restore_page</i><span>Anular Promocion</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="anular_reservas" data-title="Anular Reservas">
            <i class="material-icons">restore</i><span>Anular Reservas</span>
          </a>
        </li>
			</ul>
		</li>
    <?php } ?>
    <?php if ($cargo == "administrador" || $cargo == "contador") { ?>
    <li class="Toolbar-menu--item">
      <a href="#" data-url="submenu">
        <i class="material-icons">picture_as_pdf</i>
        <span>Reportes</span>
      </a>
      <ul class="Toolbar-submenu">
        <li>
          <a href="#" data-url="inventario" data-title="Inventario">
            <i class="material-icons">collections_bookmark</i><span>Inventario</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="egresos" data-title="Egresos">
            <i class="material-icons">local_atm</i><span>Egresos</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="facturas_canceladas" data-title="Facturas canceladas">
            <i class="material-icons">view_list</i><span>Facturas canceladas</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="cierra-parcial-fecha" data-title="Cierre parcial por fecha">
            <i class="material-icons">view_list</i><span>Cierre parcial por fecha</span>
          </a>
        <li>
        <li>
          <a href="#" data-url="traslado-fecha" data-title="traslado de habitacion por fecha">
            <i class="material-icons">view_list</i><span>traslado por fecha</span>
          </a>
        <li>
          <a href="#" data-url="ventas-fecha" data-title="Ventas por fecha">
            <i class="material-icons">view_list</i><span>Ventas por fecha</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="compras-fecha" data-title="Compras por fecha">
            <i class="material-icons">view_list</i><span>Compras por fecha</span>
          </a>
        </li>
      
      </ul>
    </li>
    <?php } ?>
    <?php if ($cargo == "administrador" || $cargo == "contador") { ?>
    <li class="Toolbar-menu--item">
      <a href="#" data-url="submenu">
        <i class="material-icons">polymer</i>
        <span>Estadisticas</span>
      </a>
      <ul class="Toolbar-submenu">
        <li>
          <a href="#" data-url="rotacion"
            data-title="Rotacion de inventario">
            <i class="material-icons">timeline</i><span>Rotacion de inventario</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="mas_reservadas"
            data-title="Habitaciónes mas reservadas">
            <i class="material-icons">timeline</i><span>Mejores Habitaciónes</span>
          </a>
        </li>
				<li>
          <a href="#" data-url="estadistica_mantenimiento"
            data-title="Estadisticas de Mantenimiento">
            <i class="material-icons">timeline</i><span>Mantenimiento</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="estadisticas" data-title="Estadisticas">
            <i class="material-icons">timeline</i><span>Ingresos / Egresos</span>
          </a>
        </li>
        <li><a href="#" data-url="mejores_clientes" data-title="Mejores Clientes"><i class="material-icons">timeline</i><span>Mejores Clientes</span></a></li>
      </ul>
    </li>
    <?php } ?>
    <?php if ($cargo == "administrador") { ?>
    <li class="Toolbar-menu--item">
      <a href="#" data-url="submenu">
        <i class="material-icons">settings_applications</i>
        <span>Mantenimiento</span>
      </a>
      <ul class="Toolbar-submenu">
        <li>
          <a href="#" data-url="clientes" data-title="Clientes">
            <i class="material-icons">perm_identity</i><span>Clientes</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="empleados" data-title="Empleados">
            <i class="material-icons">account_circle</i><span>Empleados</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="proveedores" data-title="Proveedores">
            <i class="material-icons">business</i><span>Proveedores</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="productos" data-title="Productos y Servicios">
            <i class="material-icons">blur_on</i><span>Productos y Servicios</span>
          </a>
        </li>
        <li>
          <a href="#" data-url="categorias" data-title="Categoria de habitaciones">
            <i class="material-icons">whatshot</i><span>Categoria</span>
          </a>
        </li>
				<li>
          <a href="#" data-url="muebles_enseres" data-title="Muebles y Enseres">
            <i class="material-icons">weekend</i><span>Muebles y Enseres</span>
          </a>
        </li>
        <li>
        <li>
          <a href="#" data-url="habitacion" data-title="Habitación">
            <i class="material-icons">domain</i><span>Habitación</span>
          </a>
        </li>
      </ul>
    </li>
		<li class="Toolbar-menu--item">
      <a href="#" data-url="submenu">
        <i class="material-icons">settings_applications</i>
        <span>Archivos</span>
      </a>
      <ul class="Toolbar-submenu">
        <?php if ($cargo == "administrador" || $cargo == "contador") { ?>
        <li>
          <a href="#" data-url="monedas" data-title="Monedas">
            <i class="material-icons">attach_money</i><span>Monedas</span>
          </a>
        </li>
        <?php } ?>
        <li>
          <a href="#" data-url="huespedes" data-title="Huesped">
            <i class="material-icons">perm_contact_calendar</i><span>Huesped</span>
          </a>
        </li>
      </ul>
    </li>
    <?php } ?>
	</ul>
</nav>
