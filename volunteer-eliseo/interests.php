<?php
	//Start session and include functions
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
	
	<?php
		$memberId= (int) $_SESSION['memberId'];
		$sql = ("SELECT * FROM Member WHERE Member.memberId = $memberId");
		$result = mysqli_query($conn, $sql) or die(mysqli_error());
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
				<!--<h2>Volunteer Dashboard</h2>-->
				<div id="dashboard">
				<table>
					<tr><td class="formTitle">Hello <?php echo $profile[firstName] ?>!</td></tr>
				
					<tr><td class="formTitle"><a href="add_hours.php">Add New Volunteer Hours</a></td></tr>

					<tr><td class="formTitle"><a href="edit_profile.php">Edit Your Profile</a></td></tr>
					
					<tr><td class="formTitle active">Update Your Interests</a></li>

					<tr><td class="formTitle"><a href="show_hours.php">View Your Hours</a></td></tr>

					<tr><td class="formTitle"><a href="change_pswd.php">Change Password</a></td></tr>
				
					<tr><td class="formTitle"><a href="faq.html" target = "_blank">FAQs</a></td></tr>

					<tr><td class="formTitle"><a href="logout.php">Log Out</a></td></tr>
				</table>
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