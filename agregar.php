// Lógica para agregar un videojuego
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_name = trim($_POST['game_name']);
    $game_year = $_POST['game_year'];
    $game_genre = $_POST['game_genre'];
    $game_company = trim($_POST['game_company']);

    // Plataformas disponibles (con valores por defecto si no se seleccionan)
    $xbox = isset($_POST['xbox']) ? 'Sí' : 'No';
    $play = isset($_POST['play']) ? 'Sí' : 'No';
    $nintendo = isset($_POST['nintendo']) ? 'Sí' : 'No';
    $pc = isset($_POST['pc']) ? 'Sí' : 'No';

    // Verificar si los campos requeridos están vacíos
    if (!empty($game_name) && !empty($game_year) && !empty($game_genre) && !empty($game_company)) {
        // Insertar en la base de datos sin manejar imágenes
        $stmt = $conexion->prepare("INSERT INTO videojuegos (titulo, genero, año, empresa, xbox, play, nintendo, pc) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $game_name, $game_genre, $game_year, $game_company, $xbox, $play, $nintendo, $pc);

        if ($stmt->execute()) {
            $success_message = "Videojuego agregado exitosamente!";
        } else {
            $error_message = "Error al agregar el videojuego: " . $conexion->error;
        }

        $stmt->close();
    } else {
        $error_message = "Todos los campos son obligatorios.";
    }
}
