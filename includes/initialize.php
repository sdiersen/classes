<?php
	ob_start();

	session_start();

	define("DS", DIRECTORY_SEPARATOR);

	define("INCLUDE_PATH", dirname(__FILE__));
	define("PROJECT_PATH", dirname(INCLUDE_PATH));
	define("DBASE_PATH", INCLUDE_PATH . DS . 'dbase');
	define("SHARED_PATH", INCLUDE_PATH . DS . 'shared');
	define("PUBLIC_PATH", PROJECT_PATH . DS. 'public');
	define("JS_PATH", PUBLIC_PATH . DS . 'js');
	define("CSS_PATH", PUBLIC_PATH . DS . 'css');


	// Assign the root URL to a PHP constant
	// * Do not need to include the domain
	// * Use same document root as webserver
	// * Can set a hardcoded value:
	// define("WWW_ROOT", '/~kevinskoglund/globe_bank/public');
	// define("WWW_ROOT", '');
	// * Can dynamically find everything in URL up to "/public"
	$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 8;
	$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
	define("WWW_ROOT", $doc_root);

	//base functionality
	require_once(SHARED_PATH . DS . 'validation_functions.php');
	require_once(SHARED_PATH . DS . 'functions.php');
	
	//database files
	require_once(DBASE_PATH . DS . 'table_defines.php');
	require_once(DBASE_PATH . DS . 'config.php');
	require_once(DBASE_PATH . DS . 'database.php');
	require_once(DBASE_PATH . DS . 'query_functions.php');
	require_once(DBASE_PATH . DS . 'verification.php');


	//The database
	$db = db_connect();
	$errors = array();

?>