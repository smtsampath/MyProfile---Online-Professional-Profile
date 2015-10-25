<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	edit_projects.php	#
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
	  	die("Failed");
	  }
?>
<?php

	  $message='';
	  	
	  $query = "SELECT *
				FROM user_projects 
				WHERE id = {$_GET['id']}";
		
	  $result_set = mysql_query($query);
	  $row = mysql_fetch_array($result_set);
	  if (isset($row)) {
			  $project_name  = $row['project_name'];
			  $about_project =  $row['about_project'];
	  }else {
			$message =  "Connection Failed!";;
	  }
	  
?>
<?php
	  
	  // User Projects upload Table
	  if(isset($_POST['project_update'])){
		  
		  $project_name  = trim(mysql_prep($_POST['project_name']));
		  $about_project =  trim(mysql_prep($_POST['about_project']));
		  $name = $_FILES['myproject']['name'];
		  $tmp_name = $_FILES['myproject']['tmp_name'];
		  $pro_size = $_FILES['myproject']['size'];
		  $pro_type = $_FILES['myproject']['type'];
		  
		  if($project_name && $about_project && !$name) {
				$query = "UPDATE user_projects SET 
						  user_id = {$user_id}, 
						  project_name = '{$project_name}', 
						  about_project =  '{$about_project}'
						  WHERE id = {$_GET['id']}";
				  
				$result_set = mysql_query($query, $connection);
				if(isset($result_set)) {
					redirect_to("members.php?id={$user_id}");
				} else {
					$message = "Opps some thing went wrong";
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
										  
					$query = "UPDATE user_projects SET 
							  user_id = {$user_id}, 
							  project_name = '{$project_name}', 
							  about_project =  '{$about_project}',
							  file_size = '{$pro_size}',
							  file_type = '{$pro_type}',
							  project_location = '{$pro_location}'
							  WHERE id = {$_GET['id']}";
					
					$result_set = mysql_query($query, $connection);
					if(isset($result_set)) {
						redirect_to("members.php?id={$user_id}");
					} else {
						$message = "Opps some thing went wrong";
					}
				
				} else {
					  $message = "Invalid file format!";
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
        <div class="t_edit_head">Edit Project Infomation</div>
        <div class="t_edit_body">
          <form action="edit_projects.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
           <div class="style_form">
              <label for="project_name" class="mlabel">Project Name :</label>
              <input type="text" name="project_name" id="project_name" class="form_element" value="<?php echo $project_name; ?>" />
              <span style="color:#F00; font-size:10px;">*</span>
            </div>
            <div class="style_form">
              <label for="about_project" class="mlabel">About Project :</label>
              <textarea name="about_project"  class="txt_address" cols="40" rows="3"><?php echo $about_project; ?></textarea>
            <span style="color:#F00; font-size:10px;">*</span></div>
            <div class="style_form">
              <p>
              <label for="myproject" class="mlabel">Upload Project :</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
              <input type="file" name="myproject" id="myproject"/><span style="font-size:11px"><strong>&nbsp;Max: 5MB only</strong></span>
              </p>
           </div>
           <div class="style_form">
          	<p>
            <input name="project_update" type="submit" value="Update Project" id="update_btn" />
            <span class="join_txt">or <a href="members.php?id=<?php echo $user_id; ?>"> Cancel</a> </span>
          	</p>
          </div>
          </form>
      	  </form>
        </div>
	   </div>        
<?php require("includes/footer.php"); ?>
<?php 
	ob_flush();  // flush the buffer 
?> 