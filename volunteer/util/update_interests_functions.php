<?php

	/**Remove interest entries for member
	** @param: member ID
	** @author: Greg Tran
	**/
	function clean_member_has_interests($memberId){
	mysql_query("DELETE FROM Member_has_Interests WHERE memberId = $memberId") or die ('Error: '.mysql_error());
	}
	
?>	