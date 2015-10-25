<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	edit_education.php	#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php confirm_logged_in(); ?>
<?php
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
	  	$message =  "Connection Failed!";;
	  }
?>
<?php
			  $query = "SELECT *
						FROM user_edu 
						WHERE id = {$_GET['id']}";
				
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
					  user_id = {$user_id},
					  school_name = '{$sch_name}', 
					  degree = '{$dtitle}', 
					  start_year = '{$start_year}', 
					  award_year = '{$end_year}', 
					  adi_notes = '{$adi_note}'
					  WHERE id = {$_GET['id']}";
		  
			  $result = mysql_query($query, $connection);
			  if (isset($result)){
				  // Success!
				  redirect_to("members.php?id={$user_id}");
			  } else {
				  // Display error message.
				  $message =  "Opps some thing went wrong";
			  }
		 } else {
			$message = "* Please fill the required fieds.";
		 }	  
	  }
?>
<?php require("includes/header.php"); ?>
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
          <form action="edit_education.php?id=<?php echo $_GET['id']; ?>" method="post" id="edu_update">
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
            <span class="join_txt">or <a href="members.php?id=<?php echo $user_id; ?>"> Cancel</a> </span>
          </p>
       	  </div>
      	  </form>
        </div>
	   </div>        
<?php require("includes/footer.php"); ?>
<?php 
	ob_flush();  // flush the buffer 
?> 