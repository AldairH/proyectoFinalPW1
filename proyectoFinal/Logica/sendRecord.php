<?php
include "./conexion.php";
mysqli_set_charset($conexion, 'utf8');
$nombreUser=mysqli_real_escape_string($conexion, $_POST['nombre_usuario']);
$correoE=mysqli_real_escape_string($conexion, $_POST['correoE']);
$password=mysqli_real_escape_string($conexion, $_POST['password']);

$buscarUsuario="SELECT * FROM usuario WHERE correoE='$correoE'";
$resultado = $conexion -> query($buscarUsuario);
$count = mysqli_num_rows($resultado);

if($count > 0){
    header("Location: ../register.php?registro=error");
    exit();
}else{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuario (nomUsuario, correoE, password)VALUES(?,?,?)");
    $stmt->bind_param("sss", $nombreUser, $correoE, $hashedPassword);

    if($stmt->execute()){
        header("Location: ../index.php");
        exit();
    }else{
        echo "<br><h1>Error al crear usuario D:</h1>";
        echo "<p>Error:" .$stmt->error. "</p>";
    }
    $stmt->close();
}
mysqli_close($conexion);
?>