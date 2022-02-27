<?php

// CTracker_Ignore: File Checked By Human

if(!defined('setup'))
{
die('Hacking attempt');
}
/***************************************************************************
* begin : Sunday, Okt 16, 2005
* copyright : (C) 1999-2005 by Christian Knerr, www.cback.de
* email : info@cback.de
***************************************************************************/

if($mode == 'install')
{
$config_data = '';
$dbtyp = '';
$dbhost = '';
$dbname = '';
$dbuser = '';
$dbpass = '';
$dbprefix = '';
$written = FALSE;
$dbtyp = addslashes($HTTP_POST_VARS['dbtyp']);
$dbhost = addslashes($HTTP_POST_VARS['dbhost']);
$dbname = addslashes($HTTP_POST_VARS['dbname']);
$dbuser = addslashes($HTTP_POST_VARS['dbuser']);
$dbpass = addslashes($HTTP_POST_VARS['dbpass']);
$dbprefix = addslashes($HTTP_POST_VARS['dbprefix']);

if(empty($dbhost))
{
// PHP 5
$dbtyp = addslashes($_POST['dbtyp']);
$dbhost = addslashes($_POST['dbhost']);
$dbname = addslashes($_POST['dbname']);
$dbuser = addslashes($_POST['dbuser']);
$dbpass = addslashes($_POST['dbpass']);
$dbprefix = addslashes($_POST['dbprefix']);
}

if(empty($dbtyp))
{
$dbtyp = 'mysql';
}

$config_data = '<?php'."\n\n";
$config_data .= "\n// Otomatik oluşturulmuş config dosyası\n// Yakusha / Türk işi phpBB \n\n";


$config_data .= "//Admin paneli koruma şifresi\n";
$config_data .= "//değerleri kendi değerleriniz ile değiştiriniz\n";

$config_data .= "//\$config['adminuser'] = 'admin_user'; \n";
$config_data .= "//\$config['adminpassword'] = 'ilgili_parola'; \n\n";

$config_data .= '$dbms = \''.$dbtyp.'\';'."\n\n";
$config_data .= '$dbhost = \''.$dbhost.'\';'."\n";
$config_data .= '$dbname = \''.$dbname.'\';'."\n";
$config_data .= '$dbuser = \''.$dbuser.'\';'."\n";
$config_data .= '$dbpasswd = \''.$dbpass.'\';'."\n\n";
$config_data .= '$table_prefix = \''.$dbprefix.'\';'."\n\n";
$config_data .= 'define(\'PHPBB_INSTALLED\', true);'."\n\n";
$config_data .= '?'.'>'; 

@$fp = fopen("../config.php", "w+");
@fwrite($fp, $config_data);
@fclose($fp);

if (is_writeable('../config.php'))
{
// dosya yazım yetkileri var mı
$written = TRUE;
}

if($written == TRUE)
{
echo $langu['cwrit'];
echo '<a href="index.php?step=4&lang='.$language.'">'.$langu['fstell'].'</a> ';
echo "<p>";
}
else
{
echo $langu['cdol'];
echo '<form method="post" action="index.php?step=4&lang='.$language.'&mode=dlconfig">';
echo '<input type="hidden" name="conf_data" value="'.$config_data.'"><input type="submit" name="submit" value="'.$langu['dload'].'"';
echo "</form>";
echo '<p><a href="index.php?step=4&lang='.$language.'">'.$langu['fstell'].'</a>';
echo "<p>";
}

} // if instlall
else
{
echo "<p>".$langu['fertig']."<p>";
}

?>