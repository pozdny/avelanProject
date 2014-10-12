<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 12.10.14
 * Time: 20:08
 */
// вид добавления позиций внизу таблицы
function view_add_menu()
{
    global $smarty;
    $action = $_GET['action'];
    if($action == 'products')
    {
        $position = 'категорию';
        $title    = 'название категории';
        $get_action   = ADMIN_PANEL.'/add_menu';
        $table    = CATALOG_MENU;
    }
    elseif($action == TABLE_ADMIN_USERS)
    {
        $position = 'оператора';
        $title = 'Ф.И.О. оператора';
        $get_action = ADMIN_PANEL.'/add_position';
        $table    = TABLE_ADMIN_USERS;
    }
    elseif($action == SERVICES)
    {
        $position = 'услугу';
        $title = 'название услуги';
        $get_action = ADMIN_PANEL.'/add_position';
        $table    = SERVICES;
    }
    elseif($action == RABOTY)
    {
        $position = 'работу';
        $title = 'название работы';
        $get_action = ADMIN_PANEL.'/add_position';
        $table    = RABOTY;
    }
    else
    {
        $position = 'категорию';
        $title    = 'название категории';
        $get_action   = ADMIN_PANEL.'/add_menu';
        $table    = CATALOG_MENU;
    }

    $smarty->assign('action', $action);
    $smarty->assign('position', $position);
    $smarty->assign('title', $title);
    $smarty->assign('table', $table);
    $html = $smarty->fetch('inner-tpl/product/form-add-menu.tpl');
    return $html;
}