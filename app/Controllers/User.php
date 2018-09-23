<?php 

namespace app\Controllers;


class User extends Errors{
	
	function __construct()	{
		
	}

	private $user_id = null;
	private $username = null;
	private $validated = false; //True = Valid and False = Invalid
	private $email = null;
	private $password = null;

	public function setUser_id ($user_id) {
		$this->user_id = $user_id;
	}

	public function setUsername ($username) {
		$this->username = $username;
	}

	public function setValidated ($validated) {
		$this->validated = $validated;
	}

	public function setEmail ($email) {
		$this->email = $email;
	}

	public function setPassword ($password) {
		$this->password = $password;
	}

	
	public function getUser_id () {
		return $this->user_id;
	}

	public function getUsername () {
		return $this->username;
	}

	public function getValidated () {
		return $this->validated;
	}

	public function getEmail () {
		return $this->email;
	}

	public function getPassword () {
		return $this->password;
	}

}
