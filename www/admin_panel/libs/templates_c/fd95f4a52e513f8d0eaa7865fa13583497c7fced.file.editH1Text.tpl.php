<?php /* Smarty version Smarty-3.1.18, created on 2014-10-13 17:20:29
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\editH1Text.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6919543bedbda2f425-48058552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd95f4a52e513f8d0eaa7865fa13583497c7fced' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\editH1Text.tpl',
      1 => 1413187422,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6919543bedbda2f425-48058552',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'style' => 0,
    'name_for_h1' => 0,
    'h1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543bedbe01b539_07809243',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543bedbe01b539_07809243')) {function content_543bedbe01b539_07809243($_smarty_tpl) {?><tr><td <?php echo $_smarty_tpl->tpl_vars['style']->value;?>
><label for="h1"><?php echo $_smarty_tpl->tpl_vars['name_for_h1']->value;?>
</label></td></tr>
<tr><td><input type='text' name='h1' id='h1' size='100' placeholder='Заголовок h1' value='<?php echo $_smarty_tpl->tpl_vars['h1']->value;?>
' /><br /><br /></td></tr><?php }} ?>
