<?php
	/**
	* Volunteer logout
	* @author: Benaiah Morgan, Mindy Wise
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