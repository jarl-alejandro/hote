;(function () {
  'use strict'

  $(".reporte-table").on("click", function (e) {
    var codigo = e.currentTarget.dataset.codigo
    var type = e.currentTarget.dataset.type

    if(type === "mensual")
      window.open(`./facturas_canceladas/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
    else
      window.open(`./facturas_canceladas/reporte/indiv.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")      
  })

  $("#CerrarFecha").on("click", function () {
    $(".table").load("facturas_canceladas/partials/table.php")
  })

})()
