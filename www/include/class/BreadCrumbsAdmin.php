<?php
/**
 * Created by PhpStorm.
 * User: Валентина
 * Date: 12.03.14
 * Time: 15:13
 */

class BreadCrumbsAdmin {
    public $Content;
    public function __construct(){
        $this->getContent();
    }
    private  function getContent(){
        $mysqli = M_Core_DB::getInstance();
        global $arResult;
        global $Pages;
        global $Catalog;
        global $Services;
        global $Raboty;
        global $smarty;
        //echo '<pre>';print_r($Pages);echo '</pre>';
        $query = "SELECT ".ADMIN_CAT_M.".id, ".ADMIN_CAT_M.".title, ".ADMIN_CAT_M.".eng, ".ADMIN_PROC.".eng as action FROM ".ADMIN_CAT_M."
                      INNER JOIN ".ADMIN_PROC_M." ON ".ADMIN_PROC_M.".admin_menu_id = ".ADMIN_CAT_M.".id
                      INNER JOIN ".ADMIN_PROC." ON ".ADMIN_PROC_M.".proc_id = ".ADMIN_PROC.".id
                      WHERE ".ADMIN_CAT_M.".eng !='MainPage' AND ".ADMIN_CAT_M.".id !='14' ORDER BY ".ADMIN_CAT_M.".id ASC";
        $mysqli->_execute($query);
        while($row = $mysqli->fetch()){
            $arr_menu[] = $row;

        }
       // echo '<pre>';print_r($arr_menu);echo '</pre>';

        $action = $arResult->ACTION;
        $pos1 = $arResult->POS1;
        $pos2 = $arResult->POS2;
        $pos3 = $arResult->POS3;
        $pos4 = $arResult->POS4;
        $elem = $li = '';
        $active = ' class="active"';
        $link = ADMIN_PANEL;
        $li = '<li><a href="'.$link.'">Главная админ</a></li>';
        if($action !='' && $pos1 == ''){
            foreach($arr_menu as $key => $value){
                if($action == $value["eng"]){
                    $li.= '<li'.$active.'>'.$value["title"].'</li>';
                    break;
                }
            }
        }
        else{
            foreach($arr_menu as $key => $value){
                if($action == $value["action"] && $value["action"]!='edit_metatags_other'){
                    $title = $value["title"];
                    $li.= '<li><a href="'.$link.'/'.$value["eng"].'">'.$title.'</a></li>';
                    if($action == 'edit_table'){
                        $table = $pos2;
                        $id = $pos1;
                        $query = "SELECT * FROM ".$table."
                                  WHERE id= ".$id;
                        $mysqli->_execute($query);
                        $row = $mysqli->fetch();
                        if($table == TABLE_ADMIN_USERS){
                            $name = $row["name"];
                        }
                        else{
                            $name = $row["title"];
                        }
                        $li.= '<li'.$active.'>'.$name.'</li>';
                    }
                    elseif($action == 'edit_catalog'){
                        if($pos2 == 'menu'){
                            foreach($Catalog as $key=>$menu){
                                if($menu["eng"] == $pos1){
                                    $li.= '<li'.$active.'>'.$menu["title"].'</li>';
                                }
                            }
                        }
                        elseif($pos2 == 'submenu'){
                            $act = 'edit_catalog';
                            foreach($Catalog as $key=>$menu){
                                if($menu["eng"]==$pos1){
                                    $li.= '<li><a href="'.$link.'/'.$act.'/'.$pos1.'/menu">'.$menu["title"].'</a></li>';
                                }
                                if(isset($menu["Submenu"])){
                                    foreach($menu["Submenu"] as $key=>$submenu){
                                        if($submenu["eng"] == $pos3){
                                            $elem = $submenu["title"];
                                            $li.= '<li'.$active.'>'.$elem.'</li>';
                                        }
                                    }
                                }
                            }
                        }
                        elseif($pos2 == 'all'){
                            $act = 'edit_catalog';
                            foreach($Catalog as $key=>$menu){
                                if($menu["eng"]==$pos1){
                                    $li.= '<li><a href="'.$link.'/'.$act.'/'.$pos1.'/menu">'.$menu["title"].'</a></li>';
                                }
                                if(isset($menu["Submenu"])){
                                    foreach($menu["Submenu"] as $key2=>$submenu){
                                        if($submenu["eng"] == $pos3){
                                            $elem = $submenu["title"];
                                            $li.= '<li><a href="'.$link.'/'.$act.'/'.$pos1.'/submenu/'.$pos3.'">'.$elem.'</a></li>';
                                        }
                                        if(isset($submenu["All"])){
                                            foreach($submenu["All"] as $key3=>$all){
                                                if($all["eng"] == $pos4){
                                                    $elem = $all["title"];
                                                    $li.= '<li'.$active.'>'.$elem.'</li>';
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                        }

                    }
                    elseif($action == 'edit_services'){
                        foreach($Services as $key => $value){
                            if($pos1 == $value["id"]){
                                $li.= '<li'.$active.'>'.$value["title"].'</li>';
                            }
                        }
                    }
                    elseif($action == 'edit_nashi_raboty'){
                        foreach($Raboty as $key => $value){
                            if($pos1 == $value["id"]){
                                $li.= '<li'.$active.'>'.$value["title"].'</li>';
                            }
                        }
                    }
                    else{
                        foreach($Pages as $key => $value1){
                            if($value1["link"] == '')
                                $value1["link"] = 'MainPage';
                            if($pos1 == $value1["link"]){
                                $li.= '<li'.$active.'>'.$value1["title"].'</li>';
                            }
                        }
                    }

                }
                elseif($action == 'edit_metatags_other' && $value["action"] == $action && $value["eng"] == $pos2){
                    $li.= '<li><a href="'.$link.'/'.$pos2.'">'.$value["title"].'</a></li>';
                    if($pos2 == 'services'){
                        foreach($Services as $key => $services){
                            if($pos1 == $services["id"]){
                                $li.= '<li'.$active.'>'.$services["title"].'</li>';
                            }
                        }
                    }
                    elseif($pos2 == 'nashi_raboty'){
                        foreach($Raboty as $key => $raboty){
                            if($pos1 == $raboty["id"]){
                                $li.= '<li'.$active.'>'.$raboty["title"].'</li>';
                            }
                        }
                    }

                }
                elseif($action == $value["action"] && $value["action"] == 'edit_metatags_other' && $value["eng"] == 'products' && $pos2 !=RABOTY && $pos2 !=SERVICES){
                    $title = $value["title"];
                    $li.= '<li><a href="'.$link.'/'.$value["eng"].'">'.$title.'</a></li>';
                    if($pos2 == CATALOG_MENU){
                        foreach($Catalog as $key=>$menu){
                            if($menu["eng"] == $pos1){
                                $li.= '<li'.$active.'>'.$menu["title"].'</li>';
                            }
                        }
                    }
                    elseif($pos2 == CATALOG_SUBMENU){
                        $act = 'edit_catalog';
                        foreach($Catalog as $key=>$menu){
                            if($menu["eng"]==$pos1){
                                $li.= '<li><a href="'.$link.'/'.$act.'/'.$pos1.'/menu">'.$menu["title"].'</a></li>';
                            }
                            if(isset($menu["Submenu"])){
                                foreach($menu["Submenu"] as $key=>$submenu){
                                    if($submenu["eng"] == $pos3){
                                        $elem = $submenu["title"];
                                        $li.= '<li'.$active.'>'.$elem.'</li>';
                                    }
                                }
                            }
                        }
                    }
                    elseif($pos2 == CATALOG_ALL){
                        $act = 'edit_catalog';
                        foreach($Catalog as $key=>$menu){
                            if($menu["eng"]==$pos1){
                                $li.= '<li><a href="'.$link.'/'.$act.'/'.$pos1.'/menu">'.$menu["title"].'</a></li>';
                            }
                            if(isset($menu["Submenu"])){
                                foreach($menu["Submenu"] as $key2=>$submenu){
                                    if($submenu["eng"] == $pos3){
                                        $elem = $submenu["title"];
                                        $li.= '<li><a href="'.$link.'/'.$act.'/'.$pos1.'/submenu/'.$pos3.'">'.$elem.'</a></li>';
                                    }
                                    if(isset($submenu["All"])){
                                        foreach($submenu["All"] as $key3=>$all){
                                            if($all["eng"] == $pos4){
                                                $elem = $all["title"];
                                                $li.= '<li'.$active.'>'.$elem.'</li>';
                                            }
                                        }
                                    }

                                }
                            }
                        }
                    }
                }
                else{

                }
            }


        }



        $smarty->assign('li', $li);
        $html= $smarty->fetch('breadcrumb.tpl');
        $this->Content = $html;
    }
} 