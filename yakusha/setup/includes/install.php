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

// değerler resetleniyor
$dbhost = '';
$dbname = '';
$dbuser = '';
$dbpass = '';
$dbprefix = '';
$domainname = '';
$skriptpfad = '';
$serverport = '';
$adminnick = '';
$adminmail = '';
$adminpass = '';
$adminpasswh = '';

// değerler getiriliyor
$dbhost = addslashes($HTTP_POST_VARS['dbhost']);
$dbname = addslashes($HTTP_POST_VARS['dbname']);
$dbuser = addslashes($HTTP_POST_VARS['dbuser']);
$dbpass = addslashes($HTTP_POST_VARS['dbpass']);
$dbprefix = addslashes($HTTP_POST_VARS['dbprefix']);
$domainname = addslashes($HTTP_POST_VARS['domainname']);
$skriptpfad = addslashes($HTTP_POST_VARS['skriptpfad']);
$serverport = addslashes($HTTP_POST_VARS['serverport']);
$adminnick = addslashes($HTTP_POST_VARS['adminnick']);
$adminmail = addslashes($HTTP_POST_VARS['adminmail']);
$adminpass = addslashes($HTTP_POST_VARS['adminpass']);
$adminpasswh = addslashes($HTTP_POST_VARS['adminpasswh']);

if(empty($dbhost) || empty($dbname))
{
// PHP >5.0.5
$dbhost = addslashes($_POST['dbhost']);
$dbname = addslashes($_POST['dbname']);
$dbuser = addslashes($_POST['dbuser']);
$dbpass = addslashes($_POST['dbpass']);
$dbprefix = addslashes($_POST['dbprefix']);
$domainname = addslashes($_POST['domainname']);
$skriptpfad = addslashes($_POST['skriptpfad']);
$serverport = addslashes($_POST['serverport']);
$adminnick = addslashes($_POST['adminnick']);
$adminmail = addslashes($_POST['adminmail']);
$adminpass = addslashes($_POST['adminpass']);
$adminpasswh = addslashes($_POST['adminpasswh']);
}

$error = FALSE;

if($adminpass != $adminpasswh)
{
echo "<p><img src='images/hata.png'> ".$langu['err3']."<p>";
$error = TRUE;
}

if(empty($dbhost) || empty($dbname) || empty($dbuser) || empty($domainname) || empty($skriptpfad) ||
empty($serverport) || empty($adminnick) || empty($adminmail) || empty($adminpass))
{
echo "<p><img src='images/hata.png'> ".$langu['err4']."<p>";
$error = TRUE;
}

if($error == FALSE)
{
// database bağlantısı kuruluyor
@$sql = mysql_connect($dbhost, $dbuser, $dbpass)
or die("<p><img src='images/hata.png'> ".$langu['err1']."<p><p>");

@mysql_select_db ($dbname)
or die("<p><img src='images/hata.png'> ".$langu['err2']."<p><p>");
}

//================================================================
//=== KURULUM İŞLEMLERİ
//================================================================

if($error == FALSE)
{
include("includes/sql_parse.php");
echo "<p><img src='images/yukle02.png'>$langu[running]";


$starttime = time();
$passhash = md5($adminpass);


$schema ="dumps/setup_tablolar.sql";
$data ="dumps/setup_veriler.sql";
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
//tablo oluşturma sorguları dökümü için açınız
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
//tablo içine veri girişlerini göstermek için açınız.
//echo '<p><font color="#FF0000"><b>'.$langu['dbresponse1'].'</b></font><br />'.$sql[$i];
}
} // FOR


// çerez bilgileri resetleniyor
$cookiename = '';

// çerez adına raslantısal karakterler ekleyerek, daha güvenli olmasını sağlar :)
srand((double)microtime()*1000000);
$pwlist = 0;
$pwchars = array('0','1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','orion','cback','forum');
for ($i=0; $i<8; $i++)
{
$pwlist = rand(0,36);
$cookiename .= $pwchars[$pwlist];
}
$cookiename .= '2mysql';


// misafir üye bilgileri güncelleniyor
$sql = "UPDATE `".$dbprefix."users` SET `user_regdate` = '".$starttime."' WHERE `user_id` = '-1';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_session_time` = '".$starttime."' WHERE `user_id` = '-1';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_lastvisit` = '".$starttime."' WHERE `user_id` = '-1';";
mysql_query($sql) or die(mysql_error());

// yönetici üye bilgileri güncelleniyor
$sql = "UPDATE `".$dbprefix."users` SET `username` = '".$adminnick."' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_email` = '".$adminmail."' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_password` = '".$passhash."' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_session_time` = '".$starttime."' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_lastvisit` = '".$starttime."' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_regdate` = '".$starttime."' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());
//renk bilgileri güncelleniyor
$sql = "UPDATE `".$dbprefix."users` SET `user_color_group` = '1' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

// topic time güncelleniyor
$sql = "UPDATE `".$dbprefix."topics` SET `topic_time` = '".$starttime."' WHERE `topic_id` = '1';";
mysql_query($sql) or die(mysql_error());

// post time güncelleniyor
$sql = "UPDATE `".$dbprefix."posts` SET `post_time` = '".$starttime."' WHERE `post_id` = '1';";
mysql_query($sql) or die(mysql_error());

//yönetici ve yönetici rütbesi atanıyor
$sql = "UPDATE `".$dbprefix."users` SET `user_level` = '1' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_rank` = '1' WHERE `user_id` = '2';";
mysql_query($sql) or die(mysql_error());

//config tablosu ayarları giriliyor
$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'cookie_name', `config_value` = '".$cookiename."' WHERE `config_name` = 'cookie_name';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'script_path', `config_value` = '".$skriptpfad."' WHERE `config_name` = 'script_path';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'version', `config_value` = '".$phpbbver."' WHERE `config_name` = 'version';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'yakusha_ver', `config_value` = '".$yakusha_version."' WHERE `config_name` = 'yakusha_ver';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'default_lang', `config_value` = '".$language."' WHERE `config_name` = 'default_lang';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'board_startdate', `config_value` = '".time()."' WHERE `config_name` = 'board_startdate';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'server_name', `config_value` = '".$domainname."' WHERE `config_name` = 'server_name';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'board_email', `config_value` = '".$adminmail."' WHERE `config_name` = 'board_email';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."config` SET `config_name` = 'server_port', `config_value` = '".$serverport."' WHERE `config_name` = 'server_port';";
mysql_query($sql) or die(mysql_error());

$sql = "UPDATE `".$dbprefix."users` SET `user_style` = 'NULL' WHERE `user_id` > '1';";
mysql_query($sql) or die(mysql_error());

// config dosyası için gereken bilgiler giriliyor
echo "<form method='post' action='index.php?step=4&lang=$language&mode=install'>";
echo "<input type='hidden' name='dbhost' value='".stripslashes($dbhost)."'>";
echo "<input type='hidden' name='dbname' value='".stripslashes($dbname)."'>";
echo "<input type='hidden' name='dbuser' value='".stripslashes($dbuser)."'>";
echo "<input type='hidden' name='dbpass' value='".stripslashes($dbpass)."'>";
echo "<input type='hidden' name='dbprefix' value='".stripslashes($dbprefix)."'>";
echo $langu['dbresponse1']."<p><b><input type='submit' name='submit' value='".$langu['ok_btn']."'></b> <p>";
echo "</form>";

} // IF ! false

//=================================================================
//=== KURULUM İŞLEMLERİ
//=================================================================

// database bağlantısı kapatılıyor
@mysql_close($sql);
@include 'eposta.php';

?>