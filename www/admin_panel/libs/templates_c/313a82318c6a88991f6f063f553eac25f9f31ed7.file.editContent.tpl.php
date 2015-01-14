<?php /* Smarty version Smarty-3.1.18, created on 2014-10-23 11:37:17
         compiled from "admin_panel\libs\templates\inner-tpl\content\editContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:119205448cc4d80c1f4-96095877%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '313a82318c6a88991f6f063f553eac25f9f31ed7' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\content\\editContent.tpl',
      1 => 1414057036,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '119205448cc4d80c1f4-96095877',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'back' => 0,
    'table' => 0,
    'title' => 0,
    'zagolovok' => 0,
    'table_redact' => 0,
    'id' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5448cc4d859a75_84081487',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5448cc4d859a75_84081487')) {function content_5448cc4d859a75_84081487($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['back']->value;?>

<div align="center" class="style1">Исправить заголовок, содержание страницы</div>
<form id="editForm" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
">
    <fieldset>
        <legend><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</legend>
        <div class="form-group">
           <label for="zagolovok">Заголовок страницы:</label>
           <input class="form-control input-sm" type="text" name="zagolovok" id="zagolovok" placeholder="Введите заголовок страницы" value="<?php echo $_smarty_tpl->tpl_vars['zagolovok']->value;?>
" />
        </div>
        <div class="form-group">
           <label for="content">Содержание страницы:</label>
            <?php echo $_smarty_tpl->tpl_vars['table_redact']->value;?>

        </div>
        <button type="button" name="Submit" class="btn btn-primary" id="button_edit">Изменить</button>
    </fieldset>
    <input name="edit_id" type="hidden" id="edit_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
    <input name="link" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
">
</form><?php }} ?>
