<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	getuser.php		#
#################################################
	
?> 
<?php require_once("includes/connection.php"); ?>
<?php
	  $q = $_GET["q"];
	  
	  $query = "SELECT * FROM user_login 
				WHERE id = '".$q."' 
				AND active = 1";
	  $result_set = mysql_query($query);
	  
	  echo "<table class=\"auser_table\">
			<tr>
			<th class=\"mdata_table_th\">Firstname</th>
			<th class=\"mdata_table_th\">Lastname</th>
			<th class=\"mdata_table_th\">Username</th>
			<th class=\"mdata_table_th\">Email</th>
			<th class=\"mdata_table_th\">Registered Date</th>
			<th class=\"mdata_table_th\">Edit User</th>
			<th class=\"mdata_table_th\">Bann User</th>
			<th class=\"mdata_table_th\">Delete User</th>
			</tr>";
	  
	  
	  //show the users
	  while($row = mysql_fetch_array($result_set))
		{
		echo "<tr>";
		echo "<td class=\"mdata_table_td\">{$row['firstname']}</td>";
		echo "<td class=\"mdata_table_td\">{$row['lastname']}</td>";
		echo "<td class=\"mdata_table_td\">{$row['username']}</td>";
		echo "<td class=\"mdata_table_td\">{$row['email']}</td>";
		echo "<td class=\"mdata_table_td\">{$row['reg_date']}</td>";
		echo "<td class=\"mdata_table_td\"><a href=\"admin_useredit.php?id={$row['id']}\">Edit</a></td>";
		echo "<td class=\"mdata_table_td\"><a href=\"ban_user.php?id={$row['id']}\" onClick=\"return ban_confirm();\">Bann</a></td>";
		echo "<td class=\"mdata_table_td\"><a href=\"delete_user.php?id={$row['id']}\" onClick=\"return delete_confirm();\">Delete</a></td>";				
		echo "</tr>";
		}
	  echo "</table>";
	  
?>
<?php
	mysql_close($connection);
?> 
