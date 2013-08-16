var currentImage=1;
var maxImages=0;
var slImgTimer=0;
/*
function slideImages(){
	var prevImage=0;
	if(currentImage==maxImages){
		currentImage=0;
	}
	if(currentImage==0){
		prevImage=maxImages-1;
	}
	else{
		prevImage=currentImage-1;
	}
	$('.highlights img').eq(currentImage).fadeIn(1500,
		function(){
			$('.highlights img').eq(prevImage).fadeOut(1500,function(){
				currentImage=currentImage+1;
				slideImages();
			});
		}
	);
}
*/
function slideImages(){
	if(currentImage==maxImages){
		currentImage=0;
	}
	$('.highlights img').css('z-index','0');
	$('.highlights img').eq(currentImage).css('z-index','1');
	
	$('.highlights img').eq(currentImage).fadeIn(3000,
		function(){
			$('.highlights img').each(
				function(index){
					if(index!=currentImage){
						$(this).hide();
					}
				}
			);
			currentImage=currentImage+1;
			clearTimeout(slImgTimer);
			slImgTimer=setTimeout('slideImages();',4000);
		}
	);
}
$(document).ready(
	function(){
		maxImages=$('.highlights img').length;
		slideImages();
	}
);