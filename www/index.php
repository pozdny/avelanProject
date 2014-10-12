<?php
if (!isset($_SESSION)){
    session_start();
}
// configs
require_once 'include/config.php';
// BD
require_once('connection/DBClass.php');
// Smarty
require_once 'libs/Smarty.class.php';
$smarty = new Smarty();
require_once 'libs/setup.php';
require_once 'include/include.php';
$arResult = getArResult(); //echo '<pre>'; print_r($arResult); echo '</pre>';
if ( $arResult->ACTION == '' ) $arResult->ACTION = 'MainPage';
// error404
if ( !in_array( $arResult->ACTION, $actions ) || ($arResult->ACTION == 'admin-panel' && $arResult->save_code !=SAVE_CODE) || $arResult->WRONGDATA){
    error404(SAPI_NAME, REQUEST_URL);
    return;
}
if(isset($arResult->UsernameEnter["enter"]) &&  $arResult->UsernameEnter["enter"] != "Y" && !isset($_SESSION['once']) && isset( $_COOKIE['autologin'] ) ) autoLogin();
// main template
$smarty->assign('header', head());
$smarty->assign('arResult', $arResult);
$smarty->assign('navbar', navigator());
$smarty->assign('title_main', title_main());
$smarty->assign('bread_crumbs', bread_crumbs($arrayBreadCrumbs));
$smarty->assign('footer', footer());
$smarty->assign('response', '');
$smarty->assign('calc', $smarty->fetch('inner-tpl/forms/calculator/calc.tpl'));
$smarty->assign('backcall', $smarty->fetch('inner-tpl/forms/backcall/backcall.tpl'));
switch ($arResult->ACTION)
{
    case 'MainPage':
        $smarty->assign('content', MainPage());
        break;
    case 'about':
    case 'oplata':
    case 'price':
    case 'contacts':
    case 'result_search':
        $smarty->assign('content', static_page());
        $smarty->assign('bread_crumbs', '');
        break;
    case 'catalog':
        $smarty->assign('content', catalog());
        $smarty->assign('catalog_menu', catalog_menu());
        break;
    case 'services':
        $smarty->assign('content', services());
        $smarty->assign('left_menu', left_menu());
        break;
    case 'nashi_raboty':
        $smarty->assign('content', nashi_raboty());
        $smarty->assign('left_menu', left_menu());
        break;
    case 'raschet-moshchnosti-oborudovaniya':
        $smarty->assign('content', raschet_moshchnosti_oborudovaniya());
        break;
    case 'admin-panel':
        $smarty->assign('login_form', getAdminPanel());
        $smarty->assign('content', '');
        $smarty->assign('bread_crumbs', '');
        break;
    default:
        $arResult->ACTION = "MainPage";
        $smarty->assign('action', $arResult->ACTION);
        $smarty->assign('content', MainPage());
}
//display main temlate
$smarty->display('main.tpl');

function MainPage()
{
    global $smarty;
    $mysqli = M_Core_DB::getInstance();
    $id = 1;
    $query = sprintf("SELECT content FROM ".NAVIGATOR." WHERE id=%s", $id);
    //$k = mysql_query($query) or die(mysql_error());
    //$row_k = mysql_fetch_assoc($k);
    $mysqli->_execute($query);
    $row = $mysqli->fetch();
    $content = $row["content"];
    //.......TAB-VIEW
    $query = 'SELECT '.SERVICES.'.title, '.SERVICES.'.eng FROM '.SERVICES.'
	     	  ORDER BY '.SERVICES.'.id';
    $mysqli->_execute($query);
    $li_tab = '';
    $tab_pane = '';
    $active = "active";
    if($mysqli->num_rows() > 0){
        while($row = $mysqli->fetch()){
            $eng = $row["eng"];
            $title = $row["title"];
            $url = "/services/".$eng;
            $smarty->assign('active', $active);
            $smarty->assign('eng', $eng);
            $smarty->assign('url', $url);
            $smarty->assign('title', $title);
            $li_tab.= $smarty->fetch('inner-tpl/tab-view/li-tab.tpl');
            $tab_pane.= $smarty->fetch('inner-tpl/tab-view/tab-pane.tpl');
            $active = '';
        }
    }
    $smarty->assign('li_tab', $li_tab);
    $tab_view = $smarty->fetch('inner-tpl/tab-view/tab-view.tpl');
    $smarty->assign('tab_pane', $tab_pane);
    $tab_content = $smarty->fetch('inner-tpl/tab-view/tab-content.tpl');
    $smarty->assign('tab_view', $tab_view);
    $smarty->assign('tab_content', $tab_content);
    $main_tab_view = $smarty->fetch('inner-tpl/tab-view/main-tab-view.tpl');
    //................
    //.......CAROUSEL
    $query = "SELECT DISTINCT ".CATALOG_MENU.".id, ".CATALOG_MENU.".title, ".CATALOG_MENU.".eng FROM ".CATALOG_SUBMENU."
			  INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			  WHERE ".CATALOG_MENU.".id !=5
			  ORDER BY ".CATALOG_MENU.".id";
    $k = $mysqli->queryQ($query);
    $li_carousel = '';
    if($mysqli->num_r($k) > 0){
        while($row_k = $mysqli->fetchAssoc($k)){
            $title_carousel = $row_k["title"];
            $eng_carousel = $row_k["eng"];
            $query = 'SELECT  DISTINCT '.CATALOG_SUBMENU.'.id, '.CATALOG_SUBMENU.'.title, '.CATALOG_SUBMENU.'.eng FROM '.CATALOG_SUBMENU.'
					INNER JOIN '.CATALOG_MENU.' ON '.CATALOG_SUBMENU.'.menu_id = '.$row_k['id'].'
					WHERE '.CATALOG_SUBMENU.'.eng NOT LIKE "default%"
					ORDER BY '.CATALOG_SUBMENU.'.id ASC';
            $e = $mysqli->queryQ($query);
            if($mysqli->num_r($e) > 0){
                $subli_carousel = '';
                while($row_e = $mysqli->fetchAssoc($e)){
                    $subtitle_carousel = $row_e["title"];
                    $suburl_carousel = '/catalog/'.$row_k["eng"].'/'.$row_e["eng"];
                    $smarty->assign('subtitle_carousel', $subtitle_carousel);
                    $smarty->assign('suburl_carousel', $suburl_carousel);
                    $subli_carousel.= $smarty->fetch('inner-tpl/carousel/subli-carousel.tpl');
                }
            }
            $smarty->assign('title_carousel', $title_carousel);
            $smarty->assign('eng_carousel', $eng_carousel);
            $smarty->assign('subli_carousel', $subli_carousel);
            $li_carousel.= $smarty->fetch('inner-tpl/carousel/li-carousel.tpl');
        }
    }
    $smarty->assign('li_carousel', $li_carousel);
    $main_carousel = $smarty->fetch('inner-tpl/carousel/main-carousel.tpl');
    //................
    $smarty->assign('main_tab_view', $main_tab_view);
    $smarty->assign('content', $content);
    $smarty->assign('main_carousel', $main_carousel);
    $html = $smarty->fetch('inner-tpl/main-page.tpl');

    return $html;
}
function catalog()
{
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    $content_page = '';
    if($arResult->ACTION !=''){
        $action1 = $arResult->ACTION;
    }
    else{
        $action1 = DEFAULT_PAGE;
    }

    if($arResult->POS1 == '')
    {
        $query = sprintf("SELECT content FROM ".NAVIGATOR." WHERE eng LIKE '%s'", $action1);
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $content_page = print_page($row['content']);
    }
    elseif($arResult->POS1 !='' && $arResult->POS2 !='' && $arResult->POS3 == ''){
        $query = "SELECT content2
				FROM ".CATALOG_SUBMENU."
				WHERE ".CATALOG_SUBMENU.".eng LIKE '".$arResult->POS2."'";
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $content_page = catalog_pos2();
        if($row['content2'] !='')
        {
            $content_page.= print_page($row['content2']);
        }
    }
    elseif($arResult->POS1 !='' && $arResult->POS2 !='' && $arResult->POS3!= ''){

        $content_page = catalog_pos3();
    }
    elseif($arResult->POS1 !='' && $arResult->POS2 ==''){
        error404(SAPI_NAME, REQUEST_URL);
    }
    $smarty->assign('content', $content_page);
    $html = $smarty->fetch('inner-tpl/content-page.tpl');
    return $html;
}
function static_page()
{
    global $arResult;
    global $smarty;
    $mysqli = M_Core_DB::getInstance();
    $action = '';
    if($arResult->ACTION !='' && $arResult->POS1 !=''){
        error404(SAPI_NAME, REQUEST_URL);
    }
    elseif($arResult->ACTION !='' && $arResult->POS1 =='')
    {
        $action = $arResult->ACTION;
    }

    if($action == 'result_search') {
        $html = getSearch();
        return $html;
    }

    $query = sprintf("SELECT content FROM ".NAVIGATOR." WHERE eng LIKE '%s'", $action);
    $mysqli->_execute($query);
    $row = $mysqli->fetch();
    $content_page =print_page($row['content']);
    $smarty->assign('content', $content_page);
    $html = $smarty->fetch('inner-tpl/content-page.tpl');
    return $html;
}
function services(){
    global $smarty;
    global $arResult;
    $mysqli = M_Core_DB::getInstance();
    $content_page = '';

    if($arResult->ACTION !='')
    {
        $action = $arResult->ACTION;
    }

    $query = sprintf("SELECT id, title, titlepage, content, keywords, description FROM ".NAVIGATOR." WHERE eng LIKE '%s'", $action);
    $mysqli->_execute($query);
    $row = $mysqli->fetch();
    $content = $row['content'];

    if($arResult->POS1 !='')
    {
        $content_page =  catalog_services_pos1();
        $content_page.= catalog_services();
    }
    else
    {
        $query = sprintf("SELECT img_service FROM ".TABLE_INFO);
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        if($row > 0 && $row['img_service'] !='')
        {
            $img_service = $row['img_service'];
            $img = '<div id="img_services"><img src="/img/services/'.$img_service.'" alt="������"></div>';
        }
        $content_page = catalog_services();
        $content_page.= $img.print_page($content);
    }

    $smarty->assign('content', $content_page);
    $html = $smarty->fetch('inner-tpl/content-page.tpl');
    return $html;
}
function nashi_raboty(){
    global $arResult;
    $mysqli = M_Core_DB::getInstance();
    $html = '';
    if($arResult->POS1 == '')
    {
        $query = sprintf("SELECT content FROM ".NAVIGATOR." WHERE eng LIKE '%s'", $arResult->ACTION);
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        if($row['content'] !='')
        {
            $html = print_page($row['content']).'<br /><br />';
        }
        $html.= nashi_rabotyMain();
    }
    else
    {
        $html.= nashi_raboty_pos1();
    }
    return $html;
}
function getAdminPanel(){
    global $smarty;
    $html = $smarty->fetch('inner-tpl/forms/login/login.tpl');
    return $html;
}
