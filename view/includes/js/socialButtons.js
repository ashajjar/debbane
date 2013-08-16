/**
 * 
 */
$(document).ready(function(){
	
	$('._Print').live('click',function(){
			$.ajax({
				url:_ROOT+"view/includes/getLink.ajax.php",
				success:function(msg){
					$.ajax({
						url:msg,
						success:function(html){
							var myWindow;
							var writeDoc;
	
							myWindow=window.open();
							writeDoc = myWindow.document;
							writeDoc.open();
							writeDoc.write(html);
							writeDoc.close();
							myWindow.focus();
							myWindow.print();
							myWindow.close();
						}
					});
				}
			});
		});
	
	$('._FBShare').live('click',function(){
		$.ajax({
			url:_ROOT+"view/includes/getLink.ajax.php?full=1",
			success:function(msg){
				var d=document,f='http://www.facebook.com/share',l=msg,e=encodeURIComponent,p='.php?src=bm&v=4&i=1293191547&u='+e(l)+'&t='+e(d.title);1;
				try
				{
					if (!/^(.*\.)?facebook\.[^.]*$/.test(l))
						throw(0);
					share_internal_bookmarklet(p);
				}
				catch(z) 
				{
					a=function() 
					{
						if (!window.open(f+'r'+p,'sharer','toolbar=0,status=0,resizable=1,width=626,height=436'))
							l=f+p;
					};
					if (/Firefox/.test(navigator.userAgent))
						setTimeout(a,0);
					else
					{
						a();
					}
				}
				void(0);
			}
		});
	});
	
	$('._SendToFriend').live('click',function(){
		$('.emailForm').show();
	});
	
	$('#stf_cancelSending').live('click',
		function (){
			$('.emailForm').hide();
		}
	);
	$('#stf_sendEMail').live('click',
		function (){
			var email=$('#stf_email').val();
			var from=$('#stf_from').val();
			var name=$('#stf_name').val();
			var fname=$('#stf_fname').val();
			if((!rege.test(email))||(!rege.test(from))||(name=='')||(fname=='')){
				$('#stf_errors').show();
				$('#stf_errors').css('color','red');
				$('#stf_errors').html('All fields should be filled correctly!');
				$('#stf_errors').fadeOut(5000);
				return false;
			}
			$.ajax({
				url:_ROOT+"view/includes/getLink.ajax.php?full=1",
				success:function(msg){
					$.ajax (
						{
							url:"../common/sendToFriend.ajax.php",
							type:"POST",
							data:{to:email,link:msg,from:from,name:name,fname:fname},
							success:function(html){
								showMessageBox(html);
								$('.emailForm').hide();
								setTimeout("$('.messageBox').hide();", 3000);
							},
							error:function(){
								showMessageBox("Error");
								$('.emailForm').hide();
								setTimeout("$('.messageBox').hide();", 3000);
							}
						}
					);
				}
			});
		}
	);
});