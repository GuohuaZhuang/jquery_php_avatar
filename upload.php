<?php

function GetFileType($file) {
	$arr = explode('/', $file['type']);
	return end($arr);
}
function VarifyImageType($filetype) {
	$valid_filetypes = array('jpeg', 'png', 'gif', 'bmp');
	if (!in_array($filetype, $valid_filetypes)) {
		return false;
	}
	return true;
}
function VarifyImageSize($file) {
	$valid_size = 20*1024*1024;
	if ($file['size'] > $valid_size) {
		return false;
	}
	return true;
}
function VarifyUploadImagefile($file) {
	if (empty($file) || $file['error'] != 0) {
		return false;
	}
	if (!is_uploaded_file($file['tmp_name'])) {
		return false;
	}
	return true;
}
function CheckDir($dir) {
	if (!file_exists($dir)) {
		mkdir($dir, 0777);
	}
	if (!is_writeable($dir)) {
		return false;
	}
	return true;
}

function Upload($imagefile) {

	global $error_log;

	// Varify not empty and no errors
	if (!VarifyUploadImagefile($imagefile)) {
		$error_log = 'File upload is invalid!';
		return false;
	}
	// Varify image file type and size
	$filetype = GetFileType($imagefile);
	if (!VarifyImageType($filetype)) {
		$error_log = 'File type is invalid!';
		return false;
	}
	// Varify image size
	if (!VarifyImageSize($imagefile)) {
		$error_log = 'File size is invalid!';
		return false;
	}
	// Set and check dir
	$upload_dir = dirname(__FILE__).'/upload/';
	if (!CheckDir($upload_dir)) {
		$error_log = 'Upload dir is invalid!';
		return false;
	}
	// Set image filepath and move it
	$filename = md5(microtime().rand(0, 100)) . '.' . $filetype;
	$newpath = $upload_dir . $filename;
	if (!move_uploaded_file($imagefile['tmp_name'], $newpath)) {
		$error_log = 'Move uploaded file failed!';
		return false;
	}
	return './upload/' . $filename;
}

function GetFileTypeByPath($path) {
    $arr = explode('.', $path);
    $filetype = end($arr);
    $filetype = strtolower($filetype);
    return $filetype;
}

function GetFileNameByPath($path) {
    $arr = explode('/', $path);
    $filename = end($arr);
    $filename = strtolower($filename);
    return $filename;
}

function CalcDefaultThumbSize($imagepath, $twidth = 100, $theight = 100) {
	
	list($swidth, $sheight) = getimagesize($imagepath);
	
	$wscale = $swidth / $twidth;
	$hscale = $sheight / $theight;
	if ($wscale > $hscale) {
		$minh = $sheight;
		$minw = $twidth * $hscale;
	} else {
		$minh = $theight * $wscale;
		$minw = $swidth;
	}
	$x1 = ($swidth - $minw) / 2;
	$y1 = ($sheight - $minh) / 2;
	
	return array('x1' => $x1, 'y1' => $y1, 
	    'swidth' => $minw, 'sheight' => $minh);
}

function ReduceSize(&$imagepath, &$x1, &$y1, &$swidth, &$sheight) {
    list($width, $height) = getimagesize($imagepath);
    
    $maxsize = max($width, $height);
    $reducescale = $maxsize / 300;
    
    $x1 = $x1 * $reducescale;
    $y1 = $y1 * $reducescale;
    $swidth = $swidth * $reducescale;
    $sheight = $sheight * $reducescale;
}

function Generatethumb($imagepath, 
    $x1, $y1, $swidth, $sheight, $twidth = 100, $theight = 100)
{
	global $error_log;
	
    // Varify input args is OK
    if (empty($imagepath) 
        || $x1 < 0 || $y1 < 0
        || $swidth <= 0 || $sheight <= 0
        || $twidth <= 0 || $theight <= 0) {
		$error_log = 'Invoke Generatethumb args is invalid!';
		return false;
    }
	
	// Get image file type and varify it
	$filetype = GetFileTypeByPath($imagepath);
	$filename = GetFileNameByPath($imagepath);
	if (!VarifyImageType($filetype)) {
		$error_log = 'File type is invalid!';
		return false;
	}
	// Set and check dir
	$thumb_dir = dirname(__FILE__).'/thumb/';
	if (!CheckDir($thumb_dir)) {
		$error_log = 'Thumb dir is invalid!';
		return false;
	}
	// Reduce size
	ReduceSize($imagepath, $x1, $y1, $swidth, $sheight);
	
	// create source image handler and thumb handler
	$thumb = imagecreatetruecolor($twidth, $theight);
	$white = imagecolorallocate($thumb, 255, 255, 255);
	imagefill($thumb, 0, 0, $white);
	$func_create = 'imagecreatefrom' . $filetype;
	$source = $func_create($imagepath);
	// Resize to thumb
	imagecopyresampled($thumb, $source, 
	    0, 0, $x1, $y1, $twidth, $theight, $swidth, $sheight);
	// Output thumb image
	$thumbpath = $thumb_dir . '/' . $filename;
	$func_save = 'image' . $filetype;
	$func_save($thumb, $thumbpath);
	
	// Destroy image source handler
	imagedestroy($thumb);
	imagedestroy($source);
	
	return './thumb/' . $filename;
}

?>
