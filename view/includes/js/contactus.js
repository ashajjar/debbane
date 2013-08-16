/**
 * 
 */
$(document)
		.ready(
				function() {
					/* Regular Expressions */
					var rege = /^\b[A-Za-z]+[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/;
					var regPhoneNum = /^\b[0-9]{7}\b$/;
					var regNumber = /^\b[0-9\.]*\b$/;
					$('#ContactUsForm').live(
							'submit',
							function() {
								var name = $('#cu_name').val();
								var email = $('#cu_email').val();
								var subject = $('#cu_subject').val();
								var message = $('#cu_message').val();
								var mobile = $('#cu_mobile').val();
								var phone = $('#cu_phone').val();
								var country = $('#cu_country').val();

								if ((name == '') || (country == '')
										|| (phone == '') || (mobile == '')
										|| (subject == '') || (message == '')) {
									showMessageBox(ALL_REQ);
									return false;
								}
								if (!rege.test(email)) {
									showMessageBox(VALID_EMAIL);
									return false;
								}
								$.ajax({
									url : "../common/sendContactUs.ajax.php",
									type : "POST",
									data : {
										name : name,
										email : email,
										subject : subject,
										message : message,
										mobile : mobile,
										phone : phone,
										country : country
									},
									success : function(msg) {
										if (msg.trim() == "sent") {
											showMessageBox(CONTACT_DONE);
											setTimeout("document.location='"
													+ _ROOT + "'", 5000);
										} else if (msg.trim() == "failed") {
											showMessageBox(CONTACT_FAILED);
										} else {
											showMessageBox(msg);
										}
									},
									error : function() {
										showMessageBox(CONTACT_ERROR);
									}
								});
							});

					$('#cu_submit').live('click', function() {
						$('#ContactUsForm').submit();
						return false;
					});
				});