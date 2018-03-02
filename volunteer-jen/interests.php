<?php
	session_start();
	//require_once('util/secure_conn.php');
	require_once('util/database_connect.php');
	require_once('util/valid_user.php');
	require_once('util/interests_functions.php');
?>
<!doctype html>
	<html lang="en" class="no-js">	

<head>	
	<meta charset="utf-8">
	<title>Update Your Interests</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods Volunteer Interests">
	<meta name="author" content="Greg Tran">

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/member.css" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
    
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
					
					<p><span class="formTitle active">Update Your Interests</a></span><br />Let us know your project interests</p>

					<p><span class="formTitle"><a href="show_hours.php">View Your Hours</a></span><br />View a list of your previously submitted volunteer hours</p>

					<p><span class="formTitle"><a href="change_pswd.php">Change Password</a></span></p>
				
					<p><span class="formTitle"><a href="faq.html" target = "_blank">FAQs</a></span></p>

					<p><span class="formTitle"><a href="logout.php">Log Out</a></span></p>
				</div>
			</div>

	<div id="rightCol">
	<h2 class="center">Park Interests</h2>
	<form action="action/update_interests.php" method="post" id="interests" class = "formCenter" style="width: 750px">
		<?php
			show_interests();
		?>			
				<p class="center"><input type="submit" value="  Update Interests  " /></p>
			</form>
			<br/>
		</div>
    </div>
	  
  </div> <!-- end of #container -->

</body>
</html>