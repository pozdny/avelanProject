<?php /* Smarty version Smarty-3.1.18, created on 2014-10-21 09:27:29
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\inputSubmenuTd.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31003543beeef774e17-23215617%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55d23ee2c0755ddb90b3df23d6f0e37548603d15' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\inputSubmenuTd.tpl',
      1 => 1413876441,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31003543beeef774e17-23215617',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543beeef7f9af6_86119197',
  'variables' => 
  array (
    'del_td' => 0,
    'num_id' => 0,
    'classHidden' => 0,
    'title' => 0,
    'edit_full' => 0,
    'edit_key' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543beeef7f9af6_86119197')) {function content_543beeef7f9af6_86119197($_smarty_tpl) {?><tr>
    <?php echo $_smarty_tpl->tpl_vars['del_td']->value;?>

    <td width="10%"><?php echo $_smarty_tpl->tpl_vars['num_id']->value;?>
</td>
    <td width="70%" <?php echo $_smarty_tpl->tpl_vars['classHidden']->value;?>
><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</td>
    <td align="center" width="5%"><?php echo $_smarty_tpl->tpl_vars['edit_full']->value;?>
</td>
    <td align="center" width="5%"><?php echo $_smarty_tpl->tpl_vars['edit_key']->value;?>
</td>
</tr><?php }} ?>
