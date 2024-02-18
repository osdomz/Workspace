angular.module('AppAngularJS', [])
    .controller('MainController', function ($scope, $http) {
        $scope.title = "Mi Aplicación AngularJS";
        $scope.showTable = false; // Ocultar la tabla de detalles

        $http.get('json/data.json').then(function (response) {
            $scope.items = response.data;
        });

        $scope.addBorder = function(event) {
            event.target.style.border = '2px solid red';
        };

        $scope.removeBorder = function(event) {
            event.target.style.border = 'none';
        };

        $scope.showDetails = function (item) {
            $scope.selectedItem = item;
            $scope.showTable = true;
            var detailsWindow = window.open("", "_blank", "width=400,height=400");
            detailsWindow.document.write("<h2>Detalles</h2>");
            detailsWindow.document.write("<p>Nombre: " + item.name + "</p>");
            detailsWindow.document.write("<img src='" + item.image + "' alt='" + item.name + "' style='width: 400px; height: 200px;' />");
            detailsWindow.document.write("<p>Descripción: " + item.description + "</p>");
        };
        
        $scope.hideDetails = function () {
            $scope.showTable = false;
        };
        $scope.agregarItem = function(newItem) {
            // Agregar el nuevo item al arreglo items
            $scope.items.push({
                name: newItem.name,
                image: newItem.image,
                description: newItem.description
            });

            // Limpiar el formulario después de agregar el nuevo item
            $scope.newItem = {};
        };
    });


        

    

