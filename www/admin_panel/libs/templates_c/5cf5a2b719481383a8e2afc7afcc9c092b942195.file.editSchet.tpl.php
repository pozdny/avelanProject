<?php /* Smarty version Smarty-3.1.18, created on 2014-11-04 15:10:10
         compiled from "admin_panel\libs\templates\inner-tpl\dif-tab\editSchet.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30555458d5ab1d1314-64332196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cf5a2b719481383a8e2afc7afcc9c092b942195' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\dif-tab\\editSchet.tpl',
      1 => 1415110208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30555458d5ab1d1314-64332196',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5458d5ab7b06e5_34804069',
  'variables' => 
  array (
    'table' => 0,
    'fieldset' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5458d5ab7b06e5_34804069')) {function content_5458d5ab7b06e5_34804069($_smarty_tpl) {?><div align="center" class="style1">Исправить данные счетчиков</div>
<form id="editForm" class="<?php echo $_smarty_tpl->tpl_vars['table']->value;?>
">
    <?php echo $_smarty_tpl->tpl_vars['fieldset']->value;?>

    <button type="button" name="Submit" class="btn btn-primary" id="button_edit">Изменить</button>
    <input name="link" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
">
</form><?php }} ?>
