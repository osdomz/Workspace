

// Obtén elementos del DOM
const showRegistrationButton = document.getElementById('show-registration-form');
const registrationForm = document.getElementById('registration-form');
const returnToLoginButton = document.getElementById('return-to-login');
const loginForm = document.querySelector('.login-form'); // Obtén el formulario de inicio de sesión
const destinoInput = document.getElementById('destino');
const resultsDiv = document.getElementById('results'); // Div para mostrar resultados
let destinos = []; // Aquí almacenaremos los destinos cargados desde el JSON



// Agrega un evento de clic al botón "Registro"
showRegistrationButton.addEventListener('click', function () {
  // Muestra el formulario de registro
  registrationForm.style.display = 'block';
  // Oculta el formulario de inicio de sesión
  loginForm.style.display = 'none';
  // Oculta el botón "Registro"
  showRegistrationButton.style.display = 'none';
});

// Agrega un evento de clic al botón "Volver al inicio de sesión" dentro del formulario de registro
returnToLoginButton.addEventListener('click', function () {
  // Oculta el formulario de registro
  registrationForm.style.display = 'none';
  // Muestra el formulario de inicio de sesión
  loginForm.style.display = 'block';
  // Muestra el botón "Registro"
  showRegistrationButton.style.display = 'block';
});

// Agrega un evento de envío al formulario de búsqueda
const formSumitLogin = document.querySelectorAll('.sumit');
formSumitLogin.addEventListener('submit', function (e) {
  e.preventDefault();
  var usuarioSumit = document.getElementById("usr").value;
  var contraseñaSumit = document.getElementById("psw").value;
  displayResults(filteredDestinos);
  compararLogin(usuarioSumit, contraseñaSumit);
});


//comprobar usuario y contraseña introducidos
var usuarioencontrado = false;
var login = false;
function compararLogin(usuarioSumit, contraseñaSumit) {
userdata.usuarios.forEach(comprobar => {
  if (comprobar.usuario == usuarioSumit) {
    const usuarioJson = JSON.stringify(usuarioSumit);
    localStorage.setItem("usuario", usuarioJson);
    usuarioencontrado = true;

    if (comprobar.contrasena == contraseñaSumit && usuarioencontrado) {
      const contrasnaJson = JSON.stringify(contraseñaSumit);
      localStorage.setItem("usuario", contrasnaJson);
      login = true;
    };

  }
});
}

// DROPDROWN PERFIL
document.getElementById("dropdrownprofile").addEventListener("click", function () {
const toggleMenu = document.querySelector(".menu-profile");
toggleMenu.classList.toggle("active");
});

// DROPDROWN PERFIL
document.getElementById("dropdrownlogin").addEventListener("click", function () {
const toggleMenu = document.querySelector(".menu-login");
toggleMenu.classList.toggle("active");
});