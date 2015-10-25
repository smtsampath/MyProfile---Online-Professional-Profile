<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	header.php		#
#################################################
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="keywords" content="MyProfile, Online CV, Professionals Profile" />
        <title>MyProfile</title>
        <script type="text/javascript" src="javascripts/jquery.js"></script>
        <script type="text/javascript" src="javascripts/validation.js"></script>
        <script type="text/javascript" src="javascripts/member_page_togles.js"></script>
        <link href="stylesheets/form_style.css" type="text/css" rel="stylesheet">
        <link href="stylesheets/template.css" rel="stylesheet" type="text/css" />
     	<script type="text/javascript" src="javascripts/datetimepicker_css.js"></script>
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
                <?php if(logged_in() && ($_SESSION['admin'] == 1)  ) { echo "<li><a href=\"admin.php\" title=\"Sign in\">Admin</a></li>";} ?>
            </ul>
        </div>
        <!-- End of Top navigation -->
        <!-- Beginning of Main Content -->
    	<div id="content">
  