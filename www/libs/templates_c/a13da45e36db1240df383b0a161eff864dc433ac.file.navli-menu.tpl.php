<?php /* Smarty version Smarty-3.1.18, created on 2014-10-02 11:26:35
         compiled from "libs\templates\inner-tpl\left-menu\navli-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4430542cfe5dc69577-89582074%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a13da45e36db1240df383b0a161eff864dc433ac' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\left-menu\\navli-menu.tpl',
      1 => 1412241994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4430542cfe5dc69577-89582074',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542cfe5e0a55d5_95646172',
  'variables' => 
  array (
    'active_menu' => 0,
    'url_menu' => 0,
    'title_menu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542cfe5e0a55d5_95646172')) {function content_542cfe5e0a55d5_95646172($_smarty_tpl) {?><li class="<?php echo $_smarty_tpl->tpl_vars['active_menu']->value;?>
">
    <a  href="<?php echo $_smarty_tpl->tpl_vars['url_menu']->value;?>
">
        <?php echo $_smarty_tpl->tpl_vars['title_menu']->value;?>

    </a>
</li><?php }} ?>
