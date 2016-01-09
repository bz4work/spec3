<?php
class Test{
	private $_fname = array();
	private $_lname;
		
	function __set ($name, $value){
		switch ($name){
			case "first_name" : $this->_fname[$name] = $value;break;
			case "last_name" : $this->_lname[$name] = $value;break;
			default : echo "ERROR!";
		}
	}
	
	function __get ($name){
		switch ($name){
			case "first_name" : return $this->_fname ."<br>";break;
			case "last_name" : return $this->_lname ."<br>";break;
			default : echo "ERROR!";
		}
	}
}
?>