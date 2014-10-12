<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 18:22:42
         compiled from "admin_panel\libs\templates\inner-tpl\hello.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13818543aaad2b0f1f0-15356428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f4c7352eec6321c68801153811016b09d861ae0' => 
    array (
      0 => 'admin_panel\\libs\\templates\\inner-tpl\\hello.tpl',
      1 => 1413129729,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13818543aaad2b0f1f0-15356428',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'name' => 0,
    'time' => 0,
    'online' => 0,
    'logout' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_543aaad2c397c8_41788900',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_543aaad2c397c8_41788900')) {function content_543aaad2c397c8_41788900($_smarty_tpl) {?><div class="row" id="hello">
    <div class="col-xs-12">
        Добро пожаловать на сайт, <strong><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
!</strong> Ваш последний визит <?php echo $_smarty_tpl->tpl_vars['time']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['online']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['logout']->value;?>

    </div>
</div><?php }} ?>
