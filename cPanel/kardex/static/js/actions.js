;(function(){
  'use strict'

  var $reporte = $(".reporte-table")
  var $kardex = $(".kardex")

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./kardex/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function kardex (e) {
    var codigo = e.currentTarget.dataset.codigo
    $(".form-kardex").load(`kardex/partials/form.php?codigo=${codigo}`)
    setTimeout(function() {
      $(".table-kardex").slideUp()
      $(".form-kardex").slideDown()
    }, 200)
  }

  $reporte.on("click", reporte)
  $kardex.on("click", kardex)

})()