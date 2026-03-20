CREATE DATABASE login_db;

USE login_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL DEFAULT 'usuario'
);

-- Usuario admin de prueba
INSERT INTO usuarios (usuario, password, rol) 
VALUES ('admin', '$2y$10$U6u1TzsyD2vKShzMPn5mQeXjJ5Xq2q2iO2sfOObl6PyQ5n8l7f7/6', 'admin'); 
-- contraseña: 1234