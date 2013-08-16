<?php
function resizeToFile($image, $width, $height, $newFilename) {
	if (file_exists ( $newFilename ))
		return $newFilename;
		//Check if GD extension is loaded
	if (! extension_loaded ( 'gd' ) && ! extension_loaded ( 'gd2' )) {
		trigger_error ( "GD is not loaded", E_USER_WARNING );
		return false;
	}
	ini_set('memory_limit', '-1');
	//Get Image size info
	$imgInfo = getimagesize ( $image );
	switch ($imgInfo [2]) {
		case 1 :
			$im = imagecreatefromgif ( $image );
			break;
		case 2 :
			
			$im = imagecreatefromjpeg ( $image );
			break;
		case 3 :
			$im = imagecreatefrompng ( $image );
			break;
		default :
			trigger_error ( 'Unsupported filetype!', E_USER_WARNING );
			break;
	}
	//If image dimension is smaller, do not resize
	if ($imgInfo [0] <= $width && $imgInfo [1] <= $height) {
		$nHeight = $imgInfo [1];
		$nWidth = $imgInfo [0];
		return $image;
	} else {
		//yeah, resize it, but keep it proportional
		$rate = (($width / $imgInfo [0]) < ($height / $imgInfo [1])) ? ($width / $imgInfo [0]) : ($height / $imgInfo [1]);
		$nWidth = $imgInfo [0] * $rate;
		$nHeight = $imgInfo [1] * $rate;
	}
	$nWidth = round ( $nWidth );
	$nHeight = round ( $nHeight );
	
	$newImg = imagecreatetruecolor ( $nWidth, $nHeight );
	
	/* Check if this image is PNG or GIF, then set if Transparent*/
	if (($imgInfo [2] == 1) or ($imgInfo [2] == 3)) {
		imagealphablending ( $newImg, false );
		imagesavealpha ( $newImg, true );
		$transparent = imagecolorallocatealpha ( $newImg, 255, 255, 255, 127 );
		imagefilledrectangle ( $newImg, 0, 0, $nWidth, $nHeight, $transparent );
	}
	imagecopyresampled ( $newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo [0], $imgInfo [1] );
	
	//Generate the file, and rename it to $newFilename
	switch ($imgInfo [2]) {
		case 1 :
			imagegif ( $newImg, $newFilename );
			break;
		case 2 :
			imagejpeg ( $newImg, $newFilename );
			break;
		case 3 :
			imagepng ( $newImg, $newFilename );
			break;
		default :
			trigger_error ( 'Failed resize image!', E_USER_WARNING );
			break;
	}
	
	return $newFilename;
}
?>