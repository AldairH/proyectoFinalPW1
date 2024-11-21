<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php?login=required");
    exit();
}
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
                <form action="./Logica/addTask.php" method="POST">

                    <!-- Titulo -->
                    <div class="input-field">
                        <label for="titulo">Titulo:</label>
                        <input type="text" name="titulo" id="titulo" required>
                    </div>

                    <!-- Descripcion -->
                    <div class="input-field">
                        <label for="descripcion">Descripcion:</label>
                        <textarea name="descripcion" id="descripcion" class="materialize-textarea" required></textarea>
                    </div>

                    <!-- Fecha de Vencimiento -->
                    <div class="input-field">
                        <input type="date" name="fecha_de_vencimiento" id="fecha_de_vencimiento">
                        <label for="fecha_de_vencimiento">Fecha de Vencimiento</label>
                    </div>


                    <!-- Prioridad -->
                    <div class="input-field">
                            <select name="prioridad" id="prioridad" required>
                                <option value="" disabled selected>Selecciona una prioridad</option>
                                <option value="Baja">Baja</option>
                                <option value="Media">Media</option>
                                <option value="Alta">Alta</option>
                             </select>
                        <label>Prioridad</label>
                    </div>

                    <!-- Estado-->
                    <div class="input-field">
                       <select name="estado" id="estado" required>
                           <option value="" disabled selected>Selecciona un estado</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Progreso">En Progreso</option>
                          <option value="Completada">Completada</option>
                        </select>
                        <label>Estado</label>
                    </div>

                    <!-- Botón de guardar cambios -->
                    <div class="center-align">
                        <button type="submit" class="btn blue darken-2">Añadir Tarea</button>
                       <a href="principal.php" class="btn-flat">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            M.FormSelect.init(elems);
        });
    </script>
</body>
</html>