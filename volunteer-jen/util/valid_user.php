<?php
	/**
	** @author: Benaiah Morgan
	**/
	// verify user is logged in as a valid user
	// if not redirect to index page to login
	if (!isset($_SESSION['is_valid_user'])) {
		header("Location: ../index.php");
	}
?>