<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 18:02:10
         compiled from "libs\templates\inner-tpl\hello.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6307543aa458d1f9e0-00969426%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f0268851b1cfec9d96f663735932adc03eb81620' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\hello.tpl',
      1 => 1413129729,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6307543aa458d1f9e0-00969426',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543aa458d5c042_44301621',
  'variables' => 
  array (
    'name' => 0,
    'time' => 0,
    'online' => 0,
    'logout' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543aa458d5c042_44301621')) {function content_543aa458d5c042_44301621($_smarty_tpl) {?><div class="row" id="hello">
    <div class="col-xs-12">
        Добро пожаловать на сайт, <strong><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
!</strong> Ваш последний визит <?php echo $_smarty_tpl->tpl_vars['time']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['online']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['logout']->value;?>

    </div>
</div><?php }} ?>
