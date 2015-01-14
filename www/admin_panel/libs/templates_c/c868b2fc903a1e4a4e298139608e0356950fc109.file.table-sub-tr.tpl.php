<?php /* Smarty version Smarty-3.1.18, created on 2014-11-11 10:53:05
         compiled from "admin_panel\libs\templates\inner-tpl\product\table-sub-tr.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17287543b6ffb7eb2e0-43552057%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c868b2fc903a1e4a4e298139608e0356950fc109' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\product\\table-sub-tr.tpl',
      1 => 1415699570,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17287543b6ffb7eb2e0-43552057',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543b6ffb89a519_80917794',
  'variables' => 
  array (
    'num_sub' => 0,
    'classHidden' => 0,
    'title_sub' => 0,
    'title_sub_eng' => 0,
    'edit_sub_full' => 0,
    'edit_sub_key' => 0,
    'del_sub' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543b6ffb89a519_80917794')) {function content_543b6ffb89a519_80917794($_smarty_tpl) {?><tr class="submenu_td2">
    <td id="td_sub_<?php echo $_smarty_tpl->tpl_vars['num_sub']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['classHidden']->value;?>
><?php echo $_smarty_tpl->tpl_vars['title_sub']->value;?>
</td>
    <td ><?php echo $_smarty_tpl->tpl_vars['title_sub_eng']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['edit_sub_full']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['edit_sub_key']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['del_sub']->value;?>
</a></td>
</tr><?php }} ?>
