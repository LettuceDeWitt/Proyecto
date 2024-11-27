<?php
session_start();

// Verificar si el administrador está logueado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'conexion.php'; // Conexión a la base de datos

// Verificar si se ha pasado un ID de videojuego
if (isset($_GET['id'])) {
    $game_id = $_GET['id'];

    // Eliminar el videojuego de la base de datos
    $stmt = $conexion->prepare("DELETE FROM videojuegos WHERE id = ?");
    $stmt->bind_param("i", $game_id);

    if ($stmt->execute()) {
        // Redirigir al panel de administración después de eliminar
        header("Location: admin.php"); 
        exit;
    } else {
        echo "Error al eliminar el videojuego: " . $conexion->error;
    }

    $stmt->close();
}

$conexion->close();
?>
