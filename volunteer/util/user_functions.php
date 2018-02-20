<?php

	/** Add member login to Security table
	** @param: email, password
	** @author: Benaiah Morgan
	**/
	function add_user($email, $password) {
		$password= sha1($password);
		mysql_query("INSERT INTO Security (email, password) VALUES ('$email', '$password')") or die(mysql_error());
	}

	/** Check login against Security table
	** @param: email, password
	** @return: member Id or -1 if not valid email and password
	** @author: Benaiah Morgan
	**/
	function is_valid_login($email, $password) {
		$password= sha1($password);
		$result= mysql_query("SELECT memberId FROM Security WHERE emailAddress = '$email' AND password = '$password'") or die(mysql_error());
		
		$counter = 0;
		$row;
		$memberId;
		while($row = mysql_fetch_array($result)){
			$counter++;
			$memberId= $row["memberId"];
		}
		// check for only one match
		if($counter == 1) {
			return $memberId;
		}
		else return -1;
	}
	
	/**	The purpose of this function is to return whether the given email exists in the Security table
	** @param: $email - The email address to look for in the Security table
	** @return: True or False if no match found
	** @author: Benaiah Morgan
	**/
	function is_existing_email($email) {
		// Get the row(s) where the given email address exists in Security
		$result= mysql_query("SELECT memberId FROM Security WHERE emailAddress = '$email'") or die(mysql_error());
		
		$counter = 0;
		$row;
		// while rows still exists in the query results
		while($row = mysql_fetch_array($result)){
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