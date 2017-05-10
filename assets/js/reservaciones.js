;(function () {
  'use strict'

  $('input, textarea').characterCounter();

  $('select').material_select()

  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15,
    min:$("#fecha_actual").val()
  })

  var reservaciones_array = []
  localStorage.clear()

  var $reservarHabitacion = $(".reservarHabitacion")
  var $botonReservacion = $(".reservacion-btn")
  var $botonCancelar = $(".cancelar-btn")
  var $categorias = $("#categorias")
  var $definido = $("#definido")
  var $Indefinido = $("#indefinido")
  var $maxima_personas = $("#maxi_habitacion")

  // Inputs
  var $fecha = $("#fecha")
  var $cant = $("#cant")
  var $adultos = $("#adultos")
  var $children = $("#children")
  var $hasta = $("#dayHosped")
  var $diasQuedar = $("#dias--quedar")

  function getData () {
    var habitacionesJSON = JSON.parse(localStorage.getItem("reservaciones"))
    return {
      fecha:$fecha.val(),
      hasta:$hasta.html(),
      total:$("#total_price").html(),
      habitaciones:habitacionesJSON,
    }
  }

  loadCarrito()

  function loadCarrito () {
    $.ajax({
      type:"GET",
      url:"servicios/carrito.php",
      dataType:"JSON"
    })
    .done(function (response) {
      console.log(response)
      if(parseInt(response.status.status) === 200){

        for (var i in response.habitaciones) {
          var habitacion = response.habitaciones[i]
          var ctx = {
            "codigo":habitacion.codigo, "valor":habitacion.valor,
            "categoria":habitacion.categoria, "habitacion":habitacion.habitacion,
            "adultos":habitacion.adultos, "children":habitacion.children,
            "cant":habitacion.cant, "ocupado": habitacion.ocupado
          }
          reservaciones_array.push(ctx)
        }

        localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
        construir()

      }
    })
  }

  function validar () {
    var flag = false
    if (localStorage.length == 0) {
      toast("Debe reservar alguna habitacion que tenemos")
    } else if ($fecha.val() == "") {
      toast("Porfavor ingrese la fecha en la que se hospedaran")
      $fecha.focus()

    } else if($diasQuedar.val() == "") {
      toast("Porfavor ingrese la fecha hasta cuando se hospedaran")
      $diasQuedar.focus()

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

      $(`.button${codigo}`).attr("disabled", true)
      $(`.reservado_${codigo}`).slideDown()
      $(`.card_${codigo}`).css("box-shadow", "none")
      $(`.cd_${codigo}`).css("-webkit-filter", "blur(2px)")
      $(`.cd_${codigo}`).css("filter", "blur(2px)")
      $(`.cd_${codigo} img`).removeClass("activator")
      $(`.title_${codigo}`).removeClass("activator")

      var ctx = {
        "codigo":codigo, "valor":valor, "categoria":categoria,
        "habitacion":habitacion, "adultos":$adultos.val(), "children":$children.val(),
        "cant":cantidad,
        "ocupado": false
      }

      guardar_carrito(ctx)

      reservaciones_array.push(ctx)
      localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
      cancelarForm()

      if($diasQuedar.val() != "")
        HabitacionesOcupadoByFecha()
      else
        construir()
    }

  }

  function guardar_carrito (object) {
    $.ajax({
      type:"POST",
      url:"servicios/carrito_save.php",
      data:object
    })
    .done(function (response) {
      console.log(response)
    })
  }

  function reservarHabitacion(e) {
    var codigo = e.currentTarget.dataset.codigo
    var categoria = e.currentTarget.dataset.categoria
    var habitacion = e.currentTarget.dataset.habitacion
    var valor = e.currentTarget.dataset.valor
    var cant = e.currentTarget.dataset.cant

    if($("#sessionInit").val() === "Session"){
      var aceptar = document.querySelector(".aceptar-form")


      aceptar.dataset.codigo = codigo
      aceptar.dataset.categoria = categoria
      aceptar.dataset.habitacion = habitacion
      aceptar.dataset.valor = valor
      $maxima_personas.html(cant)

      $(".HabitacionForm").slideDown()
      $(".u-oculto").slideDown()
    }
    else {
      toast(`Debe iniciar sesión si desea alquilar la habitacion N° ${habitacion}`)
    }
  }

  function cancelarForm() {
    $(".menssage-cliente").html("")
    var def = document.getElementById("definido")
    var inDef = document.getElementById("indefinido")
    $(".HabitacionForm").slideUp()
    $(".u-oculto").slideUp()
    $definido.attr("disabled", false)
    $(".HabitacionForm-gastos").slideUp()
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
  }

  function reservacion () {
    if (validar()) {
      $.ajax({
        type:"POST",
        url:"servicios/reservacion.php",
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
          cancelar()
        }
      })
    }
  }

  function cancelar () {
    $.ajax({
      type:"POST",
      url:"servicios/eliminar_carrito.php",
    })
    .done(function (response) {
      if(response == "2") {
        limpiezaCerra()
        $(".carrito").removeClass("carrito--active")
        $(".wizar--message").html("Seleciona las habitacioens a reservar.")
        // toast("Se ha eliminado su pedidos con exito")
      }
      else {
        toast("Disculpe, tenemos problemas al eliminar sus pedidos, vuelva a intentarlo.")
      }
    })

  }

  function limpiezaCerra() {
    // $("select").val("")
    // $('select').material_select("update")
    $fecha.val("")
    $diasQuedar.val("")
    $hasta.html("")
    $(".notify-front").html("0")
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
    $(".Reservas-formularios-cliente").slideToggle()
    $(".label-fecha").removeClass("active")
    $(".label-debe").removeClass("active")
  }

  function selectCategorias () {
    var name = $categorias.val()
    var $catCode = $(`#catInput${name}`)

    if(name == "todos") {
      $(".Reservas-Habitaciones section").slideDown()
    }
    else {
      $(".Reservas-Habitaciones section").slideUp()
      $catCode.parent().slideDown()
    }

  }

  function definido () {
    var def = document.getElementById("definido")
    $(".HabitacionForm-gastos").slideToggle()
    // if(def.checked == true) {}
  }

  function construir () {
    var reservaciones = JSON.parse(localStorage.getItem("reservaciones"))
    var table_habitaciones = $("#habitaciones_reservadas")
    var total = 0
    table_habitaciones.html("")
    $(".notify-front").html(reservaciones.length)
    $(".wizar--message").html("Siguiente reservar las habiatciones")
    $(".carrito").addClass("carrito--active")

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

      if(e.ocupado === true)
        tpl.addClass("red white-text")

      table_habitaciones.append(tpl)
    })

    $("#total_price").html(total.toFixed(2))

    $(".delete").on("click", function (e) {
      var index = e.currentTarget.dataset.index
      reservaciones_array.splice(index, 1);
      localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
      construir()
    })

    var pagin = new Paginator("#Tab_Filter", "#NavPosicion_b", 2)
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

  function onMaximaPersona () {
    setTimeout(function () {
      var value = $(this).val() | 0
      var suma = parseInt($adultos.val()) + parseInt($children.val())

      if($(".menssage-cliente").children()[0] === undefined) {
        var cantPerson = parseInt($maxima_personas.html()) - parseInt(value)
        $(".menssage-cliente").html(`<h3 class="oculto--cant">
            Maximo de pesonas <span id="CantPerson">${cantPerson}</span></h3>`)
      }
      else {
        var cantPerson = parseInt($("#CantPerson").html()) - parseInt(value)
        $(".menssage-cliente").html(`<h3 class="oculto--cant">
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


  function calcularDias () {
    var fechaInicial = document.getElementById("fecha").value
    var fechaFinal = document.getElementById("hasta").value;

    var inicial = fechaInicial.split("/")
    var final = fechaFinal.split("/")

    var dateStart = new Date(inicial[0], (inicial[1]-1), inicial[2])
    var dateEnd = new Date(final[0], (final[1]-1), final[2])

    var dias = (((dateEnd - dateStart)/ 86400 )/ 1000)
    $("#dayHosped").html(dias)
  }

  function onValidFecha() {
  //  calcularDias()
   HabitacionesOcupadoByFecha()
  }

  function HabitacionesOcupadoByFecha () {
    var habitacionesJSON = JSON.parse(localStorage.getItem("reservaciones"))

    $.ajax({
      type:"POST",
      url:"cPanel/inicio/servicio/validar.php",
      data:{ fecha:$fecha.val(), hasta:$hasta.html(), habitaciones:habitacionesJSON }
   })
   .done(function (response) {
      response = JSON.parse(response)
      if(response[0].ocupadas[0].status != 200) {

        // $hasta.val("")
        // $(".label-hasta").removeClass("active")
        toast(`Habitaciones ocupadas`)
        response[0].ocupadas.map(function (el) {
          var habitacion = el.habitacion
          sacarHabitacionesOcupadas(habitacion)
        })

      }
   })
  }

  function sacarHabitacionesOcupadas (habitacion) {
    var reservaciones = JSON.parse(localStorage.getItem("reservaciones"))
    reservaciones.map(function (el, i) {
      if (el.codigo ===  habitacion) {
        reservaciones_array[i].ocupado = true
        localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
        construir()
        limpiarCardOne(habitacion)
      }
    })
  }

  function limpiarCardOne (codigo) {
    $(`.boton${codigo}`).attr("disabled", false)
    $(`.reservado_${codigo}`).slideUp()
    $(`.card_${codigo}`).css("box-shadow", "0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12)")
    $(`.cd_${codigo}`).css("-webkit-filter", "none")
    $(`.cd_${codigo}`).css("filter", "none")
    $(`.cd_${codigo} img`).addClass("activator")
    $(`.title_${codigo}`).addClass("activator")
  }

  function handlerDaysStay () {
    setTimeout(function () {
      var price = parseFloat($("#total_price").html())
      var daysStay = parseInt($("#dias--quedar").val())
      var totalPrice = price * daysStay

      $("#total_price").html(totalPrice.toFixed(2))

      var value = parseInt($(this).val())
			var fecha = new Date($("#fecha").val())
			fecha.setDate(fecha.getDate() + value)

			var newDate = `${fecha.getFullYear()}-${fecha.getMonth()+1}-${fecha.getDate()}`

			$("#dayHosped").html(newDate)

    }.bind(this), 300)
  }

  $reservarHabitacion.on("click", reservarHabitacion)
  $botonReservacion.on("click", reservacion)
  $botonCancelar.on("click", cancelar)
  $categorias.on("change", selectCategorias)
  $definido.on("click", definido)
  $(".cancelar-form").on("click", cancelarForm)
  $(".aceptar-form").on("click", saveReservacion)
  // $Indefinido.on("click", indefinidoChange)
  $adultos.on("keyup", onMaximaPersona)
  $children.on("keyup", onMaximaPersona)
  $hasta.on("change", onValidFecha)
  $("#dias--quedar").keyup(handlerDaysStay)

  $(".promocion-btn").on("click", function () {
    $(".PromocionesHome").slideDown()
  })


  $(".cerrar-promociones").on("click", function () {
    $(".PromocionesHome").slideUp()
  })

  $("#ShowPanel").click(function () {
    $(".Reservas-formularios-cliente").slideToggle()
  })

  $(".retornar").on("click", function () {
    $(".Reservas-formularios-cliente").slideToggle()
  })


})()
