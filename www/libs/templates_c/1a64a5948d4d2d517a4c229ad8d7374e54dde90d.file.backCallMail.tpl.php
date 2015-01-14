<?php /* Smarty version Smarty-3.1.18, created on 2014-10-14 09:08:08
         compiled from "..\libs\templates\inner-tpl\forms\backcall\backCallMail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7158543ccbd87aecf4-94019223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a64a5948d4d2d517a4c229ad8d7374e54dde90d' => 
    array (
      0 => '..\\libs\\templates\\inner-tpl\\forms\\backcall\\backCallMail.tpl',
      1 => 1413126501,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7158543ccbd87aecf4-94019223',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name' => 0,
    'phone' => 0,
    'comments' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543ccbd885e507_25862126',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543ccbd885e507_25862126')) {function content_543ccbd885e507_25862126($_smarty_tpl) {?>Ф.И.О.: <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

тел.: <?php echo $_smarty_tpl->tpl_vars['phone']->value;?>

Сообщение: <?php echo $_smarty_tpl->tpl_vars['comments']->value;?>

<?php }} ?>
