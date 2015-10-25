<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	whymp.php		#
#################################################
	
?> 
<?php 

	ob_start(); // turning on the output buffer
	
?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php

	if(logged_in() && ($_SESSION['admin'] == 1)) {
		redirect_to("admin.php");
	}
	if(logged_in() && ($_SESSION['admin'] == 0)) {
		redirect_to("members.php?id={$_SESSION['id']}");
	}
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
      <div class="m_interface">
        <table width="580" border="0">
          <tr>
            <td>
            <div class="m_head">Welcome to MyProfile</div>
            <div class="indexview">
            <p>An online professional profile is a great way to get ahead of the competition in the job market, and help you get that dream job.</p>
            <p>MyProfile lets you get your own online Professional profile. Your profile will always be accessible for potential employers and agencies, from any internet-enabled computer.
            </p>
            <p >
              <p><strong>Myprofile will help you to:</strong></p>
              <p>
              <ul>
                <li>Market your professional profile to entire world</li>
                <li>More advantage of get better job of any fields</li>
                <li>Avoid costly hiring mistakes for employers</li>
                <li>Employ people with the right attitude</li>
                <li>Always accessible to employers and agents</li>
              </ul>
              </p>
            </p>
            <p>
            Today, most companies are moving toward using pre-employment assessments as part of their hiring process. Find out how easy it is to manage your recruitment selection with Myprofile. 
            </p>
            </div>
            </td>
          </tr>
        </table>
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
<?php 
	ob_flush();  // flush the buffer 
?> 
