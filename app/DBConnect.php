<?php

namespace app;

class DBConnect {
	
	function __construct() {
		$this->HOST_DB =  'localhost';
		$this->USERNAME_DB = 'lucas';
		$this->PASSWORD_DB = 'pecheche17';
		$this->NAME_DB = 'blog-admin';
	}

	public function connect () {
		$con = mysqli_connect($this->HOST_DB, $this->USERNAME_DB, $this->PASSWORD_DB, $this->NAME_DB);
		if (mysqli_connect_error()) {
			exit("Erro ao Conectar com o BD");
		}
		return $con;
	}


}