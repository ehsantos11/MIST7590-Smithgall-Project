<?php
	
	/**Adds new volunteer hours to the VolunteerHours table
	** @param: activity name, location, date, hours, member ID, project name
	** @author: Greg Tran
	**/
	function add_member_hours($newActivity, $newLocation, $sqlDate, $newHours, $memberId, $newProject){
                //added by drdan
                writeDrDanLog($memberId,$sqlDate,$newProject,$newActivity,$newLocation,$newHours);

                $dsn = 'localhost';
                $username = 'root';
                $password = '';
                $db_name = 'db358933030'; 
                $conn = mysqli_connect($dsn, $username, $password, $db_name) or die ("could not connect to mysql");
                          
		mysqli_query($conn, "INSERT INTO VolunteerHours 
		(activity, location ,volDate, numHours, memberId, projectId) VALUES ('$newActivity', '$newLocation', '$sqlDate', $newHours, $memberId, $newProject)")
		or die(mysqli_error($conn));
	}
    /**
     * Write volunteer hours fields to /volunteer/util/drdanLog.txt"
     * @author drdan
     */
   function writeDrDanLog($userId,$datePerformed,$project,$activity,$location,$hours) {
      $logFile = fopen("/homepages/23/d241546371/htdocs/volunteer/util/drdanLog.txt",'a');
      fwrite ($logFile,"\nVolunteer hours logged at ". date('Y-m-d H:i:s')."\n");
      fwrite ($logFile,"Member: $userId Date performed: $datePerformed Project $project Activity: $activity Location: $location Hours: $hours\n"); 
      fclose($logFile);
   }
?>
