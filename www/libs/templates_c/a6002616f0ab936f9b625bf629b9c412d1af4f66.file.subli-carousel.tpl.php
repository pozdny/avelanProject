<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 09:49:47
         compiled from "libs\templates\inner-tpl\carousel\subli-carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17883542e5464d67550-51323026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6002616f0ab936f9b625bf629b9c412d1af4f66' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\carousel\\subli-carousel.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17883542e5464d67550-51323026',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542e5464d9a522_05142632',
  'variables' => 
  array (
    'suburl_carousel' => 0,
    'subtitle_carousel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542e5464d9a522_05142632')) {function content_542e5464d9a522_05142632($_smarty_tpl) {?><li class="list-group-item">
    <i class="fa fa-caret-right"></i>
    <a href="<?php echo $_smarty_tpl->tpl_vars['suburl_carousel']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['subtitle_carousel']->value;?>
</a>
</li><?php }} ?>
