// Definición del número total de asientos en cada sala de cine
var TotalButacas = [100, 150, 75, 50];

// Definición del número de asientos disponibles en cada sala de cine (inicialmente igual al total de asientos)
var ButacasLibres = [100, 150, 75, 50];

// Variable para llevar un seguimiento de la sala de cine seleccionada
numSala = 0;

// Array de imágenes de carteles de películas
var cartelera = ["IMG/mechanic.jpg", "IMG/unmonstruo.jpg", "IMG/missperegrine.jpg", "IMG/ozzy.jpg"];

// Establecer la fuente de las imágenes de carteles de películas para cada sala de cine
document.getElementById("peli1").src = cartelera[0];
document.getElementById("peli2").src = cartelera[1];
document.getElementById("peli3").src = cartelera[2];
document.getElementById("peli4").src = cartelera[3];

// Array de títulos de películas
var pelon = ["MECHANIC", "UN MONSTUO VIENE A VERME", "EL HOGAR DE MISSPEREGRINE PARA NIÑOS PECULIARES", "OZZY"];

// Función para manejar el clic en el botón "comprar" (comprar boletos)
function comprar(cartelNum) {
    // Mostrar la sección de compra de boletos
    document.getElementById("compraentradas").style.display = "block";
    
    // Establecer el título de la película
    document.getElementById("pelon").textContent = pelon[cartelNum];
    
    // Mostrar información adicional sobre la sesión seleccionada y los asientos disponibles
    document.querySelector("#elementos .texto").style.display = "block";
    document.getElementById("sesBut").innerHTML = "Próxima sesión a las 19:30, butacas " + TotalButacas[cartelNum] + ", butacas libres: " + ButacasLibres[cartelNum];
    
    // Obtener el menú desplegable "tipo" (tipo de boleto)
    var ElTipo = document.getElementById("tipo");
    
    // Agregar un escuchador de eventos para manejar cambios en el tipo de boleto
    ElTipo.addEventListener("change", function() {
        var opcionSeleccionada = ElTipo.options[ElTipo.selectedIndex];
        
        // Actualizar el precio del boleto según el tipo de boleto seleccionado
        if (opcionSeleccionada.id === "normal") {
            document.getElementById("precio").value = document.getElementById("normal").value;
        } else if (opcionSeleccionada.id === "bono") {
            document.getElementById("precio").value = document.getElementById("bono").value;
        }
    });

    // Establecer la sala de cine actualmente seleccionada
    numSala = cartelNum;
}

// Función para calcular automáticamente el precio total de los boletos
function automatico() {
    var ElTipo = document.getElementById("tipo");
    document.getElementById("total").value = ElTipo.options[ElTipo.selectedIndex].value * document.getElementById("numeroent").value;
}

// Función para verificar y actualizar los asientos disponibles después de la compra de boletos
function butacasDis() {
    var resta = document.getElementById("numeroent").value;
    var emaitza = (ButacasLibres[numSala] - resta);

    // Comprobar si hay suficientes asientos disponibles
    if (ButacasLibres[numSala] < resta) {
        alert("No hay tantas entradas");
    } else {
        // Actualizar el contador de asientos disponibles y mostrar la información actualizada
        document.getElementById("sesBut").innerHTML = "Próxima sesión a las 19:30, butacas " + TotalButacas[numSala] + ", butacas libres: " + emaitza;
    }
}







