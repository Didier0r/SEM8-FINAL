<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡Acceso restringido!</h4>
            <p>No tienes permisos para acceder a esta página. Si necesitas acceso, por favor contacta con el administrador del sistema.</p>
            <hr>
            <p class="mb-0">Si necesitas regresar al inicio, haz clic <a href="index.php" class="alert-link">aquí</a>.</p>
        </div>
    </div>
</body>
</html>
