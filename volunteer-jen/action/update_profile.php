<?php
	session_start();
	//require_once('../util/secure_conn.php');
	require_once('../util/database_connect.php');
	require_once('../util/valid_user.php');
	require_once('../util/update_profile_functions.php');
?>
<!doctype html>

<html lang="en" class="no-js">

<head>
	<meta charset="utf-8">

	<title>Volunteer Dashboard - Edit Your Profile</title>
	<meta name="description" content="Update volunteer profile information">
	<meta name="author" content="Greg Tran, Benaiah Morgan">

	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/member.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<link rel="shortcut icon" href="../images/favicon.ico" />
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
				<p><span class="formTitle"><a href="../add_hours.php">Add New Volunteer Hours</a></span><br />Add new volunteer hours to your record</p>

				<p><span class="formTitle"><a href="../edit_profile.php">Edit Your Profile</a></span><br />Update your profile information</p>
				
				<p><span class="formTitle"><a href="../interests.php">Update Your Interests</a></span><br />Let us know your project interests</p>

				<p><span class="formTitle"><a href="../show_hours.php">View Your Hours</a></span><br />View a list of your previously submitted volunteer hours</p>

				<p><span class="formTitle"><a href="../change_pswd.php">Change Password</a></span></p>
				
				<p><span class="formTitle"><a href="faq.html" target="_blank">FAQs</a></span></p>

				<p><span class="formTitle"><a href="../logout.php">Log Out</a></span></p>
			</div>
		</div>

		<div id="rightCol">
		<h2 class="center">Your Profile Overview</h2>
		<?php
		
			/**
			** Get edit profile form data and add to database - action page of edit profile
			** @author: Benaiah Morgan, Mindy Wise
			**/
			//get edit profile form data, escape all html, limit characters
			$newFirstName = htmlentities(substr($_POST["firstName"],0,64), ENT_QUOTES);		
			$newLastName = htmlentities(substr($_POST["lastName"],0,64), ENT_QUOTES);
			$newAddress = htmlentities(substr($_POST["address"],0,106), ENT_QUOTES);		
			$newAddress2 = htmlentities(substr($_POST["addressLine2"],0,106), ENT_QUOTES);
			$newCity = htmlentities(substr($_POST["city"],0,64), ENT_QUOTES);
			$newZip = htmlentities(substr($_POST["zip"],0,45), ENT_QUOTES);
			$newState = $_POST["state"]; //dropdown
			$newCountry = $_POST["country"]; //dropdown
			$newPhone = htmlentities(substr($_POST["phone"],0,45), ENT_QUOTES);
			$newCellPhone = htmlentities(substr($_POST["cellPhone"],0,45), ENT_QUOTES);
			$newVolunteerValue = $_POST["volunteer"]; //radio button
			$newFirstNameSP = htmlentities(substr($_POST["firstNameSP"],0,64), ENT_QUOTES);
			$newLastNameSP = htmlentities(substr($_POST["lastNameSP"],0,64), ENT_QUOTES);
			$newEmergencyContact = htmlentities(substr($_POST["emergencyContact"],0,106), ENT_QUOTES);
			$newEmergencyPhone = htmlentities(substr($_POST["emergencyPhone"],0,45), ENT_QUOTES);
			$newRelationToEmerContact = htmlentities(substr($_POST["relationToEmerContact"],0,45), ENT_QUOTES);
			$newSpecialRestrictions = htmlentities(substr($_POST["specialRestrict"],0,126), ENT_QUOTES);
			$memberId = (int) $_SESSION['memberId'];
			
			//add to database
			update_member($newFirstName, $newLastName, $newAddress, $newAddress2, $newCity, $newZip, $newState, $newCountry, $newPhone, $newCellPhone, $newVolunteerValue, $newFirstNameSP, $newLastNameSP, $newEmergencyContact, $newEmergencyPhone, $newRelationToEmerContact, $newSpecialRestrictions, $memberId);

			//echo form inputs out to the page	
			echo "<p>First Name: <b>$newFirstName</b></p>";
			echo "<p>Last name: <b>$newLastName</b></p>";
			echo "<p>Address: <b>$newAddress</b></p>";
			echo "<p>Address Line 2: <b>$newAddress2</b></p>";
			echo "<p>City: <b>$newCity</b></p>";
			echo "<p>State: <b>$newState</b></p>";			
			echo "<p>Zip: <b>$newZip</b></p>";
			echo "<p>Country: <b>$newCountry</b></p>";
			echo "<p>Phone: <b>$newPhone</b></p>";
			echo "<p>Cell Phone: <b>$newCellPhone</b></p>";
			echo "<p>Volunteer: <b>$newVolunteerValue</b></p>";
			echo "<p>SP First Name: <b>$newFirstNameSP</b></p>";
			echo "<p>Sp Last Name: <b>$newLastNameSP</b></p>";
			echo "<p>Emergency Contact: <b>$newEmergencyContact</b></p>";
			echo "<p>Emergency Phone: <b>$newEmergencyPhone</b></p>";
			echo "<p>Relation: <b>$newRelationToEmerContact</b></p>";
			echo "<p>Special Restrictions: <b>$newSpecialRestrictions</b></p>";				

			echo "<p> Your profile information has been updated.</p>";

		?>
		<input type="button" value="  Edit Your Profile  " onClick="self.location= '../edit_profile.php'" />
				</div>
			</div>
		</div> <!-- end of #container -->
</body>
</html>