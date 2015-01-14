<?php /* Smarty version Smarty-3.1.18, created on 2014-10-15 07:52:09
         compiled from "admin_panel\libs\templates\inner-tpl\prices\priceOne.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18984543e0b89a84948-47161149%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37571c473f8ced2d33113056ee3c9cda26eba2f0' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\prices\\priceOne.tpl',
      1 => 1413350217,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18984543e0b89a84948-47161149',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'name' => 0,
    'title1' => 0,
    'name1' => 0,
    'title2' => 0,
    'name2' => 0,
    'title3' => 0,
    'name3' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543e0b89ad0e44_76474636',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543e0b89ad0e44_76474636')) {function content_543e0b89ad0e44_76474636($_smarty_tpl) {?><div class="form-group">
    <label for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</label>
    <input type="file"  name="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
</div>
<div class="form-group">
    <label for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['title1']->value;?>
</label>
    <input type="file"  name="<?php echo $_smarty_tpl->tpl_vars['name1']->value;?>
">
</div>
<div class="form-group">
    <label for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['title2']->value;?>
</label>
    <input type="file"  name="<?php echo $_smarty_tpl->tpl_vars['name2']->value;?>
">
</div>
<div class="form-group">
    <label for="exampleInputEmail1"><?php echo $_smarty_tpl->tpl_vars['title3']->value;?>
</label>
    <input type="file"  name="<?php echo $_smarty_tpl->tpl_vars['name3']->value;?>
">
</div>

<?php }} ?>
