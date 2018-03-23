<?php

	/**Remove interest entries for member
	** @param: member ID
	** @author: Woodland Rangers, March 2018
	**/
	function clean_member_has_interests($memberId){
		global $conn;
		$sql = ("DELETE FROM Member_has_Interests WHERE memberId = $memberId");
		mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
	}
	
?>	