/**
 * 
 */
$(document).ready(function(){
	$('.menuItem a').live('click',function(){
		$('.menuItem a').parent().removeClass('menuItem_Selected');
		$(this).parent().addClass('menuItem_Selected');
	});
});