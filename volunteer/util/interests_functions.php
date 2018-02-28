<?php
	/**Displays member interests
	** @author: Greg Tran
	**/
	function show_interests(){
		$memberId = (int) $_SESSION['memberId'];
		$member_interest = get_member_interests();

		$interest_list = mysqli_query("SELECT interestName, interestId FROM Interests") or die ('ERROR: '.mysqli_error());
	echo "<table id = 'interests'>";
		$counter = 1;
		while($interest_row = mysqli_fetch_array($interest_list)){
			$checked ="";
			if($member_interest != -1){
				if(in_array($counter, $member_interest)){
					$checked = "checked";
				}
				if($counter % 2 != 0){echo "<tr>";}
				echo "<td><input name=\"$interest_row[interestId]\" value=\"$interest_row[interestId]\" type=\"checkbox\" $checked> $interest_row[interestName]</td>";
				if($counter % 2 == 0){echo "</tr>";}
				$counter++;
			}elseif ($member_interest == -1){
				if($counter % 2 != 0){echo "<tr>";}
				echo "<td><input name=\"$interest_row[interestId]\" value=\"$interest_row[interestId]\" type=\"checkbox\" $checked> $interest_row[interestName]</td>";
				if($counter % 2 == 0){echo "</tr>";}
				$counter++;
			}
		}
		echo "</table>";
	}//end show_interests
	
	/**Retrieves the member's interest
	** @return: an array of interestIds, -1 if no interests
	** @author: Greg Tran
	**/
	function get_member_interests(){
		$memberId = (int) $_SESSION['memberId'];
		
		$result = mysqli_query("SELECT Member_has_Interests.interestId FROM Interests, Member, Member_has_Interests WHERE Member.memberId = $memberId AND  Member_has_Interests.memberId = $memberId AND Member_has_Interests.interestId = Interests.interestId") or die ('Error: '.mysqli_error ());

		while($row = mysqli_fetch_array($result)){
			$member_interest[]=$row[interestId];
		}
		if($member_interest == null){
			return -1;
			}else return $member_interest;
	}//end get_member_interests
?>