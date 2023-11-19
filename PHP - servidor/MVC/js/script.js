function obtenerDatos() {
    // Realizar una petición al modelo para obtener los datos
    fetch("obtenerDatos.php")
        .then(response => response.json())
        .then(data => mostrarDatos(data))
        .catch(error => console.error(error));
}

function mostrarDatos(datos) {
    // Mostrar los datos en la vista
    var datosDiv = document.getElementById("datos");
    datosDiv.innerHTML = "";
    datos.forEach(dato => {
        var p = document.createElement("p");
        p.textContent = "ID: " + dato.id + ", Nombre: " + dato.nombre;
        datosDiv.appendChild(p);
    });
}





