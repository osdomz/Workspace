document.addEventListener("DOMContentLoaded", load, false);
var nuevaVentana; // Definir la variable fuera del ámbito de las funciones

function load() {
  document.getElementById("finscripcion").addEventListener("submit", onSubmit);
  document.getElementById("fname").addEventListener("keyup", habilitarApellido);

  // Obtén una colección de elementos con el nombre "fabrirPopup"
  var elementosPopup = document.getElementsByName("fabrirPopup");
  // Supongamos que quieres agregar el event listener al primer elemento de la colección
  var primerElementoPopup = elementosPopup[0];
  // Agrega un event listener al primer elemento para ejecutar la función abrirPopup() cuando se haga clic
  primerElementoPopup.addEventListener("click", abrirPopup);

  var crearVentana = document.getElementsByName("fcrearVentana");
  // Supongamos que quieres agregar el event listener al primer elemento de la colección
  var primerVentana = crearVentana[0];
  // Agrega un event listener al primer elemento para ejecutar la función Ventana() cuando se haga clic
  primerVentana.addEventListener("click", mostrarDatos);

  var closeVentana = document.getElementsByName("fcerrarVentana");
  // Supongamos que quieres agregar el event listener al primer elemento de la colección
  var cVentana = closeVentana[0];
  // Agrega un event listener al primer elemento para ejecutar la función Ventana() cuando se haga clic
  cVentana.addEventListener("click", cerrarVentana);
}

function validarCorreo() {
  var correoInput = document.getElementById("correo");
  var correo = correoInput.value.trim();

  if (correo === "") {
    alert("El campo de correo no puede estar vacío.");
    return false; // La validación falla
  }

  if (correo.split("@").length !== 2) {
    alert(
      'Debes introducir al menos y solamente un "@" en la dirección de correo.'
    );
    return false; // La validación falla
  }

  // La validación pasa si llegamos hasta aquí
  return true;
}

function validarClave() {
  var klabe1Input = document.getElementById("klabe1");
  var klabe2Input = document.getElementById("klabe2");
  var klabe1 = klabe1Input.value.trim();
  var klabe2 = klabe2Input.value.trim();

  if (klabe1 === "" || klabe2 === "") {
    alert("Los campos de claves no pueden estar vacíos.");
    return false; // La validación falla
  } else if (klabe1 !== klabe2) {
    alert("Las claves no coinciden.");
    return false; // La validación falla
  }

  return true; // La validación pasa si llegamos hasta aquí
}

function habilitarApellido() {
  var apellidoInput = document.getElementById("apellido");
  var fnameInput = document.getElementById("fname").value;

  if (fnameInput.length != 0) {
    apellidoInput.removeAttribute("disabled");
  } else {
    apellidoInput.setAttribute("disabled", true);
  }
}

function onSubmit(event) {
  event.preventDefault(); // Evitar el envío del formulario por defecto

  var correoValido = validarCorreo();
  var claveValida = validarClave(); // Llama a la función para validar las claves

  if (!correoValido || !claveValida) {
    // Verifica que todas las validaciones sean exitosas
    alert("Por favor, complete todos los campos correctamente.");
  } else {
    // Obtener los valores de los campos de entrada
    var correo = document.getElementById("correo").value;
    var nombre = document.getElementById("fname").value;
    var apellido = document.getElementById("apellido").value;
    var fechaNacimiento = document.getElementById("fnacimiento").value;
    var cursoElegido = document.querySelector(
      'input[name="Curso"]:checked'
    ).value;

    // Crear un objeto con los datos
    var datos = {
      correo: correo,
      nombre: nombre,
      apellido: apellido,
      fechaNacimiento: fechaNacimiento,
      cursoElegido: cursoElegido,
    };

    // Almacenar los datos en localStorage
    localStorage.setItem("datosFormulario", JSON.stringify(datos));

    // Redirigir a bigarrenLehioa.html
    window.location.href = "bigarrenLehioa.html";
  }
}


function abrirPopup() {
  // Define las dimensiones y otras opciones de la ventana emergente
  var opcionesVentana =
    "width=800, height=600, top=100, left=100, resizable=yes, scrollbars=yes";
  // Abre la ventana emergente con una URL específica (reemplaza 'tu_pagina.html' con la URL que deseas)
  var ventanaEmergente = window.open(
    "bigarrenLehioa.html",
    "MiVentanaEmergente",
    opcionesVentana
  );
  // Enfoca la ventana emergente (la trae al frente)
  ventanaEmergente.focus();
}

function mostrarDatos() {
  // Obtén los valores del formulario
  var nombre = document.getElementById("fname").value;
  var fechaNacimiento = document.getElementById("fnacimiento").value;
  var cursoElegido = document.querySelector(
    'input[name="Curso"]:checked'
  ).value;

  // Crea un mensaje personalizado con los datos
  var mensaje =
    nombre +
    ", naciste el " +
    fechaNacimiento +
    " y has elegido " +
    cursoElegido +
    ".";
  // Abre una nueva ventana con una página en blanco
  nuevaVentana = window.open("", "MiNuevaVentana", "width=400, height=300");
  // Escribe el mensaje en la nueva ventana
  nuevaVentana.document.write(
    "<html><head><title>Texto de la alerta</title></head><body>" +
      mensaje +
      "</body></html>"
  );

  // Enfoca la nueva ventana
  nuevaVentana.focus();
}

function cerrarVentana() {
  if (nuevaVentana) { // Verificar si la ventana está abierta antes de intentar cerrarla
    nuevaVentana.close();
  }
}

function mandarDatos() {
  // Lógica para enviar los datos del formulario y generar un mensaje
  return "Datos enviados con éxito.";
}

