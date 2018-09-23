<?php

namespace app;

class DBConnect {

	function __construct () {

	}
	
	private $HOST_DB =  'localhost';
	private $USERNAME_DB = 'sec_user';
	private $PASSWORD_DB = 'eKcGZr59zAa2BEWU';
	private $NAME_DB = 'secure_login';

	public function connect () {
		$con = new \mysqli ($this->HOST_DB, $this->USERNAME_DB, $this->PASSWORD_DB, $this->NAME_DB);
		if (mysqli_connect_error()) {
			exit("Erro ao Conectar com o BD");
		}
		return $con;
	}


}