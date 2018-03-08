<?php
	//Change the default error function to the custom one below
	set_error_handler("doerrorstuff");
	
	/**Login credentials
	* @author: Woodland Rangers
	*/
	$dsn = 'localhost';
	$username = 'root';
	$password = '';
	$db_name = 'db358933030';
	
	/**MySQLi Connection 
	* @author: Woodland Rangers
	*/
	$conn = mysqli_connect($dsn, $username, $password, $db_name) or die("Connection failed: " . mysqli_connect_error());
	
	/**
	 * Custom error function sends an email of the error to the webmaster 
	 * @param: errno - The number of the error
	 * @param: errstr - The text describing the error
	 * @author: Benaiah Morgan
	 */
	function doerrorstuff($errno, $errstr, $errfile, $errline) {
		switch ($errno) {
			case E_NOTICE:
				break;
        	case E_USER_NOTICE:
				break;
			case E_WARNING:
				break;
        	case E_USER_WARNING:
				break;
        	case E_STRICT:
				break;
        	case E_RECOVERABLE_ERROR:
				error_log("Recoverable Error: [$errno] $errstr $errfile $errline",1, "webmaster@friendsofsmithgallwoods.org","From: webmaster@friendsofsmithgallwoods.org");
				break;
        	case E_DEPRECATED:
				//error_log("Deprecated: [$errno] $errstr $errfile $errline",1, "webmaster@friendsofsmithgallwoods.org","From: webmaster@friendsofsmithgallwoods.org");
				break;
        	case E_USER_DEPRECATED:
				//error_log("Deprecated: [$errno] $errstr $errfile $errline",1, "webmaster@friendsofsmithgallwoods.org","From: webmaster@friendsofsmithgallwoods.org");
				break;
			default:
				error_log("Error: [$errno] $errstr $errfile $errline",1, "webmaster@friendsofsmithgallwoods.org","From: webmaster@friendsofsmithgallwoods.org");
	//added duplicate mail for  debugging. dme 1/18/2013
				error_log("Error: [$errno] $errstr $errfile $errline",1, "drdan@uga.edu","From: webmaster@friendsofsmithgallwoods.org");
				echo "<script>self.location = '/volunteer/error/error.php'</script>";
				die();
				break;
		}
	}	
?>
