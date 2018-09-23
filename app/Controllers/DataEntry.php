<?php 

namespace app\Controllers;
use app\Controllers\Auth;

class DataEntry {
	
	function __construct(){
		$this->auth = new Auth;
	}

	public function entry ($post, $get) {
		if(isset($post['action'])) {
			switch ($post['action']) {

				case 'login':
					return $this->auth->login($post);
					break;

				case 'register':
					$register = $this->auth->register($post);
						if($register != false):
							$this->auth->login($register);
						endif;
					break;
				
				default:
					var_dump($post);
					echo "Post nao entendido";
					break;
			}
		}

		if(isset($get['action'])) {
			switch ($get['action']) {

				case 'sair':
					$this->auth->exit();
					header('Location: index.php');
					break;
				
				default:
					var_dump($get);
					echo "GET nao entendido";
					break;
			}
		}
		 
	}
}

