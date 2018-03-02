<?php
	session_start();
	//require_once('util/secure_conn.php');
	require_once('util/database_connect.php');
	require_once('util/valid_user.php');
?>

<!doctype html>

	<html lang="en" class="no-js">
	<head>
	<meta charset="utf-8">

	<title>Change Password</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods Change Password">
	<meta name="author" content="Benaiah Morgan">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/member.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	<script type="text/javascript" src="js/uri.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			
			setUpHints('changePassword');
			$('input[placeholder], textarea[placeholder]').val('');
			
			if(jQuery.url.param("badpswd") == "true") {
				$("#badpswd").show('slow');
			}
			if(jQuery.url.param("goodpswd") == "true") {
				$("#goodpswd").show('slow');
			}
		});

		function validate() {
			
			startValidation();
			
			validateText("currentPassword","Please enter your existing password");
			validatePassword("password","Please enter a new, valid password: At least 6 characters, 1 letter, and 1 number");
			validateConfirmText("password","confirmPassword","Please confirm your new password. This must match the New Password field.");
			
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
		
		<div id="leftCol">
			<h2>Volunteer Dashboard</h2>
			<div id="dashboard">
				<p><span class="formTitle"><a href="add_hours.php">Add New Volunteer Hours</a></span><br />Add new volunteer hours to your record</p>

				<p><span class="formTitle"><a href="edit_profile.php">Edit Your Profile</a></span><br />Update your profile information</p>
				
				<p><span class="formTitle"><a href="interests.php">Update Your Interests</a></span><br />Let us know your project interests</p>

				<p><span class="formTitle"><a href="show_hours.php">View Your Hours</a></span><br />View a list of your previously submitted volunteer hours</p>
				
				<p><span class="formTitle active">Change Password</span></p>
				
				<p><span class="formTitle"><a href="faq.html" target="_blank">FAQs</a></span></p>

				<p><span class="formTitle"><a href="logout.php">Log Out</a></span></p>
			</div>
		</div>

		<div id="rightCol">
		<h2 class="center">Change Password</h2>
		<div id="badpswd" class="message">
			Incorrect password. Please enter your current password.
		</div>
		<div id="goodpswd" class="message">
			You have successfully updated your password.
		</div>
		<form action="action/update_pswd.php" method="post" id="changePassword" class = "formCenter" onSubmit="return validate();">
			<ul>
				<li>
					<label for="currentPassword" class="required">* Current Password</label>
					<input type="password" name="currentPassword" id="currentPassword" placeholder="" maxlength="60" required="required" />
					<span class="inputHint">Enter the password you used to login, not the new one.</span>
				</li>
				<li>
					<label for="password" class="required">* New Password</label>
					<input type="password" name="password" id="password" placeholder="" maxlength="60" required="required" />
					<span class="inputHint">Your new password must have:
						<ul>
							<li>At least six characters</li>
							<li>At least one letter</li>
							<li>At least one number</li>
						</ul>
					</span>
				</li>
				<li>
					<label for="confirmPassword" class="required">* Confirm Password</label>
					<input type="password" name="confirmPassword" id="confirmPassword" placeholder="" maxlength="60" required="required" />
					<span class="inputHint">Enter exactly the same new password.<br />Password is case sensitive.</span>
				</li>
			</ul>

			<p class="center"><input type="submit" value="  Change Password  " /></p>
		</form>
		</div>
    </div>
	  
  </div> <!-- end of #container -->

</body>
</html>