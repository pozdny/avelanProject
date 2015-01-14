<?php /* Smarty version Smarty-3.1.18, created on 2014-10-20 17:42:53
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\editPhotoIcon.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24739543bedbe7b4096-82409175%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4905efb75a15f55269daf64e82a131ebfcad7ab' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\editPhotoIcon.tpl',
      1 => 1413819684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24739543bedbe7b4096-82409175',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543bedbe7d19f6_67268035',
  'variables' => 
  array (
    'legend' => 0,
    'img_now' => 0,
    'name_img' => 0,
    'name_alt' => 0,
    'alt' => 0,
    'name_img_title' => 0,
    'img_title' => 0,
    'name_del' => 0,
    'img' => 0,
    'img_id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543bedbe7d19f6_67268035')) {function content_543bedbe7d19f6_67268035($_smarty_tpl) {?>
<fieldset>
    <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
    <div class="row">
        <div class="col-lg-9">
            <div class="form-group">
                <label for="img_icon">
                    Изображение*: <?php echo $_smarty_tpl->tpl_vars['img_now']->value;?>

                </label>
                <input id="img_icon" type="file"  name="<?php echo $_smarty_tpl->tpl_vars['name_img']->value;?>
">
            </div>
            <div class="form-group">
                <label>alt*:</label>
                <input class="form-control input-sm" type="text"  name="<?php echo $_smarty_tpl->tpl_vars['name_alt']->value;?>
" size="60" value="<?php echo $_smarty_tpl->tpl_vars['alt']->value;?>
"/>
            </div>
            <div class="form-group">
                <label>img_title*:</label>
                <input class="form-control input-sm" type="text"  name="<?php echo $_smarty_tpl->tpl_vars['name_img_title']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['img_title']->value;?>
"/>
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['name_del']->value;?>
" value="yes"> удалить фото
                    </label>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <?php echo $_smarty_tpl->tpl_vars['img']->value;?>

        </div>
        <input name="img_id" id="img_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['img_id']->value;?>
">
    </div>
</fieldset>

<?php }} ?>
