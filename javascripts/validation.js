/* 
#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	validation.js		#
#################################################
*/
function login_form_validate(form) {
	
	var username = $("#username").val();
	var password = $("#password").val();

	if(username == "" || password == "") {

		$("#log_error").css('visibility','visible');
		$("#log_error").html('All the fields are required!');
		return false;
		
		
	} 
	else  {
		return true;
	}


}

function reg_form_validate(form) {
	
	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var username = $("#username").val();
	var password = $("#password").val();
	var re_password = $("#re_password").val();
	var email = $("#email").val();
	var s_question = $("#s_question").val();
	var s_answer = $("#s_answer").val();

	if(firstname == "" || lastname == "" || username == "" || password == "" || re_password == "" || email == "" || s_question == "" || s_answer == "") {

		$("#reg_error").css('visibility','visible');
		$("#reg_error").html('All the fields are required!');
		return false;
	} 
	else  {
		return true;
	}
}

function username_validate() {
	var username = $("#username").val();// Get the value in the username textbox
	if (username.length != 0) {
		if(username.length >= 6)
		{
			$("#availability_status").html('<img src="images/loader.gif" align="absmiddle">&nbsp;Checking...');
	
			$.ajax({  
			type: "POST",  
			url: "ajax_check_username.php",  
			data: "username="+ username,  
			success: function(server_response){
	
				   $("#availability_status").ajaxComplete(function(event, request){ 
				
						if(server_response == 0)
						{ 
							$("#availability_status").html('<img src="images/available.png" align="absmiddle"> <font color="#1D4664"> Available</font>');
						}  
						else 
						{  
							$("#availability_status").html('<img src="images/not_available.png" align="absmiddle"> <font color="#FF0000"> Not Available</font>');
						} 
					});
				} 
	
			}); 
	
		}
		else
		{
			$("#availability_status").html('<font color="#cc0000">Username too short</font>');
		}
	} else {
		$("#reg_error").css('visibility','visible');
		$("#reg_error").html('Please you must enter the username first!');
		return false;
	}
}

// Password strength validation 
function password_strength(){
	var password = $("#password").val();//Get the value in the password textbox
	if(password.length < 6){
		$("#strength_status").html('<font color="#999999">At least 6 characters!</font>');	
	}else if((password.length>=6) && (password.length<8)){
		$("#strength_status").html('<font color="#FFCC33">Fair</font>');
	}else if(password.length>8){
		$("#strength_status").html('<font color="#1D4664">Strong</font>');
	}
	return false;
} 

// Password confirmation validation
function confirm_password(){
	var password = $("#password").val();//Get the value in the password textbox
	var re_password = $("#re_password").val();//Get the value in the re_password textbox
	if((re_password.length < 6) || (password != re_password)){
		$("#confirmation_status").html('<img src="images/not_available.png" align="absmiddle">');
			
	}else {
		$("#confirmation_status").html('<img src="images/available.png" align="absmiddle">');
	}
	return false;
} 

 function email_validate(reg_form, email) {
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var address = document.forms[reg_form].elements[email].value;
	if(reg.test(address) == false) {
	$("#reg_error").css('visibility','visible');
	$("#reg_error").html('Please enter a valid email address!');
	return false;
	}
};

/* Educational Profile Form */

function edu_form_validate(form) {
	
	var sch_name = $("#sch_name").val();
	var dtitle = $("#dtitle").val();
	var start_year = $("#start_year").val();
	var end_year = $("#end_year").val();
	
	if(sch_name == "" || dtitle == "" || start_year == "" || end_year == "") {

		$("#mform_error").css('visibility','visible');
		$("#mform_error").html('* Please fill the required fieds.');
		return false;
	}
	else if(isNaN(start_year) || start_year.length < 4){

		$("#mform_error").css('visibility','visible');
		$("#mform_error").html('Please enter a valid year!!');
		return false;
	}
	else if(isNaN(end_year) || end_year.length < 4){

		$("#mform_error").css('visibility','visible');
		$("#mform_error").html('Please enter a valid year!!');
		return false;
	}
	else  {
		return true;
	}
}	

/* Professional Profile Form */

function pro_form_validate(form) {

	var comp_name = $("#comp_name").val();
	var jtitle  = $("#jtitle").val();
	var init_month = $("#init_month").val();
	var init_year = $("#init_year").val();
	var complete_month  = $("#complete_month").val();
	var complete_year  = $("#complete_year").val();

	if(comp_name == "" || jtitle == "" || init_month == "" || init_year == "" || complete_month == "" || complete_year == "") {

		$("#mform_error").css('visibility','visible');
		$("#mform_error").html('* Please fill the required fieds.');
		return false;
	}
	else if(isNaN(init_year) || init_year.length < 4){

		$("#mform_error").css('visibility','visible');
		$("#mform_error").html('Please enter a valid year!!');
		return false;
	}
	else if(isNaN(complete_year) || complete_year.length < 4){

		$("#mform_error").css('visibility','visible');
		$("#mform_error").html('Please enter a valid year!!');
		return false;
	}
	else  {
		return true;
	}
}

/* Remove Confirm validate */

function remove_confirm() {
  
	if (confirm('Do you want to delete this?')) {   
		return true;
	}   
	else {   
		return false;   
	}   
}   

/* Admin - Ban user confirm validate */

function ban_confirm() {
  
	if (confirm('Do you really want to ban this user?')) {   
		return true;
	}   
	else {   
		return false;   
	}   
}

/* Admin - UnBan user confirm validate */

function unban_confirm() {
  
	if (confirm('Do you really want to active this user again?')) {   
		return true;
	}   
	else {   
		return false;   
	}   
}

/* Admin - user delete confirm validate */

function delete_confirm() {
  
	if (confirm('Do you really want to delete this user from database?')) {   
		return true;
	}   
	else {   
		return false;   
	}   
}





	



