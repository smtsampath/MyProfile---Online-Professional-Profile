<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	view_profile.php	#
#################################################
	
?> 
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php
 
	

	  $query = "SELECT *
				FROM user_login 
				WHERE username = '{$_GET['user']}'";
	  $result_set = mysql_query($query);
	  $row = mysql_fetch_array($result_set);
	  if (isset($row)) {
		$id = $row['id'];
		$firstname  = $row['firstname'];
		$lastname =  $row['lastname'];
		$username = $row['username'];
		$avatar_location = $row['avatar_location'];
		$admin = $row['admin'];
	  } else {
	  	die("Failed");
	  }
?>
<?php
	  $query = "SELECT *
				FROM user_basic 
				WHERE user_id =  $id";
	  $result_set = mysql_query($query, $connection);
	  $row = mysql_fetch_array($result_set);
	  if (isset($result_set)) {
			  $pro_headline = $row['pro_headline'];
			  $country = $row['country']; 
			  $industry = $row['industry']; 
			  $about = $row['about'];
			  $tel_number  = $row['tel_number'];
			  $tel_type =  $row['tel_type'];
			  $IM_name = $row['IM_name'];
			  $IM_type = $row['IM_type'];
			  $address = $row['address'];
			  $b_day = $row['b_day'];
			  $gender = $row['gender'];
			  $marital = $row['marital'];
			  
	  } else {
	  	 die("Failed");
	  }
?>

<?php
    $year = date('Y'); 		// Get Current Year as a String.
	$month = date('F');		// Get Current Month as a String.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="keywords" content="MyProfile, Online CV, Professionals Profile" />
        <title><?php echo $firstname . " " . $lastname . " | MyProfile"; ?></title>
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
                <?php if(!logged_in()) { echo "<li><a href=\"whymp.php\" title=\"Why MyProfile?\">Why MyProfile?</a></li>";} ?>
                <?php if(!logged_in()) { echo "<li><a href=\"register.php\" title=\"Join Today\">Join Today</a></li>";} ?>
                <?php if(!logged_in()) { echo "<li><a href=\"login.php\" title=\"Sign in\">Sign in</a></li>";} ?>
                <?php if(logged_in()) { echo "<li><a href=\"members.php?id={$_SESSION['id']}\" title=\"Edit Profile\">Edit Profile</a></li>";} ?>
                <?php if(logged_in() && ($_SESSION['admin'] == 1)  ) { echo "<li><a href=\"admin_useredit.php?id={$_GET['id']}\" title=\"Edit user\">Edit User</a></li>";} ?>
                <?php if(logged_in() && ($_SESSION['admin'] == 1)  ) { echo "<li><a href=\"admin.php\" title=\"Sign in\">Admin</a></li>";} ?>
            </ul>
        </div>
        <!-- End of Top navigation -->
        <!-- Beginning of Main Content -->
    	<div id="content">

      
<div class="pubview" >
<table width="575" border="0">
  <tr>
    <td><?php echo  $firstname . " " .  $lastname; ?></td>
    <td width="150" rowspan="3" align="center">
    <?php 
			 echo "<img src=\"{$avatar_location}\" width=\"100\" height=\"100\" >";
	?>
    </td>
  </tr>
  <tr>
    <td class="vtd"><?php echo  $pro_headline; ?></td>
  </tr>
  <tr>
    <td class="vtd"><?php echo  $country . " | " . $industry; ?></td>
  </tr>
</table>
</div>
<?php if($about) { ?>
<div class="pubview" >
<p class="vtd"><?php echo  $about; ?></p>
</div>
<?php } ?>
<div class="v_head"><?php echo  $firstname . " " .  $lastname; ?> 's Education</div>
<div class="pubview" >
  <table width="550" border="0">
      <tr>
      <?php                                                
		  $query = "SELECT *
				  FROM user_edu 
				  WHERE user_id =  $id";
		  
		  $result_set = mysql_query($query, $connection);
		  for ($count = 0; $row = mysql_fetch_array($result_set); $count++) {
	  ?>
      <td valign="middle" class="vtd"><?php echo "<strong>" . $row[2] . "</strong>" ?></td>
      </tr>
      <tr><td valign="middle" class="vtd"><?php echo $row[3] ?></td></tr>
      <tr><td valign="middle" class="vtd">
	  <?php echo $row[4] . " - " ?>
      <?php 	
              if($row[5] > $year) { 
                  echo $row[5] . " (expected)";
              } else {
                  echo $row[5];
              }
      ?>
      </span>
      </td></tr>
      <tr><td valign="middle" align="justify" class="vtd"><?php echo $row[6] ?></td></tr>
      <?php } ?>
  </table>
</div>
<div class="v_head"><?php echo  $firstname . " " .  $lastname; ?> 's Experience</div>
<div class="pubview" >
  <table width="550" border="0">
      <tr>
      <?php                                                
		  $query = "SELECT *
				  FROM user_works 
				  WHERE user_id =  $id";
		  
		  $result_set = mysql_query($query, $connection);
		  for ($count = 0; $row = mysql_fetch_array($result_set); $count++) {
	 ?>
      <td class="vtd"><?php echo "<strong>" . $row[2] . "</strong>" ?></td>
      </tr>
      <tr><td class="vtd"><?php echo $row[3] ?></td></tr>
      <tr><td class="vtd"><?php echo $row[4] . " " . $row[5] . " to " ?>
      <?php 	
              if($row[6] >= $month && $row[7] == $year) { 
                  echo "present";
              } elseif($row[7] > $year) {
                  echo "present";
              } else {
                  echo $row[6] . " " . $row[7];
              }
      ?></td></tr>
      <tr><td class="vtd" align="justify"><?php echo $row[8] ?></td></tr>
      <?php } ?>
  </table>
</div>
<div class="v_head"><?php echo  $firstname . " " .  $lastname; ?> 's Personal & Contact Infromation</div>
<div class="pubview" >
  <table width="550" border="0">
    <tr>
      <td class="vtd" width="120px"><strong>Phone Number</strong></td>
      <td class="vtd" width="20px"><strong>:</strong></td>
      <td class="vtd"><?php echo  $tel_number . " (" .  $tel_type . ")"; ?></td>
    </tr>
    <tr>
      <td class="vtd" width="120px"><strong>IM</strong></td>
      <td class="vtd" width="20px"><strong>:</strong></td>
      <td class="vtd"><?php echo  $IM_name . " (" .  $IM_type . ")"; ?></td>
    </tr>
    <tr>
      <td class="vtd" width="120px"><strong>Address</strong></td>
      <td class="vtd" width="20px"><strong>:</strong></td>
      <td class="vtd"><?php echo  $address; ?></td>
    </tr>
    <tr>
      <td class="vtd" width="120px"><strong>Date of Birth</strong></td>
      <td class="vtd" width="20px"><strong>:</strong></td>
      <td class="vtd"><?php echo  $b_day; ?></td>
    </tr>
    <tr>
      <td class="vtd" width="120px"><strong>Gender</strong></td>
      <td class="vtd" width="20px"><strong>:</strong></td>
      <td class="vtd"><?php echo  $gender; ?></td>
    </tr>
    <tr>
      <td class="vtd" width="120px"><strong>Marital Status</strong></td>
      <td class="vtd" width="20px"><strong>:</strong></td>
      <td class="vtd"><?php echo  $marital; ?></td>
    </tr>
  </table>
</div>
 <?php
$query = "SELECT *
		  FROM  up_cvs
		  WHERE user_id =  $id";
  
$result_set = mysql_query($query, $connection);
$num_rows = mysql_num_rows($result_set);
$row = mysql_fetch_array($result_set);
?>
<?php if($num_rows) { ?>
<div class="v_head"><?php echo  $firstname . " " .  $lastname; ?> 's CV</div>
<div class="pubview" >
  <table width="550" border="0">
    <tr>
      <td align="center" class="vtd"><a href="<?php echo $row['cv_location']; ?>" target="_new"><img src="images/cv_download.bmp" alt="Download CV" /></a></td>
    </tr>
  </table>
</div>
<?php } ?>
<?php 
$query = "SELECT *
		  FROM user_projects 
		  WHERE user_id = $id";
    
$result_set = mysql_query($query);
$num_rows = mysql_num_rows($result_set);
?>
<?php if($num_rows) { ?>
<div class="v_head"><?php echo  $firstname . " " .  $lastname; ?> 's Involved Projects</div>
<div class="pubview" >
   <table align="center" width="550">
     <tr>
       <th class="v_table_th" width="150">Project Name</th>
       <th class="v_table_th" >About Project</th>
       <th class="v_table_th" width="50" >Download</th>
      </tr>
     <tr>
    <?php                                                
    for ($count = 0; $row = mysql_fetch_array($result_set); $count++) {
    ?>
      <td class="vtd" width="150" align="left"><?php echo $row[2] ?></td>
      <td class="vtd" align="left"><?php echo $row[3] ?></td> 
      <td class="vtd" valign="middle" align="center">
      <?php 
            if($row[6] == "") {
                echo "No";
            } else {
                echo "<a href=\"{$row[6]}\" target=\"_new\"><img src=\"images/pro_Download.jpg\" width=\"30\" height=\"30\" alt=\"Download Project\"/></a>";           
			}
      ?>
      </td>
    </tr>
    <?php } ?> 
  </table>
</div>
<?php  } ?> 
<?php require("includes/footer.php"); ?>
