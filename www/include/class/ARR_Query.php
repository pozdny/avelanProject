<?php
class ARR_Query {
    public $ACTION;
    public $POS1;
    public $POS2;
    public $POS3;
    public $POS4;
    public $DATA = array(
        "Catalog" => array(),
        "AdminMenu" => array(),
        "TopMenu" => array(),
        "Services" => array(),
        "Raboty" => array()
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
    public $INFO_SITE = array();
    public $WRONGDATA = false;
    public $Scripts = array(
		'gerld' => 'off',
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

		if(isset($array_url[0]) && $array_url[0] !='')
		{
			$this->ACTION = $array_url[0];

		}
        if($this->ACTION !='' && $this->ACTION != 'admin'){
            if(sizeof($array_url) > 4){
                $this->WRONGDATA = true;
                return;
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
        //добавляем состав услуг в DATA
        $services = new Services();
        $this->DATA["Services"] = $services->Content;
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
                $this->POS1 = '';
                if(!isset($_SESSION['MM_Username'])){
                    $this->WRONGDATA = true;
                    return;
                }
            }
            if(isset($array_url[2]) && $array_url[2] != ''){
                $this->POS1 = $array_url[2];
                $this->POS2 = '';
            }
            if(isset($array_url[3]) && $array_url[3] != ''){
                $this->POS2 = $array_url[3];
                $this->POS3 = '';
            }
            if(isset($array_url[4]) && $array_url[4] != ''){
                $this->POS3 = $array_url[4];
                $this->POS4 = '';
            }
            if(isset($array_url[5]) && $array_url[5] != ''){
                $this->POS4 = $array_url[5];
                $this->POS5 = '';
            }
            $catalog = new Catalog();
            $this->DATA["Catalog"] = $catalog->Content;
            //echo '<pre>';print_r($this->DATA["Catalog"]);echo '</pre>';
            //добавляем состав верхнего меню в DATA
            $topmenu = new Menu('topmenu');
            $this->DATA["TopMenu"] = $topmenu->Content;
            //echo '<pre>';print_r($this->DATA["TopMenu"]);echo '</pre>';

            //добавляем состав работ в DATA
            $raboty = new Raboty();
            $this->DATA["Raboty"] = $raboty->Content;
            //echo '<pre>';print_r($this->DATA["Raboty"]);echo '</pre>';
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
        //добавляем состав TABLE_INFO в arResult
        $this->INFO_SITE = InfoSite::getInfo();
        //значения для гирлянды и эффектов
		$effect = new Effects();
        $this->Scripts["gerld"] = $effect->gerld;
        $this->Scripts["effect"] = $effect->effect;
	}
	function query( ) {
		$this->init();
	}
	function __construct() {		
			$this->query();		
	}
}

