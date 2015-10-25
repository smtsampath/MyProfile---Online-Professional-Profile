<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	logout.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php

	// Unset all the session variables
	$_SESSION = array();

	// Destroy the session cookie
	if(isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	
	// Destroy the session
	session_destroy();
	
	redirect_to("login.php?logout=1");
	
?>
<?php 
	ob_flush();  // flush the buffer 
?> 