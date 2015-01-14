<?php

class Menu
{
	public $data;
}

class Data_menu
{
	public $id;
	public $title;
}
class Submenu
{
	public $data;
}
class Data_submenu
{
	public $id;
	public $title;
	public $menu_id;
}
class All
{
	public $data_all;
}
class Data_all
{
	public $id;
	public $title;
	public $submenu_id;
}
class Description
{
	public $data;
}
class Data_description
{
	public $id;
	public $title;
	public $price;
	public $ed_izm;
	public $all_id;
}
class structDocument
{
	public $errorText;
	private $dom;
	
	public function loadStruct($in_file)
	{
		$this->dom=new DOMDocument();
		$this->dom->preserveWhiteSpace=FALSE;
		$result = $this->dom->load($in_file);
		if($result === FALSE)
		{	
			throw new CantLoadOrdersException();
		}
		else
			return TRUE;
	}
	public function getAllTab(&$out_tabList, $tab_name)
	{
		
		$tabNode = $this->dom->documentElement;
		$List_manuf = array();
		$List_purpose = array();
		$List_menu = array();
		$List_submenu = array();
		$List_all = array();
		$List_desc = array();
		foreach($tabNode->childNodes as $childNode)
		{
			$obj_name = $childNode->localName;
			switch($obj_name)
			{
				case 'menu':
				$elem = $this->loadMenu($childNode);
				$List_menu[] = $elem;
				if($obj_name == $tab_name)
				{
					$out_tabList = $List_menu;
					return $out_tabList;
				}
				break;
				case 'submenu':
				$elem = $this->loadSubmenu($childNode);
				$List_submenu[] = $elem;
				if($obj_name == $tab_name)
				{
					$out_tabList = $List_submenu;
					return $out_tabList;
				}
				break;
				case 'catalog_all':
				$elem = $this->loadAll($childNode);
				$List_all[] = $elem;
				if($obj_name == $tab_name)
				{
					$out_tabList = $List_all;
					return $out_tabList;
				}
				break;
				case 'description':
				$elem = $this->loadDescription($childNode);
				$List_desc[] = $elem;
				if($obj_name == $tab_name)
				{
					$out_tabList = $List_desc;
					return $out_tabList;
				}
				break;
			}
		}
		
	}
	
	private function loadMenu($in_dataNode)
	{
		
		$elem = new Menu();
		$arrayList = array();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Data':
				$elem->data=$this->loadData_menu($childNode);
				$arrayList[] = $elem->data;
				break;
			}
		}
		$elem->data = $arrayList;
		return $elem;
	}
	private function loadData_menu($in_dataNode)
	{
		$data = new Data_menu();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Id':
				$data->id=$childNode->textContent;
				break;
				case 'Title':
				$data->title=$childNode->textContent;
				break;
			}
		}
		return $data;
	}
	private function loadSubmenu($in_dataNode)
	{
		
		$elem = new Submenu();
		$arrayList = array();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Data':
				$elem->data=$this->loadData_submenu($childNode);
				$arrayList[] = $elem->data;
				break;
			}
		}
		$elem->data = $arrayList;
		return $elem;
	}
	private function loadData_submenu($in_dataNode)
	{
		$data = new Data_submenu();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Id':
				$data->id=$childNode->textContent;
				break;
				case 'Title':
				$data->title=$childNode->textContent;
				break;
				case 'Menu_id':
				$data->menu_id=$childNode->textContent;
				break;
			}
		}
		return $data;
	}
	private function loadAll($in_dataNode)
	{
		
		$elem = new All();
		$arrayList = array();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Data':
				$elem->data=$this->loadData_all($childNode);
				$arrayList[] = $elem->data;
				break;
			}
		}
		$elem->data = $arrayList;
		return $elem;
	}
	private function loadData_all($in_dataNode)
	{
		$data = new Data_submenu();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Id':
				$data->id=$childNode->textContent;
				break;
				case 'Title':
				$data->title=$childNode->textContent;
				break;
				case 'Submenu_id':
				$data->submenu_id=$childNode->textContent;
				break;
				
			}
		}
		return $data;
	}
	private function loadDescription($in_dataNode)
	{
		
		$elem = new Description();
		$arrayList = array();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Data':
				$elem->data=$this->loadData_desc($childNode);
				$arrayList[] = $elem->data;
				break;
			}
		}
		$elem->data = $arrayList;
		return $elem;
	}
	private function loadData_desc($in_dataNode)
	{
		$data = new Data_description();
		foreach($in_dataNode->childNodes as $childNode)
		{
			switch($childNode->localName)
			{
				case 'Id':
				$data->id=$childNode->textContent;
				break;
				case 'Title':
				$data->title=$childNode->textContent;
				break;
				case 'Price':
				$data->price=$childNode->textContent;
				break;
				case 'Ed_izm':
				$data->ed_izm=$childNode->textContent;
				break;
				case 'All_id':
				$data->all_id=$childNode->textContent;
				break;
				
			}
		}
		return $data;
	}
}


?>