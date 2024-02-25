function loadSliders() {
  fetch("./CONTENTS/tools/sliders.html")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error al cargar sliders.html");
      }
      return response.text();
    })
    .then((data) => {
      const slidersContainer = document.getElementById("sliders-container");
      if (slidersContainer) {
        slidersContainer.innerHTML = data;
        // Una vez que se cargan los sliders, generamos los JSON y los sliders
        generarJSON();
      } else {
        console.error("No se encontró el contenedor de sliders.");
      }
    })
    .catch((error) => console.error(error));
}

function generarSlider(rutasImagenes, idSlider) {
  const slider = document.getElementById(idSlider);
  if (!slider) {
    console.error(`No se encontró el slider con el ID ${idSlider}`);
    return;
  }

  const sliderInner = slider.querySelector(".carousel-inner");
  if (!sliderInner) {
    console.error(
      `No se encontró el contenedor de imágenes para el slider con el ID ${idSlider}`
    );
    return;
  }

  sliderInner.innerHTML = ""; // Limpiar el contenido existente del slider

  rutasImagenes.forEach((ruta, index) => {
    const slide = document.createElement("div");
    slide.classList.add("carousel-item");
    if (index === 0) {
      slide.classList.add("active");
    }

    const imagen = document.createElement("img");
    imagen.src = ruta;
    slide.appendChild(imagen);

    sliderInner.appendChild(slide);
  });
}

function generarJSON() {
  const carpetas = [
    { nombre: "men", idSlider: "sliderMen" },
    { nombre: "woman", idSlider: "sliderWoman" },
  ];

  carpetas.forEach(({ nombre, idSlider }) => {
    const rutaCarpeta = `./CONTENTS/images/${nombre}/modelos/`;
    fetch(rutaCarpeta)
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Error al obtener archivos de ${rutaCarpeta}`);
        }
        return response.text();
      })
      .then((data) => {
        const nombresImagenes = extraerNombresArchivos(data);
        console.log(`JSON generado para ${nombre}:`, nombresImagenes);
        // Generamos el slider después de obtener el JSON
        generarSlider(nombresImagenes, idSlider); // Aquí llamamos a generarSlider con las rutas de las imágenes y el ID del slider correspondiente
      })
      .catch((error) => console.error(error));
  });
}
function extraerNombresArchivos(html) {
  const parser = new DOMParser();
  const doc = parser.parseFromString(html, "text/html");
  const enlaces = doc.querySelectorAll("a");
  const nombres = [];
  enlaces.forEach((enlace) => {
    const nombre = enlace.getAttribute("href");
    if (nombre && !nombre.endsWith("/") && nombre.endsWith(".preview")) {
      // Elimina la extensión .preview del nombre de archivo
      const nombreSinExtension = nombre.slice(0, -8); // Elimina los últimos 8 caracteres (".preview")
      nombres.push(nombreSinExtension);
    }
  });
  return nombres;
}


// Llamamos a loadSliders para comenzar el proceso
loadSliders();
