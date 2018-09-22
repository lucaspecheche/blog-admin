<?php
namespace Components\Controllers;
session_start(); 

use Components\Controllers\FirebaseSDK as FBSDK;

class Session {
	
	function __construct($token) {

		if (isset($_SESSION['auth'])  && $_SESSION['auth'] == true){
			header('Location: logado.php');
		} else {
			if (!empty($token)) {
				$user = (new FBSDK)->UserToken($token);
				var_dump($user);

				//$_SESSION['uid'] = $_POST['token'];
			} else {
				echo "Não foi possivel criar sua sessão";
			}
		}
	}
}



?>