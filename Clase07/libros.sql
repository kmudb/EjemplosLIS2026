CREATE DATABASE IF NOT EXISTS library_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library_db;

CREATE TABLE authors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE books (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author_id INT NOT NULL,
  title VARCHAR(200) NOT NULL,
  year INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_books_author
    FOREIGN KEY (author_id) REFERENCES authors(id)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Datos de ejemplo
INSERT INTO authors (name, email) VALUES
('Gabriel García Márquez', 'gabo@example.com'),
('Isabel Allende', 'isabel@example.com');

INSERT INTO books (author_id, title, year) VALUES
(1, 'Cien años de soledad', 1967),
(2, 'La casa de los espíritus', 1982);