<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	Admin_user_eduedit.php	#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php admin_confirm(); ?>
<?php confirm_logged_in(); ?>
<?php
	  $id = $_SESSION['admin'];	
	  $user_id = $_GET['id'];
	  $row_id = $_GET['rid'];
?>
<?php

	  $query = "SELECT *
		FROM user_login 
		WHERE id = {$user_id}";
				
	  $result_set = mysql_query($query);
	  $row = mysql_fetch_array($result_set);
	  if (isset($row)) {
		$username = $row['username'];
	  } else {
	  	$error_message =  "Connection Failed!";
	  }
?>
<?php
	  $query = "SELECT *
				FROM user_edu 
				WHERE id = {$row_id}";
		
	  $result_set = mysql_query($query);
	  $row = mysql_fetch_array($result_set);
	  if (isset($row)) {
			  $sch_name  = $row['school_name'];
			  $dtitle =  $row['degree'];
			  $start_year = $row['start_year'];
			  $end_year = $row['award_year'];
			  $adi_note = $row['adi_notes']; 
	  }else {
			die("Failed");
	  }
	  
?>
<?php
	  if(isset($_POST['edu_update'])){
		  
		  $message='';
		  
		  $sch_name = trim(strip_tags($_POST['sch_name']));
		  $dtitle = trim(strip_tags($_POST['dtitle']));
		  $start_year = trim(strip_tags($_POST['start_year']));
		  $end_year = trim(strip_tags($_POST['end_year']));
		  $adi_note = trim(strip_tags($_POST['adi_note']));

		  if($sch_name && $dtitle && $start_year && $end_year) {
			  $query = "UPDATE user_edu SET 
					  school_name = '{$sch_name}', 
					  degree = '{$dtitle}', 
					  start_year = '{$start_year}', 
					  award_year = '{$end_year}', 
					  adi_notes = '{$adi_note}'
					  WHERE id = {$row_id}";
		  
			  $result = mysql_query($query, $connection);
			  if (isset($result)){
				  // Success!
				  redirect_to("admin_useredit.php?id={$user_id}");
			  } else {
				  // Display error message.
				  $message =  "Opps some thing went wrong";
			  }
		 } else {
			$message = "* Please fill the required fieds.";
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
        <script type="text/javascript" src="javascripts/validation.js"></script>
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
                <li><a href="admin_useredit.php?id=<?php echo $user_id; ?>" title="Edit User">Edit User</a></li>
                <li><a href="admin.php" title="Admin">Admin</a></li>
          </ul>
        </div>
        <!-- End of Top navigation -->
        <!-- Beginning of Main Content -->
    	<div id="content">
		<div id="apDiv1" align="right">
            <?php 
                // Display Logged user, First Name & Last Name.
                if($id) {
                    echo "<a href=\"logout.php\">Logout! " . "</a>  .. Welcome Admin"; 
                }
            ?>
        </div>
       <div class="forms_group">
       <div class="mform_error_div" >
        <?php
              global $message;
                  if(!($message=='')){
                  echo "<span id=\"mform_error\" style=\"visibility:visible\">$message</span>";
              } else {
                  echo "<span id=\"mform_error\"></span>";
              }
          ?>
         </div>         
        <div class="t_edit_head">Edit Education</div>
        <div class="t_edit_body">
          <form action="admin_user_eduedit.php?id=<?php echo $user_id; ?>&amp;rid=<?php echo $row_id; ?>" method="post">
           <div class="style_form" >
              <label for="sch_name" class="mlabel">School Name :</label>
              <input type="text" name="sch_name" id="sch_name" class="form_element" value="<?php echo  $sch_name; ?>" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="dtitle" class="mlabel">Degree Title :</label>
              <input type="text" name="dtitle" id="dtitle" class="form_element" value="<?php echo  $dtitle; ?>" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
           <div class="style_form">
              <label for="year_attend" class="mlabel">Attended year :</label>
              <input type="text" name="start_year" id="start_year" size="10"  class="m_element_year" maxlength="4" value="<?php echo  $start_year; ?>" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="year_attend" class="mlabel">Awarded year :</label>
              <input type="text" name="end_year" id="end_year"  size="10" class="m_element_year" maxlength="4" value="<?php echo  $end_year; ?>" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form" >
              <label for="adi_note" class="mlabel">Additional Note :</label>
              <textarea name="adi_note" class="txt_area" cols="40" rows="6" ><?php echo  $adi_note; ?></textarea>
          </div>
          <div class="style_form">
          <p>
            <input name="edu_update" type="submit"  value="Save Changes" id="update_btn" onClick="return edu_form_validate()" />
            <span class="join_txt">or <a href="admin_useredit.php?id=<?php echo $user_id; ?>"> Cancel</a> </span>
          	</p>
          </div>
          </form>
        </div>
	   </div>        
<?php require("includes/footer.php"); ?>
<?php 
	ob_flush();  // flush the buffer 
?> 