<?php
/**
 * Created by PhpStorm.
 * User: Валентина
 * Date: 26.10.14
 * Time: 14:28
 */

class Services {
    public $Content;
    public function __construct(){
        $this->getContent();
    }

    private function getContent(){
        $mysqli = M_Core_DB::getInstance();
        $arr_services = null;
        $query = "SELECT * FROM ".SERVICES;
        try{
            $x = $mysqli->queryQ($query);
            if($mysqli->num_r($x) > 0){
                while($row = $mysqli->fetchAssoc($x)){
                    $arr_images = null;
                    $query = "SELECT * FROM ".IMAGES_SERV."
                              WHERE all_id= ".$row["id"]."
                              ORDER BY id ASC";
                    try{
                        $i = $mysqli->queryQ($query);
                        if($mysqli->num_r($i) > 0){
                            while($row_img = $mysqli->fetchAssoc($i)){
                                $arr_images[] = array(
                                    "id" => $row_img["id"],
                                    "img" => $row_img["img"],
                                    "all_id" => $row_img["all_id"],
                                    "alt" => $row_img["alt"],
                                    "img_title" => $row_img["img_title"]
                                );
                            }
                        }
                    }
                    catch(Exception $e){
                        echo $e->getMessage();
                    }
                    $arr_services[] = array(
                        "id" => $row["id"],
                        "title" => $row["title"],
                        "eng" => $row["eng"],
                        "content" => $row["content"],
                        "titlepage" => $row["titlepage"],
                        "keywords" => $row["keywords"],
                        "description" => $row["description"],
                        "Images" => $arr_images
                    );
                }
            }
            $this->Content = $arr_services;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }

} 