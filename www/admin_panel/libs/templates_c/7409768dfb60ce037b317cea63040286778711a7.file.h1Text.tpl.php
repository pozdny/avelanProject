<?php /* Smarty version Smarty-3.1.18, created on 2014-10-21 11:08:11
         compiled from "admin_panel\libs\templates\inner-tpl\edit-product\h1Text.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6558543f88b8072881-34482735%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7409768dfb60ce037b317cea63040286778711a7' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\edit-product\\h1Text.tpl',
      1 => 1413882489,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6558543f88b8072881-34482735',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543f88b80aa719_83821215',
  'variables' => 
  array (
    'h1' => 0,
    'disabled' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543f88b80aa719_83821215')) {function content_543f88b80aa719_83821215($_smarty_tpl) {?><div class="form-group">
    <label for="h1">Заголовок на странице:</label>
    <input type='text' class='form-control input-sm' name='h1' id='h1' placeholder='Заголовок' value='<?php echo $_smarty_tpl->tpl_vars['h1']->value;?>
' <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
/>
</div>
<?php }} ?>
