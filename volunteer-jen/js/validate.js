/**
 *	File created by Benaiah Morgan
 *	File last modified 4/30/2011
 *	The purpose of this file is to contain all of the functions related to validating forms.
 *	This file requires jquery.js (jquery.com) and uri.js (github.com/allmarkedup/jQuery-URL-Parser)
 *	Some functions take/adapted from Intuit Financial Institution Division's validate.js file (indicated in @author comments)
 *
 *	All functions, in order:
 *	setUpHints
 *	startValidation
 *	endValidation
 *	validateFailed
 *	validateText
 *	validateZip
 *	validateConfirmText
 *	validatePassword
 *	validatePhone
 *	validateEmail
 *	validateHours
 *	validateDate
 *	validatePastDate
 *	checkDate
 *	parseDateOb2Str
 *	valDate
 *	valPastDate
 *	isEqualStrings
 *	isValidTLD
 *
 **/

/** 
 *	Add the javascript that shows/hides the hint box for the input fields
 *	@author: Benaiah Morgan
 *	@param formName: The name of the form whose inputs the function is adding hints to
 */
function setUpHints(formName) {

	// get all of the inputs for the form
	inputs = document.forms[formName].elements;
	
	// for each input in the form
	for (var i=0; i<inputs.length; i++){
		// when the input gets the focus
		inputs[i].onfocus = function () {
			// show the hint div IF IT EXISTS
			var hintDiv= this.parentNode.getElementsByTagName("span")[0];
			if(hintDiv != undefined) hintDiv.style.display = "inline";
		}
		// when the input loses the focus
		inputs[i].onblur = function () {
			// hide the hint div IF IT EXISTS
			var hintDiv= this.parentNode.getElementsByTagName("span")[0];
			if(hintDiv != undefined) hintDiv.style.display = "none";
		}
	}
}

/** 
 *	Initialize variables used during form validation and disable the submit button while validation is occurring
 *	@author: Benaiah Morgan
 */
function startValidation() {
	$('input[type="submit"]').attr('disabled','disabled');
	this.valid= true;		// whether or not the form inputs are valid
	this.errMsg= '';		// the error message that will be alerted to the end user if validation fails
	this.focusItem= '';		// the input field that should get the focus if validation fails (the first input that's wrong)
}

/** 
 *	End form validation by showing an alert if it failed or allowing the form action to occur if it passed
 *	@author: Benaiah Morgan
 *	@return: valid - True if the form input if valid, otherwise false
 */
function endValidation() {
	if (!this.valid) {
		errMsgHeading="The form cannot be submitted. Please correct the problems below:\n\n";
		
		alert(errMsgHeading + this.errMsg);
		if(this.focusItem != undefined) this.focusItem.focus();
		$('input[type="submit"]').removeAttr('disabled');
	}
	
	return valid;
}

/** 
 *	Updates the validation variables if a validation function fails
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input whose value is invalid
 *	@param: description - the error text that needs to be added to the error message
 */
function validateFailed(inputID, description) {
	if (this.valid) focusItem = $("#"+inputID);
	this.valid = false;
	if (description) {
		this.errMsg += description + "\n";
	}
	else {
		this.errMsg += inputID + "\n";
	}
}

/** 
 *	Tests whether an input field is empty
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validateText(inputID, description) {
	if($("#"+inputID).val() == '') {
		validateFailed(inputID, description)
	}
}

/** 
 *	Tests whether an input field contains a valid zip code (checks for 5 digits, no other text)
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validateZip(inputID, description) {
	var pattern = eval("/^\\d{5}$/");

	if (!(pattern.test($("#"+inputID).val())) || $("#"+inputID).val()=="")
	{
		validateFailed(inputID, description)
	}
	
}

/** 
 *	Tests whether the value of an input field matches that of another (for confirming emails and passwords)
 *	@author: Benaiah Morgan
 *	@param: inputOriginal - id of the form input whose value the confirm input is being compared to
 *	@param: inputConfirm - id of the form input whose value should match that of inputOriginal
 *	@param: description - the error text that needs to be added to the error message
 */
function validateConfirmText(inputOriginal, inputConfirm, description) {
	if($("#"+inputOriginal).val() != $("#"+inputConfirm).val())
	{
		validateFailed(inputConfirm,description);
	}
}

/** 
 *	Tests whether an input field contains a valid password
 *	A password is valid if the input contains at least one letter, one number, and is at least 6 characters long
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validatePassword(inputID , description) {
	if($("#"+inputID).val().length < 6) validateFailed(inputID,description);
	
	else if( !(/[0-9]/.test($("#"+inputID).val())) || !(/[A-z]/.test($("#"+inputID).val()))) validateFailed(inputID,description);
}

/** 
 *	Tests whether an input field contains a valid phone number (US phone numbers, area code required)
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validatePhone(inputID, description) {
	/*if(!/^([\(]{1}[0-9]{3}[\)]{1}[ ]{1}[0-9]{3}[\-]{1}[0-9]{4})$/.test($("#"+inputID)) && !/^\+(?:[0-9] ?){6,14}[0-9]$/.test($("#"+inputID)))
	{
		validateFailed(inputID, description)
	}*/
	
	var regex = /^([0-9]{3}[\- ]{1}[0-9]{3}[\-]{1}[0-9]{4})$/;

	var regexInt = /^\+(?:[0-9] ?){6,14}[0-9]$/;
	
	if(!(regex.test($("#"+inputID).val())) && !(regexInt.test($("#"+inputID).val()))) {
		validateFailed(inputID, description)
	}
}

/** 
 *	Tests whether an input field contains a valid email address
 *	This function checks that the top level domain used exists, see isValidTLD()
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validateEmail(inputID, description) {

	if($("#"+inputID).val() == '') validateFailed(inputID,description);
	
	else {
		// get the location of the @ in the string
		var atLocation= $("#"+inputID).val().indexOf('@');
		
		// get the location of the period after the @
		var periodLocation= $("#"+inputID).val().indexOf('.',atLocation);
		
		// check the general syntax: Word characters before an '@', word characters betweeen '@' and '.', and word characters after the '.'
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w+)$/.test($("#"+inputID).val()))) validateFailed(inputID,description);
		
		//make sure the characters after the period after the @ match a top level domain
		else if(!isValidTLD($("#"+inputID).val().substring(periodLocation+1, $("#"+inputID).val().length))) {alert($("#"+inputID).val().substring(periodLocation+1, $("#"+inputID).val().length)); validateFailed(inputID,description)};
	}
}

/** 
 *	Tests whether an input field contains a valid number of volunteer hours. A number for volunteer hours is valid if it is:
 *		Over 0 but not more than 24
 *		A number that is an increment of 0.25
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validateHours(inputID)
{	
	var numHours= parseFloat($('#newHours').val());
	
	if($("#"+inputID).val() == '') {
		validateFailed(inputID, "You must enter the number of hours. Use quarter hour (.25) increments");
	}
	
	else if(numHours % 0.25 > 0) {
		validateFailed(inputID,"You must enter the number of hours in quarter hour (.25) increments.");
	}
	
	else if(numHours < 0.25) {
		validateFailed(inputID,"You must enter at least a quarter hour: 0.25");
	}
	
	else if(numHours < 0.25 || numHours > 24) {
		validateFailed(inputID,"You can not enter more than 24 volunteer hours for one day");
	}
}

/** 
 *	Tests whether an input field contains a valid date
 *	Date format: mm/dd/yyyy
 *	@author: Intuit
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validateDate(inputID , description)
{
	if(!valDate($("#"+inputID), description, true)) // true means the alert is hidden
	{
		if (this.valid) focusItem = $("#"+inputID);
		this.valid = false;
		if (description) {
			this.errMsg += description + "\n";
		}
		else {
			this.errMsg += inputID + "\n";
		}
	}
}

/** 
 *	Tests whether an input field contains a valid date that occurs no later than today
 *	Date format: mm/dd/yyyy
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function validatePastDate(inputID , description)
{
	if(!valPastDate(inputID, true)) // true means the alert is hidden
	{
		validateFailed(inputID, description)
	}
} // checkvalid_currentdate()


/**
 *	Checks whether the given text is a valid date
 *	@author: Intuit
 *	@param: dateVal - string to test
 *	@return: boolean - true if the text is a valid date, otherwise false
 */
function checkDate (dateVal) {

   if (/^(\d{2})([\/\.-]?)(\d{2})(\2)(\d{2}|\d{4})$/.test(dateVal) ||
      /^(\d{1,2})([\/\.-])(\d{1,2})(\2)(\d{2}|\d{4})$/.test(dateVal)) {
      this.month   = RegExp.$1 * 1;
      this.date    = RegExp.$3 * 1;
      this.year    = RegExp.$5 * 1;
      this.isValid = true;
   } else {
      this.isValid = false;
   } // end if-else
   return (this.isValid);
} // end fun checkDate

/**
 *	Converts a variable that is a Date object to a string
 *	@author: Intuit
 *	@param: dateOb - object to convert to a string
 *	@return: returns date as a string
 */
function parseDateOb2Str(dateOb)
{
	var sMonth = String(dateOb.getMonth() + 1);
	var sDate = String(dateOb.getDate());
	var sYear = String(dateOb.getFullYear());
	
	if(sMonth.length == 1) sMonth = '0' + sMonth;
	if(sDate.length == 1) sDate = '0' + sDate;
	
	var newDate = sMonth + '/' + sDate + '/' + sYear;
        return   String(newDate);
}


/** Validate and format date. Begin and end dates must be javascript date objects
 * e.g. <input type="text" name="date" onchange="valDate(this, 'Date of Foo')">
 *	@author: Intuit
 *	@param: f - input field whose value is being checked
 *	@param: desc - the error text that needs to be added to the error message
 *	@param: hideAlert - if true, do not show the in function alert regarding the text not being a valid date (used for inline validation)
 *	@return: boolean - true if the given strin is a valid date, otherwise false
 */
function valDate(f, desc, hideAlert) {
	var dateFlag, errorDesc = '';
	
	if (2 > arguments.length || arguments.length > 6) return;  

	dateFlag = new checkDate(f.val());
	//alert(dateFlag.isValid);
	if (dateFlag.isValid){
		var M = dateFlag.month;
		var D = dateFlag.date;
		var Y = dateFlag.year;
	
		if (Y < 100)
			Y = (Y <= 50) ? Y + 2000 : Y + 1900;
		if (M < 1 || M > 12) {
			errorDesc = " Invalid month.";
		}
		else {
			var ld = (Y % 400 == 0 || Y % 100 != 0 && Y % 4 == 0) ? "9" : "8";
			var maxdays = "312" + ld + "31303130313130313031";
			if (D < 1 || D > maxdays.substr ((M - 1) * 2, 2))
				errorDesc = " Invalid date.";
		} // end if-else
		
		var nDate = new Date(Y,(parseInt(M)-1),D);
		
		if (errorDesc.length == 0) {
			// Date is valid and in range; format it.
			f.value =  parseDateOb2Str(nDate);
		} // end if
   }
   
   else {
		errorDesc = "You have entered an invalid date. Please re-enter the date in an accepted format, e.g. 01/01/2000 for January 1, 2000.";
   } // end if-else

             
   if (errorDesc.length > 0) {
      //f.focus();
      //f.select();
      if (!hideAlert) alert(desc + ": " + errorDesc);
      return (false);
   } // end if
	return (true);
} // end fun valDate



/** Determinea if the date entered has occurred (today's date or earlier)
 *	@author: Benaiah Morgan
 *	@param: inputID - id of the form input which is being tested
 *	@param: description - the error text that needs to be added to the error message
 */
function valPastDate(inputID,hideAlert) {
	
	// if the format of the date entered is valid
	if (valDate($("#"+inputID), 'Date',hideAlert))
	{
		// check it against todays date
		// get today's date and the date currently in the input box
		var today= new Date();
		var userDate= new Date($("#"+inputID).val());
		
		// If today occurs before the entered date
		if (today < userDate) {
			// if not asked to hide the alert, tell the user they've entered a date in the future
			if (!hideAlert) {alert("You have entered a date after today's date. Please enter a date no later than today.");}
			
			// return that the date is not valid
			return false;
		}
		// otherwise return that the date is valid
		return true;
	}
	// otherwise return false
	else return false;
} // valPastDate()

/** BOOLEAN FUNCTIONS BELOW **/

/*
 *	Determines whether two strings are equal
 *	Two strings are equal if one has the same text as the other
 *	and both are of the same length
 *	@author: Benaiah Morgan
 *	@param: str1 - String to compare to str2
 *	@param: str2 - String to compare to str1
 *	@return: boolean - true if both strings are equal, otherwise false
 */
function isEqualStrings(str1,str2) {
	if (str1.indexOf(str2) == 0 && str1.length == str2.length) return true
	return false;
}

/** 
 *	Tests whether a string is a valid top level domain
 *	Valid TLDs found at IANA's website: http://data.iana.org/TLD/tlds-alpha-by-domain.txt
 *	@author: Benaiah Morgan
 *	@param: str - string to compare against list of known TLDs
 *	@return: boolean - true if str is a top level domain, otherwise false
 */
function isValidTLD(str) {
	var tldArray= new Array();
	tldArray= ['AC','AD','AE','AERO','AF','AG','AI','AL','AM','AN','AO','AQ','AR',
		'ARPA','AS','ASIA','AT','AU','AW','AX','AZ','BA','BB','BD','BE','BF','BG',
		'BH','BI','BIZ','BJ','BM','BN','BO','BR','BS','BT','BV','BW','BY','BZ','CA',
		'CAT','CC','CD','CF','CG','CH','CI','CK','CL','CM','CN','CO','COM','COOP',
		'CR','CU','CV','CX','CY','CZ','DE','DJ','DK','DM','DO','DZ','EC','EDU','EE',
		'EG','ER','ES','ET','EU','FI','FJ','FK','FM','FO','FR','GA','GB','GD','GE',
		'GF','GG','GH','GI','GL','GM','GN','GOV','GP','GQ','GR','GS','GT','GU','GW',
		'GY','HK','HM','HN','HR','HT','HU','ID','IE','IL','IM','IN','INFO','INT','IO',
		'IQ','IR','IS','IT','JE','JM','JO','JOBS','JP','KE','KG','KH','KI','KM','KN',
		'KP','KR','KW','KY','KZ','LA','LB','LC','LI','LK','LR','LS','LT','LU','LV',
		'LY','MA','MC','MD','ME','MG','MH','MIL','MK','ML','MM','MN','MO','MOBI','MP'
		,'MQ','MR','MS','MT','MU','MUSEUM','MV','MW','MX','MY','MZ','NA','NAME','NC',
		'NE','NET','NF','NG','NI','NL','NO','NP','NR','NU','NZ','OM','ORG','PA','PE',
		'PF','PG','PH','PK','PL','PM','PN','PR','PRO','PS','PT','PW','PY','QA','RE',
		'RO','RS','RU','RW','SA','SB','SC','SD','SE','SG','SH','SI','SJ','SK','SL',
		'SM','SN','SO','SR','ST','SU','SV','SY','SZ','TC','TD','TEL','TF','TG','TH',
		'TJ','TK','TL','TM','TN','TO','TP','TR','TRAVEL','TT','TV','TW','TZ','UA',
		'UG','UK','US','UY','UZ','VA','VC','VE','VG','VI','VN','VU','WF','WS','XN',
		'YE','YT','ZA','ZM','ZW'];
		
		for(i= 0; i < tldArray.length; i++) {
			if(isEqualStrings(str.toLowerCase(),tldArray[i].toLowerCase())) return true;
		}
		return false;
}