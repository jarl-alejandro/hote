;(function(){
  'use strict'

  var $reporte = $(".reporte-table")

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./pedidos/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }


  $reporte.on("click", reporte)
  
})()