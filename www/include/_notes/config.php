<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 22.09.14
 * Time: 16:46
 */
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
    'raschet-moshchnosti-oborudovaniya'
);
$arrayBreadCrumbs = array(
    'catalog',
    'services',
    'nashi_raboty',
    'raschet-moshchnosti-oborudovaniya'
);
define('SMARTY_DIR', 'libs/');
define('DEFAULT_PAGE', 'MainPage');
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
// стили
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
//путь изображения
define ( 'PATH_IMG', '/img/' );
define ( 'PATH_IMG_GLOB', 'img/catalog/' );
define ( 'PATH_IMG_SMALL', 'img/catalog/small/' );
define ( 'PATH_IMG_R', '/img/'.RABOTY.'/' );
define ( 'PATH_IMG_SMALLR', 'img/nashi_raboty/small/' );
define ( 'PATH_IMG_BIGR', 'img/nashi_raboty/big/' );
define ( 'PATH_IMG_SERVICES', 'img/services/' );
define ( 'PATH_IMG_SERV_GLOB', 'img/services/catalog/' );
define ( 'PATH_IMG_SERV_SMALL', 'img/services/small/' );
// редирект на нужную страницу
define ( 'REDIRECT_DELAY', 2 );
define ( 'REDIRECT_DELAY2', 0 );
//разное
define ( 'REQUEST_URL', $_SERVER['REQUEST_URI'] );
define ( 'SAPI_NAME', php_sapi_name());
define ( 'BACK_IMG', '<i class="fa fa-caret-left"></i>');
