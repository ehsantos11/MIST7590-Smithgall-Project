<?php

	/**Updates the member info in the Member table
	** @param: attributes of Member table
	** @author: Greg Tran
	**/


	function update_member($newFirstName, $newLastName, $newAddress, $newAddress2, $newCity, $newZip, $newState, $newCountry, $newPhone, $newCellPhone, $newVolunteerValue, $newFirstNameSP, $newLastNameSP, $newEmergencyContact, $newEmergencyPhone, $newRelationToEmerContact, $newSpecialRestrictions, $memberId){
		$dsn = 'localhost';
		$username = 'root';
		$dbpass = '';
		$db_name = 'db358933030'; 
		$conn = mysqli_connect($dsn, $username, $dbpass, $db_name) or die ("could not connect to mysql");

		mysqli_query($conn, "UPDATE Member SET firstName = '$newFirstName', lastName = '$newLastName', address1 = '$newAddress', address2 = '$newAddress2', city = '$newCity', state = '$newState', zip = '$newZip', country = '$newCountry', phone = '$newPhone', cellPhone = '$newCellPhone', volunteer = '$newVolunteerValue', spFirstName = '$newFirstNameSP', spLastName = '$newLastNameSP', eContactName = '$newEmergencyContact', eContactPhone = '$newEmergencyPhone', eContactRelation = '$newRelationToEmerContact', specialRestrict = '$newSpecialRestrictions' WHERE memberId = $memberId") or die(header("Location: ../error/error.php"));
	}
	
?>