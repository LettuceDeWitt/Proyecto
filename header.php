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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection" />

  <!-- Tu estilo personalizado -->
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <style>
    /* Personalización del header */
    nav {
      background: linear-gradient(45deg, #42a5f5, #1e88e5);
    }

    nav a {
      font-weight: bold;
      font-size: 1.1rem;
    }

    nav a:hover {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 5px;
    }

    /* Estilo del logo */
    #logo-container img {
      border-radius: 50%;
    }

    /* Mensaje de bienvenida */
    h2 {
      text-align: center;
      margin-top: 50px;
      color: #1e88e5;
      font-weight: 700;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Íconos en el menú móvil */
    .sidenav li a {
      display: flex;
      align-items: center;
    }

    .sidenav li a i {
      margin-right: 10px;
    }
  </style>
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
        <li><a href="loginAdmin.php">Iniciar sesión</a></li>
      </ul>

      <!-- Menú para pantallas pequeñas (hamburguesa) -->
      <ul id="nav-mobile" class="sidenav">
        <li><a href="#"><i class="material-icons">people</i> Nosotros</a></li>
        <li><a href="#"><i class="material-icons">build</i> Servicios</a></li>
        <li><a href="#"><i class="material-icons">contact_mail</i> Contacto</a></li>
        <li><a href="loginAdmin.php"><i class="material-icons">login</i> Iniciar sesión</a></li>
      </ul>

      <!-- Icono de menú (hamburguesa) para dispositivos móviles -->
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <!-- Contenido de la página -->
  <div class="container">
    <!-- Bienvenida -->
    <h2>Bienvenido</h2>
    <p class="center-align">Explora nuestro sitio para conocer más sobre nosotros y nuestros servicios.</p>
  </div>

  <!-- Agregar los scripts de Materialize -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    // Inicializar el sidenav
    document.addEventListener('DOMContentLoaded', function () {
      const elems = document.querySelectorAll('.sidenav');
      M.Sidenav.init(elems);
    });
  </script>
</body>

</html>
