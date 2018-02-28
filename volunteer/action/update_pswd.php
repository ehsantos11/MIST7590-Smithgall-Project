<?php
	/**
	** Validate current email and update new password - Action page of change password form
	** @author: Benaiah Morgan, Mindy Wise
	**  
	**/
	// start session and include functions
	session_start();
	require_once('../util/secure_conn.php');
	require_once('../util/database_connect.php');
	require_once('../util/valid_user.php');
	
	//get change password form data, escape all html, limit characters
	$currentPassword = htmlentities(substr($_POST["currentPassword"],0,60), ENT_QUOTES);
	$currentPassword = sha1($currentPassword);
	$password = htmlentities(substr($_POST["password"],0,60), ENT_QUOTES);
	$password = sha1($password);
	$memberId= (int) $_SESSION['memberId'];
	//Validate current password
	$result = mysqli_query("SELECT password FROM Security WHERE memberId = $memberId") or die (mysqli_error());
	$result = mysqli_fetch_array( $result );
	
	//password not valid
	if($currentPassword != $result[password]) {
		header("Location: ../change_pswd.php?badpswd=true");
	}
	
	//update database with new password
	else {
		mysqli_query("UPDATE Security SET password = '$password' WHERE memberId = $memberId")	or die('Error: '.mysqli_error());
		session_regenerate_id(true);
		header("Location: ../change_pswd.php?goodpswd=true");			
	}
			
?>

