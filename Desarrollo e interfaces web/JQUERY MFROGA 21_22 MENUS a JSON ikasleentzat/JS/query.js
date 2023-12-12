// Realizar una solicitud para cargar el archivo JSON
$.ajax({
  url: "./JSON/datosPlatos.json",
  dataType: "json",
  success: function (data) {
    const menus = data.menu;

    menus.forEach(function (menu) {
      console.log(`Orden del menú: ${menu.orden}`);

      const datos = menu.datos;
      datos.forEach(function (plato) {
        console.log(`Título: ${plato.titulo}`);
        console.log(`Imagen: ${plato.imagen}`);
        console.log(`Precio: ${plato.precio}`);
        console.log(`Básico: ${plato.basico}`);
        console.log(`Especial: ${plato.especial}`);
        console.log("--------------");
      });

      console.log("==============");
    });

    // Obtener las secciones donde se mostrarán los platos
    const primerosPlatosSection = $("#PrimerosPlatos");
    const segundosPlatosSection = $("#SegundosPlatos");
    const postresPlatosSection = $("#PostresPlatos");

    // Recorrer los platos y crear tarjetas para cada uno
    menus.forEach(function (menu) {
      const categoria = menu.orden;
      const datos = menu.datos;

      datos.forEach(function (plato) {
        const platoCard = $("<div>").addClass("card");
        platoCard.attr("data-basico", plato.basico);
        platoCard.attr("data-especial", plato.especial);

        // Agregar contenido a la tarjeta
        platoCard.html(`
                      <img src="${plato.imagen}" alt="${plato.titulo}">
                      <p>${plato.titulo}</p>
                      <p><span>${plato.precio}€</span>
                      <input type="checkbox" class="classCheckbox" value="${plato.precio}" data-titulo="${plato.titulo}">Seleccionar
                      </p>
                  `);

        // Agregar la tarjeta a la sección correspondiente
        if (categoria === "primero") {
          primerosPlatosSection.append(platoCard);
        } else if (categoria === "segundo") {
          segundosPlatosSection.append(platoCard);
        } else if (categoria === "postre") {
          postresPlatosSection.append(platoCard);
        }
      });
    });

    // Función para filtrar los platos
    function filtrarPlatos() {
      const selectedValue = $("#comboMenus").val();
      console.log(selectedValue);
      const platos = $(".card");

      platos.each(function () {
        const esBasico = $(this).attr("data-basico") === "true";
        const esEspecial = $(this).attr("data-especial") === "true";

        if (
          (selectedValue === "basico" && esBasico) ||
          (selectedValue === "especial" && esEspecial) ||
          selectedValue === "elegir"
        ) {
          $(this).css({ display: "flex" });
        } else {
          $(this).hide();
        }
      });
    }

    if (window.location.search.includes("platos")) {
      $("#comboMenus").hide();
      $("#titulo").html("platos");
      filtrarPlatos();
      console.log("platos");
    }

    // Agrega el evento change al elemento comboMenus
    $("#comboMenus").change(filtrarPlatos);

  
  },
  error: function (error) {
    console.error("Hubo un error al cargar el archivo JSON:", error);
  },
});

$("#elemCompra").on("click", function () {
  var light = $("#light");
  var fade = $("#fade");

  light.css("display", "flex");
  fade.css("display", "flex");
  pillarDatos();

  var salir = $("#btnCancelar");
  salir.on("click", function () {
    window.location.href = "index.html";
  });
});

function pillarDatos() {
  var platosSeleccionados = $(".classCheckbox:checked");
  var aqui = $("#hemenJarri");
  var texto = "";
  var total = 0;
  var btnComprar = $("#btnComprar");

  btnComprar.attr("disabled", "disabled");

  platosSeleccionados.each(function () {
    texto += $(this).data("titulo") + " " + $(this).val() + "€" + "<br>";
    total += parseFloat($(this).val());
  });

  aqui.html(texto + "<br>" + "Total: " + total + "€");
  mostrarDescuento(total);
  alert("Has seleccionado " + platosSeleccionados.length + " platos");
}

function mostrarDescuento(total) {
  var descuentodiv = $("#descuento");
  var edad = $("#edad");
  var direccion = $("#direccion");
  var btnComprar = $("#btnComprar");

  edad.on("input", function () {
    var valor = $(this).val();

    valor = valor.replace(/\D/g, "");

    if (valor.length > 2) {
      valor = valor.slice(0, 2);
    }

    $(this).val(valor);

    direccion.prop("disabled", valor.trim() === "");

    // Calcula el descuento basado en la edad
    var descuento = 0;
    if (valor === "" || valor === "0" || valor === "00") {
      descuentodiv.html("");
    } else if (valor < 18) {
      descuento = total * 0.1;
    } else if (valor > 65) {
      descuento = total * 0.2;
    }

    // Muestra el descuento en el div descuento
    if (descuento > 0) {
      var totalConDescuento = total - descuento;
      descuentodiv.html(
        `<p>PROMOCIÓN: -${((descuento / total) * 100).toFixed(
          0
        )}% = ${Intl.NumberFormat("es-ES", {
          style: "currency",
          currency: "EUR",
        }).format(totalConDescuento)}</p>`
      );
      btnComprar.attr("disabled", "disabled");
    } else {
      descuentodiv.html("");
    }
  });

  $("#direccion").on("keyup", function () {
    var direccion = $("#direccion").val();

    if (direccion.length > 5) {
      // Habilitar el botón Comprar solo si no hay descuento aplicado
      btnComprar.removeAttr("disabled");
    } else {
      btnComprar.attr("disabled", "disabled");
    }
  });

  $("#btnComprar").on("click", function () {
    // Muestra un cuadro de confirmación
    var confirmarCompra = window.confirm(
      "¿Estás seguro de que deseas realizar la compra?"
    );

    if (confirmarCompra) {
      // Aquí puedes agregar la lógica para realizar la compra
      alert("¡Compra realizada con éxito!");
    } else {
      // Aquí puedes agregar la lógica para cancelar la compra o simplemente no hacer nada
      alert("Compra cancelada");
    }
  });
}





