/**
 * 
 */
$(document).ready(function(){
	$('.loginBox').load('../users/updateUserArea.ajax.php');
	$('#doUserLogin').live('click',function(){
		var username=$('#user').val();
		var password=$('#pass').val();
		if((username.trim()=="")||(password.trim()=="")){
			showMessageBox(ALL_REQ);
			return false;
		}
		else{
			$
			.ajax({
				url : "../users/login.ajax.php",
				type : "POST",
				data : {
					username : username,
					password : password
				},
				success : function(msg) {
					if (msg.trim() == "1") {
						showMessageBox(LOGIN_DONE);
						$('.loginBox').load('../users/updateUserArea.ajax.php');
					} else {
						showMessageBox(msg);
					}
				},
				error : function() {
					showMessageBox(LOGIN_ERROR);
				}
			});
		}
	});
});