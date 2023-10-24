document.addEventListener("DOMContentLoaded", function() {
    const carruselItems = document.querySelectorAll(".item[data-nombre]");

    carruselItems.forEach(item => {
        item.addEventListener("click", (event) => {
            event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace

            const nombre = item.getAttribute("data-nombre");
            if (nombre) {
                // Llamar a la función para reservar el destino con el nombre
                reservarDestino(nombre);
            }
        });
    });
});
$(function () {
    var slides = $('.slides'),
        images = slides.find('img');

    images.each(function (i) {
        $(this).attr('data-id', i + 1);
    })

    var typed = new Typed('.typed-words', {
        strings: ["San Francisco.", " Paris.", " Nueva Zelanda.", " Maui.", " Londres."],
        typeSpeed: 80,
        backSpeed: 80,
        backDelay: 4000,
        startDelay: 1000,
        loop: true,
        showCursor: true,
        preStringTyped: (arrayPos, self) => {
            arrayPos++;
            console.log(arrayPos);
            $('.slides img').removeClass('active');
            $('.slides img[data-id="' + arrayPos + '"]').addClass('active');
        }

    });
})

function reservarDestino(nombre) {
    // Implementa la lógica para obtener el ID del destino basado en el nombre
    const id = obtenerIdPorNombre(nombre);

    if (!isNaN(id)) {
        window.location.href = `reserva.html?id=${id}`; // Cambiar aquí a "reserva.html"
    } else {
        console.log("ID de destino no es un número válido.");
    }
}


function obtenerIdPorNombre(nombre) {
    // Implementa la lógica para buscar el destino en tu JSON por el nombre y obtener su ID
    // Puedes utilizar una función o bucle para buscar el nombre en tus datos y devolver el ID.
    // Por ejemplo:
    const destinos = [
        { id: 32, nombre: "San Francisco" },
        { id: 10, nombre: "París" },
        { id: 40, nombre: "Tokio" },
        // Agrega más destinos aquí
    ];

    const destinoEncontrado = destinos.find(destino => destino.nombre === nombre);
    return destinoEncontrado ? destinoEncontrado.id : null;
}


  
  




