<?php
	//Start session and include functions
	session_start();
	require_once('../util/secure_conn.php');
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
	<meta name="author" content="Woodland Rangers">

	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/member.css" />
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
					
					<tr><td class="formTitle"><a href="../add_hours.php">Add New Volunteer Hours</a></td></tr>

					<tr><td class="formTitle"><a href="../edit_profile.php">Edit Your Profile</a></td></tr>
					
					<tr><td class="formTitle active">Update Your Interests</a></td></tr>

					<tr><td class="formTitle"><a href="../show_hours.php">View Your Hours</a></td></tr>
				
					<tr><td class="formTitle"><a href="../change_pswd.php">Change Password</a></td></tr>
				
					<tr><td class="formTitle"><a href="../faq.html" target = "_blank">FAQs</a></td></tr>
				
					<tr><td class="formTitle"><a href="../logout.php">Log Out</a></td></tr>
				  </table>
				</div>
			</div>

			<div id="rightCol">
			  <h2 class="center">Park Interests</h2>
			  <form  style="width: 750px">

				<?php				
					clean_member_has_interests($memberId);
										
					$counter = 1;
					while ($counter < 15){
						if($_POST[$counter] == null){
							$counter++;
						}else{							
							$sql = ("INSERT INTO Member_has_Interests (memberId, interestId) VALUES ($memberId, $_POST[$counter])");
							mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
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