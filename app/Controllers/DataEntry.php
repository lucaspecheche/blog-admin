<?php 

namespace app\Controllers;
use app\Controllers\Auth;

class DataEntry {
	
	function __construct($post, $get){
		if(isset($post['action'])) {
			switch ($post['action']) {
				case 'login':
					(new Auth())->login($post);
					break;
				
				default:
					echo "Post nao entendido";
					break;
			}
		} else {
			echo "O post não contem uma ação <br>";
		}
	}
}

