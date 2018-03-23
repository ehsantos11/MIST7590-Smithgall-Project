<?php
  /*
   * This file appears not to be used. These functions are duplicated in
   * submit_account_functions.php
   * --Woodland Rangers, March 2018
   */

	/**search for member by email in Member table
	** @param: email
	** @return: member Id or -1 if not found
	**/
	function search_for_member_by_email($email){
		global $conn;
		$sql = ("SELECT memberId FROM Member WHERE email = '$email'");
		$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
		$memberId = mysqli_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
		$memberId = $memberId[memberId];
		return $memberId;
		}
	}//end function
	
	/**search for member email in Security table
	** @param: email
	** @return: member Id or -1 if not found
	**/
	function search_for_member_by_email_in_security($email){
		global $conn;
		$sql = ("SELECT memberId FROM Security WHERE emailAddress = '$email'");
		$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
		$memberId = mysqli_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
			$memberId = $memberId[memberId];
			return $memberId;
		}
	}//end function
	
	/**search for member by name
	** @param: first name, last name, zip code
	** @return: member Id or -1 if not found
	**/
	function search_for_member_by_name($firstName, $lastName, $zip){ 
		global $conn;
		$sql = ("SELECT memberId FROM Member WHERE firstName = '$firstName' AND lastName = '$lastName' AND zip = '$zip'");
		$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
		$memberId = mysqli_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
		$memberId = $memberId[memberId];
		return $memberId;
		}
	}//end function
	
	/**search to see if member password exists
	** @param: member Id
	** @return: true if found, false otherwise
	**/
	function search_for_password($memberId){
		global $conn;
		$sql = ("SELECT memberId FROM Security WHERE memberId = $memberId");		
		$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
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
	
	/**search to see how many matches are found
	** @param: first name, last name, zip code
	** @return: # of matches based on the parameters
	**/
	function how_many_by_name($firstName, $lastName, $zip){
		global $conn;
		$sql = ("SELECT memberId FROM Member WHERE firstName = '$firstName' AND lastName = '$lastName' AND zip = '$zip'");
		$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
		$counter = 0;
		while($row = mysqli_fetch_array($result)){
			$counter++;
		}
		//returns the number of matches
		return $counter;
	}//end function

	/**search for password based on email
	** @return: memberId or -1 if not found 
	**/
	function does_password_exist($email){
		global $conn;
		$sql = ("SELECT memberId FROM Security WHERE emailAddress = '$email'");
		$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
		$memberId = mysqli_fetch_array($result);
		if(!$memberId){
			return -1;
		}else{
			return $memberId;
		}
	}//end function
	
	/** Inserting new member into the database
	** @param: first name, last name, zip code, email
	**/
	function create_new_member($firstName, $lastName, $zip, $email){	
		global $conn;
		$sql = ("INSERT INTO Member 
			(firstName, lastName, zip, email) VALUES ('$firstName', '$lastName', '$zip', '$email')");  
		mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
	}//end function
		
	/**Adding member to Security table
	** @param: email address and password
	**/
	function add_member_to_security($email, $password, $memberId) {
		global $conn;
		$password= sha1($password);
		$sql = ("INSERT INTO Security (emailAddress, password, memberId) VALUES ('$email', '$password', $memberId)");
		mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
	}
		
	/** Updating member information
	** @param: member Id, first name, last name, zip code, password
	**/
	function update_member($memberId, $firstName, $lastName, $zip){
		global $conn;
		$sql = ("UPDATE Member SET firstName = '$firstName', lastName = '$lastName', zip = '$zip' WHERE memberId = $memberId");
		mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
	}
	
	/** Updating member information
	** @param: member Id, email
	**/
	function update_member_email($memberId, $email){
		global $conn;
		$sql = ("UPDATE Member SET email = '$email' WHERE memberId = $memberId");
		mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
	}
		
	/**Logic for handling account creation
	** @param: first, last name, email, zip code, password
	** @return: case #
	**/
	function check_database($firstName, $lastName, $zip, $email, $password){
		$memberIdByEmail = search_for_member_by_email_in_security($email);
		//if memberid exists in Security table
		if($memberIdByEmail != -1){
			return 1;
		}
		//if memberId does not exist in Security table
		elseif($memberIdByEmail == -1){
			$memberIdByEmail = search_for_member_by_email($email);
			//if the member Id exists in Member table
			if($memberIdByEmail != -1){
				add_member_to_security($email, $password, $memberIdByEmail);
				return 2;
			}
			//if the member Id does not exist in Member table
			elseif($memberIdByEmail == -1){				
				$numberOfMatches = how_many_by_name($firstName, $lastName, $zip);				
				//if there are mutiple matches
				if($numberOfMatches > 1){
					return 3;			
				}elseif($numberOfMatches == 1){
					$memberIdByName = search_for_member_by_name($firstName, $lastName, $zip);
					update_member_email($memberIdByName, $email);
					$memberId = search_for_member_by_email($email);
					add_member_to_security($email, $password, $memberId);
					$_SESSION['memberId'] = $memberId;
					$_SESSION['is_valid_user'] = true;
					return 4;
				}else{
					create_new_member($firstName, $lastName, $zip, $email);
					$memberId = search_for_member_by_email($email);
					add_member_to_security($email, $password, $memberId);
					$_SESSION['memberId'] = $memberId;
					$_SESSION['is_valid_user'] = true;
					return 5;
				}
			}
		}
	}//end check_database
	
	
	/**Retrieves the member's interest
	** @return: an array of interestIds, -1 if no interests
	**/
	function get_member_interests(){
		global $conn;
		$memberId = (int) $_SESSION['memberId'];		
		$sql = ("SELECT Member_has_Interests.interestId FROM Interests, Member, Member_has_Interests WHERE Member.memberId = $memberId AND  Member_has_Interests.memberId = $memberId AND Member_has_Interests.interestId = Interests.interestId");
		$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
		while($row = mysqli_fetch_array($result)){
			$member_interest[]=$row[interestId];
		}
		if($member_interest == null){
			return -1;
			}else return $member_interest;
	}//end get_member_interests
		
	/**Displays interests member is interested in
	**/
	function show_interests(){
		global $conn;
		$memberId = (int) $_SESSION['memberId'];
		$member_interest = get_member_interests();
			
		$sql = ("SELECT interestName, interestId FROM Interests");
		$interest_list = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
		
		$counter = 1;
		while($interest_row = mysqli_fetch_array($interest_list)){
			$checked ="";
			if($member_interest != -1){
				if(in_array($counter, $member_interest)){
					$checked = "checked";
				}
				echo "<input name=\"$interest_row[interestId]\" value=\"$interest_row[interestId]\" type=\"checkbox\" $checked> $interest_row[interestName]<br><br>";
			$counter++;
			}elseif ($member_interest == -1){
				echo "<input name=\"$interest_row[interestId]\" value=\"$interest_row[interestId]\" type=\"checkbox\" $checked> $interest_row[interestName]<br><br>";
				$counter++;
			}
		}
	}//end show_interests
?>
