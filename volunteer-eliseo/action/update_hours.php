<?php
	session_start();
	require_once('../util/secure_conn.php');
	require_once('../util/database_connect.php');
	require_once('../util/valid_user.php');
	require_once('../util/update_hours_functions.php')
?>

<html lang="en" class="no-js">
<head>
  <meta charset="utf-8">
  <title></title>
	<meta name="description" content="">
	<meta name="author" content="Woodland Rangers">

	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/member.css">
	<link rel="shortcut icon" href="../images/favicon.ico" />
	
	<?php
		$memberId= (int) $_SESSION['memberId'];
		$sql = ("SELECT * FROM Member WHERE Member.memberId = $memberId");
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
		$profile = mysqli_fetch_array( $result );
	?>
	
</head>

<body>
  <div id="container">
	<header>	
				<h1>Friends of Smithgall Woods</h1>
	</header>
    <div id="main">
		<div id="leftCol">
			<div id="dashboard">
			<table>
				<tr><td class="formTitle">Hello <?php echo $profile[firstName] ?>!</td></tr>
				
				<tr><td class="formTitle active">Add New Volunteer Hours</td></tr>

				<tr><td class="formTitle"><a href="../edit_profile.php">Edit Your Profile</a></td></tr>
				
				<tr><td class="formTitle"><a href="../interests.php">Update Your Interests</a></td></tr>

				<tr><td class="formTitle"><a href="../show_hours.php">View Your Hours</a></td></tr>
				
				<tr><td class="formTitle"><a href="../change_pswd.php">Change Password</a></td></tr>
				
				<tr><td class="formTitle"><a href="../faq.html" target = "_blank">FAQs</a></td></tr>
				
				<tr><td class="formTitle"><a href="../logout.php">Log Out</a></td></tr>
			</table>
			</div>
		</div>
		<div id="rightCol">
		<h2 class="center">Submitted Volunteer Hours</h2>
		<?php
			/**
			** Get add_hours form data and add to database - action of add hours form				
			**/
			$newDate = htmlentities(substr($_POST["newDate"],0,10), ENT_QUOTES);			
			$newActivity = htmlentities(substr($_POST["newActivity"],0,106), ENT_QUOTES);
			$newProject = (integer)$_POST["newProject"]; //dynamic dropdown			
			$newLocation = htmlentities(substr($_POST["newLocation"],0,106), ENT_QUOTES);	
			$newSection = $_POST["newSection"]; //dynamic dropdown
			$newHours = (float)htmlentities(substr($_POST["newHours"],0,5), ENT_QUOTES);		
			$memberId = (int) $_SESSION['memberId'];			
			$date_array = explode("/",$newDate); // split the array
			$var_month = $date_array[0];
			$var_day = $date_array[1];
			$var_year = $date_array[2]; 
			$sqlDate= "$var_year-$var_month-$var_day";
			
			add_member_hours($newActivity, $newLocation, $sqlDate, $newHours, $memberId, $newProject, $newSection);
			echo "<p class=\"center\"> <br></br>Your hours have been submitted.<br></br></p>";
		?>		
		<p class="center"><input type="button" value="  View Your New Hours  " onClick="self.location= '../show_hours.php'" /></p>
		</div>
    </div>	  
  </div> <!-- end of #container -->
</body>
</html>
