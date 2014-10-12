<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 10.10.14
 * Time: 14:20
 */
function admin_head()
{
    global $smarty;
    $title = '<span name="top">ПАНЕЛЬ АДМИНИСТРИРОВАНИЯ</span>';
    $loc = HOME_URL;
    $month = array("01" => "января", "02" => "февраля", "03" => "марта", "04" => "апреля", "05" => "мая", "06" => "июня", "07" => "июля", "08" => "августа", "09" => "сентября",
        "10" => "октября", "11" => "ноября", "12" => "декабря"
    );
    $week = array('воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота');
    $date_m = strtr(date('m'), $month);
    $date_w = $week[date('w')];
    $date_d = date('d');
    $now_date = $date_d.' '.$date_m.' '.date('Y').', '.$date_w;
    $date = '<span '.STYLE9.'><span '.DOTTED.'>'.$now_date.'</span></span>';

    $smarty->assign('title', $title);
    $smarty->assign('loc', $loc);
    $smarty->assign('date', $date);
    $html = $smarty->fetch('header.tpl');
    return $html;
}