CREATE DATABASE impresoras_db;

CREATE TABLE impresoras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo enum('inyección de tinta', 'láser', 'matricial') NOT NULL,
    nombre varchar(45) NOT NULL,
);


INSERT INTO impresoras (tipo, nombre) VALUES ('inyección de tinta', 'Impresora DPTO Informática');
INSERT INTO impresoras (tipo, nombre) VALUES ('láser', 'Impresora DPTO Matemáticas');