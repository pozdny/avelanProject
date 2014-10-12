<?php
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$id = abs(intval($id));
}
else
{
	$id = 400;
}

// ассоциативный массив кодов и описаний
$a[401] = "Требуется авторизация";
$a[403] = "Пользователь не прошел аутентификацию, доступ запрещен";
$a[404] = "Документ не найден";
$a[500] = "Внутренняя ошибка сервера";
$a[503] = "Внутренняя ошибка сервера";
$a[400] = "Неправильный запрос";
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<HTML><HEAD>
<TITLE><?php echo $a[$id]; ?></TITLE>
<meta content="text/html"; charset="windows-1251" />
<!-- <meta http-equiv="refresh" content="25;url=http://www.rnv-r.ru/"> -->
<meta http-equiv="refresh" content="25;url=http://xn--80aafm4an.xn--p1ai">
</HEAD>
<BODY>
<?php
//объявляем необходимые переменные
$server_name     = $_SERVER['SERVER_NAME'];
if(isset($_GET['request']))
{
	$request_url = $_GET['request'];
}
else
{
	$request_url = $_SERVER['REQUEST_URI'];
}
$remote_addr     = $_SERVER['REMOTE_ADDR'];
$http_user_agent = $_SERVER['HTTP_USER_AGENT'];
if(isset($_SERVER['HTTP_REFERER'])){
    $http_referer    = $_SERVER['HTTP_REFERER'];
}
else{
    $http_referer = '';
}


// определяем дату и время в стандартном формате
$time = date("d.m.Y H:i:s");
// эта переменная содержит тело сообщения
switch($id)
{
	case 404:
	$body = 'Запрошенный Вами URL: <b>'.$server_name.$request_url.' </b> не найден (Not Found)!<br />
Можете вернуться на <a href="http://'.$server_name.'">главную страницу</a> и пройти по нужной ссылке на сайте <br />
или пройти по одной из следующий ссылок:<hr>
<a href="http://'.$server_name.'">На главную </a> |
<a href="/about">О нас </a> |
<a href="/oplata">Оплата и доставка </a> |
<a href="/catalog">Каталог </a> |
<a href="/contacts">Контакты</a>
<hr>';
    break;
	case 500:
	$body = 'Запрошенный Вами URL: <b>'.$server_name.$request_url.' </b> временно недоступен.<br />
Возможные причины: технические работы на сервере, ошибка сервера, либо другое.<br />
Попробуйте зайти позже.
<hr>';
    break;
	case 503:
	$body = 'Запрошенный Вами URL: <b>'.$server_name.$request_url.' </b> временно недоступен.<br />
Возможные причины: технические работы на сервере, ошибка сервера, либо другое.<br />
Попробуйте зайти позже.
<hr>';
    break;
    default:
	 $body = 'Запрошенный Вами URL: <b>'.$server_name.$request_url.' </b> не найден (Not Found)!<br />
Можете вернуться на <a href="http://'.$server_name.'">главную страницу</a> и пройти по нужной ссылке на сайте <br />
или пройти по одной из следующий ссылок:<hr>
<a href="http://'.$server_name.'">На главную </a> |
<a href="/about">О нас </a> |
<a href="/oplata">Оплата и доставка </a> |
<a href="/catalog">Каталог </a> |
<a href="/contacts">Контакты</a>
<hr>';
}
$finish = 'Ваш IP: <b>'.$remote_addr.'</b><br />
Ваш браузер: <b>'.$http_user_agent.'</b><br />
Текущее время сервера: <b>'.$time.'</b><br />';
//Если зашел с другого адреса
if ($http_referer !='')
$body .= "Вы пришли со страницы: <b>".$http_referer."</b><br />\n";


?>
<!-- Вывод сообщения -->
<h1><i><?=$id?></i> <?=$a[$id]?></h1>
<p><?=$body.$finish?></p>
<?=$_SERVER['SERVER_SIGNATURE']?> 

</BODY></HTML>




























































































































































































































































