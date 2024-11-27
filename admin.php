<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar si la sesión ya está iniciada, solo iniciar si no está
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el administrador está logueado
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'conexion.php'; // Conexión a la base de datos

// Lógica para agregar un videojuego
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Filtrar y sanitizar las entradas
    $game_name = trim($_POST['game_name']);
    $game_year = filter_var($_POST['game_year'], FILTER_VALIDATE_INT);
    $game_genre = trim($_POST['game_genre']);
    $game_company = trim($_POST['game_company']);

    // Plataformas disponibles (con valores por defecto si no se seleccionan)
    $xbox = isset($_POST['xbox']) ? 'Sí' : 'No';
    $play = isset($_POST['play']) ? 'Sí' : 'No';
    $nintendo = isset($_POST['nintendo']) ? 'Sí' : 'No';
    $pc = isset($_POST['pc']) ? 'Sí' : 'No';

    if (!empty($game_name) && !empty($game_year) && !empty($game_genre) && !empty($game_company)) {
        // Verificar si el videojuego ya existe
        $check_query = "SELECT * FROM videojuegos WHERE titulo = ?";
        $check_stmt = $conexion->prepare($check_query);
        $check_stmt->bind_param("s", $game_name);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error_message = "El videojuego ya está registrado.";
        } else {
            // Insertar en la base de datos
            $stmt = $conexion->prepare("INSERT INTO videojuegos (titulo, genero, anio, empresa, xbox, play, nintendo, pc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssisssss", $game_name, $game_genre, $game_year, $game_company, $xbox, $play, $nintendo, $pc);

            if ($stmt->execute()) {
                $success_message = "Videojuego agregado exitosamente!";
                header("Location: admin.php");  // Redirigir a la página después de agregar
                exit;
            } else {
                $error_message = "Error al agregar el videojuego: " . $conexion->error;
            }

            $stmt->close();
        }
        $check_stmt->close();
    } else {
        $error_message = "Todos los campos son obligatorios.";
    }
}

// Lógica para eliminar un videojuego
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Eliminar el videojuego de la base de datos
    $delete_query = "DELETE FROM videojuegos WHERE id = ?";
    $delete_stmt = $conexion->prepare($delete_query);
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        $delete_success = "Videojuego eliminado exitosamente!";
    } else {
        $delete_error = "Error al eliminar el videojuego: " . $conexion->error;
    }

    $delete_stmt->close();
}

// Lógica para eliminar un usuario
if (isset($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];

    // Eliminar el usuario de la base de datos
    $delete_user_query = "DELETE FROM usuarios WHERE id = ?";
    $delete_user_stmt = $conexion->prepare($delete_user_query);
    $delete_user_stmt->bind_param("i", $delete_user_id);
    if ($delete_user_stmt->execute()) {
        $delete_user_success = "Usuario eliminado exitosamente!";
    } else {
        $delete_user_error = "Error al eliminar el usuario: " . $conexion->error;
    }

    $delete_user_stmt->close();
}

// Lógica para obtener los videojuegos desde la base de datos
$sql = "SELECT * FROM videojuegos";
$result = $conexion->query($sql);

// Lógica para obtener los usuarios desde la base de datos
$users_sql = "SELECT * FROM usuarios";
$users_result = $conexion->query($users_sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Videojuegos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .game-item, .user-item {
            margin: 20px;
            text-align: center;
        }

        .delete-icon {
            color: red;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="center">Administración de Videojuegos</h3>

        <!-- Opción de salir -->
        <div class="right-align">
            <a href="salir.php" class="btn red">Salir</a>
        </div>

        <!-- Mostrar mensaje de éxito o error -->
        <?php if (isset($success_message)) echo "<p class='green-text'>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p class='red-text'>$error_message</p>"; ?>
        <?php if (isset($delete_success)) echo "<p class='green-text'>$delete_success</p>"; ?>
        <?php if (isset($delete_error)) echo "<p class='red-text'>$delete_error</p>"; ?>
        <?php if (isset($delete_user_success)) echo "<p class='green-text'>$delete_user_success</p>"; ?>
        <?php if (isset($delete_user_error)) echo "<p class='red-text'>$delete_user_error</p>"; ?>

        <!-- Formulario para agregar un videojuego -->
        <h4>Agregar Videojuego</h4>
        <form method="POST">
            <div class="input-field">
                <input type="text" name="game_name" id="game_name" required>
                <label for="game_name">Nombre del Videojuego</label>
            </div>
            <div class="input-field">
                <input type="number" name="game_year" id="game_year" required>
                <label for="game_year">Año de Lanzamiento</label>
            </div>
            <div class="input-field">
                <input type="text" name="game_genre" id="game_genre" required>
                <label for="game_genre">Género</label>
            </div>
            <div class="input-field">
                <input type="text" name="game_company" id="game_company" required>
                <label for="game_company">Empresa</label>
            </div>

            <!-- Plataformas disponibles -->
            <p>Plataformas disponibles:</p>
            <label>
                <input type="checkbox" name="xbox">
                <span>Xbox</span>
            </label>
            <label>
                <input type="checkbox" name="play">
                <span>PlayStation</span>
            </label>
            <label>
                <input type="checkbox" name="nintendo">
                <span>Nintendo</span>
            </label>
            <label>
                <input type="checkbox" name="pc">
                <span>PC</span>
            </label>

            <button type="submit" class="btn waves-effect waves-light">Agregar</button>
        </form>

        <!-- Mostrar videojuegos -->
        <h4>Videojuegos Agregados</h4>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col s12 m6 l4 game-item'>";
                    echo "<h5>" . $row['titulo'] . "</h5>";
                    echo "<p>Año: " . $row['anio'] . "</p>";
                    echo "<p>Género: " . $row['genero'] . "</p>";
                    echo "<p>Empresa: " . $row['empresa'] . "</p>";
                    echo "<p>Plataformas: Xbox: " . $row['xbox'] . ", PlayStation: " . $row['play'] . ", Nintendo: " . $row['nintendo'] . ", PC: " . $row['pc'] . "</p>";
                    echo "<a href='?delete_id=" . $row['id'] . "' class='delete-icon'>Eliminar</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay videojuegos registrados.</p>";
            }
            ?>
        </div>

        <!-- Mostrar usuarios -->
        <h4>Usuarios Registrados</h4>
        <div class="row">
            <?php
            if ($users_result->num_rows > 0) {
                while ($user = $users_result->fetch_assoc()) {
                    echo "<div class='col s12 m6 l4 user-item'>";
                    echo "<h5>" . $user['nombre_usuario'] . "</h5>"; // Cambié 'nombre' por 'nombre_usuario'
                    echo "<p>Correo: " . $user['email'] . "</p>";
                    echo "<a href='?delete_user_id=" . $user['id'] . "' class='delete-icon'>Eliminar Usuario</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay usuarios registrados.</p>";
            }
            ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
