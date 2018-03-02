<?php

	/** Add member login to Security table
	** @param: email, password
	** @author: Benaiah Morgan
	**/

	$dsn = 'localhost';
	$username = 'root';
	$dbpass = '';
	$db_name = 'db358933030'; 
	$conn = mysqli_connect($dsn, $username, $dbpass, $db_name) or die ("could not connect to mysql");

	function add_user($email, $password) {
		global $conn;
		$password= sha1($password);
		mysqli_query($conn, "INSERT INTO Security (email, password) VALUES ('$email', '$password')") or die(mysqli_error($conn));
	}

	/** Check login against Security table
	** @param: email, password
	** @return: member Id or -1 if not valid email and password
	** @author: Benaiah Morgan
	**/
	function is_valid_login($email, $password) {
		global $conn;
		$password = sha1($password);
		$sql = "SELECT memberId FROM Security WHERE emailAddress = '$email' AND password ='$password'";
		$result= mysqli_query($conn, $sql);          
		
		$counter = 0;
		$row;
		$memberId;
		while($row = mysqli_fetch_array($result)){
			$counter++;
			$memberId= $row["memberId"];
		}
		// check for only one match
		if($counter == 1) {
			return $memberId;
		}
		else 
			return -1;
	}
	
	/**	The purpose of this function is to return whether the given email exists in the Security table
	** @param: $email - The email address to look for in the Security table
	** @return: True or False if no match found
	** @author: Benaiah Morgan
	**/
	function is_existing_email($email) {
		global $conn;
		// Get the row(s) where the given email address exists in Security
		$result= mysqli_query($conn, "SELECT memberId FROM Security WHERE emailAddress = '$email'") or die(mysqli_error($conn));
		
		$counter = 0;
		$row;
		// while rows still exists in the query results
		while($row = mysqli_fetch_array($result)){
			// increase the number of rows by one
			$counter++;
		}
		// check for only one match (there should never be more than one)
		if($counter == 1) {
			// return true if there is a match
			return TRUE;
		}
		// otherwise return false
		else return FALSE;
	}
	

	/** Reset member password to randomly generated password
	** @param: email
	** @return: randomly generated password
	** @author: Benaiah Morgan
	**/
	function new_password($email) {
		$charArray = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','Q','X','Y','Z','!','@','#','%','^','&','*','(',')','-','_','=','+');
		
		$date_array = getdate();
		$sec = $date_array['seconds'];
		$char1 = $charArray[rand(0,76)];
		$char2 = $charArray[rand(0,76)];
		$char3 = $charArray[rand(0,76)];
		$char4 = $charArray[rand(0,76)];
		
		$p= $char1 . substr(uniqid(),0,5). $char2 . substr($sec,3,2) . $char3 . substr($email,3,2) . $char4 . rand(10, 99) . substr($day,0,2);
		
		return $p;
	}
?>