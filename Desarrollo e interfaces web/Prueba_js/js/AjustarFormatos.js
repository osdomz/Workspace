var radios = document.querySelectorAll("input[type='radio']");
var contenidosDiv = document.getElementById("content");
var bgColor;
var fSize;
var radioValue = null;

for (var i = 0; i < radios.length; i++) {
    radios[i].addEventListener("click", function () {
        if (this.checked) {
            radioValue = this.value;
            console.log(radioValue);
        }
    });
}

contenidosDiv.addEventListener("mouseover", function (event) {
    switch (radioValue) {
        case "miColor":
            if (event.target.classList.contains("box")) { //classlist.contains devuelve true si el elemento tiene la clase
                var idDelDiv = event.target.id; //obtengo el id del div
                var div = document.getElementById(idDelDiv); //obtengo el div
                bgColor = window.getComputedStyle(div).backgroundColor // obtengo el color de fondo del div y lo guardo en la variable bgColor
                div.style.backgroundColor = "red";
            }
            contenidosDiv.addEventListener("mouseout", function (event) {
                if (event.target.classList.contains("box")) {
                    var idDelDiv = event.target.id;
                    var div = document.getElementById(idDelDiv);
                    if (bgColor != null) {
                        div.style.backgroundColor = bgColor;
                        bgColor = null;
                    }
                }
            });
            break;
 
        case "miTamano":
            if (event.target.classList.contains("box")) {
                var idDelDiv = event.target.id;
                var div = document.getElementById(idDelDiv);
                fSize = window.getComputedStyle(div).fontSize;
                div.style.fontSize = "40px";
            }
            contenidosDiv.addEventListener("mouseout", function (event) {
                if (event.target.classList.contains("box")) {
                    var idDelDiv = event.target.id;
                    var div = document.getElementById(idDelDiv);
                    div.style.fontSize = fSize;
                }
            });
            break;
    }
});