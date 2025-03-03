<?php
/* Smarty version 4.5.5, created on 2025-03-03 11:55:40
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\barra.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67c58aacf07720_99818014',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca9e5c84d28c69c060aac8c39ecfc949a4420962' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\barra.tpl',
      1 => 1740999225,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67c58aacf07720_99818014 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
    <a href="/dwes04/addlibro">Añadir Libro</a>
    <a href="/dwes04/borrarlibro">Borrar Libro</a>
    <a href="/dwes04/mostrarlibros">Mostrar Libros</a>
    <a href="/dwes04/index.php" class="main-page">Página Principal</a>
</div>

</body>
</html>
<?php }
}
