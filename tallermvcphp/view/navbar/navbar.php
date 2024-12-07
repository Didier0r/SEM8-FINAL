<?php
    include_once ($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
    if( !( isset($_SESSION) )) {
        session_start();
    }
    $usuario = null;
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Carga de Bootstrap 5 CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Para los íconos -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> <!-- Tipografía elegante -->
  <title>Dashboard</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f7f6;
      margin: 0;
    }

    .navbar {
      background-color: #000; /* Fondo negro */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
    }

    .navbar-brand {
      color: #fff !important; /* Texto blanco para DET WIFI */
      font-size: 1.8rem;
      font-weight: 600;
    }

    .nav-link {
      color: #ecf0f1 !important; /* Blanco suave */
      font-size: 1.1rem;
      font-weight: 400;
      padding: 10px 20px;
      transition: all 0.3s ease; /* Transición suave */
    }

    .nav-link:hover {
      color: #f39c12 !important; /* Resalta en dorado */
      background-color: rgba(255, 255, 255, 0.1); /* Fondo sutil al pasar el mouse */
      border-radius: 5px;
    }

    .navbar-nav .dropdown-menu {
      background-color: #212121;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .dropdown-item {
      color: #ecf0f1 !important;
      padding: 10px 20px;
    }

    .dropdown-item:hover {
      background-color: #f39c12 !important;
      color: #2c3e50 !important;
    }

    .navbar-toggler-icon {
      background-color: #f39c12; /* Ícono del menú hamburguesa en dorado */
    }

    /* Íconos en el menú */
    .navbar-nav .dropdown-item i {
      margin-right: 10px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .navbar-brand {
        font-size: 1.5rem;
      }

      .nav-link {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">DET WIFI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=PROJECT_PATH?>">
            <i class="bi bi-house-door"></i> Inicio
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-file-earmark-check"></i> Asistencia
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=PROJECT_PATH?>view/asistencias/create.php">Agregar</a></li>
            <li><a class="dropdown-item" href="<?=PROJECT_PATH?>view/asistencias/">Listar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-badge"></i> Permisos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=PROJECT_PATH?>view/permisos/create.php">Agregar</a></li>
            <li><a class="dropdown-item" href="<?=PROJECT_PATH?>view/permisos/">Listar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-lines-fill"></i> Usuarios
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=PROJECT_PATH?>view/usuarios/create.php">Agregar</a></li>
            <li><a class="dropdown-item" href="<?=PROJECT_PATH?>view/usuarios/">Listar</a></li>
          </ul>
        </li>        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i> <?= ucfirst($usuario) ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=PROJECT_PATH?>view/usuario/logout.php">Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Bootstrap JS y dependencia Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0-alpha1/js/bootstrap.min.js"></script>

</body>
</html>
