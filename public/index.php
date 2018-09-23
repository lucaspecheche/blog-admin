<?php 
require __DIR__.'/../vendor/autoload.php';

use app\Controllers\Session;
use app\Controllers\DataEntry;
use app\Controllers\Auth;

$session = (new Session)->start();

$data_entry = (new DataEntry)->entry($_POST, $_GET);

$auth = (new Auth)->check();

if($auth):
	require_once VIEW.DS.'admin/index.php';
else:
	require_once VIEW.DS.'login/login.php';
endif;

if(empty($data_entry)):
	//require VIEW.DS.'login/login.php';
endif;

//echo POST_ROUTE;

//require VIEW.DS.'admin/index.php';
