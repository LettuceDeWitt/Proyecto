<?php
session_start();
include "conexion.php"; // Incluir el archivo de conexión a la base de datos

// Si ya está logueado, redirigir al panel de administración
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit();
}

// Comprobación de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar si el usuario existe en la base de datos
    $sql = "SELECT id, nombre_usuario, password FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $username);  // Vincula el nombre de usuario a la consulta

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprobar si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar si la contraseña ingresada coincide con la almacenada en la base de datos
        if (password_verify($password, $user['password'])) {
            // Si las credenciales son correctas, iniciar sesión
            $_SESSION['admin_logged_in'] = true; // Marca la sesión como iniciada
            $_SESSION['admin_username'] = $user['nombre_usuario']; // Almacena el nombre de usuario
            header("Location: admin.php"); // Redirigir al panel de administración
            exit;
        } else {
            $error_message = "Credenciales incorrectas.";
        }
    } else {
        $error_message = "Credenciales incorrectas.";
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Login admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div class="container">
        <h3 class="center">Login de Administrador</h3>

        <?php if (isset($error_message)) { echo "<p class='red-text'>$error_message</p>"; } ?>

        <form method="POST" action="">
            <div class="input-field">
                <input type="text" name="username" id="username" required>
                <label for="username">Usuario</label>
            </div>

            <div class="input-field">
                <input type="password" name="password" id="password" required>
                <label for="password">Contraseña</label>
            </div>

            <button type="submit" class="btn waves-effect waves-light">Iniciar sesión</button>
        </form>

        <br>

        <!-- Botón para redirigir a registroUsuarios.php -->
        <form action="registroUsuarios.php">
            <button type="submit" class="btn waves-effect waves-light">Agregar Usuario</button>
        </form>
    </div>
</body>
</html>
<?php include_once './footer.php'; ?>