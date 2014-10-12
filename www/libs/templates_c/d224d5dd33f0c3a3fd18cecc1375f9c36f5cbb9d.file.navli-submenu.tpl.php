<?php /* Smarty version Smarty-3.1.18, created on 2014-10-01 19:14:15
         compiled from "libs\templates\inner-tpl\catalog-menu\navli-submenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:268385428f864840689-73760651%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd224d5dd33f0c3a3fd18cecc1375f9c36f5cbb9d' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\catalog-menu\\navli-submenu.tpl',
      1 => 1412183654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '268385428f864840689-73760651',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5428f8648854c0_64638504',
  'variables' => 
  array (
    'active_submenu' => 0,
    'id_submenu' => 0,
    'url_submenu' => 0,
    'title_submenu' => 0,
    'nav_subsubmenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5428f8648854c0_64638504')) {function content_5428f8648854c0_64638504($_smarty_tpl) {?><li class="dropdown <?php echo $_smarty_tpl->tpl_vars['active_submenu']->value;?>
">
    <a id="<?php echo $_smarty_tpl->tpl_vars['id_submenu']->value;?>
" class="leftnav-toggle" data-toggle="dropdown" role="button" href="<?php echo $_smarty_tpl->tpl_vars['url_submenu']->value;?>
">
        <?php echo $_smarty_tpl->tpl_vars['title_submenu']->value;?>

    </a>
    <?php echo $_smarty_tpl->tpl_vars['nav_subsubmenu']->value;?>


</li><?php }} ?>
