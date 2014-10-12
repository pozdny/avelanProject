<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 09:49:47
         compiled from "libs\templates\inner-tpl\main-page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17741541ffcdf405ca3-87450287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7716df707facc5ac73676afea2b7c2fa4206c482' => 
    array (
      0 => 'libs\\templates\\inner-tpl\\main-page.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17741541ffcdf405ca3-87450287',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_541ffcdf40ad43_87892928',
  'variables' => 
  array (
    'main_tab_view' => 0,
    'main_carousel' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541ffcdf40ad43_87892928')) {function content_541ffcdf40ad43_87892928($_smarty_tpl) {?><div class="row">
    <div class="col-xs-12">
        <div class="jumbotron" id="jumbotron-one">
            <?php echo $_smarty_tpl->tpl_vars['main_tab_view']->value;?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="jumbotron jumbotron-carousel" id="jumbotron-two">
            <?php echo $_smarty_tpl->tpl_vars['main_carousel']->value;?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="jumbotron" id="jumbotron-three">
            <h1 class="page-title">О нас</h1>
            <div class="page-content">
                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

            </div>
        </div>
    </div>
</div><?php }} ?>
