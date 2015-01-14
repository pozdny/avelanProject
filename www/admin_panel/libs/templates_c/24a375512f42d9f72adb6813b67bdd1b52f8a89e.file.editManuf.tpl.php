<?php /* Smarty version Smarty-3.1.18, created on 2014-10-14 18:22:13
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\editManuf.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1272543d4db51645f4-66267672%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '24a375512f42d9f72adb6813b67bdd1b52f8a89e' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\editManuf.tpl',
      1 => 1413208286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1272543d4db51645f4-66267672',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'style' => 0,
    'id_desc_foto' => 0,
    'name_select' => 0,
    'select_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543d4db51730d8_11600526',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543d4db51730d8_11600526')) {function content_543d4db51730d8_11600526($_smarty_tpl) {?><tr><td <?php echo $_smarty_tpl->tpl_vars['style']->value;?>
><label for="<?php echo $_smarty_tpl->tpl_vars['id_desc_foto']->value;?>
">Производитель:</label></td></tr>
<tr>
    <td>
        <select id="<?php echo $_smarty_tpl->tpl_vars['name_select']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['name_select']->value;?>
">
            <?php echo $_smarty_tpl->tpl_vars['select_item']->value;?>

        </select>
    </td>
</tr>
<?php }} ?>
