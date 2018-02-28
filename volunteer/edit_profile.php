<?php
	session_start();
	require_once('util/secure_conn.php');
	require_once('util/database_connect.php');
	require_once('util/valid_user.php');
?>

<!doctype html>

<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">

	<title>Edit Your Profile</title>
	<noscript>
		<!-- This page reguires JavaScript.	-->
		<meta http-equiv="refresh" content="1; URL=error/nojs.html">
	</noscript> 
	<meta name="description" content="Friends of Smithgall Woods Volunteer Profile">
	<meta name="author" content="Benaiah Morgan">

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/member.css" />
	<link rel="stylesheet" href="css/formalize.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.formalize.js"></script>
	
	<?php
		$memberId= (int) $_SESSION['memberId'];
		$result = mysqli_query("SELECT * FROM Member WHERE Member.memberId = $memberId") or die (mysqli_error());
		
		$profile = mysqli_fetch_array( $result );
	?>
		
	<script type="text/javascript">
		$(document).ready(function() {
			setUpHints('userEditProfile');
			
			var selectedState= "<?= $profile['state'] ?>";
			var selectedCountry= "<?= $profile['country'] ?>";
			var selectedVolunteer= "<?= $profile['volunteer'] ?>";
			
			if(selectedState != '') {
				$('#state').val(selectedState);
			}
			
			if(selectedCountry != '') {
				$('#country').val(selectedCountry);
			}
			
			if(selectedVolunteer != '') {
				$('#volunteer'+selectedVolunteer).attr("checked","checked");
			}
		});
		
		function validate() {
			
			startValidation();
					
			validateText("firstName","You must enter your first name.");
			validateText("lastName","You must enter your last name.");
			validateZip("zip","You must enter your 5 digit zip code.");
			
			if($('#phone').val() != '')
			{
				validatePhone("phone", "Your phone number must be written in either the American format (111-222-3333) or international format (+11 2222 333 444). This is NOT a required field.");
			}
			
			if($('#cellPhone').val() != '')
			{
				validatePhone("cellPhone", "Your cellphone number must be written in either the American format (111-222-3333) or international format (+11 2222 333 444). This is NOT a required field.");
			}
			
			
			
			// validation fields above
			// validation check below
			return endValidation();
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
	

		<div id="leftCol">
			<h2>Volunteer Dashboard</h2>
			<div id="dashboard">
				<p><span class="formTitle"><a href="add_hours.php">Add New Volunteer Hours</a></span><br />Add new volunteer hours to your record</p>

				<p><span class="formTitle active">Edit Your Profile</span><br />Update your profile information</p>
                
                <p><span class="formTitle"><a href="interests.php">Update Your Interests</a></span><br />Let us know your project interests</p>

				<p><span class="formTitle"><a href="show_hours.php">View Your Hours</a></span><br />View a list of your previously submitted volunteer hours</p>
				
				<p><span class="formTitle"><a href="change_pswd.php">Change Password</a></span></p>
				
				<p><span class="formTitle"><a href="faq.html" target="_blank">FAQs</a></span></p>
				
				<p><span class="formTitle"><a href="logout.php">Log Out</a></span></p>
			</div>
		</div>

		<div id="rightCol">
		<h2 class="center">Edit Your Profile</h2>
		<form action="action/update_profile.php" id="userEditProfile" class = "formCenter" method="post" onSubmit="return validate();">
			<ul>
				<li>
					<label for="firstName" class="required">* First Name</label>
					<input type="text" name="firstName" id="firstName" value="<?php echo $profile[firstName] ?>" maxlength="64" required="required" />
				</li>
				<li>
					<label for="lastName" class="required">* Last Name</label>
					<input type="text" name="lastName" id="lastName" value="<?php echo $profile[lastName] ?>" maxlength="64" required="required" />
				</li>
				<li>
					<label for="address">Address</label>
					<input type="text" name="address" id="address" value="<?php echo $profile[address1] ?>" maxlength="106" />
					<span class="inputHint">Example: 123 Street Ave</span>
				</li>
				<li>
					<input type="text" name="addressLine2" id="addressLine2" value="<?php echo $profile[address2] ?>" style="margin-left: 255px;" maxlength="106" />
					<span class="inputHint">Example: Apt 5B</span>
				</li>
				<li>
					<label for="city">City</label>
					<input type="text" name="city" id="city" value="<?php echo $profile[city] ?>" maxlength="64" />
					<span class="inputHint">Example: Atlanta</span>
				</li>
				<li>
					<label for="state">State</label>
					<select name="state" id="state">
						<option value="">Select A State</option>
						<option value="AL">AL</option>
						<option value="AK">AK</option>
						<option value="AZ">AZ</option>
						<option value="AR">AR</option>
						<option value="CA">CA</option>
						<option value="CO">CO</option>
						<option value="CT">CT</option>
						<option value="DE">DE</option>
						<option value="DC">DC</option>
						<option value="FL">FL</option>
						<option value="GA">GA</option>
						<option value="HI">HI</option>
						<option value="ID">ID</option>
						<option value="IL">IL</option>
						<option value="IN">IN</option>
						<option value="IA">IA</option>
						<option value="KS">KS</option>
						<option value="KY">KY</option>
						<option value="LA">LA</option>
						<option value="ME">ME</option>
						<option value="MD">MD</option>
						<option value="MA">MA</option>
						<option value="MI">MI</option>
						<option value="MN">MN</option>
						<option value="MS">MS</option>
						<option value="MO">MO</option>
						<option value="MT">MT</option>
						<option value="NE">NE</option>
						<option value="NV">NV</option>
						<option value="NH">NH</option>
						<option value="NJ">NJ</option>
						<option value="NM">NM</option>
						<option value="NY">NY</option>
						<option value="NC">NC</option>
						<option value="ND">ND</option>
						<option value="OH">OH</option>
						<option value="OK">OK</option>
						<option value="OR">OR</option>
						<option value="PA">PA</option>
						<option value="RI">RI</option>
						<option value="SC">SC</option>
						<option value="SD">SD</option>
						<option value="TN">TN</option>
						<option value="TX">TX</option>
						<option value="UT">UT</option>
						<option value="VT">VT</option>
						<option value="VA">VA</option>
						<option value="WA">WA</option>
						<option value="WV">WV</option>
						<option value="WI">WI</option>
						<option value="WY">WY</option>
					</select>
				</li>
				<li>
					<label for="zip" class="required">* Zip</label>
					<input type="text" name="zip" id="zip" value="<?php echo $profile[zip] ?>" required="required" maxlength="45" />
					<span class="inputHint">Enter 5 digit zip code. Example: 12345</span>
				</li>
				<li>
					<label for="country">Country</label>
					<select name="country" id="country">
							<option value="">Select A Country</option>
							<option value="United States">United States</option>
							<option value="Afghanistan">Afghanistan</option> 
							<option value="Albania">Albania</option> 
							<option value="Algeria">Algeria</option> 
							<option value="American Samoa">American Samoa</option> 
							<option value="Andorra">Andorra</option> 
							<option value="Angola">Angola</option> 
							<option value="Anguilla">Anguilla</option> 
							<option value="Antarctica">Antarctica</option> 
							<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
							<option value="Argentina">Argentina</option> 
							<option value="Armenia">Armenia</option> 
							<option value="Aruba">Aruba</option> 
							<option value="Australia">Australia</option> 
							<option value="Austria">Austria</option> 
							<option value="Azerbaijan">Azerbaijan</option> 
							<option value="Bahamas">Bahamas</option> 
							<option value="Bahrain">Bahrain</option> 
							<option value="Bangladesh">Bangladesh</option> 
							<option value="Barbados">Barbados</option> 
							<option value="Belarus">Belarus</option> 
							<option value="Belgium">Belgium</option> 
							<option value="Belize">Belize</option> 
							<option value="Benin">Benin</option> 
							<option value="Bermuda">Bermuda</option> 
							<option value="Bhutan">Bhutan</option> 
							<option value="Bolivia">Bolivia</option> 
							<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
							<option value="Botswana">Botswana</option> 
							<option value="Bouvet Island">Bouvet Island</option> 
							<option value="Brazil">Brazil</option> 
							<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
							<option value="Brunei Darussalam">Brunei Darussalam</option> 
							<option value="Bulgaria">Bulgaria</option> 
							<option value="Burkina Faso">Burkina Faso</option> 
							<option value="Burundi">Burundi</option> 
							<option value="Cambodia">Cambodia</option> 
							<option value="Cameroon">Cameroon</option> 
							<option value="Canada">Canada</option> 
							<option value="Cape Verde">Cape Verde</option> 
							<option value="Cayman Islands">Cayman Islands</option> 
							<option value="Central African Republic">Central African Republic</option> 
							<option value="Chad">Chad</option> 
							<option value="Chile">Chile</option> 
							<option value="China">China</option> 
							<option value="Christmas Island">Christmas Island</option> 
							<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
							<option value="Colombia">Colombia</option> 
							<option value="Comoros">Comoros</option> 
							<option value="Congo">Congo</option> 
							<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
							<option value="Cook Islands">Cook Islands</option> 
							<option value="Costa Rica">Costa Rica</option> 
							<option value="Cote D'ivoire">Cote D'ivoire</option> 
							<option value="Croatia">Croatia</option> 
							<option value="Cuba">Cuba</option> 
							<option value="Cyprus">Cyprus</option> 
							<option value="Czech Republic">Czech Republic</option> 
							<option value="Denmark">Denmark</option> 
							<option value="Djibouti">Djibouti</option> 
							<option value="Dominica">Dominica</option> 
							<option value="Dominican Republic">Dominican Republic</option> 
							<option value="Ecuador">Ecuador</option> 
							<option value="Egypt">Egypt</option> 
							<option value="El Salvador">El Salvador</option> 
							<option value="Equatorial Guinea">Equatorial Guinea</option> 
							<option value="Eritrea">Eritrea</option> 
							<option value="Estonia">Estonia</option> 
							<option value="Ethiopia">Ethiopia</option> 
							<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
							<option value="Faroe Islands">Faroe Islands</option> 
							<option value="Fiji">Fiji</option> 
							<option value="Finland">Finland</option> 
							<option value="France">France</option> 
							<option value="French Guiana">French Guiana</option> 
							<option value="French Polynesia">French Polynesia</option> 
							<option value="French Southern Territories">French Southern Territories</option> 
							<option value="Gabon">Gabon</option> 
							<option value="Gambia">Gambia</option> 
							<option value="Georgia">Georgia</option> 
							<option value="Germany">Germany</option> 
							<option value="Ghana">Ghana</option> 
							<option value="Gibraltar">Gibraltar</option> 
							<option value="Greece">Greece</option> 
							<option value="Greenland">Greenland</option> 
							<option value="Grenada">Grenada</option> 
							<option value="Guadeloupe">Guadeloupe</option> 
							<option value="Guam">Guam</option> 
							<option value="Guatemala">Guatemala</option> 
							<option value="Guinea">Guinea</option> 
							<option value="Guinea-bissau">Guinea-bissau</option> 
							<option value="Guyana">Guyana</option> 
							<option value="Haiti">Haiti</option> 
							<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
							<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
							<option value="Honduras">Honduras</option> 
							<option value="Hong Kong">Hong Kong</option> 
							<option value="Hungary">Hungary</option> 
							<option value="Iceland">Iceland</option> 
							<option value="India">India</option> 
							<option value="Indonesia">Indonesia</option> 
							<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
							<option value="Iraq">Iraq</option> 
							<option value="Ireland">Ireland</option> 
							<option value="Israel">Israel</option> 
							<option value="Italy">Italy</option> 
							<option value="Jamaica">Jamaica</option> 
							<option value="Japan">Japan</option> 
							<option value="Jordan">Jordan</option> 
							<option value="Kazakhstan">Kazakhstan</option> 
							<option value="Kenya">Kenya</option> 
							<option value="Kiribati">Kiribati</option> 
							<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
							<option value="Korea, Republic of">Korea, Republic of</option> 
							<option value="Kuwait">Kuwait</option> 
							<option value="Kyrgyzstan">Kyrgyzstan</option> 
							<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
							<option value="Latvia">Latvia</option> 
							<option value="Lebanon">Lebanon</option> 
							<option value="Lesotho">Lesotho</option> 
							<option value="Liberia">Liberia</option> 
							<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
							<option value="Liechtenstein">Liechtenstein</option> 
							<option value="Lithuania">Lithuania</option> 
							<option value="Luxembourg">Luxembourg</option> 
							<option value="Macao">Macao</option> 
							<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
							<option value="Madagascar">Madagascar</option> 
							<option value="Malawi">Malawi</option> 
							<option value="Malaysia">Malaysia</option> 
							<option value="Maldives">Maldives</option> 
							<option value="Mali">Mali</option> 
							<option value="Malta">Malta</option> 
							<option value="Marshall Islands">Marshall Islands</option> 
							<option value="Martinique">Martinique</option> 
							<option value="Mauritania">Mauritania</option> 
							<option value="Mauritius">Mauritius</option> 
							<option value="Mayotte">Mayotte</option> 
							<option value="Mexico">Mexico</option> 
							<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
							<option value="Moldova, Republic of">Moldova, Republic of</option> 
							<option value="Monaco">Monaco</option> 
							<option value="Mongolia">Mongolia</option> 
							<option value="Montserrat">Montserrat</option> 
							<option value="Morocco">Morocco</option> 
							<option value="Mozambique">Mozambique</option> 
							<option value="Myanmar">Myanmar</option> 
							<option value="Namibia">Namibia</option> 
							<option value="Nauru">Nauru</option> 
							<option value="Nepal">Nepal</option> 
							<option value="Netherlands">Netherlands</option> 
							<option value="Netherlands Antilles">Netherlands Antilles</option> 
							<option value="New Caledonia">New Caledonia</option> 
							<option value="New Zealand">New Zealand</option> 
							<option value="Nicaragua">Nicaragua</option> 
							<option value="Niger">Niger</option> 
							<option value="Nigeria">Nigeria</option> 
							<option value="Niue">Niue</option> 
							<option value="Norfolk Island">Norfolk Island</option> 
							<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
							<option value="Norway">Norway</option> 
							<option value="Oman">Oman</option> 
							<option value="Pakistan">Pakistan</option> 
							<option value="Palau">Palau</option> 
							<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
							<option value="Panama">Panama</option> 
							<option value="Papua New Guinea">Papua New Guinea</option> 
							<option value="Paraguay">Paraguay</option> 
							<option value="Peru">Peru</option> 
							<option value="Philippines">Philippines</option> 
							<option value="Pitcairn">Pitcairn</option> 
							<option value="Poland">Poland</option> 
							<option value="Portugal">Portugal</option> 
							<option value="Puerto Rico">Puerto Rico</option> 
							<option value="Qatar">Qatar</option> 
							<option value="Reunion">Reunion</option> 
							<option value="Romania">Romania</option> 
							<option value="Russian Federation">Russian Federation</option> 
							<option value="Rwanda">Rwanda</option> 
							<option value="Saint Helena">Saint Helena</option> 
							<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
							<option value="Saint Lucia">Saint Lucia</option> 
							<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
							<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
							<option value="Samoa">Samoa</option> 
							<option value="San Marino">San Marino</option> 
							<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
							<option value="Saudi Arabia">Saudi Arabia</option> 
							<option value="Senegal">Senegal</option> 
							<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
							<option value="Seychelles">Seychelles</option> 
							<option value="Sierra Leone">Sierra Leone</option> 
							<option value="Singapore">Singapore</option> 
							<option value="Slovakia">Slovakia</option> 
							<option value="Slovenia">Slovenia</option> 
							<option value="Solomon Islands">Solomon Islands</option> 
							<option value="Somalia">Somalia</option> 
							<option value="South Africa">South Africa</option> 
							<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
							<option value="Spain">Spain</option> 
							<option value="Sri Lanka">Sri Lanka</option> 
							<option value="Sudan">Sudan</option> 
							<option value="Suriname">Suriname</option> 
							<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
							<option value="Swaziland">Swaziland</option> 
							<option value="Sweden">Sweden</option> 
							<option value="Switzerland">Switzerland</option> 
							<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
							<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
							<option value="Tajikistan">Tajikistan</option> 
							<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
							<option value="Thailand">Thailand</option> 
							<option value="Timor-leste">Timor-leste</option> 
							<option value="Togo">Togo</option> 
							<option value="Tokelau">Tokelau</option> 
							<option value="Tonga">Tonga</option> 
							<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
							<option value="Tunisia">Tunisia</option> 
							<option value="Turkey">Turkey</option> 
							<option value="Turkmenistan">Turkmenistan</option> 
							<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
							<option value="Tuvalu">Tuvalu</option> 
							<option value="Uganda">Uganda</option> 
							<option value="Ukraine">Ukraine</option> 
							<option value="United Arab Emirates">United Arab Emirates</option> 
							<option value="United Kingdom">United Kingdom</option>
							<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
							<option value="Uruguay">Uruguay</option> 
							<option value="Uzbekistan">Uzbekistan</option> 
							<option value="Vanuatu">Vanuatu</option> 
							<option value="Venezuela">Venezuela</option> 
							<option value="Viet Nam">Viet Nam</option> 
							<option value="Virgin Islands, British">Virgin Islands, British</option> 
							<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
							<option value="Wallis and Futuna">Wallis and Futuna</option> 
							<option value="Western Sahara">Western Sahara</option> 
							<option value="Yemen">Yemen</option> 
							<option value="Zambia">Zambia</option> 
							<option value="Zimbabwe">Zimbabwe</option>
					</select>
				</li>
				<li>
					<label for="phone">Phone</label>
					<input type="tel" name="phone" id="phone" value="<?php echo $profile[phone] ?>" maxlength="45" />
					<span class="inputHint">Example: 706-555-1212</span>
				</li>
				<li>
					<label for="cellPhone">Cell Phone</label>
					<input type="tel" name="cellPhone" id="cellPhone" value="<?php echo $profile[cellPhone] ?>" maxlength="45" />
					<span class="inputHint">Example: 706-555-1212</span>
				</li>
				<li>
					<span class="formLabel">Do you want to volunteer?</span>
					<label class="radioLabel">Yes <input type="radio" name="volunteer" id="volunteerYes" value="Yes" /></label>
					<label class="radioLabel">No <input type="radio" name="volunteer" id="volunteerNo" value="No" checked="checked" /></label>
				</li>
				<li>
					<label for="firstNameSP">Spouse/Partner First Name</label>
					<input type="text" name="firstNameSP" id="firstNameSP" value="<?php echo $profile[spFirstName] ?>" maxlength="64" />
				</li>
				<li>
					<label for="lastNameSP">Spouse/Partner Last Name</label>
					<input type="text" name="lastNameSP" id="lastNameSP" value="<?php echo $profile[spLastName] ?>" maxlength="64" />
				</li>
				<li>
					<label for="emergencyContact">Emergency Contact</label>
					<input type="text" name="emergencyContact" id="emergencyContact" value="<?php echo $profile[eContactName] ?>" maxlength="106" />
				</li>
				<li>
					<label for="emergencyPhone">Emergency Contact Phone</label>
					<input type="tel" name="emergencyPhone" id="emergencyPhone" value="<?php echo $profile[eContactPhone] ?>" maxlength="45" />
				</li>
				<li>
					<label for="relationToEmerContact">Relationship to Emergency Contact</label>
					<input type="text" name="relationToEmerContact" id="relationToEmerContact" value="<?php echo $profile[eContactRelation] ?>" maxlength="45" />
					<span class="inputHint" style="margin-top: 15px">Example: Brother</span>
				</li>
				<li>
					Special Restrictions <span class="inputDesc">(ex. Cannot lift over 40lbs)</span><br />
					<textarea name="specialRestrict" id="specialRestrict"><?php echo $profile[specialRestrict] ?></textarea>
					<span class="inputHint">NOTE: This field will only store 126 characters</span>
				</li>
			</ul>
			
			

			<p class="center"><input type="submit" value="  Save Changes  " /></p>
		</form>
		</div>
    </div>

  </div> <!-- end of #container -->

</body>
</html>