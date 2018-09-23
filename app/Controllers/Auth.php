<?php

namespace app\Controllers;
use app\Controllers\Session;
use app\Models\Users;
use app\DBConnect as DB;

class Auth {

	function __construct () {
		$this->session = new Session;
	}

	public function login ($post) {
		$user = (new Users())->user_login($post);

		if ($user->getValidated()):
			$this->session->create($user);
      		return $user;
		else:
			//$user->print_errors();
			echo "<br> Não foi possivel efetuar o login";
			return $user;
		endif;
	}

	public function check () {
		return (new Users)->session_check();
	}

	public function exit () {
		$this->session->delete_session();
	}

	public function register ($post) {
		$db = (new DB)->connect();

		$username = $post['name'];
		$email = $post['email'];
		$password = hash('sha512', $post['password']);

		// Cria um salt randômico
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		// Cria uma senha pós hash (Cuidado para não re-escrever)
		$password = hash('sha512', $password.$random_salt);

		// Adicione sua inserção ao script de base de dados aqui 
		// Certifique-se de utilizar declarações preparadas
		if ($insert_stmt = $db->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {    
		   $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt); 
		   // Execute a query preparada.
		   $insert_stmt->execute();
		   if($insert_stmt->affected_rows > 0):
		   	echo "Maior de 0";
				return $post;
			else:
				return false;
			endif; 
		}
	}
}