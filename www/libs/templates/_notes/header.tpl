<!DOCTYPE html>
<html lang=ru>
<head>
    <meta charset=utf-8 >
    <meta name="viewport" content="width=1024">
    <meta name="robots" content="index, follow">
    <meta name='description' content='{$description}'>
    <meta name='keywords' content='{$keywords}'>
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/jquery/formstyler.css" rel="stylesheet">
    <script src="/js/jquery/jquery-2.0.3.js"></script>
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->
    <link type="image/x-icon" href="/favicon.ico" rel="icon">
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <title>{$titlepage}</title>
</head>
<body>
<div class="bg"></div>
<header>
    {$gerld}
    <div class="header-inner">
        {*подключаем навигатор*}
        {$navbar}
        <div class="container">
            {$hello}
            <div class="row block-1">
                <div class="col-xs-4 logo-block {$class_true}">
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
                            <span class="text">Отдел сервисного обслуживания: </span><span class="phone">{$phone_service}</span>
                        </div>
                        <div class="col-xs-4 company-phone">
                            <i class="fa round-icons-phone"></i><span class="phone"> {$phone}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="company-email pull-right">
                                <a href="mailto:avelan.info@gmail.com">{$email}</a>
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
                            <span class="time sansbold">{$work}<br>{$weekend}</span>
                        </div>
                    </div>

                </div>
                <div class="col-xs-7">
                    {$search_form}
                </div>
            </div>
        </div>
    </div>

</header>