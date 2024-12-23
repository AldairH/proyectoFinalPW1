<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Prueba</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./Styles/style.css">
</head>
<body class="log">
<div style="height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <div class="card-content">
            <span class="card-title center-align">Iniciar Sesión</span>
            <form method="POST" action="./Logica/login.php">
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input type="email" name="correoE" id="correoE" required>
                    <label for="correoE">Correo Electrónico</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password" id="password" required>
                    <label for="password">Contraseña</label>
                </div>
                <div class="center">
                    <button type="submit" class="btn">Iniciar Sesión</button>
                    <a href="./register.php" class="btn-flat">Registrarse</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET['login']) && $_GET['login'] == 'success') {
    echo "<div class='alert alert-success' style='background-color: #4caf50; color: white; padding: 10px; border-radius: 5px; text-align: center; margin-top: 20px;'>Login exitoso.</div>";
} elseif (isset($_GET['login']) && $_GET['login'] == 'error') {
    echo "<div class='alert alert-danger' style='background-color: #f44336; color: white; padding: 10px; border-radius: 5px; text-align: center; margin-top: 20px;'>Usuario o contraseña incorrectos.</div>";
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
