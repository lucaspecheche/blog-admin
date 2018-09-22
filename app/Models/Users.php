<?php

namespace app\Models;
use app\DBConnect as DB;

class Users {
	
	function __construct() {
		$this->con = (new DB)->connect();
	}

	public function UserAuth ($post) {
		$login = mysqli_escape_string($this->con, $post['login']);
		$password = mysqli_escape_string($this->con, $post['password']);

		if (!empty($login) or !empty($password)) {
			$sql = "SELECT login FROM users WHERE login = '$login' ";
			$result = mysqli_query($this->con, $sql);

			if(mysqli_num_rows($result) > 0) {
				$sql = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
				$result = mysqli_query($this->con, $sql);

				if(mysqli_num_rows($result) == 1) {
					$dados = mysqli_fetch_array($result);
					echo $dados['name'];
					return $dados;
				} else {
					echo "Usuário e senha não conferem";
				}
			} else {
				echo "Usuario Não existe";
			}
		} else {
			echo "Os campos de Email ou Senha está vazio";
		}
	}
}