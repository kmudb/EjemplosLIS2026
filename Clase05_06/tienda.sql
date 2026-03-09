-- Crear base de datos (ajústalo si ya existe)
CREATE DATABASE IF NOT EXISTS tienda
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE tienda;

-- Tabla 1: categorias
DROP TABLE IF EXISTS categorias;
CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  descripcion VARCHAR(255) NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla 2: productos (relación con categorias)
DROP TABLE IF EXISTS productos;
CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL,
  precio DECIMAL(10,2) NOT NULL CHECK (precio >= 0),
  categoria_id INT NOT NULL,
  stock INT NOT NULL DEFAULT 0 CHECK (stock >= 0),
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_productos_categorias
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- Datos de ejemplo
INSERT INTO categorias (nombre, descripcion) VALUES
('Bebidas', 'Líquidos, refrescos y jugos'),
('Snacks', 'Galletas, papitas, frutos secos');

INSERT INTO productos (nombre, precio, categoria_id, stock) VALUES
('Jugo de Naranja 1L', 2.50, 1, 50),
('Agua Mineral 600ml', 1.00, 1, 200),
('Galletas Chocolate', 1.75, 2, 120);