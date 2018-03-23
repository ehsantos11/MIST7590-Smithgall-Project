<?php
	//Start session and include functions
	session_start();
	require_once('util/secure_conn.php');
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
	<meta name="author" content="Woodland Rangers">

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/member.css" />
	<link rel="shortcut icon" href="images/favicon.ico" />
	
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
				
					<tr><td class="formTitle"><a href="add_hours.php">Add New Volunteer Hours</a></td></tr>

					<tr><td class="formTitle"><a href="edit_profile.php">Edit Your Profile</a></td></tr>
					
					<tr><td class="formTitle"><a href="interests.php">Update Your Interests</a></td></tr>

					<tr><td class="formTitle active">View Your Hours</td></tr>

					<tr><td class="formTitle"><a href="change_pswd.php">Change Password</a></td></tr>
				
					<tr><td class="formTitle"><a href="faq.html" target="_blank">FAQs</a></td></tr>

					<tr><td class="formTitle"><a href="logout.php">Log Out</a></td></tr>
				</table>
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