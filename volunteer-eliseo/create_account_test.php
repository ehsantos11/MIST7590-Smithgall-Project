<!doctype html>

<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">

	<title>Create New Account</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods New Account">
	<meta name="author" content="Benaiah Morgan">

	<link rel="stylesheet" href="css/style.css?v=2">
	<link rel="stylesheet" href="css/member.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			setUpHints('register');
		});
		
		function validate() {
			startValidation();
			alert("Starting validation process");
			validateText("firstName","You must enter your first name.");
			validateText("lastName","You must enter your last name.");
			validateZip("zip","You must enter your 5 digit zip code.");
			validateEmail("email","You must enter a valid email address.");
			validateConfirmText("email","confirmEmail","Please confirm your email address. This must match the Email field.");
			validatePassword("password","Please enter a valid password: At least 6 characters, 1 letter, and 1 number");
			validateConfirmText("password","confirmPassword","Please confirm your password. This must match the Password field.");
			// validation fields above
			
			// validation check below
			if (!valid) {
				errMsgHeading="The form cannot be submitted. Please correct the problems below:\n\n";
				alert(errMsgHeading + errMsg);
				if(focusItem != undefined) focusItem.focus();
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
		
			<h2>Create New Account</h2>
			<p class="required"><strong>All fields are required</strong></p>
			<p>NOTE: If you are a Friend of Smithgall Woods, please use the<br> same email address you used when purchasing your membership.<br> Your information may already be in the system.</p>
			
			<form action="action/submit_account_new.php" name="register" id="register" style="width: 500px" onSubmit="return validate();" method="post">
			
				
			<ul>
				<li>
					<label for="firstName" class="required">* First Name</label>
					<input type="text" name="firstName" id="firstName" placeholder="John" required="required" />
					<span class="inputHint">Example: John</span>
				</li>
				<li>
					<label for="lastName" class="required">* Last Name</label>
					<input type="text" name="lastName" id="lastName" placeholder="Doe" required="required" />
					<span class="inputHint">Example: Doe</span>
				</li>
				<li>
					<label for="zip" class="required" required="required">* Zip</label>
					<input type="text" name="zip" id="zip" placeholder="12345" required="required" />
					<span class="inputHint">Enter your 5 digit zip code. Example: 12345</span>
				</li>
				<li>
					<label for="email" class="required">* Email</label>
					<input type="email" name="email" id="email" placeholder="example@domain.com" required="required" />
					<span class="inputHint">Example: example@domain.com<br />NOTE: This will be your user id.</span>
				</li>
				<li>
					<label for="confirmEmail" class="required">* Confirm Email</label>
					<input type="email" name="confirmEmail" id="confirmEmail" placeholder="example@domain.com" required="required" />
					<span class="inputHint">Example: example@domain.com<br />Enter the same email address as above.</span>
				</li>
				<li>
					<label for="password" class="required">* Password</label>
					<input type="password" name="password" id="password" placeholder="" required="required" />
					<span class="inputHint">Your password must have:
						<ul>
							<li>At least six characters</li>
							<li>At least one letter</li>
							<li>At least one number</li>
						</ul>
					</span>
				</li>
				<li>
					<label for="confirmPassword" class="required">* Confirm Password</label>
					<input type="password" name="confirmPassword" id="confirmPassword" placeholder="" required="required" />
					<span class="inputHint">Enter exactly the same password.<br />Password is case sensitive.</span>
				</li>
			</ul>
			<p class="center"><input type="submit" value="  Continue  " /></p>
			</form>
		</div>
		<br style="clear: both" />
			
            <p>Have questions? Check out our <a href="faq.html">FAQ</a></p>
		</div>

  </div> <!-- end of #container -->

</body>
</html>
