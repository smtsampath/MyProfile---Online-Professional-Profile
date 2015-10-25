<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	unban_user.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php admin_confirm(); ?>
<?php confirm_logged_in(); ?>
<?php
		$query = "UPDATE user_login SET
				  active = '1'
				  WHERE id = {$_GET['id']}
				  LIMIT 1";
	  
		$result = mysql_query($query);
		if (isset($result)) {
			redirect_to("admin.php?viewUsers");
		} else {
		  	die("Databased Query Failed");
		}
?>
<?php
	mysql_close($connection);
?>
<?php 
	ob_flush();  // flush the buffer 
?> 