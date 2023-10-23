//Strings

const nombre = 'Christian';
const nombre2 = 'Francisco';

//Numeros

const numero = 4;
const numero2 = 5.4;

//Boolean

const usuarioConectado = false;
const mayorQue = 10 > 2; //operadores - comparaciones.

console.log(mayorQue);

//Arrays

const array = ['texto', 45, true, {propiedad: 'valor'}];
console.log(array);

//Objetos
const persona = {
    nombre: 'Christian',
    apellido: 'Ospina',
    edad: 25,
    datos: {
        sexo: 'M',
        estatura: 1.86,
    },
}
console.log(persona.datos);


function hola(){
    console.log('Hola');
}
hola();

const miVariable = null; //inicializar a 0
const miVariable2 = undefined; //no se usa
//document.getElementById(DOMloaded)