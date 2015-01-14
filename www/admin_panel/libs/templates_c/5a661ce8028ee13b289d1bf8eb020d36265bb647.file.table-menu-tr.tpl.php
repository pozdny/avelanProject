<?php /* Smarty version Smarty-3.1.18, created on 2014-11-11 10:53:04
         compiled from "admin_panel\libs\templates\inner-tpl\product\table-menu-tr.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32477543b729aa19550-41806797%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a661ce8028ee13b289d1bf8eb020d36265bb647' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\product\\table-menu-tr.tpl',
      1 => 1415699570,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32477543b729aa19550-41806797',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543b729aa606e2_06939163',
  'variables' => 
  array (
    'submenu_td' => 0,
    'num' => 0,
    'classHidden' => 0,
    'title' => 0,
    'title_eng' => 0,
    'edit_full' => 0,
    'edit_key' => 0,
    'del' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543b729aa606e2_06939163')) {function content_543b729aa606e2_06939163($_smarty_tpl) {?><tr class="<?php echo $_smarty_tpl->tpl_vars['submenu_td']->value;?>
">
    <td id="td_<?php echo $_smarty_tpl->tpl_vars['num']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['classHidden']->value;?>
 ><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</td>
    <td ><?php echo $_smarty_tpl->tpl_vars['title_eng']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['edit_full']->value;?>
'</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['edit_key']->value;?>
</td>
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['del']->value;?>
</td>
</tr>
<?php }} ?>
