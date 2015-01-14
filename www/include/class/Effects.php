<?php
/**
 * Created by PhpStorm.
 * User: Valunya
 * Date: 21.01.14
 * Time: 21:30
 */

class Effects{
    public $gerld;
    public $effect;
    public function __construct(){
        $this->getContent();
    }
    private function getContent(){
        $mysqli = M_Core_DB::getInstance();
        $query = "SELECT value FROM ".OPTIONS." WHERE title LIKE 'gerld'";
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $this->gerld = $row["value"];

        $query = "SELECT value FROM ".OPTIONS." WHERE title LIKE 'effect'";
        $mysqli->_execute($query);
        $row = $mysqli->fetch();
        $this->effect = $row["value"];
    }
} 