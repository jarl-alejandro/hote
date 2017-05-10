;(function () {
    'use strict'

    var reservaciones_array = []

    var $tableReservaciones = $("#table-reservaciones")

    function ShowTableReservaciones () {
        $("#reservaciones-editar").slideDown()
    }

    function CancelarReservaciones () {
        $("#reservaciones-editar").slideUp()
    }

    function UpdateReservaciones (e) {
      if(true){
        var codigo = e.currentTarget.dataset.codigo
        var habitaciones = JSON.parse(localStorage.getItem("reservaciones"))
        var total = $("#total_price").html()
        var desde = $("#fecha").val()
        var hasta = $("#dayHosped").html()

        $.ajax({
            type:"POST",
            url:"reservaciones/servicio/update.php",
            data: { codigo, habitaciones, total, desde, hasta }
        })
        .done(function (response) {
            console.log(response)
            toast("Se ha realizado su reservacion con exito")
            $(".Layout").load('inicio')
            $(".title-layout").html("Alquiler de habitaciones")
        })
      }
    }

    function ValidForm () {
      var habitaciones = JSON.parse(localStorage.getItem("reservaciones"))
      var update = JSON.parse(localStorage.getItem("update-habi"))
      var fecha = parseInt(localStorage.getItem("fecha"))
      var newDate = parseInt($("#dias--quedar").val())

      if (habitaciones.length === 0) {
        toast("Debe reservar alguna habitacion que tenemos")
        return false
      }
      if(JSON.stringify(habitaciones) === JSON.stringify(update) || fecha === newDate) {
        toast("No se han encontrado cambios en la reservacion")
        return false
      }
      else return true
    }

    $tableReservaciones.on("click", ShowTableReservaciones)
    $("#cancelar-editar").on("click", CancelarReservaciones)
    $(".update-btn").on("click", UpdateReservaciones)
})()
