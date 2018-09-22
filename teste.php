<?php 




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

