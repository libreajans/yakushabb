<?php
// CTracker_Ignore: File Checked By Human

//---[ + ] --- bütün degiskenler siliniyor

$_GET[] = '';
$_POST[] = '';

$img = '';
$phpbb_root_path = '';
$imageInfo = '';
$folder = '.';
$extList = '';
$fileList = '';
$handle = '';
$file = '';
$file_info = '';
$imageNumber = '';
$file_info['extension'] = '';
$contentType = '';
$im = '';
$background_color = '';
$text_color = '';
//---[ - ] --- bütün degiskenler siliniyor

$folder = '.';
$extList = array(); 
$extList['gif'] = 'image/gif'; 
$extList['jpg'] = 'image/jpeg'; 
$extList['jpeg'] = 'image/jpeg'; 
$extList['png'] = 'image/png'; 
$img = null; 


if (substr($folder,-1) != '/') 
{ 
    $folder = $folder.'/'; 
} 

$fileList = array(); 
$handle = opendir($folder); 
while ( false !== ( $file = readdir($handle) ) ) 
{ 
	$file_info = pathinfo($file); 
	if ( isset( $extList[ strtolower( $file_info['extension'] ) ] ) ) 
	{ 
		$fileList[] = $file; 
	} 
} 
closedir($handle); 

if (count($fileList) > 0) 
{ 
	$imageNumber = time() % count($fileList); 
	$img = $folder.$fileList[$imageNumber]; 
} 

if ($img != null) 
{ 
    $imageInfo = pathinfo($img); 
    $contentType = 'Content-type: '.$extList[ $imageInfo['extension'] ]; 
    header ($contentType); 
    readfile($img); 
} 
else 
{ 
    if ( function_exists('imagecreate') ) 
	{ 
        header ("Content-type: image/png"); 
        $im = @imagecreate (100, 100) 
            or die ("Cannot initialize new GD image stream"); 
        $background_color = imagecolorallocate ($im, 255, 255, 255); 
        $text_color = imagecolorallocate ($im, 0,0,0); 
        imagestring ($im, 2, 5, 5, "IMAGE ERROR", $text_color); 
        imagepng ($im); 
        imagedestroy($im); 
    } 
} 
?>