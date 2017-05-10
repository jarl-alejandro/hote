;(function () {
  'use strict'
  
  $('ul.tabs').tabs()

  var $reporte = $(".reporte-table")
  var $reporte_servicio = $(".reporte-servicio")

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./inventario/reporte/producto.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function reporte_servicio(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./inventario/reporte/servicio.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $reporte.on("click", reporte)
  $reporte_servicio.on("click", reporte_servicio)

})()