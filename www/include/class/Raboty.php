<?php
/**
 * Created by PhpStorm.
 * User: Валентина
 * Date: 27.10.14
 * Time: 17:14
 */

class Raboty {
    public $Content;
    public function __construct(){
        return $this->getContent();
    }

    private function getContent(){
        $mysqli = M_Core_DB::getInstance();
        $arr_raboty = null;
        $query = "SELECT * FROM ".RABOTY;
        try{
            $x = $mysqli->queryQ($query);
            if($mysqli->num_r($x) > 0){
                while($row = $mysqli->fetchAssoc($x)){
                    $arr_images = null;
                    $arr_img    = null;
                    $query = "SELECT * FROM ".RABOTY_IMG."
                              WHERE nashi_raboty_id= ".$row["id"]."
                              ORDER BY id ASC";
                    try{
                        $i = $mysqli->queryQ($query);
                        if($mysqli->num_r($i) > 0){
                            while($row_img = $mysqli->fetchAssoc($i)){
                                $arr_images[] = array(
                                    "id" => $row_img["id"],
                                    "img" => $row_img["img"],
                                    "nashi_raboty_id" => $row_img["nashi_raboty_id"],
                                    "alt" => $row_img["alt"],
                                    "img_title" => $row_img["img_title"],
                                    "description" => $row_img["description"]
                                );
                            }
                        }
                    }
                    catch(Exception $e){
                        echo $e->getMessage();
                    }
                    $arr_img[] = array(
                        "img"=> $row["img"],
                        "alt"=> $row["alt"],
                        "img_title"=> $row["img_title"]
                    );
                    $arr_raboty[] = array(
                        "id" => $row["id"],
                        "title" => $row["title"],
                        "img" => $arr_img,
                        "titlepage" => $row["titlepage"],
                        "keywords" => $row["keywords"],
                        "description" => $row["description"],
                        "Images" => $arr_images
                    );
                }
            }
            $this->Content = $arr_raboty;
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
} 