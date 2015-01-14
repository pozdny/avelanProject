<?php /* Smarty version Smarty-3.1.18, created on 2014-10-22 08:13:12
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\manufItem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2489854474af8e32e33-90552773%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '008651e32decafe45ca7e95991852407eb2bbf69' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\manufItem.tpl',
      1 => 1413958015,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2489854474af8e32e33-90552773',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name_select' => 0,
    'select_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54474af8e69d91_66712284',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54474af8e69d91_66712284')) {function content_54474af8e69d91_66712284($_smarty_tpl) {?><div class="row form-group">
    <div class="col-xs-2 "><strong>Производитель:</strong></div>
    <div class="col-xs-10">
        <select class="form-control" id="<?php echo $_smarty_tpl->tpl_vars['name_select']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['name_select']->value;?>
">
            <?php echo $_smarty_tpl->tpl_vars['select_item']->value;?>

        </select>
    </div>
</div><?php }} ?>
