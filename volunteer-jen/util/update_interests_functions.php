<?php

	/**Remove interest entries for member
	** @param: member ID
	** @author: Greg Tran
	**/
	function clean_member_has_interests($memberId){
		$dsn = 'localhost';
		$username = 'root';
		$password = '';
		$db_name = 'db358933030'; 
		$conn = mysqli_connect($dsn, $username, $password, $db_name) or die ("could not connect to mysql");

		mysqli_query($conn, "DELETE FROM Member_has_Interests WHERE memberId = $memberId") or die ('Error: '.mysqli_error($conn));
	}
	
?>	