<?php

namespace app\Controllers;
use app\Controllers\Session;
use app\Models\Users;

/**
* 
*/
class Auth {
	
	function __construct() {
		
	}

	public function login ($post) {
		$user = new Users();
		$user->UserAuth($post);
		echo "dados autenticados";
	}
}