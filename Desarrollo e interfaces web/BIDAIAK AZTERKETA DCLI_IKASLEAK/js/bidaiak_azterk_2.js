tarjetas=[["AMERICA","Machu Picchu Peru","IRUDIAK/machu picchu.jpg","10","2100" ],["ASIA","Vietnam","IRUDIAK/vietnam.jpg","1","2800"],["AFRICA","Cataratas Victoria","IRUDIAK/africa victoria.jpg","11","3000"],["EUROPA","Croacia","IRUDIAK/croacia.jpg","8","1200"],["OCEANIA","Australia","IRUDIAK/australia.jpg","2","3200"],["ASIA","Taj Mahal","IRUDIAK/tajmahal.jpg","4","2500"],["AFRICA","Piramides de Egipto","IRUDIAK/egipto.jpg","7","2100"],["EUROPA","Roma","IRUDIAK/roma.jpg","6","1000"],["AMERICA","Amazonas","IRUDIAK/ecuadoramazonia.jpg","0","2300"],["OCEANIA","Nueva Zelanda","IRUDIAK/new_zealand.jpg","11","3400"]];
texto="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac bibendum purus. Cras gravida, nisl at egestas pharetra, sapien sapien varius tellus, imperdiet laoreet urna ante ac elit. Nullam ac libero non ante luctus egestas id a erat. Fusce id diam in ante blandit porttitor et sit amet dolor"

document.addEventListener("DOMContentLoaded", function() {
    const selectContinent = document.getElementById('selectContinent');
    const selectTravel = document.getElementById('selectTravel');
    const divSeccion = document.getElementById('divSeccion');
    const dateDeparture = document.getElementById('dateDeparture');
    const temporadaLabel = document.getElementById('temporada');
    const btnSubmit = document.getElementsByName("submit")[0];
    const divReserva = document.getElementsByName("formulario2")[0]; 

    const temporadaAltaMeses = [6, 7, 11];
    const temporadaBajaMeses = [1, 9, 10];

    btnSubmit.addEventListener("click", function() {
        divReserva.style.display = "block";
        temporadaLabel.style.display = "block";
    });

function actualizarTemporadaYFecha(mes) {
    const meses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    const nombreMes = meses[mes];
    dateDeparture.value = nombreMes;
}

function updateSeasonLabel(mes) {

    if (temporadaAltaMeses.includes(mes)) {
        temporadaLabel.textContent = "High season";
        temporadaLabel.style.color = "yellow";
        temporadaLabel.style.backgroundColor = "yellow";
        temporadaLabel.style.display = "block";
    } else if (temporadaBajaMeses.includes(mes)) {
        temporadaLabel.textContent = "Low season";
        temporadaLabel.style.color = "green";
        temporadaLabel.style.backgroundColor = "green";
        temporadaLabel.style.display = "block";
    } else {
        temporadaLabel.textContent = "";
        temporadaLabel.style.color = "";
        temporadaLabel.style.backgroundColor = "";
    }
}

function generateTravelDetailsHTML(tarjetaSeleccionada) {
    return `
        <div class="irudia">
            <h3>${tarjetaSeleccionada[1]}</h3>
            <img src="${tarjetaSeleccionada[2]}">
        </div>
        <div class="texto">
            <p>${texto}</p>
        </div>
    `;
}

function populateTravelOptions(seleccion) {
    selectTravel.innerHTML = '';
    tarjetas.forEach(function (viaje) {
        if (viaje[0] === seleccion) {
            const opcion = document.createElement('option');
            opcion.value = viaje[1];
            opcion.textContent = viaje[1];
            selectTravel.appendChild(opcion);
        }
    });
}

function handleContinentChange() {
    const seleccion = selectContinent.value;
    selectTravel.innerHTML = '';
    divSeccion.textContent = '';
    const tarjetaSeleccionada = tarjetas.find(viaje => viaje[0] === seleccion);
    if (tarjetaSeleccionada) {
        const mes = parseInt(tarjetaSeleccionada[3], 10);
        actualizarTemporadaYFecha(mes);
    }
    populateTravelOptions(seleccion);
}

function handleTravelChange() {
    const seleccion = selectTravel.value;
    const tarjetaSeleccionada = tarjetas.find(viaje => viaje[1] === seleccion);
    if (tarjetaSeleccionada) {
        const mes = parseInt(tarjetaSeleccionada[3], 10);
        actualizarTemporadaYFecha(mes);
        updateSeasonLabel(mes);
        const detallesViaje = generateTravelDetailsHTML(tarjetaSeleccionada);
        divSeccion.innerHTML = detallesViaje;
    }
}

selectContinent.addEventListener('change', handleContinentChange);
selectTravel.addEventListener('change', handleTravelChange);

window.addEventListener('load', function () {
    const mesActual = new Date().getMonth();
    actualizarTemporadaYFecha(mesActual);
    
});
document.addEventListener("DOMContentLoaded", function() {
    const formulario1 = document.forms.formulario1;
    const formulario2 = document.forms.formulario2;

    document.getElementById("btnSubmit").addEventListener("click", function() {
       
        calcularYCopiarValores(formulario1, formulario2);
    });
});

function calcularPrecio(categoria, temporada) {
    let precioBase = 0;

    if (temporadaAltaMeses.includes(temporada)) {
        precioBase = 3000;
    } else {
        precioBase = 2000;
    }

    if (categoria === "adulto") {
        return precioBase;
    } else if (categoria === "joven") {
        return precioBase - (precioBase * 30 / 100); 
    } else if (categoria === "niño") {
        return 0;
    } else {
        return 0;
    }
}

});





  
  







