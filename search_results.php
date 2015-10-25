<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	search_results.php	#
#################################################
	
?> 
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php 
	if (isset($_SESSION['id'])) {
		$user_id = $_SESSION['id'];
		
		$query = "SELECT firstname, lastname
				FROM user_login 
				WHERE id = {$user_id}";
				
		$result_set = mysql_query($query);
		$row = mysql_fetch_array($result_set);
		if (isset($row)) {
		  $firstname  = $row['firstname'];
		  $lastname =  $row['lastname'];
		} else {
		  die ("Connection Failed!");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="keywords" content="MyProfile, Online CV, Professionals Profile" />
        <title>MyProfile</title>
        <link href="stylesheets/form_style.css" type="text/css" rel="stylesheet">
        <link href="stylesheets/template.css" rel="stylesheet" type="text/css" />
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
                <li><a href="whymp.php" title="Why MyProfile?">Why MyProfile?</a></li>
                <li><a href="register.php" title="Join Today">Join Today</a></li>
                <li><a href="login.php" title="Sign in">Sign in</a></li>
            </ul>
        </div>
        <!-- End of Top navigation -->
        <!-- Beginning of Main Content -->
        <div id="content">
        <div id="apDiv1" align="right">
        <?php 
                // Display Logged user, First Name & Last Name.
                if(isset($user_id)) {
                    echo "<a href=\"logout.php\">Logout! " . "</a>  .. " . $firstname . " " .  $lastname; 
                }
        ?>
      </div>
      <div class="s_interface">
      
        <table width="580" border="0">
          <tr>
<?php
	
	  $message = '';
	  if($_GET['search_name'] != ''){
		  
		  $search_name = $_GET['search_name'];
		  $query1 = mysql_query("SELECT id, username, avatar_location, keywords FROM user_login  WHERE active = 1 AND keywords  LIKE '%$search_name%'");				  
		  if(mysql_num_rows($query1) != 0) {
			  for ($count = 0; $result1 = mysql_fetch_array($query1); $count++) {
				 $query2 = mysql_query("SELECT pro_headline, country, industry FROM user_basic  WHERE user_id = {$result1['id']}");
				 for ($a = 0; $result2 = mysql_fetch_array($query2); $a++) {
					 $r = $result2['pro_headline'] . "<br />";
					 $r .= $result2['country'] . " | " . $result2['industry']. "<br />";
				 }
?>
		  <td valign="top" class="s_td" align="left" width="50">
		  <?php
				  echo "<img src=\"{$result1['avatar_location']}\" width=\"50\" height=\"50\"/>";
		   ?>
		  </td>
		  <td valign="top" align="left" class="s_td">
		  <?php
				  echo "<span class=\"search_result\">" . $result1['keywords'] . "</span><br />";
				  global $r;
				  echo $r;
		   ?>
		  </td>
		  <td valign="top" align="right" width="100" class="s_td">
		  <?php
				  echo "<div id=\"search_resultlink\"><a href=\"view_profile.php?user={$result1['username']}\">View Profile</a></div>";
		   ?>
		  </td>
		</tr>
<?php  
			  }
		  } else {
				$message = "!Opps <strong>{$search_name}</strong> is not our member.";
		  }
		
	  } else {
			$message = "!Please specify at least a first name or a last name";
	  }

?>	            
          </table>
        <?php
			global $message;
			if(!($message=='')){
				echo "<span id=\"search_error\" style=\"visibility:visible\">$message</span>" . "<br />";
			}
	  ?>
      </div>	
	</div>
	<!-- End of Main Content -->
	<!-- Beginning of Footer -->
	<div id="footer">
    	<p><a href="view_profile.php?user=administrator">About Me</a> | <a href="contact.php">Contact</a></p>
        <p>--------------------</p>
		<p>MyProfile Corporation &#169 2010. All Rights Reserved</p>
		<p>Developed by : S. M. Thushara Sampath</p>
        <p>Sri Lanka</p>
	</div>

	<!-- End of Footer --></div>
</body>
</html>	
