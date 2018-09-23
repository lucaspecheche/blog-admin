<?php
namespace App\Controllers;

class Session {
	
	function __construct() {

		
	}

	public function create ($user) {
		$ip_address = $_SERVER['REMOTE_ADDR']; // Pega o endereço IP do usuário. 
    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Pega a string de agente do usuário.

    $user_id = preg_replace("/[^0-9]+/", "", $user->getUser_id()); // Proteção XSS conforme poderíamos imprimir este valor
    $_SESSION['user_id'] = $user->getUser_id(); 
    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user->getUsername()); // Proteção XSS conforme poderíamos imprimir este valor
    $_SESSION['username'] = $username;
    $_SESSION['login_string'] = hash('sha512', $user->getPassword().$ip_address.$user_browser);

    return true;
	}

	public function start () {
		$session_name = 'sec_session_id'; // Define um nome padrão de sessão
    $secure = false; // Defina como true (verdadeiro) caso esteja utilizando https.
    $httponly = true; // Isto impede que o javascript seja capaz de acessar a id de sessão. 

    ini_set('session.use_only_cookies', 1); // Força as sessões a apenas utilizarem cookies. 
    $cookieParams = session_get_cookie_params(); // Recebe os parâmetros atuais dos cookies.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
    session_name($session_name); // Define o nome da sessão como sendo o acima definido.
    session_start(); // Inicia a sessão php.
    session_regenerate_id(true); // regenerada a sessão, deleta a outra.;
	}

  public function get () {
    return array (
                  'user_id'      => $_SESSION['user_id'],
                  'login_string' => $_SESSION['login_string'],
                  'username'     => $_SESSION['username'],
                  'ip_address'   => $_SERVER['REMOTE_ADDR'],    // Pega o endereço IP do usuário
                  'user_browser' => $_SERVER['HTTP_USER_AGENT'] // Pega a string do usuário.
                );
  }

  public function existing () {
    if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])):
      return true;
    else:
      return false;
    endif;
  }

  public function delete_session () {
    // Zera todos os valores da sessão
    $_SESSION = array();
    // Pega os parâmetros da sessão 
    $params = session_get_cookie_params();
    // Deleta o cookie atual.
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    // Destrói a sessão
    session_destroy();
  }

}

