<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	indes.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
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
        <script type="text/javascript" src="javascripts/jquery.js"></script>
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
      
        <table border="0" align="center">
        
         <tr>
            <td align="center" valign="top" colspan="2">
            <img src="images/index_content.jpg" width="599" height="224"/>
             </td>
          </tr>
        <tr>
          <td align="left" height="150" valign="top">
              <table width="376"  border="0" valign="top"  align="left">
                <tr>
                  <td >
                  <p>
                      <ul>
                          <li class="ilog">Find the people who are the professionals.</li>
                          <li class="ilog">Make your profile and connect to the professionals world.</li>
                          <li class="ilog">Control your professional identity online</li>
                          <li class="ilog">Find Opportunities to get dream job.</li>
                      </ul>
                  </p>
                 </td>
                </tr>
            </table>             
         </td>
         <td height="150" width="219" align="right" valign="middle">
<?php

	// START FORM PROCESSING
	if(isset($_POST['submit'])){ 	// Form has been submitted.

		$errors = array(); 			// initialize an array to hold errors
		$message ='';
		
		$required_fields = array('username', 'password');
		foreach($required_fields as $fieldname) {
			if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
				$errors[] = $fieldname;
			}
		}
		
		$username = trim(strip_tags($_POST['username']));
		$password = trim(strip_tags($_POST['password']));
		$hashed_password = sha1($password);
		
		// check for existance
		if(empty($errors)) {

			$query = "SELECT id, active, admin
					 FROM user_login
					 WHERE username = '{$username}'
					 AND hashed_password = '{$hashed_password}'
					 LIMIT 1";
		 			
			$result_set = mysql_query($query, $connection);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// Success
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['id'] = $found_user['id'];
				$_SESSION['admin'] = $found_user['admin'];
				if($_SESSION['admin'] == 1) {
					redirect_to("admin.php?admin={$_SESSION['admin']}");
				} else {
					
					if($found_user['active'] != 0) {
						redirect_to("members.php?id={$_SESSION['id']}");
					} else {
						$message = "In correct!";
					}
				}
			} else {
				$message = "In correct!";
			}
		}
		 
	} 
?> 
              <table width="200" border="0" class="ilogintable" >
                <form action="index.php" method="post" id="log_form">
                <tr>
                  <td colspan="2" align="left">
                  <div class="ilogin">Sign in</div></td>
                </tr>
                <tr class="ilog">
                  <td>username</td>
                  <td><input type="text" name="username" id="username" /></td>
                </tr>
                <tr class="ilog">
                  <td>password</td>
                 <td><input type="password" name="password" id="password" /></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">
                  <input name="submit" type="submit"  value="Sign in"  />
                  <span class="join_txt">or <a href="register.php">Join MyProfile</a></span>  </td>
                </tr>
                <tr class="ilog">
                  <td colspan="2" align="center">
                   <?php
					  global $message;
					  if(!($message=='')){
						  echo "<span id=\"in_log_error\" style=\"visibility:visible\">$message</span>" . "<br />";
					  }
					?> 
                  </td>
                </tr>
                </form>
            </table>             
         </td>
          </tr>
          <tr>
            <td align="center" valign="bottom" colspan="2">
            <form action="search_results.php" method="get">
            <div class="m_index">
              Search by Person Name
              <input type="text" name="search_name" size="40" />
              <input name="search" type="submit" id="search_btn" value="Go"  />
            </div>
            </form>
             </td>
          </tr>
         </table>
    	
<?php require("includes/footer.php"); ?>	
<?php 
	ob_flush();  // flush the buffer 
?> 
               