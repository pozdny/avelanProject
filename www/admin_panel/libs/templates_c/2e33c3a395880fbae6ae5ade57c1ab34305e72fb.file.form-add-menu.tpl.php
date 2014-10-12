<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 15:47:49
         compiled from "admin_panel\libs\templates\inner-tpl\product\form-add-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6258543a868563a948-43368616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e33c3a395880fbae6ae5ade57c1ab34305e72fb' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\product\\form-add-menu.tpl',
      1 => 1413121519,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6258543a868563a948-43368616',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'position' => 0,
    'title' => 0,
    'table' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543a86856797a7_80385633',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543a86856797a7_80385633')) {function content_543a86856797a7_80385633($_smarty_tpl) {?><form class="form_add_menu" action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="POST">
    <fieldset>
        <legend>Добавить <?php echo $_smarty_tpl->tpl_vars['position']->value;?>
</legend>
        <input type="text" name="title" size="70" maxlength="70" value="" placeholder="Введите <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
"/>
        <input type="submit" value="Добавить" />
        <input type="hidden" name="table" value="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
" />
    </fieldset>
</form><?php }} ?>
