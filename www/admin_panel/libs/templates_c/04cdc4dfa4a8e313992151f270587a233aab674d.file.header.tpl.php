<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 13:12:53
         compiled from "admin_panel\libs\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:654754379176ca6773-13503145%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04cdc4dfa4a8e313992151f270587a233aab674d' => 
    array (
      0 => 'admin_panel\\libs\\templates\\header.tpl',
      1 => 1413112373,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '654754379176ca6773-13503145',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54379176cf31f5_36216546',
  'variables' => 
  array (
    'titlepage' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54379176cf31f5_36216546')) {function content_54379176cf31f5_36216546($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=charset=utf-8"/>
    <meta name="robots" content="noindex, nofollow" />
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/admin_style.css" rel="stylesheet">
    <title><?php echo $_smarty_tpl->tpl_vars['titlepage']->value;?>
</title>

</head>
<body>
<noscript>
    <h2 align="center">не подключен JavaScript</h2>
</noscript>
<!--conteyner-->
<div class="contayner">
    <!--main-->
    <div class="main">
        <div class="head">
            <div id="head_admin">
                <div id="head_admin_b">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"><div id="logo_admin"></div></a>
                    <div id="head1_admin">
                        <div id="head2_admin">
                            <div align="center"></div>
                        </div>
                        <div id="head_date">

                        </div>
                    </div>
                </div>
                <noindex>
                    <div id="head2" class="style5"></div>
                </noindex>
            </div>
        </div><?php }} ?>
