angular.module('AdminApp', [])
    .controller('AdminController', ['$scope', '$http', function($scope, $http) {
        $http.get('json/usuarios.json')
            .then(function(response) {
                $scope.users = response.data;
            })
            .catch(function(error) {
                console.error("Error al cargar los datos de usuario:", error);
            });

        $http.get('json/cursos.json')
            .then(function(response) {
                $scope.cursos = response.data;
            })
            .catch(function(error) {
                console.error("Error al cargar los datos de cursos:", error);
            });

        $http.get('json/actividades.json')
            .then(function(response) {
                $scope.actividades = response.data;
            })
            .catch(function(error) {
                console.error("Error al cargar los datos de actividades:", error);
            });
    }]);

