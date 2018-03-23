<?php
	/**
	* Volunteer logout
	* @author: Woodland Rangers, March 2018
	*/
	session_start();
	//force secure connection
	require_once('util/secure_conn.php');
	
	//reset all session variables and end session
	$_SESSION= array();
	session_destroy();
	
	//redirect to login page
	header("Location: index.php?logout=true");
?>