<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 17:00:04
         compiled from "libs\templates\inner-tpl\catalog-menu\navli-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172675428f409ae0269-61686135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6c884707dff3fac4d6887b8a833c6c0a51fbca1' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\catalog-menu\\navli-menu.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172675428f409ae0269-61686135',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5428f409b9d739_83746766',
  'variables' => 
  array (
    'id_menu' => 0,
    'active_menu' => 0,
    'title_menu' => 0,
    'navli_submenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5428f409b9d739_83746766')) {function content_5428f409b9d739_83746766($_smarty_tpl) {?><li>
    <span <?php echo $_smarty_tpl->tpl_vars['id_menu']->value;?>
 class="<?php echo $_smarty_tpl->tpl_vars['active_menu']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['title_menu']->value;?>
</span>
    <ul class="submenu">
        <?php echo $_smarty_tpl->tpl_vars['navli_submenu']->value;?>

    </ul>
</li><?php }} ?>
