<?php
	/**Displays the total cumulative volunteers hours
	** @param: member ID
	** @author: Woodland Rangers, March 2018
	**/
	function display_user_total_vol_hours($memberId){
		global $conn;
		$sql = ("SELECT SUM(numHours) FROM VolunteerHours WHERE memberId = $memberId");
		$result = mysqli_query($conn, $sql) or die("ERROR: ".mysqli_error($conn));
		
		$column = mysqli_fetch_array($result);
		$totalHrs = $column['SUM(numHours)'];
		//if no hours have been submitted, return
		if($totalHrs == 0){
			return;
		}else{
			echo "<p class = 'center'>Total Volunteer Hours: <b>$totalHrs</b></p>";
		}
	}
	
	/**Displays the total volunteer hours for the current year
	** @param: member ID
	** @author: Woodland Rangers
	**/
	function display_user_total_yearly_hours($memberId){
		global $conn;
		$today = getdate();
		$current_year = $today['year'];
		
		$sql = ("SELECT SUM(numHours) FROM VolunteerHours WHERE memberId = $memberId AND DATE_FORMAT(volDate, '%Y') = $current_year");
		$result = mysqli_query($conn, $sql) or die("ERROR: ".mysqli_error($conn));
		
		$column = mysqli_fetch_array($result);
		$totalHrs = $column['SUM(numHours)'];
		//if no hours have been submitted, return
		if($totalHrs == 0){
			return;
		}else{
			echo "<p class = 'center'>Total Hours This Year: <b>$totalHrs</b></p>";
		}
	}
	
	/**Displays a table of volunteer hours
	** @param: member ID
	** @author: Woodland Rangers
	**/
	function display_user_hours($memberId){	
		global $conn;
		$sql = ("SELECT hoursId, volDate, projectName, activity, location, section, numHours FROM VolunteerHours, Projects WHERE Projects.projectId = VolunteerHours.projectId AND VolunteerHours.memberId = $memberId ORDER BY volDate DESC");
		$result = mysqli_query($conn, $sql) or die("ERROR: ".mysqli_error($conn));	
		$count= 0;
	
		// keeps getting the next row until there are no more to get
		while($column = mysqli_fetch_array( $result )) {
			// Print the table header once but ONLY if the loop starts
			if($count == 0) {	
				echo "<table id = 'viewHours'>";
				echo "<tr> <th>Volunteer Date</th> <th>Project Name</th> <th>Activity</th> <th>Location</th> <th>Section</th> <th>Hours</th> <th>Entry Wrong?</th> </tr>";
			}
			// Print out the contents of each column into a table
			echo "<tr><td>"; 
			echo $column['volDate'];
			echo "</td><td>"; 
			echo $column['projectName'];
			echo "</td><td>";
			echo $column['activity'];
			echo "</td><td>";
			echo $column['location'];
			echo "</td><td>";
			echo $column['section'];
			echo "</td><td>";
			echo $column['numHours'];
			echo "</td><td>";
			echo "<a href='mailto:admin@friendsofsmithgallwoods.org?Subject=Please Adjust My Volunteer Hours&Body=";
			echo "Please change the following entry in my volunteer hours:%0D%0A";
			echo "Volunteer ID: ". $memberId . "%0D%0A";
			echo "Hours ID: ". $column['hoursId'] . "%0D%0A";
			echo "Date: ". $column['volDate'] . "%0D%0A";
			echo "Project: ". $column['projectName'] . "%0D%0A";
			echo "Activity: ". $column['activity'] . "%0D%0A";
			echo "Location: ". $column['location'] . "%0D%0A";
			echo "Section: ". $column['section'] . "%0D%0A";
			echo "Number of Hours: ". $column['numHours'];
			echo "%0D%0A%0D%0A";
			echo "Please change this entry to the following:%0D%0A";
			echo "Date: %0D%0A";
			echo "Project: %0D%0A";
			echo "Activity: %0D%0A";
			echo "Location: %0D%0A";
			echo "Section: %0D%0A";
			echo "Number of Hours: %0D%0A";
			echo "%0D%0A *Any field left blank will remain the same.'>";
			echo "Email Admin</a>";
			echo "</td></tr>"; 
		
			$count++;
		}	
		if($count > 0) 	{
			echo "</table>";
		}
		else {
			echo "<p class=\"center\"> <br></br>You have not logged any volunteer hours.<br></br></p>";
		}
	}//end function

?>