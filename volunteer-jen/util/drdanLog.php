<?php

    /**
     * Write volunteer hours fields to /volunteer/util/drdanLog.txt"
     */
   function writeDrDanLog($userId,$datePerformed,$project,$activity,$location,$hours) {
      $logFile = fopen("/homepages/23/d241546371/htdocs/volunteer/util/drdanLog.txt",'a');
      fwrite ($logFile,"\nVolunteer hours logged at ". date('Y-m-d H:i:s')."\n");
      fwrite ($logFile,"Member: $userId Date performed: $datePerformed Project $project Activity: $activity Location: $location Hours: $hours\n"); 
      fclose($logFile);
   }
    writeDrDanLog(633,'2013-06-04','Web Team', 'Diagnostics','Athens GA',4);
?>
<h1>Logged</h1>
<p>Check log file for results</p>

