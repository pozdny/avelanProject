<?php /* Smarty version Smarty-3.1.18, created on 2014-10-28 08:02:33
         compiled from "admin_panel\libs\templates\inner-tpl\editMetatags.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22548544e0146aed443-21355473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86d8b6d10b855080347996bf3a7a59c7520d455a' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\editMetatags.tpl',
      1 => 1414478670,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22548544e0146aed443-21355473',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544e0146bf7bf6_40165132',
  'variables' => 
  array (
    'back' => 0,
    'table' => 0,
    'legend' => 0,
    'titlepageM' => 0,
    'keywords' => 0,
    'description' => 0,
    'id' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544e0146bf7bf6_40165132')) {function content_544e0146bf7bf6_40165132($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['back']->value;?>

<div align="center" class="style1">Исправить title, description, keywords страницы</div>
<form  id="editForm" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
">
    <fieldset>
        <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
        <div class="form-group">
            <label for="titlepage">title страницы:</label>
            <input type="text" class="form-control"  name="titlepage"  placeholder="" value="<?php echo $_smarty_tpl->tpl_vars['titlepageM']->value;?>
" />
        </div>
        <div class="form-group">
            <label for="keywords">keywords страницы:</label>
            <textarea class="form-control" name="keywords" rows="5" placeholder=""><?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
</textarea>
        </div>
        <div class="form-group">
            <label for="description">description страницы:</label>
            <textarea class="form-control" name="description" rows="5" placeholder=""><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea>
        </div>
        <button type="button" name="Submit" class="btn btn-primary" id="button_edit">Изменить</button>
    </fieldset>
    <input name="edit_id" type="hidden" id="edit_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
    <input name="link" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
">
</form><?php }} ?>
