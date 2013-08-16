String.prototype.trim=function(){return this.replace(/^\s\s*/, '').replace(/\s\s*$/, '');};
var rege = /^\b[A-Za-z]+[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}\b$/;
var regnum=/^[0-9\.]*$/;
function validate_form(){
	var stopMe=false;
	var cr='\n';
	$('.required').each(
		function(){
			var myValue=$(this).val();
			var id=$(this).attr('id');
			if($(this).hasClass('__catSelectBtn')){
				if(myValue.trim()=="-"){
					$(this).css('border','1px #f00 solid');
					stopMe=true;
				}
				else{
					$(this).css('border','1px #ccc solid');
				}
			}
			else if($(this).hasClass('mceEditor')){
				if(myValue.trim()==""){
					$(this).parent().css('border','1px #f00 solid');
					stopMe=true;
				}
				else{
					$(this).parent().css('border','none');
				}
			}
			else{
				if(myValue.trim()==""){
					$(this).css('border','1px #f00 solid');
					stopMe=true;
				}
				else{
					$(this).css('border','1px #ccc solid');
				}
			}
		}
	);
	
	$('.numeric').each(
		function(){
			var myValue=$(this).val();
			var id=$(this).attr('id');
			if(myValue.trim()==""){
				$(this).css('border','1px #f00 solid');
				stopMe=true;
			}
			else{
				if (!regnum.test(myValue)){
					$(this).css('border','1px #f00 solid');
					stopMe=true;
				}
				else{
					$(this).css('border','1px #ccc solid');
				}
			}
		}
	);
	
	$('.email').each(
		function(){
			var myValue=$(this).val();
			var id=$(this).attr('id');
			if(myValue.trim()==""){
				$(this).css('border','1px #f00 solid');
				stopMe=true;
			}
			else{
				if (!rege.test(myValue)){
					$(this).css('border','1px #f00 solid');
					stopMe=true;
				}
				else{
					$(this).css('border','1px #ccc solid');
				}
			}
		}
	);
	
	if(stopMe){
		return false;
	}
	else{
		return true;
	}
}


$(document).ready(

	function(){
		$('form').live('submit',function(){
			//return validate_form();
		});
	}
);

$(function() {
	$('.dateF').datepicker({
		showTime: false,
		dateFormat: 'yy-mm-dd',
		showButtonPanel: true,
		minDate: $('.dateF').attr('minDate'),
		maxDate: ($('.dateF').attr('maxDate')) ? ($('.dateF').attr('maxDate')) :'+3M'
	});
	$('.datetime').datepicker({
		showTime: true,
		dateFormat: 'yy-mm-dd',
		showButtonPanel: true,
		stepMinutes: 5,  
		stepHours: 1, 
		time24h: true
	 });
});