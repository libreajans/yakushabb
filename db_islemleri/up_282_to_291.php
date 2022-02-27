<?php

define("IN_PHPBB", true);
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables

// General Information
$agreed = $_GET['agreed'];
$old_ver = 'Yakusha 2.8.2';
$new_ver = 'Yakusha 2.9.1';

$title = $old_ver. ' &raquo; ' .$new_ver;
$version = 'V.1.0.0';
$rootpath = './';
$sprefix = 'phpbb_';

// Load Configuration
@@include($rootpath . "extension.inc");
@@include($rootpath . "config." . $phpEx);
?>

<html>
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<style>
body { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; background-color: #e8eaed;}
h3 { font-size : 16px; color: darkred; border-bottom-width: 2px; border-bottom-style: dotted; border-bottom-color: #D1D7DC; }
.error { font-family: Arial; font-size : 11px; color: red; font-weight: bold; }
.okey { font-family: Arial; font-size : 11px; color: #00AA00; font-weight: bold; }
.islem { font-family: Arial; font-size : 11px; color: #808080; font-weight: normal; }
p { font-family: Verdana; font-size : 13px; font-weight: normal; }
</style>

</head>
<body bgcolor="#70A5CC">

<?php
// veri tabanı bağlantısı
@$sql = mysql_connect($dbhost, $dbuser, $dbpasswd)
or die("<span class='error'><center>Sistem Hatası: SQL Bağlantısı Kurulamıyor.</span>");

@mysql_select_db($dbname)
or die("<span class='error'><center>Sistem Hatası: Database Bağlantısı Kurulamıyor..</span>");

// sql sorguları
$sql = Array(

#-- tema tablosu boşaltılıyor ve temalar yeniden tanıtılıyor
" TRUNCATE TABLE `phpbb_themes`; ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('1', 'xand', 'xand', 'xand.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', NULL, NULL); ",

" TRUNCATE TABLE `phpbb_themes_name`; ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('1', 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', ''); ",

" UPDATE `phpbb_config` SET `config_value` = '.0.22' WHERE `config_name` = 'version'; ",
" ALTER TABLE `phpbb_forums` ADD `forum_keywords` TEXT NOT NULL; ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('site_keywords','site açıklaması, 255 karakter, sınırı, vardır.');  ",

" DELETE FROM phpbb_config WHERE config_name = 'max_sessions'; ",
" DELETE FROM phpbb_config WHERE config_name = 'max_sessions_ip'; ",
" DROP TABLE phpbb_jr_admin_users; ",
" ALTER TABLE phpbb_search_results MODIFY COLUMN search_array MEDIUMTEXT NOT NULL; ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('icon_mod_open', '1'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('basit_seo_open', '1'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('admin_message_save_from_mods', '1'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('forum_width', '830'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_user_online_today', '1'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_page_on_top', '1'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_search_bots', '1'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_mods_ban', '0'); ", 
" UPDATE `phpbb_config` SET `config_value` = '6144' WHERE `config_name` = 'avatar_filesize'; ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('visit_counter', '1000'); ",
" ALTER TABLE phpbb_users DROP user_topic_moved_mail; ",
" ALTER TABLE phpbb_users DROP user_topic_moved_pm; ",
" ALTER TABLE phpbb_users DROP user_topic_moved_pm_notify; ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('hide_links', '0'); ",
" CREATE TABLE `phpbb_backup` (
	`backup_skill` int(1)  NOT NULL,
	`email_true` int(1)  NOT NULL,
	`email` text  NOT NULL,
	`ftp_true` int(1)  NOT NULL,
	`ftp_server` text  NOT NULL,
	`ftp_user_name` text  NOT NULL,
	`ftp_user_pass` text  NOT NULL,
	`ftp_directory` text  NOT NULL,
	`write_backups_true` int(1)  NOT NULL,
	`files_to_keep` varchar(255) NOT NULL,
	`cron_time` text  NOT NULL,
	`delay_time` text  NOT NULL,
	`backup_type` text  NOT NULL,
	`phpbb_only` int(1)  NOT NULL,
    `no_search` int(1) NOT NULL,
    `ignore_tables` text NOT NULL,	
	`last_run` int(11) NOT NULL,
	`finished` int(1) NOT NULL
); ",

" INSERT INTO `phpbb_backup` VALUES (0, 1, 'youremail@domain.ext, yourotheremail@anotherdomain.ext', 1, 'ftp.server.com', 'ftp_username', 'ftp_password', '/backups', '1', '-1', '0    0    *    *    *', '120', 'full', 0, 0, 'phpbb_ignore_me, separate_tables_with_a_comma_and_space, ignored, ignore_me_too', 1143162120, 0); ",

#-[+]---- son bakım işlemleri ----
" UPDATE phpbb_config SET `config_name` = 'default_style', `config_value` = '1' WHERE `config_name` = 'default_style'; ",
" UPDATE phpbb_config SET `config_name` = 'default_lang', `config_value` = 'turkish' WHERE `config_name` = 'default_lang';",
" UPDATE phpbb_users SET `user_style` = 'NULL';",

" UPDATE phpbb_config SET `config_name` = 'yakusha_ver', `config_value` = 'yakusha 2.9.1' WHERE `config_name` = 'yakusha_ver';",
#-[-]---- son bakım işlemleri ----

);
?>

<center>
<table border="0" width="800px" cellspacing="0">
<tr>
<td width="100%" valign="top" bgcolor="#ffffff">
<br>
<br>
 <table align="center" border="0" height="850%" width="90%" cellspacing="0">
 <tr>
 <td align="right">
 <h3><b><?=$title; ?></b> <small><?=$version; ?></small></h3>
 <br>
 <br>
 <p align="center"><?php echo $old_ver;?> için Database güncelleme işlemine hoşgeldiniz. <br /><br />Bu kurulum Scripti Databasenizi <br /><b><?php echo $old_ver;?></b> sürümünden <b><?php echo $new_ver;?></b><br /> sürümüne güncelleyecektir.
 </td>
 </tr>
 <tr>
 <td>
 <?php
 if (@$agreed == "true") {

 echo "
 <br /><p align='center'><b>Database İşlemleri</b>
 <ul>
 ";
 // şimdi databese güncelleme işlemi gerçekleştiriliyor
 for( $i = 0; $i < count($sql); $i++ )
 {
 $sql[$i] = preg_replace('/' . $sprefix . '/', $table_prefix, $sql[$i]);
 if(!$result = mysql_query ($sql[$i]) )
 {
 echo '<li><span class="error">[ HATA ]</span><span class="islem"> ' . $sql[$i] . '</font></li></span><br />';
 }
 else
 {
 echo '<li><span class="okey">[ TAMAM ]</span><span class="islem"> ' . $sql[$i] . '</font></li></span><br />';
 }
 }
 echo "
 </ul>
 <p align='center'>İşlem tamamlanmıştır! Bu dosyayı web alanınızdan <b>mutlaka siliniz.</b>
 <br /><br />
 Foruma geri dönmek için <a href=\"./index.$phpEx\">buraya</a> tıklayınız.
 ";
 }
 else
 {
 echo "
 <br /><p align='center'> Güncelleme işlemini gerçekleştirmek için <a href=\"?agreed=true\">buraya</a> tıklayınız.
 ";
 }
 ?>
 </td>
 </tr>
 </table>
 </center>
 <br /><br />
</td>
</tr>
</table>
</body>
</html>


<?php @mysql_close($sql); ?>