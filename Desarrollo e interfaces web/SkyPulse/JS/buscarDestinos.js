// Importar destinos
import {destinos} from "./localStorage/descarga.js";

// Obtener parámetro desde la URL
function obtenerParametro() {
    const urlParam = new URLSearchParams(window.location.search);
    return urlParam.get("pais") || urlParam.get("categoria") || urlParam.get("id");
}

// Filtrar destinos por país, categoría o ID
function buscarDestino() {
    const destinosFiltrados = [];
    const parametro = obtenerParametro();

    if (isNaN(parametro)) {
        
        // Buscar por categoria o pais
        destinos.forEach(pais => {
            const destinosEnPais = pais.ciudades;
            destinosEnPais.forEach(destino => {
                if (destino.categoria === parametro || pais.pais === parametro) {
                    destinosFiltrados.push(destino);
                }
            });
        });
    } else {
        // Buscar por ID
        destinos.forEach(pais => {
            const destinosEnPais = pais.ciudades;
            const destinoPorID = destinosEnPais.find(destino => destino.id === parseInt(parametro));
            if (destinoPorID) {
                destinosFiltrados.push(destinoPorID);
            }
        });
    }

    return destinosFiltrados;
}

export { buscarDestino, obtenerParametro };
