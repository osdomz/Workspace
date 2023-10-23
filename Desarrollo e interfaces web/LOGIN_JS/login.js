// Función para iniciar sesión
function login() {
    var user = document.getElementById("user1").value;
    var pass = document.getElementsByName("pass")[0].value;
    sessionStorage.setItem("user", user);
    sessionStorage.setItem("pass", pass);
    updateSessionData();
}

// Función para cerrar sesión
function logout() {
    sessionStorage.removeItem("user");
    sessionStorage.removeItem("pass");
    updateSessionData();
}

// Función para actualizar los datos de la sesión en el textarea
function updateSessionData() {
    var user = sessionStorage.getItem("user") || '';
    var pass = sessionStorage.getItem("pass") || '';
    var session_id = sessionStorage.getItem("session_id") || '';

    // Actualiza el contenido del textarea y el ID de sesión
    document.getElementById("sessionData").value = `User: ${user}\nPass: ${pass}`;
    document.getElementById("session_id").textContent = session_id;
}

// Verifica si ya hay una sesión iniciada
var session_id = sessionStorage.getItem("session_id");
if (!session_id) {
    // Si no hay un ID de sesión, genera uno nuevo
    session_id = Math.random().toString(36).substr(2, 9);
    sessionStorage.setItem("session_id", session_id);
}

// Asigna las funciones de inicio y cierre de sesión a los botones
document.querySelector("#loginForm button").addEventListener("click", login);
document.querySelector("#logoutForm button").addEventListener("click", logout);

// Actualiza los datos de la sesión al cargar la página
updateSessionData();



