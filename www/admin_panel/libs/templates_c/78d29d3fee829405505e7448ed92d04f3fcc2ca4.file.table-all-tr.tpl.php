<?php /* Smarty version Smarty-3.1.18, created on 2014-11-11 10:53:05
         compiled from "admin_panel\libs\templates\inner-tpl\product\table-all-tr.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12902543b6d7ae5fb53-51678115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78d29d3fee829405505e7448ed92d04f3fcc2ca4' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\product\\table-all-tr.tpl',
      1 => 1415699570,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12902543b6d7ae5fb53-51678115',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543b6d7b1c9781_95219142',
  'variables' => 
  array (
    'num_all' => 0,
    'classHidden' => 0,
    'title_all' => 0,
    'title_all_eng' => 0,
    'edit_all_full' => 0,
    'edit_all_key' => 0,
    'del_all' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543b6d7b1c9781_95219142')) {function content_543b6d7b1c9781_95219142($_smarty_tpl) {?><tr class="submenu_td3">
    <td width="45%" id="td_all_<?php echo $_smarty_tpl->tpl_vars['num_all']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['classHidden']->value;?>
><?php echo $_smarty_tpl->tpl_vars['title_all']->value;?>
</td>
    <td width="35%"><?php echo $_smarty_tpl->tpl_vars['title_all_eng']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['edit_all_full']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['edit_all_key']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['del_all']->value;?>
</td>
</tr><?php }} ?>
