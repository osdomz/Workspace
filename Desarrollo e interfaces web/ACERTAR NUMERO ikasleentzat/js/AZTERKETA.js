function generarNumeroAleatorio() {
  return Math.round(Math.random() * 50);
}
contador = 0;

document.getElementById("generar").addEventListener("click", function () {
  numAleatorio = generarNumeroAleatorio();
  alert("Número generado: " + numAleatorio);
  document.getElementById("divjuego").style.display = "block";
  document.getElementById("divimagen").style.display = "block";
});

document.getElementById("comprobar").addEventListener("click", function () {
  numeroIngresado = document.getElementById("mi_numero").value;

  if (isNaN(numeroIngresado)) {
    alert("Por favor, ingresa un número válido.");
  } else {
    if (numeroIngresado == numAleatorio) {
      document.getElementById("texto").innerHTML =
        "¡Felicidades! Has acertado.";
      document.getElementById("imagen").src = "images/ok.png";
    } else {
      document.getElementById("texto").innerText =
        "Lo siento, intenta de nuevo.";
      document.getElementById("imagen").src = "images/error.png";
      contador++;
    }
    if (contador == 1) {
      document.getElementById("celda0").style.backgroundColor = "red";
    } else if (contador == 2) {
      document.getElementById("celda1").style.backgroundColor = "red";
    } else if (contador == 3) {
      document.getElementById("celda2").style.backgroundColor = "red";
    } else if (contador == 4) {
      document.getElementById("celda3").style.backgroundColor = "red";
    } else if (contador == 5) {
      document.getElementById("celda4").style.backgroundColor = "red";
    }
  }
});
