<?php


namespace Modules\Crawler\Model;



class AnchorsAway {


	public $id;

	public $plunder; 

	public $trash; 

	public $return = array();

	function __construct(){
		$this->id = rand(100,1000000);
	}

	function __set($plunder,$trash){
		$this->plunder = $plunder;
		$this->trash = $trash;
	}

	
}