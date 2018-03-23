<?php
	require_once('../util/secure_conn.php');
	require_once('../util/database_connect.php');
	require_once('../util/user_functions.php');

	$email = htmlentities(substr($_POST['email'],0,106), ENT_QUOTES);
	
	if(!is_existing_email($email)) {
		header("Location: ../forgot_pswd.php?bademail=true");
	}
?>
<!doctype html>

<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">

	<title>Reset Password</title>
	<meta name="description" content="Friends of Smithgall Woods Password Reset">
	<meta name="author" content="Woodland Rangers">

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
		
			<h2>Reset password</h2>
			
			<?php
				if(is_existing_email($email)) {
					$password= new_password($email);
					$pswd= sha1($password);
				
					$sql = ("UPDATE Security SET password = '$pswd' WHERE emailAddress = '$email'");
					mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
					
					// double check that it went into the table
					$sql = ("SELECT password FROM Security WHERE emailAddress = '$email'");
					$result = mysqli_query($conn, $sql) or die('ERROR: '.mysqli_error($conn));
					
					$row = mysqli_fetch_array($result);
					$dbpswd= $row[password];
					
					if($pswd == $dbpswd) {
						// send email
						$subject= "Message from Friends of Smithgall Woods";
						$mailheaders= "MIME-Version: 1.0\r\n"; 
						$mailheaders.= "Content-type: text/html; charset=ISO-8859-1\r\n";
						$mailheaders.= "From: Friends of Smithgall Woods <webmaster@friendsofsmithgallwoods.org> \r\n";
						$mailheaders.= "Reply-To: " . $email;
						$msg= "<p>Your password has been reset. Your temporary password is " . $password . "</p>";
						$msg.= "<p>We recommend that you change your password after logging on by clicking on the Change Password link in the Dashboard.</p>";
						$msg.= "<br /><br /><p><strong>Friends of Smithgall Wooods</strong><br /><a href='http://www.friendsofsmithgallwoods.org'>http://www.friendsofsmithgallwoods.org</a></p>";
						mail($email, $subject, $msg, $mailheaders);
						
						echo "<p>Your password has been reset. An email with a temporary password has been sent to your address. We recommend changing your password after using it to log in.</p><p><a href='https://www.friendsofsmithgallwoods.org/test/alpha/volunteer'>Back to Login</a>";
					}
					
					else {
						echo "<p>There was an error reseting your password. Please try again. If you continue to get this error, contact the webmaster.</p>";
					}
				}
			?>
	</div>
  </div> <!-- end of #container -->
</body>
</html>