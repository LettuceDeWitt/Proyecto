<?php
session_start();
include "./conexion.php";

// Verificación de que los datos del formulario están establecidos
if (isset($_POST['nombre_usuario'], $_POST['password'])) {
    $usuario = htmlspecialchars($_POST['nombre_usuario']);
    $password = htmlspecialchars($_POST['password']);

    // Consulta preparada para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT password FROM usuarios WHERE nombre_usuario = ?");
    if ($stmt === false) {
        die("Error en la consulta SQL: " . $conexion->error);  // Si la consulta falla
    }

    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar las credenciales
    if ($user && password_verify($password, $user['password'])) {
        // Inicio de sesión exitoso
        $_SESSION['username'] = $usuario;
        header("location: ../dashboardAdmin.php");
        exit; // Asegurarse de detener la ejecución después de la redirección
    } else {
        // Redirigir al inicio de sesión con un mensaje de error
        header("location: ../loginAdmin.php?error=invalid_credentials");
        exit; // Detener ejecución para evitar que se ejecute cualquier código posterior
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    // Redirigir si no se han recibido los datos necesarios
    header("location: ../loginAdmin.php?error=missing_data");
    exit;
}

// Cerrar la conexión
$conexion->close();
?>
