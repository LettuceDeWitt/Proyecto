<?php
// Incluir el archivo de conexión
include "conexion.php";  // Asegúrate de que la ruta sea correcta
include_once './header.php'; 
// Inicializar una variable de mensaje
$mensaje = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre_usuario) && !empty($email) && !empty($password)) {
        // Encriptar la contraseña
        $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre_usuario, email, password) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        // Comprobar si la preparación fue exitosa
        if ($stmt) {
            // Vincular los parámetros de la consulta
            $stmt->bind_param("sss", $nombre_usuario, $email, $password_encriptada);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                $mensaje = "¡Usuario agregado exitosamente!";
            } else {
                $mensaje = "Error al agregar el usuario: " . $stmt->error;
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            $mensaje = "Error al preparar la consulta: " . $conexion->error;
        }
    } else {
        $mensaje = "Por favor, llena todos los campos.";
    }
}

// Cerrar la conexión
$conexion->close();
?>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <h1 class="header center orange-text">Videojuegos</h1>
        <h5 class="header col s12 light center">Conoce algunos de los videojuegos más populares</h5>
    </div>
</div>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <h3 class="center">Registrar Nuevo Usuario</h3>

        <!-- Mostrar el mensaje de éxito o error -->
        <?php if (!empty($mensaje)) { echo "<p class='center red-text'>$mensaje</p>"; } ?>

        <!-- Formulario de registro de usuario -->
        <form method="POST" action="">
            <div class="input-field">
                <input type="text" name="nombre_usuario" id="nombre_usuario" required>
                <label for="nombre_usuario">Nombre de Usuario</label>
            </div>

            <div class="input-field">
                <input type="email" name="email" id="email" required>
                <label for="email">Correo Electrónico</label>
            </div>

            <div class="input-field">
                <input type="password" name="password" id="password" required>
                <label for="password">Contraseña</label>
            </div>

            <button type="submit" class="btn waves-effect waves-light">Registrar Usuario</button>
        </form>

        <!-- Botón de salir (redirección a index.php) -->
        <div class="center" style="margin-top: 20px;">
            <a href="index.php" class="btn waves-effect waves-light red">Salir</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
<?php include_once './footer.php'; ?>