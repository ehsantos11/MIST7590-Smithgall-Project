<?php
	/**Volunteer Project dropdown menu, only current projects are displayed
	** @author: Greg Tran
	**/
	
	$dsn = 'localhost';
	$username = 'root';
	$dbpass = '';
	$db_name = 'db358933030'; 
	$conn = mysqli_connect($dsn, $username, $dbpass, $db_name) or die ("could not connect to mysql");

	try{
		global $conn;
		//set timezone
		date_default_timezone_set('America/New_York');
		$today = getdate();
		$current_year = $today['year'];
		$current_month = $today['mon'];
		$current_day = $today['mday'];
		
		//query current projects by end date		
		$searchResult = mysqli_query($conn, "SELECT projectId, projectName FROM Projects WHERE projEndDate > '$current_year-$current_month-$current_day' ORDER BY projectId");
		
		//string used by HTML page for drop down menu
		$options= "";
		while($row = mysqli_fetch_array($searchResult)){
			$id = $row ["projectId"];
			$project = $row["projectName"];
			$options.="<option value=\"$id\">".$project."</option>";
			}
		}catch (Exception $e){
			echo 'Error: ', $e->getMessage();
		}

?>