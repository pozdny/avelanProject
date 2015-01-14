<?php /* Smarty version Smarty-3.1.18, created on 2014-10-22 17:35:44
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\addInput.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21556543bedbe112043-59739625%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a117f250c3351285568f67abc72e06ab32024175' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\addInput.tpl',
      1 => 1413992140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21556543bedbe112043-59739625',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543bedbe1197a0_82922091',
  'variables' => 
  array (
    'legend' => 0,
    'add_input_id' => 0,
    'add_input_class' => 0,
    'add_id' => 0,
    'hidden_add_img' => 0,
    'button_add_input' => 0,
    'submit_button' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543bedbe1197a0_82922091')) {function content_543bedbe1197a0_82922091($_smarty_tpl) {?><fieldset>
    <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
    <div id="<?php echo $_smarty_tpl->tpl_vars['add_input_id']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['add_input_class']->value;?>
></div>
    <input name="add_id" id="add_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['add_id']->value;?>
">
    <?php echo $_smarty_tpl->tpl_vars['hidden_add_img']->value;?>

    <button type="button" class="btn btn-success" id="<?php echo $_smarty_tpl->tpl_vars['button_add_input']->value;?>
">Добавить поле</button>
    <?php echo $_smarty_tpl->tpl_vars['submit_button']->value;?>

</fieldset><?php }} ?>
