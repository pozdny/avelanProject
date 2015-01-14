<?php

//..............................шапка..................................//
function head()
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    if($arResult->UsernameEnter["enter"] == "Y"){
        $class_true = 'block-true';
        $hello = hello();
    }
    else{
        $class_true = 'block-false';
        $hello = '';
    }
    $phone_service  = $arResult->INFO_SITE["phone_service"];
    $phone = $arResult->INFO_SITE["phone"];
    $email = $arResult->INFO_SITE["mail"];
    $work = $arResult->INFO_SITE["work"];
    $weekend = $arResult->INFO_SITE["weekend"];

    $navbar = navigator();
    $titlepage = header_meta("titlepage");
    $description = header_meta("description");
    $keywords = header_meta("keywords");
    $action_form = '/result_search';
    $smarty->assign('action', $action_form);
    $search_form = $smarty->fetch('search-form.tpl');

    if($arResult->Scripts["gerld"] == 'on'){
        $gerld = '<div id="gerland" class="gerland_4"><div id="nums_1">2</div></div>';
    }
    else $gerld = '';
    $smarty->assign('gerld', $gerld);
    $smarty->assign('navbar', $navbar);
    $smarty->assign('class_true', $class_true);
    $smarty->assign('titlepage', $titlepage);
    $smarty->assign('description', $description);
    $smarty->assign('keywords', $keywords);
    $smarty->assign('search_form', $search_form);
    $smarty->assign('phone_service', $phone_service);
    $smarty->assign('phone', $phone);
    $smarty->assign('email', $email);
    $smarty->assign('work', $work);
    $smarty->assign('weekend', $weekend);
    $smarty->assign('hello', $hello);
    $html = $smarty->fetch('header.tpl');
    return $html;
}
function footer(){
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    global $smarty;
    if($arResult->UsernameEnter["enter"] == "Y"){
        $class_true = 'block-true';
    }
    else{
        $class_true = 'block-false';
    }
    $name  = $arResult->INFO_SITE["name"];
    $query = "SELECT * FROM ".SCHET;
    $mysqli->_execute($query);
    $i=1;
    $date = date('Y');
    $smarty->assign('date', $date);
    $smarty->assign('name', $name);
    $smarty->assign('class_true', $class_true);
    while($row = $mysqli->fetch())
    {
        $schet = $row['content'];
        $smarty->assign('schet_'.$i, $schet);
        $i++;
    }
    if($arResult->Scripts["effect"] == 'on'){
        $snow_script = '<script src="/js/snowstorm.js"></script>';
    }
    else $snow_script = '';
    $smarty->assign('snow_script', $snow_script);
    $html = $smarty->fetch('footer.tpl');
    return $html;
}
function header_meta($str){
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    $result = '';

    if ( $arResult->ACTION =='' )
    {
        $arResult->ACTION = 'MainPage';
        $query = "SELECT titlepage, keywords, description FROM ".NAVIGATOR." WHERE eng=''";
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        if($str == 'titlepage') $result = $row['titlepage'];
        elseif($str == 'description') $result = $row['description'];
        elseif($str == 'keywords') $result = $row['keywords'];
    }
    else
    {
        if($arResult->ACTION == 'MainPage')
        {
            $query = "SELECT titlepage, keywords, description FROM ".NAVIGATOR." WHERE eng=''";
        }
        elseif($arResult->ACTION == 'catalog'){
            if($arResult->POS1 !='' && $arResult->POS2 ==''){
                $query = "SELECT titlepage, keywords, description
				          FROM ".CATALOG_MENU."
				          WHERE ".CATALOG_MENU.".eng LIKE '".$arResult->POS1."'";
            }
            elseif($arResult->POS2 != '' && $arResult->POS3 ==''){
                $query = "SELECT titlepage, keywords, description
				          FROM ".CATALOG_SUBMENU."
				          WHERE ".CATALOG_SUBMENU.".eng LIKE '".$arResult->POS2."'";
            }
            elseif($arResult->POS3 != ''){
                $query = "SELECT titlepage, content, keywords, description
				          FROM ".CATALOG_ALL."
				         WHERE ".CATALOG_ALL.".eng LIKE '".$arResult->POS3."'";
            }
            else{
                $query = "SELECT titlepage, keywords, description FROM ".NAVIGATOR." WHERE eng LIKE '".$arResult->ACTION."'";
            }
        }
        elseif($arResult->ACTION == 'services'){
            if($arResult->POS1 !='' && $arResult->POS2 ==''){
                $query = "SELECT titlepage, keywords, description
				          FROM ".SERVICES."
				          WHERE ".SERVICES.".eng LIKE '".$arResult->POS1."'";
            }
            else{
                $query = "SELECT titlepage, keywords, description FROM ".NAVIGATOR." WHERE eng LIKE '".$arResult->ACTION."'";
            }
        }
        elseif($arResult->ACTION == 'nashi_raboty'){
            if($arResult->POS1 !='' && $arResult->POS2 ==''){
                $query = "SELECT titlepage, keywords, description
				          FROM ".RABOTY."
				          WHERE ".RABOTY.".id = '".$arResult->POS1."'";
            }
            else{
                $query = "SELECT titlepage, keywords, description FROM ".NAVIGATOR." WHERE eng LIKE '".$arResult->ACTION."'";
            }
        }
        elseif($arResult->ACTION == 'raschet-moshchnosti-oborudovaniya'){
            if($arResult->POS1 !='' && $arResult->POS2 ==''){
                $query = "SELECT titlepage, keywords, description
				          FROM ".CALCULATE."
				          WHERE ".CALCULATE.".eng LIKE '".$arResult->POS1."'";
            }
            else{
                $query = "SELECT titlepage, keywords, description FROM ".NAVIGATOR." WHERE eng LIKE '".$arResult->ACTION."'";
            }
        }
        else
        {
            $query = "SELECT titlepage, keywords, description FROM ".NAVIGATOR." WHERE eng LIKE '".$arResult->ACTION."'";
        }
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        if($str == 'titlepage'){
            $result = $row['titlepage'];
            if(empty($result)) $result = 'Авелан';
        }
        elseif($str == 'description'){
            $result = $row['description'];
            if(empty($result)) $result = 'Кондиционеры и тепловентиляционное оборудование в Новосибирске';
        }
        elseif($str == 'keywords'){
            $result = $row['keywords'];
            if(empty($result)) $result = 'Кондиционеры и тепловентиляционное оборудование в Новосибирске';
        }
    }
    return $result;
}
//..............................навигация..................................//
function navigator()
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    $li_content = '';
    $query = "SELECT title, eng FROM ".NAVIGATOR." ORDER BY id LIMIT 1,7";
    $mysqli->_execute($query);

    if($arResult->ACTION!='')
    {
        $action = $arResult->ACTION;
    }
    else{
        $action = DEFAULT_PAGE;
    }
    if($mysqli->num_rows() > 0){
        while($row_q = $mysqli->fetch()){
            $eng_title = $row_q['eng'];
            if($row_q['eng'] == '')
            {
                $eng = 'main';
                $url = '/';
            }
            else
            {
                $eng = $row_q['eng'];
                $url = '/'.$eng_title;
            }
            if($action == $eng){
                $class='class="active"';
            }
            else{
                $class = '';
            }

            $title = $row_q["title"];
            $smarty->assign('title', $title);
            $smarty->assign('class', $class);
            $smarty->assign('url', $url);
            $li_content.= $smarty->fetch('inner-tpl/navli-content.tpl');
        }
    }
    $smarty->assign('navli_content', $li_content);

    $html = $smarty->fetch('navbar.tpl');
    return $html;
}
//...........генератор заголовков..............
function title_main()
{
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    if($arResult->ACTION!='' && $arResult->POS1 == '')
    {
        $action = $arResult->ACTION;
        if($action == 'MainPage')
        {
            $query = "SELECT zagolovok FROM ".NAVIGATOR." WHERE id = 1";
            $mysqli->_execute($query);
            $row_l = $mysqli->fetch();

            $title_rus = trim($row_l['zagolovok']);
            $title = $title_rus;
            return '<div align="center">'.$title.'</div>';
        }
        else
        {
            $query = "SELECT zagolovok FROM ".NAVIGATOR." WHERE eng LIKE '".$action."' ";
            $mysqli->_execute($query);
            $row_l = $mysqli->fetch();
        }
        $title_rus = trim($row_l['zagolovok']);
        $title = $title_rus;
    }
    elseif($arResult->POS1!= '' && $arResult->POS2 == '')
    {
        $action = $arResult->ACTION;
        $pos1   = $arResult->POS1;
        if($action == "services")
        {
            $query = "SELECT title FROM ".SERVICES." WHERE eng LIKE '".$pos1."' ";
            $mysqli->_execute($query);
            $row_l = $mysqli->fetch();
            $title_rus = trim($row_l['title']);
            $title = '<span '.STYLE6.'>'.$title_rus.'</span>';
            return $title;
        }
        if($action == "nashi_raboty")
        {
            $query = "SELECT title FROM ".RABOTY." WHERE id='".$pos1."' ";
            $mysqli->_execute($query);
            $row_l = $mysqli->fetch();
            $title_rus = trim($row_l['title']);
            $title = '<span '.STYLE6.'>'.$title_rus.'</span>';
            return $title;
        }
        if($action == "raschet-moshchnosti-oborudovaniya")
        {
            $query = "SELECT zagolovok FROM ".NAVIGATOR." WHERE eng LIKE '".$action."' ";
            $mysqli->_execute($query);
            $row_l = $mysqli->fetch();
            $title_rus = trim($row_l['zagolovok']);
            $title = '<span '.STYLE6.'>'.$title_rus.'</span>';
            return $title;
        }
        $query = "SELECT id, h1 FROM ".CATALOG_MENU." WHERE eng LIKE '".$pos1."' ";
        $mysqli->_execute($query);
        $row_l = $mysqli->fetch();
        $title_rus = trim($row_l['h1']);
        $title = $title_rus;
        /*if($arResult["POS1"] != 'rashodnyye-materialy')
        $title = $txt3.$title.' '.$txt2;
        else
        $title = $title.$txt1.$txt2;*/
        //$title_big = ucfirst($title);
        //setTitle($title_big, CATALOG_MENU, $row_l['id']);
        //setH1($title, CATALOG_MENU, $row_l['id']);
    }
    elseif($arResult->POS2!= '' && $arResult->POS3 == '')
    {
        $pos2 = $arResult->POS2;
        $query = "SELECT id, h1 FROM ".CATALOG_SUBMENU." WHERE eng LIKE '".$pos2."' ";
        $mysqli->_execute($query);
        $row_l = $mysqli->fetch();
        $title_rus = trim($row_l['h1']);
        $title = $title_rus;
        /*if($arResult["POS1"] != 'rashodnyye-materialy')
        $title = $txt3.$title.' '.$txt2;
        else
        $title = $title.$txt1.$txt2;
        $title_big = ucfirst($title);*/
        //setTitle($title_big, CATALOG_SUBMENU, $row_l['id']);
        //setH1($title, CATALOG_SUBMENU, $row_l['id']);
    }
    elseif($arResult->POS3!= '')
    {
        $pos3 = $arResult->POS3;
        $query = "SELECT id, h1 FROM ".CATALOG_ALL." WHERE eng LIKE '".$pos3."' ";
        $mysqli->_execute($query);
        $row_l = $mysqli->fetch();
        $title_rus = trim($row_l['h1']);
        $title = $title_rus;
        /*if($arResult["POS1"] != 'rashodnyye-materialy')
        $title = $txt3.$title.' '.$txt2;
        else
        $title = $title.$txt1.$txt2;
        $title_big = ucfirst($title);*/
        //setTitle($title_big, CATALOG_ALL, $row_l['id']);
        //setH1($title, CATALOG_ALL, $row_l['id']);
    }

    else
        $title = '';

    return $title;
}
//...................функция для услуг.............................//
function catalog_services()
{
    $mysqli = M_Core_DB::getInstance();
    global $arResult; //echo '<pre>';print_r($arResult);echo '</pre>';
    $query = "SELECT ".SERVICES.".id, ".SERVICES.".title, ".SERVICES.".eng FROM ".SERVICES."
              WHERE ".SERVICES.".eng NOT LIKE 'default%'
	     	  ORDER BY ".SERVICES.".id";
    $mysqli->_execute($query);
    $html = '';

    $html.= '<hr>';
    //$html.='<b>Более подробную информацию об услугах можно получить перейдя в интересующий раздел по ссылкам ниже:</b><br>';
    $html.= '<ul class="ul_total">';
    while($row_s = $mysqli->fetch())
    {
        $eng = $row_s['eng'];
        $title_elem = $row_s['title'];
        if($arResult->POS1 != $eng)
            $html.= '<li><a href="/'.$arResult->ACTION.'/'.$eng.'" '.STYLE6.'>'.$title_elem.'</a></li>';
    }

    $html.= '</ul><hr>';

    return $html;
}
function catalog_services_pos1()
{
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    global $smarty;
    $html = $block_img = '';
    if($arResult->POS1 !='')
    {
        $pos1 = $arResult->POS1;
    }

    $query = "SELECT ".SERVICES.".id, ".SERVICES.".content FROM ".SERVICES."
	     	  WHERE  ".SERVICES.".eng LIKE '".$pos1."'";
    $mysqli->_execute($query);
    $row_s = $mysqli->fetch();
    $id = $row_s['id'];
    if(!$row_s)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    else{
        $query = 'SELECT * FROM '.IMAGES_SERV.'
		         WHERE '.IMAGES_SERV.'.all_id = '.$id.'
				 AND '.IMAGES_SERV.'.img IS NOT NULL ORDER BY id ASC';
        $mysqli->_execute($query);

        if($mysqli->num_rows() > 0)
        {
            $block_img = '<div class="single_foto">'."\n";

            $i = 0;
            if($mysqli->num_rows() > 1)
            {
                $rel = 'data-fancybox-group="gellery"';
            }
            else
            {
                $rel = '';
            }
            while($row_img = $mysqli->fetch())
            {
                $link  = '<a href="/'.PATH_IMG_SERV_GLOB.FindImg($row_img['img'], 'services/catalog/', IMAGES_SERV, $row_img['id']).'" title="'.$row_img['img_title'].'" '.$rel.'><div class="lupa" ></div></a>';
                $img = "<img src='/".PATH_IMG_SERV_SMALL.FindImg($row_img['img'], 'services/small/', IMAGES_SERV, $row_img['id'])."' class='center' alt='".$row_img['alt']."' title='".$row_img['img_title']."' >";
                $name = 'img_block_one';
                $title = $row_img['img_title'];
                $smarty->assign('img', $img);
                $smarty->assign('link', $link);
                $smarty->assign('name', $name);
                $smarty->assign('title', $title);
                $block_img.= $smarty->fetch('inner-tpl/catalog-img-block.tpl');

                $i++;
            }
            $block_img.= '</div>';
        }
        $html.= $block_img;
        $html.='<div class="cat_text">'.print_page($row_s['content']).'</div>';
    }
    return $html;
}
// .............................поиск изображения...........................//
function FindImg($img, $path, $tab, $id){
    $mysqli = M_Core_DB::getInstance();
    $img_empty = 'empty.jpg';
    $image_dir_path = $_SERVER["DOCUMENT_ROOT"] . PATH_IMG.$path;
    $image_dir = opendir($image_dir_path);
    $i = 0;
    $image_files = null;
    while (($image_file = readdir($image_dir)) !==false)
    {
        if (($image_file != ".") && ($image_file != ".."))
        {
            $image_files[$i] = basename($image_file);
            $i++;
        }
    }
    closedir($image_dir);
    $image_files_count = count($image_files);
    if ($image_files_count){
        sort($image_files);
        for ($i = 0; $i <$image_files_count; $i++)
        {
            if($image_files[$i] == $img){
                return $img;
            }
        }


    }
    $query = sprintf("UPDATE ".$tab." SET img=%s  WHERE id=%s",
        GetSQLValueString($img_empty, "text"),
        GetSQLValueString($id, "int"));
    $mysqli->query($query);
    return $img_empty;
}
//..............................функция ошибок.............................//
function error404($sapi_name, $request_url)
{
    if ($sapi_name == 'cgi' || $sapi_name == 'cgi-fcgi')
    {
        header('Status: 404 Not Found');
    }
    else
    {
        header($_SERVER['SERVER_PROTOCOL'] . '404 Not Found');
    }
    header( 'Refresh: '.REDIRECT_DELAY2.'; url=/error.php?id=404&request='.$request_url );
}
function catalog_menu(){
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    if($arResult->ACTION!=''){
        $action = $arResult->ACTION;
        if($arResult->POS1==''){
            $in_out = "out";
        }
        else $in_out = "in";
    }
    $pos1 = $arResult->POS1;
    $pos2 = $arResult->POS2;
    $pos3 = $arResult->POS3;
    if($action == 'catalog')
    {
        $query = "SELECT DISTINCT ".CATALOG_MENU.".id, ".CATALOG_MENU.".title, ".CATALOG_MENU.".eng FROM ".CATALOG_SUBMENU."
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE ".CATALOG_MENU.".id !=5
			  ORDER BY ".CATALOG_MENU.".id";
    }
    else{
        $query = '';
    }
    $k = $mysqli->queryQ($query);
    if($mysqli->num_r($k) > 0){
        $navli_menu = '';
        while($row_k = $mysqli->fetchAssoc($k)){
            $title_menu = $row_k["title"];
            $id_menu = 'id="'.$row_k["eng"].'"';
            ($pos1 == $row_k["eng"])? $active_menu = "active" : $active_menu = '';
            $query = 'SELECT  DISTINCT '.CATALOG_SUBMENU.'.id, '.CATALOG_SUBMENU.'.title, '.CATALOG_SUBMENU.'.eng FROM '.CATALOG_SUBMENU.'
					INNER JOIN '.CATALOG_MENU.' ON '.CATALOG_SUBMENU.'.menu_id = '.$row_k['id'].'
					WHERE '.CATALOG_SUBMENU.'.eng NOT LIKE "default%"
					ORDER BY '.CATALOG_SUBMENU.'.id ASC';
            $e = $mysqli->queryQ($query);
            if($mysqli->num_r($e) > 0){
                $navli_submenu = '';
                while($row_e = $mysqli->fetchAssoc($e)){
                    $nav_subsubmenu = '';
                    $title_submenu = $row_e["title"];
                    $id_submenu = $row_e["eng"];
                    $url_submenu = '/'.$action.'/'.$row_k["eng"].'/'.$row_e["eng"];
                    ($pos2 == $row_e["eng"])? $active_submenu = "active" : $active_submenu = '';
                    $query = 'SELECT  DISTINCT '.CATALOG_ALL.'.id, '.CATALOG_ALL.'.title, '.CATALOG_ALL.'.eng FROM '.CATALOG_ALL.'
							INNER JOIN '.CATALOG_SUBMENU.' ON '.CATALOG_ALL.'.submenu_id = '.$row_e['id'].'
							INNER JOIN '.CATALOG_MENU.' ON '.CATALOG_SUBMENU.'.menu_id = '.$row_k['id'].'
							WHERE '.CATALOG_ALL.'.eng NOT LIKE "default%"
							ORDER BY '.CATALOG_ALL.'.id ASC';
                    $s = $mysqli->queryQ($query);
                    if($mysqli->num_r($s) > 0){
                        $navli_subsubmenu = '';
                        while($row_s = $mysqli->fetchAssoc($s)){
                            $title_subsubmenu = $row_s["title"];
                            $url_subsubmenu = $url_submenu.'/'.$row_s["eng"];
                            $id_subsubmenu = 'id="'.$row_s["eng"].'"';
                            ($pos3 == $row_s["eng"])? $active_subsubmenu = "active" : $active_subsubmenu = '';
                            $smarty->assign('title_subsubmenu', $title_subsubmenu);
                            $smarty->assign('url_subsubmenu', $url_subsubmenu);
                            $smarty->assign('id_subsubmenu', $id_subsubmenu);
                            $smarty->assign('active_subsubmenu', $active_subsubmenu);
                            $navli_subsubmenu.= $smarty->fetch('inner-tpl/catalog-menu/navli-subsubmenu.tpl');
                        }
                        $smarty->assign('navli_subsubmenu', $navli_subsubmenu);
                        $smarty->assign('id_submenu', $id_submenu);
                        $nav_subsubmenu = $smarty->fetch('inner-tpl/catalog-menu/nav-subsubmenu.tpl');
                    }
                    $smarty->assign('id_submenu', $id_submenu);
                    $smarty->assign('active_submenu', $active_submenu);
                    $smarty->assign('title_submenu', $title_submenu);
                    $smarty->assign('url_submenu', $url_submenu);
                    $smarty->assign('nav_subsubmenu', $nav_subsubmenu);
                    $navli_submenu.= $smarty->fetch('inner-tpl/catalog-menu/navli-submenu.tpl');
                }
            }

            $smarty->assign('title_menu', $title_menu);
            $smarty->assign('id_menu', $id_menu);
            $smarty->assign('active_menu', $active_menu);
            $smarty->assign('navli_submenu', $navli_submenu);
            $navli_menu.= $smarty->fetch('inner-tpl/catalog-menu/navli-menu.tpl');
        }
    }
    //$smarty->assign('title', $title);
    $smarty->assign('navli_menu', $navli_menu);
    $smarty->assign('in_out', $in_out);
    $html = $smarty->fetch('inner-tpl/catalog-menu/catalog-menu.tpl');
    return $html;
}
function left_menu(){
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    $action = $arResult->ACTION;
    $pos1 = $arResult->POS1;
    $pos2 = $arResult->POS2;
    $pos3 = $arResult->POS3;
    if($action == 'services'){
        $query = "SELECT ".SERVICES.".id, ".SERVICES.".title, ".SERVICES.".eng FROM ".SERVICES."
                  WHERE ".SERVICES.".eng NOT LIKE 'default%'
			      ORDER BY ".SERVICES.".id";
    }
    elseif($action == 'nashi_raboty'){
        $query = "SELECT * FROM ".RABOTY."
			  ORDER BY ".RABOTY.".id";
    }
    else{
        $query = '';
    }
    $mysqli->_execute($query);
    if($mysqli->num_rows() > 0){
        $navli_menu = '';
        while($row= $mysqli->fetch()){
            $title_menu = $row["title"];
            if($action =='nashi_raboty'){
                $id_menu = 'id="'.$row["id"].'"';
                $p = $row["id"];
            }
            else{
                $id_menu = 'id="'.$row["eng"].'"';
                $p = $row["eng"];
            }

            ($pos1 == $p)? $active_menu = "active" : $active_menu = '';
            $url_menu = '/'.$action.'/'.$p;
            $smarty->assign('title_menu', $title_menu);
            $smarty->assign('url_menu', $url_menu);
            $smarty->assign('active_menu', $active_menu);
            $navli_menu.= $smarty->fetch('inner-tpl/left-menu/navli-menu.tpl');
        }
    }

    $smarty->assign('navli_menu', $navli_menu);
    $html = $smarty->fetch('inner-tpl/left-menu/left-menu.tpl');
    return $html;
}
//...........крошки..............
function bread_crumbs($arrayBreadCrumbs)
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;

    $content = '';
    $html = '';
    $li = '';
    $class_active = "active";
    if($arResult->ACTION!= ''){
        $action = $arResult->ACTION;
        if(!in_array($action, $arrayBreadCrumbs)){
            return $html;
        }
        else{
            $query = "SELECT title, eng FROM ".NAVIGATOR." WHERE id = 1";
            $mysqli->_execute($query);
            $row = $mysqli->fetch();

            $title = $row['title'];
            $li.= '<li><a href="/">'.$title.'</a></li>';
            if($action == 'MainPage' || !in_array($action, $arrayBreadCrumbs)){
                return $li;
            }
            else{
                $query = "SELECT title FROM ".NAVIGATOR." WHERE eng LIKE '".$action."' ";
                $mysqli->_execute($query);
                $row = $mysqli->fetch();
                $title = $row['title'];

                if($arResult->POS1 == ''){
                    $li.='<li class="'.$class_active.'">'.$title.'</li>';
                }
                else{
                    $li.='<li><a href="/'.$action.'">'.$title.'</a></li>';
                }
            }

        }
    }
    if($arResult->POS1!= ''){
        $pos1 = $arResult->POS1;
        if($action == 'catalog'){
            $tab = CATALOG_MENU;
            $where = "eng LIKE '".$pos1."'";
        }
        elseif($action == 'nashi_raboty'){
            $tab = RABOTY;
            $where = "id='".$pos1."'";
        }
        elseif($action == 'raschet-moshchnosti-oborudovaniya'){
            $tab = CALCULATE;
            $where = "eng LIKE '".$pos1."'";
        }
        else{
            $tab = SERVICES;
            $where = "eng LIKE '".$pos1."'";
        }
        $query = "SELECT title FROM ".$tab." WHERE ".$where;
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $title = $row['title'];
        $title = ucfirst($title);
        if($arResult->POS2== '' || $action = 'catalog'){
            if($action == 'catalog'){
                $class_active = '';
                $class_cat = " class_cat";
            }
            else{
                $class_active = "active";
                $class_cat = '';
            }
            $li.='<li class="'.$class_active.$class_cat.'">'.$title.'</li>';
        }
        else{
            $li.='<li><a href="/'.$action.'/'.$pos1.'">'.$title.'</a></li>';
        }
    }
    if($arResult->POS2!= ''){
        $pos2 = $arResult->POS2;
        $query = "SELECT title FROM ".CATALOG_SUBMENU." WHERE eng LIKE '".$pos2."' ";
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $title = $row['title'];
        $title = ucfirst($title);
        if($arResult->POS3== ''){
            $class_active = "active";
            $li.='<li class="'.$class_active.'">'.$title.'</li>';
        }
        else{
            $li.='<li><a href="/'.$action.'/'.$pos1.'/'.$pos2.'">'.$title.'</a></li>';
        }

    }

    if($arResult->POS3!= '')
    {
        $pos3 = $arResult->POS3;
        $query = "SELECT title FROM ".CATALOG_ALL." WHERE eng LIKE '".$pos3."' ";
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $title = $row['title'];
        $title = ucfirst($title);
        if($arResult->POS4== '')
        {
            $class_active = "active";
            $li.='<li class='.$class_active.'>'.$title.'</li>';
        }
        else
        {
            $li.='<li><a href="/'.$action.'/'.$pos1.'/'.$pos2.'/'.$pos3.'">'.$title.'</a></li>';
        }

    }
    $smarty->assign('li', $li);
    $content = $smarty->fetch('inner-tpl/bread-crumbs/ol-bread-crumbs.tpl');

    $smarty->assign('content', $content);
    $html = $smarty->fetch('inner-tpl/bread-crumbs/bread-crumbs.tpl');
    return $html;
}
function nashi_rabotyMain()
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    $maxRows = 120;
    $html = '';
    //unset($_SESSION["pageNum_back"]);
    if ($arResult->PAGE_NUM!='')
    {
        $pageNum = $arResult->PAGE_NUM;
        if ( $pageNum < 1 )
        {
            $pageNum = 1;
            $_SESSION["pageNum_back"] = '';
        }
        else
        {
            $_SESSION["pageNum_back"] = 'page='.$pageNum;
        }
    }
    else
    {
        $pageNum = 1;
        $arResult->PAGE_NUM = $pageNum;
        $_SESSION["pageNum_back"] = '';
    }
    $startRow = ($pageNum-1)* $maxRows;
    $query = "SELECT * FROM ".RABOTY;
    $query_limit = sprintf("%s LIMIT %d, %d", $query, $startRow, $maxRows);
    $k = $mysqli->queryQ($query_limit);
    $all = $mysqli->queryQ($query);
    $totalRows = $mysqli->num_r($all);
    $totalPages = ceil($totalRows/$maxRows);
    if($totalPages > 1 && $pageNum > $totalPages)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    else
    {
        $filename = '/';
        $uri = 'page';
        if($mysqli->num_r($k) > 0)
        {
            $block_img = '';
            while($row_k = $mysqli->fetchAssoc($k))
            {
                $a = '<a href="/nashi_raboty/'.$row_k['id'].'" >';
                $img = '<img src="/img/nashi_raboty/'.FindImg($row_k['img'], 'nashi_raboty/', RABOTY, $row_k['id']).'"  alt="'.$row_k['alt'].'" title="'.$row_k['img_title'].'"  class="center" >';
                $title = $row_k['title'];
                $pos = 'class = "pos2_img"';
                $smarty->assign('img', $img);
                $smarty->assign('pos', $pos);
                $smarty->assign('title', $title);
                $smarty->assign('a', $a);
                $block_img.= $smarty->fetch('inner-tpl/raboty/images-block.tpl');
            }
            $list = listanije($totalPages, $pageNum, $filename, $uri, '' );


            $smarty->assign('content', $block_img);
            $block_single = $smarty->fetch('inner-tpl/single-img-block.tpl');
            $html.= $block_single.$list;
        }
        else
        {
            $html = '<div align="center">Пунктов нет</div>';
        }
        return $html;
    }
}

//.................функция листания.........................//
function listanije($totalPages, $pageNum, $filename, $u, $admin='', $k='')
{
    $html = '';
    $uri = $filename;
    if ( $_SERVER['QUERY_STRING'] != '' )
    {
        foreach( $_GET as $key => $value )
        {
            if ( $key != $u )
            {
                if($value !='orders' && ($admin != 'admin'))
                {
                    $uri = $uri.urlencode($value).'/';
                }
            }
        }
    }
    if ( $totalPages > 1 )
    {
        // Проверяем нужна ли стрелка "В начало"
        // Находим две ближайшие станицы с обоих краев, если они есть
        $tpr = '';
        $tpl = '';
        $r=1;
        $le=1;
        $pageleft_l = '';
        $pageleft = '';
        if($k == '') $k = 10;
        $left = '<img src="/images/icon/left.gif">';
        $right = '<img src="/images/icon/right.gif">';
        if($totalPages<=$k)
        {
            $total = $totalPages;
            while($le<$total)
            {
                if ( $pageNum  > $le )
                {
                    $num_p = $pageNum-$le;
                    if($num_p == 1)
                    {
                        $pos = strrpos($uri, '/');
                        if($pos)
                        {
                            $urii = substr($uri, 0, -1);
                        }
                        $num_str = '';
                    }
                    else $num_str = 'page='.$num_p;
                    $pageleft = '<li><a  href="'.$urii.$num_str.'">'.($pageNum-$le).'</a></li>'."\n";
                }
                else
                    $pageleft = '';

                $tpl = $pageleft.$tpl;
                $le++;
            }
            while($r<$total)
            {
                if ( $pageNum + $r <= $total)
                    $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'</a></li>'."\n";
                else
                    $pageright = '';
                $tpr = $tpr.$pageright;
                $r++;
            }

        }
        else
        {
            $cel = ceil($pageNum/$k);

            $total = $cel * $k;
            if ( $pageNum >= $k )
            {

                $pos = strrpos($uri, '/');
                if($pos)
                {
                    $urii = substr($uri, 0, -1);
                }
                $startpage = '<li><a href="'.$urii.'" >'.$left.'</a></li>'."\n";
            }
            else
                $startpage = '';

            if ( $pageNum < $totalPages  )
                $endpage = '<li><a href="'.$uri.'page='.$totalPages.'" >'.$right.'</a></li>'."\n";
            else
                $endpage = '';
            //.............left........................
            $modul = $pageNum%$k;
            while($le<$total)
            {
                $j = floor($pageNum/$k);
                if($modul)
                {
                    $modul1 = ($pageNum - $r)%$k;
                    if ( $pageNum  > $le )
                    {

                        if($modul1)
                        {
                            $pageleft = '<li><a  href="'.$uri.'page='.($pageNum-$le).'">'.($pageNum-$le).'</a></li>'."\n";
                        }
                        else
                        {

                            for($i = 0, $p = 1, $pk = $k; $i<$j; $i++, $p+=$k, $pk+=$k)
                            {
                                $urii = $uri;
                                if($p == 1)
                                {
                                    $pos = strrpos($uri, '/');
                                    if($pos)
                                    {
                                        $urii = substr($uri, 0, -1);
                                    }
                                    $num_str = '';
                                }
                                else
                                {

                                    $num_str = 'page='.$p;
                                }
                                $pageleft_l.= '<li><a  href="'.$urii.$num_str.'">'.$p.'-'.($pk-1).'</a></li>'."\n";
                                if($p == 1) $p--;
                            }
                            $pageleft = $pageleft_l.'<li><a  href="'.$uri.'page='.($pageNum-$le).'">'.($pageNum-$le).'</a></li>'."\n";


                            $le = $total;
                        }
                    }
                    else
                        $pageleft = '';


                }
                else
                {

                    for($i = 0, $p = 1, $pk = $k; $i<$j; $i++, $p+=$k, $pk+=$k)
                    {
                        $urii = $uri;
                        if($p == 1)
                        {
                            $pos = strrpos($uri, '/');
                            if($pos)
                            {
                                $urii = substr($uri, 0, -1);
                            }
                            $num_str = '';
                        }
                        else $num_str = 'page='.$p;
                        $pageleft.= '<li><a  href="'.$urii.$num_str.'">'.$p.'-'.($pk-1).'</a></li>'."\n";
                        if($p == 1) $p--;
                    }
                    $le = $total;

                }
                $tpl = $pageleft.$tpl;
                $le++;
                $r++;
            }
            //.............right........................
            $r = 1;
            while($r<=$total)
            {

                if($modul)
                {
                    if ( $pageNum + $r <= $total)
                    {
                        if($pageNum + $r == $total)
                        {
                            $right_list = $pageNum + $r + $k;
                            if($right_list > $totalPages)
                            {
                                $right_list = $totalPages;
                            }
                            $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'-'.$right_list.'</a></li>'."\n";
                            $endpage = '<li><a href="'.$uri.'page='.$totalPages.'" >'.$right.'</a>'."\n";
                            $tpr.= $pageright;
                            break;
                        }
                        else
                        {
                            if($pageNum == $totalPages)
                            {
                                $pageright = '';
                                $tpr.= $pageright;
                                break;
                            }
                            if($pageNum + $r == $totalPages)
                            {
                                $endpage = '';
                                $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'</a></li>'."\n";
                                $r = $total;
                            }
                            else
                            {
                                $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'</a></li>'."\n";
                            }


                        }


                    }
                    else
                    {
                        if ( $pageNum + $r <= $totalPages)
                        {
                            if($pageNum + $r == $totalPages)
                            {

                                $endpage = '';
                            }
                            $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'</a></li>'."\n";
                        }
                        else
                        {
                            $pageright = '';
                        }
                    }
                    $tpr.= $pageright;
                    $r++;
                }
                else
                {
                    $total1 = $total + $k;
                    if ( $pageNum + $r <= $total1)
                    {
                        if($pageNum + $r == $total1)
                        {
                            $right_list = $pageNum + $r + $k;
                            if($right_list > $totalPages)
                            {
                                $right_list = $totalPages;
                            }
                            $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'-'.$right_list.'</a></li>'."\n";
                            $endpage = '<li><a href="'.$uri.'page='.$totalPages.'" >'.$right.'</a>'."\n";
                            $tpr.= $pageright;
                            break;
                        }
                        else
                        {
                            if($pageNum + $r == $totalPages)
                            {
                                $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'</a></li>'."\n";
                                $endpage = '';
                                $tpr.= $pageright;
                                break;
                            }
                            else
                            {
                                $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'</a></li>'."\n";
                            }

                        }

                    }
                    else
                    {
                        if($pageNum + $r <= $totalPages)
                        {
                            if($pageNum + $r == $totalPages)
                            {
                                $endpage = '';
                            }
                            $pageright = '<li><a  href="'.$uri.'page='.($pageNum + $r).'">'.($pageNum + $r).'</a></li>'."\n";
                        }
                        else
                            $pageright = '';
                    }
                    $tpr.= $pageright;
                    $r++;
                }
            }

            $tpl = $startpage.$tpl;
            $tpr=$tpr.$endpage;
        }

        $html = '<div class="pusher"></div><div class="bottomBreadcrumbs"><ul><li class="titleList">Страница:</li>';
        // Выводим меню
        $html.= $tpl.'<li class="current"><a href="#">'.$pageNum .'</a></li>'.$tpr;
        $html.='</ul></div><div class="pusher"></div>'."\n";
    }
    return $html;
}
function nashi_raboty_pos1(){
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    $html = '';
    $block_img = '';
    $query = "SELECT *
			  FROM ".RABOTY."
			  WHERE id =".$arResult->POS1;
    $mysqli->_execute($query);
    $row = $mysqli->fetch();
    if(!$row)
    {
        error404(SAPI_NAME, REQUEST_URL);
    }
    else
    {
        //$maxRows = 6;
        $cell    = 3;
        if ($arResult->PAGE_NUM!='')
        {
            $pageNum = $arResult->PAGE_NUM;
            if ( $pageNum < 1 )
            {
                $pageNum = 1;
            }

        }
        else
        {
            $pageNum = 1;
            $arResult->PAGE_NUM = $pageNum;
        }

        $query = "SELECT * FROM ".RABOTY_IMG." WHERE ".RABOTY."_id=".$arResult->POS1." ORDER BY ".RABOTY_IMG.".id";;
        $x = $mysqli->queryQ($query);
        $row_img = $mysqli->fetchAssoc($x);

        $totalRows = $mysqli->num_r($x);
        //выберем весь массив фотографий для этой категории
        $query = "SELECT * FROM ".RABOTY_IMG." WHERE ".RABOTY."_id=".$arResult->POS1." ORDER BY ".RABOTY_IMG.".id";;
        $mysqli->_execute($query);
        $array = array();

        $i = 0;
        while($array_elem = $mysqli->fetch())
        {
            $j=$array_elem["id"];
            $array[$j]["img"] = $array_elem["img"];
            $array[$j]["img_title"] = $row_img["img_title"];
            $i++;
        }

        if($totalRows > 0)
        {

            if($row_img > 0)
            {
                $i = 0;

                if($row_img > 1)
                {
                    $rel = 'data-fancybox-group="gellery"';
                }
                else
                {
                    $rel = '';
                }
                do{
                    if($i%$cell == 0)
                    {
                        $block_img.= '<div class="single_foto">';
                    }

                    $link  = '<a href="/'.PATH_IMG_BIGR.FindImg($row_img['img'], 'nashi_raboty/big/', TABLE_IMAGES, $row_img['id']).'" title="'.$row_img['img_title'].'" '.$rel.'><div class="lupa" ></div></a>';
                    $img = "<img src='/".PATH_IMG_SMALLR.FindImg($row_img['img'], 'nashi_raboty/small/', TABLE_IMAGES, $row_img['id'])."' class='center' alt='".$row_img['alt']."' title='".$row_img['img_title']."' >";
                    $name = 'img_blockR';
                    $description = print_page($row_img["description"]);
                    $smarty->assign('img', $img);
                    $smarty->assign('link', $link);
                    $smarty->assign('name', $name);
                    $smarty->assign('description', $description);
                    $block_img.= $smarty->fetch('inner-tpl/raboty/images-blockR.tpl');
                    $j = $row_img["id"];
                    $array_list[$j]["img"] = $row_img["img"];
                    $array_list[$j]["img_title"] = $row_img["img_title"];

                    $i++;
                    if($i%$cell == 0 || $i == $totalRows )
                    {
                        $block_img.= '</div>';
                    }


                } while($row_img = $mysqli->fetchAssoc($x));

                $html.= $block_img.backLinkG();
            }
            else{
                $html = '<div align="center">Пунктов нет</div>';
                $html.= backLinkG();
            }
            return $html;
        }

    }
}
function backLinkG()
{
    global $arResult;
    $back_page = '';
    if($arResult->PAGE_NUM_BACK !='')
    {
        $back_page = '/'.$arResult->PAGE_NUM_BACK;
    }
    $back = BACK_IMG.' '.'<a href="/'.$arResult->ACTION.$back_page.'" >весь список работ</a>';
    return $back;
}
//...........................LINKS SEARCH...................//
function getSearch_link($highlight, $link, $title, $menu_eng, $submenu_eng, $all_eng)
{

    $html = '';
    if($menu_eng == 'services'){
        $link = 'http://'.$_SERVER["SERVER_NAME"].'/';
    }else{
        $link = 'http://'.$_SERVER["SERVER_NAME"].$link;
    }


	if($submenu_eng == '' && $all_eng == '')
    {
        $title = preg_replace("/(".$highlight.")/i", "<span class='hilight'>$0</span>", $title);
        $html.= '<a href="'.$link.$menu_eng.'" class="bluelink" target="_blank">'.$title.'</a><br />'."\n";
        $html.= '<a href="'.$link.$menu_eng.'" '.STYLE5.' target="_blank">'.$link.$menu_eng.'</a><br /><br />'."\n";
    }
    elseif($submenu_eng != '' && $all_eng == '')
    {
        $title = preg_replace("/(".$highlight.")/i", "<span class='hilight'>$0</span>", $title);
        $html.= '<a href="'.$link.$menu_eng.'/'.$submenu_eng.'" class="bluelink" target="_blank">'.$title.'</a><br />'."\n";
        $html.= '<a href="'.$link.$menu_eng.'/'.$submenu_eng.'" '.STYLE5.' target="_blank">'.$link.$menu_eng.'/'.$submenu_eng.'</a><br /><br />'."\n";
    }
    elseif($menu_eng !='' && $submenu_eng != '' && $all_eng != '')
    {
        $title = preg_replace("/(".$highlight.")/i", "<span class='hilight'>$0</span>", $title);
        $html.= '<a href="'.$link.$menu_eng.'/'.$submenu_eng.'/'.$all_eng.'" class="bluelink" target="_blank">'.$title.'</a><br />'."\n";
        $html.= '<a href="'.$link.$menu_eng.'/'.$submenu_eng.'/'.$all_eng.'" '.STYLE5.' target="_blank">'.$link.$menu_eng.'/'.$submenu_eng.'/'.$all_eng.'</a><br /><br />'."\n";
    }

	return $html;
}
//...........................SEARCH..........................................//
function getSearch(){
    $mysqli = M_Core_DB::getInstance();
    $html = $like = $like1 = $like2 = $like3 = $num_submenu = $num_menu = $num_all = $num_desc = '';

    $search_word = $_POST['search_word'];
    $search_word = substr($search_word, 0, 64);
    $search_word = preg_replace("/[^\w\x7F-\xFF\s]/", " ", $search_word);
    $search_word = trim(preg_replace("/\s(\S{1,2})\s/", " ", preg_replace("/[ ]+/", "  "," $search_word ")));
    $search_word = preg_replace("/[ ]+/", " ", $search_word);
    $search_word = strtolower($search_word);
    $length = strlen($search_word);
    if($length == 3){
        $like  = "OR ".CATALOG_ALL.".title LIKE '%".$search_word."%' OR ".CATALOG_ALL.".content LIKE '%".$search_word."%'";
        $like1 = "OR ".CATALOG_SUBMENU.".title LIKE '%".$search_word."%' OR ".CATALOG_SUBMENU.".eng LIKE '%".$search_word."%'";
        $like2 = "OR ".CATALOG_MENU.".title LIKE '%".$search_word."%' OR ".CATALOG_MENU.".eng LIKE '%".$search_word."%'";
        $like3 = "OR ".DESC.".title LIKE '%".$search_word."%'";
    }
    $highlight = str_replace(" ", "|", $search_word);
    if($search_word !='')
    {
        $query = "SELECT ".DESC.".title, ".CATALOG_ALL.".eng AS all_eng, ".CATALOG_SUBMENU.".eng AS submenu_eng, ".CATALOG_MENU.".eng AS menu_eng FROM ".DESC."
	          INNER JOIN ".CATALOG_ALL." ON ".DESC.".all_id = ".CATALOG_ALL.".id
			  INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_ALL.".submenu_id = ".CATALOG_SUBMENU.".id
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE MATCH(".DESC.".title) AGAINST('".$search_word."' IN BOOLEAN MODE) ".$like3;

        $desc = $mysqli->queryQ($query);
        $row_desc = $mysqli->fetchAssoc($desc);
        if($row_desc == 0){
            $query = "SELECT ".DESC.".title, ".CATALOG_ALL.".eng AS all_eng, ".CATALOG_SUBMENU.".eng AS submenu_eng, ".CATALOG_MENU.".eng AS menu_eng FROM ".DESC."
	          INNER JOIN ".CATALOG_ALL." ON ".DESC.".all_id = ".CATALOG_ALL.".id
			  INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_ALL.".submenu_id = ".CATALOG_SUBMENU.".id
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE ".DESC.".title LIKE '%".$search_word."%'";
            $desc = $mysqli->queryQ($query);
            $row_desc = $mysqli->fetchAssoc($desc);
        }
        $query = "SELECT ".CATALOG_ALL.".title, ".CATALOG_ALL.".eng AS all_eng, ".CATALOG_SUBMENU.".eng AS submenu_eng, ".CATALOG_MENU.".eng AS menu_eng FROM ".CATALOG_ALL."
			  INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_ALL.".submenu_id = ".CATALOG_SUBMENU.".id
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE MATCH(".CATALOG_ALL.".title, ".CATALOG_ALL.".content, ".CATALOG_ALL.".eng) AGAINST('".$search_word."' IN BOOLEAN MODE) ".$like."
			  AND ".CATALOG_SUBMENU.".eng NOT LIKE 'default%'
			  AND ".CATALOG_ALL.".eng NOT LIKE 'default%'";
        $all = $mysqli->queryQ($query);
        $row_all = $mysqli->fetchAssoc($all);
        if($row_all == 0)
        {
            $query = "SELECT ".CATALOG_ALL.".title, ".CATALOG_ALL.".eng AS all_eng, ".CATALOG_SUBMENU.".eng AS submenu_eng, ".CATALOG_MENU.".eng AS menu_eng FROM ".CATALOG_ALL."
			  INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_ALL.".submenu_id = ".CATALOG_SUBMENU.".id
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE ".CATALOG_ALL.".title LIKE '%".$search_word."%' OR ".CATALOG_ALL.".content LIKE '%".$search_word."%'
              AND ".CATALOG_SUBMENU.".eng NOT LIKE 'default%'
			  AND ".CATALOG_ALL.".eng NOT LIKE 'default%'";
            $all = $mysqli->queryQ($query);
            $row_all = $mysqli->fetchAssoc($all);
        }

        $query = "SELECT ".CATALOG_SUBMENU.".title, ".CATALOG_SUBMENU.".eng AS submenu_eng, ".CATALOG_MENU.".eng AS menu_eng FROM ".CATALOG_SUBMENU."
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE MATCH(".CATALOG_SUBMENU.".title, ".CATALOG_SUBMENU.".eng) AGAINST('".$search_word."' IN BOOLEAN MODE) ".$like1."
			  AND ".CATALOG_SUBMENU.".eng NOT LIKE 'default%'";
        $submenu = $mysqli->queryQ($query);
        $row_submenu = $mysqli->fetchAssoc($submenu);
        if($row_submenu == 0)
        {
            $query = "SELECT ".CATALOG_SUBMENU.".title, ".CATALOG_SUBMENU.".eng AS submenu_eng, ".CATALOG_MENU.".eng AS menu_eng FROM ".CATALOG_SUBMENU."
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE ".CATALOG_SUBMENU.".title LIKE '%".$search_word."%' OR ".CATALOG_SUBMENU.".eng LIKE '%".$search_word."%'
			  AND ".CATALOG_SUBMENU.".eng NOT LIKE 'default%'";
            $submenu = $mysqli->queryQ($query);
            $row_submenu = $mysqli->fetchAssoc($submenu);
        }
        $query = "SELECT ".CATALOG_MENU.".title, ".CATALOG_MENU.".eng AS menu_eng FROM ".CATALOG_MENU."
			  WHERE ".CATALOG_MENU.".id !=5 AND
			  MATCH(title, eng) AGAINST('".$search_word."' IN BOOLEAN MODE) ".$like2;
        $menu = $mysqli->queryQ($query);
        $row_menu = $mysqli->fetchAssoc($menu);
        if($row_menu == 0)
        {
            $query = "SELECT ".CATALOG_MENU.".title, ".CATALOG_MENU.".eng AS menu_eng FROM ".CATALOG_MENU."
		          WHERE ".CATALOG_MENU.".id !=5 AND
			      ".CATALOG_MENU.".title LIKE '%".$search_word."%' OR ".CATALOG_MENU.".eng LIKE '%".$search_word."%'";
            $menu = $mysqli->queryQ($query);
            $row_menu = $mysqli->fetchAssoc($menu);
        }
        $link = '/catalog/';

        if($row_menu !=0 || $row_submenu !=0 || $row_all !=0 || $row_desc !=0)
        {
            $i=1;
            if($row_menu !=0 )
            {
                $num_menu =$mysqli->num_r($menu);
                do
                {
                    $html.= '<span>'.$i.'.</span> '.getSearch_link($highlight, $link, $row_menu['title'], $row_menu['menu_eng'], '', '')."\n";

                }while($row_menu = $mysqli->fetchAssoc($menu));
            }
            if($row_submenu !=0){
                //echo '<pre>'; print_r($row_submenu['menu_eng']); echo '</pre>';
                $num_submenu = $mysqli->num_r($submenu);
                do
                {
                    $html.= '<span>'.$i.'.</span> '.getSearch_link($highlight, $link, $row_submenu['title'], $row_submenu['menu_eng'], $row_submenu['submenu_eng'], '')."\n";
                    $i++;
                }while($row_submenu = $mysqli->fetchAssoc($submenu));
            }
            if($row_all !=0)
            {
                $num_all = $mysqli->num_r($all);
                do
                {
                    $html.= '<span>'.$i.'.</span> '.getSearch_link($highlight, $link, $row_all['title'], $row_all['menu_eng'], $row_all['submenu_eng'], $row_all['all_eng'])."\n";
                    $i++;
                }while($row_all = $mysqli->fetchAssoc($all));
            }
            if($row_desc !=0)
            {
                $num_desc = $mysqli->num_r($desc);
                do
                {
                    $html.= '<span>'.$i.'.</span> '.getSearch_link($highlight, $link, $row_desc['title'], $row_desc['menu_eng'], $row_desc['submenu_eng'], $row_desc['all_eng'])."\n";
                    $i++;
                }while($row_desc = $mysqli->fetchAssoc($desc));
            }
        }
        else
        {
            $html.='По Вашему запросу ничего не найдено';
        }
    }
    else
    {
        $html = 'Введите поисковое слово или фразу';
    }
    $num_total = $num_menu + $num_submenu + $num_all + $num_desc;
    $kon = endWord($num_total);
    $str = '<div ><span class="dotted"><span class="style1">'.$search_word.'</span></span><br />Найдено <span class="style1">'.$num_total.'</span> строк'.$kon.'</div><br />'."\n";
    $html = $str.$html;
    return $html;
}
function endWord($count){
    $num = $count%10;
    $string = (string)$count;
    if (strlen($count) == 2 && $string{0} == 1)
    {
        $str = '';
    }
    else
    {
        switch($num)
        {
            case 1: $str = 'а';
                break;
            case 2:
            case 3:
            case 4: $str = 'и';
                break;

            default: $str = '';
        }
    }
    return $str;
}
function raschet_moshchnosti_oborudovaniya(){
    $mysqli = M_Core_DB::getInstance();
    global $arResult;
    $html = '';
    if($arResult->ACTION!=''){
        $action = $arResult->ACTION;
    }
    if($arResult->POS1 == ''){
        $query = sprintf("SELECT content FROM ".NAVIGATOR." WHERE eng LIKE '%s'", $action);
        $mysqli->_execute($query);
        $row = $mysqli->fetch();

        $html = print_page($row['content']);
        $html.= '<div class="col-sm-12 a-power"><a href="/raschet-moshchnosti-oborudovaniya/condicioner" class="text-primary small-caps">расчет мощности кондиционера</a></div>';
        $html.= '<div class="col-sm-12 a-power"><a href="/raschet-moshchnosti-oborudovaniya/teplovie-pushki" class="text-primary small-caps">расчет мощности тепловой пушки</a></div>';
    }
    else{
        $pos1 = $arResult->POS1;

        if($pos1 == 'condicioner'){
            $html = calc_cond();
        }
        elseif($arResult->POS1 == 'teplovie-pushki'){
            $html = calc_pushki();
        }
        else{
            error404(SAPI_NAME, REQUEST_URL);
        }

    }
    return $html;
}
function calc_cond()
{
    global $smarty;
    /*.....conditioner.............*/
    $title   = 'Расчет мощности кондиционера';
    $footer_txt = 'Ознакомиться с ценами на кодиционеры вы можете перейдя по данной ссылке: <a href="/catalog/konditsionery" class="text-primary small-caps">кондиционеры</a>';
    $content = $smarty->fetch('inner-tpl/calc/calc-cond.tpl');
    $smarty->assign('title', $title);
    $smarty->assign('content', $content);
    $smarty->assign('footer_txt', $footer_txt);
    $html = $smarty->fetch('inner-tpl/calc/calc-power.tpl');
    return $html;
}
function calc_pushki()
{
    global $smarty;
    /*.....teplo...................*/
    $title = 'Расчет мощности тепловой пушки';
    $footer_txt = 'Ознакомиться с ценами на тепловые пушки вы можете перейдя по данной ссылке: <a href="/catalog/teplovoye-oborudovaniye/teplovyye-pushki" class="text-primary small-caps">тепловые пушки</a>';
    $content = $smarty->fetch('inner-tpl/calc/calc-teplo.tpl');
    $smarty->assign('title', $title);
    $smarty->assign('content', $content);
    $smarty->assign('footer_txt', $footer_txt);
    $html = $smarty->fetch('inner-tpl/calc/calc-power.tpl');
    return $html;
}
/**  Функция убирает пробелы, экранирует ковычки...........................................
 * Возвращает безопасное значение, с удаленным html и php кодом
* @param string $in_Val - исходное значение
* @param int $trim_Val - если больше 0, то оставляет только указанное количество символов
* @param bool $u_Case - если true, то возвращает заглавные буквы
* @param bool $trim_symbols - если true, то возвращает только цифры до первой буквы
* @return string
*/
function GetFormValue($in_Val, $trim_Val = 0, $u_Case = false, $trim_symbols=false) {
    $ret = trim(addslashes(htmlspecialchars(strip_tags($in_Val))));
    if ($trim_Val)
        $ret = substr($ret, 0, $trim_Val);
    if ($u_Case)
        $ret = strtoupper($ret);

    if ($trim_symbols) {
        $my_len = strlen($ret);
        for ($pos = 0; $pos<$my_len;$pos++) {
            if (!is_numeric(substr($ret,$pos,1))) {
                $ret = substr($ret,0,$pos);
                break;
            }
        }
    }
    return $ret;
}
/*....................Количество юзеров on-line......................*/
function OnlineUsers(){
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

    $d = count($data_array);
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

    $writedata = fopen($data,"w") or die("Не могу открыть файл $data");
    flock($writedata,2);
    if(sizeof($online_array) == 0){
        $online_array[]="$user::$time\r\n";
    }
    else{
        //print_r(sizeof($online_array));
    }
    foreach($online_array as $str)
        fputs($writedata,"$str");
    flock($writedata,3);
    fclose($writedata);

    $readdata=fopen($data,"r") or die("Не могу открыть файл $data");
    $data_array=file($data);
    fclose($readdata);
    $online=count($data_array);

}
//автологин
function autoLogin(){
    $mysqli = M_Core_DB::getInstance();//echo '<pre>';print_r($_COOKIE);echo '</pre>';
    $login    = $_COOKIE['name'];
    $password = $_COOKIE['password'];
    $login    = $login.SALT_LOG;
    $password = $password.SALT_PAS;
    // Выполняем запрос на получение данных пользователя из БД
    $query = "SELECT *, UNIX_TIMESTAMP(last_visit) as unix_last_visit
            FROM ".TABLE_ADMIN_USERS."
            WHERE login='".md5($login )."'
			AND password='".md5( $password )."'
			LIMIT 1";
    $mysqli->_execute($query);
    // Если пользователь с таким логином и паролем не найден -
    // значит данные неверные и надо их удалить
    if ( $mysqli->num_rows() == 0 ) {
        $tmppos = strrpos( $_SERVER['SERVER_NAME'], '/' ) + 1;
        $path = substr( $_SERVER['SERVER_NAME'], 0, $tmppos );
        setcookie( 'autologin', '', time() - 1, $path );
        setcookie( 'name', '', time() - 1, $path );
        setcookie( 'password', '', time() - 1, $path );
        setcookie( 'group', '', time() - 1, $path );
        return false;
    }
    $user = $mysqli->fetch();
    $_SESSION['MM_Username'] = $user;//echo '<pre>';print_r( $_SESSION['MM_Username']);echo '</pre>';
    $query = "SELECT * FROM ".TABLE_ADMIN_USERS."
	        WHERE id=".$_SESSION['MM_Username']['id'] ;
    $mysqli->_execute($query);
    $res1 = $mysqli->fetch();

    $_SESSION['last_visit'] = $res1;

    $query = "UPDATE ".TABLE_ADMIN_USERS."
	        SET last_visit=NOW()
			WHERE id=".$_SESSION['MM_Username']['id'];
    $mysqli->query($query);
    $_SESSION['once'] = $res1;
    return true;
}
//.................проверка существования файла..................//
function FindFileStuct($file_name, $path){

    $str_dir_path = $_SERVER["DOCUMENT_ROOT"].$path;
    $str_dir = opendir($str_dir_path);
    $i = 0;
    $str_files = null;
    while (($str_file = readdir($str_dir)) !==false)
    {
        if (($str_file != ".") && ($str_file != ".."))
        {
            $str_files[$i] = basename($str_file);
            $i++;
        }
    }
    closedir($str_dir);
    $str_files_count = count($str_files);
    if ($str_files_count)
    {
        sort($str_files);
        for ($i = 0; $i < $str_files_count; $i++)
        {
            if($str_files[$i] == $file_name)
            {
                return 1;
            }
        }
    }
    return 0;
}


