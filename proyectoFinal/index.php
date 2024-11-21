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
<div id="modalError" class="modal">
    <div class="modal-content">
        <h4>Error de Login</h4>
        <p>Usuario o contraseña incorrectos. Por favor, reintentar.</p>
    </div>
    <div class="modal-footer">
        <a href="./index.php" class="modal-close waves-effect waves-green btn-flat">Reintentar</a>
    </div>
</div>
<?php
if (isset($_GET['login']) && $_GET['login'] == 'error') {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('modalError');
                var instance = M.Modal.init(modal);
                instance.open();
            });
          </script>";
    }
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    M.AutoInit();
</script>
</body>
</html>