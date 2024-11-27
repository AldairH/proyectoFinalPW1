<?php
include "./conexion.php";
mysqli_set_charset($conexion, 'utf8');
session_start();

$correoE = $_SESSION['username'];
$query = "SELECT id_usuario FROM usuario WHERE correoE = '$correoE'";
$resultado_usuario = mysqli_query($conexion, $query);

if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) {
    $fila = mysqli_fetch_assoc($resultado_usuario);
    $id_usuario = $fila['id_usuario'];
} else {
    echo "Error: Usuario no encontrado D:";
    exit();
}

$titulo=mysqli_real_escape_string($conexion, $_POST['titulo']);
$descripcion=mysqli_real_escape_string($conexion, $_POST['descripcion']);
$fecha= $_POST['fecha_de_vencimiento'];
$prioridad=mysqli_real_escape_string($conexion, $_POST['prioridad']);
$estado=mysqli_real_escape_string($conexion, $_POST['estado']);

if(empty($fecha)){
    $fecha=Null;
}

$stmt= $conexion->prepare("INSERT INTO tareas(titulo, descripcion, fecha_de_vencimiento, prioridad, estado, id_usuario)VALUES(?,?,?,?,?,?)");
$stmt-> bind_param("sssssi", $titulo,$descripcion,$fecha,$prioridad,$estado, $id_usuario);

if($stmt->execute()){
    echo "Tarea añadida con exito :D";
    header("Location: ../principal.php");
}else{
    echo "Error al añadir tarea D:". $stmt->error;
}
$stmt->close();
mysqli_close($conexion);
?>