<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MVC Ejemplo</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
</head>
<body>

<div id="result"></div>

<form id="dataForm">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <button type="button" onclick="submitForm()">Enviar</button>
</form>

</body>
</html>



