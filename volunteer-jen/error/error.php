<?php
	/**
	* Error connecting to database. End session and redirect to error page. 
	* @author: Mindy Wise, Benaiah Morgan
	*/
	session_start();
	//force secure connection
	//require_once('secure_conn.php');
	
	//reset all session variables and end session
	$_SESSION= array();
	session_destroy();
	
	//redirect to error page
	header("Location: error.html");

?>