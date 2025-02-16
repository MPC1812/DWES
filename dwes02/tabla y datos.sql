CREATE TABLE productos
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(30) NOT NULL,
    codigo_ean VARCHAR(13) NOT NULL UNIQUE,
    categoria ENUM('lacteos', 'conservas', 'bebidas', 'snacks', 'dulces', 'otros') NOT NULL,
    propiedades SET('sin gluten', 'sin lactosa', 'vegano', 'orgánico', 'sin conservantes', 'sin colorantes') DEFAULT NULL,
    unidades INT NOT NULL CHECK (unidades > 0),
    precio DECIMAL(10, 2) NOT NULL CHECK (precio > 0)
);

INSERT INTO productos (nombre, codigo_ean, categoria, propiedades, unidades, precio) VALUES
('Leche Entera', '8412345678901', 'lacteos', 'sin gluten', 50, 1.15),
('Yogur Desnatado', '8412345678902', 'lacteos', 'sin gluten,sin lactosa', 30, 0.95),
('Queso Vegano', '8412345678903', 'lacteos', 'vegano,sin gluten,orgánico', 20, 3.25),
('Conserva de Atún', '8412345678904', 'conservas', 'sin conservantes', 100, 2.50),
('Conserva de Sardinas', '8412345678905', 'conservas', NULL, 70, 1.90),
('Coca Cola', '8412345678906', 'bebidas', NULL, 200, 1.00),
('Zumo de Naranja', '8412345678907', 'bebidas', 'sin conservantes', 150, 2.10),
('Té Verde', '8412345678908', 'bebidas', 'orgánico', 40, 3.50),
('Patatas Fritas', '8412345678909', 'snacks', 'sin gluten,sin conservantes', 90, 1.75),
('Palomitas de Maíz', '8412345678910', 'snacks', NULL, 60, 1.50),
('Galletas Integrales', '8412345678911', 'dulces', 'sin gluten,vegano', 80, 2.85),
('Chocolate Negro', '8412345678912', 'dulces', 'orgánico', 120, 1.90),
('Chicles Sin Azúcar', '8412345678913', 'dulces', 'sin gluten', 300, 0.95),
('Pan Sin Gluten', '8412345678914', 'otros', 'sin gluten', 50, 3.25),
('Tortillas de Maíz', '8412345678915', 'otros', 'sin gluten,sin conservantes', 75, 2.50),
('Leche de Avena', '8412345678916', 'lacteos', 'vegano,orgánico', 60, 2.10),
('Conserva de Pimientos', '8412345678917', 'conservas', 'sin conservantes,orgánico', 40, 3.10),
('Agua Mineral', '8412345678918', 'bebidas', NULL, 500, 0.60),
('Bebida Energética', '8412345678919', 'bebidas', NULL, 200, 1.50),
('Chips de Vegetales', '8412345678920', 'snacks', 'vegano,orgánico', 90, 2.75),
('Barritas de Cereal', '8412345678921', 'dulces', 'sin gluten,vegano', 150, 1.80),
('Galletas con Chocolate', '8412345678922', 'dulces', NULL, 80, 2.10),
('Pan Integral', '8412345678923', 'otros', 'orgánico', 60, 2.50),
('Mantequilla Sin Lactosa', '8412345678924', 'lacteos', 'sin lactosa', 50, 2.35),
('Conserva de Champiñones', '8412345678925', 'conservas', 'sin conservantes', 55, 2.40),
('Cerveza Sin Alcohol', '8412345678926', 'bebidas', 'sin conservantes', 120, 0.95),
('Tostadas Integrales', '8412345678927', 'snacks', 'sin gluten,orgánico', 40, 2.15),
('Galletas Veganas', '8412345678928', 'dulces', 'vegano,sin gluten', 90, 3.05),
('Jugo de Manzana', '8412345678929', 'bebidas', 'orgánico', 60, 2.90),
('Conserva de Alubias', '8412345678930', 'conservas', 'sin gluten', 85, 1.95);