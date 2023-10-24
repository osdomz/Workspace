var pelis = [
    ["APOCALYPTO","pelis historica", "img/apocalypto.jpg","<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
    ["BARBARIANS RISING", "series historica", "img/barbarians_rising.jpg","<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
    ["BEETHOVEN", "pelis accion", "img/beethoven.jpg","<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
    ["DORAEMON", "series infantil", "img/doraemon.jpg","<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
    ["FROZEN", "pelis infantil", "img/frozen.jpg","<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
    ["JUEGO DE TRONOS", "series accion", "img/game_of_thrones.jpg","<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
    ["DRAGON BALL", "series infantil", "img/dragonball.jpg","<p>Maecenas vitae eros nisi. Maecenas ipsum erat, auctor sed libero vitae, pulvinar porttitor leo. Aenean mattis sem sit amet tortor tincidunt cursus. Vivamus egestas cursus ipsum, sed tristique magna fermentum in. Pellentesque ac pretium ex. Phasellus convallis ante urna, sed laoreet lacus imperdiet a. Nulla ac nibh faucibus, tincidunt turpis vel, pretium elit.</p>"],
  
  ];

  document.addEventListener("DOMContentLoaded", load, false);
  function load() {
    cargarTodo();
    document.querySelector('#accion').addEventListener("click", function() {
      cargarpPeli('accion');
    });
  
    document.querySelector('#historica').addEventListener("click", function() {
      cargarpPeli('historica');
    });
  
    document.querySelector('#elementos').addEventListener("click", function() {
      console.log(event.currentTarget.getAttribute('id'));
      console.log(event.currentTarget.getAttribute('class'));
      console.log(event.currentTarget.getAttribute('data-id'));
  
      indice = event.target.getAttribute('data-id');
      verTexto(indice);
    });
  }
  function cargarTodo(){
    for(i=0; i<pelis.length;i++){
        
    }
  }
  
