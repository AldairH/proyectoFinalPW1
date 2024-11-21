<?php
include "./conexion.php";

if(isset($_GET['id'])){
    $id_tarea = $_GET['id'];

    $query= "DELETE FROM tareas WHERE id_tarea=?";
    $stmt = $conexion->prepare($query);
    $stmt ->bind_param("i", $id_tarea);

    if($stmt->execute()){
        echo "La tarea se elemio exitosamente :D";
        header("Location: ../principal.php");
        exit();
    }else{
        echo "Error al eliminar tarea D:";
    }
    $stmt->close();
    mysqli_close($conexion);
}
?>