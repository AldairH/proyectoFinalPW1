<?php
include './Logica/conexion.php';
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php?login=required");
    exit();
}

$id_tarea=intval($_GET['id_tarea']);

$query="SELECT * FROM tareas WHERE id_tarea=?";
$stmt= $conexion->prepare($query);
$stmt->bind_param("i", $id_tarea);
$stmt->execute();
$resultado=$stmt->get_result();

if ($resultado && $resultado->num_rows > 0){
    $tarea= $resultado->fetch_assoc();
}else{
    echo "Tarea no encontrada :c";
    exit();
}
$stmt->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div class="container">
        <h3>Editar Tarea</h3>
        <div class="card">
            <div class="card-content">
                <form action="./Logica/updateTask.php" method="POST">
                    <input type="hidden" name="id_tarea" value="<?= $tarea['id_tarea'] ?>">

                    <!-- Titulo -->
                    <div class="input-field">
                        <label for="titulo">Titulo:</label>
                        <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($tarea['titulo']) ?>" required>
                    </div>

                    <!-- Descripcion -->
                    <div class="input-field">
                        <label for="descripcion">Descripcion:</label>
                        <textarea name="descripcion" id="descripcion" class="materialize-textarea" required><?= htmlspecialchars($tarea['descripcion']) ?></textarea>
                    </div>

                    <!-- Fecha de Vencimiento -->
                    <div class="input-field">
                        <label for="fecha_de_vencimiento">Fecha de Vencimiento:</label>
                        <input type="date" name="fecha_de_vencimiento" id="fecha_de_vencimiento" value="<?= $tarea['fecha_de_vencimiento'] ?>">
                    </div>

                    <!-- Prioridad -->
                    <div class="input-field">
                        <select name="prioridad" id="prioridad">
                            <option value="Baja" <?= $tarea['prioridad'] === 'Baja' ? 'selected' : '' ?>>Baja</option>
                            <option value="Media" <?= $tarea['prioridad'] === 'Media' ? 'selected' : '' ?>>Media</option>
                            <option value="Alta" <?= $tarea['prioridad'] === 'Alta' ? 'selected' : '' ?>>Alta</option>
                        </select>
                        <label for="prioridad">Prioridad</label>
                    </div>


                    <!-- Botón de guardar cambios -->
                    <div class="input-field">
                        <button type="submit" class="btn waves-effect waves-light">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>
</body>
</html>