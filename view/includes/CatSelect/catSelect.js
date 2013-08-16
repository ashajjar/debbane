/**
 * @author Ahmad Hajjar
 */
$(document).ready(
		function (){
			$('body').append("<div class='__lockedPage'></div>");
			$('body').append("<div class='__CatSelectForm'></div>");
			$('.__catSelectBtn').attr('readonly',"readonly");
			$('.__catSelectBtn').click(
					function(){
						$('.__lockedPage').show();
						$('.__CatSelectForm').show();//.load("catSelect.ajax.php");
						var id=$('.__catSelectBtn').val();
						if(id!=""){
							id=id.split("-")[0].trim();
						}
						$.ajax (
								{
									url:"../includes/catSelect.ajax.php",
									data:{selected:id},
									success:function(msg){
										$('.__CatSelectForm').html(msg);
									},
									error:function(){
										alert("Erorr");
									}
								}
							);
					}
			);
			
			$('.__branch').live('dblclick',
					function(){
						var cat_id=$(this).attr('id').split("_")[1];
						$('.__CatSelectForm').load("../includes/catSelect.ajax.php?parentCat="+cat_id);
					}
			);
			$('.__leaf').live('dblclick',
					function(){
						var cat_id=$(this).attr('id').split("_")[1];
						var cat_name=$(this).html();
						$('.__SelectedCatText').val(cat_id+" - "+cat_name);
						$('.__CatSelectForm').fadeOut('slow');
						$('.__lockedPage').fadeOut('slow');
					}
			);
			
			$('.__CatSelectForm input[type=button]').live('click',
					function(){
						$('.__CatSelectForm').fadeOut('slow');
						$('.__lockedPage').fadeOut('slow');
					}
			);
			
			$('.__branch').hover(
								function(){
									$('.__branch').css('background-color','#fff');
									$(this).css('background-color','#ccc');
								},
								function(){
									$('.__branch').css('background-color','#fff');
									$(this).css('background-color','#fff');									
								}
						);
			
			$('.__leaf').hover(
								function(){
									$('.__leaf').css('background-color','#fff');
									$(this).css('background-color','#ccc');
									
								},
								function(){
									$('.__leaf').css('background-color','#fff');
									$(this).css('background-color','#fff');									
								}
						);
			
			$('.__catDDL').live('change',function(){
				var me=$(this);
				var parentCat=me.val();
				var level=me.attr('rel');
				if(level>2){
					//alert("No more expanding can be done!");
					return false;
				}
				var _parent ;
				$.ajax({
					url:"../includes/makeCatList.ajax.php",
					data:{parentCat:parentCat,level:level},
					beforeSend:function(jqXHR, settings){
						if(_userPages){
							_parent = $(".__catDDL").eq(level).parent();
							$(".__catDDL").eq(level).remove();
							$(_parent).append("<span class='__loading'>Loading . . .</span>");
						}
						else{
							me.nextAll(".__catDDL").remove();
							me.after("<span class='__loading'>Loading . . .</span>");
						}
					},
					success:function(msg){
						if(_userPages){
							$('.__loading').remove();
							$(_parent).append(msg);
						}
						else{
							$('.__loading').remove();
							me.after(msg);
						}
					},
					error:function(){
						alert("Failed to get categories");
					}
				});
			});
			
//			$('.__userView').live('change',function(){
//				var me=$(this);
//				var parentCat=me.val();
//				var level=me.attr('rel');
//				if(level>2){
//					//alert("No more expanding can be done!");
//					return false;
//				}
//				$.ajax({
//					url:"../includes/makeCatList.ajax.php",
//					data:{parentCat:parentCat,level:level},
//					success:function(msg){
//						var _parent = $(".__catDDL").eq(level).parent();
//						$(".__catDDL").eq(level).remove();
//						$(_parent).append(msg);
//					},
//					error:function(){
//						alert("Failed to get categories");
//					}
//				});
//			});
		}
);