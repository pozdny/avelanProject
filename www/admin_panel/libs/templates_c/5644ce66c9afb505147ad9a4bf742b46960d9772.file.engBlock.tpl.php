<?php /* Smarty version Smarty-3.1.18, created on 2014-10-27 13:24:57
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\engBlock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21011544e3999dbdd93-13441195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5644ce66c9afb505147ad9a4bf742b46960d9772' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\engBlock.tpl',
      1 => 1414408486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21011544e3999dbdd93-13441195',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'eng' => 0,
    'disabled' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544e3999df1670_60379286',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544e3999df1670_60379286')) {function content_544e3999df1670_60379286($_smarty_tpl) {?><div class="form-group">
    <label for="eng">Название пункта по-английски:</label>
    <input type='text' class='form-control input-sm' name='eng' id='eng' placeholder='Название пункта по-английски' value='<?php echo $_smarty_tpl->tpl_vars['eng']->value;?>
' <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
/>
</div><?php }} ?>
