<?php
/* Smarty version 4.0.0, created on 2022-03-17 09:03:09
  from '/mnt/c/htdocs2/DWES04_SOL/templates/listactivos.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_6232eb3d4e9eb4_54299186',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b85d503abc8633ae63e1128c8643c9e4381305ca' => 
    array (
      0 => '/mnt/c/htdocs2/DWES04_SOL/templates/listactivos.html',
      1 => 1641667488,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6232eb3d4e9eb4_54299186 (Smarty_Internal_Template $_smarty_tpl) {
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
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Empresa de mantenimiento</th>
            <th>Persona/contacto de mantenimiento</th>
            <th>Teléfono</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['activos']->value, 'activo');
$_smarty_tpl->tpl_vars['activo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['activo']->value) {
$_smarty_tpl->tpl_vars['activo']->do_else = false;
?>
        <tr>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['activo']->value->getId();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['activo']->value->getNombre();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['activo']->value->getDescripcion();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['activo']->value->getEmpresamnt();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['activo']->value->getContactomnt();?>

            </td>
            <td>
                <?php echo $_smarty_tpl->tpl_vars['activo']->value->getTelefonomnt();?>

            </td>
            <td>
                <form action="borraractivo" method="post">
                    <input type='hidden' name='idactivo' value='<?php echo $_smarty_tpl->tpl_vars['activo']->value->getId();?>
'>
                    <input type="submit" value="¡Borrar!">
                </form>
                <form action="editactivo" method="post">
                    <input type='hidden' name='idactivo' value='<?php echo $_smarty_tpl->tpl_vars['activo']->value->getId();?>
'>
                    <input type="submit" value="Editar">
                </form>
            </td>
        </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
<a href='<?php echo $_smarty_tpl->tpl_vars['rootpath']->value;?>
'>Volver</a><?php }
}
