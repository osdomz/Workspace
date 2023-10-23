document.addEventListener("DOMContentLoaded", function () {
  const searchForm = document.querySelector(".search-form");

  // Manejar la búsqueda cuando se envía el formulario
  searchForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Evitar que el formulario se envíe

    const destinoInput = document.getElementById("destino");
    const searchTerm = destinoInput.value.toLowerCase(); // Obtener el valor de búsqueda en minúsculas

    // Cargar el archivo JSON de destinos
    fetch("./JS/destinos.json")
      .then((response) => response.json())
      .then((destinos) => {
        // Filtrar los destinos que coinciden con la búsqueda
        const destinosCoincidentes = destinos.filter(
          (destino) => destino.pais.toLowerCase() === searchTerm
        );

        // Almacenar los datos en sessionStorage
        sessionStorage.setItem("resultados", JSON.stringify(destinosCoincidentes));

        // Redirigir a la página de resultados.html
        window.location.href = "resultados.html";
      })
      .catch((error) => {
        console.error("Error al cargar el archivo JSON", error);
      });
  });
});



  












