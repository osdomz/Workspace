

const opciones = document.querySelectorAll('input[name="opciones"]');
const fila = document.querySelector(".cfila");
const celdas = fila.querySelectorAll(".celda");

function color(celda) {
  celda.addEventListener("mouseover", function () {
    celda.style.backgroundColor = "red";
  });
  celda.addEventListener("mouseout", function () {
    celda.style.backgroundColor = "";
  });
  celda.addEventListener("mouseover", function () {
    celda.style.fontSize = "14px";
  });
}

function tamano(celda) {
  celda.addEventListener("mouseover", function () {
    celda.style.fontSize = "20px";
  });
 
  celda.addEventListener("mouseover", function () {
    celda.style.backgroundColor = "";
    });
}

function clear() {
  celdas.forEach(function (celda) {
    celda.style.backgroundColor = "";
    celda.style.fontSize = "";
  });
}

opciones.forEach(function (radio) {
  radio.addEventListener("change", function () {
    clear(); 
    if (radio.value === "miColor") {
      celdas.forEach(function (celda) {
        color(celda);
      });
    } else if (radio.value === "miTamano") {
      celdas.forEach(function (celda) {
        tamano(celda);
      });
    }
  });
});
