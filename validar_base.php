$conexion = new mysqli('localhost', 'usuario_bd', 'contraseña_bd', 'nombre_bd');

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa";
}
