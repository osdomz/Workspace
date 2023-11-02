const Headers = document.querySelectorAll(".global__header")
const Footers = document.querySelectorAll(".global__footer")



window.addEventListener("DOMContentLoaded", (e) => {

    //Global__header
    Headers.forEach((header) => {
        header.innerHTML = `
         <div class="header-logo">
             <img class="header-logo-img" src="../Assets/Img/logo_white.svg"/>
          </div>
          
          <nav class="menu">
               <ul class="menu-list">
                    <li class="menu-item">
                        <a class="menu-link" href="../Inicio.html">Inicio</a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="../Especificaciones.html">Especificaciones</a>
                    </li>
                </ul>
           </nav>

           <div class="preorder-btn">
            <a class="preorder-btn-link" href="../Preorder.html">Preorder</a>
           </div>
        `;
    });

    //Global__Footer
    Footers.forEach((footer) => {
        footer.innerHTML = `

            <div class="footer-info-first">
                <div class="footer-logo">
                    <img class="footer-logo-img" src="../Assets/Img/logo_white.svg"/>
                    <p class="footer-text">
                        En 2011, comenzamos nuestra apasionante travesía con un objetivo en mente: revolucionar la telefonia. 
                        Desde entonces, hemos estado comprometidos en ofrecer lo mejor en tecnología y servicio excepcional a nuestros clientes.                    
                    </p>
                </div>

                <div class="footer-menu">
                    <div class="footer-menu-item">
                        <h3>PeraPhone</h3>
                        <ul>
                            <li><a href="#">Especificaciones</a></li>    
                            <li><a href="#">Roadmap</a></li>    
                            <li><a href="#">Mejoras</a></li>    
                        </ul>

                    </div>

                    <div class="footer-menu-item">
                        <h3>Enlaces utiles</h3>
                        <ul>
                            <li><a href="#">FAQ</a></li>    
                            <li><a href="#">Soporte</a></li>    
                            <li><a href="#">Legal</a></li>    
                            <li><a href="#">Sitemap</a></li>    
                        </ul>
                    </div>

                    <div class="footer-menu-item">
                        <h3>Newsletter</h3>
                        <p>Dejanos tu correo: </p>
                        <input id="input" type="Email" placeholder="pepe@gmail.com"></input>
                    </div>
                </div>

                <div class="footer-btns">
                    <a class="footer-btn">Comprar</a>
                    <a class="footer-btn">Saber mas</a>
                </div>
            </div>

            <div class="footer-info-second">
                <p>PeraPhone © Todos los derechos reservados</p>

                <ul class="footer-info-second-icons">
                    <li class="icons-item">
                        <span>Siguenos: </span>
                    </li>
                    <li class="icons-item">
                        <a href=#><i class="fa-brands fa-instagram"></i></a>
                    </li>
                    <li class="icons-item">
                        <a href=#><i class="fa-brands fa-youtube"></i></a>
                    </li>
                    <li class="icons-item">
                        <a href=#><i class="fa-brands fa-x-twitter"></i></a>
                    </li>
                    <li class="icons-item">
                        <a href=#><i class="fa-brands fa-facebook"></i></a>
                    </li>
                </ul>
            </div>


        `;
    });






})

