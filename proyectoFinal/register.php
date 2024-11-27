<?php
if (isset($_GET['registro']) && $_GET['registro'] == 'error') {
    $mensajeError = "El correo ya esta registrado. Por favor, intenta con otro correo.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./Styles/style.css">
</head>
<body class="log">
<div style="height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0;">
    <div class="card" style="width: 100%; max-width: 400px;">
        <div class="card-content">
            <span class="card-title center-align">Registrarse</span>
            <form method="POST" action="./Logica/sendRecord.php">
                <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                    <input type="text" name="nombre_usuario" id="nombre_usuario" required>
                    <label for="nombre_usuario">Nombre</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input type="email" name="correoE" id="correoE" required>
                    <label for="correoE">Correo Electronico</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input type="password" name="password" id="password" required>
                    <label for="password">Contraseña</label>
                </div>
                <div class="center">
                    <button type="submit" class="btn">Crear Cuenta :D</button>
                    <a href="./index.php" class="btn-flat">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="modalError" class="modal">
    <div class="modal-content">
        <h4>Error en el Registro</h4>
        <p><?php echo isset($mensajeError) ? $mensajeError : ''; ?></p>
    </div>
    <div class="modal-footer">
        <a href="register.php" class="modal-close waves-effect waves-green btn-flat">Reintentar</a>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    $(document).ready(function() {
        M.AutoInit();
        <?php if (isset($mensajeError)): ?>
            var modal = M.Modal.getInstance(document.getElementById('modalError'));
            modal.open();
        <?php endif; ?>
    });
</script>
<script>
    M.AutoInit();
</script>
</body>
</html>