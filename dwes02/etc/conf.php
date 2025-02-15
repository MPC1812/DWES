<!-- Mario Puerma Cortés -->
<?php

define ('DB_HOSTNAME', 'localhost'); //host de la base de datos
define ('DB_PORT', '3306'); //puerto de la base de datos
define ('DB_USER', 'root'); //usuario de la base de datos
define ('DB_PASS', ''); //clave de la base de datos
define ('DB_NAME', 'dwes02'); //nombre de la base de datos

//Constante para la conexión a la base de datos
define  ('DB_DSN', 'mysql:host='.DB_HOSTNAME.';port='.DB_PORT.';dbname='.DB_NAME);

//Constante para las categoria de los productos
define('CATEGORIAS', ['lacteos', 'conservas', 'bebidas', 'snacks', 'dulces', 'otros']);

?>