<?php 

namespace app\Controllers;

class Errors {
	
	function __construct() {
		
	}

	public $type = null;
	public $msg = array();

	public function setErrors ($msg) {
		array_push($this->msg, $msg);
	}

	public function setError_type ($type){
		$this->type = $type;
	}

	public function getErrors () {
		return $this;
	}

	public function print_errors (){
		var_dump($this->msg);
	}

	public function exist_errors (){
		if(empty($this->msg)):
			return false;
		else:
			return true;
		endif;
	}
}