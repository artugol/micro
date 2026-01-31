-- Crear base de datos
CREATE DATABASE IF NOT EXISTS microframework_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE microframework_db;

-- Tabla de artículos
CREATE TABLE IF NOT EXISTS articulos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla de nombres
CREATE TABLE IF NOT EXISTS nombres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telefono VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Datos de ejemplo para artículos
INSERT INTO articulos (titulo, descripcion, precio, stock) VALUES
('Laptop Dell XPS 13', 'Laptop ultraportátil con procesador Intel i7', 1299.99, 15),
('Mouse Logitech MX Master', 'Mouse ergonómico inalámbrico', 99.99, 50),
('Teclado Mecánico Keychron K2', 'Teclado mecánico compacto', 79.99, 30),
('Monitor LG UltraWide 34"', 'Monitor curvo de 34 pulgadas', 499.99, 10),
('Auriculares Sony WH-1000XM4', 'Auriculares con cancelación de ruido', 349.99, 25);

-- Datos de ejemplo para nombres
INSERT INTO nombres (nombre, apellidos, email, telefono) VALUES
('Juan', 'García López', 'juan.garcia@email.com', '+34 600 123 456'),
('María', 'Martínez Sánchez', 'maria.martinez@email.com', '+34 610 234 567'),
('Carlos', 'Rodríguez Pérez', 'carlos.rodriguez@email.com', '+34 620 345 678'),
('Ana', 'Fernández Gómez', 'ana.fernandez@email.com', '+34 630 456 789'),
('Pedro', 'López Díaz', 'pedro.lopez@email.com', '+34 640 567 890');
