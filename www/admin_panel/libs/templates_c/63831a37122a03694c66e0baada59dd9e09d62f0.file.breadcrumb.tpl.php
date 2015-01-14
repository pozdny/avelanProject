<?php /* Smarty version Smarty-3.1.18, created on 2014-10-23 16:47:24
         compiled from "admin_panel\libs\templates\breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159765448f2d72c5d77-29368300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63831a37122a03694c66e0baada59dd9e09d62f0' => 
    array (
      0 => 'admin_panel\\libs\\templates\\breadcrumb.tpl',
      1 => 1414075642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159765448f2d72c5d77-29368300',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5448f2d72f4f11_65709264',
  'variables' => 
  array (
    'li' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5448f2d72f4f11_65709264')) {function content_5448f2d72f4f11_65709264($_smarty_tpl) {?><div id="bread-crumbs">
    <ol class="breadcrumb">
        <?php echo $_smarty_tpl->tpl_vars['li']->value;?>

    </ol>
</div><?php }} ?>
