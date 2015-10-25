<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	Admin_user_eduremove.php#
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
		$query = "DELETE FROM user_edu
				  WHERE id = {$_GET['rid']}
				  LIMIT 1";
	  
		$result = mysql_query($query);
		if (isset($result)) {
			redirect_to("admin_useredit.php?id={$_GET['id']}");
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