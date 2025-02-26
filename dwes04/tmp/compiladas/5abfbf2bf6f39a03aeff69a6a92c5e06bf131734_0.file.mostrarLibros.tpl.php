<?php
/* Smarty version 4.5.5, created on 2025-02-26 17:58:30
  from 'M:\00.Datos de Usuario\Documents\MEGA\01.DWES\htdocs\dwes\dwes04\templates\mostrarLibros.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_67bf483690f1e4_00286880',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5abfbf2bf6f39a03aeff69a6a92c5e06bf131734' => 
    array (
      0 => 'M:\\00.Datos de Usuario\\Documents\\MEGA\\01.DWES\\htdocs\\dwes\\dwes04\\templates\\mostrarLibros.tpl',
      1 => 1740589018,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67bf483690f1e4_00286880 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
    table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }

    table th,
    table td {
        padding: 12px 15px;
    }
</style>
<table border="1px solid blue">
    <thead>
        <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Año de publicación</th>
            <th>Número de páginas</th>
            <th>Ejemplares disponibles</th>
            <th>Fecha de creación</th>
            <th>Fecha de actualización</th>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listadolibros']->value, 'libro');
$_smarty_tpl->tpl_vars['libro']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['libro']->value) {
$_smarty_tpl->tpl_vars['libro']->do_else = false;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getId();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getIsbn();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getTitulo();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getAutor();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getAnioPublicacion();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getPaginas();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getEjemplaresDisponibles();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getFechaCreacion();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['libro']->value->getFechaActualizacion();?>
</td>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<a href='/index.php'><button type="submit" name="home" class="btn btn-dark btn-sm">PÁGINA PRINCIPAL</button></a><?php }
}
