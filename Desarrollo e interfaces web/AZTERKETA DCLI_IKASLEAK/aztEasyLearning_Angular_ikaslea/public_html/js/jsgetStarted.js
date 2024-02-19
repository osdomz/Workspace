angular.module("GetStartedApp", []).controller("GetStartedController", [
    "$scope",
    "$http",
    function ($scope, $http) {
      $scope.nivelRealizacion = 0;
      $scope.puntos = 0;
      $scope.imgEstado = "images/candadoCerrado.png";
      $scope.mostrarVentana = false; 
      $scope.nivel = "Basic"; 
     
      var usuarioAutenticado = JSON.parse(localStorage.getItem('usuarioAutenticado'));
      var cursoUsuario = usuarioAutenticado.curso;

      $http.get("json/cursos.json")
      .then(function (response) {
        var cursos = response.data;
        // Filtrar cursos basados en el curso asociado con el usuario autenticado
        var cursoFiltrado = cursos.find(function(curso) {
          return curso.idCurso === cursoUsuario;
        });

        $http.get("json/actividades.json")
          .then(function (response) {
            var actividades = response.data;
            // Filtramos las actividades basadas en el curso asociado con el usuario autenticado
            $scope.actividades = actividades.filter(function(actividad) {
              return actividad.curso === cursoFiltrado.nombreCurso && actividad.level === cursoFiltrado.level;
            });

            // Agregamos una propiedad para controlar el estado de cada actividad
            $scope.actividades.forEach(function(actividad) {
              actividad.seleccionada = false;
            });
          })
          .catch(function (error) {
            console.error("Error al cargar los datos de actividades:", error);
          });
      })
      .catch(function (error) {
        console.error("Error al cargar los datos de cursos:", error);
      });

      $scope.realizarActividad = function (actividad) {
        if (actividad.id <= $scope.nivelRealizacion) {
         
        } else {
       
          actividad.seleccionada = true;
        
          $scope.mostrarVentana = true;
       
          $scope.actividadSeleccionada = actividad;
        }
      };

      $scope.done = function() {
      
        $scope.mostrarVentana = false;
    
        $scope.actividadSeleccionada.imgEstado = "images/candadoAbierto.png";
        $scope.imgEstado = "images/ok.png";
        $scope.puntos += parseInt($scope.actividadSeleccionada.puntos);
        $scope.nivelRealizacion++;
      
        $scope.actividadSeleccionada.seleccionada = false;
      };

    }
]);



