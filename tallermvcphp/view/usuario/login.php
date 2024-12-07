<?php
session_start(); // Inicia sesión si aún no se ha hecho

include_once($_SERVER['DOCUMENT_ROOT'].'/Empresa/tallermvcphp/routes.php');
require_once(CONTROLLER_PATH . 'usuarioController.php');

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario_id'])) {
    // Si ya está logueado, redirigirlo al dashboard o página de inicio
    header("Location: dashboard.php");
    exit();
}

// Procesar el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Llamar al controlador para verificar las credenciales
    $object = new usuarioController();
    $usuarioData = $object->login($usuario, $clave);

    if ($usuarioData) {
        // Si la autenticación es exitosa, almacenamos los datos del usuario en la sesión
        $_SESSION['usuario_id'] = $usuarioData['id']; // Asumiendo que el 'id' es el identificador del usuario
        $_SESSION['usuario_rol'] = $usuarioData['rol_id']; // Guardamos el rol del usuario

        // Verificar el rol
        if ($usuarioData['rol_id'] != 1) {
            // Si el rol no es 1, redirigir al usuario a una página de acceso denegado
            header("Location: acceso_denegado.php");
            exit();
        }

        // Si el rol es correcto, redirigir al dashboard u otra página
        header("Location: dashboard.php");
        exit();
    } else {
        // Si las credenciales no son correctas, mostrar un mensaje de error
        echo "<script>alert('Usuario o contraseña incorrectos');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <?php include_once(ROOT_PATH . 'header.php'); ?>
    <style>
        .vh-100 {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #262626 ;
        }
        .login-container {
            text-align: center;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: #f7efee;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-control {
        margin-bottom: 15px;
        font-size: 14px; 
        font-weight: bold; 
    }
        .login-container img {
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
            object-fit: cover;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .form-control::placeholder {
        font-size: 14px; 
    }
        .btn {
            width: 100%;
        }
    </style>
</head>
<body>
<section class="vh-100">
    <div class="login-container">
        <img src="../../assets/images/inicio.png" alt="imagen usuario">
        <form id="formLogin" action="" method="post" autocomplete="off">
            
            <div class="form-outline mb-4">
                <label class="form-label" for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control form-control-lg"
                       placeholder="Ingrese usuario" autocorrect="off" spellcheck="false" required />
            </div>
            
            <div class="form-outline mb-3">
                <label class="form-label" for="clave">Contraseña</label>
                <input type="password" name="clave" id="clave" class="form-control form-control-lg"
                       placeholder="Ingrese contraseña" autocorrect="off" spellcheck="false" required />
            </div>
            
            <button type="submit" class="btn btn-primary btn-lg">Acceder</button>
        </form>
    </div>
</section>
<?php include_once(ROOT_PATH . 'footer.php'); ?>
</body>
</html>
