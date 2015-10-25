<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	connection.php		#
#################################################
	
?>
<?php
	require("constants.php");
	
	// 1. Create a database connection
	$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if (!$connection) {
		die("Opps some thing went wrong");
	}
	
	// 2. Select a database to use
	$db_select = mysql_select_db(DB_NAME, $connection);
	if (!$db_select) {
		die("Opps some thing went wrong");
	}
	
?>