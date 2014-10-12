<?php /* Smarty version Smarty-3.1.18, created on 2014-10-03 07:27:27
         compiled from "libs\templates\inner-tpl\tab-view\li-tab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11919542e310754a059-23169197%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4099b3557c7d1a5eae628fc79f0574f339fa4056' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\tab-view\\li-tab.tpl',
      1 => 1412314045,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11919542e310754a059-23169197',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542e310762ffc3_23778812',
  'variables' => 
  array (
    'active' => 0,
    'eng' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542e310762ffc3_23778812')) {function content_542e310762ffc3_23778812($_smarty_tpl) {?><li class="<?php echo $_smarty_tpl->tpl_vars['active']->value;?>
">
    <i class="fa fa-caret-right"></i>
    <a data-toggle="tab" href="#<?php echo $_smarty_tpl->tpl_vars['eng']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</a>

</li><?php }} ?>
