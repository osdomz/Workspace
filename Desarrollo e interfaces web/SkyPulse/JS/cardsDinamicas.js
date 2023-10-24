//Importar funcion para buscar destinos
import { buscarDestino, obtenerParametro } from "./buscarDestinos.js";

//Encontrar destinos
const destinosFiltrados = buscarDestino();

//Cambair titulo de pagina
const pageTitle = document.querySelector(".mb-0")
pageTitle.textContent = obtenerParametro()


//Crear card dummy
const cardFrame = document.createElement("div")
cardFrame.classList.add("destinoCard", "col-6", "col-md-6", "col-lg-3", "p-3")

const mediaFrame = document.createElement("div")
mediaFrame.classList.add("media-1")

const link = document.createElement("a")
link.classList.add("d-block", "mb-3")

const linkImage = document.createElement("img")
linkImage.classList.add("img-fluid")

const infoFrame = document.createElement("div")
infoFrame.classList.add("d-flex")

const infoInner = document.createElement("div")

const cardTitle = document.createElement("h3")
const cardDesc = document.createElement("p")


cardFrame.appendChild(mediaFrame)
mediaFrame.appendChild(link)
mediaFrame.appendChild(infoFrame)
infoFrame.appendChild(infoInner)
infoInner.appendChild(cardTitle)
infoInner.appendChild(cardDesc)
link.appendChild(linkImage)

//Limpiar el contenido de la pagina
const cardContainer = document.querySelector(".untree_co-section .container .row")
cardContainer.innerHTML = ''


//Dar valor a la card dummy y añadir a la pagina
destinosFiltrados.forEach(destino => {
    linkImage.src = '../Assets/img/destinos/' + destino.imagen + '/' + destino.imagen + '.jpg';
    cardTitle.textContent = destino.nombre
    cardDesc.textContent = destino.descripcion

    const cardClone = cardFrame.cloneNode(true);
    cardClone.setAttribute("id", destino.id)
    cardContainer.appendChild(cardClone);
});


//Agregar evento click a todas las cards
const cards = document.querySelectorAll(".destinoCard")
cards.forEach(e =>{
    e.addEventListener("click", ()=>{
        window.location.href = `reserva.html?id=${encodeURIComponent(e.getAttribute("id"))}`;

    })
})