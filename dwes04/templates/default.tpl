<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Página principal</title>
</head>

<body>
    {if isset($rutanoexistente)}
        <P>ERROR: la ruta {$rutanoexistente} no existe</P>
    {/if}
    <H1>Acciones</H1>
    <p><a href='/addlibro'><input type="button" value="Añadir libro"></a>
    <a href='/borrarlibro'><input type="button" value="Borrar Libro"></a>
    <a href='/mostrarlibros'><input type="button" value="Mostrar Libros"></a></p>
    {* <p><a href='{$rootpath}/mostrarlibros'><input type="button" value="Mostrar libros"></a></p> *}
</body>

</html>