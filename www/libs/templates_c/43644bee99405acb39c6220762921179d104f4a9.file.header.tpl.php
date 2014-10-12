<?php /* Smarty version Smarty-3.1.18, created on 2014-10-12 09:31:11
         compiled from "libs\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14961541fe574a2bee0-29255048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43644bee99405acb39c6220762921179d104f4a9' => 
    array (
      0 => 'libs\\templates\\header.tpl',
      1 => 1413098657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14961541fe574a2bee0-29255048',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_541fe574a2ffb6_58492233',
  'variables' => 
  array (
    'description' => 0,
    'keywords' => 0,
    'titlepage' => 0,
    'navbar' => 0,
    'class_true' => 0,
    'search_form' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541fe574a2ffb6_58492233')) {function content_541fe574a2ffb6_58492233($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=1024">
    <meta name="robots" content="index, follow" />
    <meta name='description' content='<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
' />
    <meta name='keywords' content='<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
' />
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery/jquery-2.0.3.js" type="text/javascript"></script>
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js" type="text/javascript"></script>
    <script src="/js/respond.min.js" type="text/javascript"></script>
    <![endif]-->
    <link type="image/x-icon" href="/favicon.ico" rel="icon">
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <title><?php echo $_smarty_tpl->tpl_vars['titlepage']->value;?>
</title>
</head>
<body>
<div class="bg"></div>
<header>
    <div class="header-inner">
        
        <?php echo $_smarty_tpl->tpl_vars['navbar']->value;?>

        <div class="container">
            <div class="row block-1">
                <div class="col-xs-4 logo-block <?php echo $_smarty_tpl->tpl_vars['class_true']->value;?>
">
                    <div class="row">
                        <div class="col-xs-3" id="logo"></div>
                        <div class="col-xs-9">
                            <div class="logo-name">
                                <span class="dinmedium">АВЕЛАН</span>
                                <span class="dinthin"> СЕРВИС</span>
                            </div>
                            <div class="logo-desc">
                                <span class="letter-sp">монтаж систем вентиляции</span><br>
                                и кондиционирования под ключ
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xs-8 ">
                    <div class="row">
                        <div class="col-xs-8 servise-info">
                            <span class="text">Отдел сервисного обслуживания: </span><span class="phone"> +7(913) 016-75-15</span>
                        </div>
                        <div class="col-xs-4 company-phone">
                            <i class="fa round-icons-phone"></i><span class="phone"> 8 (383) 201 83 39</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="company-email pull-right">
                                <a href="mailto:avelan.info@gmail.com">avelan.info@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row block-2">
                <div class="col-xs-5">
                    <div class="row shadule">
                        <div class="col-xs-6 shadule-text">
                            <i class="fa round-icons-big-clock"></i><span class="text sansbold">График работы:</span>
                        </div>
                        <div class="col-xs-6">
                            <span class="time sansbold">Пн-Пт: 09:00 - 17:30 <br>Выходные: Сб - Вск </span>
                        </div>
                    </div>

                </div>
                <div class="col-xs-7">
                    <?php echo $_smarty_tpl->tpl_vars['search_form']->value;?>

                </div>
            </div>
        </div>
    </div>

</header><?php }} ?>
