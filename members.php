<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	members.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?> 
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
	
	$user_id = $_SESSION['id'];
	
	$error_message='';  		// initialize error message
	$success_message='';		// initialize success message

?>
<?php

	  // User Login information Table
	  $query = "SELECT *
				FROM user_login 
				WHERE id = {$user_id}";
				
	  $result_set = mysql_query($query);
	  $row = mysql_fetch_array($result_set);
	  if (isset($row)) {
		$firstname  = $row['firstname'];
		$lastname =  $row['lastname'];
		$username = $row['username'];
		$avatar_location = $row['avatar_location'];
	  } else {
	  	$error_message =  "Connection Failed!";
	  }
?>
<?php

	  // User Login information Table
	  if(isset($_POST['linfo_update'])){
		
		  $firstname = trim(mysql_prep($_POST['firstname']));
		  $lastname = trim(mysql_prep($_POST['lastname']));
		  $password = trim(mysql_prep($_POST['password']));
		  $re_password = trim(mysql_prep($_POST['re_password']));
			  
			  
		  if($firstname == "" || $lastname == "" || $password == "" || $re_password == "" ) {
				$error_message = "* Please fill the required fieds.";
		  } else {
			  
			  if(strlen($password)< 6 || strlen($re_password) < 6){
				  $error_message = "Your passwords must be at least 6 characters in length!";
			  } elseif($password != $re_password) {
				  $error_message = "Your passwords does not match";
			  } else {
				  // encrypt password
				  $hashed_password = sha1($password);
					  
				  $query = "UPDATE user_login SET 
						  firstname = '{$firstname}', 
						  lastname = '{$lastname}', 
						  hashed_password = '{$hashed_password}'
						  WHERE id = {$user_id}";
			  
				  $result = mysql_query($query, $connection);
				  if (isset($result)){
					// Success.
					 $success_message =  "Login Information Successfully updated.";
				  } else {
				  	// Display error_message.
					 $error_message =  "Opps some thing went wrong";
				  }
			  }
		
		  }
	  }
?>
<?php

		// User Basic information Table
		$query = "SELECT *
				  FROM user_basic 
				  WHERE user_id = {$user_id}";
		$result_set = mysql_query($query);
		$num_rows = mysql_num_rows($result_set);
		$row = mysql_fetch_array($result_set);
		if (isset($row)) {
		  $pro_headline = $row['pro_headline'];
		  $country = $row['country']; 
		  $industry = $row['industry'];
		  $tel_number  = $row['tel_number'];
		  $tel_type =  $row['tel_type'];
		  $IM_name = $row['IM_name'];
		  $IM_type = $row['IM_type'];
		  $address = $row['address'];
		  $b_day = $row['b_day'];
		  $gender = $row['gender'];
		  $marital = $row['marital']; 
		  $about = $row['about'];
		} else {
		  $error_message =  "Connection Failed!";
		}
?>
<?php
	  
	  // User Basic information Table
	  if(isset($_POST['binfo_submit'])){
		  
			  $pro_headline = trim(mysql_prep($_POST['pro_headline']));
			  $country = $_POST['country'];
			  $industry = trim(mysql_prep($_POST['industry']));
			  $tel_number  = trim(mysql_prep($_POST['tel_number']));
			  $tel_type =  $_POST['tel_type'];
			  $IM_name = trim(mysql_prep($_POST['IM_name']));
			  $IM_type = $_POST['IM_type'];
			  $address = trim(mysql_prep($_POST['address']));
			  $b_day = trim(mysql_prep($_POST['b_day']));
			  $gender = $_POST['gender'];
			  $marital = $_POST['marital'];
			  $about = trim(mysql_prep($_POST['about']));
			  
			  if($pro_headline == "" || $country == "" || $industry == "" || $tel_number == "" || $tel_type == "" || $address == "" || $b_day == "" || $gender == "") {
					$error_message = "* Please fill the required fieds.";
		  	  } else {
				  if($num_rows == "0") {
					  $query = "INSERT INTO user_basic (
								user_id, pro_headline, country, industry, tel_number, tel_type, IM_name, IM_type, address, b_day, gender, marital, about
								) VALUES (
								{$user_id}, '{$pro_headline}', '{$country}', '{$industry}', '{$tel_number}', '{$tel_type}', '{$IM_name}', '{$IM_type}', '{$address}', '{$b_day}', '{$gender}', '{$marital}', '{$about}'
								)";
					  
					  $result = mysql_query($query, $connection);
					  if (isset($result)){
						// Success.
						 $success_message =  "Basic Information entered Successfull.";
					  } else {
						// Display error_message.
						 $error_message =  "Opps some thing went wrong";
					  }
					  
				  } else {
						$query = "UPDATE user_basic SET 
								pro_headline = '{$pro_headline}', 
								country = '{$country}', 
								industry = '{$industry}',
								tel_number = '{$tel_number}', 
								tel_type = '{$tel_type}',
								IM_name = '{$IM_name}', 
								IM_type = '{$IM_type}',
								address = '{$address}', 
								b_day = '{$b_day}', 
								gender = '{$gender}',
								marital = '{$marital}',
								about = '{$about}' 
								WHERE user_id = {$user_id}";
					
						$result = mysql_query($query, $connection);
						if (isset($result)){
						  // Success.
						   $success_message =  "Basic Information Successfully updated.";
						} else {
						  // Display error_message.
						   $error_message =  "Opps some thing went wrong";
						}
					}
			  }
		  
	  }
?>
<?php

	  // User upload image Table
	  if(isset($_POST['img_upload'])){
		  
		  	$display_avatar='';
	  
			$name = mysql_prep($_FILES['avatar']['name']);
		  	$tmp_name = $_FILES['avatar']['tmp_name'];
			
			if($name) {
				
				$exten = explode( ".", $_FILES['avatar']['name']);
				$exten = $exten['1'];
							
				if( 
					( $exten == "jpg" )
				||	( $exten == "JPG" )	
				||	( $exten == "png" )
				||	( $exten == "PNG" )
				||	( $exten == "jpeg")
				||	( $exten == "JPEG")
				||	( $exten == "gif" )
				||	( $exten == "GIF" )
				||	( $exten == "bmp" )
				||	( $exten == "BMP" ) ) {
				
					$location = "up_avatars/" . $username . "." . $exten;
					@move_uploaded_file($tmp_name, $location); 
					
					$query = "UPDATE user_login SET
							  avatar_location = '{$location}'
							  WHERE id = {$user_id}";
					
					$result_set = mysql_query($query, $connection);
					if(isset($result_set)) {
						$success_message = "your avatar has been uploded!";
					} else {
						$error_message = "Opps some thing went wrong";
					}
				
				
				} else {
					$error_message = "Invalid file format!";
				}
			}
			else {
				$error_message = "Please select a image file before upload!";
			}
			
	  }
	 
?> 
<?php
	  // User CV upload Table
	  if(isset($_POST['cv_upload'])){
	  
			$name = mysql_prep($_FILES['mycv']['name']);
		  	$tmp_name = $_FILES['mycv']['tmp_name'];
			$size = $_FILES['mycv']['size'];
			$type = $_FILES['mycv']['type'];
	
			if($name) {
				
				$exten = explode( ".", $_FILES['mycv']['name']);
				$exten = $exten['1'];
							
				if( 
					( $exten == "pdf" )
				||	( $exten == "PDF" )) {
				
					$cv_location = "up_cvs/" . $username . "." . $exten;
					@move_uploaded_file($tmp_name, $cv_location); 
					
					$query = "SELECT * 
							  FROM up_cvs 
							  WHERE user_id = {$user_id}";
					$result_set = mysql_query($query);
					$num_rows = mysql_num_rows($result_set);
					
					if($num_rows == "0") {
					
						$query = "INSERT INTO up_cvs (
								  user_id, file_size, file_type, cv_location 
								  ) VALUES (
								  {$user_id}, '{$size}', '{$type}', '{$cv_location}'
								  )";
						
						$result_set = mysql_query($query, $connection);
						if(isset($result_set)) {
							$success_message = "your cv has been uploaded!";
						} else {
							$error_message = "Opps some thing went wrong";
						}
					} else {
						$query = "UPDATE up_cvs SET
								  file_size = '{$size}',
								  file_type = '{$type}',
								  cv_location = '{$cv_location}'
								  WHERE user_id = {$user_id}";
						
						$result_set = mysql_query($query, $connection);
						if(isset($result_set)) {
							$success_message = "your cv has been updated!";
							} else {
							$error_message = "Opps some thing went wrong";
						}
					}
				
				} else {
					$error_message = "Invalid file format!";
				}
			}
			else {
				$error_message = "Please select a cv file before upload!";
			}
			
	  }
	 
?> 
<?php
	  // User Projects upload Table
	  if(isset($_POST['project_submit'])){
		  
		  $project_name  = trim(mysql_prep($_POST['project_name']));
		  $about_project =  trim(mysql_prep($_POST['about_project']));
		  $name = $_FILES['myproject']['name'];
		  $tmp_name = $_FILES['myproject']['tmp_name'];
		  $pro_size = $_FILES['myproject']['size'];
		  $pro_type = $_FILES['myproject']['type'];
		  
		  if($project_name && $about_project && !$name) {
				$query = "INSERT INTO user_projects (
						  user_id, project_name, about_project 
						  ) VALUES (
						  {$user_id}, '{$project_name}', '{$about_project}'
						  )";
				  
				$result_set = mysql_query($query, $connection);
				if(isset($result_set)) {
					$success_message = "your projects data has been submitted!";
				} else {
					$error_message = "Opps some thing went wrong";
				}
		  
			} elseif($project_name && $about_project && $name) {
		
				$exten = explode( ".", $_FILES['myproject']['name']);
				$exten = $exten['1'];
							
				if( 
					( $exten == "rar" )
				||	( $exten == "RAR" )	
				||	( $exten == "zip" )
				||	( $exten == "ZIP" ) ) {
				
					$pro_location = "up_projects/" . time() . "." . $exten;
					@move_uploaded_file($tmp_name, $pro_location); 
										  
					$query = "INSERT INTO user_projects (
							  user_id, project_name, about_project, file_size, file_type, project_location 
							  ) VALUES (
							  {$user_id}, '{$project_name}', '{$about_project}', '{$pro_size}', '{$pro_type}', '{$pro_location}'
							  )";
					
					$result_set = mysql_query($query, $connection);
					if(isset($result_set)) {
						$success_message = "your projects data and file has been uploaded!";
					} else {
						$error_message = "Opps some thing went wrong";
					}
				
				} else {
					  $error_message = "Invalid file format!";
				}
	  
			} else {
				  $error_message = "* Please fill the required fieds.";
			}
			  
	  }

?> 
<?php require("includes/header.php"); ?>
		<div class="mview" >
     		<a href="view_profile.php?user=<?php echo $username; ?>&amp;id=<?php echo $user_id; ?>" title="View Profile">View Profile</a>
        </div>
        <div class="mview" >
         <table width="585" border="0">
          <tr>
            <td width="385" align="right"><?php echo  $firstname . " " .  $lastname; ?></td>
            <td width="200" align="center" rowspan="3">
            <?php
				  global $avatar_location;
                  global $location;
                  if(isset($location)){
                      echo "<img src=\"{$location}\" width=\"100px\" height=\"100px\" >";
                  } else {
				  	 echo "<img src=\"{$avatar_location}\" width=\"100px\" height=\"100px\" >";
				  }
            ?>
            </td>
          </tr>
          <tr>
            <td align="right" ><?php echo  $pro_headline; ?></td>
          </tr>
          <tr>
            <td align="right" ><?php echo  $country . " | " . $industry; ?></td>
          </tr>
          </table>
        </div>
       
	   <div id="apDiv1" align="right">
        <?php 
                // Display Logged user, First Name & Last Name.
                if($user_id) {
                    echo "<a href=\"logout.php\">Logout! " . "</a>  .. " . $firstname . " " .  $lastname; 
                }
            ?>
      </div>
        
		<div class="forms_group">
        
        <div class="mform_error_div" >
        <?php
              global $error_message;
			  global $success_message;
              if(!($error_message=='')){
                  echo "<span id=\"mform_error\" style=\"visibility:visible\">$error_message</span>";
              }elseif(!($success_message=='')){
			  	  echo "<span id=\"mform_sucess\" style=\"visibility:visible\">$success_message</span>";
			  }else {
                  echo "<span id=\"mform_error\"></span>";
				  echo "<span id=\"mform_sucess\"></span>";
              }
          ?>
        </div>
        <div class="tform_head">+ Login Information</div> 
        <div class="tform_body"> 
        <form action="members.php?id=<?php echo $user_id; ?>" method="post">
        <div class="style_form" >
          <label for="firstname" class="mlabel">Change First Name :</label>
          <input type="text" name="firstname" id="firstname" class="form_element" value="<?php echo  mysql_prep($firstname); ?>" />
          <span style="color:#F00; font-size:10px;">*</span></div>
        <div class="style_form">
          <label for="lastname" class="mlabel">Change Last Name :</label>
          <input type="text" name="lastname" id="lastname" class="form_element" value="<?php echo  mysql_prep($lastname); ?>" />
        <span style="color:#F00; font-size:10px;">*</span></div>
        <div class="style_form">
          <label for="password" class="mlabel">Change Password :</label>
          <input type="password" name="password" id="password" class="form_element" onkeyup="return password_strength()" />
        <span style="color:#F00; font-size:10px;">*</span><span id="strength_status"></span></div>
        <div class="style_form">
          <label for="re_password" class="mlabel">Confirm Password :</label>
          <input type="password" name="re_password" id="re_password" class="form_element" onchange="return confirm_password()" />
        <span style="color:#F00; font-size:10px;">*</span><span id="confirmation_status"></span></div>
        <div class="style_form">
          <p>
            <input name="linfo_update" type="submit"  value="Save Changes" id="update_btn"  />
          </p>
        </div>
        </form>
        </div>
        
   		<div class="tform_head">+ Basic Information</div> 
        <div class="tform_body"> 
        <form action="members.php?id=<?php echo $user_id; ?>" method="post" >
        <div class="style_form">
          <label for="pro_headline" class="mlabel">Professional "Headline" :</label>
          <input type="text" name="pro_headline" id="pro_headline" class="form_element" value="<?php echo  $pro_headline; ?>" />
          <span style="color:#F00; font-size:10px;">*</span>
          <br/>
          <div class="field_tip_txt"><strong>Examples: </strong>   Experienced Transportation Executive, Student...<a href="ex_headline.php" target="_new"> See more</a> </div>
        </div>
        <div class="style_form">
          <label for="country" class="mlabel">Country :</label>
          <select class="m_sel_element" name="country" id="country">
          <?php 
			  	if($country != "") {
					echo "<option value=\"{$country}\" selected=\"selected\" >{$country}</option>";
				}
		  ?>
            <option value="" >Select  &raquo;</option>
            <option value="Afganistan" >Afganistan</option>
            <option value="Albanian" >Albanian</option>
            <option value="Algerian" >Algerian</option>
            <option value="American Samoa" >American Samoa</option>
            <option value="Anguill" >Anguilla</option>
            <option value="Antigua and Barbuda" >Antigua and Barbuda</option>
            <option value="Argentinan" >Argentinan</option>
            <option value="Armenian" >Armenian</option>
            <option value="Australian" >Australian</option>
            <option value="Austrian" >Austrian</option>
            <option value="Bahrain" >Bahrain</option>
            <option value="Bangladeshi" >Bangladeshi</option>
            <option value="Belgium" >Belgium</option>
            <option value="Bhutan" >Bhutan</option>
            <option value="Brazil" >Brazil</option>
            <option value="Cameroon" >Cameroon</option>
            <option value="Canadian" >Canadian</option>
            <option value="Central African Republic" >Central African Republic</option>
            <option value="Chad" >Chad</option>
            <option value="Chile" >Chile</option>
            <option value="Chinese" >Chinese</option>
            <option value="Colombian" >Colombian</option>
            <option value="Congo" >Congo</option>
            <option value="Cuba" >Cuba</option>
            <option value="Cyprus" >Cyprus</option>
            <option value="Czech Republic" >Czech Republic</option>
            <option value="Danish" >Danish</option>
            <option value="Ecuador" >Ecuador</option>
            <option value="Egyp" >Egypt</option>
            <option value="Fijian" >Fijian</option>
            <option value="Finland" >Finland</option>
            <option value="France" >France</option>
            <option value="Germany" >Germany</option>
            <option value="Greece" >Greece</option>
            <option value="Hong Kong" >Hong Kong</option>
            <option value="Hungary" >Hungary</option>
            <option value="Indian" >Indian</option>
            <option value="Indonesian" >Indonesian</option>
            <option value="Iraq" >Iraq</option>
            <option value="Iresh" >Iresh</option>
            <option value="Israel" >Israel</option>
            <option value="Italian" >Italian</option>
            <option value="Jamaica" >Jamaica</option>
            <option value="Japanese" >Japanese</option>
            <option value="Jordan" >Jordan</option>
            <option value="Kazakhstan" >Kazakhstan</option>
            <option value="Kenya" >Kenya</option>
            <option value="Korea (North)" >Korea (North)</option>
            <option value="Korea (South)" >Korea (South)</option>
            <option value="Kuwaitian" >Kuwaitian</option>
            <option value="Lebanon" >Lebanon</option>
            <option value="Lesotho" >Lesotho</option>
            <option value="Liberian" >Liberian</option>
            <option value="Libya" >Libya</option>
            <option value="Macedonian" >Macedonian</option>
            <option value="Malaysian" >Malaysian</option>
            <option value="Maldives" >Maldives</option>
            <option value="Mexico" >Mexico</option>
            <option value="Morocco" >Morocco</option>
            <option value="Namibia" >Namibia</option>
            <option value="Netherlands" >Netherlands</option>
            <option value="New Zealander" >New Zealander</option>
            <option value="Nigerian" >Nigerian</option>
            <option value="Norwaygian" >Norwaygian</option>
            <option value="Oman" >Oman</option>
            <option value="Pakistan" >Pakistan</option>
            <option value="Panama" >Panama</option>
            <option value="Papua New Guinea" >Papua New Guinea</option>
            <option value="Paraguay" >Paraguay</option>
            <option value="Peru" >Peru</option>
            <option value="Philipino" >Philipino</option>
            <option value="Poland" >Poland</option>
            <option value="Portugal" >Portugal</option>
            <option value="Qatar" >Qatar</option>
            <option value="Romanian" >Romanian</option>
            <option value="Russian Federation" >Russian Federation</option>
            <option value="Rwanda" >Rwanda</option>
            <option value="Saudi Arabian" >Saudi Arabian</option>
            <option value="Senegal" >Senegal</option>
            <option value="Singapore" >Singapore</option>
            <option value="Somali" >Somali</option>
            <option value="South African" >South African</option>
            <option value="Spain" >Spain</option>
            <option value="Sri Lankan" >Sri Lankan</option>
            <option value="Sudan" >Sudan</option>
            <option value="Swazilander" >Swazilander</option>
            <option value="Swedish" >Swedish</option>
            <option value="Switzerland" >Switzerland</option>
            <option value="Syrian" >Syrian</option>
            <option value="Taiwan" >Taiwan</option>
            <option value="Thailand" >Thailand</option>
            <option value="Tunisian" >Tunisian</option>
            <option value="Turkish" >Turkish</option>
            <option value="Turks and Caicos Islands" >Turks and Caicos Islands</option>
            <option value="Uganda" >Uganda</option>
            <option value="Ukrainian" >Ukrainian</option>
            <option value="Arabian" >Arabian</option>
            <option value="British" >British</option>
            <option value="American" >American</option>
            <option value="Uruguay" >Uruguay</option>
            <option value="Viet Nam" >Viet Nam</option>
            <option value="Yemen" >Yemen</option>
            <option value="Zimbabwe" >Zimbabwe</option>
        </select>
        <span style="color:#F00; font-size:10px;">*</span></div>
        <div class="style_form">
          <label for="industry" class="mlabel">Industry :</label>
          <input type="text" name="industry" id="industry" class="form_element" value="<?php echo  $industry; ?>" />
          <span style="color:#F00; font-size:10px;">*</span>
          <br/>
          <div class="field_tip_txt"><strong>Examples: </strong>  Information Services, Human Resources...<a href="ex_industry.php" target="_new"> See more</a> </div>
        </div>
        <div class="style_form" >
              <label for="tel_number" class="mlabel">Phone Number :</label>
              <input type="text" name="tel_number" id="tel_number" maxlength="12" class="m_per_element" size="25" value="<?php echo  $tel_number; ?>" />
              <select name="tel_type" class="m_sel_month" id="tel_type">
              <?php 
			  	if($tel_type != "") {
					echo "<option value=\"{$tel_type}\" selected=\"selected\" >{$tel_type}</option>";
				}
			  ?>
              	<option value="" >Select  &raquo;</option>
                <option value="Home" >Home</option>
                <option value="Mobile" >Mobile</option>
                <option value="Office" >Work</option>
          	 </select>
             <span style="color:#F00; font-size:10px;">*</span>
             <br/>
          	 <div class="field_tip_txt"><strong>Ex :</strong>  +94000000000</div>
          </div>
          <div class="style_form" >
              <label for="IM_name" class="mlabel">IM :</label>
              <input type="text" name="IM_name" id="IM_name" class="m_per_element"  size="25" value="<?php echo  $IM_name; ?>" />
              <select name="IM_type" class="m_per_sel_element" id="IM_type">
              <?php 
			  	if($IM_type != "") {
					echo "<option value=\"{$IM_type}\" selected=\"selected\" >{$IM_type}</option>";
				}
			  ?>
              	<option value="" >Select  &raquo;</option>
                <option value="AIM">AIM</option>
                <option value="Skype">Skype</option>
                <option value="Windows Live Messenger">Windows Live Messenger</option>
                <option value="Yahoo! Messenger">Yahoo! Messenger</option>
                <option value="ICQ">ICQ</option>
                <option value="GTalk">GTalk</option>
          	 </select>
          </div>
          <div class="style_form">
              <label for="address" class="mlabel">Address :</label>
              <textarea name="address"  class="txt_address" cols="40" rows="3"><?php echo  $address; ?></textarea>
          <span style="color:#F00; font-size:10px;">*</span></div>
          <div class="style_form" >
          	   <label for="b_day" class="mlabel">Birth Day :</label>
               <input type="Text" name="b_day" id="b_day" maxlength="11" value="<?php echo  $b_day; ?>" class="m_per_element" size="25"> 
               <a href="javascript:NewCssCal('b_day','mmmddyyyy')"><img src="images/cal.gif" width="16" height="16" alt="Pick a date"></a>
          <span style="color:#F00; font-size:10px;">*</span></div>
          <div class="style_form" >
              <label for="gender" class="mlabel">Gender :</label>
              <select name="gender" class="m_sel_month" id="gender">
              <?php 
			  	if($gender != "") {
					echo "<option value=\"{$gender}\" selected=\"selected\" >{$gender}</option>";
				}
			  ?>
                <option value="" >Select  &raquo;</option>
                <option value="Male" >Male</option>
                <option value="Female" >Female</option>
          	 </select>
             <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form" >
              <label for="marital" class="mlabel">Marital Status :</label>
              <select name="marital" class="m_sel_month" id="marital">
              <?php 
			  	if($marital != "") {
					echo "<option value=\"{$marital}\" selected=\"selected\" >{$marital}</option>";
				}
			  ?>
                <option value="" >Select  &raquo;</option>
                <option value="Single" >Single</option>
                <option value="Married" >Married</option>
          	 </select>
          </div>
          <div class="style_form" >
          <label for="about" class="mlabel">About you :</label>
          <textarea name="about" id="about" class="txt_area" cols="40" rows="6"  ><?php echo  $about; ?></textarea>
        </div>
        <div class="style_form">
          <p>
            <input name="binfo_submit" type="submit"  value="Save Changes" id="update_btn" onclick="ubasic_form_validate();"/>
          </p>
        </div>    
       </form>
       </div>

<?php
	
	  // User education information Table
	  $query = "SELECT *
				FROM user_edu 
				WHERE user_id = {$user_id}";
		
	  $result_set = mysql_query($query);
	  $row = mysql_fetch_array($result_set);
	  if (isset($row)) {
		  $sch_name  = $row['school_name'];
		  $dtitle =  $row['degree'];
		  $start_year = $row['start_year'];
		  $end_year = $row['award_year'];
		  $adi_note = $row['adi_notes'];
	  } else {
	  	$error_message =  "Connection Failed!";
	  } 

?>
<?php

	  // User education information Table
	  if(isset($_POST['edu_add'])){

		  $sch_name = trim(mysql_prep($_POST['sch_name']));
		  $dtitle = trim(mysql_prep($_POST['dtitle']));
		  $start_year = trim(mysql_prep($_POST['start_year']));
		  $end_year = trim(mysql_prep($_POST['end_year']));
		  $adi_note = trim(mysql_prep($_POST['adi_note']));

		  if($sch_name && $dtitle && $start_year && $end_year) {
			  $query = "INSERT INTO user_edu (
						user_id, school_name, degree, start_year, award_year, adi_notes
						) VALUES (
						{$user_id}, '{$sch_name}', '{$dtitle}', '{$start_year}', '{$end_year}', '{$adi_note}'
						)";
		  
			  $result = mysql_query($query, $connection);
			  if (isset($result)){
				// Success.
				 $success_message = "Professional Information entered Successfull.";
			  } else {
				// Display error_message.
				 $error_message =  "Opps some thing went wrong";
			  }
		  } else {
			$error_message = "* Please fill the required fieds.";
		  }
	   
	  }
?>	  
       <div class="tform_head">+ Educational Profile</div>
        <div class="tform_body">
          <form action="members.php?id=<?php echo $user_id; ?>" method="post" id="edu_profile">
          <div class="style_form" >
              <label for="sch_name" class="mlabel">School Name :</label>
              <input type="text" name="sch_name" id="sch_name" class="form_element" value="" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="dtitle" class="mlabel">Degree Title :</label>
              <input type="text" name="dtitle" id="dtitle" class="form_element" value="" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="year_attend" class="mlabel">Attended year :</label>
              <input type="text" name="start_year" id="start_year" size="10"  class="m_element_year" maxlength="4" value="" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="year_attend" class="mlabel">Awarded year :</label>
              <input type="text" name="end_year" id="end_year"  size="10" class="m_element_year" maxlength="4" value="" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form" >
              <label for="adi_note" class="mlabel">Additional Note :</label>
              <textarea name="adi_note" class="txt_area" cols="40" rows="6"></textarea>
          </div>
          <div class="style_form">
          <p>
          <input name="edu_add" type="submit" value="Add Qualification" id="addnew_btn" onClick="return edu_form_validate()"/>
          </p>
       	  </div>
          </form>
          <div class="style_form">
           <table class="form_databody" align="center">
             <tr>
               <th class="mdata_table_th">School Name</th>
               <th class="mdata_table_th">Degree Title</th>
               <th class="mdata_table_th">Attended year</th>
               <th class="mdata_table_th">Awarded year</th>
               <th class="mdata_table_th">Additional Note</th>
               <th class="mdata_table_th">Edit Records</th>
               <th class="mdata_table_th">Delete Records</th>
             </tr>
             <tr>
<?php                                                
   		$query = "SELECT *
				FROM user_edu 
				WHERE user_id = {$user_id}";
		
	  	$result_set = mysql_query($query);
		for ($count = 0; $row = mysql_fetch_array($result_set); $count++) {
?>
          	
              <td class="mdata_table_td"><?php echo $row[2] ?></td>
              <td class="mdata_table_td"><?php echo $row[3] ?></td> 
              <td class="mdata_table_td"><?php echo $row[4] ?></td> 
              <td class="mdata_table_td"><?php echo $row[5] ?></td>
              <td class="mdata_table_td"><?php echo $row[6] ?></td>
              <td class="mdata_table_td"><a href="edit_education.php?id=<?php echo $row[0]; ?>">Edit</a></td>
              <td class="mdata_table_td"><a href="remove_education.php?id=<?php echo $row[0]; ?>" onClick="return remove_confirm();">Remove</a></td>
        	</tr>
 <?php } ?>    
           </table>
          </div> 
        </div>

<?php

		// User professional information Table
		$query = "SELECT *
				  FROM  user_works
				  WHERE user_id = {$user_id}";
		  
		$result_set = mysql_query($query);
		$row = mysql_fetch_array($result_set);
		if (isset($row)) {
			$comp_name  = $row['company_name'];
			$jtitle =  $row['job_title'];
			$init_month = $row['init_month'];
			$init_year = $row['init_year'];
			$complete_month = $row['complete_month'];
			$complete_year = $row['complete_year'];
			$des = $row['description'];
		} else {
		  $error_message =  "Connection Failed!";
		} 

?>
<?php
	   // User professional information Table
	  if(isset($_POST['pro_add'])){
		  		  
		  $comp_name  = trim(mysql_prep($_POST['comp_name']));
		  $jtitle =  trim(mysql_prep($_POST['jtitle']));
		  $init_month = $_POST['init_month'];
		  $init_year = trim(mysql_prep($_POST['init_year']));
		  $complete_month = $_POST['complete_month'];
		  $complete_year = trim(mysql_prep($_POST['complete_year']));
		  $des = trim(mysql_prep($_POST['des']));

		  if($comp_name && $jtitle && $init_month && $init_year && $complete_month && $complete_year) {
			  $query = "INSERT INTO user_works (
						user_id, company_name, job_title, init_month, init_year, complete_month, complete_year, description
						) VALUES (
						{$user_id}, '{$comp_name}', '{$jtitle}', '{$init_month}', '{$init_year}', '{$complete_month}', '{$complete_year}', '{$des}'
						)";
		  
			  $result = mysql_query($query, $connection);
			  if (isset($result)){
				// Success.
				 $success_message =  "Education Information entered Successfull.";
			  } else {
				// Display error_message.
				 $error_message =  "Opps some thing went wrong";
			  }
		  } else {
				$error_message = "* Please fill the required fieds.";
		  }
	   
	  }
?> 
        <div class="tform_head">+ Professional Profile</div>
        <div class="tform_body">
        <form action="members.php?id=<?php echo $user_id; ?>" method="post" id="pro_profile">
          <div class="style_form" >
              <label for="comp_name" class="mlabel">Company Name :</label>
              <input type="text" name="comp_name" id="comp_name" class="form_element" value="" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="jtitle" class="mlabel">Job Title :</label>
              <input type="text" name="jtitle" id="jtitle" class="form_element" value="" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="initiate" class="mlabel">Initiate :</label>
              <select name="init_month" class="m_sel_month" id="init_month">
                <option value="" >Month &raquo;</option>
                <option value="January" >January</option>
                <option value="February" >February</option>
                <option value="March" >March</option>
                <option value="April" >April</option>
                <option value="May" >May</option>
                <option value="June" >June</option>
                <option value="July" >July</option>
                <option value="August" >August</option>
                <option value="September" >September</option>
                <option value="October" >October</option>
                <option value="November" >November</option>
                <option value="December" >December</option>
          	 </select>
             <input type="text" name="init_year" maxlength="4" size="10" class="m_element_year" id="init_year" value="" />
             <span class="mlabel">year</span>
             <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="complete" class="mlabel">Completed :</label>
              <select name="complete_month" class="m_sel_month" id="complete_month">
                <option value="" >Month &raquo;</option>
                <option value="January" >January</option>
                <option value="February" >February</option>
                <option value="March" >March</option>
                <option value="April" >April</option>
                <option value="May" >May</option>
                <option value="June" >June</option>
                <option value="July" >July</option>
                <option value="August" >August</option>
                <option value="September" >September</option>
                <option value="October" >October</option>
                <option value="November" >November</option>
                <option value="December" >December</option>
          	 </select>
             <input type="text" name="complete_year" maxlength="4" size="10" class="m_element_year" id="complete_year" value=""/>
             <span class="mlabel">year</span>
             <span style="color:#F00; font-size:10px;">*</span>
             <br/>
          	 <div class="field_tip_txt">( If your are still working! insert <strong>today</strong> month and year)</div>
          </div>
          <div class="style_form" >
              <label for="des" class="mlabel">Description :</label>
              <textarea name="des" class="txt_area" cols="40" rows="6"  ></textarea>
          </div>
          <div class="style_form">
          <p>
           <input name="pro_add" type="submit" value="Add Qualification" id="addnew_btn" onClick="return pro_form_validate();"/>
          </p>
          </div>
      	</form>
        <div class="style_form">
           <table class="form_databody" align="center">
             <tr>
               <th class="mdata_table_th">Company Name</th>
               <th class="mdata_table_th">Job Title</th>
               <th class="mdata_table_th">Initiate</th>
               <th class="mdata_table_th">Completed</th>
               <th class="mdata_table_th">Description</th>
               <th class="mdata_table_th">Edit Records</th>
               <th class="mdata_table_th">Delete Records</th>
             </tr>
             <tr>
<?php                                                
   		$query = "SELECT *
				FROM user_works 
				WHERE user_id = {$user_id}";
		
	  	$result_set = mysql_query($query);
		for ($count = 0; $row = mysql_fetch_array($result_set); $count++) {
?>
              <td class="mdata_table_td"><?php echo $row[2] ?></td>
              <td class="mdata_table_td"><?php echo $row[3] ?></td> 
              <td class="mdata_table_td"><?php echo $row[4] . " " . $row[5] ?></td> 
              <td class="mdata_table_td"><?php echo $row[6] . " " . $row[7] ?></td>
              <td class="mdata_table_td"><?php echo $row[8] ?></td>
              <td class="mdata_table_td"><a href="edit_professional.php?id=<?php echo $row[0]; ?>">Edit</a></td>
              <td class="mdata_table_td"><a href="remove_position.php?id=<?php echo $row[0]; ?>" onClick="return remove_confirm();">Remove</a></td>
        	</tr>
 <?php } ?> 
           </table>
        </div>
        </div>

        <div class="tform_head">+ Upload Avatar / Profile Image</div>
        <div class="tform_body">
          <div class="tupform_body"> 
            <form action="members.php?id=<?php echo $user_id; ?>" method="post" id="image_upload" enctype="multipart/form-data">
            <div class="join_txt" style="text-align:center">You can upload a JPG, GIF, BMP or PNG file (File size limit is 2 MB).</div>
            <div class="style_form" >
            <p>
              <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
              <input type="file" size="40" name="avatar" id="avatar"/>
            </p>
            </div>
            <div class="style_form">
          	<p>
            <input name="img_upload"  type="submit"  value="Upload"  id="upload_btn" />
            <span class="join_txt">or <a href="delete_image.php?id=<?php echo $user_id; ?>" onClick="return remove_confirm();">Delete Photo</a></span>
          	</p>
           </div>
          </form>
          </div>  
        </div>

        <div class="tform_head">+ Upload Your CV</div> 
        <div class="tform_body">
          <div class="tupform_body"> 
            <form action="members.php?id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
            <div class="join_txt" style="text-align:center">You can have upload a PDF file only. (File size limit is 2 MB).</div>
            <div class="style_form" >
            <p>
              <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
              <input type="file" size="40" name="mycv" id="mycv"/>
            </p>
            </div>
            <div class="style_form">
          	<p> 
              <input name="cv_upload"  type="submit"  value="Upload" id="upload_btn" />
          	</p>
           </div>
            </form>
             <div class="style_form">
           <table class="form_databody" align="center">
             <tr>
               <th class="mdata_table_th">Uploaded</th>
               <th class="mdata_table_th">Delete CV</th>
              </tr>
             <tr>
<?php                                                
   		$query = "SELECT *
				FROM up_cvs 
				WHERE user_id = {$user_id}";
		
	  	$result_set = mysql_query($query);
		$row = mysql_fetch_array($result_set);
?>
              <td class="mdata_table_td">
			  <?php 
			  		if($row[4] == "") {
						echo "No";
					} else {
						echo "Yes";
					}
			  ?>
              </td>
              <td class="mdata_table_td"><a href="delete_cv.php?id=<?php echo $user_id; ?>" onClick="return remove_confirm();">Remove</a></td>
        	</tr>
           </table>
        </div>
        </div>  
        </div>

        
        <div class="tform_head">+ Previous Involved Projects</div> 
        <div class="tform_body">
            <form action="members.php?id=<?php echo $user_id; ?>" method="post"  enctype="multipart/form-data">
            <div class="style_form">
              <label for="project_name" class="mlabel">Project Name :</label>
              <input type="text" name="project_name" id="project_name" class="form_element" />
              <span style="color:#F00; font-size:10px;">*</span>
            </div>
            <div class="style_form">
              <label for="about_project" class="mlabel">About Project :</label>
              <textarea name="about_project"  class="txt_address" cols="40" rows="3"></textarea>
            <span style="color:#F00; font-size:10px;">*</span></div>
            <div class="style_form">
            <div class="join_txt" style="text-align:center">You can upload a ZIP or RAR file.</div>
              <p>
              <label for="myproject" class="mlabel">Upload Project :</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
              <input type="file" size="29" name="myproject" id="myproject"/><span style="font-size:11px"><strong>&nbsp;Max: 5MB only</strong></span>
              </p>
           </div>
           <div class="style_form">
          	<p>
            <input name="project_submit" type="submit" value="Add Project" id="addnew_btn" />
          	</p>
          </div>
            </form>
           <div class="style_form">
           <table class="form_databody" align="center">
             <tr>
               <th class="mdata_table_th">Project Name</th>
               <th class="mdata_table_th">About Project</th>
               <th class="mdata_table_th">Uploaded</th>
               <th class="mdata_table_th">Edit Records</th>
               <th class="mdata_table_th">Delete Records</th>
             </tr>
             <tr>
<?php                                                
   		$query = "SELECT *
				FROM user_projects 
				WHERE user_id = {$user_id}";
		
	  	$result_set = mysql_query($query);
		for ($count = 0; $row = mysql_fetch_array($result_set); $count++) {
?>
              <td class="mdata_table_td"><?php echo $row[2] ?></td>
              <td class="mdata_table_td"><?php echo $row[3] ?></td> 
              <td class="mdata_table_td">
			  <?php 
			  		if($row[6] == "") {
						echo "No";
					} else {
						echo "Yes";
					}
			  ?>
              </td>
              <td class="mdata_table_td"><a href="edit_projects.php?id=<?php echo $row[0]; ?>">Edit</a></td>
              <td class="mdata_table_td"><a href="remove_projects.php?id=<?php echo $row[0]; ?>" onClick="return remove_confirm();">Remove</a></td>
        	</tr>
 <?php } ?> 
           </table>
        </div>
          
        </div>
		</div>
<?php require("includes/footer.php"); ?>
<?php 
	ob_flush();  // flush the buffer 
?> 