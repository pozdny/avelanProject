<?php /* Smarty version Smarty-3.1.18, created on 2014-10-27 12:14:47
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\block2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28699543f7bb4bd0680-83249404%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46b63f6d04b2ea66158aee5dec8daf2d03ccbc1f' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\block2.tpl',
      1 => 1414408486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28699543f7bb4bd0680-83249404',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543f7bb4bd1b92_60702989',
  'variables' => 
  array (
    'table' => 0,
    'action' => 0,
    'method' => 0,
    'legend' => 0,
    'rus' => 0,
    'disabled' => 0,
    'eng_block' => 0,
    'h1_block' => 0,
    'table_redact' => 0,
    'table_redact2' => 0,
    'main_img' => 0,
    'type_button' => 0,
    'edit_id' => 0,
    'link' => 0,
    'mm_edit' => 0,
    'menu_eng' => 0,
    'img_list' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543f7bb4bd1b92_60702989')) {function content_543f7bb4bd1b92_60702989($_smarty_tpl) {?><form id="editForm" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['action']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['method']->value;?>
 enctype="multipart/form-data">
    <div>
        <fieldset>
            <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
            <div>
                <div class="form-group">
                    <label for="rus">Название пункта по-русски:</label>
                    <input type='text' class='form-control input-sm' name='rus' id='rus' placeholder='Название пункта по-русски' value='<?php echo $_smarty_tpl->tpl_vars['rus']->value;?>
' <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
/>
                </div>
                <?php echo $_smarty_tpl->tpl_vars['eng_block']->value;?>

                <?php echo $_smarty_tpl->tpl_vars['h1_block']->value;?>

                <?php echo $_smarty_tpl->tpl_vars['table_redact']->value;?>

                <?php echo $_smarty_tpl->tpl_vars['table_redact2']->value;?>

                <?php echo $_smarty_tpl->tpl_vars['main_img']->value;?>

                <button <?php echo $_smarty_tpl->tpl_vars['type_button']->value;?>
 class="btn btn-primary" id="button_edit">Изменить</button>
            </div>
        </fieldset>
    </div>
    <input name="edit_id" id="edit_id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['edit_id']->value;?>
">
    <?php echo $_smarty_tpl->tpl_vars['link']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['mm_edit']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['menu_eng']->value;?>

</form>
<?php echo $_smarty_tpl->tpl_vars['img_list']->value;?>
<?php }} ?>
