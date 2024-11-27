<?php
// Incluir el archivo de conexión
include "conexion.php";  // Asegúrate de que la ruta sea correcta

// Definir los datos del nuevo usuario
$nombre_usuario = "32032142";  // Nombre de usuario que quieres agregar
$email = "xamplegmail.com";  // Correo electrónico del usuario
$password = "123456789";  // Contraseña del usuario

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
            echo "¡Usuario agregado exitosamente!";
        } else {
            echo "Error al agregar el usuario: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
} else {
    echo "Por favor, llena todos los campos.";
}

// Cerrar la conexión
$conexion->close();
?>
