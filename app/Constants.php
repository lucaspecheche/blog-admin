<?php 

namespace app;

/**
*
*/
class Constants {
	
	function __construct()
	{	
		define('PROJECT_NAME', 'blog-admin');
		define('DS', DIRECTORY_SEPARATOR);
		define('ROOT', $_SERVER['DOCUMENT_ROOT'].DS.PROJECT_NAME);
		define('PB', ROOT.DS.'public');
		define('CSS', 'public/css');
		define('JS', 'public/js');
		define('IMG', 'public/img');
		define('VIEW', ROOT.DS.'src/views');

	}
}

?>