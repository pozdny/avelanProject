<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 17:00:04
         compiled from "libs\templates\inner-tpl\catalog-menu\navli-subsubmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28329542922c32c1af0-01937127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e14f47f88bc5a2bc1133a203092aedfabaab110b' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\catalog-menu\\navli-subsubmenu.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28329542922c32c1af0-01937127',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_542922c330d461_24157159',
  'variables' => 
  array (
    'active_subsubmenu' => 0,
    'url_subsubmenu' => 0,
    'id_subsubmenu' => 0,
    'title_subsubmenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542922c330d461_24157159')) {function content_542922c330d461_24157159($_smarty_tpl) {?><li role="presentation" class="<?php echo $_smarty_tpl->tpl_vars['active_subsubmenu']->value;?>
">
    <a href="<?php echo $_smarty_tpl->tpl_vars['url_subsubmenu']->value;?>
" tabindex="-1" role="menuitem" <?php echo $_smarty_tpl->tpl_vars['id_subsubmenu']->value;?>
><?php echo $_smarty_tpl->tpl_vars['title_subsubmenu']->value;?>
</a>
</li><?php }} ?>
