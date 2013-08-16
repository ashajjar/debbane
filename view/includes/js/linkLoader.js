/**
 * 
 */
var topButton='<div class="GoToTop">'+_TOP+'</div>';
var backButton='<div class="GoBack">'+_BACK+'&nbsp;|&nbsp;<a href="'+_ROOT+'"><img src="'+_ROOT+'view/includes/images/homeIcon.png"/></a></div>';
var socialButtons='<div class="socialButtons"><img class="_FBShare" src="'+_ROOT+'view/includes/images/facebook.png"/><img class="_SendToFriend" src="'+_ROOT+'view/includes/images/mail.png"/><img class="_Print" src="'+_ROOT+'view/includes/images/print.png"/></div>';

$(document).ready(function() {
	$('.GoToTop').live('click',function(){
		$('html,body').animate({scrollTop: $("#__pageTop").offset().top},'fast');
	});
	
	$('.GoBack').live('click',function(){
		$.ajax({
			url:_ROOT+"view/includes/linkHistory.ajax.php",
			data:{op:"r"},
			success:function(msg){
				if(msg!=""){
					var link=msg;
					$.ajax({
						url:link,
						data:{ajax:1},
						beforeSend:function(){
							$('html,body').animate({scrollTop: $("#__pageTop").offset().top},'fast');
							$('.waitImage').show();
						},
						success:function(msg){
							$('.innerContainer').hide();
							$('.innerContainer').eq(0).show();
							$('.innerContainer').html(msg+topButton+backButton+socialButtons);
							$('.waitImage').hide();
							$('.highlights').hide();
							$('.homeContents').hide();
							$('.logoContainer').height($('.innerContainer').height()+185);
						},
						error:function(){
							$('.innerContainer').html(CONTACT_ERROR+topButton+backButton+socialButtons);
							$('.waitImage').hide();
						}
					});
					$.ajax({
						url:_ROOT+"view/includes/linkHistory.ajax.php",
						data:{op:"a",link:link},
						error:function(){
							//alert('History Error1');
						}
					});
					return false;
				}
			},
			error:function(){
				//alert('History Error2');
			}
		});
	});
	
	$('a.loadLink').live('click',function(){
		if($(this).hasClass('external-link')){
			return true;
		}
		var link=$(this).attr('href');
		$.ajax({
			url:link,
			data:{ajax:1},
			beforeSend:function(){
				$('html,body').animate({scrollTop: $("#__pageTop").offset().top},'fast');
				$('.waitImage').show();
			},
			success:function(msg){
				$('.innerContainer').hide();
				$('.innerContainer').eq(0).show();
				$('.innerContainer').html(msg+topButton+backButton+socialButtons);
				$('.waitImage').hide();
				$('.highlights').hide();
				$('.homeContents').hide();
				$('.logoContainer').height($('.innerContainer').height()+185);
			},
			error:function(){
				$('.innerContainer').html(CONTACT_ERROR+topButton+backButton+socialButtons);
				$('.waitImage').hide();
			}
		});
		$.ajax({
			url:_ROOT+"view/includes/linkHistory.ajax.php",
			data:{op:"a",link:link},
			error:function(){
				//alert('History Error3');
			}
		});
		return false;
	});
});