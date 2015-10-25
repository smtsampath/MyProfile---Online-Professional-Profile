<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	register.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php

	if(logged_in() && ($_SESSION['admin'] == 1)) {
		redirect_to("admin.php");
	}
	if(logged_in() && ($_SESSION['admin'] == 0)) {
		redirect_to("members.php?id={$_SESSION['id']}");
	}
	
	// START FORM PROCESSING
	if(isset($_POST['submit'])){ // Form has been submitted.
		
		
		$message =''; // initialize $error to blank
		
		
		$firstname = trim(mysql_prep($_POST['firstname']));
		$lastname = trim(mysql_prep($_POST['lastname']));
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$re_password = trim(mysql_prep($_POST['re_password']));
		$email = trim(mysql_prep($_POST['email']));
		$s_question = $_POST['s_question'];
		$s_answer = trim(mysql_prep($_POST['s_answer']));
		$avatar_location = "up_avatars/default-avatar.gif";
		$date = date("Y-m-d H:i:s");
		$keywords = $firstname . " " . $lastname;
		
		// check for existance
		if($firstname && $lastname && $username && $password && $re_password && $email && $s_question && $s_answer) {
					
					
					$query = "SELECT email FROM user_login WHERE email='$email'";
					$check = mysql_query($query, $connection);
					$num_rows = mysql_num_rows($check);
					
					// check email format is valid
					if(!preg_match("/.+@.+\..+/", $email)) { 
						$message = "Please enter a valid email address"; 
					}
					elseif($num_rows != 0) {
						$message = "There is an existing account associated with this email.";
					}
					else {
						
						$query = "SELECT username FROM user_login WHERE username='$username'";
	
						$check = mysql_query($query, $connection);
						$check_num_rows = mysql_num_rows($check);
						//Query to check if username is available or not 
						
						if($check_num_rows == 0) {	
											
							if(strlen($password)< 6 || strlen($re_password) < 6){
								$message = "Your passwords must be at least 6 characters in length!";
							} elseif($password != $re_password) {
								$message = "Your passwords does not match";
							} else {
								// encrypt password
								$hashed_password = sha1($password);
								
								$query = "INSERT INTO user_login (
										  firstname, lastname, username, hashed_password, email, reg_date, s_question, s_answer, avatar_location, active, admin, keywords
										  ) VALUES (
										  '{$firstname}', '{$lastname}', '{$username}', '{$hashed_password}', '{$email}', '{$date}', '{$s_question}', '{$s_answer}', '{$avatar_location}', 1, 0, '{$keywords}'
										  )";
														 
								$result_set = mysql_query($query, $connection);
								if (isset($result_set)) {
									// Success 
									redirect_to("register_confirm.php");
								} else {
									$message =  "Opps some thing went wrong";
								}
							}
						}
						else
						{
							$message = "Please re check your username!";
							
						}
					}
		}
		 
	} else {
		$firstname = "";
		$lastname = "";
		$username = "";
		$password = "";
		$re_password = "";
		$email = "";
	}
?> 
<?php require("includes/header.php"); ?>
    	<div id="header">
			<p>Sign Up for MyProfile</p>
			<p class="hinfo">Join to establish your professional profile and share your cv. </p>
		</div>
        <div id="register_form">
       <form action="register.php?add" method="post" id="reg_form" onsubmit="javascript:return email_validate('reg_form','email');">

        <div class="style_form" >
          <label for="firstname">First Name :</label>
          <input type="text" name="firstname" id="firstname" class="form_element" value="<?php echo  mysql_prep($firstname); ?>" />
          </div>
        <div class="style_form">
          <label for="lastname">Last Name :</label>
          <input type="text" name="lastname" id="lastname" class="form_element" value="<?php echo  mysql_prep($lastname); ?>" />
        </div>
        <div class="style_form">
          <label for="username">Username :</label>
          <input type="text" name="username" id="username" class="form_element"  value="<?php echo  mysql_prep($username); ?>" />
        <span id="availability_status"></span> </div>
        <div class="style_form">
          <input type="button" onClick="username_validate();" value="check availability" id="check_available"/ ><br />
        </div>
        <div class="style_form">
          <label for="password">Password :</label>
          <input type="password" name="password" id="password" class="form_element" onkeyup="return password_strength()" value="<?php echo  mysql_prep($password); ?>"/>
        <span id="strength_status"></span></div>
        <div class="style_form">
          <label for="re_password">Confirm Password :</label>
          <input type="password" name="re_password" id="re_password" class="form_element" onchange="return confirm_password()"  value="<?php echo  mysql_prep($re_password); ?>"/>
        <span id="confirmation_status"></span></div>
        <div class="style_form">
          <label for="email">Email  :</label>
          <input type="text" name="email" id="email" class="form_element"  value="<?php echo  mysql_prep($email); ?>" />
        </div>
        <div class="style_form">
          <label for="s_question" >Security Question :</label>
          <select class="m_sel_element" name="s_question" id="s_question">
          <?php 
			  	if($squestion != "") {
					echo "<option value=\"{$squestion}\" selected=\"selected\" ></option>";
				} else { ?>
                  <option value="" >Choose a question...</option>
                  <option value="SQ1" >What is your first phone number?</option>
                  <option value="SQ2" >What was the name your first teacher?</option>
                  <option value="SQ3" >What was your favorite book?</option>
                  <option value="SQ4" >Who is your favorite author?</option>
                  <option value="SQ5" >what was your first pet's name?</option>
         <?php } ?>   
        </select>
        </div>
        <div class="style_form">
          <label for="s_answer">Answer :</label>
          <input type="text" name="s_answer" id="s_answer" class="form_element"  value="" />
        </div>
        <div class="style_form">
          <p>
            <input name="submit" type="submit"  value="Register" id="submit_btn"  onclick="return reg_form_validate()" />
            <br/>
            <div class="login_txt">Already on MyProfile? <a href="login.php"> Sign in.</a> </div>
          </p>
        </div>    
        <?php
              global $message;
                  if(!($message=='')){
                  echo "<span id=\"reg_error\" style=\"visibility:visible\">$message</span>";
              } else {
                  echo "<span id=\"reg_error\"></span>";
              }
        ?>
       
        
      </form>	
      </div>
<?php require("includes/footer.php"); ?>
<?php 
	ob_flush();  // flush the buffer 
?> 