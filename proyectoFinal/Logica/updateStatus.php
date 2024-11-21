<?php
include "./conexion.php";
mysqli_set_charset($conexion, 'utf8');
session_start();

$id_tarea = intval($_POST['id_tarea']);
$nuevo_estado = htmlspecialchars($_POST['nuevo_estado']);
$correoE = $_SESSION['username'];

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

$estados_validos = ['Pendiente', 'En Progreso', 'Completada'];
if (!in_array($nuevo_estado, $estados_validos)) {
    echo "Estado no valido >:V";
    exit();
}

$query = "SELECT id_usuario FROM usuario WHERE correoE = '$correoE'";
$resultado_usuario = mysqli_query($conexion, $query);   

if ($resultado_usuario && mysqli_num_rows($resultado_usuario) > 0) {
    $fila = mysqli_fetch_assoc($resultado_usuario);
    $id_usuario = $fila['id_usuario'];
} else {
    echo "Usuario no encontrado D:";
    exit();
}

$stmt_verify = $conexion->prepare("SELECT id_tarea FROM tareas WHERE id_tarea = ? AND id_usuario = ?");
$stmt_verify->bind_param("ii", $id_tarea, $id_usuario);
$stmt_verify->execute();
$resultado_verificacion = $stmt_verify->get_result();
if ($resultado_verificacion->num_rows === 0) {
    echo "La tarea no pertenece al usuario :/";
    exit();
}

$stmt = $conexion->prepare("UPDATE tareas SET estado = ? WHERE id_tarea = ?");
$stmt->bind_param("si", $nuevo_estado, $id_tarea);

if($stmt->execute()){
    echo "Estado actualizado :D";
}else{
    echo "Error al actualizar D:".$stmt->error;
}

$stmt->close();
$stmt_verify->close();
$conexion->close();
header("Location: ../principal.php");
exit();

?>