<?php
/* Smarty version 4.5.5, created on 2025-03-03 21:05:17
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\formlibro.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67c60b7d8fed65_13066462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '46d116d65fe5b6328caaf381ebb4c6b874a73986' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\formlibro.tpl',
      1 => 1741032315,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c60b7d8fed65_13066462 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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

</html><?php }
}
