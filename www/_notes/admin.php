<?php
if (!isset($_SESSION)) {
    session_set_cookie_params (3600, '/');
    session_start();
    setcookie('PHPSESSID', session_id(), time()+3600, '/');
    $CookieInfo = session_get_cookie_params();
}

// configs
if (!defined("SMARTY_ADMIN_DIR"))  define('SMARTY_ADMIN_DIR', 'admin_panel/libs/');
require_once 'include/config.php';
// BD
require_once('connection/DBClass.php');
// Smarty
require_once 'libs/Smarty.class.php';
$smarty = new Smarty();
require_once 'admin_panel/libs/setup.php';
require_once 'include/include.php';
require_once 'include/include_admin.php';

$arResult = getArResult(); //echo '<pre>'; print_r($arResult); echo '</pre>';
$action = $arResult->ACTION;
if(($action !='admin' && !(isset($_SESSION['MM_Username']))) || $action == 'admin' && !(isset($_SESSION['MM_Username']))){
    if($action == 'products'){
        $req_url = '/admin';
    }
    else{
        $req_url = REQUEST_URL;
    }
    error404(SAPI_NAME, $req_url);
    return;
}
elseif(isset($arResult->WRONGDATA) && $arResult->WRONGDATA){
    error404(SAPI_NAME, REQUEST_URL);
    return;
}
elseif(isset($_SESSION['MM_Username']) && !in_array( $arResult->ACTION, $admin_actions )){
    error404(SAPI_NAME, REQUEST_URL);
    return;
}
else{
    if  ($arResult->UsernameEnter["enter"] == "Y" && !isset($_SESSION['once']) && isset( $_COOKIE['autologin'] ) ) autoLogin();
    OnlineUsers();
    $Pages = $arResult->DATA["TopMenu"];
    $Catalog = $arResult->DATA["Catalog"];
    $rights = '';
    if ($arResult->UsernameEnter["group"] !='')
    {
        $rights = $arResult->UsernameEnter["group"];
    }
    if ($arResult->ACTION =='')
    {
        if($rights == 'a')
        {
            $arResult->ACTION = FIRST_PAGE;
        }
        else
            $arResult->ACTION = FIRST_PAGE;
    }

    //$browser_ver = browser_ver();
    //$head = admin_head();
    //$CONTENT_columns = 'CONTENT_big';
    //$footer = '<div id="footer">'.footer().'</div>';
    //$link = admin_header_link();
    //$kroshki = admin_kroshki();
    //$title_main = admin_title_main();

    //$privet = privet();

    $smarty->assign('header', admin_head());
    $smarty->assign('footer', footer());
    $smarty->assign('left', left());
    $smarty->assign('titlepage', getTitle());
    $smarty->assign('breadcrumbs', getBreadCrumbs());
    switch($action){
        case 'pages':
            $smarty->assign('content', admin_main_page());
            break;
        case 'products':
            $smarty->assign('content', products(ALL_R));
            break;
        case 'logout':
            $smarty->assign('content', logout());
            break;
        case 'edit_catalog':
            $smarty->assign('content', edit_menu(ALL_R, $rights));
            break;
        case 'get_edit_submenu':
            $smarty->assign('content', get_edit_submenu());
            break;
        case 'get_edit_all':
            $smarty->assign('content', get_edit_all());
            break;
        case 'get_edit_images':
            $smarty->assign('content', get_edit_images());
            break;
        case 'prices':
            $smarty->assign('content', prices(ALL_R));
            break;
        case 'get_edit_prices':
            $smarty->assign('content', get_edit_prices());
            break;
        case 'edit_content':
            $smarty->assign('content', edit_content(ALL_R));
            break;
        default:
            $smarty->assign('content', products(ALL_R));
    }
    //display main tamplate
    $smarty->display('main.tpl');
}
//functions
function products($r){
    //access();
    access_rights($r);
    unset($_SESSION['menu']);

    //страницы категорий, подкатегорий и товара
    $html = admin_product();
    return $html;
}
function prices($r){
    access();
    access_rights($r);
    $html = admin_prices();
    return $html;
}
function getBreadCrumbs(){
    $bread_obj   = new BreadCrumbsAdmin();
    $breadcrumbs = $bread_obj->Content;
    return $breadcrumbs;
}

