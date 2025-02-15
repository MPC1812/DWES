CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    hash_contraseña VARCHAR(255) NOT NULL) ENGINE=InnoDB;

CREATE TABLE mascotas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    publica ENUM('si', 'no') NOT NULL DEFAULT 'no',
    CONSTRAINT fk_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO usuarios (login, hash_contraseña) VALUES
('test1', SHA2(CONCAT(REVERSE('test1'), 'TEST', '_28381TXF'), 256)),
('test2', SHA2(CONCAT(REVERSE('test2'), 'TEST', '_28381TXF'), 256)),
('test3', SHA2(CONCAT(REVERSE('test3'), 'TEST', '_28381TXF'), 256)),
('test4', SHA2(CONCAT(REVERSE('test4'), 'TEST', '_28381TXF'), 256)),
('test5', SHA2(CONCAT(REVERSE('test5'), 'TEST', '_28381TXF'), 256));

INSERT INTO mascotas (usuario_id, nombre, tipo, publica) VALUES
(1, 'Max', 'Perro', 'si'),
(1, 'Luna', 'Gato', 'no');
INSERT INTO mascotas (usuario_id, nombre, tipo, publica) VALUES
(2, 'Rocky', 'Pájaro', 'si'),
(2, 'Molly', 'Perro', 'no');
INSERT INTO mascotas (usuario_id, nombre, tipo, publica) VALUES
(3, 'Simba', 'Gato', 'si'),
(3, 'Bobby', 'Pájaro', 'no');
INSERT INTO mascotas (usuario_id, nombre, tipo, publica) VALUES
(4, 'Charlie', 'Perro', 'si'),
(4, 'Chirpy', 'Gato', 'no');
INSERT INTO mascotas (usuario_id, nombre, tipo, publica) VALUES
(5, 'Tweety', 'Pájaro', 'si'),
(5, 'Bella', 'Perro', 'no');