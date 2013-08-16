/**
 * 
 */

$(document).ready(
		function(){
			$('.question').live('click',function(){
				var id=$(this).attr('id').split('_')[1];
				$('#answer_'+id).slideToggle('slow');
				return false;
			});
		}
);