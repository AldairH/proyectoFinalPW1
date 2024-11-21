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
    <!-- Importar Materialize CSS -->
    <link href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css' rel='stylesheet'>
    
    <style>
    .tabla-contenedor {
        border-radius: 10px; /* Bordes redondeados */
        overflow: hidden; /* Asegura que las esquinas redondeadas no se corten */
        border: 2px solid #ddd; /* Borde sutil alrededor del contenedor */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra suave */
        padding: 20px; /* Un poco de relleno alrededor */
        background-color: #fff; /* Fondo blanco para el contenedor */
    }
    
    /* Estilo para la tabla */
    table.striped {
        border-radius: 8px; /* Bordes redondeados en la tabla */
    }

    .descripcion-tarea {
        max-width: 200px;
        height: 80px;
        overflow-y: auto;
        word-wrap: break-word;
    }

    .estado {
        width: 150px;
    }
</style>

</head>
<body> 
    <?php include('../Includes/header.php'); ?>
    <div class='container'>";
    
require "./Logica/conexion.php";
mysqli_set_charset($conexion, 'utf8');

$query = "SELECT id_usuario, nomUsuario FROM usuario WHERE correoE='$correoE'";
$resultado = mysqli_query($conexion,$query);

if($resultado && mysqli_num_rows($resultado) > 0){
    $fila = mysqli_fetch_assoc($resultado);
    $id_usuario = $fila['id_usuario'];
    $nomUsuario = $fila['nomUsuario'];

    echo "<h1>Hola $nomUsuario ! :D </h1>";
    echo "<a href='Logica/logout.php' class='btn waves-effect waves-light'>Exit</a>";

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
                
            echo "<td><a href='#' onclick='ConfirmarEliminacion(" . $row['id_tarea']. ")' class='btn red'>Delete</a></td>";
            echo "<td><a href='./editarTarea.php?id_tarea=" . $row['id_tarea'] . "' class='btn blue'>Editar</a></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }else{
        echo "<h2>No hay tareas</h2>";
    }
}else{
    echo "<h2>Error ID</h2>";
}
echo "<a href='./agregarTarea.php' class='btn waves-effect waves-light'>Agregar Tarea</a>";
mysqli_close($conexion);

echo "</div>";

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

</body>
</html>
