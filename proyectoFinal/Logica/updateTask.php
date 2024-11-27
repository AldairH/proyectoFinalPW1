<?php
include "./conexion.php";
mysqli_set_charset($conexion, 'utf8');
session_start();

$titulo=mysqli_real_escape_string($conexion, $_POST['titulo']);
$descripcion=mysqli_real_escape_string($conexion, $_POST['descripcion']);
$fecha= $_POST['fecha_de_vencimiento'];    
$prioridad=mysqli_real_escape_string($conexion, $_POST['prioridad']);
$id_tarea=intval($_POST['id_tarea']);

if(empty($fecha)){
    $fecha=Null;
}

$stmt= $conexion->prepare("UPDATE tareas
                            SET titulo=?,
                             descripcion=?,
                             fecha_de_vencimiento=?,
                             prioridad=?
                        WHERE id_tarea=?");
$stmt-> bind_param("ssssi", $titulo,$descripcion,$fecha,$prioridad, $id_tarea);

if($stmt->execute()){
    header("Location: ../principal.php");
}else{
    header("Location: ../principal.php");
}
$stmt->close();
mysqli_close($conexion);
?>