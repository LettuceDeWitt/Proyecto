<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    include_once './header.php'; // Evitar inclusión duplicada
    include_once 'conexion.php'; // Evitar inclusión duplicada

    // Consulta para obtener videojuegos
    $sql = "SELECT * FROM videojuegos"; // No se necesita DISTINCT si ya controlas duplicados en PHP
    $result = $conexion->query($sql);
?>

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <h1 class="header center orange-text">Videojuegos</h1>
        <h5 class="header col s12 light center">Conoce algunos de los videojuegos más populares</h5>
    </div>
</div>

<div class="container">
    <div class="section">
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Array para controlar títulos mostrados
                $mostrados = [];

                while ($row = $result->fetch_assoc()) {
                    // Evitar mostrar videojuegos con el mismo título
                    if (!in_array($row["titulo"], $mostrados)) {
                        // Sanitizar datos para evitar vulnerabilidades XSS
                        $titulo = htmlspecialchars($row["titulo"]);
                        $genero = htmlspecialchars($row["genero"] ?? 'Desconocido');
                        $año = htmlspecialchars($row["año"] ?? 'N/A');
                        $empresa = htmlspecialchars($row["empresa"] ?? 'N/A');
                        $xbox = htmlspecialchars($row["xbox"] ?? 'No');
                        $play = htmlspecialchars($row["play"] ?? 'No');
                        $nintendo = htmlspecialchars($row["nintendo"] ?? 'No');
                        $pc = htmlspecialchars($row["pc"] ?? 'No');
                        $imagen = htmlspecialchars($row["imagen"] ?? 'default.jpg');

                        echo '
                        <div class="col s12 m4">
                            <div class="icon-block">
                                <h2 class="center light-blue-text"><i class="material-icons">videogame_asset</i></h2>
                                <h5 class="center">' . $titulo . '</h5>
                                <p class="center">Género: ' . $genero . '</p>
                                <p class="center">Año: ' . $año . '</p>
                                <p class="center">Desarrollador: ' . $empresa . '</p>
                                <p class="center">Disponible en:</p>
                                <p class="center">
                                    Xbox: ' . $xbox . '<br>
                                    PlayStation: ' . $play . '<br>
                                    Nintendo: ' . $nintendo . '<br>
                                    PC: ' . $pc . '
                                </p>
                                <div class="center">
                                    <img src="images/' . $imagen . '" alt="' . $titulo . '" style="width:100%; max-width:200px; height:auto;">
                                </div>
                            </div>
                        </div>';
                        // Agregar título a los mostrados
                        $mostrados[] = $titulo;
                    }
                }
            } else {
                echo "<p class='center'>No hay videojuegos disponibles en la base de datos.</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php include_once './footer.php'; ?>
