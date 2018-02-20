<?php
     /*
      * Revised by drdan to allow multiple members to use same email. When a user submits 
      * data to create a new account, the request is considered 'new' if the (email, lastname, firstname)
      * triple does not exist in the database.
      *  --June 15 2013
      */


	/**Search for member by (email,fname,lname) in Member table
	** @param: email
	** @return: member ID or -1 if not found
	** @auther: Greg Tran
	**/
	function search_for_member_by_email($email, $fname, $lname){
		$result = mysql_query("SELECT memberId FROM Member WHERE email = '$email' and firstName='$fname' and lastName='$lname'") or die ('search for member by email Error: '.mysql_error());
		$memberId = mysql_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
		$memberId = $memberId[0];
		return $memberId;
		}
	}//end function
	
	/**Search for member email in Security table
	** @param: email email address
	** @return: member ID or -1 if not found
	** @author: Greg Tran
	**/
	function search_for_member_by_email_in_security($email){
		$result = mysql_query("SELECT memberId FROM Security WHERE emailAddress = '$email'") or die ('Error in search for member in security: '.mysql_error());
		$memberId = mysql_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
			$memberId = $memberId[0];
			return $memberId;
		}
	}//end function
	
       /** Search for the member in the Secuirty table
	** @param: member ID
	** @return: true if found, false otherwise
	** @author: Greg Tran
	**/
	function search_for_member_by_ID_in_security($memberId){
		$result = mysql_query("SELECT memberId FROM Security WHERE memberId = '$memberId'");
		if($row = mysql_fetch_array($result)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	/**Search for member by name in the Member table
	** @param: first name, last name, zip code
	** @return: member Id or -1 if not found
	** @auther: Greg Tran
	**/
	function search_for_member_by_name($firstName, $lastName, $zip){ 
		$result = mysql_query("SELECT memberId FROM Member WHERE firstName = '$firstName' AND lastName = '$lastName' AND zip = '$zip'") or die ('Error in search for member by name: '.mysql_error ());
		$memberId = mysql_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
			$memberId = $memberId[memberId];
			return $memberId;
		}
	}//end function
	
	/**Search to see if member password exists in the Security table
	** @param: member Id
	** @return: true if found, false otherwise
	** @auther: Greg Tran
	**/
	function search_for_password($memberId){
		$result = mysql_query("SELECT memberId FROM Security WHERE memberId = $memberId") or die ('Error in search for password: '.mysql_error ());		
			$result = mysql_fetch_array($result);
			if(!$result){
				return FALSE;
			}
			elseif($result == null){ 
				return FALSE;
			}else{
			RETURN TRUE;
		}
	}//end function
	
	/**Search to see how many matches are found in the Member table
	** @param: first name, last name, zip code
	** @return: # of matches based on the parameters
	** @auther: Greg Tran
	**/
	function how_many_by_name($firstName, $lastName, $zip){
		$result = mysql_query("SELECT memberId FROM Member WHERE firstName = '$firstName' AND lastName = '$lastName' AND zip = '$zip'") or die ('Error in how many by namE: '.mysql_error ());
		$counter = 0;
		while($row = mysql_fetch_array($result)){
			$counter++;
		}
		//returns the number of matches
		return $counter;
	}//end function

	/**Search for password based on email in the Security table
	** @param: email address
	** @return: memberId or -1 if not found 
	** @auther: Greg Tran
	**/
	function does_password_exist($email){
		$result = mysql_query("SELECT memberId FROM Security WHERE emailAddress = '$email'") or die ('Error: '.mysql_error ());
		$memberId = mysql_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
			return $memberId;
		}
	}//end function
	
	/** Insert a new member into the Member table
	** @param: first name, last name, zip code, email
        ** @return: id of new member
	** @auther: Greg Tran
        ** @author: drdan
	**/
	function create_new_member($firstName, $lastName, $zip, $email){	
		mysql_query("INSERT INTO Member 
			(firstName, lastName, zip, email) VALUES ('$firstName', '$lastName', '$zip', '$email')")
  		or die('Error in create new member: '.mysql_error());  
                return mysql_insert_id();
		}//end function
		
	/**Add a member to Security table
	** @param: email address and password
	** @auther: Greg Tran
	**/
	function add_member_to_security($email, $password, $memberId) {
		$password= sha1($password);
		mysql_query("INSERT INTO Security (emailAddress, password, memberId) VALUES ('$email', '$password', $memberId)") or die('Error in add member to security: '.mysql_error());
	}
		
	/** Update member information
	** @param: member Id, first name, last name, zip code, password
	** @auther: Greg Tran
	**/
	function update_member($memberId, $firstName, $lastName, $zip){
		mysql_query("UPDATE Member SET firstName = '$firstName', lastName = '$lastName', zip = '$zip' WHERE memberId = $memberId") or die('Error in update member: '.mysql_error());
	}
	
	/** Update member information
	** @param: member Id, email
	** @auther: Greg Tran
	**/
	function update_member_email($memberId, $email){
		mysql_query("UPDATE Member SET email = '$email' WHERE memberId = $memberId") or die('Error in update member email: '.mysql_error());
	}
		
	/**Logic for handling account creation
	** @param: first, last name, email, zip code, password
	** @return: case #
	** @auther: Greg Tran
        ** @author: drdan
	** case 1: email exists in the Security table and (email, firstName, lastName) exists in Member table
	** case 2: (email, firstname, lastname) exists in the Member table, not in the Security table
	** case 3: no email match in Security or Member table, more than one match for name/zip
        ** case 4: no email match in Security or Member table, but name & zip code match existing volunteer
	** case 5: no email match in Security or Member table, one match for name & zip, 
        **         no existing password in Security table (this case removed because it could lead to error if
        **         two members with same name and zip code attempt to join. Logic must ensure that each record
        **         in Security table must have a password. Admin must assure that the same member does not 
        **         register with multiple emails.)
	** case 6: no email match in Security or Member table, no matches for name & zip, create new account
	**/
	function check_database($firstName, $lastName, $zip, $email, $password){
                $logFile = fopen("/kunden/homepages/23/d241546371/htdocs/volunteer/util/drdanLog.txt","a");
                fwrite($logFile,"Adding $firstName $lastName $zip $email $password\n");
		$memberIdInSecurity = search_for_member_by_email_in_security($email);
	        $memberIdInMember   = search_for_member_by_email($email,$firstName,$lastName);
	        $numberOfMatches    = how_many_by_name($firstName, $lastName, $zip);				
		$memberIdByName     = search_for_member_by_name($firstName, $lastName, $zip);
		
                fwrite($logFile,"Member id in Member table: $memberIdInMember in Security table $memberIdIn Security\n");
		if(($memberIdInSecurity != -1)&&($memberIdInMember != -1)){ //account exists
			return 1;
		}
		else if($memberIdInMember != -1){//not in the Security table, but in the Member table
		        add_member_to_security($email, $password, $memberIdByName);
		        return 2;
		}
		else if($numberOfMatches > 1){
			return 3;			
	        }
		else if($memberIdByName != -1){
			return 4;
		}
/*
	        else if ($numberOfMatches ==1){ //case 5, disabled by drdan
		   update_member_email($memberIdByName, $email);
	           add_member_to_security($email, $password, $memberIdByName);
		   $_SESSION['memberId'] = $memberIdByName;
		   $_SESSION['is_valid_user'] = true;
						return 5;
					}
*/
		else{ //case 6: create new member
		   $memberId = create_new_member($firstName, $lastName, $zip, $email);
		   add_member_to_security($email, $password, $memberId);
		   $_SESSION['memberId'] = $memberId;
		   $_SESSION['is_valid_user'] = true;
		   return 6;
		}
	}//end check_database
	
	/**Based upon the case scenario, the appropriate form is shown
	** @param: case number
	** @auther: Courtney Spak
	** case 1: email exists in the Security table
	** case 2: email exists in the Member table, not in the Security table
	** case 3: no email match in Security or Member table, more than one match for name/zip
	** case 4: no email match in Security or Member table, one match for name & zip, has existing account & password in Security table
	** case 5: no email match in Security or Member table, one match for name & zip, no existing password in Security table
	** case 6: no email match in Security or Member table, no matches for name & zip, create new account
	**/
	function display_case_outcome($case){
		if($case == 1){
			echo "<form action=\"login.php\" method=\"post\" name=\"login\" id=\"login\" style=\"width: 500px\">";
			echo "<p>Your account already exists, please login.</p>";
			echo "<input type=\"submit\" value=\"  Login  \"/>";
			echo "</form>";
		}
		elseif($case == 2){
			echo "<form action=\"../edit_profile.php\" method=\"post\" name=\"login\" id=\"login\" style=\"width: 500px\">";
			echo "<p>Thank you for registering, you may now edit your profile.</p>";
			echo "<input type=\"submit\" value=\"  Edit Your Profile  \"/>";
			echo "</form>";
		}
		elseif($case == 3){
			echo "<form method=\"post\" style=\"width: 500px\" action=\"mailto:admin@friendsofsmithgallwoods.org?subject=Account Conflict&body=Hello FSGW Admin, I have been unable to create an account. My name and email is...\">";
			echo "<p>We have found more than one record for your name in the Friends Volunteer List. Would you like to send your contact information to the Friend’s Chapter Administrator for resolution?</p>";

			echo "<input type=\"submit\" value=\"  Send Email  \"/>";
			echo "<p></p>";
			echo "<p>Back to <a href=\"http://www.friendsofsmithgallwoods.org\">Home</a></p>";
			echo "</form>";
		}	
		elseif($case == 4){
				echo "<form method=\"post\" style=\"width: 500px\" action=\"mailto:admin@friendsofsmithgallwoods.org?subject=Existing Account&body=Hello FSGW Admin, I have an existing account but do not remember what it is. My name and contact information is...\">";
				echo "<p>It seems that you already have an account. Would you like to send your contact information to the Friends Chapter Administrator for resolution?</p>";

				echo "<input type=\"submit\" value=\"  Send Email  \"/>";
				echo "<p></p>";
				echo "<p>Back to <a href=\"http://www.friendsofsmithgallwoods.org\">Home</a></p>";
				echo "</form>";
			}
		elseif($case == 5){
			echo "<form action=\"../edit_profile.php\" method=\"post\" name=\"login\" id=\"login\" style=\"width: 500px\">";
			
			echo "<p>Your email has been updated. You may now edit your profile.</p>";
			echo "<input type=\"submit\" value=\"  Edit Your Profile  \"/>";
			echo "</form>";
		}
		elseif($case == 6){
			echo "<form action=\"../edit_profile.php\" method=\"post\" name=\"login\" id=\"login\" style=\"width: 500px\">";
			
			echo "<p>Your account has been created. You may now edit your profile.</p>";
			echo "<input type=\"submit\" value=\"  Edit Your Profile  \"/>";
			echo "</form>";
		}
	}
	
?>
