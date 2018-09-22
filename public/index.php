<?php 
require __DIR__.'/../vendor/autoload.php';

use app\Controllers\Session;
use app\Controllers\DataEntry;
use app\Constants;

new Constants();
new DataEntry($_POST, $_GET);
//echo "Print POST: <br>";
//require VIEW.DS.'admin/index.php';
//var_dump($_POST);

?>