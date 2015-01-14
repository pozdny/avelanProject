<?php /* Smarty version Smarty-3.1.18, created on 2014-10-14 18:22:13
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\altTitle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17499543d4db500e9b5-04488246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47472491a73c3d3e351496f6422cde697fae261c' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\altTitle.tpl',
      1 => 1413208103,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17499543d4db500e9b5-04488246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'style' => 0,
    'id_alt' => 0,
    'name_alt' => 0,
    'alt' => 0,
    'id_title' => 0,
    'name_title' => 0,
    'img_title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543d4db505c491_23000009',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543d4db505c491_23000009')) {function content_543d4db505c491_23000009($_smarty_tpl) {?><tr><td <?php echo $_smarty_tpl->tpl_vars['style']->value;?>
><label for="<?php echo $_smarty_tpl->tpl_vars['id_alt']->value;?>
">alt:</label></td></tr>
<tr><td><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['name_alt']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['id_alt']->value;?>
 size="80" placeholder="alt" value="<?php echo $_smarty_tpl->tpl_vars['alt']->value;?>
" /><br /></td></tr>
<tr><td <?php echo $_smarty_tpl->tpl_vars['style']->value;?>
><label for="<?php echo $_smarty_tpl->tpl_vars['id_title']->value;?>
">img_title:</label></td></tr>
<tr><td ><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['name_title']->value;?>
" size="80" placeholder="title" value="<?php echo $_smarty_tpl->tpl_vars['img_title']->value;?>
" /><br /></td></tr><?php }} ?>
