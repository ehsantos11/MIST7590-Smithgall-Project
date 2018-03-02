<?php
	session_start();
	//require_once('util/secure_conn.php');
	require_once('util/database_connect.php');
	require_once('util/valid_user.php');
	require_once('util/show_hours_functions.php');
?>
<!doctype html>
	<html lang="en" class="no-js">	

<head>	
	<meta charset="utf-8">
	<title>View Your Hours</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods Volunteer Hours">
	<meta name="author" content="Benaiah Morgan">

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/member.css" />
	<link rel="shortcut icon" href="images/favicon.ico" />
</head>
	<body>

	  <div id="container">

		<header>	
				<h1>Friends of Smithgall Woods</h1>
		</header>

	    <div id="main">
			<div id="leftCol">
				<h2>Volunteer Dashboard</h2>
				<div id="dashboard">
					<p><span class="formTitle"><a href="add_hours.php">Add New Volunteer Hours</a></span><br />Add new volunteer hours to your record</p>

					<p><span class="formTitle"><a href="edit_profile.php">Edit Your Profile</a></span><br />Update your profile information</p>
					
					<p><span class="formTitle"><a href="interests.php">Update Your Interests</a></span><br />Let us know your project interests</p>

					<p><span class="formTitle active">View Your Hours</span><br />View a list of your previously submitted volunteer hours</p>

					<p><span class="formTitle"><a href="change_pswd.php">Change Password</a></span></p>
				
					<p><span class="formTitle"><a href="faq.html" target="_blank">FAQs</a></span></p>

					<p><span class="formTitle"><a href="logout.php">Log Out</a></span></p>
				</div>
			</div>

	<div id="rightCol">
	<h2 class="center">View Your Hours</h2>
	<?php
		$memberId= (int) $_SESSION['memberId'];
		display_user_total_vol_hours($memberId);
		display_user_total_yearly_hours($memberId);
		display_user_hours($memberId);
	?>
	
	<br />
	<p class="center"><input type="button" value="  Add New Hours  " onClick="self.location= 'add_hours.php'" /></p>

		</div>
    </div>
	  
  </div> <!-- end of #container -->

</body>
</html>