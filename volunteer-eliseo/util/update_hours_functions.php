<?php
	
	/**Adds new volunteer hours to the VolunteerHours table
	** @param: activity name, location, date, hours, member ID, project name
	** @author: Greg Tran
	**/
	function add_member_hours($newActivity, $newLocation, $sqlDate, $newHours, $memberId, $newProject, $newSection){
        //added by drdan
        writeDrDanLog($memberId,$sqlDate,$newProject,$newActivity,$newLocation,$newSection,$newHours);
		
		global $conn;
		$sql = ("INSERT INTO VolunteerHours 
		(activity, location ,volDate, numHours, section, memberId, projectId) VALUES ('$newActivity', '$newLocation', '$sqlDate', $newHours, '$newSection', $memberId, $newProject)");
		mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error());
	}
    /**
     * Write volunteer hours fields to /volunteer/util/drdanLog.txt"
     * @author drdan
     */
   function writeDrDanLog($userId,$datePerformed,$project,$activity,$location,$section,$hours) {
      $logFile = fopen("/homepages/23/d241546371/htdocs/volunteer/util/drdanLog.txt",'a');
      fwrite ($logFile,"\nVolunteer hours logged at ". date('Y-m-d H:i:s')."\n");
      fwrite ($logFile,"Member: $userId Date performed: $datePerformed Project: $project Activity: $activity Location: $location Section: $section Hours: $hours\n"); 
      fclose($logFile);
   }
?>
