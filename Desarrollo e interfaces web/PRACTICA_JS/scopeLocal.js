//variables declaradas dentro de una funcion y solo podemos acceder a ellas mediante esa misma funcion
var obtenerNumeroLetras = (nombre) => {
    var numero = nombre.length;

    console.log(`${nombre} tiene ${numero} letras`);

    var funcionAnidada = () => {
        console.log(numero);
    };
    funcionAnidada();
};
obtenerNumeroLetras('Christian');