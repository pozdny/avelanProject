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

        if (isset( $_POST["table"])) $table = $_POST['table'];
        else $table = '';

        if (isset( $_POST["value"])) $value = $_POST['value'];
        else $value = null;

        $num = $_POST['num'];
        switch($num)
        {
            case 1: backCall($value);
                break;
            case 2: login($value);
                break;
            case 3: checkView();
                break;
            case 4: delAction($id, $value, $table);
                break;
            case 5: putAction($id, $value, $table);
                break;
            case 6: editAction($id, $value, $table);
                break;
            case 7: respData($value);
                break;
            default: backCall($value);
        }
    }
}
//редактирование пунктов
function editAction($id, $value, $table){
    $mysqli = M_Core_DB::getInstance();
    $error = $link = $link_change = '';
    if($table == CATALOG_MENU){
        $query = "SELECT * FROM ".$table."
                  WHERE id = ".$id;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $eng   = $row['eng'];
        $title = $row['title'];
        $titlepage   = $row['titlepage'];
        $keywords    = $row['keywords'];
        $description = $row['description'];
        foreach($value as $key=>$val){
            if($val['name'] == 'eng')    $eng   = GetFormValue($val['value']);
            if($val['name'] == 'rus')    $title = GetFormValue($val['value']);
            if($val['name'] == 'titlepage')   $titlepage   = GetFormValue($val['value']);
            if($val['name'] == 'keywords')    $keywords    = GetFormValue($val['value']);
            if($val['name'] == 'description') $description = GetFormValue($val['value']);
            if($val['name'] == 'link')   $link  = ($val['value']);
        }
        if(!empty($eng)){
            $query = "SELECT id,eng FROM ".$table;
            $mysqli->_execute($query);
            while($row = $mysqli->fetch()){
                if($eng == $row["eng"] && $id !=$row["id"]){
                    $error = 'не уникальное значение названия по-английски';
                }
                elseif($eng != $row["eng"] && $id ==$row["id"]){
                    $link_change = "yes";
                }
            }
        }
        if(empty($error)){
            $query = sprintf("UPDATE ".$table." SET `title`=%s, `eng`=%s, `titlepage`=%s, `keywords`=%s, `description`=%s  WHERE id=%s",
                GetSQLValueString($title, "text"),
                GetSQLValueString($eng, "text"),
                GetSQLValueString($titlepage, "text"),
                GetSQLValueString($keywords, "text"),
                GetSQLValueString($description, "text"),
                GetSQLValueString($id, "int"));
            $mysqli->query($query);
            if($link_change == 'yes'){
                $query = "SELECT eng FROM ".$table." WHERE id = ".$id;
                $mysqli->_execute($query);
                $row = $mysqli->fetch();
                $link_eng = $row["eng"];
                $link = ADMIN_PANEL."/edit_catalog/".$link_eng."/menu";
            }
        }
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == CATALOG_SUBMENU){
        $query = "SELECT * FROM ".$table."
                  WHERE id = ".$id;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $titlepage   = $row['titlepage'];
        $keywords    = $row['keywords'];
        $description = $row['description'];
        foreach($value as $key=>$val){
            if($val['name'] == 'titlepage')   $titlepage   = GetFormValue($val['value']);
            if($val['name'] == 'keywords')    $keywords    = GetFormValue($val['value']);
            if($val['name'] == 'description') $description = GetFormValue($val['value']);
            if($val['name'] == 'link')        $link      = ($val['value']);
        }
        $query = sprintf("UPDATE ".$table." SET `titlepage`=%s, `keywords`=%s, `description`=%s  WHERE id=%s",
            GetSQLValueString($titlepage, "text"),
            GetSQLValueString($keywords, "text"),
            GetSQLValueString($description, "text"),
            GetSQLValueString($id, "int"));
        $mysqli->query($query);
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == CATALOG_ALL){
        $query = "SELECT * FROM ".$table."
                  WHERE id = ".$id;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $titlepage   = $row['titlepage'];
        $keywords    = $row['keywords'];
        $description = $row['description'];

        foreach($value as $key=>$val){
            if($val['name'] == 'titlepage')   $titlepage   = GetFormValue($val['value']);
            if($val['name'] == 'keywords')    $keywords    = GetFormValue($val['value']);
            if($val['name'] == 'description') $description = GetFormValue($val['value']);
            if($val['name'] == 'link')        $link      = ($val['value']);
        }
        $query = sprintf("UPDATE ".$table." SET `titlepage`=%s, `keywords`=%s, `description`=%s  WHERE id=%s",
            GetSQLValueString($titlepage, "text"),
            GetSQLValueString($keywords, "text"),
            GetSQLValueString($description, "text"),
            GetSQLValueString($id, "int"));
        $mysqli->query($query);
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == NAVIGATOR){
        $query = "SELECT * FROM ".NAVIGATOR."
                  WHERE id = ".$id;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $titlepage   = $row['titlepage'];
        $keywords    = $row['keywords'];
        $description = $row['description'];
        $zagolovok   = $row['zagolovok'];
        $content     = $row['content'];
        foreach($value as $key=>$val){
            if($val['name'] == 'titlepage')   $titlepage   = GetFormValue($val['value']);
            if($val['name'] == 'keywords')    $keywords    = GetFormValue($val['value']);
            if($val['name'] == 'description') $description = GetFormValue($val['value']);
            if($val['name'] == 'zagolovok')   $zagolovok   = GetFormValue($val['value']);
            if($val['name'] == 'content')     $content     = ($val['value']);
            if($val['name'] == 'link')        $link        = ($val['value']);
        }
        $query = sprintf("UPDATE ".$table." SET `zagolovok`=%s, `content`=%s, `titlepage`=%s, `keywords`=%s, `description`=%s  WHERE id=%s",
            GetSQLValueString($zagolovok, "text"),
            GetSQLValueString($content, "text"),
            GetSQLValueString($titlepage, "text"),
            GetSQLValueString($keywords, "text"),
            GetSQLValueString($description, "text"),
            GetSQLValueString($id, "int"));
        $mysqli->query($query);
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == TABLE_ADMIN_USERS){
        $query = "SELECT * FROM ".TABLE_ADMIN_USERS."
                  WHERE id = ".$id;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        foreach($value as $key=>$val){
            if($val['name'] == 'name')     $name     = GetFormValue($val['value']);
            if($val['name'] == 'login')    $login    = GetFormValue($val['value']);
            if($val['name'] == 'password') $password = GetFormValue($val['value']);
            if($val['name'] == 'link')     $link        = ($val['value']);
        }
        if(empty($name))     $name     = $row['name'];
        if(empty($login))    $login    = $row['login'];
        else $login = md5($login.SALT_LOG);
        if(empty($password)) $password = $row['password'];
        else $password = md5($password.SALT_PAS);
        $query = sprintf("UPDATE ".$table." SET `name`=%s, `login`=%s, `password`=%s WHERE id=%s",
            GetSQLValueString($name, "text"),
            GetSQLValueString($login, "text"),
            GetSQLValueString($password, "text"),
            GetSQLValueString($id, "int"));
        $mysqli->query($query);
        $options=array(
            "link" => $link,
            "error" => $error
        );
        echo json_encode($options);
    }
    elseif($table == TABLE_INFO){
        $gerld = $effect = 'off';

        foreach($value as $key=>$val){
            if($val['name'] == 'name')          $name     = GetFormValue($val['value']);
            if($val['name'] == 'email')         $email    = GetFormValue($val['value']);
            if($val['name'] == 'phone')         $phone    = GetFormValue($val['value']);
            if($val['name'] == 'phone_service') $phone_service = GetFormValue($val['value']);
            if($val['name'] == 'shadule')       $shadule  = GetFormValue($val['value']);
            if($val['name'] == 'shadule1')      $shadule1 = GetFormValue($val['value']);
            if($val['name'] == 'address')       $address  = GetFormValue($val['value']);
            if($val['name'] == 'gerld')         $gerld    = GetFormValue($val['value']);
            if($val['name'] == 'effect')        $effect   = GetFormValue($val['value']);
            if($val['name'] == 'link')          $link     = ($val['value']);

        }
        $query = sprintf("UPDATE ".$table." SET `company_name`=%s, `company_address`=%s, `company_phone`=%s, `company_phone_service`=%s, `company_mail`=%s WHERE id=1",
            GetSQLValueString($name, "text"),
            GetSQLValueString($address, "text"),
            GetSQLValueString($phone, "text"),
            GetSQLValueString($phone_service, "text"),
            GetSQLValueString($email, "text"));
        $mysqli->query($query);
        $query = sprintf("UPDATE ".SHADULE." SET `content`=%s WHERE id=1",
            GetSQLValueString($shadule, "text"));
        $mysqli->query($query);
        $query = sprintf("UPDATE ".SHADULE." SET `content`=%s WHERE id=2",
            GetSQLValueString($shadule1, "text"));
        $mysqli->query($query);
        $query = sprintf("UPDATE ".OPTIONS." SET `value`=%s WHERE id=1",
            GetSQLValueString($gerld, "text"));
        $mysqli->query($query);
        $query = sprintf("UPDATE ".OPTIONS." SET `value`=%s WHERE id=2",
            GetSQLValueString($effect, "text"));
        $mysqli->query($query);

        $options=array(
            "link" => $link,
            "error" => $error
        );
        echo json_encode($options);
    }
    elseif($table == SCHET){
        $i = 1;
        foreach($value as $key=>$val){
            if($val['name'] == 'schet_'.$i) $content  = $val['value'];
            if($val['name'] == 'link')          $link     = ($val['value']);
            $query = sprintf("UPDATE ".SCHET." SET `content`=%s WHERE id=%s",
                GetSQLValueString($content, "text"),
                GetSQLValueString($i, "int"));
            $mysqli->query($query);
            $i++;
        }
        $options=array(
            "link" => $link,
            "error" => $error
        );
        echo json_encode($options);
    }
    elseif($table == SERVICES){
        $query = "SELECT * FROM ".$table."
                  WHERE id = ".$id;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $title    = $row['title'];
        $eng      = $row['eng'];
        $content  = $row['content'];
        $titlepage   = $row['titlepage'];
        $keywords    = $row['keywords'];
        $description = $row['description'];
        foreach($value as $key=>$val){
            if($val['name'] == 'eng')         $eng         = GetFormValue($val['value']);
            if($val['name'] == 'rus')         $title       = GetFormValue($val['value']);
            if($val['name'] == 'content')     $content     = $val['value'];
            if($val['name'] == 'titlepage')   $titlepage   = GetFormValue($val['value']);
            if($val['name'] == 'keywords')    $keywords    = GetFormValue($val['value']);
            if($val['name'] == 'description') $description = GetFormValue($val['value']);
            if($val['name'] == 'link')   $link  = ($val['value']);
        }
        if(!empty($eng)){
            $query = "SELECT id,eng FROM ".$table;
            $mysqli->_execute($query);
            while($row = $mysqli->fetch()){
                if($eng == $row["eng"] && $id !=$row["id"]){
                    $error = 'не уникальное значение названия по-английски';
                }

            }
        }
        if(empty($error)){
            $query = sprintf("UPDATE ".$table." SET `title`=%s, `eng`=%s, `content`=%s, `titlepage`=%s, `keywords`=%s, `description`=%s WHERE id=%s",
                GetSQLValueString($title, "text"),
                GetSQLValueString($eng, "text"),
                GetSQLValueString($content, "text"),
                GetSQLValueString($titlepage, "text"),
                GetSQLValueString($keywords, "text"),
                GetSQLValueString($description, "text"),
                GetSQLValueString($id, "int"));
            $mysqli->query($query);

        }
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == RABOTY){
        $query = "SELECT * FROM ".$table."
                  WHERE id = ".$id;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $titlepage   = $row['titlepage'];
        $keywords    = $row['keywords'];
        $description = $row['description'];
        foreach($value as $key=>$val){
            if($val['name'] == 'titlepage')   $titlepage   = GetFormValue($val['value']);
            if($val['name'] == 'keywords')    $keywords    = GetFormValue($val['value']);
            if($val['name'] == 'description') $description = GetFormValue($val['value']);
            if($val['name'] == 'link')   $link  = ($val['value']);
        }
        if(empty($error)){
            $query = sprintf("UPDATE ".$table." SET `titlepage`=%s, `keywords`=%s, `description`=%s WHERE id=%s",
                GetSQLValueString($titlepage, "text"),
                GetSQLValueString($keywords, "text"),
                GetSQLValueString($description, "text"),
                GetSQLValueString($id, "int"));
            $mysqli->query($query);

        }
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    else{
        foreach($value as $key=>$val){
            if($val['name'] == 'content')     $content = ($val['value']);
            $query = sprintf("UPDATE ".$table." SET `content`=%s WHERE id=%s",
                GetSQLValueString($content, "text"),
                GetSQLValueString($id, "int"));
            $mysqli->query($query);
        }
        $options=array(
            "link" => '/admin/'
        );
        echo json_encode($options);
    }



}

//добавление пунктов
function putAction($id, $value, $table){
    $mysqli = M_Core_DB::getInstance();
    $error = $link = '';
    if($table == CATALOG_SUBMENU){
        foreach($value as $key=>$val){
            if($val['name'] == 'addinput[]'){
                $query = "SELECT id FROM ".CATALOG_SUBMENU." ORDER BY id DESC LIMIT 1";
                $k = $mysqli->queryQ($query);
                $row = $mysqli->fetchAssoc($k);
                $last_id = $row['id']+1;
                $title = GetFormValue($val['value']);
                $eng = 'default_'.$last_id;
                $query = sprintf('INSERT INTO '.$table.' (`id`, `title`, `eng`, `menu_id`) VALUES (%s, %s, %s, %s)',
                    GetSQLValueString($last_id, 'text'),
                    GetSQLValueString($title, 'text'),
                    GetSQLValueString($eng, 'text'),
                    GetSQLValueString($id, 'int'));
                $mysqli->query($query);
            }
            if($val['name'] == 'link')  $link = ($val['value']);
        }
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == CATALOG_ALL){
        foreach($value as $key=>$val){
            if($val['name'] == 'addinput[]'){
                $title = GetFormValue($val['value']);
                $query = "SELECT id FROM ".CATALOG_ALL." ORDER BY id DESC LIMIT 1";
                $k = $mysqli->queryQ($query);
                $row = $mysqli->fetchAssoc($k);
                $last_id = $row['id']+1;
                $eng = 'default_'.$last_id;
                $query = sprintf('INSERT INTO '.$table.' (`id`, `title`, `eng`, `submenu_id`) VALUES (%s, %s, %s, %s)',
                    GetSQLValueString($last_id, 'int'),
                    GetSQLValueString($title, 'text'),
                    GetSQLValueString($eng, 'text'),
                    GetSQLValueString($id, 'int'));
                $mysqli->query($query);
            }
            if($val['name'] == 'link')  $link = ($val['value']);
        }
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == SERVICES){
        foreach($value as $key=>$val){
            if($val['name'] == 'title'){
                $query = "SELECT id FROM ".SERVICES." ORDER BY id DESC LIMIT 1";
                $k = $mysqli->queryQ($query);
                $row = $mysqli->fetchAssoc($k);
                $last_id = $row['id']+1;
                $title = GetFormValue($val['value']);
                $eng = 'default_'.$last_id;
                $query = sprintf('INSERT INTO '.$table.' (`title`, `eng`) VALUES (%s, %s)',
                    GetSQLValueString($title, 'text'),
                    GetSQLValueString($eng, 'text'));
                $mysqli->query($query);
            }
            if($val['name'] == 'link')  $link = ($val['value']);
        }
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == RABOTY){
        foreach($value as $key=>$val){
            if($val['name'] == 'title'){
                $title = GetFormValue($val['value']);
                $query = sprintf('INSERT INTO '.$table.' (`title`) VALUES (%s)',
                    GetSQLValueString($title, 'text'));
                $mysqli->query($query);
            }
            if($val['name'] == 'link')  $link = ($val['value']);
        }
        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == TABLE_ADMIN_USERS){
        $name = '';
        foreach($value as $key=>$val){
            if($val['name'] == 'title')    $name = GetFormValue($val['value']);
            if($val['name'] == 'link')     $link = ($val['value']);
        }
        $query  = "SELECT * FROM ".$table."
			   		WHERE `name` REGEXP '^".$name."$'";
        $mysqli->_execute($query);

        if ( preg_match( "/[&$^%#*@!+=(){}:;\/]+$/i",  $name) )
            $error = $error.'название содержит недопустимые символы (пробел, %, $ и т.д.)';
        if ( empty($name))
            $error = $error.'название оператора не заполнено';
        if($mysqli->num_rows() >0){
            $error = $error.'оператор с именем '.$name.' уже существует!!!';
        }
        if(empty($error)){
            $login = md5($name.SALT_LOG);
            $password = md5($name.SALT_PAS);
            $query = sprintf('INSERT INTO '.$table.' (`name`, `login`, `password`, `rights`) VALUES (%s, %s, %s, %s)',
                GetSQLValueString($name, 'text'),
                GetSQLValueString($login, 'text'),
                GetSQLValueString($password, 'text'),
                GetSQLValueString('m', 'text'));
            $mysqli->query($query);
        }

        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
}
//удаление
function delAction($id, $value, $table)
{
    $mysqli = M_Core_DB::getInstance();
    $error = '';

    if($table == CATALOG_SUBMENU)// Удалить подкатегорию товара
    {
        $arr = array();
        foreach($value as $key=>$val){
            if($val['name'] == 'del[]')  $arr[] = ($val['value']);
            if($val['name'] == 'link')  $link = ($val['value']);
        }
        //$arr = implode( ',',$arr);

        foreach($arr as $key=>$value){
            $query = "SELECT * FROM ".CATALOG_ALL."
			          WHERE ".CATALOG_ALL.".submenu_id = ".$value;
            $l = $mysqli->queryQ($query);
            if($mysqli->num_r($l) > 0){
                while($row = $mysqli->fetchAssoc($l)){
                    $query = 'DELETE FROM '. CATALOG_ALL.' WHERE id ='.$row["id"];
                    $mysqli->query($query);
                }
            }
            $query = 'DELETE FROM '. $table.' WHERE id ='.$value;
            $mysqli->query($query);
        }

        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    elseif($table == CATALOG_ALL)
    { //echo '<pre>'; print_r($value); echo '</pre>';
        $arr = array();

        foreach($value as $key=>$val){
            if($val['name'] == 'del[]')  $arr[] = ($val['value']);
            if($val['name'] == 'link')  $link = ($val['value']);
        }
        $arr = implode( ',',$arr);

        $query = 'DELETE FROM '. $table.' WHERE id IN ('.$arr.')';
        $mysqli->query($query);

        $options=array(
            "link" => $link,
            "error"=> $error
        );
        echo json_encode($options);
    }
    else // Удалить позицию из таблиц $table
    {
        if($table == CATALOG_MENU.'_main')// Удалить категорию товара
        {
            $query = "SELECT * FROM ".CATALOG_SUBMENU."
			          WHERE ".CATALOG_SUBMENU.".menu_id = ".$id;
            $l = $mysqli->queryQ($query);
            if($mysqli->num_r($l) > 0){
                while($row = $mysqli->fetchAssoc($l)){
                    $query = "SELECT * FROM ".CATALOG_ALL."
			                  WHERE ".CATALOG_ALL.".submenu_id = ".$row["id"];
                    $n = $mysqli->queryQ($query);
                    if($mysqli->num_r($n) > 0){
                        while($row_n = $mysqli->fetchAssoc($n)){
                            $query = 'DELETE FROM '. CATALOG_ALL.' WHERE id ='.$row_n["id"];
                            $mysqli->query($query);
                        }
                     }

                    $query = 'DELETE FROM '. CATALOG_SUBMENU.' WHERE id ='.$row["id"];
                    $mysqli->query($query);
                }
            }
            $query = 'DELETE FROM '. CATALOG_MENU.' WHERE id ='.$id;
            $mysqli->query($query);
        }
        elseif($table == CATALOG_SUBMENU.'_main')// Удалить подкатегорию товара
        {
            $query = "SELECT * FROM ".CATALOG_ALL."
                      WHERE ".CATALOG_ALL.".submenu_id = ".$id;
            $l = $mysqli->queryQ($query);
            if($mysqli->num_r($l) > 0){
                while($row = $mysqli->fetchAssoc($l)){
                    $query = 'DELETE FROM '. CATALOG_ALL.' WHERE id ='.$row["id"];
                    $mysqli->query($query);
                }
            }
            $query = 'DELETE FROM '. CATALOG_SUBMENU.' WHERE id ='.$id;
            $mysqli->query($query);

        }
        elseif($table == CATALOG_ALL.'_main')// Удалить подподкатегорию товара
        {
            $query = 'DELETE FROM '. CATALOG_ALL.' WHERE id ='.$id;
            $mysqli->query($query);
        }
        else{
            $query = 'DELETE FROM '. $table.' WHERE id ='.$id;
            $mysqli->query($query);
        }

        $options=array(
            "link"=>$value,
            "error"=> $error
        );
        echo json_encode($options);

    }

}
function backCall($value){
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
function respData($value){
    $mysqli = M_Core_DB::getInstance();
    $now_date = time();
    foreach($value as $key=>$val){
        if($val['name'] == 'respSelect')         $cat_id     = GetFormValue($val['value']);
        if($val['name'] == 'respTxt')            $content    = GetFormValue($val['value']);
    }
    $query = "INSERT INTO ".RESP_TXT." (`content`, `cat_id`, `date`) VALUES ('".$content."', '".$cat_id."', '".$now_date."')";
    try{
        $mysqli->query($query);
        $rez = '1';
    }
    catch(Exception $e){
        $rez = $e->getMessage();
    }

    $options=array(
        "rez"=>$rez
    );
    echo json_encode($options);
}
function sendmail($arr){
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
            setcookie( 'sessionStatus', '', time() - 1, "/", HOST_NAME );

            setcookie( 'name', $login_cook, time() + 3600*24*COOKIE_TIME, "/", HOST_NAME);
            setcookie( 'password', $password_cook, time() + 3600*24*COOKIE_TIME, "/", HOST_NAME);
            setcookie( 'group', $rights, time() + 3600*24*COOKIE_TIME, "/", HOST_NAME);
            if(!isset( $_COOKIE['sessionStatus'] )) {
                setcookie('sessionStatus', session_id(), time() + 3600*24*COOKIE_TIME, '/');
            }

            if($autologin=='yes'){
                setcookie( 'autologin', 'yes', time() + 3600*24*COOKIE_TIME, "/");
            }

            $rez = 'ok';

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
function checkView()
{
    $mysqli = M_Core_DB::getInstance();
    $file_name = 'structure.xml';
    $file = '../xml/1C/'.$file_name;
    $query = "SELECT hash FROM ".TABLE_INFO;
    $x = $mysqli->queryQ($query);
    $row = $mysqli->fetchAssoc($x);
    $hash_old = $row["hash"];
    if(!file_exists($file))
    {
        return false;
    }
    else
    {
        $hash_new = md5_file($file);
        $result = strcmp($hash_old, $hash_new);
        if($result){
            update_tables($file);
            $query = sprintf("UPDATE ".TABLE_INFO." SET hash=%s",
                GetSQLValueString($hash_new, "text"));
            $mysqli->query($query);

        }
        return true;
    }
    $options=array(
        "hash_old"=>$hash_old,
        "hash_new"=>$hash_new
    );
    echo json_encode($options);
}
function update_tables($file)
{
    $mysqli = M_Core_DB::getInstance();
    ////////////////////////////////////////////
    require_once '../xml/one_C.php';
    try
    {
        $cl = new structDocument();
        $cl->loadStruct($file);
        $tab_menu = $cl->getAllTab($tabs, 'menu');
        $tab_submenu = $cl->getAllTab($tabs, 'submenu');
        $tab_all = $cl->getAllTab($tabs, 'catalog_all');
        $tab_desc = $cl->getAllTab($tab_desc, 'description');
        $menu_name = 'rashodnyye-materialy';
        // UPDATE, INSERT и DELETE для таблицы catalog_menu
        /*foreach($tab_menu as $list)
        {
            $array_List = array();
            $list_data = $list->data;
            foreach($list_data as $table)
            {
                $id               = $table->id;
                $array_List[]     = $id;
                $title            = $table->title;
                $title            = iconv('UTF-8', 'windows-1251',trim($title));
                // Проверяем есть ли такой id в таблице
                $query = "SELECT * FROM ".CATALOG_MENU." WHERE id=".$id;
                $d = mysql_query($query) or die(mysql_error());
                $row_d = mysql_fetch_assoc($d);
                if($row_d)
                {
                    $updateSQL = sprintf('UPDATE '.CATALOG_MENU.' SET title=%s  WHERE id=%s',
                       GetSQLValueString($title, 'text'),
                       GetSQLValueString($id, 'int'));
                    mysql_query($updateSQL);
                }
                else
                {
                    $title_eng = 'default_'.$id;
                    $insertSQL = sprintf('INSERT INTO '.CATALOG_MENU.' (`id`, `title`, eng) VALUES (%s, %s, %s)',
                       GetSQLValueString($id, 'int'),
                       GetSQLValueString($title, 'text'),
                       GetSQLValueString($title_eng, 'text'));
                    mysql_query( $insertSQL );
                }
            }
            // Удаляем строки из таблицы которых нет в sturcture.xml
            $query = "SELECT id FROM ".CATALOG_MENU;
            $d = mysql_query($query) or die(mysql_error());
            $row_d = mysql_fetch_assoc($d);
            do
            {
                $id = $row_d['id'];
                if ( !in_array( $id, $array_List ) )
                {
                    $query = "DELETE FROM ".CATALOG_MENU." WHERE id=".$id;
                    mysql_query( $query );
                }

            }while($row_d = mysql_fetch_assoc($d));
        }
        // END UPDATE, INSERT и DELETE для таблицы catalog_menu*/
        // UPDATE, INSERT и DELETE для таблицы catalog_submenu
        foreach($tab_submenu as $list){
            $array_List = array();
            $list_data = $list->data;
            foreach($list_data as $table){
                $id               = $table->id;
                $array_List[]     = $id;
                $title            = $table->title;
                $title            = trim($title);
                $menu_id          = $table->menu_id;

                // Проверяем есть ли такой id в таблице
                $query = "SELECT * FROM ".CATALOG_SUBMENU." WHERE id=".$id;
                $d = $mysqli->queryQ($query);
                if($mysqli->num_r($d) > 0){
                    $updateSQL = sprintf('UPDATE '.CATALOG_SUBMENU.' SET title=%s, menu_id=%s WHERE id=%s',
                        GetSQLValueString($title, 'text'),
                        GetSQLValueString($menu_id, 'int'),
                        GetSQLValueString($id, 'int'));
                    $mysqli->query($updateSQL);
                }
                else{
                    $title_eng = 'default_'.$id;
                    $insertSQL = sprintf('INSERT INTO '.CATALOG_SUBMENU.' (`id`, `title`, menu_id, eng, titlepage) VALUES (%s, %s, %s, %s, %s)',
                        GetSQLValueString($id, 'int'),
                        GetSQLValueString($title, 'text'),
                        GetSQLValueString($menu_id, 'int'),
                        GetSQLValueString($title_eng, 'text'),
                        GetSQLValueString($title, 'text'));
                    $mysqli->query($insertSQL);
                }

            }
            // Удаляем строки из таблицы которых нет в sturcture.xml
            $query = "SELECT ".CATALOG_SUBMENU.".id FROM ".CATALOG_SUBMENU."
			          INNER JOIN ".CATALOG_MENU." ON ".CATALOG_MENU.".id = ".CATALOG_SUBMENU.".menu_id
					  WHERE ".CATALOG_MENU.".eng LIKE '".$menu_name."'";
            $d = $mysqli->queryQ($query);
            while($row_d = $mysqli->fetchAssoc($d)){
                $id = $row_d['id'];
                if ( !in_array( $id, $array_List ) ){
                    $query = "DELETE FROM ".CATALOG_SUBMENU." WHERE id=".$id;
                    $mysqli->query($query);
                }
            }
        }
        // END UPDATE, INSERT и DELETE для таблицы catalog_submenu
        // UPDATE, INSERT и DELETE для таблицы catalog_all
        foreach($tab_all as $list){

            $array_List = array();
            $list_data = $list->data;
            foreach($list_data as $table){
                $id               = $table->id;
                $array_List[]     = $id;
                $title            = $table->title;
                $title            = trim($title);
                $submenu_id       = $table->submenu_id;
                // Проверяем есть ли такой id в таблице
                $query = "SELECT * FROM ".CATALOG_ALL." WHERE id=".$id;
                $d = $mysqli->queryQ($query);
                if($mysqli->num_r($d) > 0){
                    $updateSQL = sprintf('UPDATE '.CATALOG_ALL.' SET title=%s, submenu_id=%s  WHERE id=%s',
                        GetSQLValueString($title, 'text'),
                        GetSQLValueString($submenu_id, 'int'),
                        GetSQLValueString($id, 'int'));
                    $mysqli->query($updateSQL);
                }
                else{
                    $title_eng = 'default_'.$id;
                    $insertSQL = sprintf('INSERT INTO '.CATALOG_ALL.' (`id`, `title`, submenu_id, eng, titlepage) VALUES (%s, %s, %s, %s, %s)',
                        GetSQLValueString($id, 'int'),
                        GetSQLValueString($title, 'text'),
                        GetSQLValueString($submenu_id, 'int'),
                        GetSQLValueString($title_eng, 'text'),
                        GetSQLValueString($title, 'text'));
                    $mysqli->query($insertSQL);
                }

            }
            // Удаляем строки из таблицы которых нет в sturcture.xml
            $query = "SELECT ".CATALOG_ALL.".id FROM ".CATALOG_ALL."
			          INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_SUBMENU.".id = ".CATALOG_ALL.".submenu_id
			          INNER JOIN ".CATALOG_MENU." ON ".CATALOG_MENU.".id = ".CATALOG_SUBMENU.".menu_id
					  WHERE ".CATALOG_MENU.".eng LIKE '".$menu_name."'";
            $d = $mysqli->queryQ($query);
            while($row_d = $mysqli->fetchAssoc($d)){
                $id = $row_d['id'];
                if ( !in_array( $id, $array_List ) ){
                    $query = "DELETE FROM ".CATALOG_ALL." WHERE id=".$id;
                    $mysqli->query($query);
                }
            }
        }
        // END UPDATE, INSERT и DELETE для таблицы catalog_all
        // UPDATE, INSERT и DELETE для таблицы description
        foreach($tab_desc as $list){
            $array_List = array();
            $list_data = $list->data;
            foreach($list_data as $table){
                $id           = $table->id;
                $array_List[] = $id;
                $title        = $table->title;
                $title        = trim($title);
                $price        = $table->price;
                $ed_izm       = $table->ed_izm;
                $all_id       = $table->all_id;
                if(!$price)
                {
                    $price = 0.00;
                }
                if(!$ed_izm)
                {
                    $ed_izm = '';
                }
                // Проверяем есть ли такой id в таблице
                $query = "SELECT * FROM ".DESC." WHERE id=".$id;
                $d = $mysqli->queryQ($query);
                if($mysqli->num_r($d) > 0){
                    $updateSQL = sprintf("UPDATE ".DESC." SET title=%s, price=%s, ed_izm=%s, all_id=%s   WHERE id=%s",
                        GetSQLValueString($title, 'text'),
                        GetSQLValueString($price, 'float'),
                        GetSQLValueString($ed_izm, 'text'),
                        GetSQLValueString($all_id, 'int'),
                        GetSQLValueString($id, 'text'));
                    $mysqli->query($updateSQL);
                }
                else{
                    $insertSQL = sprintf("INSERT INTO ".DESC." (`id`, `title`, price, ed_izm, all_id ) VALUES (%s, %s, %s, %s, %s)",
                        GetSQLValueString($id, "text"),
                        GetSQLValueString($title, "text"),
                        GetSQLValueString($price, "float"),
                        GetSQLValueString($ed_izm, "text"),
                        GetSQLValueString($all_id, "int"));
                    $mysqli->query($insertSQL);
                }

            }
            // Удаляем строки из таблицы которых нет в sturcture.xml
            $query = "SELECT id FROM ".DESC;
            $d = $mysqli->queryQ($query);
            while($row_d = $mysqli->fetchAssoc($d)){
                $id = $row_d['id'];
                if ( !in_array( $id, $array_List ) ){
                    $query = "DELETE FROM ".DESC." WHERE id=".$id;
                    $mysqli->query($query);
                }

            }
        }
        // END UPDATE, INSERT и DELETE для таблицы description
        //unlink($file);
        return true;
    }
    catch(Exception $e)
    {
        echo $e.'no no no';
    }

}







