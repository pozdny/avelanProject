<?php /* Smarty version Smarty-3.1.18, created on 2014-11-14 08:00:22
         compiled from "admin_panel\libs\templates\inner-tpl\dif-tab\editInfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205954536ebd89a9a9-97073903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06d42072ed8c1d5b0954b982e240c083719ef930' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\dif-tab\\editInfo.tpl',
      1 => 1415948422,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205954536ebd89a9a9-97073903',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54536ebd8f9862_72305124',
  'variables' => 
  array (
    'table' => 0,
    'legend' => 0,
    'name' => 0,
    'email' => 0,
    'phone' => 0,
    'phone_service' => 0,
    'shadule' => 0,
    'shadule1' => 0,
    'address' => 0,
    'checked_gerld' => 0,
    'checked_effect' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54536ebd8f9862_72305124')) {function content_54536ebd8f9862_72305124($_smarty_tpl) {?><form id="editForm" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
">
    <fieldset>
        <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="name">Название организации:</label>
                    <input class="form-control input-sm" type="text" name="name" id="name" placeholder="Введите название организации" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" />
                </div>
                <div class="col-xs-6">
                    <label for="email">E-mail:</label>
                    <input class="form-control input-sm" type="text" name="email" id="email" placeholder="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="phone">Телефон организации:</label>
                    <input class="form-control input-sm" type="text" name="phone" id="phone" placeholder="Введите телефон организации" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
" />
                </div>
                <div class="col-xs-6">
                    <label for="phone_service">Телефон сервиса:</label>
                    <input class="form-control input-sm" type="text" name="phone_service" id="phone_service" placeholder="Введите телефон сервисного отдела" value="<?php echo $_smarty_tpl->tpl_vars['phone_service']->value;?>
" />
                </div>
            </div>

        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <label for="shadule">Время работы:</label>
                    <input class="form-control input-sm" type="text" name="shadule" id="shadule" placeholder="Время работы" value="<?php echo $_smarty_tpl->tpl_vars['shadule']->value;?>
" />
                </div>
                <div class="col-xs-6">
                    <label for="shadule1">Выходные:</label>
                    <input class="form-control input-sm" type="text" name="shadule1" id="shadule1" placeholder="Время работы" value="<?php echo $_smarty_tpl->tpl_vars['shadule1']->value;?>
" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12">
                    <label for="address">Адрес:</label>
                    <input class="form-control input-sm" type="text" name="address" id="address" placeholder="Время работы" value="<?php echo $_smarty_tpl->tpl_vars['address']->value;?>
" />
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="gerld" <?php echo $_smarty_tpl->tpl_vars['checked_gerld']->value;?>
> Включение/выключение гирлянды
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="effect" <?php echo $_smarty_tpl->tpl_vars['checked_effect']->value;?>
> Включение/выключение скрипта снега
            </label>
        </div>
        <button type="button" name="Submit" class="btn btn-primary" id="button_edit">Изменить</button>
    </fieldset>
    <input name="link" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
">
</form><?php }} ?>
