<?php /* Smarty version Smarty-3.1.18, created on 2014-10-28 13:26:22
         compiled from "admin_panel\libs\templates\inner-tpl\product\formAddElement.tpl" */ ?>
<?php /*%%SmartyHeaderCode:739544cbeb6944b82-76547907%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecbaf35fca38b8ad78329d692f6f5802f5e51795' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\product\\formAddElement.tpl',
      1 => 1414499083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '739544cbeb6944b82-76547907',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544cbeb6981c56_09746546',
  'variables' => 
  array (
    'table' => 0,
    'position' => 0,
    'title' => 0,
    'add_id' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544cbeb6981c56_09746546')) {function content_544cbeb6981c56_09746546($_smarty_tpl) {?><form id="formAddElements" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
" >
    <fieldset>
        <legend>Добавить <?php echo $_smarty_tpl->tpl_vars['position']->value;?>
</legend>
        <div class="row form-group">
            <div class="col-xs-8">
                <input id="title" class="form-control input-sm" type="text" name="title" placeholder="Введите <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
">
            </div>
            <div class="col-xs-4">
                <button id="button_add" class="btn btn-default" type="button">Добавить</button>
            </div>
        </div>
        <input name="add_id" id="add_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['add_id']->value;?>
" >
        <?php echo $_smarty_tpl->tpl_vars['link']->value;?>

    </fieldset>
</form><?php }} ?>
