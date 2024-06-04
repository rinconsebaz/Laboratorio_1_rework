<?php

use App\controllers\database\ConexionDBController;

require '/controllers/database/ConexionDBController.php';

$conexionDB = new ConexionDBController();

//Autenticación usuario
$autController = new authController($conexionDB);

// Verifica datos enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Llamar al inicio de sesión 
    $autController->login();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesion</title>

</head>
<body>
    <div class="container">
            <h2>Iniciar sesión</h2>
            <form action=" " method="POST"> 

                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>  
                </div>

                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>

                <button type="submit">Iniciar Sesion</button>

            </form>
        </div>
</body>
</html>