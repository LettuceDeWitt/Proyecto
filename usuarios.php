<?php
// Incluir el archivo de conexión
include "conexion.php";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
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

        // Comprobar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular los parámetros
            $stmt->bind_param("sss", $nombre_usuario, $email, $password_encriptada);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Si el usuario se registra exitosamente
                echo "¡Usuario registrado exitosamente!";
            } else {
                // Si hubo un error al insertar
                echo "Error al registrar el usuario: " . $stmt->error;
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            // Si hubo un error al preparar la consulta
            echo "Error al preparar la consulta: " . $conexion->error;
        }
    } else {
        echo "Por favor, llena todos los campos.";
    }
}

// Cerrar la conexión
$conexion->close();
?>
