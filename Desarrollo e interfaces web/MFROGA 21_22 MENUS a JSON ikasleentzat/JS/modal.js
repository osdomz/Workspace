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

      if (window.location.search.includes('platos')) {
          document.getElementById('comboMenus').style.display = "none";
          document.getElementById('titulo').innerHTML = 'platos'
          filtrarPlatos("elegir");
          console.log('platos');
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
    document
      .getElementById("comboMenus")
      .addEventListener("change", filtrarPlatos);

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
    // light.style.display = 'none';
    // fade.style.display = 'none';
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
  alert("Has seleccionado " + platosSeleccionados.length + " platos");
}

function filtroEdad(event) {
  if (event.key >= 0 && event.key <= 9) {
    return true;
  } else {
    return false;
  }
}

document.getElementById("edad").addEventListener("keypress", function (event) {
  if (filtroEdad(event) == false) {
    event.preventDefault();
  }
});

document.getElementById("edad").addEventListener("keyup", function () {
  var edad = document.getElementById("edad").value;
  var direccion = document.getElementById("direccion");

  if (edad.length >= 2) {
    direccion.removeAttribute("disabled");
  } else {
    direccion.setAttribute("disabled", "disabled");
  }
});

document.getElementById("direccion").addEventListener("keyup", function () {
  var direccion = document.getElementById("direccion").value;
  var btnComprar = document.getElementById("btnComprar");

  if (direccion.length > 5) {
    btnComprar.removeAttribute("disabled");
  } else {
    btnComprar.setAttribute("disabled", "disabled");
  }
});

// info.innerHTML += `<h3> TOTAL: ${Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(total)} </h3>`;

// const descuentodiv = document.getElementById('descuento');
// const edad = document.getElementById('edad');
// const direccion = document.getElementById('direccion');

// edad.addEventListener("input", function () {
//     let valor = this.value;

//     valor = valor.replace(/\D/g, '');

//     if (valor.length > 2) {
//         valor = valor.slice(0, 2);
//     }

//     this.value = valor;

//     direccion.disabled = valor.trim() === '';

//     if (valor === '' || valor === '0' || valor === '00') {
//         descuentodiv.innerHTML = '';
//     } else if (valor < 18) {
//         let descuento = total * 0.10;
//         let totalConDescuento = total - descuento;
//         descuentodiv.innerHTML = `<p>PROMOCIÓN: -10% = ${Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(totalConDescuento)}</p>`;
//     } else if (valor > 65) {
//         let descuento = total * 0.20;
//         let totalConDescuento2 = total - descuento;
//         descuentodiv.innerHTML = `<p>PROMOCIÓN: -20% = ${Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(totalConDescuento2)}</p>`;
//     } else {
//         descuentodiv.innerHTML = '';
//     }
// });





