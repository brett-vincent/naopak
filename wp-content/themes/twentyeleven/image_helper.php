<?php
if ( ! function_exists('resizeImage')){
	function resizeImage($image, $width, $height, $scale) {
		$image_data 	= getimagesize($image);
		$imageType 		= image_type_to_mime_type($image_data[2]);
		$newImageWidth 	= ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage 		= imagecreatetruecolor($newImageWidth,$newImageHeight);
		
		switch($imageType) {
			case "image/gif":
				$source = imagecreatefromgif($image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source = imagecreatefromjpeg($image); 
				break;
		    case "image/png":
			case "image/x-png":
				$source = imagecreatefrompng($image); 
				break;
	  	}
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		
		switch($imageType) {
			case "image/gif":
		  		imagegif($newImage,$image); 
				break;
	      	case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
		  		imagejpeg($newImage,$image,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$image);  
				break;
	    }
		chmod($image, 0777);
		
		return $image;
	}
}

//You do not need to alter these functions
if ( ! function_exists('resizeThumbnailImage')){
	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType 									= image_type_to_mime_type($imageType);
		
		$newImageWidth 	= ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage 		= imagecreatetruecolor($newImageWidth,$newImageHeight);
		/*error_log('N_W:'.$newImageWidth);
		error_log('N_H:'.$newImageHeight);
		error_log('Image:'.$newImage);*/
		switch($imageType) {
			case "image/gif":
				$source = imagecreatefromgif($image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source = imagecreatefromjpeg($image); 
				break;
		    case "image/png":
			case "image/x-png":
				$source = imagecreatefrompng($image); 
				break;
	  	}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
		  		imagegif($newImage,$thumb_image_name); 
				break;
	      	case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
		  		imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
	    }
		chmod($thumb_image_name, 0777);
		
		return $thumb_image_name;
	}
}

//You do not need to alter these functions
if ( ! function_exists('getHeight')){
	function getHeight($image) {
		$sizes = getimagesize($image);
		$height= $sizes[1];
		
		return $height;
	}
}

//You do not need to alter these functions
if ( ! function_exists('getWidth')){
	function getWidth($image) {
		$sizes = getimagesize($image);
		$width = $sizes[0];
		
		return $width;
	}
}
?>