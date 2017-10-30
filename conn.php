<?php 
// php securty 
//step 1 databse var should be constants  


define('DB_HOST', 'localhost'); // database  server 
define('DB_USER', 'root'); // database user
define('DB_PASS', '');  // database password 
define('DB_NAME', 'todo'); // databsae name 
define('DSN', 'mysql:host='.DB_HOST.';dbname=' . DB_NAME);


$option = array( // some addtional  options 
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	// utf8 unicode to support all the languages such as the arabic 
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	// hide some errors and make it's waring not error 

	);
try {

	$conn = new PDO(DSN,DB_USER, DB_PASS,$option);
}  catch(PDOException $e) {

	echo "ERROR "  . $e->getmessage(); 
	exit();
}

