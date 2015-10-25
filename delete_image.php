<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	delete_image.php	#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php
		$avatar_location = "up_avatars/default-avatar.gif";
		
		$query = "UPDATE user_login SET
				  avatar_location = '{$avatar_location}'
				  WHERE id = {$_GET['id']}";
		
		$result = mysql_query($query, $connection);
		if (isset($result)) {
			redirect_to("members.php?id={$_GET['id']}");
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