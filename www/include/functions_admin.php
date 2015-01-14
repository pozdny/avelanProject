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
    $array_pages = $array_products = $array_dif_tab = $array_dif_tab1 = $array_dif_tab2 = array();
    require('include/arrays.php');
    global $arResult;
    global $smarty;
    $AdminMenu = $arResult->DATA["AdminMenu"];
    $pos2 = $arResult->POS2;
    $li = $li_menu = '';

    $action = $arResult->ACTION;
    foreach($AdminMenu as  $menu){
        $eng_menu   = $menu["eng"];
        $title_menu = $menu["title"];//echo $eng_menu.' '.$action.' '.$pos2.'<br>';

        ($eng_menu == $action || ((in_array($action, $array_pages)) && $eng_menu == $array_pages[0])
            || ((in_array($action, $array_products)) && $eng_menu == $array_products[0] && (in_array($pos2, $array_products)))
            || ((in_array($action, $array_dif_tab)) && $eng_menu == $array_dif_tab[0])
            || 'edit_'.$eng_menu == $action
            || ((in_array($action, $array_dif_tab1)) && $eng_menu == $array_dif_tab1[0] && $pos2 == $array_dif_tab1[0])
            || ((in_array($action, $array_dif_tab2)) && $eng_menu == $array_dif_tab2[0] && $pos2 == $array_dif_tab2[0])
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
    $tr = '';
    $query = "SELECT ".CATALOG_MENU.".id, ".CATALOG_MENU.".title, ".CATALOG_MENU.".eng FROM ".CATALOG_MENU."
			  WHERE ".CATALOG_MENU.".eng != 'services'
			  ORDER BY ".CATALOG_MENU.".id";
    $c = $mysqli->queryQ($query);
    $query = "SELECT title, link FROM ".ADMIN_ACTIONS." ORDER BY id LIMIT 1,1";
    $d = $mysqli->queryQ($query);
    $row_d = $mysqli->fetchAssoc($d);

    if($mysqli->num_r($c) > 0){
        while($row_c = $mysqli->fetchAssoc($c)){
            $num = $row_c['id'];
            $product = '';
            $classHidden     = '';
            $reg = preg_match( "/^default_/i", $row_c["eng"] );
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
                $classHidden = 'class="classHidden"';
            }
            $title     = '<a href="/catalog/'.$row_c['eng'].'" '.STYLE1.' id="a_'.$num.'">'.$row_c['title'].'</a>';
            $title_eng = '<a href="/catalog/'.$row_c['eng'].'"  '.STYLE9.'>'.$row_c['eng'].'</a>';
            $edit_full =  '<a href="'.ADMIN_PANEL.'/edit_catalog/'.$row_c['eng'].'/menu">'.EDIT_IMG.'</a>';
            //$edit      =  '<span class="img_edit" onclick="Edit_Title(\''.$num.'\', \'catalog_menu\')">'.EDIT_IMG_Q.'</span>';
            $edit_key  =  '<a href="'.ADMIN_PANEL.'/'.$row_d['link'].'_other/'.$row_c['eng'].'/'.CATALOG_MENU.'" ><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
            $del = '<span class="del_button '.CATALOG_MENU.'_main" id="'.$row_c['id'].'">'.DEL_IMG.'</span>';
            $submenu_td = 'submenu_prod';
            $smarty->assign('submenu_td', $submenu_td);
            $smarty->assign('num', $num);
            $smarty->assign('classHidden', $classHidden);
            $smarty->assign('title', $title);
            $smarty->assign('title_eng', $title_eng);
            $smarty->assign('edit_full', $edit_full);
            //$smarty->assign('edit', $edit);
            $smarty->assign('edit_key', $edit_key);
            $smarty->assign('del', $del);
            $td = $smarty->fetch('inner-tpl/product/table-menu-tr.tpl');
            $query = "SELECT ".CATALOG_SUBMENU.".id, ".CATALOG_SUBMENU.".title, ".CATALOG_SUBMENU.".eng FROM ".CATALOG_SUBMENU."
			          WHERE ".CATALOG_SUBMENU.".menu_id =".$row_c['id']."
			          ORDER BY ".CATALOG_SUBMENU.".title";
            $n = $mysqli->queryQ($query);
            if($mysqli->num_r($c) > 0){
                while($row_n = $mysqli->fetchAssoc($n)){
                    //...............подкатегория товара..............................//
                    $num_sub = $row_n['id'];
                    $classHidden     = '';
                    $reg = preg_match( "/^default_/i", $row_n["eng"] );
                    $reg2 = preg_match( "/^default_/i", $row_c["eng"] );
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
                        $classHidden = 'class="classHidden"';
                    }
                    $title_sub     = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'" '.STYLE1.' id="a_sub_'.$num_sub.'">'.$row_n['title'].'</a>';
                    $title_sub_eng = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'" '.STYLE10.'>'.$row_n['eng'].'</a>';
                    $edit_sub_full =  '<a href="'.ADMIN_PANEL.'/edit_catalog/'.$row_c['eng'].'/submenu/'.$row_n["eng"].'">'.EDIT_IMG.'</a>';
                    //$edit_sub      =  '<span class="img_edit" onclick="Edit_Title(\''.$num_sub.'\', \'catalog_submenu\')">'.EDIT_IMG_Q.'</span>';
                    $edit_sub_key  =  '<a href="'.ADMIN_PANEL.'/'.$row_d['link'].'_other/'.$row_c['eng'].'/'.CATALOG_SUBMENU.'/'.$row_n["eng"].'"><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
                    $del_sub       = '<span class="del_button '.CATALOG_SUBMENU.'_main" id="'.$row_n['id'].'">'.DEL_IMG.'</span>';

                    $smarty->assign('num_sub', $num_sub);
                    $smarty->assign('classHidden', $classHidden);
                    $smarty->assign('title_sub', $title_sub);
                    $smarty->assign('title_sub_eng', $title_sub_eng);
                    $smarty->assign('edit_sub_full', $edit_sub_full);
                   // $smarty->assign('edit_sub', $edit_sub);
                    $smarty->assign('edit_sub_key', $edit_sub_key);
                    $smarty->assign('del_sub', $del_sub);
                    $product.= $smarty->fetch('inner-tpl/product/table-sub-tr.tpl');
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
                            $reg = preg_match( "/^default_/i", $row_all["eng"] );
                            $reg2 = preg_match( "/^default_/i", $row_n["eng"] );
                            $reg3 = preg_match( "/^default_/i", $row_c["eng"] );
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
                                $classHidden = 'class="classHidden"';
                            }
                            $num_all = $row_all['id'];
                            $title_all     = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'/'.$row_all['eng'].'" id="a_all_'.$num_all.'" '.STYLE14.'>'.$row_all['title'].'</a>';
                            $title_all_eng = '<a href="/catalog/'.$row_c['eng'].'/'.$row_n['eng'].'/'.$row_all['eng'].'" '.STYLE10.'>'.$row_all['eng'].'</a>';
                            $edit_all_full =  '<a href="'.ADMIN_PANEL.'/edit_catalog/'.$row_c['eng'].'/all/'.$row_n["eng"].'/'.$row_all["eng"].'">'.EDIT_IMG.'</a>';
                            //$edit_all      =  '<span class="img_edit" onclick="Edit_Title(\''.$num_all.'\', \'catalog_all\')">'.EDIT_IMG_Q.'</span>';
                            $edit_all_key  =  '<a href="'.ADMIN_PANEL.'/'.$row_d['link'].'_other/'.$row_c['eng'].'/'.CATALOG_ALL.'/'.$row_n["eng"].'/'.$row_all["eng"].'"><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
                            $del_all =  '<span class="del_button '.CATALOG_ALL.'_main" id="'.$row_all['id'].'">'.DEL_IMG.'</span>';

                            $smarty->assign('num_all', $num_all);
                            $smarty->assign('classHidden', $classHidden);
                            $smarty->assign('title_all', $title_all);
                            $smarty->assign('title_all_eng', $title_all_eng);
                            $smarty->assign('edit_all_full', $edit_all_full);
                            //$smarty->assign('edit_all', $edit_all);
                            $smarty->assign('edit_all_key', $edit_all_key);
                            $smarty->assign('del_all', $del_all);
                            $tr_all.= $smarty->fetch('inner-tpl/product/table-all-tr.tpl');
                        }
                        $smarty->assign('tr_all', $tr_all);
                        $product_all = $smarty->fetch('inner-tpl/product/table-all.tpl');

                    }
                    //.............................................................
                    $product.= $product_all;
                }
            }

            $smarty->assign('product', $product);
            $smarty->assign('td', $td);
            $tr.= $smarty->fetch('inner-tpl/product/admin-product.tpl');
        }
    }


    $smarty->assign('tr', $tr);
    $smarty->assign('id_table', 'id="dif_tab"');
    $smarty->assign('link', 'class="'.$_SERVER['REQUEST_URI'].'"');
    $html.= $smarty->fetch('inner-tpl/product/table.tpl');
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
    if ( isset( $_COOKIE['sessionStatus'] ) ) setcookie( 'sessionStatus', '', time() - 1, "/");
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
    return;
}
// создание выпадающего списка с текущим id
function get_select($rez='', $tab, $num=0){
    $mysqli = M_Core_DB::getInstance();
    $purpose_id = $rez;
    if($tab == TABLE_ADMIN_USERS){
        $sort = 'name';
        $title = 'name';
    }
    elseif($tab == MANUF){
        $sort = 'id';
        $title = 'title';
    }
    else{
        $sort = 'title';
        $title = 'title';
    }
    if($num>0){
        $query = "SELECT id, ".$title." FROM ".$tab." WHERE all_id=".$num." ORDER BY ".$sort." ASC";
        $mysqli->_execute($query);
    }
    else{
        if($tab == TABLE_ADMIN_USERS){
            $query = "SELECT id, ".$title."
			          FROM ".$tab."
					  WHERE rights = 'm'
					  ORDER BY ".$sort." DESC";
            $mysqli->_execute($query);
        }
        else{
            $query = "SELECT id, ".$title." FROM ".$tab." ORDER BY ".$sort." ASC";
            $mysqli->_execute($query);
        }
    }
    if($tab == TABLE_ADMIN_USERS){
        $html= '<option value="0" disabled="disabled" selected="selected" style="background:#f6f6f6">Выберите оператора</option>';
    }
    else{
        $html= '';
    }

    while($row_p = $mysqli->fetch()){
        if($tab == TABLE_ADMIN_USERS){
            $html.= '<option  value="'.$row_p['id'].'"';
            $html.= '>'.$row_p['name'].'</option>';
        }
        else{
            $html.='<option value="'.$row_p['id'].'" ';
            if (!(strcmp($row_p['id'], $purpose_id)))
            {
                $html.="selected=\"selected\"";
            }
            $html.='>'.$row_p['title'].'</option>';
        }
    }
    return $html;
}
function admin_prices(){
    global $smarty;
    $html = '';
    $legend = "Загрузить прайсы";

    $title = 'Прайс "Вентиляционное оборудование" (Price_Vent) <span '.STYLE8.'>(тип файла Excel 97-2003 (*.xls))</span>';
    $title1 = 'Прайс "Кондиционеры" (Price_Cond) <span '.STYLE8.'>(тип файла Excel 97-2003 (*.xls))</span>';
    $title2 = 'Прайс "Тепловое оборудование" (Price_Teplo) <span '.STYLE8.'>(тип файла Excel 97-2003 (*.xls))</span>';
    $title3 = 'Прайс "Расходные материалы" (price_rashodka.xls) <span '.STYLE8.'>(тип файла Excel 97-2003 (*.xls))</span>';
    $name = 'price_upload';
    $name1 = 'price1_upload';
    $name2 = 'price2_upload';
    $name3 = 'price3_upload';
    $smarty->assign('title', $title);
    $smarty->assign('title1', $title1);
    $smarty->assign('title2', $title2);
    $smarty->assign('title3', $title3);
    $smarty->assign('name', $name);
    $smarty->assign('name1', $name1);
    $smarty->assign('name2', $name2);
    $smarty->assign('name3', $name3);

    $price = $smarty->fetch('inner-tpl/prices/priceOne.tpl');
    $action = ADMIN_PANEL.'/get_edit_prices';
    $notice = $smarty->fetch('inner-tpl/prices/notice.tpl');
    $smarty->assign('legend', $legend);
    $smarty->assign('price', $price);
    $smarty->assign('notice', $notice);
    $smarty->assign('action', $action);
    $html.= $smarty->fetch('inner-tpl/prices/mainPrice.tpl');
    return $html;
}
function get_edit_prices(){
    $mysqli = M_Core_DB::getInstance();
    require_once('readexcel/reader.php');
    $files = ''; //echo '<pre>';print_r($_FILES); echo '</pre>';

    if (isset($_FILES["price_upload"]) && (!empty($_FILES["price_upload"]["name"])) && (preg_match("/price_vent/i", $_FILES["price_upload"]["name"]))){
        $tab = VENT;
        $file_name = $_FILES["price_upload"]["name"];
        $tmp_file_name = $_FILES["price_upload"]["tmp_name"];
        $dest_file_name_loc = PATH_EXCEL_LOC.$file_name;
        $dest_file_name = PATH_EXCEL.$file_name;
        copy($tmp_file_name, $dest_file_name_loc);
        move_uploaded_file($tmp_file_name, $dest_file_name);

        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding("utf-8"); //Кодировка выходных данных
        $data->read($file_name);
        //СТАРТ Считывание из файла Excel и запись в БД
        $query = 'DELETE FROM '.$tab;
        $mysqli->query($query);
        $i = 0;
        for($j=0, $k=1; $j<12; $j++){
            $title=$flow=$db=$nm=$n=$vt=$a=$b=$size=$price=$price2=$cell_id='';

            if($j == 2 || $j == 3 || $j == 4 || $j == 5 || $j == 6 || $j == 7) $i = 6;
            elseif($j == 8) $i = 4;
            else $i = 5;

            for (; $i<=$data->sheets[$j]["numRows"]; $i++){
                if(!empty($data->sheets[$j]["cells"][$i][1])){
                    $cell_id = addslashes(trim($data->sheets[$j]["cells"][$i][1]));
                    if($cell_id == 0 || $cell_id == ''){
                        continue;
                    }
                }
                else{
                    continue;
                }

                if($cell_id == 0 || $cell_id == ''){
                    continue;
                }
                if(!empty($data->sheets[$j]["cells"][$i][2])){
                    $title = addslashes(trim($data->sheets[$j]["cells"][$i][2]));
                }

                if($j == 0 || $j == 1)//Круглый канал, Прямоугольный канал
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $flow       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $db         = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $nm         = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $n          = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $vt         = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $a          = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][9])){
                        $b          = addslashes(trim($data->sheets[$j]["cells"][$i][9]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][11])){
                        $price      = addslashes(trim($data->sheets[$j]["cells"][$i][11]));
                    }
                }
                elseif($j == 2 )//Центробежные
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $flow       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $db         = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $nm         = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $n          = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $a          = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price      = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][9])){
                        $price2     = addslashes(trim($data->sheets[$j]["cells"][$i][9]));
                    }
                }
                elseif($j == 3)//Крышные
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $flow       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $db         = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $nm         = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $n          = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $a          = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price      = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                }
                elseif($j == 4)//Осевые
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $flow       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $db         = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $nm         = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $n          = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $price      = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                }
                else// Калориферы, Гибкие воздуховоды, Воздухораспределители
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $price      = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                }
                $query="INSERT INTO ".$tab." (`id`,`title`, `flow`, `db`, `nm`, `n`, `vt`, `a`, `b`, `size`, `all_id`, `price`, `price2`) VALUES('".$k."', '".$title."', '".$flow."', '".$db."', '".$nm."', '".$n."', '".$vt."', '".$a."', '".$b."', '".$size."', '".$cell_id."', '".$price."', '".$price2."')";
                $mysqli->query($query);
                $k++;
            }
        }
        $files = $file_name.', ';
        unlink('./'.$file_name);
    }
    if (isset($_FILES["price1_upload"]) && (!empty($_FILES["price1_upload"]["name"])) && (preg_match("/price_cond/i", $_FILES["price1_upload"]["name"]))){
        $tab = COND;
        $file_name = $_FILES["price1_upload"]["name"];
        $tmp_file_name = $_FILES["price1_upload"]["tmp_name"];
        $dest_file_name_loc = PATH_EXCEL_LOC.$file_name;
        $dest_file_name = PATH_EXCEL.$file_name;
        copy($tmp_file_name, $dest_file_name_loc);
        move_uploaded_file($tmp_file_name, $dest_file_name);

        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding("utf-8"); //Кодировка выходных данных
        $data->read($file_name);
        //СТАРТ Считывание из файла Excel и запись в БД
        $query = 'DELETE FROM '.$tab;
        $mysqli->query($query);
        for($j=0, $k=1; $j<6; $j++){
            $btu_c=$btu_h=$pipe=$n=$size=$size1=$flow=$price=$weight=$cell_id='';
            if($j == 0 ) $i = 8;
            if($j == 1 || $j == 3 || $j == 4 || $j == 5) $i = 9;
            elseif($j == 2) $i = 11;

            for (; $i<=$data->sheets[$j]["numRows"]; $i++ ){
                if(!empty($data->sheets[$j]["cells"][$i][1])){
                    $cell_id = addslashes(trim($data->sheets[$j]["cells"][$i][1]));
                    if($cell_id == 0 || $cell_id == ''){
                        continue;
                    }
                }
                else{
                    continue;
                }

                if(!empty($data->sheets[$j]["cells"][$i][2])){
                    $title = addslashes(trim($data->sheets[$j]["cells"][$i][2]));
                }
                if(!empty($data->sheets[$j]["cells"][$i][3])){
                    $btu_c = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                }
                if(!empty($data->sheets[$j]["cells"][$i][4])){
                    $btu_h = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                }
                if(!empty($data->sheets[$j]["cells"][$i][5])){
                    $pipe  = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                }
                if(!empty($data->sheets[$j]["cells"][$i][6])){
                    $size  = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                }
                if(!empty($data->sheets[$j]["cells"][$i][7])){
                    $size1 = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                }

                if($j == 0)//Настенные кондиционеры
                {
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $flow   = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][10])){
                        $price  = addslashes(trim($data->sheets[$j]["cells"][$i][10]));
                    }

                }
                elseif($j == 1)//Инвертерные кондиционеры
                {
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $flow  = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][9])){
                        $price = addslashes(trim($data->sheets[$j]["cells"][$i][9]));
                    }
                }
                elseif($j == 2)//Мобильные кондиционеры
                {
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $size   = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $weight = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $price  = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                }
                elseif($j == 3)//Напольно-потолочные кондиционеры
                {
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $flow  = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                }
                elseif($j == 4)//Кассетные
                {
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $flow  = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                }
                elseif($j == 5)//Канальные
                {
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $flow  = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                }
                $query="INSERT INTO ".$tab." (`id`,`title`, `btu_c`, `btu_h`, `pipe`, `n`, `size`, `size1`, `flow`, `all_id`, `price`, `weight`) VALUES('$k', '$title', '$btu_c', '$btu_h', '$pipe', '$n', '$size', '$size1', '$flow', '$cell_id', '$price', '$weight')";
                $mysqli->query($query);
                $k++;
            }
        }
        $files.=$file_name.', ';
        unlink('./'.$file_name);
    }
    if (isset($_FILES["price2_upload"]) && (!empty($_FILES["price2_upload"]["name"])) && (preg_match("/price_teplo/i", $_FILES["price2_upload"]["name"]))){
        $tab = TEPLO;
        $file_name = $_FILES["price2_upload"]["name"];
        $tmp_file_name = $_FILES["price2_upload"]["tmp_name"];
        $dest_file_name_loc = PATH_EXCEL_LOC.$file_name;
        $dest_file_name = PATH_EXCEL.$file_name;
        copy($tmp_file_name, $dest_file_name_loc);
        move_uploaded_file($tmp_file_name, $dest_file_name);

        $data = new Spreadsheet_Excel_Reader();
        $data->setOutputEncoding("utf-8"); //Кодировка выходных данных
        $data->read($file_name);
        //СТАРТ Считывание из файла Excel и запись в БД
        $query = 'DELETE FROM '.$tab;
        $mysqli->query($query);

        for($j=0, $k=1; $j<8; $j++){
            $n=$s=$flow=$h=$pos=$v=$size=$pr=$price=$cell_id='';
            if($j == 0 || $j == 4 || $j == 5 || $j == 7) $i = 6;
            elseif($j == 1) $i = 10;
            elseif($j == 2 || $j == 6) $i = 5;
            elseif($j == 3) $i = 7;

            for (; $i<=$data->sheets[$j]["numRows"]; $i++ ){
                if(!empty($data->sheets[$j]["cells"][$i][1])){
                    $cell_id = addslashes(trim($data->sheets[$j]["cells"][$i][1]));
                    if($cell_id == 0 || $cell_id == ''){
                        continue;
                    }
                }
                else{
                    continue;
                }
                if(!empty($data->sheets[$j]["cells"][$i][2])){
                    $title = addslashes(trim($data->sheets[$j]["cells"][$i][2]));

                }
                if($j == 0 || $j == 1 )//Эл.завесы, Водяные завесы
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $n       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $flow    = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $h       = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $pos     = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $v       = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $size    = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][10])){
                        $price   = addslashes(trim($data->sheets[$j]["cells"][$i][10]));
                    }
                }
                elseif($j == 2 )//Завесы без нагревательного элемента
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $n       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $flow    = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $h       = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $pos     = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $v       = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][9])){
                        $size    = addslashes(trim($data->sheets[$j]["cells"][$i][9]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][10])){
                        $price   = addslashes(trim($data->sheets[$j]["cells"][$i][10]));
                    }
                }
                elseif($j == 3 )//Электр. тепловые пушки
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $n       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $flow    = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $v       = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $s       = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $size    = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price   = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                }
                elseif($j == 4 )//Вод. тепловые пушки
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $n       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $flow    = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $v       = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $s       = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $size    = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price   = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                }
                elseif($j == 5 )//Газ. тепловые пушки
                {
                    if(!empty($data->sheets[$j]["cells"][$i][3])){
                        $n       = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $flow    = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $s       = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $v       = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $size    = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][8])){
                        $price   = addslashes(trim($data->sheets[$j]["cells"][$i][8]));
                    }
                }
                elseif($j == 6 || $j == 7 )//Маслянные радиаторы, Эл.конвекторы
                {
                    if($j == 6 && $i == 5)
                        if(!empty($data->sheets[$j]["cells"][$i][2])){
                            $title   = addslashes(trim($data->sheets[$j]["cells"][$i][2]));
                        }

                    else{
                        if(!empty($data->sheets[$j]["cells"][$i][3])){
                            $title   = addslashes(trim($data->sheets[$j]["cells"][$i][3]));
                        }
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][4])){
                        $n       = addslashes(trim($data->sheets[$j]["cells"][$i][4]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][5])){
                        $s       = addslashes(trim($data->sheets[$j]["cells"][$i][5]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][6])){
                        $v       = addslashes(trim($data->sheets[$j]["cells"][$i][6]));
                    }
                    if(!empty($data->sheets[$j]["cells"][$i][7])){
                        $price   = addslashes(trim($data->sheets[$j]["cells"][$i][7]));
                    }
                }

                $query="INSERT INTO ".$tab." (`id`, `title`, `n`, `s`, `flow`, `h`, `pos`, `v`, `size`, `pr`, `all_id`, `price`) VALUES('$k', '$title', '$n', '$s', '$flow', '$h', '$pos', '$v', '$size', '$pr', '$cell_id', '$price')";
                $mysqli->query($query);
                $k++;
            }
        }
        $files.=$file_name;
        unlink('./'.$file_name);
    }
    if (isset($_FILES["price3_upload"]) && (!empty($_FILES["price3_upload"]["name"])) && ($_FILES["price3_upload"]["name"]=='price_rashodka.xls')){
        $file_name = $_FILES["price3_upload"]["name"];
        $tmp_file_name = $_FILES["price3_upload"]["tmp_name"];
        $dest_file_name_loc = PATH_EXCEL_LOC.$file_name;
        $dest_file_name = PATH_EXCEL.$file_name;
        copy($tmp_file_name, $dest_file_name_loc);
        move_uploaded_file($tmp_file_name, $dest_file_name);
        $files.=$file_name;
        unlink('./'.$file_name);
    }
    if (isset($_FILES["price_upload"]) && (!empty($_FILES["price_upload"]["name"])) || isset($_FILES["price1_upload"]) && (!empty($_FILES["price1_upload"]["name"])) || isset($_FILES["price2_upload"]) && (!empty($_FILES["price2_upload"]["name"])) || isset($_FILES["price3_upload"]) && (!empty($_FILES["price3_upload"]["name"]))){
        $date = date('Y-m-d');
        $query=sprintf("UPDATE ".TABLE_INFO." SET date_price=%s",
            GetSQLValueString($date, "date"));
        $mysqli->query($query);
        $messages = new Messages('info', 'Файл(ы) ('.$files.') успешно загружен(ы) в базу данных!', 'prices' );
        $html = $messages->Content;

    }
    elseif (isset($_FILES["price3_upload"]) && (!empty($_FILES["price3_upload"]["name"]))){
        if(!empty($files)){
            $date = date('Y-m-d');
            $query=sprintf("UPDATE ".TABLE_INFO." SET date_price=%s",
                GetSQLValueString($date, "date"));
            $mysqli->query($query);
            $mess = 'Файл ('.$files.') успешно загружен на сервер!';
        }
        else{
            $mess = 'Неверный формат файла! Файл не загружен';
        }
        $messages = new Messages('info',  $mess, 'prices');
        $html = $messages->Content;

    }
    else{
        $messages = new Messages('info', 'Не выбрано ни одного файла', 'prices' );
        $html = $messages->Content;
    }
    return $html;
}
function putIMG($key, $all_id, $key_alt, $input_tab, $menu_eng=''){
    $mysqli = M_Core_DB::getInstance();
    $tab      = $input_tab;
    $value    = (array_values($key));//echo '<pre>'; print_r( $key_alt);echo '</pre>';
    $titleR   = (array_values($value[0]));
    $altAR = (array_values($key_alt));
    $n = count($value);
    $k = count($titleR);
    $g = 0;
    if($tab == IMAGES_SERV) $num = 2;
    else $num = 3;

    for($j = 0; $j<$k; $j++){
        for($i = 0 ; $i<$num; $g++, $i++){
            $array_alt[$i] = $altAR[$g];
        }

        for($i = 0; $i<$n; $i++){
            $array = (array_values($value[$i]));
            $k = count($array);

            $array_main[$i] = $array[$j];

        }
        $alt            = $array_alt[0];
        $img_title      = $array_alt[1];
        if(isset($array_alt[2])){
            $desc_foto      = $array_alt[2];
        }
        $add_foto       = $array_main[0];
        $tmp_file_name  = $array_main[2];
        $size           = $array_main[4]/1024;
        $error = '';
        if(!empty($add_foto)){
            $extensions = array( ".jpg", ".jpeg", ".JPG", ".JPEG", ".gif", ".bmp", ".png", ".PNG" );
            $ext  = strrchr($add_foto, "." );
            if ( !in_array( $ext, $extensions ) )
                $error.= '<tr><td ><li>недопустимый формат файла изображения '.$add_foto.' (можно jpg, JPG, gif, bmp, png)</li></td></tr>'."\n";
            if ( !preg_match( "#^[a-zA-Z_.\d]+$#i",  $add_foto) )
                $error.='<tr><td><li>название файла изображения '.$add_foto.' содержит русские буквы или недопустимые символы (пробел, %, $ и т.д.)</li></td></tr>'."\n";

            if ( $size == 0 ){
                $error.='<tr><td><li>размер файла изображения  '.$add_foto.' больше '.(ceil(MAX_FILE_SIZE/1024/1024)).' мб</li></td></tr>'."\n";
            }
            $size = ceil($size);
            if ( $size > MAX_FILE_SIZE/1024 ){
                $error.='<tr><td><li>размер файла изображения  '.$add_foto.' больше '.(ceil(MAX_FILE_SIZE/1024/1024)).' мб</li></td></tr>'."\n";
            }
            $query = "SELECT id FROM ".$tab." ORDER BY id DESC LIMIT 1";
            $mysqli->_execute($query);
            $row = $mysqli->fetch();
            $last_id = $row['id']+1;
            $pos = strpos($add_foto, ".jpg");
            $add_foto = substr($add_foto, 0, $pos);
            $add_foto.= '_'.$last_id.'.jpg';
            if($tab == IMAGES_SERV){
                $dest = SERVICES."/catalog/";
                $all_tab = SERVICES;
            }
            elseif($tab == RABOTY){
                $dest = RABOTY.'/';
                $all_tab = RABOTY;
            }
            elseif($tab == RABOTY_IMG){
                $dest = RABOTY.'/big/';
                $all_tab = RABOTY;
            }
            else{
                $dest = "catalog/";
                $all_tab = CATALOG_ALL;
            }
            $dest_file_name = $_SERVER["DOCUMENT_ROOT"] . PATH_IMG.$dest . $add_foto;

            if(empty($error)){
                move_uploaded_file($tmp_file_name, $dest_file_name);
                if($tab != RABOTY){
                    watermark($dest_file_name, $input_tab, $menu_eng);
                }
                $query = "SELECT title FROM ".$all_tab." WHERE ".$all_tab.".id = ".$all_id;
                $mysqli->_execute($query);
                $row = $mysqli->fetch();
                $title_all = $row['title'];
                if($alt == NULL)       $alt = $title_all;
                if($img_title == NULL) $img_title = $title_all;

                if($tab == RABOTY_IMG){
                    $query = sprintf("INSERT INTO ".$tab." (id, img, img_title, alt, description, ".RABOTY."_id ) VALUES (%s, %s, %s, %s, %s, %s)",
                        GetSQLValueString($last_id, "int"),
                        GetSQLValueString($add_foto, "text"),
                        GetSQLValueString($img_title, "text"),
                        GetSQLValueString($alt, "text"),
                        GetSQLValueString($desc_foto, "text"),
                        GetSQLValueString($all_id, "int"));
                    $mysqli->query($query);
                }
                elseif($tab == IMAGES_SERV){
                    $query = sprintf("INSERT INTO ".$tab." (id, img, all_id, alt, img_title ) VALUES (%s, %s, %s, %s, %s)",
                        GetSQLValueString($last_id, "int"),
                        GetSQLValueString($add_foto, "text"),
                        GetSQLValueString($all_id, "int"),
                        GetSQLValueString($alt, "text"),
                        GetSQLValueString($img_title, "text"));
                    $mysqli->query($query);
                }
                else{
                    $query = sprintf("INSERT INTO ".$tab." (id, img, all_id, alt, img_title, line_id ) VALUES (%s, %s, %s, %s, %s, %s)",
                        GetSQLValueString($last_id, "int"),
                        GetSQLValueString($add_foto, "text"),
                        GetSQLValueString($all_id, "int"),
                        GetSQLValueString($alt, "text"),
                        GetSQLValueString($img_title, "text"),
                        GetSQLValueString($desc_foto, "text"));
                    $mysqli->query($query);
                }
            }

        }
    }
    if(!empty($error)){

        return '0'.$error;
    }
    else{
        return '1';
    }

}
function editIMG($key, $all_id, $key_alt, $input_tab, $menu_eng='', $f=''){
    $mysqli = M_Core_DB::getInstance();
    $tab      = $input_tab;
    $value    = (array_values($key));
    $array_key=array_keys($key["name"]);
    $titleR   = (array_values($value[0]));
    $altAR = (array_values($key_alt));
    $n = count($value);
    $k = count($titleR);
    $g = 0;
    if($tab == RABOTY_IMG || $f == 'all' ){
        $num = 3;
    }
    else{
        $num = 2;
    }
    for($j = 0; $j<$k; $j++){
        for($i = 0 ; $i<$num; $g++, $i++){
            $array_alt[$i] = $altAR[$g];
        }
        for($i = 0; $i<$n; $i++){
            $array = (array_values($value[$i]));
            $k = count($array);

            $array_main[$i] = $array[$j];

        }
        $id_foto        = $array_key[$j];
        $alt            = $array_alt[0];
        $img_title      = $array_alt[1];
        if(isset($array_alt[2])){
            $desc_foto      = $array_alt[2];
        }
        else{
            $desc_foto = '0';
        }
        $add_foto       = $array_main[0];
        $tmp_file_name  = $array_main[2];
        $size           = $array_main[4]/1024;
        $error = '';

        if(!empty($add_foto)){
            $extensions = array( ".jpg", ".jpeg", ".JPG", ".JPEG", ".gif", ".bmp", ".png" );
            $ext  = strrchr($add_foto, "." );
            if ( !in_array( $ext, $extensions ) )
                $error.= '<tr><td ><li>недопустимый формат файла изображения '.$add_foto.' (можно jpg, JPG, gif, bmp, png)</li></td></tr>'."\n";
            if ( !preg_match( "#^[a-zA-Z_.\d]+$#i",  $add_foto) )
                $error.='<tr><td><li>название файла изображения '.$add_foto.' содержит русские буквы или недопустимые символы (пробел, %, $ и т.д.)</li></td></tr>'."\n";

            if ( $size == 0 ){
                $error.='<tr><td><li>размер файла изображения  '.$add_foto.' больше '.(ceil(MAX_FILE_SIZE/1024/1024)).' мб</li></td></tr>'."\n";
            }
            $size = ceil($size);
            if ( $size > MAX_FILE_SIZE/1024 ){
                $error.='<tr><td><li>размер файла изображения  '.$add_foto.' больше '.(ceil(MAX_FILE_SIZE/1024/1024)).' мб</li></td></tr>'."\n";
            }
            $pos = strpos($add_foto, ".jpg");
            $add_foto = substr($add_foto, 0, $pos);
            $add_foto.= '_'.$id_foto.'.jpg';
            if($tab == IMAGES_SERV){
                $dest = SERVICES."/catalog/";
                $all_tab = SERVICES;
            }
            elseif($tab == RABOTY){
                $dest = RABOTY.'/';
                $all_tab = RABOTY;
            }
            elseif($tab == RABOTY_IMG){
                $dest = RABOTY.'/big/';
                $all_tab = RABOTY;
            }
            else{
                $dest = "catalog/";
                $all_tab = CATALOG_ALL;
            }
            $dest_file_name = $_SERVER["DOCUMENT_ROOT"] . PATH_IMG.$dest . $add_foto;

            if(empty($error)){
                move_uploaded_file($tmp_file_name, $dest_file_name);
                watermark($dest_file_name, $input_tab, $menu_eng);

                $query = "SELECT title FROM ".$all_tab." WHERE ".$all_tab.".id = ".$all_id;
                $mysqli->_execute($query);
                $row = $mysqli->fetch();
                $title_all = $row['title'];
                if($alt == NULL)       $alt = $title_all;
                if($img_title == NULL) $img_title = $title_all;
                if($tab == RABOTY_IMG){
                    $query = sprintf("UPDATE ".$tab." SET img=%s, alt=%s, img_title=%s WHERE id=%s",
                        GetSQLValueString($add_foto, "text"),
                        GetSQLValueString($alt, "text"),
                        GetSQLValueString($img_title, "text"),
                        GetSQLValueString($id_foto, "int"));
                    $mysqli->query($query);
                }
                elseif($tab == RABOTY){
                    $query = sprintf("UPDATE ".$tab." SET img=%s, alt=%s, img_title=%s WHERE id=%s",
                        GetSQLValueString($add_foto, "text"),
                        GetSQLValueString($alt, "text"),
                        GetSQLValueString($img_title, "text"),
                        GetSQLValueString($id_foto, "int"));
                    $mysqli->query($query);
                }
                elseif($tab == IMAGES_SERV){
                    $query = sprintf("UPDATE ".$tab." SET img=%s, alt=%s, img_title=%s WHERE id=%s",
                        GetSQLValueString($add_foto, "text"),
                        GetSQLValueString($alt, "text"),
                        GetSQLValueString($img_title, "text"),
                        GetSQLValueString($id_foto, "int"));
                    $mysqli->query($query);
                }
                else{
                    $query = sprintf("UPDATE ".$tab." SET img=%s, alt=%s, img_title=%s, line_id=%s WHERE id=%s",
                        GetSQLValueString($add_foto, "text"),
                        GetSQLValueString($alt, "text"),
                        GetSQLValueString($img_title, "text"),
                        GetSQLValueString($desc_foto, "text"),
                        GetSQLValueString($id_foto, "int"));
                    $mysqli->query($query);
                }

            }
        }
        elseif(empty($add_foto) && (!empty($alt) || !empty($img_title) || !empty($desc_foto))){
            if($tab == RABOTY_IMG){
                $query = sprintf("UPDATE ".$tab." SET alt=%s, img_title=%s, description=%s  WHERE id=%s",
                    GetSQLValueString($alt, "text"),
                    GetSQLValueString($img_title, "text"),
                    GetSQLValueString($desc_foto, "text"),
                    GetSQLValueString($id_foto, "int"));
                $mysqli->query($query);
            }
            elseif($tab == RABOTY){
                $query = sprintf("UPDATE ".$tab." SET alt=%s, img_title=%s WHERE id=%s",
                    GetSQLValueString($alt, "text"),
                    GetSQLValueString($img_title, "text"),
                    GetSQLValueString($id_foto, "int"));
                $mysqli->query($query);
            }
            elseif($tab == IMAGES_SERV){
                $query = sprintf("UPDATE ".$tab." SET alt=%s, img_title=%s WHERE id=%s",
                    GetSQLValueString($alt, "text"),
                    GetSQLValueString($img_title, "text"),
                    GetSQLValueString($id_foto, "int"));
                $mysqli->query($query);
            }
            else{
                $query = sprintf("UPDATE ".$tab." SET alt=%s, img_title=%s, line_id=%s WHERE id=%s",
                    GetSQLValueString($alt, "text"),
                    GetSQLValueString($img_title, "text"),
                    GetSQLValueString($desc_foto, "text"),
                    GetSQLValueString($id_foto, "int"));
                $mysqli->query($query);
            }
        }

    }
    if(!empty($error)){

        return '0'.$error;
    }
    else{
        return '1';
    }
}
//watermark
function watermark($img, $input_tab, $menu_eng)
{
    $q = 100;
    $slesh = strrpos($img, '/');
    $filename = substr($img, $slesh+1);

    // получим размеры исходного изображения
    $size_img = getimagesize($img);
    $no_water = 300;
    $w_max = 5000;
    $img_path = $img;
    $img_save = $img;
    if($size_img[0] < $no_water)
    {
        if($input_tab == IMAGES_SERV || $menu_eng == 'rashodnyye-materialy')
        {
            resizeimg($img_save, 115, 1, '', 'save', $menu_eng);
        }
        elseif($input_tab == RABOTY_IMG)
        {
            resizeimg($img_save, 200, 3, '', 'save', RABOTY);
        }
        elseif($input_tab == RABOTY)
        {
            resizeimg($img_save, 115, 4, '', 'save', RABOTY);
        }
        else{
            resizeimg($img_save, 115, 4, '', 'save', TABLE_IMAGES);
        }
        return true;
    }
    else
    {
        if($size_img[0] > $w_max)
        {
            // файл и новый размер

            $percent = 0.2;

            // тип содержимого
            /*if ($size_img[2]==2)      header('Content-type: image/jpg');
            else if ($size_img[2]==1) header('Content-type: image/gif');
            else if ($size_img[2]==3) header('Content-type: image/png'); */

            // получение нового размера
            list($width, $height) = getimagesize($img);
            $newwidth = $width * $percent;
            $newheight = $height * $percent;

            // загрузка
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            if ($size_img[2]==2)      $source = imagecreatefromjpeg($img);
            else if ($size_img[2]==1) $source = imagecreatefromgif($img);
            else if ($size_img[2]==3) $source = imagecreatefrompng($img);

            // изменение размера
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            // сохраняем после уменьшения в тот же файл
            if ($size_img[2]==2) imagejpeg($thumb, $img, $q);
            else if ($size_img[2]==1) imagegif($thumb, $img, $q);
            else if ($size_img[2]==3) imagepng($thumb, $img, $q);
        }
        $watermark = imagecreatefrompng('img/icons/watermark.png');
        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);

        if (strstr($img_path, '.jpg')) $img = imagecreatefromjpeg($img_path);
        elseif (strstr($img_path, '.png')) $img = imagecreatefrompng($img_path);
        elseif (strstr($img_path, '.gif')) $img = imagecreatefromgif($img_path);
        if ($img === false)
        {
            return false;
        }

        $size = getimagesize($img_path);
        $dest_x = ($size[0] - $watermark_width)/2;
        $dest_y = ($size[1] - $watermark_height)/2;

        $str_type = gettype($img);
        if($str_type == 'string')
        {
            unlink($img_path);
            return false;
        }
        imagealphablending($img, true);
        imagealphablending($watermark, true);

        imagecopy($img,$watermark,$dest_x,$dest_y,0,0,$watermark_width,$watermark_height);
        //масштабируем фото и сохраняем в папке small
        if($input_tab == IMAGES_SERV /*|| $menu_eng == 'rashodnyye-materialy'*/){
            resizeimg($img_save, 115, 1, '', 'save', $menu_eng);
        }
        elseif($input_tab == RABOTY_IMG){
            resizeimg($img_save, 230, 3, '', 'save', RABOTY);
        }
        elseif($input_tab == RABOTY){
            resizeimg($img_save, 115, 4, '', 'save', RABOTY);
            imagedestroy($img);
            imagedestroy($watermark);
            return true;
        }
        else{
            resizeimg($img_save, 115, 4, '', 'save', TABLE_IMAGES);
        }
        if($input_tab == IMAGES_SERV){
            $img_save = PATH_IMG_SERV_GLOB.$filename;
        }
        elseif($input_tab == RABOTY_IMG){
            $img_save = PATH_IMG_BIGR.$filename;
        }
        else{
            $img_save = PATH_IMG_GLOB.$filename;
        }
        if (strstr($img_path, '.jpg')) imagejpeg($img, $img_save, $q);
        elseif (strstr($img_path, '.png')) imagepng($img, $img_save);
        elseif (strstr($img_path, '.gif')) imagegif($img, $img_save, $q);


        imagedestroy($img);
        imagedestroy($watermark);
        return true;
    }
}
/*...........функции пропорций фото.......................*/
function resizeimg($f, $w, $type, $q='', $s='', $menu_eng)
{
// f - имя файла
// type - способ масштабирования
// q - качество сжатия
// src - исходное изображение
// dest - результирующее изображение
// w - ширниа изображения
// ratio - коэффициент пропорциональности
// str - текстовая строка
    if (!file_exists($f)) return false;
// тип преобразования, если не указаны размеры
    if ($type == 0) $w = 30;  // квадратная 70x70
    if ($type == 1) $w = 115;  // квадратная 115x115
    if ($type == 2) $w = 218; // пропорциональная шириной 218
    if ($type == 3) $w = 200;  // квадратная 115x115
    $dstX = 0;
    $dstY = 0;

    $s_img = getimagesize($f);
    if ($s_img === false) return false;

// качество jpeg по умолчанию
    if ($q == '')
    {
        $q = 100;
    }

// создаём исходное изображение на основе
// исходного файла и опеределяем его размеры

    if ($s_img[2]==2)      $src = imagecreatefromjpeg($f);
    else if ($s_img[2]==1) $src = imagecreatefromgif($f);
    else if ($s_img[2]==3) $src = imagecreatefrompng($f);

    $w_src = imagesx($src);
    $h_src = imagesy($src);



// если размер исходного изображения
// отличается от требуемого размера
    if ($w_src != $w)
    {
        // операции для получения прямоугольного файла
        if ($type==2)
        {
            // вычисление пропорций
            $ratio = $w_src/$w;
            $w_dest = round($w_src/$ratio);
            $h_dest = round($h_src/$ratio);

            // создаём пустую картинку
            // важно именно truecolor!, иначе будем иметь 8-битный результат
            $dest = imagecreatetruecolor($w_dest,$h_dest);
            $str = "foxweb.net.ru";
            imagecopyresized($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
            // определяем координаты вывода текста
            $size = 2; // размер шрифта
            $x_text = $w_dest-imagefontwidth($size)*strlen($str)-3;
            $y_text = $h_dest-imagefontheight($size)-3;

            // определяем каким цветом на каком фоне выводить текст
            $white = imagecolorallocate($dest, 255, 255, 255);
            $black = imagecolorallocate($dest, 0, 0, 0);
            $gray = imagecolorallocate($dest, 127, 127, 127);
            if (imagecolorat($dest,$x_text,$y_text)>$gray) $color = $black;
            if (imagecolorat($dest,$x_text,$y_text)<$gray) $color = $white;

            // выводим текст
            imagestring($dest, $size, $x_text-1, $y_text-1, $str, $white-$color);
            imagestring($dest, $size, $x_text+1, $y_text+1, $str, $white-$color);
            imagestring($dest, $size, $x_text+1, $y_text-1, $str, $white-$color);
            imagestring($dest, $size, $x_text-1, $y_text+1, $str, $white-$color);

            imagestring($dest, $size, $x_text-1, $y_text,   $str, $white-$color);
            imagestring($dest, $size, $x_text+1, $y_text,   $str, $white-$color);
            imagestring($dest, $size, $x_text,   $y_text-1, $str, $white-$color);
            imagestring($dest, $size, $x_text,   $y_text+1, $str, $white-$color);

            imagestring($dest, $size, $x_text,   $y_text,   $str, $color);
        }
        // операции для получения файла с пропорциональным изображением отцентрированныя по квадрату
        if($type==4)
        {
            // вычисление пропорций

            if($w_src > $h_src)//если ширина больше высоты вычисляем смещение вниз по Y картинки
            {
                $ratio = $w_src/$w;
                $w_dest = round($w_src/$ratio);
                $h_dest = round($h_src/$ratio);
                $dstY = ($w_dest - $h_dest)/2;
            }
            if($h_src > $w_src)//если высота больше ширины вычисляем смещение вниз по X картинки
            {
                $ratio = $h_src/$w;
                $w_dest = round($w_src/$ratio);
                $h_dest = round($h_src/$ratio);
                $dstX = ($h_dest - $w_dest)/2;
            }
            if($h_src == $w_src)//если высота равна ширине
            {
                $w_dest = $w;
                $h_dest = $w;
            }
//echo '$ratio:'.$w_src.'/'.$w.'='.$ratio.'<br />';
//echo '$w_dest:'.$w_src.'/'.$ratio.'='.$w_dest.'<br />';
//echo '$h_dest:'.$h_src.'/'.$ratio.'='.$h_dest.'<br />';
            // создаём пустую картинку с белым фоном
            $dest = imagecreatetruecolor($w,$w);
            imagefill($dest, 0, 0, 0xffffff);
            imagecopyresized($dest, $src, $dstX, $dstY, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

        }

        // операции для получения квадратного файла
        if ($type==0||$type==1||$type==3)
        {
            // создаём пустую квадратную картинку
            // важно именно truecolor!, иначе будем иметь 8-битный результат
            $dest = imagecreatetruecolor($w,$w);

            // вырезаем квадратную серединку по x, если фото горизонтальное
            if ($w_src>$h_src)
                imagecopyresized($dest, $src, 0, 0,
                    round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                    0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));

            // вырезаем квадратную верхушку по y,
            // если фото вертикальное (хотя можно тоже серединку)
            if ($w_src<$h_src)
                imagecopyresized($dest, $src, 0, 0, 0,
                    round((max($w_src,$h_src)-min($w_src,$h_src))/2),
                    $w, $w, min($w_src,$h_src), min($w_src,$h_src));

            // квадратная картинка масштабируется без вырезок
            if ($w_src==$h_src)
                imagecopyresized($dest, $src, 0, 0, 0, 0, $w, $w, $w_src, $w_src);
        }
        if($s == 'save')
        {
            //Сохраняем уменьшенную копию
            $slesh = strrpos($f, '/');
            $filename = substr($f, $slesh+1);
            /*if($menu_eng == 'rashodnyye-materialy')
            {
                $save_path = PATH_IMG_SMALL.$filename;
            }*/
            if($menu_eng == RABOTY)
            {
                $type == 4?$save_path = 'img/'.RABOTY.'/'.$filename:$save_path = PATH_IMG_SMALLR.$filename;
            }
            elseif($menu_eng == TABLE_IMAGES)
            {
                $save_path = PATH_IMG_SMALL.$filename;
            }
            else
            {
                $save_path = PATH_IMG_SERV_SMALL.$filename;
            }
            if ($s_img[2]==2) imagejpeg($dest, $save_path, $q);
            else if ($s_img[2]==1) imagegif($dest, $save_path, $q);
            else if ($s_img[2]==3) imagepng($dest, $save_path);
        }
        else
        {
            // Выводим уменьшенную копию в поток вывода
            if ($s_img[2]==2)      header('Content-type: image/jpg');
            else if ($s_img[2]==1) header('Content-type: image/gif');
            else if ($s_img[2]==3) header('Content-type: image/png');
            if ($s_img[2]==2) imagejpeg($dest);
            else if ($s_img[2]==1) imagegif($dest);
            else if ($s_img[2]==3) imagepng($dest);

        }


        imagedestroy($dest);
        imagedestroy($src);
        return;
    }

}
//................ правка главные страницы сайта.........................//
function admin_main_page(){
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $Pages;
    $html ='<table class="table table-bordered table-condensed" >';
    foreach($Pages as $key => $value){
        $query = "SELECT title, link FROM ".ADMIN_ACTIONS." ORDER BY id";
        $mysqli->_execute($query);
        $product = '';
        $title = '<a href="/'.$value['link'].'" '.STYLE1.'>'.$value['title'].'</a>';
        $td = '<td>'.$title.'</td>';
        while($row_d =  $mysqli->fetch()){
            if($value["link"] == '') $value["link"] = "MainPage";
            $product.= '<tr class="submenu_td2">
                        <td><a href="'.ADMIN_PANEL.'/'.$row_d['link'].'/'.$value['link'].'" '.STYLE1.'>'.$row_d['title'].'</a></td>
                        </tr>';
        }
        $submenu_td = 'submenu_prod';

        $smarty->assign('td', $td);
        $smarty->assign('product', $product);
        $smarty->assign('submenu_td', $submenu_td);
        $html.= $smarty->fetch('inner-tpl/editTableT.tpl');
    }
    $html.='</table>';

    return $html;
}
function getTitle(){
    $array_pages = array();
    $array_products = array();
    $array_dif_tab = array();
    require('include/arrays.php');
    global $arResult;
    global $smarty;
    $AdminMenu = $arResult->DATA["AdminMenu"];
    $action = $arResult->ACTION;
    $title = '';
    foreach($AdminMenu as $value){
        $eng_menu   = $value["eng"];
        $title_menu = $value["title"];
        if($eng_menu == $action || ((in_array($action, $array_pages)) && $eng_menu == $array_pages[0])
            || ((in_array($action, $array_products)) && $eng_menu == $array_products[0])
            || ((in_array($action, $array_dif_tab)) && $eng_menu == $array_dif_tab[0])
            || 'edit_'.$eng_menu == $action){
            $title = $title_menu;
            break;
        }
        else{
            $title= "товары";
        }
    }
    $smarty->assign('page_title', $title);
    $html = $smarty->fetch('title.tpl');
    return $html;
}
function getEdit(){
    global $arResult;
    $html = '';
    $action = $arResult->ACTION;
    if($arResult->UsernameEnter["enter"] == "Y"){
        $mainpage = array('MainPage', 'about', 'oplata', 'contacts', 'price', 'catalog', 'services', 'nashi_raboty', );
        if($action == '') $action = 'MainPage';
        if(in_array($action, $mainpage) && $arResult->POS1 ==''){
            $html = buttonEditPage();
        }
        elseif($action == SERVICES || $action == RABOTY ){
            $html = buttonEditDif();
        }
        elseif($action == 'raschet-moshchnosti-oborudovaniya') $html = '';
        else{
            $html = buttonEditCatalog();
        }
    }
    return $html;
}
//..........кнопка edit.............................................
function buttonEditPage()
{
    global $arResult;
    $action = $arResult->ACTION;
    if($action == 'MainPage'){
        $button = '<div id="buttonEdit"><a href="'.HOME_URL.ADMIN_PANEL.'/edit_content/MainPage">'.EDIT_IMG_SITE.'</a></div>';

    }
    else {
        $button = '<div id="buttonEdit"><a href="'.HOME_URL.ADMIN_PANEL.'/edit_content/'.$action.'">'.EDIT_IMG_SITE.'</a></div>';

    }
    return $button;
}
function buttonEditCatalog()
{
    global $arResult;
    $action = $arResult->ACTION;
    if(isset($arResult->POS1) && $arResult->POS1 !=''){
        $pos1 = $arResult->POS1;
    }
    if(isset($arResult->POS2) && $arResult->POS2 !=''){
        $pos2 = $arResult->POS2;
    }
    if(isset($arResult->POS3) && $arResult->POS3 !=''){
        $pos3 = $arResult->POS3;
    }
    if(isset($arResult->POS1) && $arResult->POS1 !='' && $arResult->POS2 != '' && $arResult->POS3 == ''){
        $button = '<div id="buttonEdit"><a href="'.HOME_URL.ADMIN_PANEL.'/edit_catalog/'.$pos1.'/submenu/'.$pos2.'">'.EDIT_IMG_SITE.'</a></div>';
    }
    elseif(isset($arResult->POS1) && $arResult->POS1 !='' && $arResult->POS2 != '' && $arResult->POS3 != ''){
        $button = '<div id="buttonEdit"><a href="'.HOME_URL.ADMIN_PANEL.'/edit_catalog/'.$pos1.'/all/'.$pos2.'/'.$pos3.'">'.EDIT_IMG_SITE.'</a></div>';
    }
    else{
        $button = '<div id="buttonEdit"><a href="'.HOME_URL.ADMIN_PANEL.'/edit_catalog/'.$pos1.'/menu">'.EDIT_IMG_SITE.'</a></div>';
    }
    return $button;
}
function buttonEditDif()
{
    global $arResult;

    $action = $arResult->ACTION;
    if(isset($arResult->POS1) && $arResult->POS1 !=''){
        $pos1 = $arResult->POS1;
    }
    if($action == SERVICES){
        global $Services;
        $edit = 'edit_'.SERVICES;
        foreach($Services as $key=>$value){
            if($value["eng"] == $pos1) $id = $value["id"];
        }
    }
    if($action == RABOTY){
        $edit = 'edit_'.RABOTY;
        $id = $pos1;
    }
    if(isset($arResult->POS1) && $arResult->POS1 !=''){

        $button = '<div id="buttonEdit"><a href="'.HOME_URL.ADMIN_PANEL.'/'.$edit.'/'.$id.'">'.EDIT_IMG_SITE.'</a></div>';
    }
    return $button;
}





