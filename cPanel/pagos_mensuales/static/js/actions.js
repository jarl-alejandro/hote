;(function () {
  'use strict'

  $(".reporte-table").on("click", function (e) {
    var codigo = e.currentTarget.dataset.codigo

    window.open (`./pagos_mensuales/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

  $("#CerrarFecha").on("click", function () {
    $(".table").load("pagos_mensuales/partials/table.php")
  })

})()
