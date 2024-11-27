<?php
// Incluir el archivo de conexión
include "db.php";

// Comprobar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $año = $_POST['año'];
    $empresa = $_POST['empresa'];
    $xbox = $_POST['xbox'];
    $play = $_POST['play'];
    $nintendo = $_POST['nintendo'];
    $pc = $_POST['pc'];

    // Validar que los campos no estén vacíos
    if (!empty($titulo) && !empty($genero) && !empty($año) && !empty($empresa)) {
        
        // Validar el formato del año
        if (!is_numeric($año) || $año < 1900 || $año > date("Y")) {
            echo "Por favor, ingrese un año válido.";
            exit;
        }

        // Sanitizar entradas
        $titulo = htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8');
        $genero = htmlspecialchars($genero, ENT_QUOTES, 'UTF-8');
        $empresa = htmlspecialchars($empresa, ENT_QUOTES, 'UTF-8');

        // Comprobar si el videojuego ya existe
        $check_sql = "SELECT id FROM videojuegos WHERE titulo = ?";
        $check_stmt = $conexion->prepare($check_sql);
        $check_stmt->bind_param("s", $titulo);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            echo "Este videojuego ya está registrado.";
            exit;
        }

        // Preparar la consulta SQL
        $sql = "INSERT INTO videojuegos (titulo, genero, año, empresa, xbox, play, nintendo, pc) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssssss", $titulo, $genero, $año, $empresa, $xbox, $play, $nintendo, $pc);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "¡Videojuego registrado exitosamente!";
        } else {
            echo "Error al registrar el videojuego: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Por favor, llena todos los campos del videojuego.";
    }
}

// Cerrar la conexión
$conexion->close();
?>

<!-- Formulario de registro de videojuego -->
<form action="registro_videojuego.php" method="POST">
    <label for="titulo">Título del Videojuego</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="genero">Género</label>
    <input type="text" id="genero" name="genero" required>

    <label for="año">Año de Lanzamiento</label>
    <input type="number" id="año" name="año" required>

    <label for="empresa">Empresa Desarrolladora</label>
    <input type="text" id="empresa" name="empresa" required>

    <label for="xbox">Disponible en Xbox</label>
    <select id="xbox" name="xbox" required>
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <label for="play">Disponible en PlayStation</label>
    <select id="play" name="play" required>
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <label for="nintendo">Disponible en Nintendo</label>
    <select id="nintendo" name="nintendo" required>
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <label for="pc">Disponible en PC</label>
    <select id="pc" name="pc" required>
        <option value="Sí">Sí</option>
        <option value="No">No</option>
    </select>

    <button type="submit" class="btn">Registrar Videojuego</button>
</form>
