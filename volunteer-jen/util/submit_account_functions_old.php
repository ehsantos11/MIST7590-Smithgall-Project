<?php
	/**Search for member by email in Member table
	** @param: email
	** @return: member ID or -1 if not found
	** @auther: Greg Tran
	**/

	$dsn = 'localhost';
	$username = 'root';
	$dbpass = '';
	$db_name = 'db358933030'; 
	$conn = mysqli_connect($dsn, $username, $dbpass, $db_name) or die ("could not connect to mysql");

	function search_for_member_by_email($email){
		global $conn;
		$result = mysqli_query($conn, "SELECT memberId FROM Member WHERE email = '$email'") or die ('Error: '.mysqli_error($conn));
		$memberId = mysqli_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
		$memberId = $memberId[memberId];
		return $memberId;
		}
	}//end function
	
	/**Search for member email in Security table
	** @param: email
	** @return: member ID or -1 if not found
	** @auther: Greg Tran
	**/
	function search_for_member_by_email_in_security($email){
		global $conn;
		$result = mysqli_query($conn, "SELECT memberId FROM Security WHERE emailAddress = '$email'") or die ('Error: '.mysqli_error($conn));
		$memberId = mysqli_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
			$memberId = $memberId[memberId];
			return $memberId;
		}
	}//end function
	
	/** Search for the member in the Secuirty table
	** @param: member ID
	** @return: true if found, false otherwise
	** @author: Greg Tran
	**/
	function search_for_member_by_ID_in_security($memberId){
		global $conn;
		$result = mysqli_query($conn, "SELECT memberId FROM Security WHERE memberId = '$memberId'");
		if($row = mysqli_fetch_array($result)){
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
		global $conn;
		$result = mysqli_query($conn, "SELECT memberId FROM Member WHERE firstName = '$firstName' AND lastName = '$lastName' AND zip = '$zip'") or die ('Error: '.mysqli_error ($conn));
		$memberId = mysqli_fetch_array($result);
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
		global $conn;
		$result = mysqli_query($conn, "SELECT memberId FROM Security WHERE memberId = $memberId") or die ('Error: '.mysqli_error ($conn));		
			$result = mysqli_fetch_array($result);
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
		global $conn;
		$result = mysqli_query($conn, "SELECT memberId FROM Member WHERE firstName = '$firstName' AND lastName = '$lastName' AND zip = '$zip'") or die ('Error: '.mysqli_error ($conn));
		$counter = 0;
		while($row = mysqli_fetch_array($result)){
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
		global $conn;
		$result = mysqli_query($conn, "SELECT memberId FROM Security WHERE emailAddress = '$email'") or die ('Error: '.mysqli_error ($conn));
		$memberId = mysqli_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
			return $memberId;
		}
	}//end function
	
	/** Insert a new member into the Member table
	** @param: first name, last name, zip code, email
	** @auther: Greg Tran
	**/
	function create_new_member($firstName, $lastName, $zip, $email){	
		global $conn;
		mysqli_query($conn, "INSERT INTO Member 
			(firstName, lastName, zip, email) VALUES ('$firstName', '$lastName', '$zip', '$email')")	or die('Error: '.mysqli_error($conn));  
		}//end function
		
	/**Add a member to Security table
	** @param: email address and password
	** @auther: Greg Tran
	**/
	function add_member_to_security($email, $password, $memberId) {
		global $conn;
		$password= sha1($password);
		mysqli_query($conn, "INSERT INTO Security (emailAddress, password, memberId) VALUES ('$email', '$password', $memberId)") or die('Error: '.mysqli_error($conn));
	}
		
	/** Update member information
	** @param: member Id, first name, last name, zip code, password
	** @auther: Greg Tran
	**/
	function update_member($memberId, $firstName, $lastName, $zip){
		global $conn;
		mysqli_query($conn, "UPDATE Member SET firstName = '$firstName', lastName = '$lastName', zip = '$zip' WHERE memberId = $memberId") or die('Error: '.mysqli_error($conn));
	}
	
	/** Update member information
	** @param: member Id, email
	** @auther: Greg Tran
	**/
	function update_member_email($memberId, $email){
		global $conn;
		mysqli_query($conn, "UPDATE Member SET email = '$email' WHERE memberId = $memberId") or die('Error: '.mysqli_error($conn));
	}
		
	/**Logic for handling account creation
	** @param: first, last name, email, zip code, password
	** @return: case #
	** @auther: Greg Tran
	** case 1: email exists in the Security table
	** case 2: email exists in the Member table, not in the Security table
	** case 3: no email match in Security or Member table, more than one match for name/zip
	** case 4: no email match in Security or Member table, one match for name & zip, has existing account & password in Security table
	** case 5: no email match in Security or Member table, one match for name & zip, no existing password in Security table
	** case 6: no email match in Security or Member table, no matches for name & zip, create new account
	**/
	function check_database($firstName, $lastName, $zip, $email, $password){
		$memberIdByEmail = search_for_member_by_email_in_security($email);
		//if email exists in Security table
		if($memberIdByEmail != -1){
			return 1;
		}
		//if email does not exist in Security table
		elseif($memberIdByEmail == -1){
			$memberIdByEmail = search_for_member_by_email($email);
			//if the email exists in Member table
			if($memberIdByEmail != -1){
				add_member_to_security($email, $password, $memberIdByEmail);
				return 2;
			}
			//if the email does not exist in Member table
			elseif($memberIdByEmail == -1){				
				$numberOfMatches = how_many_by_name($firstName, $lastName, $zip);				
				//if there are mutiple matches
				if($numberOfMatches > 1){
					return 3;			
				}elseif($numberOfMatches == 1){
					$memberIdByName = search_for_member_by_name($firstName, $lastName, $zip);
					//get memberId from member table
					//check security to see if security table has member Id already
					//if yes, display message
					//if no, 
					if(search_for_member_by_ID_in_security($memberIdByName)){
						 return 4;
					}
					//member does not have an existing login account
					else{
						update_member_email($memberIdByName, $email);
						add_member_to_security($email, $password, $memberIdByName);
						$_SESSION['memberId'] = $memberIdByName;
						$_SESSION['is_valid_user'] = true;
						return 5;
					}
				}else{
					create_new_member($firstName, $lastName, $zip, $email);
					$memberId = search_for_member_by_email($email);
					add_member_to_security($email, $password, $memberId);
					$_SESSION['memberId'] = $memberId;
					$_SESSION['is_valid_user'] = true;
					return 6;
				}
			}
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
				echo "<p>It seems that you already have an account. Would you like to send your contact information to the Friend’s Chapter Administrator for resolution?</p>";

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