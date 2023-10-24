//Obtener datos del localStorage

//Destinos
var destinos = JSON.parse(localStorage.getItem('destinos'));

//Usuarios
var usuarios = JSON.parse(localStorage.getItem('usuarios'));

export {destinos, usuarios};