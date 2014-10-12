<?php
if (!isset($_SESSION)) {
  session_start();
}
// подключаем основные настройки
define('SMARTY_ADMIN_DIR', 'admin_panel/libs/');
require_once 'include/config.php';
// Подключаем БД
require_once('connection/DBClass.php');
//Создадим объект класса Smarty
require_once 'libs/Smarty.class.php';
$smarty = new Smarty();
require_once 'admin_panel/libs/setup.php';
require_once 'include/include.php';
require_once 'include/functions_admin.php';
$arResult = getArResult(); //echo '<pre>'; print_r($arResult); echo '</pre>';

if  ($arResult->UsernameEnter["enter"] == "Y" && !isset($_SESSION['once']) && isset( $_COOKIE['autologin'] ) ) autoLogin();
OnlineUsers();

$titlepage = 'Админ.панель';
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
            $smarty->assign('content', '');
			break;
		default:
			$left = '';
            $smarty->assign('content', '');
			
}


//Выводим шаблон на экран
$smarty->display('main.tpl');

function left()
{
    global $arResult;
    global $smarty;
    if($arResult->ACTION!=''){
        $action = $arResult->ACTION;
    }

    $title_left = '<span class="title_leftMenu">МЕНЮ</span>';
    $title_menu = 'title_menu';
    $catalog_menu = catalog_menu(ALL_R);
    $catalog_class = 'left-menu';
    $html = file_get_contents( './templates/main_left.html' );
    $html = str_replace( '{title_menu}', $title_menu, $html );
    $html = str_replace( '{title_left}', $title_left, $html );
    $html = str_replace( '{content1}', $catalog_menu, $html );
    $html = str_replace( '{catalog_class}', $catalog_class, $html );
    return $html;
}