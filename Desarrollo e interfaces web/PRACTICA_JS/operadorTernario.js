const boleto = "vip";
// let codigoDeAcceso;

// if (boleto === "vip") {
//   codigoDeAcceso = "VIP-123-456";
// } else {
//   codigoDeAcceso = "REGULAR-456-789";
// }
// console.log(codigoDeAcceso);

const codigoDeAcceso = boleto === "vip" ? "VIP-123-456" : "REGULAR-456-789";

boleto === "vip" ? console.log("Tu boleto es VIP") : console.log("REGULAR-456-789");
