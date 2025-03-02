<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Navegación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #4CAF50; /* Tono verde */
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar .main-page {
            float: right;
        }
        .navbar a:hover {
            background-color: #009879;
            
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="/addlibro">Añadir / Modificar Libro</a>
    <a href="/borrarlibro">Borrar Libro</a>
    <a href="/mostrarlibros">Mostrar Libros</a>
    <a href="/index.php" class="main-page">Página Principal</a>
</div>

</body>
</html>
