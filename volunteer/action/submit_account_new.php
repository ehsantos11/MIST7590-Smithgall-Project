<?php
	session_start();
	require_once('../util/database_connect.php');
	require_once('../util/secure_conn.php');
	require_once('../util/submit_account_functions_new.php');
	
	$firstName = htmlentities(substr($_POST["firstName"],0,64), ENT_QUOTES);
	$lastName = htmlentities(substr($_POST["lastName"],0,64), ENT_QUOTES);
	$zip = htmlentities(substr($_POST["zip"],0,45), ENT_QUOTES);
	$email = htmlentities(substr($_POST["email"],0,106), ENT_QUOTES);
	$password = htmlentities(substr($_POST["password"],0,60), ENT_QUOTES);
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">

	<title>Volunteer Login</title>
	<meta name="description" content="Friends of Smithgall Woods Account Verification">
	<meta name="author" content="Greg Tran">

	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/member.css">
	<link rel="shortcut icon" href="../images/favicon.ico" />
</head>
	<body>
		<div id="container">
		<header>	
				<h1>Friends of Smithgall Woods</h1>
		</header>
		<div id="main">
		<?php
			$case = check_database($firstName, $lastName, $zip, $email, $password);
			display_case_outcome($case);
		?>
		</div>
		</div>
	</body>
</html>
