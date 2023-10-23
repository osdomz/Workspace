
document.addEventListener("DOMContentLoaded", function() {
    var nombreInput = document.getElementById("nombre");
    var edadInput = document.getElementById("edad");
    var estudiosSelect = document.getElementById("estudios");
    var aceptoCheckbox = document.getElementById("acepto");
    var form = document.forms["pago"];

    nombreInput.addEventListener("blur", function() {
        var nombre = nombreInput.value;
        if (nombre.length < 2) {
            alert("El nombre debe contener al menos dos caracteres.");
        }
    });

    edadInput.addEventListener("blur", function() {
        var edad = edadInput.value;
        if (isNaN(edad) || edad < 10 || edad > 100) {
            alert("La edad debe ser un número entre 10 y 100.");
        }
    });

    estudiosSelect.addEventListener("change", function() {
        var estudios = estudiosSelect.value;
        if (estudios === "") {
            alert("Debes seleccionar un elemento en el combo de estudios.");
        }
    });

    aceptoCheckbox.addEventListener("change", function() {
        if (!aceptoCheckbox.checked) {
            alert("Debes aceptar las condiciones.");
        }
    });

    form.addEventListener("submit", function() {
        alert("Formulario enviado");
    });
});

