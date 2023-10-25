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
    cargarPeli('infantiles');
  });

  document.querySelector('.container').addEventListener("click", function (event) {
    console.log(event.currentTarget.getAttribute('id'))
    console.log(event.currentTarget.getAttribute('class'))
    console.log(event.currentTarget.getAttribute('data-id'))

    indice = event.target.getAttribute('data-id')
    verTexto(indice);
  })
  for (i = 0; i < pelis.length; i++) {
    document.querySelector('img')[i].addEventListener("click", function (event) {
      alert('betiko era')
    })
  }
}
function cargarTodo() {

  var carteles = "";
  console.log(pelis.length);

  for (var i = 0; i < pelis.length; i++) {
    var cartel = `<figure><a><img class="${pelis[i][1]}" src="${pelis[i][2]}" data-id="${i}" alt="" /></a>
        <div class="texto">
          <h3>${pelis[i][0]}</h3>
          <p>${pelis[i][3]}</p>
        </div>
      </figure>`;


    carteles += cartel;
  }

  document.querySelector('.container').innerHTML = carteles;
}
function cargarPeli(tipo) {
  var textos = document.querySelectorAll('.texto');

  textos.forEach((texto) => {
    texto.style.display = "none";
  });

  var peliculasPorGenero = document.querySelectorAll(`.container img.${tipo}`);

  peliculasPorGenero.forEach((pelicula) => {
    pelicula.parentElement.nextElementSibling.style.display = "block";
  });
}

for (var i = 0; i < pelis.length; i++) {
  document.querySelectorAll('.container img')[i].addEventListener("click", function (event) {
    alert('betiko era');
  });
}

function verTexto(i) {

  var tipo = pelis[i][1];
  var titulo = pelis[i][0];

  console.log(tipo);
  console.log(titulo);

  document.querySelector('.texto').forEach((element, index) => {
    console.log(index);
    tit = document - querySelectorAll('h3')[index].innerHTML.trim();
    console.log(tit)
    if (titulo === tit) {
      document.querySelectorAll('.texto')[index].computedStyleMap.display = "flex"
    } else {
      document.querySelectorAll('.texto')[index].computedStyleMap.display = "none"
    }
    
  });
}




