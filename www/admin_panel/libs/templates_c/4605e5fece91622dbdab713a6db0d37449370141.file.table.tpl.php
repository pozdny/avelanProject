<?php /* Smarty version Smarty-3.1.18, created on 2014-11-13 08:44:05
         compiled from "admin_panel\libs\templates\inner-tpl\product\table.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4387543b73b3093846-67615640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4605e5fece91622dbdab713a6db0d37449370141' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\product\\table.tpl',
      1 => 1415864528,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4387543b73b3093846-67615640',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543b73b30d6f43_41031360',
  'variables' => 
  array (
    'id_table' => 0,
    'link' => 0,
    'tr' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543b73b30d6f43_41031360')) {function content_543b73b30d6f43_41031360($_smarty_tpl) {?><table class="table table-bordered table-condensed">
    <thead <?php echo $_smarty_tpl->tpl_vars['id_table']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['link']->value;?>
>
        <tr><th width="45%">Наименование</th><th width="35%">english</th><th>F</th><th>M</th><th>D</th></tr>
    </thead>
    <?php echo $_smarty_tpl->tpl_vars['tr']->value;?>

</table><?php }} ?>
