;(function() {
  'use strict'

  var $aceptarVentas = $(".aceptar-ventas")

  function aceptarVentas () {
    toast("Ha visto la venta realizada")
    $(".u-oculto").slideUp()
    $('.ventas').slideUp()
  }
  
  $(".reporte-ventas").on("click", function (e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./facturas/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

  $aceptarVentas.on("click", aceptarVentas)

})()