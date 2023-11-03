tarjetas=[["AMERICA","Machu Picchu Peru","IRUDIAK/machu picchu.jpg","10","2100" ],["ASIA","Vietnam","IRUDIAK/vietnam.jpg","1","2800"],["AFRICA","Cataratas Victoria","IRUDIAK/africa victoria.jpg","11","3000"],["EUROPA","Croacia","IRUDIAK/croacia.jpg","8","1200"],["OCEANIA","Australia","IRUDIAK/australia.jpg","2","3200"],["ASIA","Taj Mahal","IRUDIAK/tajmahal.jpg","4","2500"],["AFRICA","Piramides de Egipto","IRUDIAK/egipto.jpg","7","2100"],["EUROPA","Roma","IRUDIAK/roma.jpg","6","1000"],["AMERICA","Amazonas","IRUDIAK/ecuadoramazonia.jpg","0","2300"],["OCEANIA","Nueva Zelanda","IRUDIAK/new_zealand.jpg","11","3400"]]
texto="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac bibendum purus. Cras gravida, nisl at egestas pharetra, sapien sapien varius tellus, imperdiet laoreet urna ante ac elit. Nullam ac libero non ante luctus egestas id a erat. Fusce id diam in ante blandit porttitor et sit amet dolor"


const seccion = document.getElementById('seccion');

function abrirPopup(viajeIndex) {
    const viajeSeleccionado = tarjetas[viajeIndex];

    const popupWindow = window.open('BIDAIAK_AZTERK_2.html', '_blank', 'width=600,height=400');

    popupWindow.addEventListener('load', function () {
        popupWindow.mostrarDetalles(viajeSeleccionado);
    });
}

tarjetas.forEach((tarjetaData, index) => {
    const [continente, titulo, imagenSrc, cantidad, precio] = tarjetaData;

    const card = document.createElement('div');
    card.classList.add('card');

    const contenido = `
        <div class="irudia">
            <h3>${titulo}</h3>
            <img src="${imagenSrc}" onclick="abrirPopup(${index})">
        </div>
        <div class="texto">
            <p>${texto}</p>
        </div>
    `;

    card.innerHTML = contenido;

    seccion.appendChild(card);
});

const openPopupButton = document.getElementById('openPopupButton');
const bookTravelButton = document.getElementById('bookTravelButton');

openPopupButton.addEventListener('click', function () {
    window.open('BIDAIAK_AZTERK_2.html', '_blank', 'width=600,height=400');
});

bookTravelButton.addEventListener('click', function () {
    window.open('BIDAIAK_AZTERK_2.html', '_blank', 'width=600,height=400');
});



