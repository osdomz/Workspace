document.addEventListener("DOMContentLoaded", function () {
    // Obtener los datos almacenados en localStorage
    var datosGuardados = localStorage.getItem("datosFormulario");
  
    if (datosGuardados) {
      // Convertir los datos de cadena JSON a un objeto
      var datos = JSON.parse(datosGuardados);
  
      // Mostrar los datos en la tabla en la página
      document.getElementById("emailTable").textContent = datos.correo || "No disponible";
      document.getElementById("firstnameTable").textContent = datos.nombre || "No disponible";
      document.getElementById("lastnameTable").textContent = datos.apellido || "No disponible";
      document.getElementById("dateTable").textContent = datos.fechaNacimiento || "No disponible";
      document.getElementById("subjectTable").textContent = datos.cursoElegido || "No disponible";
    }
  });