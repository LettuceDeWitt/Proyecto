<?php
    // Incluir la conexión a la base de datos
    include 'conexion.php'; // Suponiendo que la conexión está en un archivo llamado conexion.php

    // Consulta para obtener los videojuegos
    $sql = "SELECT * FROM videojuegos";
    $result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Videojuegos - FES Aragon</title>
  <link rel="shortcut icon" href="./Media/favicon.jpg" type="image/x-icon">

  <!-- CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php include "./header.php"; ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Videojuegos</h1>
      <div class="row center">
        <h5 class="header col s12 light">Conoce algunos de los videojuegos más populares</h5>
      </div>
      <br><br>
    </div>
  </div>

  <div class="container">
    <div class="section">
      <!-- Tabla de videojuegos -->
      <div class="row">
        <?php
        // Verificar si hay resultados y mostrar los videojuegos
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                <div class="col s12 m4">
                  <div class="icon-block">
                    <h2 class="center light-blue-text"><i class="material-icons">videogame_asset</i></h2>
                    <h5 class="center">' . $row["titulo"] . '</h5>
                    <p class="center">Género: ' . $row["genero"] . '</p>
                    <p class="center">Año: ' . $row["año"] . '</p>
                    <p class="center">Desarrollador: ' . $row["empresa"] . '</p>
                    <p class="center">Disponible en:</p>
                    <p class="center">
                      Xbox: ' . $row["xbox"] . '<br>
                      PlayStation: ' . $row["play"] . '<br>
                      Nintendo: ' . $row["nintendo"] . '<br>
                      PC: ' . $row["pc"] . '
                    </p>
                  </div>
                </div>
                ';
            }
        } else {
            echo "<p class='center'>No hay videojuegos disponibles en la base de datos.</p>";
        }
        ?>
      </div>
    </div>
  </div>

  <?php include "./footer.php"; ?>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>
</html>

<?php
  // Cerrar la conexión
  $conexion->close();
?>
