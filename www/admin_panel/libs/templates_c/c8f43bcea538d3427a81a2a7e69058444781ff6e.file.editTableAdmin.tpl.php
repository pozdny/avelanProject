<?php /* Smarty version Smarty-3.1.18, created on 2014-10-28 12:17:51
         compiled from "admin_panel\libs\templates\inner-tpl\dif-tab\editTableAdmin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6021544f7b5f96f266-67850460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8f43bcea538d3427a81a2a7e69058444781ff6e' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\dif-tab\\editTableAdmin.tpl',
      1 => 1414493497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6021544f7b5f96f266-67850460',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'back' => 0,
    'table' => 0,
    'legend' => 0,
    'name' => 0,
    'id' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544f7b5f9afcc1_35382160',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544f7b5f9afcc1_35382160')) {function content_544f7b5f9afcc1_35382160($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['back']->value;?>

<div align="center" class="style1">Исправить данные об операторе</div>
<form id="editForm" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
 form-horizontal" >
    <fieldset>
        <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
        <div class="form-group">
            <div class="col-xs-2">
                <label for="rus">Ф.И.О:</label>
            </div>
            <div class="col-xs-5">
                <input type='text' name='name' id='rus' class="form-control input-sm" placeholder='Название пункта' value='<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
' />
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-2">
                <label for="rus">Новый логин:</label>
            </div>
            <div class="col-xs-5">
                <input class="form-control input-sm" type='text' name='login' value='' placeholder='Логин' />
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-2">
                <label for="rus">Новый пароль:</label>
            </div>
            <div class="col-xs-5">
                <input class="form-control input-sm" type='text' name='password'  value='' placeholder='Пароль' />
            </div>
        </div>
        <button type="button" name="Submit" class="btn btn-primary" id="button_edit">Изменить</button>
        <input name="edit_id" type="hidden" id="edit_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
        <input name="link" type="hidden"  value="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" />
    </fieldset>
</form>
<?php }} ?>
