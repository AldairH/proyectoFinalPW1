CREATE DATABASE IF NOT EXISTS gestorDeTareas CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE gestorDeTareas;


CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nomUsuario VARCHAR(255) NOT NULL,
    correoE VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tareas (
    id_tarea INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha_de_vencimiento DATE,
    prioridad ENUM('Alta', 'Media', 'Baja') DEFAULT 'Media',
    estado ENUM('Pendiente', 'En Progreso', 'Completada') DEFAULT 'Pendiente',
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

INSERT INTO usuario (nombre, correoE, contraseña) VALUES
('Usuario de prueba', 'test@example.com', '12345');

INSERT INTO tareas (id_usuario, titulo, descripcion, fecha_de_vencimiento, prioridad, estado) VALUES
(1, 'Primera Tarea', 'Descripción de ejemplo', '2024-12-01', 'Alta', 'Pendiente');