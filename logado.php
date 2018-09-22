<?php 

require __DIR__.'/vendor/autoload.php';
use Components\Controllers\ControllerFirebaseSDK as fb;




?>

<!DOCTYPE html>
<html>
<head>
	<title>Logado</title>
</head>
<body>

	<h1><strong>Nome: </strong> <?php $userName ?> </h1>
	<a href="http://localhost/fb/server/index.php?action=exit"></a>
</body>
</html>