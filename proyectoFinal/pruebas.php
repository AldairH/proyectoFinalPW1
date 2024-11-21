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
        /* Estilo para la descripción, permitiendo desplazamiento vertical */
        .descripcion-tarea {
            max-width: 200px; /* Limitar ancho de la celda */
            height: 80px; /* Establecer altura máxima */
            overflow-y: auto; /* Permitir el desplazamiento vertical */
            word-wrap: break-word; /* Asegura que el texto se ajuste a la celda */
        }
        
        .estado {
            width: 150px; /* Ancho fijo para la columna de estado */
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1> Hola $correoE! :D </h1>
        <a href='Logica/logout.php' class='btn waves-effect waves-light'>Exit</a>";

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
        echo "<h2>Tareas obtenidas.</h2>";
        echo "<table class='striped'>
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
            
            // Mostrar la descripción completa y con desplazamiento vertical
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
echo "<a href='./agregarTarea.php' class='btn green'>Agregar Tarea</a>";
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

<!-- Importar jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Importar Materialize JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script>
    // Inicializar componentes de Materialize (si es necesario)
    M.AutoInit();
</script>

</body>
</html>
