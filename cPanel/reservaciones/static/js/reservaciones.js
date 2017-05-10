;(function () {
  'use strict'

  var index = 0;

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('input, textarea').characterCounter();

  $('select').material_select()
  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15,
    min:$("#fecha_actual").val()
  })

  var reservaciones_array = []
  localStorage.clear()

  var $editarBtn = $(".editar-btn")
  var $botonReservacion = $(".reservacion-btn")
  var $botonCancelar = $(".cancelar-btn")
  var $categorias = $("#categorias")
  var $definido = $("#definido")
  var $Indefinido = $("#indefinido")
  var $maxima_personas = $("#maxi_habitacion")
  var $numeroHabitacion = $(".numeroHabitacion")

  // Inputs
  var $cliente = $("#cliente")
  var $fecha = $("#fecha")
  var $cant = $("#cant")
  var $adultos = $("#adultos")
  var $children = $("#children")
  // var $hasta = $("#hasta")

  function getData () {
    var habitacionesJSON = JSON.parse(localStorage.getItem("reservaciones"))
    return {
      cliente: $cliente.val(),
      fecha: $fecha.val(),
      hasta: $("#dayHosped").html(),
      total: $("#total_price").html(),
      habitaciones: habitacionesJSON,
    }
  }

  function validar () {
    var flag = false
    if (reservaciones_array.length == 0) {
      toast("Debe reservar alguna habitacion que tenemos")
    } else if ($cliente.val() == null) {
      toast("Porfavor ingrese el cliente")
    } else if ($fecha.val() == "") {
      toast("Porfavor ingrese la fecha en la que se hospedaran")
      $fecha.focus()

    }else if($("#dias--quedar").val() === "") {
      toast("Porfavor ingrese los dias que se va a hospedar")
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

            $(`#boton${codigo}`).attr("disabled", true)
          $(`.reservado_${codigo}`).slideDown()
          $(`#card_${codigo}`).css("box-shadow", "none")
          $(`#cd_${codigo}`).css("-webkit-filter", "blur(2px)")
          $(`#cd_${codigo}`).css("filter", "blur(2px)")
          $(`#cd_${codigo} img`).removeClass("activator")
          $(`#title_${codigo}`).removeClass("activator")

          var ctx = {
            "codigo":codigo, "valor":valor,
            "categoria":categoria, "habitacion":habitacion,
            "adultos":$adultos.val(), "children":$children.val(),
            "cant":cantidad, "ocupado": false
          }
          reservaciones_array.push(ctx)
          localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
          cancelarForm()

          if ($("#dias--quedar").val() != 0) {
            HabitacionesOcupadoByFecha()
          }
          else {
            construir()
          }

        }

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
        $(".habitacion-modal").html("")
      }

      function reservacion () {
        if (validar()) {
          $.ajax({
            type:"POST",
            url:"reservaciones/servicio/guardar.php",
            data: getData()
          })
          .done(function (data) {
            console.log(data)
            var json = JSON.parse(data)
            var response = json[0].response

            if(response.status == 1) toast("Debe actualizar los parametros")
            else if(response.status == 3) {
              toast("Ya hay reservaciones para la fecha indicada")
            }
            else if(response.status == 201){
              var ocupados = json[0].ocupadas || []

              ocupados.map(function (el) {
                toast(`Habitacion ${el.habitacion} ocupado...`)
              })
              toast("Se ha realizado su reservacion con exito")
              $(".Layout").load('inicio')
              $(".title-layout").html("Alquiler de habitaciones")
            }

          })
        }
      }

      function cancelar () {
        $("select").val("")
        $('select').material_select("update")
        $fecha.val("")
        $("#dias--quedar").val("")
        localStorage.clear()
        reservaciones_array = []
        limpiarCard()
        $("#habitaciones_reservadas").empty()
        $("#NavPosicion_b").empty()
        $("#total_price").html("0.00")
        $(".reservacion-btn").slideDown()
        $(".update-btn").slideUp()
      }

      function limpiarCard() {
        $(".activo-reservar").attr("disabled", false)
        $(`.activo-cinta`).slideUp()
        $(`.card-title`).addClass("activator")
        $(`.activo-card`).css("box-shadow", "0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12)")
        $(`.image-active`).css("-webkit-filter", "none")
        $(`.image-active`).css("filter", "none")
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
          reservaciones_array.splice(index, 1);
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
         $cant.attr("disabled", true)
         $Indefinido.attr("disabled", true)
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

    function HabitacionesOcupadoByFecha() {
      var habitacionesJSON = JSON.parse(localStorage.getItem("reservaciones"))
      $.ajax({
        type:"POST",
        url:"reservaciones/servicio/validar.php",
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
            construir()
          }
        }

        // if(response[0].ocupadas[index].status === "ocupado") {
        //   $(".label-fecha").addClass("active")
        //   toast(`Habitaciones ocupadas`)

        //   response[0].ocupadas.map(function (el) {
        //     var habitacion = el.habitacion
        //     sacarHabitacionesOcupadas(habitacion)
        //   })
        // }
        // else {
        //   construir()
        //   index++;
        // }

      })
    }

    function calcularDias () {
      var fechaInicial = document.getElementById("fecha").value
      var fechaFinal = document.getElementById("hasta").value;

      var inicial = fechaInicial.split("/")
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

    function numeroHabitacion (e) {
      var id = e.currentTarget.dataset.id
      $(".u-oculto").slideToggle()
      $(".habitacion-modal").load(`reservaciones/partials/habitaciones.php?id=${id}`)
    }

    function editarForm(e) {
      var cliente = e.currentTarget.dataset.cedula
      var codigo = e.currentTarget.dataset.codigo

      $.ajax({
        type:"GET",
        data: { cliente, codigo },
        url:"reservaciones/servicio/reservacion.php",
        dataType:"JSON"
      })
      .done(function (response) {
        console.log(response)
        $(".reservacion-btn").slideUp()
        $(".update-btn").slideDown()
        document.querySelector(".update-btn").dataset.codigo = codigo

        var reservacion = response[0].reservacion
        var habitaciones = response[0].habitaciones
        loadHabitaciones(habitaciones)

        $("#cliente").val(reservacion.cliente_reservacion)
        document.getElementById("cliente").disabled = true
        $('select').material_select("update")

        var fechaJS = reservacion.fecha_habitacion.replace(/-/gi, "/")        

        $("#fecha").val(fechaJS)
        $("#dayHosped").html(reservacion.hasta_habitacion)

        var fecha = document.getElementById("fecha")
        fecha.disabled = true
        $(".label-fecha").addClass("active")
        var dias = restarFechas(reservacion.fecha_habitacion, reservacion.hasta_habitacion)
        $("#dias--quedar").val(dias)
        localStorage.setItem("fecha", dias)

        var totalReservaciones = parseFloat(totalHabitaciones())
        var totalAPagar = parseInt(dias) * totalReservaciones

        $("#total_price").html(totalAPagar.toFixed(2))
      })

      $("#reservaciones-editar").slideUp()
    }

    function loadHabitaciones (habitaciones) {
      reservaciones_array = []
      localStorage.clear()

      habitaciones.map(function (el) {
        var ctx = {
          "codigo" : el.codigo_habitacion,
          "valor" : el.valor_habitacion,
          "categoria" : el.nombre_categoria,
          "habitacion" : el.nombre_habitacion,
          "adultos" : el.adultos_detalle,
          "children" : el.children_detalle,
          "cant" : el.cant_detalle,
          "ocupado" : false
        }
        reservaciones_array.push(ctx)
        localStorage.setItem("reservaciones", JSON.stringify(reservaciones_array))
        localStorage.setItem("update-habi", JSON.stringify(reservaciones_array))
      })
      construir()
    }

    function restarFechas (f1,f2) {
      var aFecha1 = f1.split('-');
      var aFecha2 = f2.split('-'); 
      // aFecha1[0], aFecha1[1], aFecha1[2]
      
      var fecha1 = new Date(f1);
      var fecha2 = new Date(f2);
      var diasDif = fecha2.getTime() - fecha1.getTime();
      var dias = Math.round(diasDif/(1000 * 60 * 60 * 24));

      return dias;
    }

   function handlerDaysStay () {
    onValidFecha()
    var price = parseFloat($("#totalHab").val())
    var daysStay = parseInt($("#dias--quedar").val())
    var totalPrice = price * daysStay

    $("#total_price").html(totalPrice.toFixed(2))

    var fecha = new Date($("#fecha").val())
    fecha.setDate(fecha.getDate() + daysStay)

    var mes = fecha.getMonth() + 1
    var newDate = `${fecha.getFullYear()}-${mes}-${fecha.getDate()}`

    $("#dayHosped").html(newDate)
  }

  $numeroHabitacion.on("click", numeroHabitacion)
  $("#dias--quedar").keyup(handlerDaysStay)

  $botonReservacion.on("click", reservacion)
  $botonCancelar.on("click", cancelar)
  $categorias.on("change", selectCategorias)
  $definido.on("click", definido)
  $(".cancelar-form").on("click", cancelarForm)
  $(".aceptar-form").on("click", saveReservacion)
  $Indefinido.on("click", indefinidoChange)
  $adultos.on("keyup", onMaximaPersona)
  $children.on("keyup", onMaximaPersona)
  $editarBtn.on("click", editarForm)

  // $hasta.on("change", onValidFecha)

  $(".numberHabi").on("click" , function (e) {
    var type = e.currentTarget.dataset.type
    toast(`La habitacion no esta disponible por ${type}`)
  })

})()
