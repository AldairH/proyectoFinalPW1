<?php
require 'conexion.php';
session_start();

$correoE = mysqli_real_escape_string($conexion, $_POST['correoE']);
$password = mysqli_real_escape_string($conexion, $_POST['password']);

$q = "SELECT * FROM usuario WHERE correoE = '$correoE'";

$consulta = mysqli_query($conexion, $q);
$array = mysqli_fetch_array($consulta);

if ($array) {
    $hashedPasswordFromDB = $array['password'];
    if (password_verify($password, $hashedPasswordFromDB)) {
        $_SESSION['username'] = $correoE;
        header("location: ../principal.php");
    } else {
        header("location: ../index.php?login=error");
    }
} else {
    header("location: ../index.php?login=error");
}

mysqli_close($conexion);
?>
