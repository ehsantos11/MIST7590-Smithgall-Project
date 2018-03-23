<?php
	/**
	** Validate email and password - Action page of login form
	** @author: Woodland Rangers, March 2018
	**/

	// start session and include functions
	session_start();
	require_once('../util/secure_conn.php');
	require_once('../util/database_connect.php');
	require_once('../util/user_functions.php');

	
	//get login form data, escape all html, limit characters
	$email = htmlentities(substr($_POST['email'],0,200), ENT_QUOTES);
	$password = htmlentities(substr($_POST['password'],0,200), ENT_QUOTES);
	
	//login valid redirect to addhours
	if(is_valid_login($email, $password) != -1) {
		$_SESSION['memberId'] = is_valid_login($email, $password);
		$_SESSION['is_valid_user'] = true;
		//create new sessionID	
		session_regenerate_id(true);
		header("Location: ../add_hours.php");
	}
	//login invalid
	else {
		header("Location: ../index.php?badlogin=true");
	}
	
?>
	