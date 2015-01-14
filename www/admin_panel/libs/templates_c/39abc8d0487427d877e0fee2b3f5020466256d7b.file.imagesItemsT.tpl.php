<?php /* Smarty version Smarty-3.1.18, created on 2014-10-22 07:05:36
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\imagesItemsT.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1603354473b20a90787-26275901%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '39abc8d0487427d877e0fee2b3f5020466256d7b' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\imagesItemsT.tpl',
      1 => 1413954286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1603354473b20a90787-26275901',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'del_td' => 0,
    'num_id' => 0,
    'classHidden' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54473b20bfb511_58870687',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54473b20bfb511_58870687')) {function content_54473b20bfb511_58870687($_smarty_tpl) {?><tr>
    <?php echo $_smarty_tpl->tpl_vars['del_td']->value;?>

    <td><?php echo $_smarty_tpl->tpl_vars['num_id']->value;?>
</td>
    <td<?php echo $_smarty_tpl->tpl_vars['classHidden']->value;?>
><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</td>
</tr><?php }} ?>
