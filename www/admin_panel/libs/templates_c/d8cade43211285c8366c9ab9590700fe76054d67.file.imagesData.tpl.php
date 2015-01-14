<?php /* Smarty version Smarty-3.1.18, created on 2014-10-22 08:13:12
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\imagesData.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8327544741a1b2c974-50566464%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8cade43211285c8366c9ab9590700fe76054d67' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\imagesData.tpl',
      1 => 1413957725,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8327544741a1b2c974-50566464',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_544741a1b6ca00_05778570',
  'variables' => 
  array (
    'img_now' => 0,
    'img' => 0,
    'img_name' => 0,
    'alt' => 0,
    'alt_name' => 0,
    'img_title' => 0,
    'img_title_name' => 0,
    'manuf' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_544741a1b6ca00_05778570')) {function content_544741a1b6ca00_05778570($_smarty_tpl) {?><div class="row form-group">
    <div class="col-xs-12"><span class="text-muted">Текущее изображение: </span> <span class="text-primary"><?php echo $_smarty_tpl->tpl_vars['img_now']->value;?>
</span> </div>
    <div class="col-xs-2"><strong>Изображение:</strong></div>
    <div class="col-xs-2"><?php echo $_smarty_tpl->tpl_vars['img']->value;?>
</div>
    <div class="col-xs-8"><input  type="file" placeholder="Изображение для позиции" size="80" name="<?php echo $_smarty_tpl->tpl_vars['img_name']->value;?>
"></div>
</div>
<div class="row form-group">
    <div class="col-xs-2 "><strong>Alt:</strong></div>
    <div class="col-xs-10"><input class="form-control input-sm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['alt']->value;?>
" placeholder="alt" size="80" name="<?php echo $_smarty_tpl->tpl_vars['alt_name']->value;?>
"></div>
</div>
<div class="row form-group">
    <div class="col-xs-2 "><strong>Title:</strong></div>
    <div class="col-xs-10"><input class="form-control input-sm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['img_title']->value;?>
" placeholder="alt" size="80" name="<?php echo $_smarty_tpl->tpl_vars['img_title_name']->value;?>
"></div>
</div>
<?php echo $_smarty_tpl->tpl_vars['manuf']->value;?>
<?php }} ?>
