<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dwes04</title>
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
    <a href="/dwes04/index.php?accion=nuevo_libro_form_MPC">Añadir Libro</a>
    <a href="/dwes04/index.php?accion=borrar_libro_MPC">Borrar Libro</a>
    <a href="/dwes04/mostrarlibros">Mostrar Libros</a>
    <a href="/dwes04/index.php" class="main-page">Página Principal</a>
</div>

</body>
</html>
