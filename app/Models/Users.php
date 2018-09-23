<?php

namespace app\Models;
use app\Controllers\Session;
use app\Controllers\User;
use app\DBConnect as DB;


class Users {
	
	function __construct() {
		$this->con = (new DB)->connect();
		$this->user = new User;
	}

	public function user_login ($post) {
		$email = $post['email'];
		$password = hash('sha512', $post['password']);

		if ($stmt = $this->con->prepare("SELECT id, username, password, salt FROM members WHERE email = ? LIMIT 1")) { 
	        $stmt->bind_param('s', $email); // Vincula "$email" ao parâmetro.
	        $stmt->execute(); // Executa a query preparada.
	        $stmt->store_result();
	        $stmt->bind_result($user_id, $username, $db_password, $salt); // obtém variáveis do resultado.
	        $stmt->fetch();

	        $password = hash('sha512', $password.$salt); // confere o hash de "$password" e "$salt"

	        if($stmt->num_rows == 1) { // se o usuário existe

	         // Nós checamos se a conta está bloqueada devido a várias tentativas de login
	         	if($this->checkbrute($user_id) == true) { 
	            	// Conta está bloqueada
	            	$this->user->setErrors("Você tentou entrar muitas vezes, aguarde por 2h e tente novamente");
	         	} else {

		        	if($db_password == $password) { // Checa se a senha na base de dados confere com a senha que o usuário digitou. 
		            	// Senha está correta!
		        		$this->user->setUser_id($user_id);
		        		$this->user->setUsername($username);
		        		$this->user->setPassword($password);
		        		$this->user->setValidated(true);
		            	
		         	} else {
		         		$this->user->setErrors("Senha não está correta");
		            	// Senha não está correta
		            	// Nós armazenamos esta tentativa na base de dados
		            	$now = time();
		            	$this->con->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
		         	}
	      		}
	      	} else {
	      		$this->user->setErrors("Nenhum usuário existe");
	    	}
	    }
		return $this->user;    
	}

	public function checkbrute($user_id) {
	   // Retorna a data atual
	   $now = time();
	   // Todas as tentativas de login são contadas pelas 2 últimas horas. 1537664400
	   $valid_attempts = $now - (2 * 60 * 60); 

	   if ($stmt = $this->con->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
	      	$stmt->bind_param('i', $user_id); 
	      	// Executa a query preparada.
	      	$stmt->execute();
	      	$stmt->store_result();
	      	// Se houver mais de 5 tentativas falhas de login

	      	if($stmt->num_rows > 5):
	      		return true;
	      	else:
	      		return false;
	      	endif;
	   }
	}

	public function session_check () {
		$session = new Session;

		if($session->existing()) {
			$data = $session->get();

			if ($stmt = $this->con->prepare("SELECT password FROM members WHERE id = ? LIMIT 1")) { 
				$stmt->bind_param('i', $data['user_id']); // Atribui "$user_id" ao parâmetro
				$stmt->execute(); // Executa a tarefa atribuía
				$stmt->store_result();

				if($stmt->num_rows == 1) { // Caso o usuário exista
					$stmt->bind_result($password); // pega variáveis a partir do resultado
					$stmt->fetch();
					$login_check = hash('sha512', $password.$data['ip_address'].$data['user_browser']); //$login_check = hash('sha512', $password.$ip_address.$user_browser);
					if($login_check == $data['login_string']) {
					  	// Logado!!!
					 	return true;
					} else {
					  // Não foi logado
					  return false;
					}
				} else {
				// Não foi logado
				return false;
				}
			} else {
			// Não foi logado
			return false;
			}
		} else {
		// Não foi logado
		return false;
		}
	}
}