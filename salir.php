<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al login.php (o a la página que elijas)
header("Location: index.php");
exit;
?>
