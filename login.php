<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	login.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	
	if(logged_in() && ($_SESSION['admin'] == 1)) {
		redirect_to("admin.php");
	}

	if(logged_in() && ($_SESSION['admin'] == 0)) {
		redirect_to("members.php?id={$_SESSION['id']}");
	}
	
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
						$message = "Your account is tempary banned!<br/>
						  			Please contact administrator.";
					}
				}
			} else {
				$message = "Username / Password combination incorrect.<br/>
						  Please make sure your caps lock key is off and try again.";
			}
		}
		 
	} else {
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out.";
		}
		$username = "";
		$password = "";
	}
?> 
<?php require("includes/header.php"); ?>
  		<div id="header">
			<p>Sign in to MyProfile</p>
		</div>
        <div id="login_form">
       	<form action="login.php" method="post" id="log_form" >
         <?php
              global $message;
                  if(!($message=='')){
                  echo "<span id=\"log_error\" style=\"visibility:visible\">$message</span>" . "<br />";
              } else {
                  echo "<span id=\"log_error\"></span>" . "<br />";
              }
        ?> 
        
        <div class="style_form">
          <label for="username">Username :</label>
          <input type="text" name="username" id="username" class="form_element"  value="<?php echo  strip_tags($username); ?>" />
        </div>
        <div class="style_form">
          <label for="password">Password :</label>
          <input type="password" name="password" id="password" class="form_element" />
        	<span class="join_txt"><a href="password_assistants.php">forgot password?</a></span>  
        </div>
        <div class="style_form">
          <p>
            <input name="submit" type="submit"  value="Sign in" id="login_btn"  onclick="return login_form_validate()" />
            <span class="join_txt">or <a href="register.php">Join MyProfile</a></span>      
          </p>
        </div>
      </form>	
      </div>
<?php require("includes/footer.php"); ?>
<?php 
	ob_flush();  // flush the buffer 
?> 
