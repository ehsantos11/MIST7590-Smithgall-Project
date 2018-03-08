<?php

	/**Updates the member info in the Member table
	** @param: attributes of Member table
	** @author: Greg Tran
	**/
	function update_member($newFirstName, $newLastName, $newAddress, $newAddress2, $newCity, $newZip, $newState, $newCountry, $newPhone, $newCellPhone, $newVolunteerValue, $newFirstNameSP, $newLastNameSP, $newEmergencyContact, $newEmergencyPhone, $newRelationToEmerContact, $newSpecialRestrictions, $memberId){
		global $conn;
		$sql = ("UPDATE Member SET firstName = '$newFirstName', lastName = '$newLastName', address1 = '$newAddress', address2 = '$newAddress2', city = '$newCity', state = '$newState', zip = '$newZip', country = '$newCountry', phone = '$newPhone', cellPhone = '$newCellPhone', volunteer = '$newVolunteerValue', spFirstName = '$newFirstNameSP', spLastName = '$newLastNameSP', eContactName = '$newEmergencyContact', eContactPhone = '$newEmergencyPhone', eContactRelation = '$newRelationToEmerContact', specialRestrict = '$newSpecialRestrictions' WHERE memberId = $memberId");
		mysqli_query($conn, $sql) or die(header("Location: ../error/error.php"));
	}
	
?>