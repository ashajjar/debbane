/**
 * 
 */

$(document).ready(function(){
	$('#newsLetterBtn').live('click',
			function (){
				var name=$('#name_nl').val();
				var email=$('#email_nl').val();

				if(name==NAME){
					showMessageBox(ALL_REQ);
					return false;
				}
				if(!rege.test(email)){
					showMessageBox(VALID_EMAIL);
					return false;
				}
				
				$.ajax({
				      url: "../newsletter/newsletter.php",
				      type: "POST",
				      data: {email : email, name : name},
				      success: function(msg){
				    	  showMessageBox(msg);
				    	  $('#name_nl').attr("value","").blur();
				    	  $('#email_nl').attr("value","").blur();
				      }
				   }
				);
				return false;
			}
		);
});