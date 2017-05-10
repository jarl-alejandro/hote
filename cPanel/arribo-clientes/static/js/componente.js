;(function (){
	'use strict'

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('arribo-clientes/partials/table.php')

  var $nuevo = $("#nuevo")
  var $reporteGeneral = $("#reporteGeneral")

 
  function onNuevo () {
    $(".table").slideUp()
    $(".form").slideDown()
  }

  function reporteGeneral() {
    window.open (`./arribo-clientes/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $nuevo.on("click", onNuevo)
  $reporteGeneral.on("click", reporteGeneral)

})()
