<?php /* Smarty version Smarty-3.1.18, created on 2014-11-04 15:10:10
         compiled from "admin_panel\libs\templates\inner-tpl\dif-tab\schetFieldset.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6495458de428c0bc6-85036376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f50e97cf374015fc952fae377a988822567eb32' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\dif-tab\\schetFieldset.tpl',
      1 => 1415110208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6495458de428c0bc6-85036376',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'legend' => 0,
    'id' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5458de429ed007_22645321',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5458de429ed007_22645321')) {function content_5458de429ed007_22645321($_smarty_tpl) {?><fieldset>
    <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
    <div class="form-group">
        <label for="schet_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">Содержание:</label>
        <textarea class="form-control" name="schet_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" id="schet_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" cols="75" rows="15" placeholder="Введите содержание страницы"><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</textarea>
    </div>
</fieldset><?php }} ?>
