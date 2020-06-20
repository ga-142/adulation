<?php

namespace Modules\Adulation\Model;

class Adulator {
	/**
	* Adulator id variable
	* @var int
	*/
    public $id = "Random ID";
	/**
	* Adulator args variable
	* @var array()
	*/
    public $args = "Input Arguments";
	/**
	* Adulator trash variable
	* @var array()
	*/
    //public $trash = "Trash Pile";

	function __construct(){
		$this->id = rand(100,1000000);
	}
	/*
	function __set($args,$trash){
		$this->args = $args;
		$this->trash = $trash;

	}*/

	public function validatorString($key='String',$value=null,$min=0,$max=256) {
		if(is_null($value)) {
			$error = "Invalid $key.";
			if($min > 0)
				$error .= " $key must be between $min and $max characters";
			else
				$error .= " $key may contain no more than $max characters";
			$error .= " and contain at least 1 letter";
			return $error;
		} else {
			if($min == 0 && strlen($value) == 0)
				return 1;
			else {
				$min_value = preg_replace("/\s/", "", $value);
				return (is_string($value) || is_numeric($value)) && strlen($min_value) >= $min && strlen($value) <= $max && preg_match("/[a-zA-Z0-9]/", $value) ? 1 : 0;
			}
		}
	}
	
	//validator Binary
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorBinary($key='Binary',$value=null) {
		if(is_null($value)) {
			$error = "Invalid input for $key. Input must be binary.";
			return $error;
		} else {
			return $value == 0 || $value == 1 ? 1 : 0;
		}
	}
	
	//validator Zipcode
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorZipcode($key='Zipcode',$value=null) {
		if(is_null($value)) {
			$error = "Invalid $key.";
			return $error;
		} else {
			return strlen($value) == 0 || preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $value) ? 1 : 0;
		}
	}
	
	//validator Date
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorDate($key='Date',$value=null) {
		if(is_null($value)) {
			$error = "Invalid $key.";
			return $error;
		} else {
			return strtotime($value) != 0 ? 1 : 0;
		}
	}
	
	//validator Slug
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorSlug($key='Slug',$value=null) {
		if(is_null($value)) {
			$error = "Invalid $key. Slug must begin alphanumerically and be no more than 250 alphanumeric characters including dashes.";
			return $error;
		} else {
			return preg_match("/^[a-zA-Z0-9][-a-zA-Z0-9]{0,249}$/", $value) ? 1 : 0;
		}
	}
	
	//validator Number
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorWholeNumber($key='Whole Number',$value=null,$min=null,$max=null) {
		if(is_null($value)) {
			$error = "Invalid $key. Must be numeric";
			if(!is_null($min) && !is_null($max))
				$error .= " and between $min and $max.";
			elseif(!is_null($min))
				$error .= " and greater than or equal to $min.";
			elseif(!is_null($max))
				$error .= " and less than or equal to $max.";
			else
				$error .= ".";
			return $error;
		} else {
			if(is_numeric($value) && floor($value) == $value) {
				if(!is_null($min) && !is_null($max))
					return $value >= $min && $value <= $max ? 1 : 0;
				elseif(!is_null($min))
					return $value >= $min ? 1 : 0;
				elseif(!is_null($max))
					return $value <= $max ? 1 : 0;
			} else
				return 0;
		}
	}
	
	//validator Username
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorUsername($key='Username',$value=null) {
		if(is_null($value))
			return "$key invalid. $key must be 3-50 characters, must contain 1 letter, may only contain letters, numbers, -, _, @ and .";
		else
			return preg_match('/(?=.*[A-Za-z])[0-9A-Za-z@\.\-_]{3,50}$/', $value) ? 1 : 0;
	}
	
	//validator Password
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorPassword($key='Password',$value=null) {
		if(is_null($value))
			return "$key invalid. $key must be between 8-72 characters, must contain 1 letter, must contain 1 number.";
		else
			return preg_match('/(?=.*\d)(?=.*[a-zA-Z])[\w\W]{8,72}$/', $value) ? 1 : 0;
	}
	
	//validator Email
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorEmail($key='Email',$value=null) {
		if(is_null($value))
			return "$key invalid.";
		return strlen($value) < 255 && filter_var($value, FILTER_VALIDATE_EMAIL) ? 1 : 0;
	}
	
	//validator Phone
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorPhone($key='Phone',$value=null) {
		if(is_null($value))
			return "$key invalid.";
		return strlen($value) < 20 && !preg_match('/[^\+\d-\(\)\s]+/', $value) ? 1 : 0;
	}
	
	//validator Url
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorUrl($key='Url',$value=null) {
		if(is_null($value))
			return "$key invalid.";
		return strlen($value) < 2083 && !filter_var($value, FILTER_VALIDATE_URL) === false ? 1 : 0;
	}
	
	//validator Currency
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorCurrency($key='Currency',$value=null) {
		if(is_null($value))
			return "$key invalid.";
		return strlen($value) < 10 && preg_match('/^-?\d+\.\d{2}$/', $value) ? 1 : 0;
	}
	
	//validator Text
	//input string $key, string/null $value
	//return error with null $value, binary with $value input
	public function validatorText($key='Text',$value=null,$min=0,$max=null) {
		if(is_null($value))
			return "$key invalid.";
		return strlen($value) >= $min && (is_null($max) || strlen <= $max) ? 1 : 0;
	}


	

}

?>