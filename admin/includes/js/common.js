/**
 * 
 */

$(document).ready(function() {
	$('.deleteObject').click(function() {
		return confirm('Are you sure you want to delete this?');
	});
});

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
	setTimeout("$('.messageBox').hide();", 3000);
}
function initEditor(){
	tinyMCE.init({
			// General options
			mode : "specific_textareas",
			theme : "advanced",
			editor_selector : "mceEditor",
			plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager",

		// Theme options
	theme_advanced_buttons1 : "cut,copy,paste,pastetext,pasteword,cleanup,|,search,replace,|,undo,redo,|,bullist,numlist,|,outdent,indent,blockquote,|,ltr,rtl,|,justifyleft,justifycenter,justifyright,justifyfull,", 
	theme_advanced_buttons2 : ",bold,italic,underline,strikethrough,|,sub,sup,|,styleselect,formatselect,fontselect,fontsizeselect|,forecolor,backcolor,|,removeformat,", 
	theme_advanced_buttons3 : "link,unlink,anchor,image,insertimage,media,emotions,charmap,|,insertdate,inserttime,|,hr,|,tablecontrols,", 
	theme_advanced_buttons4 :"insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage|,fullscreen,attribs,preview,code,", 
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,


			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "js/template_list.js",
			external_link_list_url : "js/link_list.js",
			external_image_list_url : "js/image_list.js",
			media_external_list_url : "js/media_list.js",
			content_css : "../includes/editor.css",

		// Replace values for the template plugin
		template_replace_values : {
			username : "demo",
			staffid : "demo"
		}
	});
	}