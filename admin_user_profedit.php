<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID		:	K0191622	#
#	Page	:	Admin_user_proedit.php	#
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

	  $message='';
	  $query = "SELECT *
				FROM user_works 
				WHERE id = {$row_id}";
		
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
	  	$message =  "Connection Failed!";;
	  }
	  
?>
<?php
	  if(isset($_POST['pro_update'])){
		  
		  $comp_name  = trim(strip_tags($_POST['comp_name']));
		  $jtitle =  trim(strip_tags($_POST['jtitle']));
		  $init_month = $_POST['init_month'];
		  $init_year = trim(strip_tags($_POST['init_year']));
		  $complete_month = $_POST['complete_month'];
		  $complete_year = trim(strip_tags($_POST['complete_year']));
		  $des = trim(strip_tags($_POST['des']));

		  if($comp_name && $jtitle && $init_month && $init_year && $complete_month && $complete_year) {
			  $query = "UPDATE user_works SET 
					  company_name = '{$comp_name}', 
					  job_title = '{$jtitle}', 
					  init_month = '{$init_month}', 
					  init_year = '{$init_year}',
					  complete_month = '{$complete_month}', 
					  complete_year = '{$complete_year}', 
					  description = '{$des}'
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
          <form action="admin_user_profedit.php?id=<?php echo $user_id; ?>&amp;rid=<?php echo $row_id; ?>" method="post">
          <div class="style_form" >
              <label for="comp_name" class="mlabel">Company Name :</label>
              <input type="text" name="comp_name" id="comp_name" class="form_element" value="<?php echo  $comp_name; ?>" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="jtitle" class="mlabel">Job Title :</label>
              <input type="text" name="jtitle" id="jtitle" class="form_element" value="<?php echo  $jtitle; ?>" />
              <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="initiate" class="mlabel">Initiate :</label>
              <select name="init_month" class="m_sel_month" id="init_month">
              <?php 
			  	if(isset($row['init_month'])) {
					echo "<option value=\"{$row['init_month']}\" selected=\"selected\" >{$row['init_month']}</option>";
				}
			  ?>
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
             <input type="text" name="init_year" maxlength="4" size="10" class="m_element_year" id="init_year" value="<?php echo  $init_year; ?>" />
             <span class="mlabel">year</span>
             <span style="color:#F00; font-size:10px;">*</span>
          </div>
          <div class="style_form">
              <label for="complete" class="mlabel">Completed :</label>
              <select name="complete_month" class="m_sel_month" id="complete_month">
              <?php 
			  	if(isset($row['complete_month'])) {
					echo "<option value=\"{$row['complete_month']}\" selected=\"selected\" >{$row['complete_month']}</option>";
				}
			  ?>
                <option value="">Month &raquo;</option>
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
             <input type="text" name="complete_year" maxlength="4" size="10" class="m_element_year" id="complete_year" value="<?php echo  $complete_year; ?>"/>
             <span class="mlabel">year</span>
             <span style="color:#F00; font-size:10px;">*</span>
             <br/>
          	 <div class="field_tip_txt">( If your are still working! insert <strong>today</strong> month and year)</div>
          </div>
          <div class="style_form" >
              <label for="des" class="mlabel">Description :</label>
              <textarea name="des" class="txt_area" cols="40" rows="6"  ><?php echo  $des; ?></textarea>
          </div>
          <div class="style_form">
          <p>
            <input name="pro_update" type="submit"  value="Save Changes" id="update_btn" onClick="return pro_form_validate()" />
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