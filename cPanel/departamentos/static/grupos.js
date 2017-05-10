'use strict'

var GroupApp = {}

GroupApp.reservacionesArray = []

GroupApp.reserveRoom = function (e) {
  var codigo = e.currentTarget.dataset.codigo
  var categoria = e.currentTarget.dataset.categoria
  var habitacion = e.currentTarget.dataset.habitacion
  var valor = e.currentTarget.dataset.valor
  var cant = e.currentTarget.dataset.cant

  var el = document.getElementById(`check_${codigo}`)

  if(el.checked === false) {
    GroupApp.addRoom(e.currentTarget.dataset)
  }
  else {
    GroupApp.removeRoom(codigo)
  }
}

GroupApp.addRoom = function (object) {
  var ctx = {
    "codigo": object.codigo, "valor": object.valor,
    "categoria": object.categoria, "habitacion": object.habitacion,
    "adultos": object.cant, "children": 0,
    "cant": object.cant,
    "ocupado": false
  }
  GroupApp.reservacionesArray.push(ctx)
  GroupApp.build()
}

GroupApp.removeRoom = function (codigo) {
  for (var i in GroupApp.reservacionesArray) {
    var item = GroupApp.reservacionesArray[i]

    if(item.codigo === codigo) {
      GroupApp.reservacionesArray.splice(i, 1)
      GroupApp.build()
      return false
    }
  }
}

GroupApp.build = function () {
  var tableHabitaciones = $("#habitaciones_reservadas")
  var total = 0

  tableHabitaciones.html("")

  GroupApp.reservacionesArray.map(function(e, i) {
    total += parseFloat(e.valor)
    var tpl = $(`<tr>
      <td>${ e.categoria }</td>
      <td>${ e.habitacion }</td>
      <td>${ e.adultos }</td>
      <td>${ e.children }</td>
      <td>${ e.cant }</td>
      <td>${ e.valor }</td>
      </tr>`)

    tableHabitaciones.append(tpl)
  })

  var daysStay = 1
  var totalPay = daysStay * total
  $("#total_price").html(totalPay.toFixed(2))

  GroupApp.paginator()
}

GroupApp.aceptReserve = function () {
  if (GroupApp.validReseve()) {

    $.ajax({
      type: "POST",
      url: "departamentos/service/save.php",
      data: GroupApp.data()
    })
    .done(function (response) {
      console.log(response)
      toast("Se ha realizado se reservo con exito con exito")
      $(".title-layout").html("Alquiler de habitaciones")
      $(".Layout").load('inicio')
    })
  }
}

GroupApp.cancelReserve = function () {
  GroupApp.reservacionesArray = []
  GroupApp.build()

  $("#fecha").val("")
  $("#cliente").val("")
  $('select').material_select("update")
  $("label").removeClass("active")
}

GroupApp.validReseve = function () {
  var flag = false
  var cliente = document.getElementById('cliente')

  if (GroupApp.reservacionesArray.length == 0) {
    toast("Debe reservar alguna habitacion que tenemos")
  } 
  else if (cliente.value == "") {
    toast("Porfavor ingrese el cliente")
  }
  else if ($("#fecha").val() == "") {
    toast("Porfavor ingrese la fecha en la que se hospedaran")
    $("#fecha").focus()

  }
  else flag = true

  return flag

}

GroupApp.data = function () {
  var cliente = document.getElementById('cliente')
  
  return  {
    cliente: cliente.value,
    fecha: $("#fecha").val(),
    total: $("#total_price").html(),
    habitaciones: GroupApp.reservacionesArray,
  }
}

GroupApp.paginator = function () {
  var pagin = new Paginator("#Tab_Filter", "#NavPosicion_b", 1)
  pagin.init()
  pagin.showNavigation()
  pagin.showPage(1)

  $(".pagin-boton").on("click", function (e) {
    var id = e.currentTarget.dataset.id
    pagin.showPage(id)
  })

  $(".prev").on("click", function (e) {
    pagin.prev()
  })

  $(".next").on("click", function (e) {
    pagin.next()
  })
}