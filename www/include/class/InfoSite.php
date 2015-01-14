<?php
/**
 * Created by PhpStorm.
 * User: Валентина
 * Date: 13.03.14
 * Time: 13:32
 */

class InfoSite {

    public function __construct(){
            $this->getInfo();
    }
    public static function getInfo(){
        $mysqli = M_Core_DB::getInstance();
        $array = array();
        $query = "SELECT *
		          FROM ".TABLE_INFO;
        try{
            $mysqli->_execute($query);
            if($mysqli->num_rows() > 0){
                while($row = $mysqli->fetch()){
                    $array["name"]    = $row["company_name"];
                    $array["address"] = $row["company_address"];
                    $array["phone"]   = $row["company_phone"];
                    $array["phone_service"]   = $row["company_phone_service"];
                    $array["mail"]    = $row["company_mail"];
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
        $query = "SELECT *
		          FROM ".SHADULE;
        try{
            $mysqli->_execute($query);
            if($mysqli->num_rows() > 0){
                while($row = $mysqli->fetch()){
                    $array[$row["title"]]    = $row["content"];
                }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $array;
    }
    public static function getSessionId(){
        $mysqli = M_Core_DB::getInstance();
        $tab = 'info_site';
        $content = '';
        $query = "SELECT content FROM ".$tab." WHERE eng LIKE 'session_id'";
        $mysqli->_execute($query);
        if($mysqli->num_rows() > 0){
           $row = $mysqli->fetch();
           $content = $row["content"];

        }
        return $content;
    }
} 