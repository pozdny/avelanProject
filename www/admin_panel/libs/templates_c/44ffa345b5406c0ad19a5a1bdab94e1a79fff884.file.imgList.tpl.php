<?php /* Smarty version Smarty-3.1.18, created on 2014-10-21 17:17:09
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\imgList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29732544678f5dc7e94-67166489%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44ffa345b5406c0ad19a5a1bdab94e1a79fff884' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\imgList.tpl',
      1 => 1413904627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29732544678f5dc7e94-67166489',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544678f631e0e9_34476143',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544678f631e0e9_34476143')) {function content_544678f631e0e9_34476143($_smarty_tpl) {?><form id="<?php echo $_smarty_tpl->tpl_vars['formElements']->value;?>
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
