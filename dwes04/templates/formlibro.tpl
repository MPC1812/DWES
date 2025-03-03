<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>dwes04</title>
</head>
<style>
    table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    table thead tr {
        background-color: #3e8e41;
        color: #ffffff;
        text-align: left;
    }

    table th,
    table td {
        padding: 12px 15px;
    }

    form {
        margin-top: 1em;
    }
</style>

<body>
{* Si los campos son obligatorios me gusta usar required para evitar olvidar algun campo pero
en este caso no es necesario ya que vamos a procesar los datos recibidos *}
    <form action="/dwes04/index.php?accion=crear_libro_MPC" method="post">
        <input type="text" name="isbn" placeholder="ISBN" >
        <input type="text" name="titulo" placeholder="Título" >
        <input type="text" name="autor" placeholder="Autor" >
        <input type="text" name="anio" placeholder="Año de publicación" >
        <input type="text" name="paginas" placeholder="Número de páginas" >
        <input type="text" name="ejemplares" placeholder="Ejemplares disponibles" >
        <button type="submit" action="crear_libro_MPC" name="addlibro" class="btn btn-dark btn-sm">AÑADIR LIBRO</button>
    </form>
</body>

</html>