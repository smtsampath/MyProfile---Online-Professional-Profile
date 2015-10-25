<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	ajax_check_username.php	#
#################################################
	
?> 
<?php require_once("includes/connection.php"); ?>
<?php
	$username = trim(strip_tags($_POST['username']));//Some clean up :)
	if(isset($username))//If a username has been submitted 
	{
		
		
		$query = "SELECT username FROM user_login WHERE username='$username'";
		
		$check = mysql_query($query, $connection);
		$check_num_rows = mysql_num_rows($check);
		//Query to check if username is available or not 
		
		if($check_num_rows == 0)
		{
			echo "0";//No Record Found - Username is available 
			
		}
		else
		{
			echo "1";//If there is a  record match in the Database - Not Available 
			
		}
	
	}
?>

