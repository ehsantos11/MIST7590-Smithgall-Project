<?php
	//LOGIN CREDENTIALS
	error_reporting(0);
	set_error_handler("doerrorstuff");
	$dsn = 'db2846.perfora.net';
	$username = 'bad';
	$password = 'data';
	$db_name = 'db358933030';
	
	//MySQL Connection 
	mysql_connect($dsn, $username, $password) or doerrorstuff();
	mysql_select_db($db_name) or doerrorstuff();
	
	function doerrorstuff($errno, $errstr) {
		error_log("Error: [$errno] $errstr",1, "Benaiah.Morgan@gmail.com","From: webmaster@example.com");
		die();
		echo "<script>self.location = '../error/error.php'</script>";
	}	
?>