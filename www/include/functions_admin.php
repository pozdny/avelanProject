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
    $url = HOME_URL;
    $month = array("01" => "января", "02" => "февраля", "03" => "марта", "04" => "апреля", "05" => "мая", "06" => "июня", "07" => "июля", "08" => "августа", "09" => "сентября",
        "10" => "октября", "11" => "ноября", "12" => "декабря"
    );
    $week = array('воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота');
    $date_m = strtr(date('m'), $month);
    $date_w = $week[date('w')];
    $date_d = date('d');
    $now_date = $date_d.' '.$date_m.' '.date('Y').', '.$date_w;
    $date = '<span '.STYLE9.'><span '.DOTTED.'>'.$now_date.'</span></span>';
    $titlepage = 'Админ. панель';
    $hello = hello();
    $smarty->assign('title', $title);
    $smarty->assign('url', $url);
    $smarty->assign('date', $date);
    $smarty->assign('titlepage', $titlepage);
    $smarty->assign('hello', $hello);
    $html = $smarty->fetch('header.tpl');
    return $html;
}
function left()
{
    $array_pages = array();
    $array_products = array();
    $array_dif_tab = array();
    require('include/arrays.php');
    global $arResult;
    global $smarty;
    $AdminMenu = $arResult->DATA["AdminMenu"];
    $li = '';

    $action = $arResult->ACTION;
    foreach($AdminMenu as  $menu){
        $eng_menu   = $menu["eng"];
        $title_menu = $menu["title"];//echo $eng_menu.' '.$action.'<br>';
        ($eng_menu == $action || ((in_array($action, $array_pages)) && $eng_menu == $array_pages[0])
            || ((in_array($action, $array_products)) && $eng_menu == $array_products[0])
            || ((in_array($action, $array_dif_tab)) && $eng_menu == $array_dif_tab[0])
            || 'edit_'.$eng_menu == $action
        )? $li_menu = "active" : $li_menu = "";
        $li.='<li class="'.$li_menu.'"><a href="/admin/'.$eng_menu.'">'.$title_menu.'</a>';

        $li.='</li>';
    }

    $smarty->assign('li', $li);
    $html = $smarty->fetch('left.tpl');

    return $html;
}
//................редактирование данных товара.........................//
function admin_product(){
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    //...............категория товара..............................//
    $i = 0;
    $html = '';
    $query = "SELECT ".CATALOG_MENU.".id, ".CATALOG_MENU.".title, ".CATALOG_MENU.".eng FROM ".CATALOG_MENU."
			  WHERE ".CATALOG_MENU.".eng != 'services'
			  ORDER BY ".CATALOG_MENU.".id";
    $c = $mysqli->queryQ($query);
    $query = "SELECT title, link FROM ".ADMIN_ACTIONS." ORDER BY id LIMIT 1,1";
    $d = $mysqli->queryQ($query);
    $row_d = $mysqli->fetchAssoc($d);

    $html.= '<div class="a_color_line" >Товары</div>';
    $html.='<table class="table table-bordered table-condensed">';
    $html.='<tr><th width="45%">Наименование</th><th width="35%">english</th><th>F</th><th>Q</th><th>M</th><th>D</th></tr>';
    if($mysqli->num_r($c) > 0){
        while($row_c = $mysqli->fetchAssoc($c)){
            $num = $row_c['id'];
            $product = '';
            $classHidden     = '';
            $reg = preg_match( "#(default_[0-9]{1,})$#ui", $row_c["eng"] );
            $num_k = true;
            if($row_c["eng"] == 'rashodnyye-materialy')
            {
                $query = 'SELECT * FROM '.CATALOG_ALL.'
				          INNER JOIN '.CATALOG_SUBMENU.' ON '.CATALOG_SUBMENU.'.id = '.CATALOG_ALL.'.submenu_id
				          INNER JOIN '.CATALOG_MENU.' ON '.CATALOG_MENU.'.id = '.CATALOG_SUBMENU.'.menu_id
				          INNER JOIN '.DESC.' ON '.DESC.'.all_id = '.CATALOG_ALL.'.id
				          WHERE '.DESC.'.price != 0
				          AND '.CATALOG_MENU.'.eng LIKE "'.$row_c["eng"].'"
				          AND '.CATALOG_SUBMENU.'.eng NOT LIKE "default%"
				          AND '.CATALOG_ALL.'.eng NOT LIKE "default%"';
                $k = $mysqli->queryQ($query);
                $num_k = $mysqli->num_r($k);
            }
            if($reg || !$num_k){
                $classHidden = ' class="classHidden"';
            }
            $title     = '<a href="/catalog/'.$row_c['eng'].'" '.STYLE1.' id="a_'.$num.'">'.$row_c['title'].'</a>';
            $title_eng = '<a href="/catalog/'.$row_c['eng'].'"  '.STYLE9.'>'.$row_c['eng'].'</a>';
            $edit_full =  '<a href="'.ADMIN_PANEL.'/edit_menu/'.$row_c['eng'].'/menu">'.EDIT_IMG.'</a>';
            $edit      =  '<span class="img_edit" onclick="Edit_Title(\''.$num.'\', \'catalog_menu\')">'.EDIT_IMG_Q.'</span>';
            $edit_key  =  '<a href="'.ADMIN_PANEL.'/'.$row_d['link'].'_other/'.$row_c['eng'].'/'.CATALOG_MENU.'" ><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
            $del =  '<span class="img_edit" onclick="Del_Position(\''.$num.'\', \'catalog_menu\');">'.DEL_IMG.'</span>';
            $td =  '<td id="td_'.$num.'"'.$classHidden.' >'.$title.'</td>
		        <td >'.$title_eng.'</td>
			    <td align="center">'.$edit_full.'</td>
       			<td align="center">'.$edit.'</td>
				<td align="center">'.$edit_key.'</td>
				<td align="center">'.$del.'</td>';

            $query = "SELECT ".CATALOG_SUBMENU.".id, ".CATALOG_SUBMENU.".title, ".CATALOG_SUBMENU.".eng FROM ".CATALOG_SUBMENU."
			          WHERE ".CATALOG_SUBMENU.".menu_id =".$row_c['id']."
			          ORDER BY ".CATALOG_SUBMENU.".title";
            $n = $mysqli->queryQ($query);
            if($mysqli->num_r($c) > 0){
                while($row_n = $mysqli->fetchAssoc($n)){
                    //...............подкатегория товара..............................//
                    $num_sub = $row_n['id'];
                    $classHidden     = '';
                    $reg = preg_match( "#(default_[0-9]{1,})$#ui", $row_n["eng"] );
                    $reg2 = preg_match( "#(default_[0-9]{1,})$#ui", $row_c["eng"] );
                    $num_k = true;
                    if($row_c["eng"] == 'rashodnyye-materialy')
                    {
                        //если в таблице CATALOG_ALL все позиции не выводятся, то текущая позиция красная (не выводится)
                        $query = 'SELECT * FROM '.CATALOG_ALL.'
					              INNER JOIN '.CATALOG_SUBMENU.' ON '.CATALOG_SUBMENU.'.id = '.CATALOG_ALL.'.submenu_id
					              INNER JOIN '.CATALOG_MENU.' ON '.CATALOG_MENU.'.id = '.CATALOG_SUBMENU.'.menu_id
					              INNER JOIN '.DESC.' ON '.DESC.'.all_id = '.CATALOG_ALL.'.id
					              WHERE '.DESC.'.price != 0
					              AND '.CATALOG_MENU.'.eng LIKE "'.$row_c["eng"].'"
					              AND '.CATALOG_SUBMENU.'.eng LIKE "'.$row_n["eng"].'"
					              AND '.CATALOG_ALL.'.eng NOT LIKE "default%"';
                        $k = $mysqli->queryQ($query);
                        $num_k = $mysqli->num_r($k);
                    }
                    if($reg || $reg2 || !$num_k)
                    {
                        $classHidden = ' class="classHidden"';
                    }
                    $title_sub     = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'" '.STYLE1.' id="a_sub_'.$num_sub.'">'.$row_n['title'].'</a>';
                    $title_sub_eng = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'" '.STYLE10.'>'.$row_n['eng'].'</a>';
                    $edit_sub_full =  '<a href="'.ADMIN_PANEL.'/edit_menu/'.$row_n['eng'].'/submenu">'.EDIT_IMG.'</a>';
                    $edit_sub      =  '<span class="img_edit" onclick="Edit_Title(\''.$num_sub.'\', \'catalog_submenu\')">'.EDIT_IMG_Q.'</span>';
                    $edit_sub_key  =  '<a href="'.ADMIN_PANEL.'/'.$row_d['link'].'_other/'.$row_n['eng'].'/'.CATALOG_SUBMENU.'"><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
                    $del_sub       = '<span class="img_edit" onclick="Del_Position(\''.$num_sub.'\', \'catalog_submenu\');">'.DEL_IMG.'</span>';
                    $product.= '<tr class="submenu_td2">
						<td id="td_sub_'.$num_sub.'"'.$classHidden.'>'.$title_sub.'</td>
						<td >'.$title_sub_eng.'</td>
						<td align="center">'.$edit_sub_full.'</td>
						<td align="center">'.$edit_sub.'</td>
						<td align="center">'.$edit_sub_key.'</td>
						<td align="center">'.$del_sub.'</a></td>
						</tr>';
                    //...............позиции товара..............................//
                    $query = "SELECT * FROM ".CATALOG_ALL."
			                  WHERE submenu_id =".$row_n['id']."
				              ORDER BY title";
                    $all = $mysqli->queryQ($query);
                    $product_all = '';
                    if($mysqli->num_r($all) > 0)
                    {
                        $tr_all = '';
                        while($row_all = $mysqli->fetchAssoc($all)){
                            ++$i;
                            $classHidden     = '';
                            $reg = preg_match( "#(default_[0-9]{1,})$#ui", $row_all["eng"] );
                            $reg2 = preg_match( "#(default_[0-9]{1,})$#ui", $row_n["eng"] );
                            $reg3 = preg_match( "#(default_[0-9]{1,})$#ui", $row_c["eng"] );
                            $numC = true;
                            if($row_c["eng"] == 'rashodnyye-materialy')
                            {
                                //если в таблице DESCRIPTION все позиции с ценами 0, то текущая позиция красная (не выводится)
                                $query = "SELECT ".DESC.".price AS price
							              FROM ".DESC."
		    				              WHERE ".DESC.".all_id = ".$row_all['id']." AND ".DESC.".price !=0";
                                $price = $mysqli->queryQ($query);
                                $numC = $mysqli->num_r($price);
                            }
                            if($reg || $reg2 || $reg3 || !$numC)
                            {
                                $classHidden = ' classHidden';
                            }
                            $num_all = $row_all['id'];
                            $title_all     = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'/'.$row_all['eng'].'" id="a_all_'.$num_all.'" '.STYLE14.'>'.$row_all['title'].'</a>';
                            $title_all_eng = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'/'.$row_all['eng'].'" '.STYLE10.'>'.$row_all['eng'].'</a>';
                            $edit_all_full =  '<a href="'.ADMIN_PANEL.'/edit_menu/'.$row_all['eng'].'/all">'.EDIT_IMG.'</a>';
                            $edit_all      =  '<span class="img_edit" onclick="Edit_Title(\''.$num_all.'\', \'catalog_all\')">'.EDIT_IMG_Q.'</span>';
                            $edit_all_key  =  '<a href="'.ADMIN_PANEL.'/'.$row_d['link'].'_other/'.$row_all['eng'].'/'.CATALOG_ALL.'"><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
                            $del_all =  '<span class="img_edit" onclick="Del_Position(\''.$num_all.'\', \'catalog_all\');">'.DEL_IMG.'</span>';
                            $tr_all.= '<tr>
							   <td width="45%" id="td_all_'.$num_all.'" class="submenu_td3'.$classHidden.'">'.$title_all.'</td>
							   <td width="35%" class="submenu_td3">'.$title_all_eng.'</td>
							   <td align="center">'.$edit_all_full.'</td>
							   <td align="center">'.$edit_all.'</td>
							   <td align="center">'.$edit_all_key.'</td>
							   <td align="center">'.$del_all.'</td>
						       </tr>';
                        }
                        $smarty->assign('tr_all', $tr_all);
                        $table_all = $smarty->fetch('inner-tpl/product/table-all.tpl');
                        $product_all = '<tr><td colspan="6">'.$table_all.'</td></tr>';

                    }
                    //.............................................................
                    $product.= $product_all;
                }
            }

            $submenu_td = 'submenu_prod';
            $smarty->assign('submenu_td', $submenu_td);
            $smarty->assign('product', $product);
            $smarty->assign('td', $td);
            $html.= $smarty->fetch('inner-tpl/product/admin-product.tpl');
        }
    }

    $html.='</table>';
    //$html.=view_add_menu();
    $html.='<a href="#top">'.TOP_IMG.' Наверх</a>';
    return $html;
}
//...............функция приветствия.....................//
function hello(){
    global $arResult;
    global $smarty;
    $html = '';
    if(isset($arResult->UsernameEnter) && $arResult->UsernameEnter["enter"] == 'Y')
    {
        $time = $arResult->UsernameEnter["last_date"];
        if($time == '0000-00-00 00:00:00')
        {
            $time =  get_string_time(time());
        }
        else
        {
            $time = date( "d.m.Y, H:i:s", strtotime($time));
        }
        $name = $arResult->UsernameEnter["name"];
        $online = getOnlineUsers().', ';
        $logout = '&nbsp;&nbsp;<a href="/admin/logout" '.STYLE3.'>выход</a>';

        $smarty->assign('name', $name);
        $smarty->assign('time', $time);
        $smarty->assign('online', $online);
        $smarty->assign('logout', $logout);
        $html = $smarty->fetch('inner-tpl/hello.tpl');
    }
    return $html;
}
function get_string_time($date){
    $date_time_array = getdate( $date );
    $mon = $date_time_array['mon'];
    $mday = $date_time_array['mday'];
    $year = $date_time_array['year'];
    $hours = $date_time_array['hours'];
    $minutes = $date_time_array['minutes'];
    $seconds = $date_time_array['seconds'];
    $time = $year.'-'.$mon.'-'.$mday.' '.$hours.':'.$minutes.':'.$seconds;
    $time = date( "d.m.Y, H:i:s", strtotime($time));
    return $time;
}
function getOnlineUsers(){
    $data = "./files/online.dat";
    $time = time();
    $past_time = time()-600;
    $online_array = array();
    $readdata = fopen($data,"r") or die("Не могу открыть файл $data");
    $data_array = file($data);
    fclose($readdata);

    if (getenv('HTTP_X_FORWARDED_FOR'))
        $user = getenv('HTTP_X_FORWARDED_FOR');
    else
        $user = getenv('REMOTE_ADDR');

    $d=count($data_array);
    for($i=0;$i<$d;$i++)
    {
        list($live_user,$last_time)=explode("::","$data_array[$i]");
        if($live_user!=""&&$last_time!=""):
            if($last_time<$past_time):
                $live_user="";
                $last_time="";
            endif;
            if($live_user!=""&&$last_time!="")
            {
                if($user==$live_user)
                {
                    $online_array[]="$user::$time\r\n";
                }
                else
                    $online_array[]="$live_user::$last_time";
            }
        endif;
    }

    if(isset($online_array)):
        foreach($online_array as $i=>$str)
        {
            if($str=="$user::$time\r\n")
            {
                $ok=$i;
                break;
            }
        }
        foreach($online_array as $j=>$str)
        {
            if($ok==$j) { $online_array[$ok]="$user::$time\r\n"; break;}
        }
    endif;

    $writedata=fopen($data,"w") or die("Не могу открыть файл $data");
    flock($writedata,2);
    if($online_array=="") $online_array[]="$user::$time\r\n";
    foreach($online_array as $str)
        fputs($writedata,"$str");
    flock($writedata,3);
    fclose($writedata);

    $readdata=fopen($data,"r") or die("Не могу открыть файл $data");
    $data_array=file($data);
    fclose($readdata);
    $online=count($data_array);
    switch ($online)
    {
        case 1:
            $icon = '&nbsp;<img src="'.HOME_URL.'/img/icons/User.png" width=12px id="img_user"/>'."\n";
            $stroka = ' посетитель';
            break;
        case 2:
        case 3:
        case 4:
            $stroka = ' посетителя';
            $icon = '&nbsp;<img src="'.HOME_URL.'/img/icons/Users.png" width=12px id="img_users"/>'."\n";
            break;
        default:
            $icon = '&nbsp;<img src="'.HOME_URL.'/img/icons/Users.png" width=12px id="img_users"/>'."\n";
            $stroka = ' посетителей';
    }

    $online = $icon.' Он-лайн:&nbsp;<strong>'.$online.'</strong><a href="'.ADMIN_PANEL.'/online">'.$stroka.'</a>';
    return $online;
}
//Выход
function logout(){
    //to fully log out a visitor we need to clear the session varialbles
    if ( isset( $_COOKIE['autologin'] ) ) setcookie( 'autologin', '', time() - 1, "/");
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['once'] = NULL;
    $_SESSION['last_visit'] = NULL;
    unset($_SESSION['MM_Username']);
    unset($_SESSION['once']);
    unset($_SESSION['last_visit']);
    $logoutGoTo = HOME_URL;
    if ($logoutGoTo)
    {
        header("Location: $logoutGoTo");
        exit;
    }


}
