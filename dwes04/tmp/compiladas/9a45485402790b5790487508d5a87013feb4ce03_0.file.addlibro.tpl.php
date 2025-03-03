<?php
/* Smarty version 4.5.5, created on 2025-03-03 20:06:17
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\addlibro.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67c5fda9e9c076_82918527',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a45485402790b5790487508d5a87013feb4ce03' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\addlibro.tpl',
      1 => 1741028775,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c5fda9e9c076_82918527 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=100%, initial-scale=1.0">
    <title>Añadir/Modificar libro</title>
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
    <form action="/dwes04/index.php?accion=nuevo_libro_form_MPC" method="post">
        <input type="text" name="isbn" placeholder="ISBN" required>
        <input type="text" name="titulo" placeholder="Título" required>
        <input type="text" name="autor" placeholder="Autor" required>
        <input type="text" name="anio" placeholder="Año de publicación" required>
        <input type="text" name="paginas" placeholder="Número de páginas" required>
        <input type="text" name="ejemplares" placeholder="Ejemplares disponibles" required>
        <button type="submit" name="addlibro" class="btn btn-dark btn-sm">AÑADIR LIBRO</button>
    </form>
</body>

</html><?php }
}
