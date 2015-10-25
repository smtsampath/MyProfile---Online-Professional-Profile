/* 
#################################################
#	Author	:	S.M.Thushara Sampath	#
#	ID	:	K0191622		#
#	Page	:	member_page_togles.js	#
#################################################
*/
$(document).ready(function(){  //hide the all of the element with class msg_body  
	$(".tform_body").hide();  //toggle the componenet with class msg_body  
	$(".tform_head").click(function()  {    
		if($(this).next().is(":hidden")){
			$('.tform_body').slideUp('slow');
            $(this).next().slideToggle('slow');
		} else{
             $(this).next().slideToggle('slow');
        }
	});
});

