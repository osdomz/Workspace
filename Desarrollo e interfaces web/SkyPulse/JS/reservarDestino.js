import {buscarDestino} from "./buscarDestinos.js";

//Obtener destino
const destino = buscarDestino()

//Cambiar titulo de pagina
const title = document.querySelector(".mb-0")
title.textContent = 'Reservar ' + destino[0].nombre

//Cambiar imagenes de carrusel
const carouselItems = document.querySelectorAll(".carousel-item");
carouselItems.forEach((item, i) => {
    const img = item.querySelector("img");
  
    if (i === 0) {
      img.src = `../Assets/img/destinos/${destino[0].imagen}/${destino[0].imagen}.jpg`
    } else {
      img.src = `../Assets/img/destinos/${destino[0].imagen}/${i}.jpg`;
    }
  });

 //Cambiar imagenes de indicador del carrusel
 const carruselIndicator = document.querySelectorAll(".list-inline-item")
carruselIndicator.forEach((item, i) =>{
    const thumnail = item.querySelector("img")

    if (i === 0) {
        thumnail.src = `../Assets/img/destinos/${destino[0].imagen}/${destino[0].imagen}.jpg`
      } else {
        thumnail.src = `../Assets/img/destinos/${destino[0].imagen}/${i}.jpg`;
      }
}) 


//Cambiar titulo de sobre destino
const infoDestinoTitle = document.querySelector(".info-destino-title")
infoDestinoTitle.textContent = 'Sobre ' + destino[0].nombre

//Cambiar textos
 const infoDestinoTexto = document.querySelectorAll(".info-destino-texto")
 infoDestinoTexto.forEach((e, i) =>{
    e.textContent = destino[0].descripcion[i]
})

//Cambiar info hotel
const hoteltitle = document.querySelector(".hotel-title")
hoteltitle.textContent = destino[0].destInfo.nombre

const numPersonas = document.querySelector(".numPersonas")
numPersonas.textContent = destino[0].destInfo.numPersonas + ' personas'

const numCamas = document.querySelector(".numCamas")
numCamas.textContent = destino[0].destInfo.numCamas + ' camas'

const fechaEntrada = document.querySelector(".fechaEntrada")
fechaEntrada.textContent = destino[0].destInfo.fechaEntrada

const fechaSalida = document.querySelector(".fechaSalida")
fechaSalida.textContent = destino[0].destInfo.fechaSalida

const precio = document.querySelector(".precio")
precio.textContent = destino[0].destInfo.precio

//Añadir evento a boton de reserva
const btnReserva = document.querySelector(".btn-reserva")
btnReserva.addEventListener("click", ()=>{
  
  //Comprobar si inicio de sesion
  const logged = localStorage.getItem("login")
  if(logged){
    alert("Se ha reservado " + destino[0].destInfo.nombre)
  }else{
    alert("Necesitas estar logeado para reservar")
  }

})