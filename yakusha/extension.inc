<?php
/***************************************************************************
* extension.inc
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// Change this if your extension is not .php!
$phpEx = "php";

$starttime = 0;	// --- phpBB default

// Page generation time
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$starttime = $mtime;

?>