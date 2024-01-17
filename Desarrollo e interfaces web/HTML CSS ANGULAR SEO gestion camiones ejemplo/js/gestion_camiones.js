$(document).ready(function () {  //*Esta línea asegura que el código dentro de la función se ejecutará una vez que el documento HTML esté completamente cargado. Es una forma de garantizar que los elementos del DOM estén disponibles antes de intentar interactuar con ellos.
    var trucks = [  //*....Datos de camiones..... Aquí define un array llamado trucks que contiene objetos representados
        {
            "id": 1,
            "modelo": "Camión A",
            "marca": "Marca X",
            "ano": 2020,
            "imagen": "img/camion1.jpeg"
        },
        {
            "id": 2,
            "modelo": "Camión B",
            "marca": "Marca Y",
            "ano": 2022,
            "imagen": "img/camion2.jpeg"
        },
        {
            "id": 3,
            "modelo": "Camión D",
            "marca": "Marca Z",
            "ano": 2019,
            "imagen": "img/camion3.jpeg"
        }
    ];

    displayTrucks(trucks);  //*se llama a la función displayTrucks pasándole el array trucks para mostrar los camiones iniciales en la página

    function displayTrucks(truckArray) {   //*Código para mostrar camiones en el DOM.  Esta función toma un array de camiones como parámetro y se encarga de mostrar
        var truckList = $("#truck-list");
        truckList.empty();

        $.each(truckArray, function (index, truck) {  //* se utiliza $.each para iterar sobre cada elemento del array TruckArray
            var truckCard = createTruckCard(truck);   //* Creación de Tarjetas de camiones. Para cada camión, se llama a la función createTruckCard para generar una tarjeta de camión
            truckList.append(truckCard);
        });
    }

    function createTruckCard(truck) {   //*Código para crear una tarjeta de camión y adjuntar eventos.  Crea dinámicamente una tarjeta de camión y agrega eventos, como el clic para mostrar detalles del camión
        var truckCard = $("<div class='truck-card'>");  //*se crea un elemento div con la clase truck-card y se asigna a la variable truckCard
        var truckImage = $("<img>").attr("src", truck.imagen).attr("alt", truck.modelo);  //*Se crea un elemento img, con la URL de la imagen del camión y el atributu alt con el modelo del camión
        var truckHeader = $("<h3>").text(truck.modelo);  //*Se crea un elemento h3 y se le asigna el texto del modelo del camión 

        truckCard.append(truckImage, truckHeader, createTruckInfo("Marca", truck.marca), createTruckInfo("Año", truck.ano)); //*Se añaden los elementos creados (imagen,encabezado y detalles de marca y año) a la tarjeta del camión

        // Agregamos un evento click para mostrar información adicional si se hace clic en la tarjeta
        truckCard.click(function () {  //*Mostar detalles del camión al hacer clic
            showTruckDetails(truck);
        });

        return truckCard;  //*La función createTruckCard devuelve la tarjeta del camión creada
    }

    function createTruckInfo(label, value) {  //*Se define la función createTruckInfo que crea un elemento de informaciónn del camión (ejemplo, Marca y Año)
        return $("<p>").addClass("truck-info").text(label + ": " + value);  //* La función devuelve un elemento p con la clase truck-info y el texto concatenado de la etiqueta y el valor
    }

    function showTruckDetails(truck) {    //*Se define la función showTruckDetails para mostrar detalles del camión
        alert("Detalles del Camión:\nModelo: " + truck.modelo + "\nMarca: " + truck.marca + "\nAño: " + truck.ano);   
    }

    $("#truck-form").submit(function (event) {   //*Agregando un Nuevo Camión.  Para manejar la presentación del formulario y agregar un nuevo camión. Agrega un evento de envío al formulario para evitar la recarga de la página y agrega un nuevo camión al carray de camiones.
        event.preventDefault();

        var newTruck = {   //*Se crea un newTruck con los valores del formulario
            "id": trucks.length + 1,
            "modelo": $("#modelo").val(),
            "marca": $("#marca").val(),
            "ano": $("#ano").val(),
            "imagen": $("#imagen").val()
        };

        trucks.push(newTruck);   //*Se agrega el nuevo camión al array trucks, se vuelve a mostrar
        displayTrucks(trucks);
        $("#modelo, #marca, #ano, #imagen").val("");
    });

    $("#add-truck-form").hover(   //*Animación del Formulario de Agregar Camiones.  Agrega un efecto de cambio en el margen superior del formulario de agregar camiones cuando el ratón ingresa o sale del área.
        function () {
            $(this).css("margin-top", "0");
        },
        function () {
            $(this).css("margin-top", "20px");
        }
    );
});       //*Cierre del JQuery.  En resumen, JQuery es una herramienta que agiliza el desarrollo de aplicaciones web al proporcionar una interfaz.
