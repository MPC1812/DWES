<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Añadir libro</title>
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
</style>
<form action="/dwes04/index.php?accion=borrar_libro_MPC" method="post">
<input type="checkbox" name="checkboxborrar" value="checkboxborrar">
<button type="submit" name="accion" class="btn btn-dark btn-sm" value="confirmar">
<input type="hidden" value="{$idborrar}" name="borrar">
<input type="hidden" value="TEST" name="control">
¿Está seguro de que desea borrar el libro?
</button>
</form>
    </form>
    </html>