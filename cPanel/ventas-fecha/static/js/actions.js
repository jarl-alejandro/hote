;(function () {
  'use strict'

  $(".reporte-table").on("click", function (e) {
    var codigo = e.currentTarget.dataset.codigo
    var type = e.currentTarget.dataset.type

    if(type === "mensual")
      window.open(`./ventas-fecha/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
    else
      window.open(`./ventas-fecha/reporte/indiv.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")      
  })

  $("#CerrarFecha").on("click", function () {
    $(".table").load("ventas-fecha/partials/table.php")
  })

})()
