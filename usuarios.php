<?php
// Incluir el archivo de conexión
include "conexion.php";

// Definir los datos del nuevo usuario
$nombre_usuario = "32032142";  // Nombre de usuario que quieres agregar
$email = "usuario@example.com";  // Correo electrónico del usuario
$password = "123456789";  // Contraseña del usuario

// Validar que los campos no estén vacíos
if (!empty($nombre_usuario) && !empty($email) && !empty($password)) {
    // Encriptar la contraseña
    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, email, password) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
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
    echo "Por favor, llena todos los campos.";
}

// Cerrar la conexión
$conexion->close();
?>
