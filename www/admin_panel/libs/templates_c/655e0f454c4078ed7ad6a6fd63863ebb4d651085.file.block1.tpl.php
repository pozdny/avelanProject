<?php /* Smarty version Smarty-3.1.18, created on 2014-10-15 17:59:23
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\block1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31128543d024c8cd3e0-81811873%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '655e0f454c4078ed7ad6a6fd63863ebb4d651085' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\block1.tpl',
      1 => 1413388763,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31128543d024c8cd3e0-81811873',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543d024c90b740_02947697',
  'variables' => 
  array (
    'formElements' => 0,
    'table' => 0,
    'method' => 0,
    'action' => 0,
    'legend' => 0,
    'submenu_items' => 0,
    'hidden' => 0,
    'add_elements' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543d024c90b740_02947697')) {function content_543d024c90b740_02947697($_smarty_tpl) {?><form id="<?php echo $_smarty_tpl->tpl_vars['formElements']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
" enctype="multipart/form-data" <?php echo $_smarty_tpl->tpl_vars['method']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['action']->value;?>
>
    <div>
        <fieldset>
            <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
            <?php echo $_smarty_tpl->tpl_vars['submenu_items']->value;?>

        </fieldset>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['hidden']->value;?>

</form>
<?php echo $_smarty_tpl->tpl_vars['add_elements']->value;?>

<?php }} ?>
