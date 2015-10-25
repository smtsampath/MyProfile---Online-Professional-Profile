<?php

#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	session.php		#
#################################################
	
?>
<?php

	header("Cache-Control: post-check=0, pre-check=0",false);
	session_cache_limiter("must-revalidate");
	
	session_start();
	
	// chek session still their.
	function logged_in() {
		return isset($_SESSION['id']);
			
	}
	
	// confirm users logged in.
	function confirm_logged_in() {
		if(!logged_in()) {
			redirect_to("index.php");
			
		}
	}
	
	// cinfirn if logged user is admin.
	function admin_confirm() {
		if(!$_SESSION['admin'] || $_SESSION['admin'] == 0) {
			redirect_to("index.php");
		}
	}

	
?>