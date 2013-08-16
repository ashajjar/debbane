/**
 * 
 */
var rege = /^\b[A-Za-z]+[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/;
var regPhoneNum = /^\b[0-9]{7}\b$/;
var regNumber= /^\b[0-9\.]*\b$/;

$(document).ready(function() {
	$('.logoContainer').height($(document).height());
	
	$('.deleteObject').click(function() {
		return confirm('Are you sure you want to delete this?');
	});
});
String.prototype.trim=function(){
	trimLeft = /^\s+/;
	trimRight = /\s+$/;
	return this.replace(trimLeft,"").replace(trimRight,"");
};

/**
 * Show message box function 
 * @author Ahmad Hajjar
 * @param msg String the message to show.
 * */
function showMessageBox(msg)
{
	$('.messageBox').html(msg+"<br/><br/><br/><input type='button' value='OK' class='__messageBoxOK button2' />");
	
	$('.__messageBoxOK').live(
			'click',
			function(){
				$('.messageBox').hide();
			}
	);
	$('.__messageBoxOK').focus();
	$('.messageBox').show();
}
