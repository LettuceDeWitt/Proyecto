<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Página Principal</title>
  <link rel="shortcut icon" href="./Media/favicon.jpg" type="image/x-icon">

  <!-- Enlace a los iconos de Google Material -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Estilos de Materialize CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!-- Tu estilo personalizado -->
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

<body>
  <!-- Navegación -->
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container">
      <!-- Logo que lleva a la página de inicio -->
      <a href="#" id="logo-container" class="brand-logo">
        <img src="./Media/logo.png" alt="Logo" style="height: 50px;">
      </a>

      <!-- Menú para pantallas grandes -->
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Nosotros</a></li>
        <li><a href="#">Servicios</a></li>
        <li><a href="#">Contacto</a></li>
        <!-- Enlace actualizado para redirigir a loginAdmin.php -->
        <li><a href="loginAdmin.php">Iniciar sesión</a></li>
      </ul>

      <!-- Menú para pantallas pequeñas (hamburguesa) -->
      <ul id="nav-mobile" class="sidenav">
        <li><a href="#">Nosotros</a></li>
        <li><a href="#">Servicios</a></li>
        <li><a href="#">Contacto</a></li>
        <!-- Enlace actualizado para redirigir a loginAdmin.php -->
        <li><a href="loginAdmin.php">Iniciar sesión</a></li>
      </ul>

      <!-- Icono de menú (hamburguesa) para dispositivos móviles -->
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <!-- Contenido de la página -->
  <div class="container">
    <!-- Bienvenida -->
    <h2>Bienvenido</h2>
  </div>

  <!-- Agregar los scripts de Materialize -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>
