<?php
session_start();
include "./logica/conexion.php";  // Incluye la conexión a la base de datos

$usuario = $_SESSION['usermane'];  // Obtiene el usuario de la sesión

// Verifica si la sesión del usuario está activa
if (!isset($usuario)) {
    // Si no hay sesión activa, redirige a la página de login
    header("location: loginAdmin.php");
    exit();  // Asegúrate de que el código no continúe ejecutándose
} else {
    // Si la sesión está activa, incluye el encabezado de administrador
    include "./headerAdmin.php";
?>
    <header>
        <h2 style="text-align:center">Registro</h2>
        <h4 style="text-align:center">Generando registro por: <?php echo htmlspecialchars($usuario); ?></h4>
    </header>

    <br /><br />

    <!-- Botón para limpiar los campos del formulario -->
    <input type="reset" name="clear" class="btn btn-primary" value="Borrar">
    
    <!-- Botón de salida que redirige a la acción de destruir la sesión -->
    <a style="right:inherit" class="waves-effect waves-light btn" href="logica/session_destroyAdmin.php">Salir</a>

<?php  
}  // Fin del bloque else
?>
