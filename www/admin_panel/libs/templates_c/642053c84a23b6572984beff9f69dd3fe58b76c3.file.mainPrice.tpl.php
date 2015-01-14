<?php /* Smarty version Smarty-3.1.18, created on 2014-10-15 10:30:39
         compiled from "admin_panel\libs\templates\inner-tpl\prices\mainPrice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8267543e0b56e56c71-24108958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '642053c84a23b6572984beff9f69dd3fe58b76c3' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\prices\\mainPrice.tpl',
      1 => 1413361838,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8267543e0b56e56c71-24108958',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543e0b56ecb1b8_37608113',
  'variables' => 
  array (
    'action' => 0,
    'legend' => 0,
    'price' => 0,
    'notice' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543e0b56ecb1b8_37608113')) {function content_543e0b56ecb1b8_37608113($_smarty_tpl) {?><form  action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" name="file_upload" method="POST" enctype="multipart/form-data">
    <fieldset>
        <legend><?php echo $_smarty_tpl->tpl_vars['legend']->value;?>
</legend>
        <?php echo $_smarty_tpl->tpl_vars['price']->value;?>

        <div><?php echo $_smarty_tpl->tpl_vars['notice']->value;?>
</div>
        <button type="submit" id="loadButton" data-loading-text="Загрузка..." class="btn btn-success">Загрузить</button>
    </fieldset>
</form><?php }} ?>
