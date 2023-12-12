// Realizar una solicitud para cargar el archivo JSON
fetch("./JSON/datosPlatos.json")
  .then((response) => {
    if (!response.ok) {
      throw new Error("Hubo un error en la solicitud.");
    }
    return response.json();
  })

  .then((data) => {
    const menus = data.menu;

    menus.forEach((menu) => {
      console.log(`Orden del menú: ${menu.orden}`);

      const datos = menu.datos;
      datos.forEach((plato) => {
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
    const primerosPlatosSection = document.getElementById("PrimerosPlatos");
    const segundosPlatosSection = document.getElementById("SegundosPlatos");
    const postresPlatosSection = document.getElementById("PostresPlatos");

    if (window.location.search.includes("platos")) {
      document.getElementById("comboMenus").style.display = "none";
      document.getElementById("titulo").innerHTML = "platos";
      filtrarPlatos("elegir");
      console.log("platos");
    }

    // Recorrer los platos y crear tarjetas para cada uno
    menus.forEach((menu) => {
      const categoria = menu.orden;
      const datos = menu.datos;

      datos.forEach((plato) => {
        const platoCard = document.createElement("div");
        platoCard.classList.add("card");
        platoCard.setAttribute("data-basico", plato.basico);
        platoCard.setAttribute("data-especial", plato.especial);

        // Agregar contenido a la tarjeta
        platoCard.innerHTML = `
        <img src="${plato.imagen}" alt="${plato.titulo}">
        <p>${plato.titulo}</p>
        <p><span>${plato.precio}€</span>
        <input type="checkbox" class="classCheckbox" value="${plato.precio}" data-titulo="${plato.titulo}">Seleccionar
        </p>
        `;

        // Agregar la tarjeta a la sección correspondiente
        if (categoria === "primero") {
          primerosPlatosSection.appendChild(platoCard);
        } else if (categoria === "segundo") {
          segundosPlatosSection.appendChild(platoCard);
        } else if (categoria === "postre") {
          postresPlatosSection.appendChild(platoCard);
        }
      });
    });

    function filtrarPlatos() {
      const selectedValue = document.getElementById("comboMenus").value; // Obtiene el valor seleccionado del menú
      const platos = document.querySelectorAll(".card"); // Selecciona todas las tarjetas de platos

      platos.forEach(function (plato) {
        const esBasico = plato.getAttribute("data-basico") === "true";
        const esEspecial = plato.getAttribute("data-especial") === "true";

        if (
          (selectedValue === "basico" && esBasico) ||
          (selectedValue === "especial" && esEspecial) ||
          selectedValue === "elegir"
        ) {
          // Si el plato cumple con el filtro seleccionado o no se ha seleccionado filtro, muestra el plato
          plato.style.display = "block";
        } else {
          // Si no cumple con el filtro seleccionado, oculta el plato
          plato.style.display = "none";
        }

    

      });
    }

    // Agrega el evento change al elemento comboMenus
    document.getElementById("comboMenus").addEventListener("change", filtrarPlatos);

    // Llama a la función para realizar el filtrado al cargar la página, si es necesario
    filtrarPlatos();
  })
  .catch((error) => {
    console.error("Hubo un error al cargar el archivo JSON:", error);
  });

document.getElementById("elemCompra").addEventListener("click", function () {
  light = document.getElementById("light");
  fade = document.getElementById("fade");

  light.style.display = "flex";
  fade.style.display = "flex";
  pillarDatos();

  salir = document.getElementById("btnCancelar");
  salir.addEventListener("click", function () {
    window.location.href = "index.html";
  });
});

function pillarDatos() {
  let platosSeleccionados = document.querySelectorAll(".classCheckbox:checked");
  let aqui = document.getElementById("hemenJarri");
  let texto = "";
  let total = 0;
  var btnComprar = document.getElementById("btnComprar");

  btnComprar.setAttribute("disabled", "disabled");

  platosSeleccionados.forEach(function (plato) {
    texto +=
      plato.getAttribute("data-titulo") + " " + plato.value + "€" + "<br>";
    total += parseFloat(plato.value);
  });

  aqui.innerHTML = texto + "<br>" + "Total: " + total + "€";
  mostrarDescuento(total);
  alert("Has seleccionado " + platosSeleccionados.length + " platos");
}

function mostrarDescuento(total) {
  const descuentodiv = document.getElementById("descuento");
  const edad = document.getElementById("edad");
  const direccion = document.getElementById("direccion");
  var btnComprar = document.getElementById("btnComprar");

  edad.addEventListener("input", function () {
    let valor = this.value;

    valor = valor.replace(/\D/g, "");

    if (valor.length > 2) {
      valor = valor.slice(0, 2);
    }

    this.value = valor;

    direccion.disabled = valor.trim() === "";

    // Calcula el descuento basado en la edad
    let descuento = 0;
    if (valor === "" || valor === "0" || valor === "00") {
      descuentodiv.innerHTML = "";
    } else if (valor < 18) {
      descuento = total * 0.1;
    } else if (valor > 65) {
      descuento = total * 0.2;
    }

    // Muestra el descuento en el div descuento
    if (descuento > 0) {
      let totalConDescuento = total - descuento;
      descuentodiv.innerHTML = `<p>PROMOCIÓN: -${(
        (descuento / total) *
        100
      ).toFixed(0)}% = ${Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR",
      }).format(totalConDescuento)}</p>`;
      btnComprar.setAttribute("disabled", "disabled");
    } else {
      descuentodiv.innerHTML = "";
    }
  });

  document.getElementById("direccion").addEventListener("keyup", function () {
    var direccion = document.getElementById("direccion").value;

    if (direccion.length > 5) {
      // Habilitar el botón Comprar solo si no hay descuento aplicado
      btnComprar.removeAttribute("disabled");
    } else {
      btnComprar.setAttribute("disabled", "disabled");
    }
  });
  document.getElementById("btnComprar").addEventListener("click", function () {
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
