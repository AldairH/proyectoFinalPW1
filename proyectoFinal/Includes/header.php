<?php
require "./Logica/conexion.php";
mysqli_set_charset($conexion, 'utf8');
$correoE = $_SESSION['username'];

$query = "SELECT nomUsuario FROM usuario WHERE correoE = '$correoE'";
$resultado = mysqli_query($conexion, $query);

$nomUsuario = "Usuario";

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $nomUsuario = $fila['nomUsuario'];
}

?>
<link rel="stylesheet" href="../Styles/style.css">
<nav class="nav"style="background: rgb(103,0,255); background: linear-gradient(90deg, rgba(103,0,255,0.999964951801033) 0%, rgba(255,0,86,1) 100%); margin-bottom: 40px;">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">
                <i class="material-icons">account_circle</i>
                <?php echo htmlspecialchars($nomUsuario); ?>
            </a>
            <ul class="right hide-on-med-and-down" style="padding-right:40px;">
                <li><a href="./Logica/logout.php" class="btn waves-effect waves-light">Salir</a></li>
            </ul>
        </div>
</nav>