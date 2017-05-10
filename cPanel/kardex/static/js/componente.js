;(function (){
	'use strict'

  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table-kardex").load('kardex/partials/table.php')

  var $reporteGeneral = $("#reporteGeneral")

  function reporteGeneral() {
    window.open (`./kardex/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  $reporteGeneral.on("click", reporteGeneral)

})()
