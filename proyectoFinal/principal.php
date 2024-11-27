<?php
session_start();
$correoE= $_SESSION['username'];

if(!isset($correoE)){
    header("location: ./index.php");
    exit();
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Principal - Tareas</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='./Styles/style.css'>
</head>
<body> 

<div class='container'>";
include "./Includes/header.php";
require "./Logica/conexion.php";
mysqli_set_charset($conexion, 'utf8');

$query = "SELECT id_usuario FROM usuario WHERE correoE='$correoE'";
$resultado = mysqli_query($conexion,$query);

if($resultado && mysqli_num_rows($resultado) > 0){
    $fila = mysqli_fetch_assoc($resultado);
    $id_usuario = $fila['id_usuario'];

    $consulta_sql = "SELECT * FROM tareas WHERE id_usuario = $id_usuario";
    $resultado_tareas = mysqli_query($conexion, $consulta_sql);

    if($resultado_tareas && mysqli_num_rows($resultado_tareas)>0){
        echo "<table class='tabla-contenedor'>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha de Vencimiento</th>
                        <th>Prioridad</th>
                        <th class='estado'>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>";

        while($row = mysqli_fetch_assoc($resultado_tareas)){
            echo "<tr>";
            echo "<td>". $row['titulo'] ."</td>";
            echo "<td class='descripcion-tarea'>". $row['descripcion'] ."</td>";
            echo "<td>". $row['fecha_de_vencimiento'] ."</td>";
            echo "<td>". $row['prioridad'] ."</td>";
            echo "<td class='estado'>
                    <form action='./Logica/updateStatus.php' method='POST'>
                        <input type='hidden' name='id_tarea' value='" .$row['id_tarea']."'>
                        <select name='nuevo_estado' onchange='this.form.submit()'>
                            <option value='Pendiente' ". ($row['estado'] === 'Pendiente' ? "selected" : "").">Pendiente</option>
                            <option value='En Progreso' ". ($row['estado'] === 'En Progreso' ? "selected" : "").">En Progreso</option>
                            <option value='Completada' ". ($row['estado'] === 'Completada' ? "selected" : "").">Completada</option>
                        </select>
                    </form>
                </td>";
            echo "<td><a href='#' onclick='ConfirmarEliminacion(" . $row['id_tarea']. ")' class='btn red'>Eliminar</a></td>";
            echo "<td><a href='./editarTarea.php?id_tarea=" . $row['id_tarea'] . "' class='btn blue'>Editar</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }else{
        echo "<div class='no-tasks-message'>
                <i class='material-icons'>assignment</i>
                <span>¡No hay tareas por el momento!</span>
            </div>";
    }
}else{
    echo "<h2>Error ID</h2>";
}
echo "<div style='text-align: right; margin-bottom: 20px;'>
        <a href='./agregarTarea.php' class='btn waves-effect waves-light'>Agregar Tarea</a>
      </div>";

mysqli_close($conexion);

echo "</div>";

include "./Includes/footer.php";
?>
<script>
function ConfirmarEliminacion(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
        window.location.href = `Logica/deleteTask.php?id=${id}`;
    }
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    M.AutoInit();
</script>