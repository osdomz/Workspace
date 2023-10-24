// Obtener valor destino formulario y pasarlo como paramtetro en la URL
const btnBuscar = document.querySelector(".form-buscar")

btnBuscar.addEventListener("click", e => {
    e.preventDefault()
    const searchForm = document.getElementById("buscadorDestinos");

    if(searchForm.value === ""){        
        const warningMessage = document.querySelector(".warning-message")
        warningMessage.classList.replace("d-none", "d-block")
    }else{
        window.location.href = `destinos.html?pais=${encodeURIComponent(searchForm.value)}`;

    }

});


