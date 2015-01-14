<?php /* Smarty version Smarty-3.1.18, created on 2014-10-22 07:08:19
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\imagesItemsTd.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2682254473bc34572d5-26649461%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce3b199b3401bc4a06d95be175ac108bb0ffec0c' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\imagesItemsTd.tpl',
      1 => 1413954286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2682254473bc34572d5-26649461',
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
  'unifunc' => 'content_54473bc348f373_42426336',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54473bc348f373_42426336')) {function content_54473bc348f373_42426336($_smarty_tpl) {?><tr>
    <?php echo $_smarty_tpl->tpl_vars['del_td']->value;?>

    <td><?php echo $_smarty_tpl->tpl_vars['num_id']->value;?>
</td>
    <td<?php echo $_smarty_tpl->tpl_vars['classHidden']->value;?>
><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</td>
</tr><?php }} ?>
