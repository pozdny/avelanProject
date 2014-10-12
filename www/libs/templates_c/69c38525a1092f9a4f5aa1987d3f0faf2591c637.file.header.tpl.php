<?php /* Smarty version Smarty-3.1.18, created on 2014-09-22 12:10:16
         compiled from "D:\work\avelanProject\www\libs\templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5173541ff03114a885-00827126%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69c38525a1092f9a4f5aa1987d3f0faf2591c637' => 
    array (
      0 => 'D:\\work\\avelanProject\\www\\libs\\templates\\header.tpl',
      1 => 1411380614,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5173541ff03114a885-00827126',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_541ff031150e89_51225852',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_541ff031150e89_51225852')) {function content_541ff031150e89_51225852($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
    <title>Авелан</title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251" >
    <meta name="viewport" content="width=1024">
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery/jquery-2.0.3.js" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="/rediz/js/html5shiv.js" type="text/javascript"></script>
    <script src="/rediz/js/respond.min.js" type="text/javascript"></script>
    <![endif]-->
    <link type="image/x-icon" href="/favicon.ico" rel="icon">
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">

</head>
<body>
<div class="bg"></div>
<header>
    <div class="header-inner">
        
        <?php echo $_smarty_tpl->getSubTemplate ('navbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


        <div class="container">
            <div class="row block-1">
                <div class="col-xs-4 logo-block">
                    <div class="row">
                        <div class="col-xs-3" id="logo"></div>
                        <div class="col-xs-9" >
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
                            <span class="text">Отдел сервисного обслуживания: </span><span class="phone"> +7(913)016-75-15</span>
                        </div>
                        <div class="col-xs-4 company-phone">
                            <i class="fa round-icons-phone"></i><span class="phone"> 8 (383) 201 83 39</span>
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
                            <span class="time sansbold">Пн-Пт: 08:30 - 17:30 <br>Выходные: Сб - Вск </span>
                        </div>
                    </div>

                </div>
                <div class="col-xs-7">
                    <div class="search-form">
                        <form name="searchForm" action="" method="post" role="form" id="searchForm">
                            <div class="input-append">
                                <div class="search-inner">
                                    <input type="text" name="search_word" maxlength="60" class="form-control sansbold" id="inputFild"  placeholder="Мы поможем найти...">
                                    <input type="image" alt="Поиск" name="submit" id="inputIcon" src="img/icons/dif-icons.png" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header><?php }} ?>
