//Header

const headers = document.querySelectorAll(".global__header")

headers.forEach(header => {
    header.innerHTML = `
    
    <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="site-navigation verticalcentrado">
            <a href="index.html" class="logo m-0"><img class="imagenlogo" src="../Assets/img/logo/logo.png" alt="Logo"></a>

            <ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right position-relative ">
                <li class="active"><a href="index.html">Inicio</a></li>
                <li class="has-children">
                    <a class="btn-dest">Destinos</a>
                    <ul class="dropdown">
                        <li><a href="destinos.html?categoria=Playa">Playas paradisiacas</a></li>
                        <li><a href="destinos.html?categoria=Naturaleza">Naturaleza y aventura</a></li>
                        <li><a href="destinos.html?categoria=Gastronomía">Gastronomicos</a></li>
                        <li><a href="destinos.html?categoria=Ciudad">Ciudades</a></li>
                        <li><a href="destinos.html?categoria=Cultura">Historicos y culturales</a></li>
                    </ul>
                </li>
                <li><a href="sobre-nosotros.html">Sobre nosotros</a></li>
                <li><a href="contacto.html">Contacto</a></li>
                <li class="loginBtn postion-relative"> 
                    <a class="">
                        <h5 class="bi bi-person-circle p-0 m-0"></h5>
                        <div class="login-form position-absolute">
                            <input type="text" placeholder="Usuario" class="w-100  p-1 pl-2 campo " name="usuario"></input>
                            <input type="password" placeholder="Contraseña" class="w-100 mt-3  p-1 pl-2 campo" name="contrasena"></input>
                            <button class="btn-iniciarSesion btn btn-primary w-100 p-1 mt-4">Iniciar sesion</button>
                            <button class="btn-registro btn btn-secondary w-100 p-1 mt-2">Registro</button>
                            <div class="mensaje-error"></div>
                        </div>
                    </a>
                </li>

            </li>
            </ul>

            <a href="#"
                class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light"
                data-toggle="collapse" data-target="#main-navbar">
                <span></span>
            </a>

        </div>
    </div>
</nav>

    `;
});

// Importar usuarios
import { usuarios } from "./localStorage/descarga.js";

// Logica login
const btnLogin = document.querySelector(".btn-iniciarSesion");
const mensajeError = document.querySelector(".mensaje-error");
const loginform = document.querySelector(".login-form");
const campo = document.querySelectorAll(".campo");

// Comprueba si el usuario ha iniciado sesión previamente
const isLoggedIn = localStorage.getItem("login") === "true";

if (isLoggedIn) {
    // Si el usuario ha iniciado sesión previamente, muestra el perfil
    const savedUserData = JSON.parse(localStorage.getItem("userData"));
    mostrarPerfil(savedUserData);
}

btnLogin.addEventListener("click", () => {
    const { usuario, contrasena } = obtenerValoresForm();
    const userFound = usuarios.find((user) =>
        user.usuario === usuario && user.contrasena === contrasena
    );

    if (userFound) {
        localStorage.setItem("login", "true");

        localStorage.setItem("userData", JSON.stringify(userFound));

        mostrarPerfil(userFound);
    } else {
        mensajeError.innerHTML = `<i class="bi bi-exclamation-circle-fill mr-1"></i> Credenciales inválidas`;
        mensajeError.classList.add("text-danger", "mt-3");
    }
});

function mostrarPerfil(usuario) {
    loginform.innerHTML = "";

    const userImg = document.createElement("img");
    userImg.classList.add("rounded-circle");
    userImg.src = "https://placehold.co/60";
    loginform.appendChild(userImg);

    if (usuario && usuario.nombre) {
        const user = document.createElement("h5");
        user.classList.add("text-dark", "mt-4");
        user.textContent = usuario.nombre;
        loginform.appendChild(user);

        const email = document.createElement("h6");
        email.classList.add("text-dark", "mt-2");
        email.textContent = usuario.correo;
        loginform.appendChild(email);
    }

    const logoutbtn = document.createElement("button");
    logoutbtn.classList.add("btn", "btn-secondary", "w-100", "p-1", "mt-4");
    logoutbtn.textContent = "LOGOUT";
    btnLogin.style.display = "none";

    logoutbtn.addEventListener("click", () => {

        localStorage.removeItem("login");
        localStorage.removeItem("userData");
        window.location.reload()

    });

    loginform.appendChild(logoutbtn);
}



//Logica Registro
//const btnRegistro = document.querySelector(".btn-registro")
// btnRegistro.addEventListener("click", () => {
//     console.log("Registro");
// });

// Obtener valores del formulario
function obtenerValoresForm() {
    const campos = document.querySelectorAll(".campo");
    const valores = {};

    campos.forEach(campo => {
        valores[campo.name] = campo.value;
    });

    return valores;
}


//Footer
const footers = document.querySelectorAll(".global__footer")
footers.forEach(footer => {
    footer.innerHTML = `
    <div class="site-footer">
    <div class="inner first">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="widget">
                        <h3 class="heading">Sobre SkyPulse</h3>
                        <p>SkyPulse es la agencia de viajes lider en el sector. </p>
                    </div>
                    <div class="widget">
                        <ul class="list-unstyled social">
                            <li><a href="https://twitter.com/?lang=es"><span class="icon-twitter"><i class="bi bi-twitter-x"></i></span></a></li>
                            <li><a href="https://www.instagram.com/"><span class="icon-instagram"><i class="bi bi-instagram"></i></span></a></li>
                            <li><a href="https://www.facebook.com/?locale=es_ES"><span class="icon-facebook"><i class="bi bi-facebook"></i></span></a></li>
                            <li><a href="https://es.linkedin.com/?trk=guest_homepage-basic_nav-header-logo"><span class="icon-linkedin"><i class="bi bi-linkedin"></i></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 pl-lg-5">
                    <div class="widget">
                        <h3 class="heading">Paginas</h3>
                        <ul class="links list-unstyled">
                            <li><a href="destinos.html?categoria=Playa">Destinos</a></li>
                            <li><a href="sobre-nosotros.html">Sobre nosotros</a></li>
                            <li><a href="#">Carrito</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="widget">
                        <h3 class="heading">Recursos</h3>
                        <ul class="links list-unstyled">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Contacto</a></li>
                            <li><a href="https://www.google.com/maps/place/52%C2%B028'48.5%22N+62%C2%B011'09.0%22E/@52.4797906,62.1848557,542m/data=!3m1!1e3!4m4!3m3!8m2!3d52.4801256!4d62.1858301!5m1!1e4?entry=ttu">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="widget">
                        <h3 class="heading">Contacto</h3>
                        <ul class="list-unstyled quick-info links">
                            <li class="email"><a href="#">julendejaelgym@skypulse.com</a></li>
                            <li class="phone"><a href="#">6969696969</a></li>
                            <li class="address"><a href="#">Calle Wallaby, 42, Sidney</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    `
})