<?php


define('APP_NAME', 'blog-admin');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'].DS.APP_NAME); //$_SERVER['REMOTE_ADDR']
define('VIEW', ROOT.DS.'app/Views');
define('POST_ROUTE', $_SERVER['HTTP_HOST'].DS.'public');
define('GET_ROUTE', $_SERVER['HTTP_HOST'].DS.'public');

//header('Location: http://localhost/fb/cli');
require_once __DIR__.'/public/index.php';

?>
