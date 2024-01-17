// Creación del módulo AngularJS llamado 'GestionCamionesApp'
var app = angular.module('GestionCamionesApp', []);

// Definición del controlador 'CamionesController' dentro del módulo
app.controller('CamionesController', function($scope) {
    
    // Datos iniciales de camiones
    $scope.camiones = [
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

    // Objeto para almacenar datos del nuevo camión (enlazado bidireccionalmente con el formulario)
    $scope.nuevoCamion = {
        modelo: "",
        marca: "",
        ano: "",
        imagen: ""
    };

    // Función para agregar un nuevo camión
    $scope.agregarCamion = function() {
        // Asigna un nuevo ID al camión
        $scope.nuevoCamion.id = $scope.camiones.length + 1;
        // Agrega el nuevo camión al array 'camiones'
        $scope.camiones.push(angular.copy($scope.nuevoCamion));
        // Reinicia el objeto 'nuevoCamion' para el próximo ingreso
        $scope.nuevoCamion = {
            modelo: "",
            marca: "",
            ano: "",
            imagen: ""
        };
    };

    // Función para mostrar detalles del camión (puede ser personalizada según tus necesidades)
    $scope.mostrarDetalles = function(camion) {
        // Ejemplo: Muestra un mensaje de alerta con los detalles del camión
        alert("Detalles del Camión:\nModelo: " + camion.modelo + "\nMarca: " + camion.marca + "\nAño: " + camion.ano);
    };
});
