<?php /* Smarty version Smarty-3.1.18, created on 2014-10-07 15:21:15
         compiled from "D:\work\avelanProject\www\libs\templates\inner-tpl\forms\backcall\backCallMail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155665433e8cb9537b1-44502104%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c862a7deaf54760491d53215ca1957d259830e23' => 
    array (
      0 => 'D:\\work\\avelanProject\\www\\libs\\templates\\inner-tpl\\forms\\backcall\\backCallMail.tpl',
      1 => 1412688068,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155665433e8cb9537b1-44502104',
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
  'unifunc' => 'content_5433e8cb98b028_77853822',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5433e8cb98b028_77853822')) {function content_5433e8cb98b028_77853822($_smarty_tpl) {?>Ф.И.О.: <?php echo $_smarty_tpl->tpl_vars['name']->value;?>

тел.: <?php echo $_smarty_tpl->tpl_vars['phone']->value;?>

Сообщение: <?php echo $_smarty_tpl->tpl_vars['comments']->value;?>

<?php }} ?>
