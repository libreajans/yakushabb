<?php

define("IN_PHPBB", true);
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables

// General Information
$agreed = $_GET['agreed'];
$old_ver = 'Yakusha F-5.003';
$new_ver = 'Yakusha F-6.001';

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
body  { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; background-color: #e8eaed;}
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
" DROP TABLE  phpbb_preload; ",
" TRUNCATE TABLE phpbb_sessions; ",
" TRUNCATE TABLE phpbb_sessions_keys; ",
" TRUNCATE TABLE phpbb_hacks_list; ",

// versiyonlar giriliyor
" UPDATE phpbb_ctrack SET value = '4.1.7' WHERE name = 'version'; ",
" UPDATE phpbb_config SET config_value = '.0.21' WHERE config_name = 'version';",
" UPDATE phpbb_config SET config_value = 'Yakusha F-6.001' WHERE config_name = 'yakusha_ver';",

//-- otomatik üye sil, üyeyi silmez, silinmiş diye işaretler
" ALTER TABLE `phpbb_users` ADD `user_fake_delete` TINYINT( 1 ) DEFAULT '0' NOT NULL ; ",

//----------- loged in control --------
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_login_for_profile',1);",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_login_for_memberlist',1);",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_login_for_whoisonline',1);",

//-- eski hızlı cevap kaldırılıyor
" ALTER TABLE phpbb_users DROP user_quickreply; ",
" DELETE FROM phpbb_config WHERE config_name = 'allow_quickreply'; ",

//--attach ekleniyor ---
" DROP TABLE phpbb_attachments_config; ",
" CREATE TABLE phpbb_attachments_config (
  config_name varchar(255) NOT NULL,
  config_value varchar(255) NOT NULL,
  PRIMARY KEY (config_name)
);",

" DROP TABLE phpbb_forbidden_extensions;",
" CREATE TABLE phpbb_forbidden_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  extension varchar(100) NOT NULL,
  PRIMARY KEY (ext_id)
);",

"DROP TABLE phpbb_extension_groups;",
"CREATE TABLE phpbb_extension_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name char(20) NOT NULL,
  cat_id tinyint(2) DEFAULT '0' NOT NULL,
  allow_group tinyint(1) DEFAULT '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  upload_icon varchar(100) DEFAULT '',
  max_filesize int(20) DEFAULT '0' NOT NULL,
  forum_permissions varchar(255) default '' NOT NULL,
  PRIMARY KEY group_id (group_id)
);",

"DROP TABLE phpbb_extensions;",
"CREATE TABLE phpbb_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  extension varchar(100) NOT NULL,
  comment varchar(100),
  PRIMARY KEY ext_id (ext_id)
);",

"DROP TABLE phpbb_attachments_desc;",
"CREATE TABLE phpbb_attachments_desc (
  attach_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  physical_filename varchar(255) NOT NULL,
  real_filename varchar(255) NOT NULL,
  download_count mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  comment varchar(255),
  extension varchar(100),
  mimetype varchar(100),
  filesize int(20) NOT NULL,
  filetime int(11) DEFAULT '0' NOT NULL,
  thumbnail tinyint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (attach_id),
  KEY filetime (filetime),
  KEY physical_filename (physical_filename(10)),
  KEY filesize (filesize)
);",

"DROP TABLE phpbb_attachments;",
"CREATE TABLE phpbb_attachments (
  attach_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  privmsgs_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id_1 mediumint(8) NOT NULL,
  user_id_2 mediumint(8) NOT NULL,
  KEY attach_id_post_id (attach_id, post_id),
  KEY attach_id_privmsgs_id (attach_id, privmsgs_id),
  KEY post_id (post_id),
  KEY privmsgs_id (privmsgs_id)
);",

"DROP TABLE phpbb_quota_limits;",
"CREATE TABLE phpbb_quota_limits (
  quota_limit_id mediumint(8) unsigned NOT NULL auto_increment,
  quota_desc varchar(20) NOT NULL default '',
  quota_limit bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (quota_limit_id)
);",

"DROP TABLE phpbb_attach_quota;",
"CREATE TABLE phpbb_attach_quota (
  user_id mediumint(8) unsigned NOT NULL default '0',
  group_id mediumint(8) unsigned NOT NULL default '0',
  quota_type smallint(2) NOT NULL default '0',
  quota_limit_id mediumint(8) unsigned NOT NULL default '0',
  KEY quota_type (quota_type)
);",

"ALTER TABLE phpbb_forums ADD auth_download TINYINT(2) DEFAULT '0' NOT NULL; ",
"ALTER TABLE phpbb_auth_access ADD auth_download TINYINT(1) DEFAULT '0' NOT NULL; ",
"ALTER TABLE phpbb_posts ADD post_attachment TINYINT(1) DEFAULT '0' NOT NULL; ",
"ALTER TABLE phpbb_topics ADD topic_attachment TINYINT(1) DEFAULT '0' NOT NULL; ",
"ALTER TABLE phpbb_privmsgs ADD privmsgs_attachment TINYINT(1) DEFAULT '0' NOT NULL; ",

// -- attachments_config
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_dir','files'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_img','images/icon_clip.gif'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('topic_icon','images/icon_clip.gif'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('display_order','0'); ",

" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize','262144'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_quota','52428800'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize_pm','262144'); ",

" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments','3'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments_pm','1'); ",

" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('disable_mod','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_pm_attach','1'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_topic_review','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_ftp_upload','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('show_apcp','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attach_version','2.4.3'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_upload_quota', '0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_pm_quota', '0'); ",

" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_server',''); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_path',''); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('download_path',''); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_user',''); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pass',''); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pasv_mode','1'); ",

" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_display_inlined','1'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_width','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_height','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_width','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_height','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_create_thumbnail','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_min_thumb_filesize','12000'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_imagick', ''); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('use_gd2','0'); ",

" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('wma_autoplay','0'); ",
" INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('flash_autoplay','0'); ",

// -- forbidden_extensions
" INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (1,'php'); ",
" INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (2,'php3'); ",
" INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (3,'php4'); ",
" INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (4,'phtml'); ",
" INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (5,'pl'); ",
" INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (6,'asp'); ",
" INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (7,'cgi'); ",

// -- extension_groups
" INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (1,'Images',1,1,1,'',0,''); ",
" INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (2,'Archives',0,1,1,'',0,''); ",
" INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (3,'Plain Text',0,0,1,'',0,''); ",
" INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (4,'Documents',0,0,1,'',0,''); ",
" INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (5,'Real Media',0,0,2,'',0,''); ",
" INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (6,'Streams',2,0,1,'',0,''); ",
" INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (7,'Flash Files',3,0,1,'',0,''); ",

// -- extensions
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (1, 1,'gif', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (2, 1,'png', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (3, 1,'jpeg', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (4, 1,'jpg', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (5, 1,'tif', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (6, 1,'tga', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (7, 2,'gtar', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (8, 2,'gz', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (9, 2,'tar', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (10, 2,'zip', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (11, 2,'rar', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (12, 2,'ace', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (13, 3,'txt', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (14, 3,'c', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (15, 3,'h', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (16, 3,'cpp', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (17, 3,'hpp', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (18, 3,'diz', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (19, 4,'xls', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (20, 4,'doc', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (21, 4,'dot', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (22, 4,'pdf', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (23, 4,'ai', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (24, 4,'ps', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (25, 4,'ppt', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (26, 5,'rm', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (27, 6,'wma', ''); ",
" INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (28, 7,'swf', ''); ",

// -- default quota limits
" INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (1, 'Low', 262144); ",
" INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (2, 'Medium', 2097152); ",
" INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (3, 'High', 5242880); ",
//-- attach mod sonu ---


//---------- mod listesi girilyor
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('1', 'Şehir Açılır Kutuda', 'Kullanıcı profilinde bulunan ve profil değişikliği ile kayıt sırasında doldurulabilen şehir/nereli girdi kutusunu, içinde şehirlerin yer aldığı açılır (drop-down) bir kutu ile değiştirir.', 'ALEXIS', 'phpbb@canver.net', 'http://www.canver.net', '3.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('2', 'Meslek Açılır Kutuda', 'Kullanıcı profilinde bulunan ve profil değişikliği ile kayıt sırasında doldurulabilen meslek girdi kutusunu, içinde mesleklerin yer aldığı açılır (drop-down) bir kutu ile değiştirir.', 'ALEXIS', '', 'http://www.canver.net', '2.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('3', 'Toplam üye sayısı link', 'index.php sayfasının altında bulunan istatiktik kutusunda yer alan toplam üye sayısını üye listesine gidecek şekilde linkler.', 'ALEXIS', '', 'http://www.canver.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('4', 'forum yönetim geliştirme', 'Yönetim panelindeki forum yönetim kısmında, sil, değiştir, düzenle vb. linkleri resimler ile değiştirdim ;)', 'ALEXIS', '', 'http://www.canver.net', '1.0.0a', 'no', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('5', 'Display Total Replies And Views In Viewtopic', 'Bu eklenti wiewtopic.php de toplam cevabı ve gösterimi gösterir', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.1', 'No', '', '0', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('6', 'Display forum desciription in viewforum', 'Bu eklenti wiewforum.php de forum açıklamasını gösterir', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('7', 'Special ban system', 'Üyelerin, mesaj gönderip gönderemeyeceğine yöneticilerin karar verebilmelerine imkan tanır.', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('8', 'Multi-page topics, forums or searchs in one page', 'Çoklu sonuçları tek sayfada gösterir, topic, forum ve search sayfalarında..', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.5', 'No', '', '', '1144334662'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('9', 'My bbcode box lt', 'BBcode butonlarını Microsoft Office 2003 tarzı buton seti şekline dönüştürür ve yeni bbcode özellikleri ekler. Advancad bbcode box modunun daha da küçültülmüş, orta halli bir türevidir. Çoklu dil özelliklerini kaldıracak şekilde yapılandırılmıştır.', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '2.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('10', 'Yakusha Modlist', 'Modların listesinin oluşturulmasına ve mod bilgilerinin düzenlenmesine imkan tanır. Nivisec - Admin hack list 1.2.0 modunun geliştirilmiş bir türevidir.', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '0', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('11', 'Son 3 günün kayıt olan üyeleri', 'Bu mod son kaydolan kullanıcı kısmını son 3 gün içinde kaydolan ve hesapları aktif edilmiş üyelerin listesi ile değiştirir.', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '', '1144334662'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('12', 'Lock / Unlock Topic with Post', 'Mesajdan ilgili başlığı kilitlemeye veya kilidi açmaya yarar.', 'Yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.2', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('13', 'Light Statictik', 'İstatistik bilgisi verileri için fazladan yapılan if döngüsü karmaşasını düzeltir.', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('14', 'Clean BBcode', 'Oluşturduğumuz bir bbcode listesiyle açıkta kalan geçersiz biçim kodlarını temizler', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.2', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('15', 'Highlight fix on search.php', 'arama sayfasındaki highlight özelliği için bir düzeltme içerir.', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.2', 'No', '', '', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('16', 'Bantron Eklentileri', 'Bantron ile banlanan üyeye, otomatik olarak, önceden ayarlanmış olan banlı rütbesini atar, renk gruplarından da aynı işlemi gerçekleştirir. Eğer üye üye listesinden banlanmışsa, yine aynı işlemi yapar. :)', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('17', 'İstatistik bilgilerine bilgi ekle', 'Panele arama tablosu ve mesaj tablosu büyüklüğünü de ekler', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('18', 'Date and backup type in backup filename', 'his MOD automatically adds the current date and backup type to the filename of database backup files', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('19', 'Logged In control on acp', 'Profil görüntüleme, üye listesi, kimler online sayfalarını misafirlerin görüp göremeyeceğini panelden ayarlamaya yarar', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('20', 'Yöneticiler daima isim değiştirebilir', 'Yöneticiler hesap ayarlarından (profillerinden) kendi isimlerini daima değiştirebilirler', 'ALEXIS', '', 'http://www.canver.net', '1.0.0', 'No', '', '', '0');",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('21', 'pafiledb icon adları', 'pafiledb modunda dosya yüklerken seçmemiz istenen iconlar adlarını icon dosyası adından alır. Mod bu addaki uzantıyı temizler ve icona title olarak yazar.', 'ALEXIS', '', 'http://www.canver.net', '1.0.0', 'No', '', '', '0');",

" ALTER TABLE phpbb_users DROP user_quickreply; ",
" DELETE FROM phpbb_config WHERE config_name = 'allow_quickreply'; ",

"TRUNCATE TABLE `phpbb_themes`; ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('1', 'emexci', 'emexci', 'emexci.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', NULL, NULL); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('2', 'emexci', 'emexci_emexci', 'emexci_emexci.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('3', 'emexci', 'emexci_ndesign', 'emexci_ndesign.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('4', 'emexci', 'emexci_cback', 'emexci_cback.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('5', 'emexci', 'emexci_plus', 'emexci_plus.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('6', 'emexci', 'emexci_silver', 'emexci_silver.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('7', 'emexci', 'emexci_smartblue', 'emexci_smartblue.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('8', 'emexci', 'emexci_alexis', 'emexci_alexis.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('9', 'emexci', 'emexci_yakusha_f4', 'emexci_yakusha_f4.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('10', 'subSilver', 'subSilver', 'subSilver.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",

" TRUNCATE TABLE `phpbb_themes_name`; ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('1', 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('6', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('7', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('8', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('9', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');  ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",




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
