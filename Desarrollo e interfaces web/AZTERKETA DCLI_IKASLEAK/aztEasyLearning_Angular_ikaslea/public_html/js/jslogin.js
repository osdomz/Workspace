angular.module('LoginApp', [])
.controller('LoginController', ['$scope', '$http', '$window', function($scope, $http, $window) {
  $scope.submitForm = function() {
    var email = $scope.email;
    var password = $scope.password;
    
    $http.get('json/usuarios.json')
      .then(function(response) {
        var users = response.data;
        // verificamos si el correo y la contraseña coinciden con un usuario del json
        var user = users.find(function(user) {
          return user.userName === email && user.password === password;
        });
        if (user) {
          if (user.userType === 'user') {
            // Guardar el usuario autenticado en LocalStorage
            localStorage.setItem('usuarioAutenticado', JSON.stringify(user));
            // Redirigir al usuario a la página de inicio
            $window.location.href = 'GetStarted.html';
          } else if (user.userType === 'admin') {
            //si es usuario admin
            $window.location.href = 'administration.html';
          } else {
            alert("Tipo de usuario desconocido.");
          }
        } else {
          alert("Correo electrónico o contraseña inválidos. Por favor, inténtalo de nuevo.");
        }
      })
      .catch(function(error) {
        console.error("Error al cargar los datos de usuario:", error);
      });
  };
}]);


