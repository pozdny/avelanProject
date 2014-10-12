<?php
if (!isset($_SESSION)) {
    session_start();
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

if  ($arResult->UsernameEnter["enter"] == "Y" && !isset($_SESSION['once']) && isset( $_COOKIE['autologin'] ) ) autoLogin();
OnlineUsers();

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
$actions = array( 'MainPage',
				  'pages', 
				  'products',
				  'services',
				  'nashi_raboty',
				  'prices',
				  'manufacturer',
				  'info_site',
				  'admin_users',
				  'schet',
				  'online',
				  'response',
				  'edit_content', 
				  'get_edit_content', 
				  'edit_metatags', 
				  'get_edit_metatags', 
				  'edit_metatags_other',
				  'get_edit_metatags_other',
				  'add_menu',
				  'edit_menu',
				  'get_edit_menu',
				  'edit_description',
				  'get_edit_description',
				  'add_position',
				  'edit_table',
				  'get_edit_manuf',
				  'get_edit_tab',
				  'loginForm',
				  'logout', 
				  'edit_order',
				  'send_order',
				  'get_edit_prices'
				  );

//$browser_ver = browser_ver();
//$head = admin_head();
//$CONTENT_columns = 'CONTENT_big';
//$footer = '<div id="footer">'.footer().'</div>';
//$link = admin_header_link();
//$kroshki = admin_kroshki();
//$title_main = admin_title_main();

//$privet = privet();

$action = $arResult->ACTION;
$smarty->assign('header', admin_head());
$smarty->assign('footer', footer());
$smarty->assign('left', left());
switch($action)
{
		case 'products':
			$left = '';
            $smarty->assign('content', products(ALL_R));
			break;
        case 'logout':
            $left = '';
            $smarty->assign('content', logout());
        break;
		default:
			$left = '';
            $smarty->assign('content', products(ALL_R));
			
}


//display main tamplate
$smarty->display('main.tpl');

//functions
function products($r)
{
    //access();
    access_rights($r);
    unset($_SESSION['menu']);

    //страницы категорий, подкатегорий и товара
    $html = admin_product();
    return $html;
}
