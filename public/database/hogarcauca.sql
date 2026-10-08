CREATE DATABASE IF NOT EXISTS hogarcauca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hogarcauca;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(30) DEFAULT '',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE propiedades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(180) NOT NULL,
    descripcion TEXT NOT NULL,
    tipo ENUM('casa','apartamento','lote','local') NOT NULL,
    operacion ENUM('venta','arriendo') NOT NULL,
    precio DECIMAL(12,2) NOT NULL,
    ciudad VARCHAR(120) NOT NULL,
    direccion VARCHAR(180) NOT NULL,
    habitaciones INT DEFAULT 0,
    banos INT DEFAULT 0,
    area INT DEFAULT 0,
    imagen VARCHAR(255) DEFAULT 'public/images/logo.png',
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE favoritos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    propiedad_id INT NOT NULL,
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_favorito (usuario_id, propiedad_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (propiedad_id) REFERENCES propiedades(id) ON DELETE CASCADE
);

INSERT INTO usuarios (nombre, email, password, telefono) VALUES
('Administrador', 'admin@hogarcauca.com', '$2y$10$7k9Q4q8L0zKQ4kQPHN4e6Oa1gVF7ynz5VQz1VMMjvlfnKX3d5J9Lm', '3000000000');

INSERT INTO propiedades (usuario_id, titulo, descripcion, tipo, operacion, precio, ciudad, direccion, habitaciones, banos, area, imagen) VALUES
(1, 'Casa moderna en Popayán', 'Amplia casa con excelente iluminación natural, dos baños, patio y cocina moderna.', 'casa', 'venta', 280000000.00, 'Popayán', 'Cra 4 # 20-45', 3, 2, 120, 'public/images/logo.png'),
(1, 'Apartamento moderno', 'Apartamento con acabados premium y vista a la ciudad.', 'apartamento', 'venta', 195000000.00, 'Popayán', 'Cl 15 # 8-34', 2, 2, 75, 'public/images/logo.png'),
(1, 'Casa familiar en conjunto', 'Hermosa vivienda familiar con zona de parque y amplio jardín.', 'casa', 'arriendo', 1400000.00, 'Popayán', 'Av 7 # 22-10', 4, 3, 150, 'public/images/logo.png');

INSERT INTO favoritos (usuario_id, propiedad_id) VALUES
(1, 1),
(1, 3);