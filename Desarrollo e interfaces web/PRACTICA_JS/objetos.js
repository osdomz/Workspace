const personaArreglo = ['Carlos', 27, 'carlos@correo.com', true, true];

const persona = {
    nombre: 'Carlos',
    edad: 27, //variables dentro de un objeto son propiedades y su valor
    correo: 'carlos@correo.com',
    suscripciones: { //categorias 
        web: true,
        correo: true
    },
    coloresFav: ['Negro', 'Rojo'],
    saludo: function(){ //funciones / metodos
        alert('Hola');
    }
}
//console.log(persona.nombre); //accede a variables
//console.log(persona['edad']); //accede a valores

const variable = 'suscripciones';
//console.log(persona[variable]);
//console.log(persona.suscripciones.correo);

persona.pais = 'Colombia';
console.log(persona);
persona.saludo();