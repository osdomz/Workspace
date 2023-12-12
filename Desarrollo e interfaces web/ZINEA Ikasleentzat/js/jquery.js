
// Definición del número total de asientos en cada sala de cine
var TotalButacas = [100, 150, 75, 50];

// Definición del número de asientos disponibles en cada sala de cine (inicialmente igual al total de asientos)
var ButacasLibres = [100, 150, 75, 50];

// Variable para llevar un seguimiento de la sala de cine seleccionada
var numSala = 0;

// Array de imágenes de carteles de películas
var cartelera = ["IMG/mechanic.jpg", "IMG/unmonstruo.jpg", "IMG/missperegrine.jpg", "IMG/ozzy.jpg"];

// Establecer la fuente de las imágenes de carteles de películas para cada sala de cine
$("#peli1").attr("src", cartelera[0]);
$("#peli2").attr("src", cartelera[1]);
$("#peli3").attr("src", cartelera[2]);
$("#peli4").attr("src", cartelera[3]);

// Array de títulos de películas
var pelon = ["MECHANIC", "UN MONSTUO VIENE A VERME", "EL HOGAR DE MISSPEREGRINE PARA NIÑOS PECULIARES", "OZZY"];

// Función para manejar el clic en el botón "comprar" (comprar boletos)
function comprar(cartelNum) {
    // Mostrar la sección de compra de boletos
    $("#compraentradas").css("display", "block");
    
    // Establecer el título de la película
    $("#pelon").text(pelon[cartelNum]);
    
    // Mostrar información adicional sobre la sesión seleccionada y los asientos disponibles
    $("#elementos .texto").css("display", "block");
    $("#sesBut").html("Próxima sesión a las 19:30, butacas " + TotalButacas[cartelNum] + ", butacas libres: " + ButacasLibres[cartelNum]);
    
    // Obtener el menú desplegable "tipo" (tipo de boleto)
    var ElTipo = $("#tipo");
    
    // Agregar un escuchador de eventos para manejar cambios en el tipo de boleto
    ElTipo.on("change", function() {
        var opcionSeleccionada = ElTipo.find(":selected");
        
        // Actualizar el precio del boleto según el tipo de boleto seleccionado
        if (opcionSeleccionada.attr("id") === "normal") {
            $("#precio").val($("#normal").val());
        } else if (opcionSeleccionada.attr("id") === "bono") {
            $("#precio").val($("#bono").val());
        }
    });

    // Establecer la sala de cine actualmente seleccionada
    numSala = cartelNum;
}

// Función para calcular automáticamente el precio total de los boletos
function automatico() {
    var ElTipo = $("#tipo");
    $("#total").val(ElTipo.find(":selected").val() * $("#numeroent").val());
}

// Función para verificar y actualizar los asientos disponibles después de la compra de boletos
function butacasDis() {
    var resta = $("#numeroent").val();
    var emaitza = ButacasLibres[numSala] - resta;

    // Comprobar si hay suficientes asientos disponibles
    if (ButacasLibres[numSala] < resta) {
        alert("No hay tantas entradas");
    } else {
        // Actualizar el contador de asientos disponibles y mostrar la información actualizada
        $("#sesBut").html("Próxima sesión a las 19:30, butacas " + TotalButacas[numSala] + ", butacas libres: " + emaitza);
    }
}