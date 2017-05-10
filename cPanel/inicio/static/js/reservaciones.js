;(function () {
  'use strict'

  $("#clientes-select").load("inicio/partials/clientes.php", function () {
    $('select').material_select()
  })

  var reservaciones_array = []
  localStorage.clear()

  var $botonReservacion = $(".reservacion-btn")
  var $botonCancelar = $(".cancelar-btn")
  var $categorias = $("#categorias")
  var $definido = $("#definido")
  var $Indefinido = $("#indefinido")
  var $maxima_personas = $("#maxi_habitacion")
  var $aceptarForm = $("#aceptar-form")

  // Inputs
  // var $cliente = document.getElementById('cliente')
  var $fecha = $("#fecha")
  var $cant = $("#cant")
  var $adultos = $("#adultos")
  var $children = $("#children")
  // var $hasta = $("#hasta")

  function getData () {
    var habitacionesJSON = JSON.parse(localStorage.getItem("reservaciones"))
    var cliente = document.getElementById('cliente')

    return {
      cliente:cliente.value,
      fecha:$fecha.val(),
      hasta:$("#dayHosped").html(),
      total:$("#total_price").html(),
      abono:$("#abonoPagar").val() | 0,
      habitaciones:habitacionesJSON,
    }
  }

  function validar () {
    var flag = false
    var cliente = document.getElementById('cliente')

    if (reservaciones_array.length == 0) {
      toast("Debe reservar alguna habitacion que tenemos")
    } else if (cliente.value == "") {
      toast("Porfavor ingrese el cliente")
    } else if ($fecha.val() == "") {
      toast("Porfavor ingrese la fecha en la que se hospedaran")
      $fecha.focus()

    } else if($("#dias--quedar").val() === "") {
      toast("Porfavor ingrese la fecha hasta cuando se hospedaran")
      $("#dias--quedar").focus()

    }else flag = true

    return flag
  }

  function validarReservacion() {
    var flag = false
    var suma = parseInt($adultos.val()) + parseInt($children.val())

    if($adultos.val() === "" || $adultos.val() == 0) {
      toast("Porfavor ingrese los adultos que se hospedaran")
      $adultos.focus()

    } else if ($children.val() === ""){
      toast("Porfavor ingrese los niños que se hospedaran")
      $children.focus()

    } else if (suma > $maxima_personas.html()) {
      $adultos.val("0")
      $children.val("0")
      toast(`Porfavor no puede ingrear mas de ${ $maxima_personas.html() }`)
    }else flag = true

    return flag
  }

  function saveReservacion (e) {
    var codigo = e.currentTarget.dataset.codigo
    var categoria = e.currentTarget.dataset.categoria
    var habitacion = e.currentTarget.dataset.habitacion
    var valor = e.currentTarget.dataset.valor
    var cantidad = ""

    if (validarReservacion() && validarHabitacion(codigo)) {
      var indef = document.getElementById("indefinido")

      if(indef.checked == true) cantidad = "indefinido"
      else cantidad = $cant.val()

      if(indef.checked == false) cantidad = "indefinido"

      $(`.boton${codigo}`).attr("disabled", true)
      $(`.reservado_${codigo}`).slideDown()
      $(`.card_${codigo}`).css("box-shadow", "none")
      $(`.cd_${codigo}`).css("-webkit-filter", "blur(2px)")
      $(`.cd_${codigo}`).css("filter", "blur(2px)")
      $(`.cd_${codigo} img`).removeClass("activator")
      $(`.title_${codigo}`).removeClass("activator")
      var ctx = {
        "codigo":codigo, "valor":valor,
        "categoria":categoria, "habitacion":habitacion,
        "adultos":$adultos.val(), "children":$children.val(),
        "cant":cantidad,
        "ocupado": false
      }
      reservaciones_array.push(ctx)
      localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))

      cancelarForm()

      if($("#dias--quedar").val() != 0){
        HabitacionesOcupadoByFecha()
      }
      else{
        construir()
      }
    }

    e.stopPropagation()
  }

  function validarHabitacion (id) {
    var flag = false

    if(reservaciones_array.length === 0) {
      flag = true
    }
    else {
      for (var i in reservaciones_array){
        var reservacion = reservaciones_array[i]

        if (reservacion.codigo === id) {
          cancelarForm()
          toast("Esta habitacion ya esta reservada.")
          return false
        }
        else {
          flag = true
        }
      }
    }

    return flag
  }


  function cancelarForm() {
    var def = document.getElementById("definido")
    var inDef = document.getElementById("indefinido")
    $(".HabitacionForm").slideUp()
    $(".u-oculto").slideUp()
    $(".u-oculto").html("")

    $(".HabitacionForm-gastos").slideUp()

    $definido.attr("disabled", false)
    $cant.val("")
    $adultos.val("")
    $children.val("")
    def.checked = false
    inDef.checked = false
    $cant.attr("disabled", false)
    $Indefinido.attr("disabled", false)
    $(".label-habitacion").removeClass("active")
    $cant.removeClass("valid")
    $adultos.removeClass("valid")
    $children.removeClass("valid")

    $(".habitacion-modal").html("")
  }

  function reservacion () {
    if (validar()) {
      $.ajax({
        type:"POST",
        url:"inicio/servicio/guardar.php",
        data:getData()
      })
      .done(function (data) {
        var json = JSON.parse(data)
        var response = json[0].response
        if(response.status == 1) toast("Debe actualizar los parametros")
        else if(response.status == 3) {
          toast("Ya hay reservaciones para la fecha indicada")
        }
        else if(response.status == 201) {
          var ocupados = json[0].ocupadas || []

          ocupados.map(function (el) {
            toast(`Habitacion ${el.habitacion} ocupado...`)
          })

          toast("Se ha realizado su reservacion con exito")
          $(".Layout").load('inicio')
          $(".u-oculto").slideToggle()

        }
      })
    }
  }

  function cancelar () {
    $(".u-oculto").slideToggle()
    $(".Reservas-formularios").slideToggle()
    $(".notify").html("0")
    $("select").val("")
    $('select').material_select("update")
    $("dias--quedar").val("")
    localStorage.clear()
    reservaciones_array = []
    $(".activo-reservar").attr("disabled", false)
    $(`.activo-cinta`).slideUp()
    $(`.activo-card`).css("box-shadow", "0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12)")
    $(`.image-active`).css("-webkit-filter", "none")
    $(`.image-active`).css("filter", "none")
    $("#habitaciones_reservadas").empty()
    $("#NavPosicion_b").empty()
    $("#total_price").html("0.00")
  }

  function selectCategorias () {
    var card = $(".nombre_categoria-reservaciones")
    var name = $categorias.val()

    if(name == "todos") {
      $(".Reservas-active").slideDown()

    } else {
      var sUp = card.filter(function (e, i){
        var cat = $(i).html()
        return cat != name
      })
      sUp.parent().parent().parent().parent().slideUp()

      var sDown = card.filter(function (e, i){
        var cat = $(i).html()
        return cat == name
      })
      sDown.parent().parent().parent().parent().slideDown()

    }

  }

  function definido () {
    var def = document.getElementById("definido")
    if(def.checked == true) {
      $definido.attr("disabled", true)
      $(".HabitacionForm-gastos").slideDown()
    }
  }

  function construir () {
    var reservaciones = JSON.parse(localStorage.getItem("reservaciones"))
    var table_habitaciones = $("#habitaciones_reservadas")
    var total = 0
    table_habitaciones.html("")
    $(".notify").html(reservaciones.length)

    reservaciones.map(function(e, i) {
      total += parseFloat(e.valor)
      var tpl = $(`<tr>
            <td>${ e.categoria }</td>
            <td>${ e.habitacion }</td>
            <td>${ e.adultos }</td>
            <td>${ e.children }</td>
            <td>${ e.cant }</td>
            <td>${ e.valor }</td>
            <td>
              <button class="waves-effect waves-light btn-flat blue-text delete flex" data-index="${i}">
                Eliminar <i class="material-icons">delete</i>
              </button>
            </td>
          </tr>`)
      if(e.ocupado === true){
        tpl.addClass("red white-text")
      }

      table_habitaciones.append(tpl)
    })

    $(".delete").on("click", function (e) {
      var index = e.currentTarget.dataset.index
      reservaciones_array.splice(index, 1)
      localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
      construir()
    })

    var daysStay = parseInt($("#dias--quedar").val()) | 0
    var totalPay = daysStay * total
    $("#total_price").html(totalPay.toFixed(2))
    $("#totalHab").val(total)

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

  function indefinidoChange () {
    var indef = document.getElementById("indefinido")
    if(indef.checked == true){
     // $cant.attr("disabled", true)
     // $Indefinido.attr("disabled", true)
    }
  }

  function onMaximaPersona () {
    setTimeout(function () {
      var value = $(this).val() | 0
      var suma = parseInt($adultos.val()) + parseInt($children.val())

      if($(".u-oculto").children()[0] === undefined) {
        var cantPerson = parseInt($maxima_personas.html()) - parseInt(value)
        $(".u-oculto").html(`<h3 class="oculto--cant">
            Maximo de pesonas <span id="CantPerson">${cantPerson}</span></h3>`)
      }
      else {
        var cantPerson = parseInt($("#CantPerson").html()) - parseInt(value)
        $(".u-oculto").html(`<h3 class="oculto--cant">
            Maximo de pesonas <span id="CantPerson">${cantPerson}</span></h3>`)

      }

      if (parseInt(value) === parseInt($maxima_personas.html())) {
        // $children.attr("disabled", true)
        $children.val("0")
        $(".label-habitacion").addClass("active")

      } else if(parseInt(value) > parseInt($maxima_personas.html())) {
        $(this).val("0")
        $children.val("0")
        $(".label-habitacion").addClass("active")
        toast(`No puede ingresar mas de ${ $maxima_personas.html() } en esta habitacion`)

      } else if(parseInt(value) < parseInt($maxima_personas.html())) {
        $children.attr("disabled", false)
      }
    }.bind(this), 300)
  }

  function onValidFecha() {
    setTimeout(function () {
      HabitacionesOcupadoByFecha()
    }, 1000)
  }

  function HabitacionesOcupadoByFecha () {
    var habitacionesJSON = JSON.parse(localStorage.getItem("reservaciones"))
    $.ajax({
      type:"POST",
      url:"inicio/servicio/validar.php",
      data:{ fecha:$fecha.val(), hasta:$("#dayHosped").html(), habitaciones:habitacionesJSON }
    })
    .done(function (response) {
      response = JSON.parse(response)
      console.log(response)
        for(var i in response[0].ocupadas){
          var habi = response[0].ocupadas[i]

          if(habi.status == "ocupado") {
            toast(`Habitaciones ocupadas por reservacion`)
            var reservaciones = JSON.parse(localStorage.getItem("reservaciones"))
            sacarHabitacionesOcupadas(habi.habitacion)
          }
          else {
            // alert("construir")
            construir()
          }

        }
        // if(response[0].ocupadas[0].status != 200) {
        //   toast(`Habitaciones ocupadas`)

        //   response[0].ocupadas.map(function (el) {
        //     var habitacion = el.habitacion
        //     sacarHabitacionesOcupadas(habitacion)
        //   })

        // }
        // else {
        //   construir()
        // }
    })
  }

  function calcularDias () {
    var fechaInicial = document.getElementById("fecha").value
    var fechaFinal = document.getElementById("hasta").value;

    var inicial = fechaInicial.split("-")
    var final = fechaFinal.split("/")

    var dateStart = new Date(inicial[0], (inicial[1]-1), inicial[2])
    var dateEnd = new Date(final[0], (final[1]-1), final[2])

    var dias = (((dateEnd - dateStart)/ 86400 )/ 1000)
    dias = dias + 1

    $("#dayHosped").html(dias)

    var totalReservaciones = parseFloat(totalHabitaciones())
    var totalAPagar = parseInt(dias) * totalReservaciones

    $("#total_price").html(totalAPagar.toFixed(2))
  }

  function totalHabitaciones () {
    var parse = JSON.parse(localStorage.getItem("reservaciones"))
    var total = 0

    for (var i in parse) {
      var item = parse[i]
      total += JSON.parse(item.valor)
    }

    return total
  }

  function sacarHabitacionesOcupadas(habitacion) {
    var reservaciones = JSON.parse(localStorage.getItem("reservaciones"))
    reservaciones.map(function (el, i) {
      if (el.codigo ===  habitacion) {
        reservaciones_array.splice(i, 1);
        // reservaciones_array[i].ocupado = true
        localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
        construir()
        limpiarCardOne(habitacion)
      }
    })

  }

  function limpiarCardOne (codigo) {
    $(`#boton${codigo}`).attr("disabled", false)
    $(`.reservado_${codigo}`).slideUp()
    $(`#card_${codigo}`).css("box-shadow", "0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12)")
    $(`#cd_${codigo}`).css("-webkit-filter", "none")
    $(`#cd_${codigo}`).css("filter", "none")
    $(`#cd_${codigo} img`).addClass("activator")
    $(`#title_${codigo}`).addClass("activator")
  }

  function handlerOverHabitacion (e) {
    var type = e.currentTarget.dataset.type
    $("#message-reservas").html(`${type}`)
  }

  function handlerLeaveHabitacion () {
    $("#message-reservas").html(`Reserve habitaciones`)
  }

  function handlerDaysStay () {
    onValidFecha()
    var price = parseFloat($("#totalHab").val())
    var daysStay = parseInt($("#dias--quedar").val())
    var totalPrice = price * daysStay
    $("#total_price").html(totalPrice.toFixed(2))
  }

  $aceptarForm.click(saveReservacion)

  $botonReservacion.on("click", reservacion)
  $botonCancelar.on("click", cancelar)
  $categorias.on("change", selectCategorias)
  $definido.on("click", definido)
  $(".cancelar-form").on("click", cancelarForm)
  $Indefinido.on("click", indefinidoChange)
  $adultos.on("keyup", onMaximaPersona)
  $children.on("keyup", onMaximaPersona)
  $("#dias--quedar").keyup(handlerDaysStay)
  // $hasta.on("change", onValidFecha)
  $(".over-hab").mouseover(handlerOverHabitacion)
  $(".over-hab").mouseleave(handlerLeaveHabitacion)

})()
