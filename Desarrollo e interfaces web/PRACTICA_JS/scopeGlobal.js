//variables que han sido declaradas fuera de una funcion y podemos acceder desde cualquier parte del codigo

var nombre = 'Christian';
console.log(nombre);

const saludo = () => {
    console.log('Hola ' + nombre);

    nombre = 'Francisco';
    console.log('El nuevo nombre es: ' + nombre);
};
saludo(); 