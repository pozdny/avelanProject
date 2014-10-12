<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 17.06.14
 * Time: 17:01
 */
header("Content-Type: text/plain");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
//Создадим объект класса Smarty
require_once '../libs/Smarty.class.php';
$smarty = new Smarty();
require_once '../libs/setup.php';
require_once('../include/include.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
{
    header('Content-Type:text/javascript; charset=windows-1251');
    exit('Данные отправлены не через AJAX');
}
else{
    header('Content-Type:text/javascript; charset=windows-1251');

    if (isset( $_POST["num"]))
    {
        if (isset( $_POST["id"])) $id = $_POST['id'];
        else $id = 1;
        if (isset( $_POST["value"]))
        {
            $value = $_POST['value'];
        }
        $num = $_POST['num'];
        switch($num)
        {
            case 1: BackCall($value);
                break;
            default: BackCall($value);
        }
    }
}
function BackCall($value){
    foreach($value as $key=>$val){
        if($val['name'] == 'nameOrder')          $name       = GetFormValue($val['value']);
        if($val['name'] == 'phoneOrder')         $phone      = GetFormValue($val['value']);
        if($val['name'] == 'caracterOrder')      $caracter   = GetFormValue($val['value']);
    }
    $mail_arr = array(
        'name' => $name,
        'phone'=> $phone,
        'caracter' => $caracter
    );

    $rez = sendmail($mail_arr);
    $options=array(
        "rez"=>$rez
    );
    echo json_encode($options);
}
function sendmail($arr)
{
    // Читаем настройки config
    require_once('../lib/phpmailer/config.php');

// Подключаем класс FreakMailer
    require_once('../lib/MailClass.inc');

// инициализируем класс
    $mailer = new FreakMailer();
    $email = $mailer->to_email;
    $name = $mailer->to_name;
    $email2 = '';
    if(!empty($mailer->to_email2)){
        $email2 = $mailer->to_email2;
    }

// Устанавливаем тему письма
    $subject = "Заказ обратного звонка";
    $mailer->Subject = $subject;

// Задаем тело письма
    $htmlBody = createMailMessage($arr);
    $mailer->Body = $htmlBody;

// Добавляем адрес в список получателей
    $mailer->AddAddress($email, $name);
    if($email2!=''){
        $mailer->AddCC($email2, $name);
    }

    if(!$mailer->Send())
    {
        return '0';
    }
    else
    {
        $mailer->ClearAddresses();
        $mailer->ClearAttachments();
        return '1';
    }



}
function createMailMessage($arr)
{
    global $smarty;
    $name = $arr["name"];
    $phone = $arr["phone"];
    $caracter = $arr["caracter"];
    $smarty->assign('name', $name);
    $smarty->assign('phone', $phone);
    $smarty->assign('comments', $caracter);
    $html = $smarty->fetch('inner-tpl/forms/backcall/backCallMail.tpl');
    return $html;
}







