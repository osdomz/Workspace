// const saludo = (nombre = 'Juan') => {
//     console.log(`Hola ${nombre}`); //``
// };

// saludo('Christian');
// saludo('Alex');
// saludo('Cesar');
// saludo();

//Multiples parametros
const operacion = (tipo, numero1, numero2) => {
    //console.log(numero1 + numero2);
    if (tipo === 'suma') {
        console.log(numero1 + numero2);
    } else if (tipo === 'resta') {
        console.log(numero1 - numero2);
    }
};

operacion('suma', 2, 5);
operacion('resta', 5, 7);