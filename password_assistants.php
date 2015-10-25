<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	password_assistants.php	#
#################################################
	
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
                <li><a href="whymp.php" title="What is MyProfile">What is MyProfile</a></li>
                <li><a href="register.php" title="Join Today">Join Today</a></li>
                <li><a href="login.php" title="Sign in">Sign in</a></li>
                
            </ul>
        </div>
        <!-- End of Top navigation -->
        <!-- Beginning of Main Content -->
    	<div id="content">


        <div class="a_head">Password Assistance</div> 
        <div class="aview" ><span class="vtd">Please enter the email address you used to create your  MyProfile account, and we will send you a link to reset your password.
        </span></div>
		<?php
                if(isset($_POST['submit'])) {
                    
                    $message='';
                        
                    if(!$_POST['email']){
                        $message = "Please enter a value"; 
                    }
                    elseif(!preg_match("/.+@.+\..+/", $_POST['email'])) { 
                        $message = "Please enter a valid email address"; 
                    } else {
                        $success_message = "If <strong>{$_POST['email']}</strong> is in our records, we will send a link to reset your password to that address.";
                    }
                }
        
        ?>
        <div id="login_form">
		<form action="password_assistants.php" method="post" id="reset_form">
 		<div class="style_form">
          <label for="email" class="mlabel">Email  :</label>
          <input type="text" name="email" id="email" class="form_element"  value="" />
        </div>
         <div class="style_form">
          <p>
            <input name="submit" type="Submit"  value="Submit Address" id="submit_btn"  onclick="return reg_form_validate()" />
          </p>
        </div>
        </form>
         <?php
              global $message;
			  global $success_message;
              if(!($message=='')){
                  echo "<span id=\"reg_error\" style=\"visibility:visible\">$message</span>";
              } elseif(!($success_message=='')){
			  	  echo "<span id=\"mform_sucess\" style=\"visibility:visible\">$success_message</span>";
              } else {
                  echo "<span id=\"reg_error\"></span>";
				  echo "<span id=\"mform_sucess\"></span>";
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