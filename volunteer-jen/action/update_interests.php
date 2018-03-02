<?php
	session_start();
	//require_once('../util/secure_conn.php');
	require_once('../util/database_connect.php');
	require_once('../util/valid_user.php');
	require_once('../util/update_interests_functions.php');
	$memberId = (int) $_SESSION['memberId'];
?>
<!doctype html>
	<html lang="en" class="no-js">	

<head>	
	<meta charset="utf-8">
	<title>Update Your Interests</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/member.css" />
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
					
					<p><span class="formTitle active">Update Your Interests</a></span><br />Let us know your project interests</p>

					<p><span class="formTitle"><a href="../show_hours.php">View Your Hours</a></span><br />View a list of your previously submitted volunteer hours</p>

					<p><span class="formTitle"><a href="../change_pswd.php">Change Password</a></span></p>
				
					<p><span class="formTitle"><a href="../faq.html" target = "_blank">FAQs</a></span></p>

					<p><span class="formTitle"><a href="../logout.php">Log Out</a></span></p>
				</div>
			</div>

	<div id="rightCol">
	<h2 class="center">Park Interests</h2>
	<form  style="width: 750px">

				<?php
				 	 $dsn = 'localhost';
					 $username = 'root';
					 $password = '';
					 $db_name = 'db358933030'; 
					 $conn = mysqli_connect($dsn, $username, $password, $db_name) or die ("could not connect to mysql");
				 
					clean_member_has_interests($memberId);
										
					$counter = 1;
					while ($counter < 15){
						if($_POST[$counter] == null){
							$counter++;
						}else{
							mysqli_query($conn, "INSERT INTO Member_has_Interests (memberId, interestId) VALUES ($memberId, $_POST[$counter])") or die ('Error: '.mysqli_error($conn));
							$counter++;}
					}
					echo "<p class=\"center\">Your interests have been updated.</p>";
				?>
				
				<p class="center"><input type="button" value="  Return to Interests  " onClick="self.location= '../interests.php'"/></p>
			</form>
			<br/>
		</div>
    </div>
	  
  </div> <!-- end of #container -->

</body>
</html>