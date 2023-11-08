//Platos
fetch("./JSON/datosPlatos.json")
.then(response => {
    if (!response.ok) {
      throw new Error("Hubo un error en la solicitud.");
    }
    return response.json();
  })
  .then(data => {
    // Almacenar los datos en el localStorage
    localStorage.setItem('menu', JSON.stringify(data.menu));
  })
  .catch(error => {
    console.error("Hubo un error al cargar los datos del menú:", error);
  });




