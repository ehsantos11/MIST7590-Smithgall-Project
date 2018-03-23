<?php
	/**
	* Error connecting to database. End session and redirect to error page. 
	* @author: Woodland Rangers, March 2018
	*/
	session_start();
	//force secure connection
	//require_once('../util/secure_conn.php');
	
	//reset all session variables and end session
	$_SESSION= array();
	session_destroy();
	
	//redirect to error page
	header("Location: error.html");

?>