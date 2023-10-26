var pelis = [
  ["APOCALYPTO", "pelis historica", "img/apocalypto.jpg", "<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
  ["BARBARIANS RISING", "series historica", "img/barbarians_rising.jpg", "<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
  ["BEETHOVEN", "pelis accion", "img/beethoven.jpg", "<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
  ["DORAEMON", "series infantil", "img/doraemon.jpg", "<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
  ["FROZEN", "pelis infantil", "img/frozen.jpg", "<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
  ["JUEGO DE TRONOS", "series accion", "img/game_of_thrones.jpg", "<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
  ["DRAGON BALL", "series infantil", "img/dragonball.jpg", "<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],

];

document.addEventListener("DOMContentLoaded", load, false);
function load() {
  cargarTodo();
  document.querySelector('.accion').addEventListener("click", function (event) {
    event.preventDefault();
    cargarPeli('accion');
  });

  document.querySelector('.historicas').addEventListener("click", function (event) {
    event.preventDefault();
    cargarPeli('historica');
  });

  document.querySelector('.infantiles').addEventListener("click", function (event) {
    event.preventDefault();
    cargarPeli('infantil');
  });

  document.querySelector('.container').addEventListener("click", function (event) {
    console.log(event.currentTarget.getAttribute('id'))
    console.log(event.currentTarget.getAttribute('class'))
    console.log(event.currentTarget.getAttribute('data-id'))

    indice = event.target.getAttribute('data-id')
    verTexto(indice);

  })
  //for (i = 0; i < pelis.length; i++) {
  //  document.querySelector('img')[i].addEventListener("click", function (event) {
  //    alert('betiko era')
  //  })
  //}
  document.querySelectorAll('img').forEach(el => {
    el.addEventListener("click", function (event) {
      alert('betiko era')
    })
  })

}
function cargarTodo() {

  var carteles = "";
  console.log(pelis.length);

  for (var i = 0; i < pelis.length; i++) {
    var cartel = `<figure data-id="${i}"><img class="${pelis[i][1]}" src="${pelis[i][2]}" alt="" />
        <div class="texto">
          <h3>${pelis[i][0]}</h3>
          <p>${pelis[i][3]}</p>
        </div>
      </figure>`;


    carteles += cartel;
  }

  document.querySelector('.container').innerHTML = carteles;
}
// <!----------------------------- --------------------------------------------------------------------------------------------->
function cargarPeli(tipo) {

  var figuras = document.querySelectorAll('figure');
  console.log(figuras)
  figuras.forEach((figure) => {
    figure.style.display = "none";
  });

  var peliculasPorTipo = document.querySelectorAll(`.container img.${tipo}`);
  console.log(peliculasPorTipo)
  peliculasPorTipo.forEach((pelicula) => {
    pelicula.parentElement.style.display = "block"; // Muestra la figura que contiene la imagen

  });

  figuras.forEach((figure) => {
    figure.addEventListener("mouseenter", (e) => {
      // Cuando el puntero entra en la figura
      verTexto(figure.getAttribute("data-id"));
    });

    figure.addEventListener("mouseleave", (e) => {
      // Cuando el puntero sale de la figura
      ocultarTexto();
    });
  });

  function ocultarTexto() {
    var textos = document.querySelectorAll('.texto');
    textos.forEach((texto) => {
      texto.style.display = "none";
    });
  }

}

let peliculas = document.querySelectorAll('.container img')

peliculas.forEach(pelicula => {
  pelicula.addEventListener("click", e => {
    console.log(pelicula)
  })
})



// <!----------------------------- --------------------------------------------------------------------------------------------->



function verTexto(i) {
  console.log(i)
  var tipo = pelis[i][1];
  var titulo = pelis[i][0];

  console.log(tipo);
  console.log(titulo);

  var figu = document.querySelector("[data-id='" + i + "']")
  figu.querySelector('.texto').style.display = "flex"

  //figu.querySelector('.texto').forEach((element, index) => {

  /*
    console.log(index);
    tit = figu.querySelectorAll('h3').innerHTML.trim();
    console.log(tit)
    if (titulo === tit) {
      figu.querySelector('.texto').computedStyleMap.display = "flex"
    } else {
      figu.querySelector('.texto').computedStyleMap.display = "none"
    }
    
    */
  //});


}




