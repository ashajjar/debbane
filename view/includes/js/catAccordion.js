/**
 * 
 */

$(document).ready(
	function(){
		$('.level1').click(function(){
			$('.level1subCat').slideUp('slow');
			var num=$(this).attr('id').split('_')[1];
			$('#content_'+num).slideDown('slow');
		});

		$('.level2').click(function(){
			$('.level2subCat').slideUp('slow');
			var num=$(this).attr('id').split('_')[1];
			$('#content_'+num).slideDown('slow');
		});

		$('.level3').click(function(){
			$('.level3subCat').slideUp('slow');
			var num=$(this).attr('id').split('_')[1];
			$('#content_'+num).slideDown('slow');
		});

	}
);