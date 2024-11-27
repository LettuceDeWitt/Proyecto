<?php
// Determinar si estamos en un entorno de producción (servidor remoto) o desarrollo (local)
$is_local = true; // Cambia a false cuando subas a producción

if ($is_local) {
    // Configuración para el entorno local (tu máquina)
    $host_db = "localhost:3306";  // Host local
    $user_db = "root";            // Usuario de MySQL por defecto en XAMPP
    $pass_db = "320321492";       // Contraseña de MySQL configurada en XAMPP
    $db_name = "videojuegos";     // Nombre de la base de datos local
} else {
    // Configuración para el entorno de producción (servidor remoto)
    $host_db = "sql205.infinityfree.com"; // Host remoto
    $user_db = "if0_37329474";           // Usuario en el servidor remoto
    $pass_db = "VsRvf8UOUtxX";             // Contraseña en el servidor remoto
    $db_name = "if0_37329474_videojuegos";  // Nombre de la base de datos en el servidor remoto
}

// Crear la conexión
$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
