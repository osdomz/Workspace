const usuario = {
    nombre: "Christian",
    pais: "Colombia",
};
// if (usuario.pais === "Colombia") {
//   console.log("El usuario es Colombiano");
// } else if (usuario.pais === "España") {
//   console.log("El usuario es Español");
// } else if (usuario.pais === "Chile") {
//   console.log("El usuario es Chileno");
// } else {
//   console.log("El usuario es de otro pais");
// }
switch (usuario.pais) {
    case "Colombia":
        console.log("El usuario es Colombiano");
        break;
    case "España":
        console.log("El usuario es Español");
        break;
    case "Chile":
        console.log("El usuario es Chileno");
        break;
    default:
        console.log('El usuario es de otro país');
}
