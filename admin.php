<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	Admin.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php admin_confirm(); ?>
<?php confirm_logged_in(); ?>
<?php
	 $id = $_SESSION['admin'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="keywords" content="MyProfile, Online CV, Professionals Profile" />
        <title>Admin | MyProfile</title>
        <script type="text/javascript" src="javascripts/validation.js"></script>
        <link href="stylesheets/form_style.css" type="text/css" rel="stylesheet">
        <link href="stylesheets/template.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
			function showUser(str)
			{
			if (str==""){
			  document.getElementById("result").innerHTML="";
			  return;
			} 
			  if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			  }
			  else {// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  	xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				  document.getElementById("result").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","getuser.php?q="+str,true);
			xmlhttp.send();
			}
		</script>
    </head>
    <body>
    <div id="container">
        <!-- Beginning of Banner -->
        <div id="banner">
        <img src="images/site_logo.png" />
        </div>
        <!-- End of Banner -->
        <!-- Beginning of Top navigation -->
        <div class="mattblacktabs">
          <ul>
                <li><a href="index.php" title="Home">Home</a></li>                
                <li><a href="members.php?id=<?php echo $_SESSION['admin']; ?>" title="Edit Profile">Edit Profile</a></li>
                <li><a href="admin.php" title="Admin">Admin</a></li>
          </ul>
        </div>
        <!-- End of Top navigation -->
        <!-- Beginning of Main Content -->
    	<div id="ad_content">
		<div id="apDiv1" align="right">
            <?php 
                // Display Logged user, First Name & Last Name.
                if($id) {
                    echo "<a href=\"logout.php\">Logout! " . "</a>  .. Welcome Admin"; 
                }
            ?>
        </div>
 
        <div class="a_interface">
        <div class="a_head">Welcome to Administrator area</div> 
        <div class="aview" >
        <div style="color:#09C; text-align:right">Registered users : 
		  <?php 
          $query = "SELECT id FROM 
                    user_login";
          $result_set = mysql_query($query);
          $nums_row = mysql_num_rows($result_set);
          if($result_set) {
              echo " " . $nums_row;
          }
          ?>
          </div>
        </div>
        <div class="aview" ><span style="color:#09C">View active users</span></div>
          
          <div class="aview">
          <form name="users">
          <select name="username" onchange="showUser(this.value)">
            <option value="">Select a user:</option>
            <?php
				  $query = "SELECT * FROM user_login 
							WHERE active=1 
							AND admin=0 
							ORDER BY reg_date DESC ";
				  $result_set = mysql_query($query);
				  while ($row = mysql_fetch_assoc($result_set)) {
				  	echo "<option value=\"{$row['id']}\">{$row['username']}</option>";
				  }
			?>
   
            </select>
          </form>
          <br />
          <div  id="result"></div>
          </div>
          <div class="aview" ><span style="color:#09C">Banned Users</span></div>
          <div class="aview">
          <table class="auser_table" align="center">
             <tr>
               <th class="mdata_table_th">Firstname</th>
               <th class="mdata_table_th">Lastname</th>
               <th class="mdata_table_th">username</th>
               <th class="mdata_table_th">email</th>
               <th class="mdata_table_th">Registered Date</th>
               <th class="mdata_table_th">Action</th>
            </tr>
            <tr>
            <?php
				  $query = "SELECT * FROM user_login 
							WHERE active = 0 
							ORDER BY reg_date ASC ";
				  $result_set = mysql_query($query);
				  for ($count = 0; $row = mysql_fetch_array($result_set); $count++) {
            ?>
              <td class="mdata_table_td"><?php echo $row[1] ?></td>
              <td class="mdata_table_td"><?php echo $row[2] ?></td> 
              <td class="mdata_table_td"><?php echo $row[3] ?></td> 
              <td class="mdata_table_td"><?php echo $row[5] ?></td> 
              <td class="mdata_table_td"><?php echo $row[6] ?></td> 
              <td class="mdata_table_td"><a href="unban_user.php?id=<?php echo $row['id']; ?>" onClick="return unban_confirm();">Active</a></td>
            </tr>
            <?php } ?> 
         </table>
        </div>
        </div>	
<?php require("includes/footer.php"); ?>
<?php 
	ob_flush();  // flush the buffer 
?> 