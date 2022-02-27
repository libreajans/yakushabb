<?php
// CTracker_Ignore: File Checked By Human
/***************************************************************************
* setup.php
***************************************************************************/

define('setup',true);

// First we disable error reporting for unset Vars.
error_reporting (E_ERROR | E_WARNING | E_PARSE);
set_magic_quotes_runtime(0);

// Variable Reset
$mode = $language = $step = '';

// And now we get mode and language
$mode = $_GET['mode'];
$step = $_GET['step'];
$language = $_GET['lang'];

if(empty($language))
{
	$language = 'english';
}

// Set general Vars for later use in setup
$yakusha_version = '2.9.1';
$phpbbver = '.0.22';

// Sprachdatei einbinden
if(file_exists("language/".$language.".php"))
{
	include("language/$language.php");
}
else
{
	die("<center>Seçilmiþ dil bulunmamaktadýr. Lütfen <b>setup/language/</b> klasöründe seçtiðinin dilin varolduðunu doðrulayýnýz!");
}

// Letzter Schritt
if($step == 4 && $mode == 'dlconfig')
{
	header('Content-Type: text/x-delimtext; name="config.php"');
	header('Content-disposition: attachment; filename="config.php"');
	$configdownload = $HTTP_POST_VARS['conf_data'];
	if(empty($configdownload))
	{
		// PHP >5.0.5
		$configdownload = $_POST['conf_data'];
	}
	echo stripslashes($configdownload);
	exit;
}

// Global Header for Setup
include("includes/header.php");

// Setupschritte
if($step == 1)
{
	include("includes/step1.php");
}
else if($step == 2)
{
	include("includes/step2.php");
}
else if($step == 3)
{
	if($mode == 'convert')
	{
		include("includes/convert.php");
	}
	else if ($mode == 'install')
	{
		include("includes/install.php");
	}
	else if($mode == 'update')
	{
		include("includes/update.php");
	}
	else
	{
		die("<center>Yanlýþ kurulum modu!");
	}
}
else if($step == 4)
{
	include("includes/step4.php");
}
else
{
	include("includes/welcome.php");
}

// Global Footer for Setup
include("includes/footer.php");

?>