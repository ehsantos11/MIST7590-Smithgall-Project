<?php
	require_once('util/secure_conn.php');
	require_once('util/database_connect.php');
?>
<!doctype html>

<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">

	<title>Reset Password</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods Password Reset">
	<meta name="author" content="Benaiah Morgan">

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/member.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	<script type="text/javascript" src="js/uri.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			setUpHints('forgotpswd')
			
			if(jQuery.url.param("bademail") == "true") {
				$("#bademail").show('slow');
			}
		});
		
		function validate() {
			$('#submit').attr('disabled','disabled');
			startValidation();
			validateEmail("email","You must enter a valid email address.");
			// validation fields above
			
			// validation check below
			if (!valid) {
				self.location= "forgot_pswd.php?bademail=true";				
			}
			return valid;
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
		
			<h2>Reset password</h2>
			
			<p>Please enter the email address on your account to reset your password.</p>
			
			<div id="bademail" class="message">
				<p>You have entered an incorrect email address. Please try again.</p>
			</div>
			
			<form action="action/reset_pswd.php" method="post" name="forgotpswd" id="forgotpswd" style="width: 400px" onSubmit="return validate();">
			<ul>
				<li>
					<label for="email">Email</label>
					<input type="email" name="email" id="email" placeholder=""  required="required" maxlength="106" />
					<span class="inputHint">Example: example@domain.com</span>
				</li>
			</ul>

			<p class="center"><input type="submit" id="submit" value="  Reset Password  " /></p>
			</form>
			<br style="clear: both" />
			
			
			<p>Not a Friends of Smithgall Volunteer? <a href="create_account.php">Create An Account</a></p>
			<p>Have your password? <a href="index.php">Login</a></p>
			<p>Back to <a href="http://www.friendsofsmithgallwoods.org">Home</a></p>
	</div>
  </div> <!-- end of #container -->
</body>
</html>