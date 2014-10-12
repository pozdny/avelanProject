<?php
if (!isset($_SESSION)) {
    session_start();
}
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 17.06.14
 * Time: 17:01
 */
header("Content-Type: text/plain");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
// configs
define('SMARTY_DIR', '../libs/');
require_once '../include/config.php';
// BD
require_once('../connection/DBClass.php');
// Smarty
require_once '../libs/Smarty.class.php';
$smarty = new Smarty();
require_once '../libs/setup.php';
require_once('../include/include.php');

if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
{
    header('Content-Type:text/javascript; charset=utf-8');
    error404(SAPI_NAME, REQUEST_URL);
    exit('no AJAX');
}
else{
    header('Content-Type:text/javascript; charset=utf-8');
    if (isset( $_POST["num"]))
    {
        if (isset( $_POST["id"])) $id = $_POST['id'];
        else $id = 1;
        if (isset( $_POST["value"])){
            $value = $_POST['value'];
        }
        else{
            $value = null;
        }
        $num = $_POST['num'];
        switch($num)
        {
            case 1: BackCall($value);
                break;
            case 2: login($value);
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
    //  config
    require_once('../lib/phpmailer/config.php');

    //  FreakMailer
    require_once('../lib/MailClass.inc');

    // to-email
    $mailer = new FreakMailer();
    $email = $mailer->to_email;
    $name = $mailer->to_name;
    $email2 = '';
    if(!empty($mailer->to_email2)){
        $email2 = $mailer->to_email2;
    }

    // subject
    $subject = "Заказ обратного звонка";
    $mailer->Subject = $subject;

    // body
    $htmlBody = createMailMessage($arr);
    $mailer->Body = $htmlBody;

    // address
    $mailer->AddAddress($email, $name);
    if($email2!=''){
        $mailer->AddCC($email2, $name);
    }

    if(!$mailer->Send()){
        return '0';
    }
    else{
        $mailer->ClearAddresses();
        $mailer->ClearAttachments();
        return '1';
    }



}
function createMailMessage($arr){
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

function login(){
    $mysqli = M_Core_DB::getInstance();
    $error     = '';
    $login     = '';
    $password  = '';
    $autologin = '';
    $rez       = '';
    //$arr
    $array = $_POST['arr'];
    if(isset($array[0]))
        $login     = $array[0]['value'];
    if(isset($array[1]))
        $password  = $array[1]['value'];
    if(isset($array[2]))
        $autologin = $array[2]['value'];
    $login    = GetFormValue(substr($login, 0, 20));
    $password = GetFormValue(substr($password, 0, 20));
    if ( empty( $login )  )
        $error = 'empty_login';
    if ( empty( $password )  )
        $error.= 'empty_password';
    if (empty($error))
    {
        $login_cook = $login;
        $password_cook = $password;
        $login    = $login.SALT_LOG;
        $password = $password.SALT_PAS;
        // find user
        $query = "SELECT * FROM ".TABLE_ADMIN_USERS."
                         WHERE login='".md5($login)."'
						 AND password='".md5($password)."'
			             LIMIT 1";
        $mysqli->_execute($query);
        $user = $mysqli->fetch();
        if ($mysqli->num_rows() > 0 )
        {
            $rights  = $user['rights'];
            $_SESSION["MM_Username"] = $user;
            setLastVisit();
            setcookie( 'name', '', time() - 1, "/", HOST_NAME );
            setcookie( 'password', '', time() - 1, "/", HOST_NAME );
            setcookie( 'group', '', time() - 1, "/", HOST_NAME );

            setcookie( 'name', $login_cook, time() + 3600*24*COOKIE_TIME, "/", HOST_NAME);
            setcookie( 'password', $password_cook, time() + 3600*24*COOKIE_TIME, "/", HOST_NAME);
            setcookie( 'group', $rights, time() + 3600*24*COOKIE_TIME, "/", HOST_NAME);
            if($autologin=='yes'){
                setcookie( 'autologin', 'yes', time() + 3600*24*COOKIE_TIME, "/");
            }

            $rez = 'yes';

        }
        else
        {
            $rez = 'no';
        }
    }
    else
    {
        if($error == 'empty_login')
            $rez = 'empty_login';
        else if($error == 'empty_password')
            $rez = 'empty_password';
        else
            $rez = 'empty_both';
    }

    $options=array(
        "rez"=>$rez
    );
    echo json_encode($options);
}
function setLastVisit()
{
    $mysqli = M_Core_DB::getInstance();
    if ( isset($_SESSION["MM_Username"]))
    {
        $query = "SELECT * FROM ".TABLE_ADMIN_USERS."
	        WHERE id=".$_SESSION["MM_Username"]["id"] ;
        $mysqli->_execute( $query );
        $row = $mysqli->fetch();

        $_SESSION['last_visit'] = $row;
        $query = "UPDATE ".TABLE_ADMIN_USERS."
	        SET last_visit=NOW()
			WHERE id=".$_SESSION["MM_Username"]["id"] ;
        $mysqli->query( $query );
    }
}







