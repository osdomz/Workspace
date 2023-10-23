const usuario = {
    edad: 27,
    pais: "Colombia",
    ticket: true,
};

if(usuario.edad > 17){
console.log('El usuario es mayor de edad y puede entrar al concierto');
}else{
console.log('El usuario no es mayor de edad, no puede ingresar');
}
//////////////////////////////////////////////////////////
const usuario2 = {
    edad: 27,
    pais: "Colombia",
    ticket: true,
};

if ((usuario2.edad >= 18) & (usuario2.ticket == true)) {
    console.log("El usuario es mayor de edad y tiene ticket");
} else if ((usuario2.edad >= 18) & (usuario2.ticket == false)) {
    console.log("El usuario es mayor de edad pero no tiene ticket");
} else if ((usuario2.edad < 18) & (usuario2.ticket == true)) {
    console.log("El usuario no es mayor de edad y tiene ticket");
} else {
    console.log("El usuario no cumple con ningunO de los requisitos");
};
//////////////////////////////////////////////////////////
const usuario3 = {
    edad: 27,
    pais: "Colombia",
    ticket: false,
};

if(usuario3.edad >= 18) {
    if(usuario3.ticket) {
        console.log('El usuario es mayor y tiene ticket');
    }else{
        console.log('El usuario es mayor pero no tiene ticket');
    }
}else {
    console.log('El usuario es menor de edad');
}
////////////////////////////////////
const usuario4 = {
    edad: 27,
    pais: "Colombia",
    ticket: false,
};

if(usuario4.pais === 'Colombia') {
    console.log('El usuario es Colombiano');
}else if (usuario4.pais === 'Mexico') {
    console.log('El usuario es Mexicano');
}else if (usuario4.pais === 'España') {
    console.log('El usuario es Español');
}else{
    console.log('El usuario no cumple con ningun requisito');
}
