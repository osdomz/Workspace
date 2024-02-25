// Función para cargar la barra de navegación
function cargarBarraNavegacion() {
  fetch("CONTENTS/tools/navbar.html")
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("navbar").innerHTML = data;
      // Obtén elementos del DOM
      const showRegistrationButton = document.getElementById(
        "show-registration-form"
      );
      const registrationForm = document.getElementById("registration-form");
      const returnToLoginButton = document.getElementById("return-to-login");
      const loginForm = document.getElementById("login-form"); // Obtén el formulario de inicio de sesión
      const miCarritoLink = document.getElementById("carrito-link");

      // Agrega un evento de clic al botón "Registro"
      showRegistrationButton.addEventListener("click", function (event) {
        // Muestra el formulario de registro
        event.stopPropagation(); // Evitar que el menú se cierre
        registrationForm.style.display = "block";

        // Oculta el formulario de inicio de sesión
        loginForm.style.display = "none";

        // Oculta el botón "Registro"
        showRegistrationButton.style.display = "none";
        miCarritoLink.classList.remove("disabled");
        miCarritoLink.removeAttribute("aria-disabled");
      });

      // Agrega un evento de clic al botón "Volver al inicio de sesión" dentro del formulario de registro
      returnToLoginButton.addEventListener("click", function (event) {
        event.stopPropagation(); // Evitar que el menú se cierre
        // Oculta el formulario de registro
        registrationForm.style.display = "none";

        // Muestra el formulario de inicio de sesión
        loginForm.style.display = "block";

        // Muestra el botón "Registro"
        showRegistrationButton.style.display = "block";
        // Habilita el botón "Mis Viajes"
        miCarritoLink.classList.remove("disabled");
        miCarritoLink.removeAttribute("aria-disabled");
      });
    });
}

  
  // Función para cargar los filtros de página
  function cargarFiltrosPagina() {
    fetch("CONTENTS/tools/filtros.html")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("filtros").innerHTML = data;
      });
  }
  
  // Función para cargar el pie de página
  function cargarPiePagina() {
    fetch("CONTENTS/tools/footer.html")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("footer").innerHTML = data;
      });
  }
  
  // Llamar a las funciones para cargar los elementos
  cargarBarraNavegacion();
  cargarFiltrosPagina();
  cargarPiePagina();
  
