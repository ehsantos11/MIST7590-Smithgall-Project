<?php
	//Start session and include functions
	session_start();
	require_once('util/secure_conn.php');
	require_once('util/database_connect.php');
	require_once('util/valid_user.php');
	require_once('util/projects_menu.php');
	
?>
<!doctype html>

	<html lang="en" class="no-js">
	<head>
	<meta charset="utf-8">

	<title>Volunteer Dashboard - Submit Volunteer Hours</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods Add Volunteer Hours">
	<meta name="author" content="Woodland Rangers">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/member.css">
	<style type="text/css">
		input, select, {width: 180px;}
		.inputHint {width: 165px}
	</style>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	
	<?php
		$memberId= (int) $_SESSION['memberId'];
		$sql = ("SELECT * FROM Member WHERE Member.memberId = $memberId");
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$profile = mysqli_fetch_array( $result );
	?>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#newHours').change(function() {
				var cleanHours= parseFloat($('#newHours').val());
				cleanHours= cleanHours.toFixed(2);
				$('#newHours').val(cleanHours);
			});
			
			setUpHints('submitVolHours');
			$('input[placeholder], textarea[placeholder]').val('');
		});

		function validate() {
			
			startValidation();
			
			validatePastDate("newDate","You must enter the date you volunteered in the following format: mm/dd/yyyy. Ex: 03/25/2001. Do not enter a date in the future.");
			validateText("newActivity","You must enter the activity performed.");
			validateText("newLocation","You must enter the location the activity was performed.");			
			validateHours("newHours","You must enter the number of hours you volunteered.");
			
			// validation fields above
			// validation check below
			return endValidation();
		}
	</script>
	<link rel="shortcut icon" href="images/favicon.ico" />
</head>

<body>

  <div id="container">

	<header>	
				<h1>Friends of Smithgall Woods</h1>
	</header>

    <div id="main">
		<!--<div id="leftCol">
			<h2>Volunteer Dashboard</h2>-->
		
		<div id="leftCol">
			<div id="dashboard">
			<table>
				<tr><td class="formTitle">Hello <?php echo $profile[firstName] ?>!</td></tr>
				
				<tr><td class="formTitle active">Add New Volunteer Hours</td></tr>

				<tr><td class="formTitle"><a href="edit_profile.php">Edit Your Profile</a></td></tr>
				
				<tr><td class="formTitle"><a href="interests.php">Update Your Interests</a></td></tr>

				<tr><td class="formTitle"><a href="show_hours.php">View Your Hours</a></td></tr>
				
				<tr><td class="formTitle"><a href="change_pswd.php">Change Password</a></td></tr>
				
				<tr><td class="formTitle"><a href="faq.html" target = "_blank">FAQs</a></td></tr>
				
				<tr><td class="formTitle"><a href="logout.php">Log Out</a></td></tr>
			</table>
			</div>
		</div>
		
		<!--</div>-->

		<div id="rightCol">
		<h2 class="center">Add New Volunteer Hours</h2>
		<form action="action/update_hours.php" method="POST" id="submitVolHours" class = "formCenter" onSubmit="return validate();">
			<ul>
				<li>
					<label for="newDate" class="required">* Date Performed</label>
					
					<input type="text" name="newDate" id="newDate" required="required" placeholder="02/15/2010" pattern="\d{1,2}/\d{1,2}/\d{4}" maxlength="10" /><span class="inputHint">Date format: mm/dd/yyyy<br />Example: 02/15/2010<br />Do not enter future dates</span>
				</li>
				<li>
					<label for="newActivity" class="required">* Activity</label>
					<input type="text" name="newActivity" id="newActivity" required="required" placeholder="Building benches" maxlength="106" />
					<span class="inputHint">Building benches</span>
				</li>
				<li>
					<label for="newProject">* Project</label>
					<select required name="newProject" id="newProject">
					<option value="" disabled selected>--Select option--</option>
					<?=$options ?>
					</select>
				</li>
				<li>
					<label for="newLocation" class="required">* Location</label>
					<input type="text" name="newLocation" id="newLocation" required="required" placeholder="Visitor Center" maxlength="106" />
					<span class="inputHint">Visitor Center</span>
				</li>
				<li>
					<label for="newHours" class="required">* Hours Worked</label>
					<input type="number" min="0.25" max="24" step="0.25" name="newHours" id="newHours" required="required" placeholder="3.25" maxlength="6" />
					<span class="inputHint">Enter in quarter hour increments. Example: 3.25</span>
				</li>
				<li>
					<label for="newSection">* Section</label>
					<select required name="newSection" id="newSection" >
						<option value="" disabled selected>--Select option--</option>
						<option value="Smithgall Woods">Smithgall Woods</option>
						<option value="Hardman Farm">Hardman Farm</option>
					</select>
				</li>
			</ul>

			<p class="center"><input type="submit" value="  Add Hours  " /></p>
		</form>
		</div>
    </div>
	  
  </div> <!-- end of #container -->

</body>
</html>