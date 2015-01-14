<?php
/**
 * Created by PhpStorm.
 * User: Valunya
 * Date: 21.01.14
 * Time: 21:30
 */

class Catalog{
    public $Content;
    public function __construct(){
        $this->getContent();
    }

    private function getContent(){
        $mysqli = M_Core_DB::getInstance();
        $query = "SELECT * FROM ".CATALOG_MENU;
        try{
            $x = $mysqli->queryQ($query);
            if($mysqli->num_r($x) > 0){
                while($row = $mysqli->fetchAssoc($x)){
                    $arr_submenu = null;
                    $query = "SELECT * FROM ".CATALOG_SUBMENU."
                              WHERE menu_id= ".$row["id"];
                    try{
                        $t = $mysqli->queryQ($query);
                        if($mysqli->num_r($t) > 0){
                            while($row1 = $mysqli->fetchAssoc($t)){
                                $arr_all    = null;
                                $arr_img    = null;

                                $query = 'SELECT  DISTINCT '.CATALOG_ALL.'.id, '.CATALOG_ALL.'.title, '.CATALOG_ALL.'.h1, '.CATALOG_ALL.'.content, '.CATALOG_ALL.'.content2, '.CATALOG_ALL.'.eng, '.CATALOG_ALL.'.titlepage, '.CATALOG_ALL.'.keywords, '.CATALOG_ALL.'.description FROM '.CATALOG_ALL.'
							              INNER JOIN '.CATALOG_SUBMENU.' ON '.CATALOG_ALL.'.submenu_id = '.$row1['id'].'
							              ORDER BY '.CATALOG_ALL.'.id ASC';

                                try{
                                    $l = $mysqli->queryQ($query);
                                    if($mysqli->num_r($l) > 0){
                                        while($row2 = $mysqli->fetchAssoc($l)){
                                            $arr_images = null;
                                            $arr_desc   = null;
                                            if($row["eng"] == 'rashodnyye-materialy'){
                                                $query = "SELECT ".DESC.".id, ".DESC.".title, ".DESC.".price, ".DESC.".ed_izm, ".CATALOG_ALL.".title as all_title, ".CATALOG_ALL.".content
			                                              FROM ".DESC."
			                                              INNER JOIN ".CATALOG_ALL." ON ".CATALOG_ALL.".id = ".DESC.".all_id
			                                              INNER JOIN ".CATALOG_SUBMENU." ON ".CATALOG_ALL.".submenu_id = ".CATALOG_SUBMENU.".id
			                                              INNER JOIN ".CATALOG_MENU." ON ".CATALOG_SUBMENU.".menu_id = ".CATALOG_MENU.".id
			                                              WHERE ".DESC.".all_id =".$row2["id"]."
			                                              ORDER BY ".DESC.".title ASC";
                                                try{
                                                    $d = $mysqli->queryQ($query);
                                                    if($mysqli->num_r($d) > 0){
                                                        while($row3 = $mysqli->fetchAssoc($d)){
                                                            $arr_desc[] = array(
                                                                "id" => $row3["id"],
                                                                "title" => $row3["title"],
                                                                "price" => $row3["price"],
                                                                "ed_izm" => $row3["ed_izm"]
                                                            );
                                                        }
                                                    }
                                                }
                                                catch(Exception $e){
                                                    echo $e->getMessage();
                                                }
                                            }
                                            $query = 'SELECT '.TABLE_IMAGES.'.id, '.TABLE_IMAGES.'.img, '.TABLE_IMAGES.'.all_id, '.TABLE_IMAGES.'.alt, '.TABLE_IMAGES.'.img_title,
                                                      '.TABLE_IMAGES.'.line_id, '.MANUF.'.title as manuf_title, '.MANUF.'.id as manuf_id FROM '.TABLE_IMAGES.'
                                                      INNER JOIN '.MANUF.' ON '.MANUF.'.id = '.TABLE_IMAGES.'.line_id
                                                      WHERE '.TABLE_IMAGES.'.all_id = '.$row2["id"].'
                                                      ORDER BY '.TABLE_IMAGES.'.id';
                                            try{
                                                $i = $mysqli->queryQ($query);
                                                if($mysqli->num_r($i) > 0){
                                                    while($row_img = $mysqli->fetchAssoc($i)){
                                                        $arr_images[] = array(
                                                            "id" => $row_img["id"],
                                                            "img" => $row_img["img"],
                                                            "all_id" => $row_img["all_id"],
                                                            "alt" => $row_img["alt"],
                                                            "img_title" => $row_img["img_title"],
                                                            "line_id" => $row_img["line_id"]
                                                        );
                                                    }
                                                }


                                            }
                                            catch(Exception $e){
                                                echo $e->getMessage();
                                            }
                                            $arr_all[] = array(
                                                "id" => $row2["id"],
                                                "title" => $row2["title"],
                                                "h1" => $row2["h1"],
                                                "eng" => $row2["eng"],
                                                "content" => $row2["content"],
                                                "content2" => $row2["content2"],
                                                "titlepage" => $row2["titlepage"],
                                                "keywords" => $row2["keywords"],
                                                "description" => $row2["description"],
                                                "Desc" => $arr_desc,
                                                "Images" => $arr_images
                                            );
                                        }
                                    }
                                    $query = 'SELECT * FROM '.TABLE_IMAGES.' WHERE '.TABLE_IMAGES.'.all_id = '.$row1["id"].' LIMIT 1';
                                    $i = $mysqli->queryQ($query);
                                    $row_img = $mysqli->fetchAssoc($i);
                                    $arr_img[] = array(
                                        "id" => $row_img["id"],
                                        "img" => $row_img["img"],
                                        "all_id" => $row_img["all_id"],
                                        "alt" => $row_img["alt"],
                                        "img_title" => $row_img["img_title"]
                                    );
                                    $arr_submenu[] = array(
                                        "id" => $row1["id"],
                                        "title" => $row1["title"],
                                        "h1" => $row1["h1"],
                                        "eng" => $row1["eng"],
                                        "content" => $row1["content"],
                                        "titlepage" => $row1["titlepage"],
                                        "keywords" => $row1["keywords"],
                                        "description" => $row1["description"],
                                        "img" => $arr_img,
                                        "All" => $arr_all
                                    );
                                }
                                catch(Exception $e){
                                    echo $e->getMessage();
                                }
                            }
                        }
                        $arr_menu[] = array(
                            "id" => $row["id"],
                            "title" => $row["title"],
                            "h1" => $row["h1"],
                            "eng" => $row["eng"],
                            "content" => $row["content"],
                            "titlepage" => $row["titlepage"],
                            "keywords" => $row["keywords"],
                            "description" => $row["description"],
                            "img" => $row["img"],
                            "Submenu" => $arr_submenu
                        );
                        $this->Content = $arr_menu;
                    }
                    catch(Exception $e){
                        echo $e->getMessage();
                    }
                }
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

} 