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
        $this->getCatalog();
    }

    private function getCatalog(){
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

                                try{
                                    $arr_submenu[] = array(
                                        "id" => $row1["id"],
                                        "title" => $row1["title"],
                                        "h1" => $row1["h1"],
                                        "eng" => $row1["eng"],
                                        "content" => $row1["content"],
                                        "content2" => $row1["content2"],
                                        "titlepage" => $row1["titlepage"],
                                        "keywords" => $row1["keywords"],
                                        "description" => $row1["description"],
                                        "menu_id" => $row1["menu_id"]
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