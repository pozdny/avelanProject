<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 09:31:11
         compiled from "libs\templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28696541fe5748a5830-00280696%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb2ebcedb0971b374f34a58e023c4b2574b8326b' => 
    array (
      0 => 'libs\\templates\\main.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28696541fe5748a5830-00280696',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_541fe57491b144_89173655',
  'variables' => 
  array (
    'header' => 0,
    'arResult' => 0,
    'action' => 0,
    'two_class' => 0,
    'content' => 0,
    'pos1' => 0,
    'left_menu' => 0,
    'bread_crumbs' => 0,
    'title_main' => 0,
    'catalog_menu' => 0,
    'login_form' => 0,
    'response' => 0,
    'calc' => 0,
    'backcall' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541fe57491b144_89173655')) {function content_541fe57491b144_89173655($_smarty_tpl) {?>
<?php echo $_smarty_tpl->tpl_vars['header']->value;?>

<?php $_smarty_tpl->tpl_vars['action'] = new Smarty_variable($_smarty_tpl->tpl_vars['arResult']->value->ACTION, null, 0);?>
<?php $_smarty_tpl->tpl_vars['pos1'] = new Smarty_variable($_smarty_tpl->tpl_vars['arResult']->value->POS1, null, 0);?>
<?php $_smarty_tpl->tpl_vars['two_class'] = new Smarty_variable('', null, 0);?>
<!--wrap-->
<div id="wrap" >
    <?php if ($_smarty_tpl->tpl_vars['action']->value=='services'||$_smarty_tpl->tpl_vars['action']->value=='nashi_raboty') {?>
        <?php $_smarty_tpl->tpl_vars['two_class'] = new Smarty_variable("two-columns", null, 0);?>
    <?php }?>
    <div class="container <?php echo $_smarty_tpl->tpl_vars['two_class']->value;?>
">
        <?php if ($_smarty_tpl->tpl_vars['action']->value=='MainPage') {?>
            <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

        <?php } elseif (($_smarty_tpl->tpl_vars['action']->value=='services'||$_smarty_tpl->tpl_vars['action']->value=='nashi_raboty')&&$_smarty_tpl->tpl_vars['pos1']->value!='') {?>
            <div class="row">
                <div class="col-xs-3">
                    <?php echo $_smarty_tpl->tpl_vars['left_menu']->value;?>

                </div>
                <div class="col-xs-9">
                    <div class="jumbotron" id="content-page" >
                        <?php echo $_smarty_tpl->tpl_vars['bread_crumbs']->value;?>

                        <h1 class="page-title"><?php echo $_smarty_tpl->tpl_vars['title_main']->value;?>
</h1>
                        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

                        <div class="pusher"></div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron" id="content-page">
                    <?php echo $_smarty_tpl->tpl_vars['bread_crumbs']->value;?>

                    <h1 class="page-title"><?php echo $_smarty_tpl->tpl_vars['title_main']->value;?>
</h1>
                    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

                </div>
            </div>
        </div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['action']->value=='catalog') {?>
            <?php echo $_smarty_tpl->tpl_vars['catalog_menu']->value;?>

        <?php }?>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['action']->value=='admin-panel') {?>
        <?php echo $_smarty_tpl->tpl_vars['login_form']->value;?>

    <?php }?>
</div>
<!--/wrap-->
<?php echo $_smarty_tpl->tpl_vars['response']->value;?>

<?php echo $_smarty_tpl->tpl_vars['calc']->value;?>

<?php echo $_smarty_tpl->tpl_vars['backcall']->value;?>


<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>



<?php }} ?>
