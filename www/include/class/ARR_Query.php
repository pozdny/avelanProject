<?php
class ARR_Query {
    public $ACTION;
    public $POS1;
    public $POS2;
    public $POS3;
    public $POS4;
    public $DATA = array(
        "AdminMenu" => array()
    );
    public $PAGE_NUM;
    public $PAGE_NUM_BACK;
    public $save_code = '';
    public $UsernameEnter = array(
        "enter" => "",
        "name"  => "",
        "last_date" => "",
        "group" => ""
    );
    public $WRONGDATA = false;
    public $Scripts = array(
		'girld' => 'off',
		'effect' => 'off'
	);

	function init() {
        $result = $_SERVER['REQUEST_URI']; //print_r($result) ;
        if (preg_match ("/([^a-zA-Z0-9\.\/\-\_\#\?\=])/", $result)) {
            $this->WRONGDATA = true;
            return;
        }
        $resultArray = preg_split("/(\/)/", $result, -1, PREG_SPLIT_NO_EMPTY);//echo '<pre>';print_r($resultArray);echo '</pre>';
        $array_url = array();

        $array_url = $resultArray;
        if(sizeof($array_url) > 4){
           $this->WRONGDATA = true;
           return;
        }
		if(isset($array_url[0]) && $array_url[0] !='')
		{
			$this->ACTION = $array_url[0];

		}
        if (preg_match("/admin-panel/i", $this->ACTION)) {
            $resultArray = preg_split("/(\?)/", $this->ACTION, -1, PREG_SPLIT_NO_EMPTY);
            $array_url = array();
            $array_url = $resultArray;//echo '<pre>';print_r($resultArray);echo '</pre>';

            $this->ACTION = $array_url[0];
            if(isset($array_url[1]) && $array_url[1] != ''){
                $this->save_code = $array_url[1];
            }
        }
        if($this->ACTION !='' && $this->ACTION == 'admin'){  // .............................админ панель
            if(isset($array_url[1]) && $array_url[1] != ''){
                $this->ACTION = $array_url[1];
            }
            if(isset($array_url[2]) && $array_url[2] != ''){
                $this->POS1 = $array_url[2];
            }
            if(isset($array_url[3]) && $array_url[3] != ''){
                $this->POS2 = $array_url[3];
            }
            if(isset($array_url[4]) && $array_url[4] != ''){
                $this->POS3 = $array_url[4];
            }

        }
        if(isset($array_url[1]) && $array_url[1] !='')
		{
			$this->POS1 = $array_url[1];
            if($this->ACTION == 'services' && sizeof($array_url) > 2){
                $this->WRONGDATA = true;
                return;
            }
            elseif(($this->ACTION == 'nashi_raboty' && sizeof($array_url) > 2) || ($this->ACTION == 'nashi_raboty' && !intval($this->POS1))){
                $this->WRONGDATA = true;
                return;
            }
		}
        if(isset($array_url[2]) && $array_url[2] !='')
		{
			$this->POS2 = $array_url[2];
		}
        if(isset($array_url[3]) && $array_url[3] !='')
		{
			$this->POS3 = $array_url[3];
		}
        if(isset($array_url[4]) && $array_url[4] !='')
		{
			$this->POS4 = $array_url[3];
		}
		if (isset($_GET['page']))
		{
			$this->PAGE_NUM = $_GET['page'];
		}
		if(isset($_SESSION['pageNum_back']))
		{
			$this->PAGE_NUM_BACK = $_SESSION["pageNum_back"];
		}
        //autorization
        if(isset($_SESSION['MM_Username']) && $_SESSION["MM_Username"]!=''){
            $this->UsernameEnter["enter"] = 'Y';
            $this->UsernameEnter["name"] = $_SESSION["MM_Username"]["name"];
            if(isset($_SESSION["last_visit"]) && $_SESSION["last_visit"] !=''){
                $this->UsernameEnter["last_date"] = $_SESSION["last_visit"]["last_visit"];
            }
            $this->UsernameEnter["group"] = $_SESSION["MM_Username"]["rights"];
            //добавляем состав левого меню в DATA
            $adminmenu = new Menu('leftmenu', $this->UsernameEnter["group"]);
            $this->DATA["AdminMenu"] = $adminmenu->Content;
        }

        //girld
		/*$query = "SELECT option_value FROM ".OPTIONS." WHERE option_name LIKE 'gerld'";
		$k = mysql_query($query) or die(mysql_error());
		$row_k = mysql_fetch_assoc($k);
		$girld = $row_k['option_value'];
		$query = "SELECT option_value FROM ".OPTIONS." WHERE option_name LIKE 'effect'";
		$k = mysql_query($query) or die(mysql_error());
		$row_k = mysql_fetch_assoc($k);
		$effect = $row_k['option_value'];
		$this->Scripts["girld"] =  $girld;
		$this->Scripts["effect"] = $effect;*/
	}
	function query( ) {
		$this->init();
	}
	function __construct() {		
			$this->query();		
	}
}

