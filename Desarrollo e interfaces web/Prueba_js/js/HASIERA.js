

const numerosGaleria = document.querySelectorAll("#fotos li a");
const galeria = document.getElementsByName("galeriafoto");
const imgContenedor = document.getElementById("imgContenedor");

let imagenActual = 0;

function cambiarImagen(index) {
  imgContenedor.src = galeria[index].getAttribute("href");
  imagenActual = index;

  numerosGaleria.forEach((numero) => {
    numero.style.color = ''; 
  });
  numerosGaleria[index].style.color = 'red';
}

for (let i = 0; i < galeria.length; i++) {
  galeria[i].addEventListener("click", function (event) {
    event.preventDefault();
    cambiarImagen(i);
  });
}

imgContenedor.addEventListener("click", function () {
  if (imagenActual < galeria.length - 1) {
    cambiarImagen(imagenActual + 1);
  } else {
    cambiarImagen(0);
  }
});

cambiarImagen(0);


