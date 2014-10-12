<?php /* Smarty version Smarty-3.1.18, created on 2014-10-10 11:09:01
         compiled from "admin_panel\libs\templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4575437918d820ea6-25851609%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6beda53c34d4692c668ae131f50d59c37e3b786' => 
    array (
      0 => 'admin_panel\\libs\\templates\\main.tpl',
      1 => 1412932058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4575437918d820ea6-25851609',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5437918d854bb8_49355727',
  'variables' => 
  array (
    'header' => 0,
    'content' => 0,
    'footer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5437918d854bb8_49355727')) {function content_5437918d854bb8_49355727($_smarty_tpl) {?><?php echo $_smarty_tpl->tpl_vars['header']->value;?>

    <div id="content_border">
        <div id="privet"></div>
         <div id="content_big">

             <div class="CONTENT">
                    <div id="main_block">

                         <div id="undermain">
                             <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

                         </div>
                    </div>
             </div>

        </div>
    </div>
    <div class="footer-pusher"></div>
</div>
<!--end main-->
<?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

<?php }} ?>
