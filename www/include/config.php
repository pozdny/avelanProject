<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 22.09.14
 * Time: 16:46
 */
//cache
header("Cache-Control: public");
header("Expires: " . date("r", time() + 3600));
$actions = array(
    'MainPage',
    'about',
    'oplata',
    'catalog',
    'contacts',
    'price',
    'services',
    'result_search',
    'nashi_raboty',
    'raschet-moshchnosti-oborudovaniya',
    'admin-panel'
);
$admin_actions = array(
    'MainPage',
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
    'logout',
    'get_edit_submenu',
    'get_edit_all',
    'get_edit_prices',
    'edit_catalog',
    'get_edit_images',
    'get_edit_prices',
    'edit_content',
    'edit_services',
    'edit_nashi_raboty',
    'edit_metatags',
    'edit_metatags_other',
    'get_edit_nashi_raboty',
    'edit_table',

);

$arrayBreadCrumbs = array(
    'catalog',
    'services',
    'nashi_raboty',
    'raschet-moshchnosti-oborudovaniya'
);
if (!defined("SMARTY_DIR")) define('SMARTY_DIR', 'libs/');
define('DEFAULT_PAGE', 'MainPage');
define ( 'HOME_URL', "http://".$_SERVER['SERVER_NAME'] );
define ( 'HOST_NAME', $_SERVER['SERVER_NAME'] );
define ( 'ADMIN_PANEL', '/admin' );
//table names
define ( 'TABLE_USERS',       'users' );
define ( 'TABLE_ADMIN_USERS', 'admin_users' );
define ( 'NAVIGATOR',         'content' );
define ( 'CATALOG_MENU',      'catalog_menu' );
define ( 'CATALOG_SUBMENU',   'catalog_submenu' );
define ( 'CATALOG_ALL',       'catalog_all' );
define ( 'DESC',              'description' );
define ( 'CALCULATE',         'calc' );
define ( 'TABLE_IMAGES',      'images' );
define ( 'IMAGES_SERV',       'images_services' );
define ( 'SERVICES',          'services' );
define ( 'ADMIN_CAT_M',       'admin_catalog_menu' );
define ( 'ADMIN_ACTIONS',     'admin_actions' );
define ( 'ADMIN_PROC',        'admin_proc' );
define ( 'ADMIN_PROC_M',      'proc' );
define ( 'TABLE_INFO',        'info_site' );
define ( 'SHADULE',           'shadule' );
define ( 'SCHET',             'schet' );
define ( 'VENT',              'p_vent' );
define ( 'COND',              'p_cond' );
define ( 'TEPLO',             'p_teplo' );
define ( 'RABOTY',            'nashi_raboty' );
define ( 'RABOTY_IMG',        'images_raboty' );
define ( 'RESP_CAT',          'response_category' );
define ( 'RESP_TXT',          'response' );
define ( 'MANUF',             'manuf' );
define ( 'OPTIONS',           'g_options' );
// style
define ( 'STYLE1', 'class="style1"' );
define ( 'STYLE2', 'class="style2"' );
define ( 'STYLE3', 'class="style3"' );
define ( 'STYLE4', 'class="style4"' );
define ( 'STYLE5', 'class="style5"' );
define ( 'STYLE6', 'class="style6"' );
define ( 'STYLE7', 'class="style7"' );
define ( 'STYLE8', 'class="style8"' );
define ( 'STYLE9', 'class="style9"' );
define ( 'STYLE10', 'class="style10"' );
define ( 'STYLE11', 'class="style11"' );
define ( 'STYLE12', 'class="style12"' );
define ( 'STYLE13', 'class="style13"' );
define ( 'STYLE14', 'class="style14"' );
define ( 'STYLE15', 'class="style15"' );
define ( 'STYLE16', 'class="style16"' );
define ( 'DOTTED', 'class="dotted"' );
//img
define ( 'PATH_IMG', '/img/' );
define ( 'PATH_IMG_GLOB', 'img/catalog/' );
define ( 'PATH_IMG_SMALL', 'img/catalog/small/' );
define ( 'PATH_IMG_R', 'img/'.RABOTY.'/' );
define ( 'PATH_IMG_SMALLR', 'img/nashi_raboty/small/' );
define ( 'PATH_IMG_BIGR', 'img/nashi_raboty/big/' );
define ( 'PATH_IMG_SERVICES', 'img/services/' );
define ( 'PATH_IMG_SERV_GLOB', 'img/services/catalog/' );
define ( 'PATH_IMG_SERV_SMALL', 'img/services/small/' );
// redirect
define ( 'REDIRECT_DELAY', 2 );
define ( 'REDIRECT_DELAY2', 0 );
//different
define ( 'REQUEST_URL', $_SERVER['REQUEST_URI'] );
define ( 'SAPI_NAME', php_sapi_name());
define ( 'BACK_IMG', '<i class="fa fa-caret-left"></i>');
define ( 'TOP_IMG', '<i class="fa fa-caret-up" title="вверх"></i>');
define ( 'SAVE_CODE', 'sfaj9a0jladqbmo');
define ( 'COOKIE_TIME', 30 );
define ( 'FIRST_PAGE', 'products' );
define ( 'EDIT_IMG', '<img src="/img/icons/edit_full.png" title="полное редактирование" />');
define ( 'EDIT_IMG_K', '<img src="/img/icons/edit_key.png" title="изменить метатеги" />');
define ( 'EDIT_IMG_Q', '<img src="/img/icons/edit_title.png" title="быстро изменить название позиции по-русски" />');
define ( 'DEL_IMG', '<img src="/img/icons/delete.png" title="удалить" />');
define ( 'EDIT_IMG_SITE', '<i class="fa fa-edit fa-2x" title="редактирование" ></i>');
define ( 'NODATA', 'Нет данных');
// Максимальный размер файла вложения в мегабайтах (2мб)
define ( 'MAX_FILE_SIZE', 2048000 );
//путь для загрузки файлов
define ( 'PATH_EXCEL', $_SERVER["DOCUMENT_ROOT"].'/files/prices/' );
define ( 'PATH_EXCEL_LOC', $_SERVER["DOCUMENT_ROOT"].'/' );
// solt login, password
define ( 'SALT_LOG', 'gu&@' );
define ( 'SALT_PAS', '7J9$' );
// rights
define ( 'ALL_R', 'a,m' );
define ( 'A_R', 'a' );
define ( 'M_R', 'm' );