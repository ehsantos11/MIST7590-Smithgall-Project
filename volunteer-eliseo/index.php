<?php
	//require_once('util/secure_conn.php');
	require_once('util/database_connect.php');
?>
<!doctype html>

<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">

	<title>Volunteer Login</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods Login">
	<meta name="author" content="Benaiah Morgan">

	<link rel="stylesheet" href="css/style.css?v=2">
	<link rel="stylesheet" href="css/member.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	<script type="text/javascript" src="js/uri.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			setUpHints('login')
			
			if(jQuery.url.param("badlogin") == "true") {
				$("#badlogin").show('slow');
			}
			
			else if(jQuery.url.param("logout") == "true") {
				$("#logout").show('slow');
			}
		});
	</script>
	<link rel="shortcut icon" href="images/favicon.ico" />
</head>
<body>
  <div id="container">

	<header>	
				<h1>Friends of Smithgall Woods</h1>
	</header>

    <div id="main">
		
			<h2>Volunteer Login</h2>
			
			<div id="badlogin" class="message">
				<p>You have entered an incorrect email address and/or password. Please try again.</p>
			</div>
			
			<div id="logout" class="message">
				<p>You have successfully logged out.</p>
			</div>
			
			<form action="action/login.php" method="post" name="login" id="login" style="width: 400px">
			<ul>
				<li>
					<label for="email">Email</label>
					<input type="email" name="email" placeholder=""  required="required" maxlength="106" />
					<span class="inputHint">Example: example@domain.com</span>
				</li>
				<li>
					<label for="firstName">Password</label>
					<input type="password" name="password" required="required" maxlength="60" />
				</li>
			</ul>

			<p class="center"><input type="submit" value="  Log In  " /></p>
			</form>
			<br style="clear: both" />
			
            <p>Trouble logging in? <a href="forgot_pswd.php">Reset your password</a></p>
			
			<p>Not a Friends of Smithgall Volunteer? <a href="create_account.php">Create An Account</a></p>
			
            <p>Have questions? Check out our <a href="faq.html">FAQ</a></p>
            
			<p>Back to <a href="../volunteer">Home</a></p>
	</div>
  </div> <!-- end of #container -->
</body>
</html>