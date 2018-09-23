<?php 

	private $HOST_DB =  'localhost';
	private $USERNAME_DB = 'sec_user';
	private $PASSWORD_DB = 'eKcGZr59zAa2BEWU';
	private $NAME_DB = 'secure_login';

	public function connect () {
		$con = new mysqli ($this->HOST_DB, $this->USERNAME_DB, $this->PASSWORD_DB, $this->NAME_DB);
		/*if (mysqli_connect_error()) {
			exit("Erro ao Conectar com o BD");
		}*/
	}
	echo "conectando";
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Auth</title>
</head>
<body>
	<form method="post" action="index.php">
		<input type="text" name="tokenId" value="<?php echo $idToken; ?>" style="display: none;">
		<input type="text" name="sair" value="sair" style="display: none;">
		<button type="submit">Sair</button>
	</form>

</body>
</html>

