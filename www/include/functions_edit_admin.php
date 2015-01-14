<?php
/**
 * Created by PhpStorm.
 * User: Valentina
 * Date: 12.10.14
 * Time: 20:08
 */
function edit_content($r){
    global $arResult;
    global $Pages; //echo '<pre>';print_r($Pages);echo '</pre>';
    global $smarty;
    access();
    access_rights($r);
    $tab = NAVIGATOR;
    $GoTo = ADMIN_PANEL.'/pages';
    $pos1 = $row = '';
    if($arResult->POS1 !=''){
        $pos1 = $arResult->POS1;
    }
    else{
        header("Location: ".$GoTo);
    }

    foreach($Pages as $key => $arr){
        if($arr["link"] == '') $arr['link'] = 'MainPage';
        if($arr["link"] == $pos1){
            $row = $arr;
        }
    }
    /*....................................table_redact............................................*/
    $name_content = 'content';
    $helpbox = 'helpbox';
    $i = '1';
    $addbbcode20 = '<select name="addbbcode20" onChange="bbfontstyle(\'[color=\' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + \']\', \'[/color]\', \''.$i.'\'); this.selectedIndex=0;" onMouseOver="helpline(\'s\', \''.$i.'\')" onMouseOut="helpline(\'h\', \''.$i.'\')">';
    $smarty->assign('content', $row["content"]);
    $smarty->assign('name_content', $name_content);
    $smarty->assign('helpbox', $helpbox);
    $smarty->assign('i', $i);
    $smarty->assign('addbbcode20', $addbbcode20);
    $table_redact = $smarty->fetch('inner-tpl/edit-product/tableRedact.tpl');
    ////.......................................................
    $zagolovok = htmlspecialchars ($row['zagolovok']);
    $title = '<a href="/'.$row['link'].'">'.$row['title'].'</a>';
    $back = '<a href="'.ADMIN_PANEL.'/pages" '.STYLE12.'>'.BACK_IMG.' назад</a>';

    $smarty->assign('back', $back);
    $smarty->assign('title', $title);
    $smarty->assign('zagolovok', $zagolovok);
    $smarty->assign('id', $row['id']);
    $smarty->assign('table_redact', $table_redact);
    $smarty->assign('table', $tab);
    $smarty->assign('link', $_SERVER['REQUEST_URI']);
    $html = $smarty->fetch('inner-tpl/content/editContent.tpl');

    return $html;
}
//.................titlepage, keywords, description главных страниц........................
function edit_metatags($r){
    access();
    access_rights($r);
    global $smarty;
    global $arResult;
    global $Pages;//echo '<pre>';print_r($Pages);echo '</pre>';
    $tab = NAVIGATOR;
    $row = array();
    $GoTo = ADMIN_PANEL.'/pages';
    if($arResult->POS1 !=''){
        $pos1 = $arResult->POS1;
    }
    else{
        header("Location: ".$GoTo);
    }

    foreach($Pages as $key => $arr){
        if($arr["link"] == '') $arr['link'] = 'MainPage';
        if($arr["link"] == $pos1){
            $row = $arr;
        }
    }
    $titlepage = htmlspecialchars ($row['titlepage']);
    $keywords = $row['keywords'];
    $description = $row['description'];
    $title = '<a href="/'.$row['link'].'">'.$row['title'].'</a>';
    $back = '<a href="'.ADMIN_PANEL.'/pages" '.STYLE12.'>'.BACK_IMG.' назад</a>';
    $id = $row["id"];
    $smarty->assign('legend', $title);
    $smarty->assign('titlepageM', $titlepage);
    $smarty->assign('keywords', $keywords);
    $smarty->assign('description', $description);
    $smarty->assign('id', $id);
    $smarty->assign('back', $back);
    $smarty->assign('table', $tab);
    $smarty->assign('link', $_SERVER['REQUEST_URI']);
    $html = $smarty->fetch('inner-tpl/editMetatags.tpl');

    return $html;
}
//.................titlepage, keywords, description страниц категорий товара........................
function edit_metatags_other($r){
    access();
    access_rights($r);
    global $arResult;
    global $smarty;
    $GoTo = ADMIN_PANEL;
    if($arResult->POS1 !='')
    {
        $pos1 = $arResult->POS1;
    }
    else
    {
        header("Location: ".$GoTo);
    }
    if($arResult->POS2 !='')
    {
        $tab = $arResult->POS2;
    }
    else
    {
        header("Location: ".$GoTo);
    }
    if($arResult->POS3 !='')
    {
        $pos3 = $arResult->POS3;
    }
    if($arResult->POS3 !='')
    {
        $pos4 = $arResult->POS4;
    }
    if($tab == SERVICES){
        global $Services;
        $b = SERVICES;
        foreach($Services as $key => $value){
            if($value["id"] == $pos1){
                $id = $value["id"];
                $title = '<a href="/'.$tab.'/'.$value["eng"].'" >'.$value["title"].'</a>';
                $titlepage   = $value["titlepage"];
                $keywords    = $value["keywords"];
                $description = $value["description"];
            }
        }
    }
    if($tab == RABOTY){
        global $Raboty;
        $b = RABOTY;
        foreach($Raboty as $key => $value){
            if($value["id"] == $pos1){
                $id = $value["id"];
                $title = '<a href="/'.$tab.'/'.$value["id"].'" >'.$value["title"].'</a>';
                $titlepage   = $value["titlepage"];
                $keywords    = $value["keywords"];
                $description = $value["description"];
            }
        }
    }
    else{
        global $Catalog;
        foreach($Catalog as $key => $value){
            if($tab == CATALOG_MENU){
                $b = $tab;
                if($value["eng"] == $pos1){
                    $id          = $value["id"];
                    $title       = '<a href="/catalog/'.$value["eng"].'" >'.$value["title"].'</a>';
                    $titlepage   = $value["titlepage"];
                    $keywords    = $value["keywords"];
                    $description = $value["description"];
                }
            }
            if($tab == CATALOG_SUBMENU){
                $b = $tab;
                foreach($Catalog as $key => $menu){
                    if($menu["eng"] == $pos1){
                        if(sizeof($menu["Submenu"]) > 0 && $menu["Submenu"] !=''){
                            foreach($menu["Submenu"] as $key1 => $submenu){
                                if($pos3 == $submenu["eng"]){
                                    $id          = $submenu["id"];
                                    $title  = '<a href="/catalog/'.$pos1.'/'.$submenu["eng"].'" >'.$submenu["title"].'</a>';
                                    $titlepage   = $submenu["titlepage"];
                                    $keywords    = $submenu["keywords"];
                                    $description = $submenu["description"];
                                }

                            }
                        }

                    }
                }
            }
            if($tab == CATALOG_ALL){
                $b = $tab;
                foreach($Catalog as $key => $menu){
                    if($menu["eng"] == $pos1){
                        if(sizeof($menu["Submenu"]) > 0 && $menu["Submenu"] !=''){
                            foreach($menu["Submenu"] as $key1 => $submenu){
                                if($pos3 == $submenu["eng"]){
                                    if(sizeof($submenu["All"]) > 0 && $submenu["All"] !=''){
                                        foreach($submenu["All"] as $key2 => $all){
                                            if($pos4 == $all["eng"]){
                                                $id          = $all["id"];
                                                $title  = '<a href="/catalog/'.$pos1.'/'.$submenu["eng"].'/'.$all["eng"].'" >'.$all["title"].'</a>';
                                                $titlepage   = $all["titlepage"];
                                                $keywords    = $all["keywords"];
                                                $description = $all["description"];
                                            }

                                        }

                                    }

                                }

                            }
                        }

                    }
                }
            }
        }
    }

    $back = '<a href="'.ADMIN_PANEL.'/'.$b.'" '.STYLE12.'>'.BACK_IMG.' назад</a>';
    $smarty->assign('legend', $title);
    $smarty->assign('titlepageM', $titlepage);
    $smarty->assign('keywords', $keywords);
    $smarty->assign('description', $description);
    $smarty->assign('id', $id);
    $smarty->assign('back', $back);
    $smarty->assign('table', $tab);
    $smarty->assign('link', $_SERVER['REQUEST_URI']);
    $html = $smarty->fetch('inner-tpl/editMetatags.tpl');
    return $html;
}

// вид добавления позиций внизу таблицы
function view_add_menu(){
    global $smarty;
    global $arResult;
    $tab = $arResult->ACTION;
    if($tab == TABLE_ADMIN_USERS){
        $position = 'оператора';
        $title = 'Ф.И.О. оператора';
        $get_action = ADMIN_PANEL.'/add_position';
        $table    = TABLE_ADMIN_USERS;
    }
    elseif($tab == SERVICES){
        $position = 'услугу';
        $title = 'название услуги';
        $get_action = ADMIN_PANEL.'/add_position';
        $table    = SERVICES;
    }
    elseif($tab == RABOTY){
        $position = 'работу';
        $title = 'название работы';
        $get_action = ADMIN_PANEL.'/add_position';
        $table    = RABOTY;
    }
    else{
        $position = 'работу';
        $title = 'название работы';
        $get_action = ADMIN_PANEL.'/add_position';
        $table    = RABOTY;
    }
    $link_url = $_SERVER['REQUEST_URI'];
    $link = '<input name="link" type="hidden" value="'.$link_url.'">';
    $smarty->assign('action', $tab);
    $smarty->assign('position', $position);
    $smarty->assign('title', $title);
    $smarty->assign('table', $table);
    $smarty->assign('add_id', '');
    $smarty->assign('link', $link);
    $html = $smarty->fetch('inner-tpl/product/formAddElement.tpl');
    return $html;
}
/*........................полное редактирование пунктов каталога........*/
function edit_menu($r, $m_r){
    access();
    access_rights($r);
    global $smarty;
    global $arResult;
    global $Catalog;
    //echo '<pre>';print_r($Catalog); echo '</pre>';
    $mysqli = M_Core_DB::getInstance();
    if(isset($_SESSION["back_edit"])) unset($_SESSION["back_edit"]);
    if(isset($_SESSION["back_one"])) unset($_SESSION["back_one"]);
    $GoTo = ADMIN_PANEL;
    if($arResult->POS1!=''){
        $eng = $arResult->POS1;
        if($arResult->POS2!=''){
            $kind = $arResult->POS2;
        }
        else{
            $kind = '';
        }
        if($arResult->POS3 !=''){
            $sub_eng = $arResult->POS3;
        }
        if($arResult->POS4 !=''){
            $subsub_eng = $arResult->POS4;
        }
    }
    else{
        header("Location: ".$GoTo);
        exit;
    }
    $classHidden=$h1_text=$foto=$main_img=$table_redact2=$id_for_eng=$disabled=$menu_id=$submenu_items=$txt=$block1=$block2=$reg=$reg2='';

    //делаем закрытые для модераторов поля заблокированными
    if($m_r == 'm'){
        $disabled = "disabled='disabled'";
    }
    else{
        $disabled = '';
    }
    $link_url = $_SERVER['REQUEST_URI'];
    foreach($Catalog as $key => $value){
        if($value["eng"] == $eng){
            $rus =  htmlspecialchars($value['title'], ENT_QUOTES);
            $menu_id = $value["id"];
            $h1_text = $value["h1"];
            $content = $value["content"];
            $name_pos = '<a href="/catalog/'.$eng.'" >'.$rus.'</a>';
        }
    }
    //ссылка метатегов
    $query = "SELECT title, link FROM ".ADMIN_ACTIONS." ORDER BY id LIMIT 1,1";
    $mysqli->_execute($query);
    $row = $mysqli->fetch();
    $link_met = $row['link'];
    /////////////////////////////MENU///////////////////////////////////////////
    if($kind == 'menu'){
        $txt = 'категории';
        /*
            ==================
            [BLOCK 1]
            ==================
        */
        $legend  = 'Список подкатегорий в данной категории ('.$name_pos.')';
        $sub_td = '';
        $header_sub = '<th>del</th><th>id</th><th>Название</th><th>F</th><th>M</th>';
        $table_sub = CATALOG_SUBMENU;
        $table_current = CATALOG_MENU;

        //список подкатегорий в категории
        foreach($Catalog as $key => $menu){
            if($menu["id"] == $menu_id){
                if(sizeof($menu["Submenu"]) > 0 && $menu["Submenu"] !=''){
                    foreach($menu["Submenu"] as $key2 => $value){
                        $num_id = $value["id"];
                        $classHidden = '';
                        $reg = preg_match( "/^default_/i", $value["eng"] );
                        if($reg){
                            $classHidden = 'class="classHidden"';
                        }
                        $del_check = '<input type="checkbox" name="del[]"  value="'.$value['id'].'"/>';
                        $title_sub = '<a class="text-info" href="/catalog/'.$eng.'/'.$value['eng'].'">'.$value["title"].'</a>';
                        $edit_full = '<a href="'.ADMIN_PANEL.'/edit_catalog/'.$eng.'/submenu/'.$value['eng'].'">'.EDIT_IMG.'</a>';
                        $edit_key  = '<a href="'.ADMIN_PANEL.'/'.$link_met.'_other/'.$eng.'/'.CATALOG_SUBMENU.'/'.$value["eng"].'" ><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
                        $smarty->assign('del_td', '<td>'.$del_check.'</td>');
                        $smarty->assign('classHidden', $classHidden);
                        $smarty->assign('num_id', $num_id);
                        $smarty->assign('title', $title_sub);
                        $smarty->assign('edit_full', $edit_full);
                        $smarty->assign('edit_key', $edit_key);
                        $sub_td.= $smarty->fetch('inner-tpl/edit-product/inputSubmenuTd.tpl');

                    }
                    if($eng !='rashodnyye-materialy'){
                        $del_button = '<button id="button_del" class="btn btn-danger" type="button">Удалить</button>';
                    }
                    else{
                        $del_button = '';
                    }
                    $smarty->assign('id', '');
                    $smarty->assign('header_tab', $header_sub);
                    $smarty->assign('td', $sub_td);
                    $smarty->assign('del_button', $del_button);
                    $submenu_items = $smarty->fetch('inner-tpl/edit-product/inputSubmenuT.tpl');
                }
                else{
                    $submenu_items = NODATA;
                }
            }
        }
        if($eng !='rashodnyye-materialy'){
            $link = '<input name="link" type="hidden" value="'.$link_url.'">';
            $legend1  = 'Добавить подкатегорию';
            $submit_button = '<button type="button" class="btn btn-default" id="button_add">Отправить</button>';
            $smarty->assign('legend', $legend1);
            $smarty->assign('add_id', $menu_id);
            $smarty->assign('add_input_id', 'add_input');
            $smarty->assign('add_input_class', '');
            $smarty->assign('button_add_input', "button_add_input");
            $smarty->assign('hidden_add_img', '');
            $smarty->assign('submit_button', $submit_button);
            $add_input = $smarty->fetch('inner-tpl/edit-product/addInput.tpl');
            $smarty->assign('table', $table_sub);
            $smarty->assign('add_input', $add_input);
            $smarty->assign('method', '');
            $smarty->assign('action', '');
            $smarty->assign('link', $link);
            $add_elements = $smarty->fetch('inner-tpl/edit-product/addElement.tpl');
        }
        else $add_elements = '';
        $formElements = "formElements";
        $link = '<input name="link" type="hidden" value="'.$link_url.'">';
        $smarty->assign('legend', $legend);
        $smarty->assign('formElements', $formElements);
        $smarty->assign('table', $table_sub);
        $smarty->assign('method', '');
        $smarty->assign('action', '');
        $smarty->assign('submenu_items', $submenu_items);
        $smarty->assign('hidden', $link);
        $smarty->assign('add_elements', $add_elements);
        $block1 = $smarty->fetch('inner-tpl/edit-product/block1.tpl');

        /*
            ==================
            [BLOCK 2]
            ==================
        */
        $legend2 = "Данные категории (".$name_pos.") (id=".$menu_id.')';
        $link = '<input name="link" type="hidden" value="'.$link_url.'">';
        $smarty->assign('eng', $eng);
        $smarty->assign('disabled', $disabled);
        $eng_block = $smarty->fetch('inner-tpl/edit-product/engBlock.tpl');
        $smarty->assign('action', '');
        $smarty->assign('legend', $legend2);
        $smarty->assign('table', $table_current);
        $smarty->assign('rus', $rus);
        $smarty->assign('eng_block', $eng_block);
        $smarty->assign('h1_block', '');
        $smarty->assign('disabled', $disabled);
        $smarty->assign('table_redact', '');
        $smarty->assign('table_redact2', '');
        $smarty->assign('main_img','');
        $smarty->assign('edit_id', $menu_id);
        $smarty->assign('link', $link);
        $smarty->assign('mm_edit', '');
        $smarty->assign('type_button', 'type="button"');
        $smarty->assign('method', '');
        $smarty->assign('menu_eng', '');
        $smarty->assign('img_list', '');
        $block2 = $smarty->fetch('inner-tpl/edit-product/block2.tpl');
    }
    /////////////////////////////SUBMENU///////////////////////////////////////////
    if($kind == 'submenu'){
        $txt = 'подкатегории';
        /*
            ==================
            [BLOCK 1]
            ==================
        */
        $sub_td = '';
        $header_sub = '<th>del</th><th>id</th><th>Название</th><th>F</th><th>M</th>';
        $table_sub = CATALOG_ALL;
        $table_current = CATALOG_SUBMENU;

        //список подкатегорий в категории
        foreach($Catalog as $key => $menu){
            if($menu["id"] == $menu_id){
                if(sizeof($menu["Submenu"]) > 0 && $menu["Submenu"] !=''){
                    foreach($menu["Submenu"] as $key2 => $submenu){
                        if($submenu["eng"] == $sub_eng){
                            $rus =  htmlspecialchars($submenu['title'], ENT_QUOTES);
                            $submenu_id = $submenu["id"];
                            $h1_text = $submenu["h1"];
                            $content = $submenu["content"];
                            $name_pos = '<a href="/catalog/'.$eng.'/'.$sub_eng.'" >'.$rus.'</a>';
                            $legend  = 'Список подкатегорий в данной подкатегории ('.$name_pos.')';
                            $arr_img = $submenu["img"];
                            if(sizeof($submenu["All"]) > 0 && $submenu["All"] !=''){
                                foreach($submenu["All"] as $key3 => $value){
                                    $num_id = $value["id"];
                                    $classHidden = '';
                                    $reg = preg_match( "/^default_/i", $menu["eng"] );
                                    $reg1 = preg_match( "/^default_/i", $submenu["eng"] );
                                    $reg2 = preg_match( "/^default_/i", $value["eng"] );
                                    if($reg || $reg1 || $reg2){
                                        $classHidden = 'class="classHidden"';
                                    }
                                    $del_check = '<input type="checkbox" name="del[]"  value="'.$value['id'].'"/>';
                                    $title_sub = '<a class="text-info" href="/catalog/'.$eng.'/'.$value['eng'].'">'.$value["title"].'</a>';
                                    $edit_full = '<a href="'.ADMIN_PANEL.'/edit_catalog/'.$eng.'/all/'.$sub_eng.'/'.$value['eng'].'">'.EDIT_IMG.'</a>';
                                    $edit_key  = '<a href="'.ADMIN_PANEL.'/'.$link_met.'_other/'.$eng.'/'.CATALOG_ALL.'/'.$sub_eng.'/'.$value["eng"].'" ><span class="img_edit" >'.EDIT_IMG_K.'</span></a>';
                                    $smarty->assign('del_td', '<td>'.$del_check.'</td>');
                                    $smarty->assign('classHidden', $classHidden);
                                    $smarty->assign('num_id', $num_id);
                                    $smarty->assign('title', $title_sub);
                                    $smarty->assign('edit_full', $edit_full);
                                    $smarty->assign('edit_key', $edit_key);
                                    $sub_td.= $smarty->fetch('inner-tpl/edit-product/inputSubmenuTd.tpl');
                                }
                                if($eng !='rashodnyye-materialy'){
                                    $del_button = '<button id="button_del" class="btn btn-danger" type="button">Удалить</button>';
                                }
                                else{
                                    $del_button = '';
                                }
                                $smarty->assign('id', '');
                                $smarty->assign('header_tab', $header_sub);
                                $smarty->assign('td', $sub_td);
                                $smarty->assign('del_button', $del_button);
                                $submenu_items = $smarty->fetch('inner-tpl/edit-product/inputSubmenuT.tpl');
                            }
                            else{
                                $submenu_items = NODATA;
                            }
                        }


                    }
                }
                else{
                    $submenu_items = NODATA;
                }
            }
        }
        if($eng !='rashodnyye-materialy'){
            $link = '<input name="link" type="hidden" value="'.$link_url.'">';
            $legend1  = 'Добавить подкатегорию';
            $submit_button = '<button type="button" class="btn btn-default" id="button_add">Отправить</button>';
            $smarty->assign('legend', $legend1);
            $smarty->assign('add_id', $submenu_id);
            $smarty->assign('add_input_id', 'add_input');
            $smarty->assign('add_input_class', '');
            $smarty->assign('button_add_input', "button_add_input");
            $smarty->assign('hidden_add_img', '');
            $smarty->assign('submit_button', $submit_button);
            $add_input = $smarty->fetch('inner-tpl/edit-product/addInput.tpl');
            $smarty->assign('table', $table_sub);
            $smarty->assign('add_input', $add_input);
            $smarty->assign('method', '');
            $smarty->assign('action', '');
            $smarty->assign('link', $link);
            $add_elements = $smarty->fetch('inner-tpl/edit-product/addElement.tpl');
        }
        else $add_elements = '';

        $formElements = "formElements";
        $link = '<input name="link" type="hidden" value="'.$link_url.'">';
        $smarty->assign('legend', $legend);
        $smarty->assign('formElements', $formElements);
        $smarty->assign('table', $table_sub);
        $smarty->assign('method', '');
        $smarty->assign('action', '');
        $smarty->assign('submenu_items', $submenu_items);
        $smarty->assign('hidden', $link);
        $smarty->assign('add_elements', $add_elements);
        $block1 = $smarty->fetch('inner-tpl/edit-product/block1.tpl');
        /*
            ==================
            [BLOCK 2]
            ==================
        */
        $legend_img = "Изображение иконка";

        //проверяем изображение на наличие
        //echo '<pre>';print_r($arr_img);echo '</pre>';
        foreach($arr_img as $key=>$value){
            $img = $value["img"];
            $img_id = $value["id"];
            $alt = $value["alt"];
            $img_title = $value["img_title"];
        }
        $img_now = ' (текущее '.$img.')';
        $path_img = 'catalog/small/';
        $img = FindImg($img, $path_img, TABLE_IMAGES, $img_id);
        $img = '<img src="'.HOME_URL.PATH_IMG.$path_img.$img.'" width="98px"/>';
        $name_del = 'delete';
        $name_img = 'addimg['.$img_id.']';
        $name_alt = 'addimg[alt_'.$img_id.']';
        $name_img_title = 'addimg[title_'.$img_id.']';


        $smarty->assign('legend', $legend_img);
        $smarty->assign('img_now', $img_now);
        $smarty->assign('name_img', $name_img);
        $smarty->assign('name_alt', $name_alt);
        $smarty->assign('name_img_title', $name_img_title);
        $smarty->assign('alt', $alt);
        $smarty->assign('img_title', $img_title);
        $smarty->assign('img', $img);
        $smarty->assign('name_del', $name_del);
        $smarty->assign('img_id', $img_id);
        $main_img = $smarty->fetch('inner-tpl/edit-product/editPhotoIcon.tpl');
        /*....................................table_redact............................................*/
        $name_content = 'content';
        $helpbox = 'helpbox';
        $i = '1';
        $addbbcode20 = '<select name="addbbcode20" onChange="bbfontstyle(\'[color=\' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + \']\', \'[/color]\', \''.$i.'\'); this.selectedIndex=0;" onMouseOver="helpline(\'s\', \''.$i.'\')" onMouseOut="helpline(\'h\', \''.$i.'\')">';
        $smarty->assign('content', $content);
        $smarty->assign('name_content', $name_content);
        $smarty->assign('helpbox', $helpbox);
        $smarty->assign('i', $i);
        $smarty->assign('addbbcode20', $addbbcode20);
        $table_redact = $smarty->fetch('inner-tpl/edit-product/tableRedact.tpl');
        if($eng == 'rashodnyye-materialy'){
            $disabled = "disabled='disabled'";
        }
        $smarty->assign('disabled', $disabled);
        $smarty->assign('h1', $h1_text);
        $h1_block = $smarty->fetch('inner-tpl/edit-product/h1Text.tpl');
        $legend2 = "Данные подкатегории (".$name_pos.") (id=".$submenu_id.')';
        $action = 'action="'.ADMIN_PANEL.'/get_edit_submenu"';
        $mm_edit = '<input name="MM_edit" type="hidden"  value="MM_edit">';
        $menu_eng = '<input name="menu_eng" type="hidden"  value="'.$eng.'">';

        $link = '<input name="link" type="hidden" value="'.$link_url.'">';

        $smarty->assign('eng', $sub_eng);
        $smarty->assign('disabled', $disabled);
        $eng_block = $smarty->fetch('inner-tpl/edit-product/engBlock.tpl');
        $smarty->assign('action', $action);
        $smarty->assign('legend', $legend2);
        $smarty->assign('table', $table_current);
        $smarty->assign('rus', $rus);
        $smarty->assign('eng_block', $eng_block);
        $smarty->assign('h1_block', $h1_block);
        $smarty->assign('disabled', $disabled);
        $smarty->assign('table_redact', $table_redact);
        $smarty->assign('table_redact2', '');
        $smarty->assign('main_img', $main_img);
        $smarty->assign('edit_id', $submenu_id);
        $smarty->assign('link', $link);
        $smarty->assign('mm_edit', $mm_edit);
        $smarty->assign('type_button', 'type="submit"');
        $smarty->assign('method', 'method="POST"');
        $smarty->assign('menu_eng', $menu_eng);
        $smarty->assign('img_list', '');
        $block2 = $smarty->fetch('inner-tpl/edit-product/block2.tpl');
    }
    /////////////////////////////ALL///////////////////////////////////////////
    if($kind == 'all'){

        $txt = 'подподкатегории';
        $images_items = '';
        /*
            ==================
            [BLOCK 1]
            ==================
        */
        $sub_td = '';
        $table_sub = DESC;
        $table_current = CATALOG_ALL;

        //список подкатегорий в категории
        foreach($Catalog as $key => $menu){
            if($menu["eng"] == $eng){
                if(sizeof($menu["Submenu"]) > 0 && $menu["Submenu"] !=''){
                    foreach($menu["Submenu"] as $key2 => $submenu){
                        if($submenu["eng"] == $sub_eng){
                            if(sizeof($submenu["All"]) > 0 && $submenu["All"] !=''){
                                foreach($submenu["All"] as $key3 => $all){
                                    if($all["eng"] == $subsub_eng){
                                        $rus =  htmlspecialchars($all['title'], ENT_QUOTES);
                                        $all_id = $all["id"];
                                        $h1_text = $all["h1"];
                                        $content = $all["content"];
                                        $name_pos = '<a href="/catalog/'.$eng.'/'.$sub_eng.'/'.$subsub_eng.'" >'.$rus.'</a>';
                                        $legend  = 'Список подкатегорий в данной подкатегории ('.$name_pos.')';
                                        $classHidden = '';
                                        $reg = preg_match( "#(default_[0-9]{1,})$#ui", $menu["eng"] );
                                        $reg2 = preg_match( "/^default_/i", $submenu["eng"] );
                                        $reg3 = preg_match( "/^default_/i", $all["eng"] );
                                        if($reg || $reg2 || $reg3){
                                            $classHidden = 'class="classHidden"';
                                        }
                                        //ITEMS
                                        if(sizeof($all["Desc"]) > 0 && $all["Desc"] !=''){
                                            foreach($all["Desc"] as $key4 => $value){
                                                $num_id = $value["id"];
                                                $del_check = '<input type="checkbox" name="del[]"  value="'.$value['id'].'"/>';
                                                $title_sub = '<a class="text-info" href="/catalog/'.$eng.'/'.$sub_eng.'/'.$subsub_eng.'">'.$value["title"].'</a>';
                                                $price = $value["price"];
                                                $ed_izm  = $value["ed_izm"];
                                                $smarty->assign('del_td', '');
                                                $smarty->assign('classHidden', $classHidden);
                                                $smarty->assign('num_id', $num_id);
                                                $smarty->assign('title', $title_sub);
                                                $smarty->assign('edit_full', $price);
                                                $smarty->assign('edit_key', $ed_izm);
                                                $sub_td.= $smarty->fetch('inner-tpl/edit-product/inputSubmenuTd.tpl');
                                            }

                                            $del_button = '';
                                            $header_sub = '<th>id</th><th>Название</th><th>price</th><th>ед.изм.</th>';
                                            $smarty->assign('id', '');
                                            $smarty->assign('header_tab', $header_sub);
                                            $smarty->assign('td', $sub_td);
                                            $smarty->assign('del_button', $del_button);
                                            $submenu_items = $smarty->fetch('inner-tpl/edit-product/inputSubmenuT.tpl');
                                        }
                                        //IMAGES
                                        if(sizeof($all["Images"]) > 0 && $all["Images"] !=''){
                                            $img_td = '';
                                            $tab = TABLE_IMAGES;
                                            $path_img_small = 'catalog';
                                            foreach($all["Images"] as $key4 => $value){
                                                $del_check = '<input type="checkbox" name="del[]" id="del[]" value="'.$value['id'].'"/>';
                                                $img_now = $value["img"];
                                                $img_small = FindImg($value["img"], $path_img_small, $tab, $value["id"]);
                                                $img       = '<img src="'.HOME_URL.'/'.PATH_IMG_SMALL.$img_small.'" width="30px">';
                                                $img_id    = $value["id"];
                                                $img_name  = 'editfile['.$value["id"].']';
                                                $alt       = $value["alt"];
                                                $img_title = $value["img_title"];
                                                $alt_name  = 'editfile[alt_'.$value["id"].']';
                                                $img_title_name = 'editfile[title_'.$value["id"].']';
                                                $select_item = get_select($value['line_id'], MANUF);
                                                $name_select = 'editfile[select_'.$value['id'].']';
                                                $smarty->assign('select_item', $select_item);
                                                $smarty->assign('name_select', $name_select);
                                                $manuf = $smarty->fetch('inner-tpl/edit-product/manufItem.tpl');
                                                $smarty->assign('img_now', $img_now);
                                                $smarty->assign('img', $img);
                                                $smarty->assign('id', $img_id);
                                                $smarty->assign('img_name', $img_name);
                                                $smarty->assign('alt', $alt);
                                                $smarty->assign('img_title', $img_title);
                                                $smarty->assign('alt_name', $alt_name);
                                                $smarty->assign('img_title_name', $img_title_name);
                                                $smarty->assign('manuf', $manuf);
                                                $img_data = $smarty->fetch('inner-tpl/edit-product/imagesData.tpl');

                                                $smarty->assign('del_td', '<td>'.$del_check.'</td>');
                                                $smarty->assign('classHidden', '');
                                                $smarty->assign('num_id', $img_id);
                                                $smarty->assign('title', $img_data);
                                                $img_td.= $smarty->fetch('inner-tpl/edit-product/imagesItemsTd.tpl');
                                            }
                                            $header_sub = '<th>del</th><th>id</th><th>Название</th>';
                                            $edit_button = '<button type="submit" class="btn btn-primary">Изменить</button>';
                                            $smarty->assign('id', '');
                                            $smarty->assign('header_tab', $header_sub);
                                            $smarty->assign('td', $img_td);
                                            $smarty->assign('del_button', $edit_button);
                                            $images_items = $smarty->fetch('inner-tpl/edit-product/inputSubmenuT.tpl');
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if($eng =='rashodnyye-materialy'){
            $formElements = "formElements";
            $link = '<input name="link" type="hidden" value="'.$link_url.'">';
            $smarty->assign('legend', $legend);
            $smarty->assign('formElements', $formElements);
            $smarty->assign('table', $table_sub);
            $smarty->assign('method', '');
            $smarty->assign('action', '');
            $smarty->assign('submenu_items', $submenu_items);
            $smarty->assign('hidden', $link);
            $smarty->assign('add_elements', '');
            $block1 = $smarty->fetch('inner-tpl/edit-product/block1.tpl');
        }
        else{
            $block1 = '';
        }
        /*
        ==================
        [BLOCK 2]
        ==================
        */
        /*....................................table_redact............................................*/
        $name_content = 'content';
        $helpbox = 'helpbox';
        $i = '1';
        $addbbcode20 = '<select name="addbbcode20" onChange="bbfontstyle(\'[color=\' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + \']\', \'[/color]\', \''.$i.'\'); this.selectedIndex=0;" onMouseOver="helpline(\'s\', \''.$i.'\')" onMouseOut="helpline(\'h\', \''.$i.'\')">';
        $smarty->assign('content', $content);
        $smarty->assign('name_content', $name_content);
        $smarty->assign('helpbox', $helpbox);
        $smarty->assign('i', $i);
        $smarty->assign('addbbcode20', $addbbcode20);
        $table_redact = $smarty->fetch('inner-tpl/edit-product/tableRedact.tpl');
        if($eng == 'rashodnyye-materialy'){
            $disabled = "disabled='disabled'";
        }
        $smarty->assign('disabled', $disabled);
        $smarty->assign('h1', $h1_text);
        $h1_block = $smarty->fetch('inner-tpl/edit-product/h1Text.tpl');

        /*....................................img_list............................................*/
        $legend3  = 'Список изображений в данной подкатегории ('.$name_pos.')';
        $legend4  = 'Добавить изображение в подкатегорию ('.$name_pos.')';
        $formElements = "formImages";
        $action = 'action="'.ADMIN_PANEL.'/get_edit_images"';
        $method = 'method="POST"';
        $hidden = '<input name="Img_edit" type="hidden"  value="Img_edit">';
        $hidden.= '<input type="hidden" value="'.$all_id.'" name="edit_id">';
        $hidden.= '<input type="hidden" value="'.TABLE_IMAGES.'" name="img_table">';
        $hidden_add_img = '<input type="hidden" value="'.TABLE_IMAGES.'" name="add_input_img">';
        $table = TABLE_IMAGES;
        $submit_button = '<button type="submit" class="btn btn-default" id="button_add">Отправить</button>';
        $smarty->assign('legend', $legend4);
        $smarty->assign('add_id', $all_id);
        $smarty->assign('add_input_id', 'table_add_img');
        $smarty->assign('add_input_class', 'class="tabImgProd"');
        $smarty->assign('button_add_input', "button_add_img");
        $smarty->assign('hidden_add_img', $hidden_add_img);
        $smarty->assign('submit_button', $submit_button);
        $add_input = $smarty->fetch('inner-tpl/edit-product/addInput.tpl');

        $smarty->assign('table', $table);
        $smarty->assign('method', $method);
        $smarty->assign('action', $action);
        $smarty->assign('add_input', $add_input);
        $smarty->assign('link', '');
        $add_elements = $smarty->fetch('inner-tpl/edit-product/addElement.tpl');
        $smarty->assign('legend', $legend3);
        $smarty->assign('formElements', $formElements);
        $smarty->assign('table', '');
        $smarty->assign('method', $method);
        $smarty->assign('action', $action);
        $smarty->assign('submenu_items', $images_items);
        $smarty->assign('hidden', $hidden);
        $smarty->assign('add_elements', $add_elements);
        $img_list = $smarty->fetch('inner-tpl/edit-product/imgList.tpl');

        $legend2 = "Данные подподкатегории (".$name_pos.") (id=".$all_id.')';
        $action = 'action="'.ADMIN_PANEL.'/get_edit_all"';
        $mm_edit = '<input name="MM_edit" type="hidden"  value="MM_edit">';
        $menu_eng = '<input name="menu_eng" type="hidden"  value="'.$eng.'">';
        $link = '<input name="link" type="hidden" value="'.$link_url.'">';
        $smarty->assign('eng', $subsub_eng);
        $smarty->assign('disabled', $disabled);
        $eng_block = $smarty->fetch('inner-tpl/edit-product/engBlock.tpl');
        $smarty->assign('action', $action);
        $smarty->assign('legend', $legend2);
        $smarty->assign('table', $table_current);
        $smarty->assign('rus', $rus);
        $smarty->assign('eng_block', $eng_block);
        $smarty->assign('h1_block', $h1_block);
        $smarty->assign('disabled', $disabled);
        $smarty->assign('table_redact', $table_redact);
        $smarty->assign('table_redact2', '');
        $smarty->assign('main_img', $main_img);
        $smarty->assign('edit_id', $all_id);
        $smarty->assign('link', $link);
        $smarty->assign('mm_edit', $mm_edit);
        $smarty->assign('type_button', 'type="submit"');
        $smarty->assign('method', 'method="POST"');
        $smarty->assign('menu_eng', $menu_eng);
        $smarty->assign('img_list', $img_list);
        $block2 = $smarty->fetch('inner-tpl/edit-product/block2.tpl');


    }

    //ссылка назад
    $back_link = ADMIN_PANEL.'/products';
    $back = '<a href="'.$back_link.'" '.STYLE12.'>'.BACK_IMG.' назад</a>';
    $smarty->assign('txt', $txt);
    $smarty->assign('block1', $block1);
    $smarty->assign('block2', $block2);
    $html = $smarty->fetch('inner-tpl/edit-product/editMenu.tpl');

    return $html;
}

function get_edit_all(){
    $mysqli = M_Core_DB::getInstance();
    $_SESSION['prevPage'] = $_SERVER['HTTP_REFERER'];
    if ((isset($_POST["MM_edit"])) && ($_POST["MM_edit"] == "MM_edit")){
        //echo '<pre>';print_r($_POST);echo '</pre>';
        if(isset($_POST['rus'])){
            $rus = GetFormValue($_POST['rus']);
        }
        else{
            $rus = '';
        }
        if(isset($_POST['eng'])){
            $eng = GetFormValue($_POST['eng']);
        }
        else{
            $eng = '';
        }
        if(isset($_POST['menu_eng'])){
            $menu_eng = GetFormValue($_POST['menu_eng']);
        }
        if(isset($_POST['h1'])){
            $h1 = GetFormValue($_POST['h1']);
        }
        else{
            $h1 = '';
        }
        if(isset($_POST['content'])){
            $content = GetFormValue($_POST['content']);
        }
        else{
            $content = '';
        }
        if(isset($_POST['edit_id'])){
            $id = $_POST['edit_id'];
        }
        $error = '';
        $tab = CATALOG_ALL;
        $tab_img = TABLE_IMAGES;
        if ( empty( $rus ) && $menu_eng !='rashodnyye-materialy')
            $error = $error.'<li>не заполнено название позиции по-русски</li>'."\n";
        if(!empty($error)){
            new Messages('error', '<ul>'.$error.'</ul>');
        }
        else{
            if($menu_eng == 'rashodnyye-materialy'){
                $query = sprintf("UPDATE ".$tab." SET content=%s  WHERE id=%s",
                    GetSQLValueString($content, "text"),
                    GetSQLValueString($id, "int"));
                $mysqli->query($query);
                $GoTo = '';
            }
            else{
                $query = sprintf("UPDATE ".$tab." SET title=%s, h1=%s, content=%s, eng=%s  WHERE id=%s",
                    GetSQLValueString($rus, "text"),
                    GetSQLValueString($h1, "text"),
                    GetSQLValueString($content, "text"),
                    GetSQLValueString($eng, "text"),
                    GetSQLValueString($id, "int"));
                $mysqli->query($query);
                $query = "SELECT ".CATALOG_ALL.".eng, ".CATALOG_SUBMENU.".eng as submenu_eng FROM ".$tab."
                      INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_SUBMENU.".id = ".CATALOG_ALL.".submenu_id
                      WHERE ".CATALOG_ALL.".id =".$id;
                $mysqli->_execute($query);
                $row = $mysqli->fetch();
                $GoTo = 'edit_catalog/'.$menu_eng.'/all/'.$row["submenu_eng"].'/'.$row["eng"];
            }
            new Messages('info', 'Изменения зафиксированы!', $GoTo);
        }
    }
    else{
        new Messages('error', 'Ошибка!');
    }
    return;
}
function get_edit_submenu(){
    $mysqli = M_Core_DB::getInstance();
    $GoTo = ADMIN_PANEL.'/products';
    //echo '<pre>'; print_r($_POST); echo '</pre>';
    $_SESSION['prevPage'] = $_SERVER['HTTP_REFERER'];
    if ((isset($_POST["MM_edit"])) && ($_POST["MM_edit"] == "MM_edit")){ //echo '<pre>';print_r($_POST);echo '</pre>';
        if(isset($_POST['rus'])){
            $rus = GetFormValue($_POST['rus']);
        }
        if(isset($_POST['eng'])){
            $eng = GetFormValue($_POST['eng']);
        }
        if(isset($_POST['menu_eng'])){
            $menu_eng = GetFormValue($_POST['menu_eng']);
        }
        if(isset($_POST['h1'])){
            $h1 = GetFormValue($_POST['h1']);
        }
        if(isset($_POST['content'])){
            $content = GetFormValue($_POST['content']);
        }
        if(isset($_FILES['addimg'])){
            $file = $_FILES['addimg'];
        }
        if(isset($_POST['addimg'])){
            $keys = $_POST['addimg'];
        }
        if(isset($_POST['delete'])){
            $delete = $_POST['delete'];
        }
        if(isset($_POST['edit_id'])){
            $id = $_POST['edit_id'];
        }
        if(isset($_POST['img_id'])){
            $img_id = $_POST['img_id'];
        }
        if(isset($_POST['menu_eng'])){
            $menu_eng = $_POST['menu_eng'];
        }
        $error = '';
        $dest = "catalog/";
        $destS = "catalog/small/";
        $tab = CATALOG_SUBMENU;
        $tab_img = TABLE_IMAGES;

        if ( empty( $rus ) )
            $error = $error.'<li>не заполнено название позиции по-русски</li>'."\n";
        //if ( preg_match( "/[&$^%#*@!+=(){}:;\/]+$/ui",  $name) )
        //$error = $error.'<li>название содержит недопустимые символы (пробел, %, $ и т.д.)</li>'."\n";

        //удаление отмеченных фото иконок
        if(isset($_POST['delete']) && $_POST['delete'] == 'yes'){
            $query = "SELECT img FROM ".$tab_img." WHERE id =".$img_id;
            $mysqli->_execute($query);
            $row = $mysqli->fetch();
            $file_name = $row['img'];
            $file = './'.PATH_IMG_GLOB.'/'.$row['img'];
            $fileS = './'.PATH_IMG_GLOB.'/small/'.$row['img'];
            $hasAFile = FindFileStuct($file_name, PATH_IMG.$dest);
            if($hasAFile && $file_name !="empty.jpg")
            {
                unlink($file);
            }
            $hasAFile = FindFileStuct($file_name, PATH_IMG.$destS);
            if($hasAFile && $file_name !="empty.jpg")
            {
                unlink($fileS);
            }
            $img = 'empty.jpg';
            $query = sprintf("UPDATE ".$tab_img." SET img=%s WHERE id=%s",
                GetSQLValueString($img, "text"),
                GetSQLValueString($img_id, "int"));
            $mysqli->query($query);
        }
        else{
            if(isset($_FILES['addimg'])){
                //добавление изображения
                $edit_error = editIMG($file, $id, $keys, $tab_img, $menu_eng);
                $str = substr($edit_error, 0, 1);
                if(!$str)
                {
                    $str = substr($edit_error, 1);
                    $error.=$str;
                }
            }
        }
        if(!empty($error)){
            new Messages('error', '<ul>'.$error.'</ul>');

        }
        else{
            $query = sprintf("UPDATE ".$tab." SET title=%s, h1=%s, eng=%s, content=%s  WHERE id=%s",
                GetSQLValueString($rus, "text"),
                GetSQLValueString($h1, "text"),
                GetSQLValueString($eng, "text"),
                GetSQLValueString($content, "text"),
                GetSQLValueString($id, "int"));
            $mysqli->query($query);
            $query = "SELECT eng FROM ".$tab." WHERE id =".$id;
            $mysqli->_execute($query);
            $row = $mysqli->fetch();
            $GoTo = 'edit_catalog/'.$menu_eng.'/submenu/'.$row["eng"];
            new Messages('info', 'Изменения зафиксированы!', $GoTo);
        }
    }
    else{
        header("Location: ".$GoTo);
        exit;
    }
    return;
}
//редактирование данных разных таблиц
function admin_dif_table(){
    $mysqli = M_Core_DB::getInstance();
    global $smarty;
    global $arResult;
    $tab = $arResult->ACTION;
    //................редактирование данных таблиц пользователи, новости.........................//
    if($tab == TABLE_ADMIN_USERS){
        $select_item = 'id, name';
        $title_main  = 'Ф.И.О.';
        $title_tab   = '';
        $order_by    = 'id ASC';
        $action      = 'edit_table';
        $action_meta = 'edit_metatags_other';
        $condition   = 'WHERE rights = "m"';
        $M           = '';
    }
    elseif($tab == SERVICES){
        $select_item = 'id, title, eng';
        $title_main  = 'Наименование';
        $title_tab   =  '<th>english</th>';
        $order_by    = 'id ASC';
        $action      = 'edit_'.$tab;
        $action_meta = 'edit_metatags_other';
        $condition   = '';
        $M           = '<th>M</th>';
    }
    elseif($tab == RABOTY){
        $select_item = 'id, title';
        $title_main  = 'Наименование';
        $title_tab   =  '<th>ID</th>';
        $order_by    = 'id ASC';
        $action      = 'edit_'.$tab;
        $action_meta = 'edit_metatags_other';
        $condition   = '';
        $M           = '<th>M</th>';
    }
    elseif($tab == RESP_TXT){
        $title_main = 'Содержание';
        $title_tab  = 'Категория';
        $action     = 'edit_table';
    }
    if($tab == RESP_TXT){
        $str=strstr($_GET["action"], 'page=');
        if($str){
            $arr = preg_split('/\=/', $str, -1, PREG_SPLIT_NO_EMPTY);
            $num = intval($arr[1]);
            if(!$num){
                error404(SAPI_NAME, REQUEST_URL);
            }
            else{
                $pageNum = $num;
                if ( $pageNum < 1 ) $pageNum = 1;
            }
        }
        else{
            $pageNum = 1;
        }
        $maxRows = 20;
        $startRow = ($pageNum-1)* $maxRows;
        $query = "SELECT ".RESP_TXT.".id, ".RESP_TXT.".content, ".RESP_TXT.".date, ".RESP_TXT.".status, ".RESP_CAT.".title FROM ".RESP_TXT."
		          INNER JOIN ".RESP_CAT." ON ".RESP_TXT.".cat_id = ".RESP_CAT.".id
			      ORDER BY ".RESP_TXT.".date DESC";
        $query_limit = sprintf("%s LIMIT %d, %d", $query, $startRow, $maxRows);
        try{
            $x = $mysqli->queryQ($query_limit);
            $mysqli->_execute($query);
            $totalPages = ceil($mysqli->num_rows()/$maxRows);
            if($pageNum > $totalPages && $mysqli->num_rows() > 0) error404(SAPI_NAME, REQUEST_URL);
            $filename = '/admin/response/';
            $uri = 'page';
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    else{
        $query = "SELECT ".$select_item." FROM ".$tab." ".$condition."
                  ORDER BY ".$order_by;
        try{
            $x = $mysqli->queryQ($query);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

    if($tab == RESP_TXT){
        $header_table = '<tr><th>ID</th><th>Дата</th><th>'.$title_main.'</th><th>'.$title_tab.'</th><th>D</th></tr>';
    }
    else{
        $header_table = '<tr><th>'.$title_main.'</th>'.$title_tab.'<th>F</th>'.$M.'<th>D</th></tr>';
    }


    $html = $content = $product = $table = $td = $title_eng_str = $metatag = $eng = $id = $date = $resp_content = '';
    if($mysqli->num_r($x) > 0){
        while($row = $mysqli->fetchAssoc($x)){
            $num = $row['id'];
            if($tab == TABLE_ADMIN_USERS){
                $title = '<span id="a_'.$num.'" '.STYLE1.'>'.stripslashes($row['name']).'</span>';
                $edit_full = '<a href="'.ADMIN_PANEL.'/'.$action.'/'.$row['id'].'/'.$tab.'">'.EDIT_IMG.'</a>';
            }
            else{
                $edit_full = '<a href="'.ADMIN_PANEL.'/'.$action.'/'.$row['id'].'">'.EDIT_IMG.'</a>';
            }

            $del = '<span class="del_button '.$tab.'" id="'.$num.'">'.DEL_IMG.'</span>';

            if($tab == SERVICES ){
                $metatag = '<td><a href="'.ADMIN_PANEL.'/'.$action_meta.'/'.$row['id'].'/'.$tab.'">'.EDIT_IMG_K.'</a></td>';
                $eng = '<td>'.$row["eng"].'</td>';
                $title = '<a href="/'.$tab.'/'.$row["eng"].'" >'.stripslashes($row['title']).'</a>';
            }
            elseif($tab == RESP_TXT){
                $id = $row["id"];
                $date = get_string_time($row['date']);
                $resp_content = $row["content"];
                $title = $row['title'];
            }
            elseif($tab == RABOTY){
                $metatag = '<td><a href="'.ADMIN_PANEL.'/'.$action_meta.'/'.$row['id'].'/'.$tab.'">'.EDIT_IMG_K.'</a></td>';
                $eng = '<td>'.$row["id"].'</td>';
                $title = '<a href="/'.$tab.'/'.$row["id"].'" >'.stripslashes($row['title']).'</a>';
            }
            else{
                $metatag = '';
                $eng = '';
            }
            $smarty->assign('id', $id);
            $smarty->assign('date', $date);
            $smarty->assign('resp_content', $resp_content);
            $smarty->assign('title', $title);
            $smarty->assign('eng', $eng);
            $smarty->assign('edit_full', $edit_full);
            $smarty->assign('metatag', $metatag);
            $smarty->assign('del', $del);
            if($tab == RESP_TXT){
                $td = $smarty->fetch('inner-tpl/dif-tab/respTd.tpl');
            }
            else{
                $td = $smarty->fetch('inner-tpl/dif-tab/inputSubmenuTd.tpl');
            }

            $smarty->assign('td', $td);
            $smarty->assign('product', $product);
            $smarty->assign('submenu_td', '');
            $content.= $smarty->fetch('inner-tpl/editTableT.tpl');
        }

        $smarty->assign('header_table', $header_table);
        $smarty->assign('content', $content);
        $smarty->assign('id', 'id="dif_tab"');
        $smarty->assign('link', 'class = "'.$_SERVER['REQUEST_URI'].'"');
        $html = $smarty->fetch('inner-tpl/dif-tab/tableMain.tpl');


        $top = '<a href="#top" '.STYLE12.'>'.TOP_IMG.' Наверх</a>';
    }
    else{
        $top = '';
        $table = '<div align="center">Нет пунктов</div>';
    }

    if($tab == RESP_TXT){
        $nav_obj = new NavPage($totalPages, $pageNum, $filename, $uri, 'admin', 20);
        $nav = $nav_obj->Content;
        $html.=$table.$nav;
    }
    else{
        $html.=$table.view_add_menu();
    }


    $html.= $top;
    return $html;
}
function edit_services($r){
    /////////////////////////////SERVICES///////////////////////////////////////////
    access();
    access_rights($r);
    global $arResult;
    global $smarty;
    global $Services;
    $txt = 'услуг';
    $elem_id = $arResult->POS1;
    $table_current = SERVICES;
    $images_items = '';
    foreach($Services as $key => $services){
        if($services["id"] == $elem_id){
            $rus =  htmlspecialchars($services['title'], ENT_QUOTES);
            $serv_eng = $services["eng"];
            $content = $services["content"];
            $legend = '<a href="/services/'.$serv_eng.'" >'.$rus.'</a>';
            //IMAGES
            if(sizeof($services["Images"]) > 0 && $services["Images"] !=''){
                $img_td = '';
                $tab = IMAGES_SERV;
                $path_img_small = 'services/catalog';
                foreach($services["Images"] as $key1 => $value){
                    $del_check = '<input type="checkbox" name="del[]" id="del[]" value="'.$value['id'].'"/>';
                    $img_now = $value["img"];
                    $img_small = FindImg($value["img"], $path_img_small, $tab, $value["id"]);
                    $img       = '<img src="'.HOME_URL.'/'.PATH_IMG_SERV_SMALL.$img_small.'" width="30px">';
                    $img_id    = $value["id"];
                    $img_name  = 'editfile['.$value["id"].']';
                    $alt       = $value["alt"];
                    $img_title = $value["img_title"];
                    $alt_name  = 'editfile[alt_'.$value["id"].']';
                    $img_title_name = 'editfile[title_'.$value["id"].']';

                    $smarty->assign('img_now', $img_now);
                    $smarty->assign('img', $img);
                    $smarty->assign('id', $img_id);
                    $smarty->assign('img_name', $img_name);
                    $smarty->assign('alt', $alt);
                    $smarty->assign('img_title', $img_title);
                    $smarty->assign('alt_name', $alt_name);
                    $smarty->assign('img_title_name', $img_title_name);
                    $smarty->assign('manuf', '');
                    $img_data = $smarty->fetch('inner-tpl/edit-product/imagesData.tpl');

                    $smarty->assign('del_td', '<td>'.$del_check.'</td>');
                    $smarty->assign('classHidden', '');
                    $smarty->assign('num_id', $img_id);
                    $smarty->assign('title', $img_data);
                    $img_td.= $smarty->fetch('inner-tpl/edit-product/imagesItemsTd.tpl');
                }
                $header_sub = '<th>del</th><th>id</th><th>Название</th>';
                $edit_button = '<button type="submit" class="btn btn-primary">Изменить</button>';
                $smarty->assign('id', '');
                $smarty->assign('header_tab', $header_sub);
                $smarty->assign('td', $img_td);
                $smarty->assign('del_button', $edit_button);
                $images_items = $smarty->fetch('inner-tpl/edit-product/inputSubmenuT.tpl');
            }
            else{
                $images_items = NODATA;
            }
        }
    }
    $link_url = $_SERVER['REQUEST_URI'];
    $link = '<input name="link" type="hidden" value="'.$link_url.'">';
    /*....................................img_list............................................*/
    $legend3  = 'Список изображений ('.$legend.')';
    $legend4  = 'Добавить изображение ('.$legend.')';
    $formElements = "formImages";
    $action = 'action="'.ADMIN_PANEL.'/get_edit_images"';
    $method = 'method="POST"';
    $hidden = '<input name="Img_edit" type="hidden"  value="Img_edit">';
    $hidden.= '<input type="hidden" value="'.$elem_id.'" name="edit_id">';
    $hidden.= '<input type="hidden" value="'.IMAGES_SERV.'" name="img_table">';
    $hidden_add_img = '<input type="hidden" value="'.IMAGES_SERV.'" name="add_input_img">';
    $table = TABLE_IMAGES;
    $submit_button = '<button type="submit" class="btn btn-default" id="button_add">Отправить</button>';
    $smarty->assign('legend', $legend4);
    $smarty->assign('add_id', $elem_id);
    $smarty->assign('add_input_id', 'table_add_img');
    $smarty->assign('add_input_class', 'class="tabImg"');
    $smarty->assign('button_add_input', "button_add_img");
    $smarty->assign('hidden_add_img', $hidden_add_img);
    $smarty->assign('submit_button', $submit_button);
    $add_input = $smarty->fetch('inner-tpl/edit-product/addInput.tpl');

    $smarty->assign('table', $table);
    $smarty->assign('method', $method);
    $smarty->assign('action', $action);
    $smarty->assign('add_input', $add_input);
    $smarty->assign('link', '');
    $add_elements = $smarty->fetch('inner-tpl/edit-product/addElement.tpl');
    $smarty->assign('legend', $legend3);
    $smarty->assign('formElements', $formElements);
    $smarty->assign('table', '');
    $smarty->assign('method', $method);
    $smarty->assign('action', $action);
    $smarty->assign('submenu_items', $images_items);
    $smarty->assign('hidden', $hidden);
    $smarty->assign('add_elements', $add_elements);
    $img_list = $smarty->fetch('inner-tpl/edit-product/imgList.tpl');
    /*....................................table_redact............................................*/
    $name_content = 'content';
    $helpbox = 'helpbox';
    $i = '1';
    $addbbcode20 = '<select name="addbbcode20" onChange="bbfontstyle(\'[color=\' + this.form.addbbcode20.options[this.form.addbbcode20.selectedIndex].value + \']\', \'[/color]\', \''.$i.'\'); this.selectedIndex=0;" onMouseOver="helpline(\'s\', \''.$i.'\')" onMouseOut="helpline(\'h\', \''.$i.'\')">';
    $smarty->assign('content', $content);
    $smarty->assign('name_content', $name_content);
    $smarty->assign('helpbox', $helpbox);
    $smarty->assign('i', $i);
    $smarty->assign('addbbcode20', $addbbcode20);
    $table_redact = $smarty->fetch('inner-tpl/edit-product/tableRedact.tpl');
    $smarty->assign('eng', $serv_eng);
    $smarty->assign('disabled', '');
    $eng_block = $smarty->fetch('inner-tpl/edit-product/engBlock.tpl');
    $smarty->assign('action', '');
    $smarty->assign('legend', $legend);
    $smarty->assign('table', $table_current);
    $smarty->assign('rus', $rus);
    $smarty->assign('eng_block', $eng_block);
    $smarty->assign('h1_block', '');
    $smarty->assign('disabled', '');
    $smarty->assign('table_redact', $table_redact);
    $smarty->assign('table_redact2', '');
    $smarty->assign('main_img', '');
    $smarty->assign('edit_id', $elem_id);
    $smarty->assign('link', $link);
    $smarty->assign('mm_edit', '');
    $smarty->assign('type_button', 'type="button"');
    $smarty->assign('method', '');
    $smarty->assign('menu_eng', '');
    $smarty->assign('img_list', $img_list);
    $block2 = $smarty->fetch('inner-tpl/edit-product/block2.tpl');


    $smarty->assign('txt', $txt);
    $smarty->assign('block1', '');
    $smarty->assign('block2', $block2);
    $html = $smarty->fetch('inner-tpl/edit-product/editMenu.tpl');
    return $html;

}

function edit_nashi_raboty($r){
    /////////////////////////////SERVICES///////////////////////////////////////////
    access();
    access_rights($r);
    global $arResult;
    global $smarty;
    global $Raboty;
    $txt = 'работы';
    $elem_id = $arResult->POS1;
    $table_current = RABOTY;
    $table = RABOTY_IMG;
    $images_items = '';
    foreach($Raboty as $key => $raboty){
        if($raboty["id"] == $elem_id){
            $rus =  htmlspecialchars($raboty['title'], ENT_QUOTES);
            $elem_id = $raboty["id"];
            $legend = '<a href="/nashi_raboty/'.$elem_id.'" >'.$rus.'</a>';
            $arr_img = $raboty["img"];
            //IMAGES
            if(sizeof($raboty["Images"]) > 0 && $raboty["Images"] !=''){
                $img_td = '';
                $path_img_small = RABOTY.'/small';
                foreach($raboty["Images"] as $key1 => $value){
                    $del_check = '<input type="checkbox" name="del[]" id="del[]" value="'.$value['id'].'"/>';
                    $img_now = $value["img"];
                    $img_small = FindImg($value["img"], $path_img_small, $table, $value["id"]);
                    $img       = '<img src="'.HOME_URL.'/'.PATH_IMG_SMALLR.$img_small.'" width="30px">';
                    $img_id    = $value["id"];
                    $img_name  = 'editfile['.$value["id"].']';
                    $alt       = $value["alt"];
                    $img_title = $value["img_title"];
                    $alt_name  = 'editfile[alt_'.$value["id"].']';
                    $img_title_name = 'editfile[title_'.$value["id"].']';
                    $desc_name = 'editfile[desc_'.$value["id"].']';
                    $smarty->assign('desc_name', $desc_name);
                    $smarty->assign('desc_content', $value["description"]);
                    $desc = $smarty->fetch('inner-tpl/dif-tab/descFild.tpl');
                    $smarty->assign('img_now', $img_now);
                    $smarty->assign('img', $img);
                    $smarty->assign('id', $img_id);
                    $smarty->assign('img_name', $img_name);
                    $smarty->assign('alt', $alt);
                    $smarty->assign('img_title', $img_title);
                    $smarty->assign('alt_name', $alt_name);
                    $smarty->assign('img_title_name', $img_title_name);
                    $smarty->assign('manuf', $desc);
                    $img_data = $smarty->fetch('inner-tpl/edit-product/imagesData.tpl');

                    $smarty->assign('del_td', '<td>'.$del_check.'</td>');
                    $smarty->assign('classHidden', '');
                    $smarty->assign('num_id', $img_id);
                    $smarty->assign('title', $img_data);
                    $img_td.= $smarty->fetch('inner-tpl/edit-product/imagesItemsTd.tpl');
                }
                $header_sub = '<th>del</th><th>id</th><th>Название</th>';
                $edit_button = '<button type="submit" class="btn btn-primary">Изменить</button>';
                $smarty->assign('id', '');
                $smarty->assign('header_tab', $header_sub);
                $smarty->assign('td', $img_td);
                $smarty->assign('del_button', $edit_button);
                $images_items = $smarty->fetch('inner-tpl/edit-product/inputSubmenuT.tpl');
            }
            else{
                $images_items = NODATA;
            }
        }
    }
    $link_url = $_SERVER['REQUEST_URI'];
    $link = '<input name="link" type="hidden" value="'.$link_url.'">';
    /*....................................img_list............................................*/
    $legend3  = 'Список изображений ('.$legend.')';
    $legend4  = 'Добавить изображение ('.$legend.')';
    $formElements = "formImages";
    $action = 'action="'.ADMIN_PANEL.'/get_edit_images"';
    $method = 'method="POST"';
    $hidden = '<input name="Img_edit" type="hidden"  value="Img_edit">';
    $hidden.= '<input type="hidden" value="'.$elem_id.'" name="edit_id">';
    $hidden.= '<input type="hidden" value="'.RABOTY_IMG.'" name="img_table">';
    $hidden_add_img = '<input type="hidden" value="'.RABOTY_IMG.'" name="add_input_img">';

    $submit_button = '<button type="submit" class="btn btn-default" id="button_add">Отправить</button>';
    $smarty->assign('legend', $legend4);
    $smarty->assign('add_id', $elem_id);
    $smarty->assign('add_input_id', 'table_add_img');
    $smarty->assign('add_input_class', 'class="tabImgJob"');
    $smarty->assign('button_add_input', "button_add_img");
    $smarty->assign('hidden_add_img', $hidden_add_img);
    $smarty->assign('submit_button', $submit_button);
    $add_input = $smarty->fetch('inner-tpl/edit-product/addInput.tpl');

    $smarty->assign('table', $table);
    $smarty->assign('method', $method);
    $smarty->assign('action', $action);
    $smarty->assign('add_input', $add_input);
    $smarty->assign('link', '');
    $add_elements = $smarty->fetch('inner-tpl/edit-product/addElement.tpl');
    $smarty->assign('legend', $legend3);
    $smarty->assign('formElements', $formElements);
    $smarty->assign('table', '');
    $smarty->assign('method', $method);
    $smarty->assign('action', $action);
    $smarty->assign('submenu_items', $images_items);
    $smarty->assign('hidden', $hidden);
    $smarty->assign('add_elements', $add_elements);
    $img_list = $smarty->fetch('inner-tpl/edit-product/imgList.tpl');

    //.................................main_img.................................................
    $legend_img = "Изображение иконка";

    //проверяем изображение на наличие
    //echo '<pre>';print_r($arr_img);echo '</pre>';
    foreach($arr_img as $key=>$value){
        $img = $value["img"];
        $alt = $value["alt"];
        $img_title = $value["img_title"];
    }
    $img_now = ' (текущее '.$img.')';
    $path_img = RABOTY.'/';
    $img = FindImg($img, $path_img, $table_current, $elem_id);
    $img = '<img src="'.HOME_URL.PATH_IMG.$path_img.$img.'" width="98px"/>';
    $name_del = 'delete';
    $name_img = 'addimg['.$elem_id.']';
    $name_alt = 'addimg[alt_'.$elem_id.']';
    $name_img_title = 'addimg[title_'.$elem_id.']';


    $smarty->assign('legend', $legend_img);
    $smarty->assign('img_now', $img_now);
    $smarty->assign('name_img', $name_img);
    $smarty->assign('name_alt', $name_alt);
    $smarty->assign('name_img_title', $name_img_title);
    $smarty->assign('alt', $alt);
    $smarty->assign('img_title', $img_title);
    $smarty->assign('img', $img);
    $smarty->assign('name_del', $name_del);
    $smarty->assign('img_id', $elem_id);
    $main_img = $smarty->fetch('inner-tpl/edit-product/editPhotoIcon.tpl');

    $action = 'action="'.ADMIN_PANEL.'/get_edit_'.RABOTY.'"';
    $mm_edit = '<input name="MM_edit" type="hidden"  value="MM_edit">';
    $smarty->assign('action', $action);
    $smarty->assign('legend', $legend);
    $smarty->assign('table', $table_current);
    $smarty->assign('rus', $rus);
    $smarty->assign('eng_block', '');
    $smarty->assign('h1_block', '');
    $smarty->assign('disabled', '');
    $smarty->assign('table_redact', '');
    $smarty->assign('table_redact2', '');
    $smarty->assign('main_img', $main_img);
    $smarty->assign('edit_id', $elem_id);
    $smarty->assign('link', $link);
    $smarty->assign('mm_edit', $mm_edit);
    $smarty->assign('type_button', 'type="submit"');
    $smarty->assign('method', 'method="POST"');
    $smarty->assign('menu_eng', '');
    $smarty->assign('img_list', $img_list);
    $block2 = $smarty->fetch('inner-tpl/edit-product/block2.tpl');


    $smarty->assign('txt', $txt);
    $smarty->assign('block1', '');
    $smarty->assign('block2', $block2);
    $html = $smarty->fetch('inner-tpl/edit-product/editMenu.tpl');
    return $html;

}
function get_edit_images(){
    $mysqli = M_Core_DB::getInstance();
    $error = '';
    $_SESSION['prevPage'] = $_SERVER['HTTP_REFERER'];//echo '<pre>'; print_r($_POST); echo '</pre>';
    if ((isset($_POST["Img_edit"])) && ($_POST["Img_edit"] == "Img_edit")){//echo '<pre>';print_r($_POST); echo '</pre>';
        if(isset($_POST["img_table"])){
            $input_tab_img = $_POST["img_table"];
        }

        //удаление отмеченных фото
        if(isset($_POST['del'])){
            if($input_tab_img == IMAGES_SERV){
                $dest = "services/catalog/";
                $destS = "services/small/";
            }
            if($input_tab_img == RABOTY_IMG){
                $dest = RABOTY."/big/";
                $destS = RABOTY."/small/";
            }
            else{
                $dest = "catalog/";
                $destS = "catalog/small/";
            }

            $del_array = $_POST['del'];

            $n = count($del_array); //echo '<pre>'; print_r($del_array); echo '</pre>';
            if($n){
                for($i=0; $i<$n; $i++){
                    $query = "SELECT img FROM ".$input_tab_img." WHERE id =".$del_array[$i];
                    $mysqli->_execute($query);
                    $row = $mysqli->fetch();
                    $file_name = $row['img'];
                    if($input_tab_img == IMAGES_SERV){
                        $file = './'.PATH_IMG_SERV_GLOB.$row['img'];
                        $fileS = './'.PATH_IMG_SERV_SMALL.$row['img'];
                    }
                    if($input_tab_img == RABOTY_IMG){
                        $file = './'.PATH_IMG_BIGR.$row['img'];
                        $fileS = './'.PATH_IMG_SMALLR.$row['img'];
                    }
                    else{
                        $file = './'.PATH_IMG_GLOB.$row['img'];
                        $fileS = './'.PATH_IMG_SMALL.$row['img'];
                    }

                    $hasAFile = FindFileStuct($file_name, PATH_IMG.$dest);
                    if($hasAFile && $file_name !="empty.jpg"){
                        unlink($file);
                    }
                    $hasAFile = FindFileStuct($file_name, PATH_IMG.$destS);
                    if($hasAFile && $file_name !="empty.jpg"){
                        unlink($fileS);
                    }
                }
                $key_del_array = implode( ',',$del_array);
                $query = 'DELETE FROM '.$input_tab_img.' WHERE id IN ('.$key_del_array.')';
                $mysqli->query($query);

            }
        }
        if(isset($_FILES['editfile']) || isset($_POST['editfile']))
        {//echo '<pre>'; print_r($_FILES); echo '</pre>';
            $editfile        = $_FILES['editfile'];
            $edit_key_alt    = $_POST['editfile'];
            $edit_id         = $_POST['edit_id'];
            if($input_tab_img == IMAGES_SERV){
                $all = '';
            }
            else{
                $all = 'all';
            }
            //echo '<pre>';print_r($editfile); echo '</pre>';
            //echo '<pre>';print_r($_POST); echo '</pre>';
            $edit_error = editIMG($editfile, $edit_id, $edit_key_alt, $input_tab_img, '', $all);
            $str = substr($edit_error, 0, 1);
            if(!$str){
                $str = substr($edit_error, 1);
                $error.=$str;
            }
        }

        if(!empty($error)){
            new Messages('error', '<ul>'.$error.'</ul>' );
        }
        else{
            new Messages('info', 'Изменения зафиксированы!');
        }
    }
    elseif(isset($_POST['add_input_img'])){
        $input_tab_img = $_POST["add_input_img"];
        $key             = $_FILES['addimg'];
        $key_alt         = $_POST['addimg'];
        $add_id              = $_POST['add_id'];
        // echo '<pre>';print_r($_POST); echo '</pre>';
        $put_error = putIMG($key, $add_id, $key_alt, $input_tab_img);
        $str = substr($put_error, 0, 1);
        if(!$str)
        {
            $str = substr($put_error, 1);
            $error.=$str;
        }
        if(!empty($error)){
            new Messages('error', '<ul>'.$error.'</ul>' );
        }
        else{

            new Messages('info', 'Изменения зафиксированы!');
        }
    }
    else{
        new Messages('error', 'Ошибка' );
    }
}
function get_edit_nashi_raboty(){
    $mysqli = M_Core_DB::getInstance();
    $GoTo = ADMIN_PANEL.'/'.RABOTY;
    //echo '<pre>'; print_r($_POST); echo '</pre>';
    $_SESSION['prevPage'] = $_SERVER['HTTP_REFERER'];
    if ((isset($_POST["MM_edit"])) && ($_POST["MM_edit"] == "MM_edit")){ //echo '<pre>';print_r($_POST);echo '</pre>';
        if(isset($_POST['rus'])){
            $rus = GetFormValue($_POST['rus']);
        }

        if(isset($_FILES['addimg'])){
            $file = $_FILES['addimg'];
        }
        if(isset($_POST['addimg'])){
            $keys = $_POST['addimg'];
        }
        if(isset($_POST['delete'])){
            $delete = $_POST['delete'];
        }
        if(isset($_POST['edit_id'])){
            $id = $_POST['edit_id'];
        }
        if(isset($_POST['img_id'])){
            $img_id = $_POST['img_id'];
        }
        if(isset($_POST['menu_eng'])){
            $menu_eng = $_POST['menu_eng'];
        }
        $error = '';
        $dest = RABOTY."/";
        $tab = RABOTY;
        $tab_img = RABOTY_IMG;

        if ( empty( $rus ) )
            $error = $error.'<li>не заполнено название позиции по-русски</li>'."\n";
        //if ( preg_match( "/[&$^%#*@!+=(){}:;\/]+$/ui",  $name) )
        //$error = $error.'<li>название содержит недопустимые символы (пробел, %, $ и т.д.)</li>'."\n";

        //удаление отмеченных фото иконок
        if(isset($_POST['delete']) && $_POST['delete'] == 'yes'){
            $query = "SELECT img FROM ".$tab." WHERE id =".$id;
            $mysqli->_execute($query);
            $row = $mysqli->fetch();
            $file_name = $row['img'];
            $file = './'.PATH_IMG_R.$row['img'];
            $hasAFile = FindFileStuct($file_name, PATH_IMG.$dest);
            if($hasAFile && $file_name !="empty.jpg")
            {
                unlink($file);
            }

            $img = 'empty.jpg';
            $query = sprintf("UPDATE ".$tab." SET img=%s WHERE id=%s",
                GetSQLValueString($img, "text"),
                GetSQLValueString($id, "int"));
            $mysqli->query($query);
        }
        else{
            if(isset($_FILES['addimg'])){
                //добавление изображения
                $edit_error = editIMG($file, $id, $keys, $tab);
                $str = substr($edit_error, 0, 1);
                if(!$str)
                {
                    $str = substr($edit_error, 1);
                    $error.=$str;
                }
            }
        }
        if(!empty($error)){
            //new Messages('error', '<ul>'.$error.'</ul>');

        }
        else{
            $query = sprintf("UPDATE ".$tab." SET title=%s   WHERE id=%s",
                GetSQLValueString($rus, "text"),
                GetSQLValueString($id, "int"));
            $mysqli->query($query);

            $GoTo = 'edit_'.RABOTY.'/'.$id;
            //new Messages('info', 'Изменения зафиксированы!', $GoTo);
        }
    }
    else{
        header("Location: ".$GoTo);
        exit;
    }
    return;
}
//редактирование разных таблиц
function edit_table($r){
    $mysqli = M_Core_DB::getInstance();
    access();
    access_rights($r);
    global $arResult;
    global $smarty;
    $GoTo = ADMIN_PANEL;
    $html = '';
    if(isset($arResult->POS1)){
        $id = $arResult->POS1;
    }
    else{
        header("Location: ".$GoTo);
    }
    if(isset($arResult->POS2)){
        $tab = $arResult->POS2;
    }
    else{
        header("Location: ".$GoTo);
    }
    if($tab == TABLE_ADMIN_USERS){

    }
    $query  = "SELECT name
	           FROM ".$tab."
			   WHERE id=".$id;
    $mysqli->_execute($query);
    $row = $mysqli->fetch();
    $back   = '<a href="'.ADMIN_PANEL.'/'.$tab.'" '.STYLE12.'>'.BACK_IMG.' назад</a>';
    $legend = $row["name"];
    $smarty->assign('back', $back);
    $smarty->assign('table', $tab);
    $smarty->assign('legend', $legend);
    $smarty->assign('name', $legend);
    $smarty->assign('id', $id);
    $smarty->assign('link', $_SERVER['REQUEST_URI']);
    $html = $smarty->fetch('inner-tpl/dif-tab/editTableAdmin.tpl');
    return $html;
}
function admin_info_site(){
    global $arResult;
    global $smarty;
    $mysqli = M_Core_DB::getInstance();
    $html = $content = $fieldset = '';
    $action = $arResult->ACTION;
    if($action == SCHET)
    {
        $table = SCHET;
        $query = "SELECT * FROM ".$table;
        try{
            $mysqli->_execute($query);
            if($mysqli->num_rows() > 0){
               while($row = $mysqli->fetch()){
                   $content = $row["content"];
                   $id      = $row["id"];
                   $legend = 'Счетчик '.$row["id"];
                   $smarty->assign('legend', $legend);
                   $smarty->assign('content', $content);
                   $smarty->assign('id', $id);
                   $fieldset.= $smarty->fetch('inner-tpl/dif-tab/schetFieldset.tpl');

               }

                $smarty->assign('fieldset', $fieldset);
                $smarty->assign('table', $table);
                $smarty->assign('link', $_SERVER['REQUEST_URI']);
                $html = $smarty->fetch('inner-tpl/dif-tab/editSchet.tpl');
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }



    }
    else{
        $table = TABLE_INFO;
        $query = "SELECT * FROM ".$table;
        $mysqli->_execute($query);
        if($mysqli->num_rows() > 0){
            $row = $mysqli->fetch();
            //echo '<pre>';print_r($row);echo '</pre>';
            $name    = $row["company_name"];
            $address = $row["company_address"];
            $phone   = $row["company_phone"];
            $phone_service = $row["company_phone_service"];
            $email   = $row["company_mail"];

        }
        $query = "SELECT * FROM ".SHADULE;
        $mysqli->_execute($query);
        if($mysqli->num_rows() > 0){
            while($row = $mysqli->fetch()){
                if($row["id"] == 1){
                    $shadule = $row["content"];
                }
                else{
                    $shadule1 = $row["content"];
                }
            }

        }
        $legend = 'Данные организации';

        if($arResult->Scripts['gerld'] == 'on'){
            $checked_gerld = 'checked="checked"';
        }
        else $checked_gerld = '';
        if($arResult->Scripts['effect'] == 'on'){
            $checked_effect = 'checked="checked"';
        }
        else $checked_effect = '';

        $smarty->assign('table', $table);
        $smarty->assign('legend', $legend);
        $smarty->assign('name', $name);
        $smarty->assign('phone', $phone);
        $smarty->assign('phone_service', $phone_service);
        $smarty->assign('shadule', $shadule);
        $smarty->assign('shadule1', $shadule1);
        $smarty->assign('email', $email);
        $smarty->assign('address', $address);
        $smarty->assign('checked_gerld', $checked_gerld);
        $smarty->assign('checked_effect', $checked_effect);
        $smarty->assign('link', $_SERVER['REQUEST_URI']);
        $html = $smarty->fetch('inner-tpl/dif-tab/editInfo.tpl');
    }
    return $html;
}