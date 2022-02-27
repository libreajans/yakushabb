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

$dbpass = '';
$error = FALSE;

$dbpass = addslashes($HTTP_POST_VARS['dbpass']);

if(empty($dbpass))
{
// PHP >5.0.5
$dbpass = addslashes($_POST['dbpass']);
}

include("../config.php");

$dbprefix = $table_prefix;

if($dbpass != $dbpasswd)
{
echo "<img src='images/hata.png'>&nbsp; ".$langu['err3']."<p>";
$error = TRUE;
}

if($error == FALSE)
{
@$sql = mysql_connect($dbhost, $dbuser, $dbpasswd)
or die("<h2>yakusha '.$yakusha_version.'</h2><br />".$langu['err1']."<p><p>");

@mysql_select_db ($dbname)
or die("<h2>yakusha '.$yakusha_version.'</h2><br />".$langu['err2']."<p><p>");
}

//==================================================================
//=== KURULUM İŞLEMLERİ ===
//==================================================================

if($error == FALSE)
{
include("includes/sql_parse.php");
echo $langu['running'];


$starttime = time();
$passhash = md5($adminpass);


$schema ="dumps/con_yapi.sql";
$data ="dumps/con_veri.sql";
$altert ="dumps/con_upt.sql";
$remove_remarks = "remove_remarks";
$delimiter = ";";
$delimiter_basic = ";";
$sql = @fread(@fopen($schema, 'r'), @filesize($schema));
$sql = preg_replace('/phpbb_/', $dbprefix, $sql);
$sql = remove_remarks($sql);
$sql = split_sql_file($sql, $delimiter);

for( $i = 0; $i < count($sql); $i++ )
{
if(!$result = mysql_query ($sql[$i]) )
{
//echo '<p><font color="#FF0000"><b>'.$langu['dbresponse2'].'</b></font><br />'.$sql[$i];
}
else
{
//echo '<p><font color="#FF0000"><b>'.$langu['dbresponse1'].'</b></font><br />'.$sql[$i];
}
} // FOR

$sql = @fread(@fopen($data, 'r'), @filesize($data));
$sql = preg_replace('/phpbb_/', $dbprefix, $sql);
$sql = remove_remarks($sql);
$sql = split_sql_file($sql, $delimiter);

for( $i = 0; $i < count($sql); $i++ )
{
if(!$result = mysql_query ($sql[$i]) )
{
//echo '<p><font color="#FF0000"><b>'.$langu['dbresponse2'].'</b></font><br />'.$sql[$i];
}
else
{
//echo '<p><font color="#FF0000"><b>'.$langu['dbresponse1'].'</b></font><br />'.$sql[$i];
}
} // FOR

$sql = @fread(@fopen($altert, 'r'), @filesize($altert));
$sql = preg_replace('/phpbb_/', $dbprefix, $sql);
$sql = remove_remarks($sql);
$sql = split_sql_file($sql, $delimiter);

for( $i = 0; $i < count($sql); $i++ )
{
if(!$result = mysql_query ($sql[$i]) )
{
//echo '<p><font color="#FF0000"><b>'.$langu['dbresponse2'].'</b></font><br />'.$sql[$i];
}
else
{
//echo '<p><font color="#FF0000"><b>'.$langu['dbresponse1'].'</b></font><br />'.$sql[$i];
}
} // FOR END

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'version', `config_value` = '".$phpbbver."' WHERE `config_name` = 'version';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'yakusha_ver', `config_value` = '".$yakusha_version."' WHERE `config_name` = 'yakusha_ver';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_color_group` = '1' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'default_style', `config_value` = '1' WHERE `config_name` = 'default_style';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'default_lang', `config_value` = '".$language."' WHERE `config_name` = 'default_lang';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'default_dateformat', `config_value` = 'l d F Y H:i' WHERE `config_name` = 'default_dateformat';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_style` = 'NULL' WHERE `user_id` > '1';";
mysql_query($sql) or die(mysql_error());

echo "<form method='post' action='index.php?step=4&lang=$language'>";
echo $langu['dbresponse1']."<p><b><input type='submit' name='submit' value='".$langu['ok_btn']."'></b> <p>";
echo "</form>";

} // IF ! FALSE

//==================================================================
//=== KURULUM İŞLEMLERİ ===
//==================================================================

@mysql_close($sql);
@include 'eposta2.php';

?>