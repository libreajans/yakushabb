<?php

define("IN_PHPBB", true);
error_reporting  (E_ERROR | E_WARNING | E_PARSE); // This will NOT report uninitialized variables

// General Information
$agreed = $_GET['agreed'];
$old_ver = 'Yakusha F-6.001';
$new_ver = 'Yakusha F-7.001';

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

" 
CREATE TABLE `phpbb_search_rebuild` (
 `rebuild_session_id` mediumint(8) unsigned NOT NULL auto_increment,
 `start_post_id` mediumint(8) unsigned NOT NULL default '0',
 `end_post_id` mediumint(8) unsigned NOT NULL default '0',
 `start_time` int(11) NOT NULL default '0',
 `end_time` int(11) NOT NULL default '0',
 `last_cycle_time` int(11) NOT NULL default '0',
 `session_time` int(11) NOT NULL default '0',
 `session_posts` mediumint(8) unsigned NOT NULL default '0',
 `session_cycles` mediumint(8) unsigned NOT NULL default '0',
 `search_size` int(10) unsigned NOT NULL default '0',
 `rebuild_session_status` tinyint(1) NOT NULL default '0',
 PRIMARY KEY (`rebuild_session_id`),
 KEY `end_post_id` (`end_post_id`)
);
",

" ALTER TABLE phpbb_posts_text modify post_subject varchar(100); ",
" ALTER TABLE phpbb_topics modify topic_title varchar(100); ",
" ALTER TABLE phpbb_users ADD user_allowsig TINYINT(1) default '1' NOT NULL AFTER user_allowavatar; ",

" CREATE TABLE `phpbb_favorites` (
`fav_id` int(11) NOT NULL auto_increment,
`user_id` int(11) NOT NULL default '0',
`topic_id` int(11) NOT NULL default '0',
PRIMARY KEY (`fav_id`)); ",

//forum icon
"ALTER TABLE `phpbb_forums` ADD `forum_icon` VARCHAR( 255 ) default NULL;",

"CREATE TABLE phpbb_inline_ads (
ad_id TINYINT( 5 ) NOT NULL auto_increment,
ad_code TEXT NOT NULL ,
ad_name CHAR( 25 ) NOT NULL,
PRIMARY KEY (ad_id)
); ",

"INSERT INTO phpbb_inline_ads (ad_id , ad_code, ad_name ) VALUES 
(1, '<a href=http://www.canver.net><img src=http://www.canversoft.net/banner/canversoft468.png></a>', 'canversoft'); ",

"INSERT INTO phpbb_config ( config_name , config_value ) VALUES
('ad_after_post', '1'), ('ad_post_threshold', ''), ('ad_every_post', ''), ('ad_who', '1'),
('ad_no_forums', ''), ('ad_no_groups', ''), ('ad_old_style', '1'); ",


" CREATE TABLE phpbb_report_cat (
 cat_id mediumint(8) NOT NULL auto_increment,
 cat_name varchar(100) NOT NULL default '',
 cat_type tinyint(1) NOT NULL default '0',
 cat_auth tinyint(1) NOT NULL default '0',
 cat_explain text NOT NULL,
 PRIMARY KEY (cat_id)
); ",

"CREATE TABLE phpbb_report (
 report_id mediumint(8) NOT NULL auto_increment,
 cat_id mediumint(8) NOT NULL,
 report_status tinyint(1) NOT NULL default '0',
 report_date int(11) NOT NULL default '0',
 report_user_id mediumint(8) NOT NULL default '0',
 report_info varchar(100) NOT NULL default '',
 report_text text NOT NULL,
 PRIMARY KEY (report_id),
 KEY cat_id (cat_id)
); ",

" INSERT INTO phpbb_report_cat (cat_id, cat_name, cat_type, cat_auth, cat_explain) VALUES (1, 'Report Post', 1, 0, ''); ",
" INSERT INTO phpbb_report_cat (cat_id, cat_name, cat_type, cat_auth, cat_explain) VALUES (2, 'Report Topic', 1, 0, ''); ",
" INSERT INTO phpbb_report_cat (cat_id, cat_name, cat_type, cat_auth, cat_explain) VALUES (3, 'Report User', 1, 0, ''); ",

" INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_color_not_cleared', '#A8371D'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_color_in_process', '#1B75BE'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_color_cleared', '#297F3F'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_list', '0'); ",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_notify', '0'); ",

" DROP TABLE `phpbb_ctrack`; ",
" DROP TABLE `phpbb_ct_filter`; ",
" DROP TABLE `phpbb_ct_viskey`; ",
" ALTER TABLE `phpbb_users` DROP `ct_logintry`; ",
" ALTER TABLE `phpbb_users` DROP `ct_unsucclogin`; ",
" ALTER TABLE `phpbb_users` DROP `ct_pwreset`; ",
" ALTER TABLE `phpbb_users` DROP `ct_mailcount`; ",
" ALTER TABLE `phpbb_users` DROP `ct_postcount`; ",
" ALTER TABLE `phpbb_users` DROP `ct_posttime`; ",
" ALTER TABLE `phpbb_users` DROP `ct_searchcount`; ",
" ALTER TABLE `phpbb_users` DROP `ct_searchtime`; ",

" CREATE TABLE `phpbb_ctracker_filechk` (
`filepath` text,
`hash` varchar(32) default NULL
) TYPE=MyISAM; ",

" CREATE TABLE `phpbb_ctracker_filescanner` (
`id` smallint(5) NOT NULL,
`filepath` text,
`safety` smallint(1) NOT NULL default '0',
PRIMARY KEY (`id`)
) TYPE=MyISAM; ",

" CREATE TABLE `phpbb_ctracker_ipblocker` (
`id` mediumint(8) unsigned NOT NULL,
`ct_blocker_value` varchar(250) default NULL,
PRIMARY KEY (`id`)
) TYPE=MyISAM AUTO_INCREMENT=33 ; ",

" CREATE TABLE `phpbb_ctracker_config` (
`ct_config_name` varchar(255) NOT NULL,
`ct_config_value` varchar(255) NOT NULL,
PRIMARY KEY (`ct_config_name`)
) TYPE=MyISAM; ",

" CREATE TABLE `phpbb_ctracker_loginhistory` (
`ct_user_id` int(10) default NULL,
`ct_login_ip` varchar(16) default NULL,
`ct_login_time` int(11) NOT NULL default '0'
) TYPE=MyISAM; ",

" ALTER TABLE `phpbb_users` ADD `ct_search_time` INT( 11 ) NULL DEFAULT 1 AFTER `user_newpasswd`; ",
" ALTER TABLE `phpbb_users` ADD `ct_search_count` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_search_time`; ",
" ALTER TABLE `phpbb_users` ADD `ct_last_mail` INT( 11 ) NULL DEFAULT 1 AFTER `ct_search_count`; ",
" ALTER TABLE `phpbb_users` ADD `ct_last_post` INT( 11 ) NULL DEFAULT 1 AFTER `ct_last_mail`; ",
" ALTER TABLE `phpbb_users` ADD `ct_post_counter` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_last_post`; ",
" ALTER TABLE `phpbb_users` ADD `ct_last_pw_reset` INT( 11 ) NULL DEFAULT 1 AFTER `ct_post_counter`; ",
" ALTER TABLE `phpbb_users` ADD `ct_enable_ip_warn` TINYINT( 1 ) NULL DEFAULT 1 AFTER `ct_last_pw_reset`; ",
" ALTER TABLE `phpbb_users` ADD `ct_last_used_ip` VARCHAR( 16 ) NULL DEFAULT '0.0.0.0' AFTER `ct_enable_ip_warn`; ",
" ALTER TABLE `phpbb_users` ADD `ct_last_ip` VARCHAR( 16 ) NULL DEFAULT '0.0.0.0' AFTER `ct_last_used_ip`; ",
" ALTER TABLE `phpbb_users` ADD `ct_login_count` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_last_used_ip`; ",
" ALTER TABLE `phpbb_users` ADD `ct_login_vconfirm` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_login_count`; ",
" ALTER TABLE `phpbb_users` ADD `ct_last_pw_change` INT( 11 ) NULL DEFAULT 1 AFTER `ct_login_vconfirm`; ",
" ALTER TABLE `phpbb_users` ADD `ct_global_msg_read` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_last_pw_change`; ",
" ALTER TABLE `phpbb_users` ADD `ct_miserable_user` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_global_msg_read`; ",


" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('ipblock_enabled', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('ipblock_logsize', '100'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('auto_recovery', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('vconfirm_guest', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('autoban_mails', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('detect_misconfiguration', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_time_guest', '30'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_time_user', '20'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_count_guest', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_count_user', '4'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('massmail_protection', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_protection', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_blocktime', '30'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_lastip', '0.0.0.0'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pwreset_time', '20'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('massmail_time', '20'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_time', '30'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_postcount', '4'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_blockmode', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('loginfeature', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_reset_feature', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_last_reg', '1155944976'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_history', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_history_count', '10'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_ip_check', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_validity', '30'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex_min', '4'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex_mode', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_control', '0'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex', '0'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('last_file_scan', '1156000091'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('last_checksum_scan', '1156000082'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logsize_logins', '100'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logsize_spammer', '100'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_ip_scan', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('global_message', 'Hello world!'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('global_message_type', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logincount', '2'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_feature_enabled', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spam_attack_boost', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spam_keyword_det', '1'); ",
" INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('footer_layout', '3'); ",


" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (1, '*WebStripper*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (2, '*NetMechanic*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (3, '*CherryPicker*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (4, '*EmailCollector*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (5, '*EmailSiphon*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (6, '*WebBandit*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (7, '*EmailWolf*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (8, '*ExtractorPro*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (9, '*SiteSnagger*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (10, '*CheeseBot*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (11, '*ia_archiver*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (12, '*Website Quester*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (13, '*WebZip*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (14, '*moget*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (15, '*WebSauger*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (16, '*WebCopier*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (17, '*WWW-Collector*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (18, '*InfoNaviRobot*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (19, '*Harvest*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (20, '*Bullseye*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (21, '*LinkWalker*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (22, '*LinkextractorPro*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (23, '*Proxy*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (24, '*BlowFish*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (25, '*WebEnhancer*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (26, '*TightTwatBot*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (27, '*LinkScan*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (28, '*WebDownloader*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (29, 'lwp'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (30, '*BruteForce*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (31, 'lwp-*'); ",
" INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (32, '*anonym*'); ",

#-- captha
" CREATE TABLE `phpbb_captcha_config` (
 `config_name` varchar(255) NOT NULL default '',
 `config_value` varchar(100) NOT NULL default '',
 PRIMARY KEY (`config_name`)
) TYPE=MyISAM; ",


" INSERT INTO `phpbb_captcha_config` VALUES ('width', '320'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('height', '60'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('background_color', '#E5ECF9');",
" INSERT INTO `phpbb_captcha_config` VALUES ('jpeg', '0'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('jpeg_quality', '50'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters', '0'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters_great', '0'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('font', '0'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('chess', '0'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('ellipses', '1'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('arcs', '0'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('lines', '1'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('image', '0'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('gammacorrect', '0.8'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_x', '15'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_y', '15'); ",
" INSERT INTO `phpbb_captcha_config` VALUES ('lattice_color', '#FFFFFF'); ",

" ALTER TABLE `phpbb_confirm` CHANGE `code` `code` CHAR(10) NOT NULL; ",



#-- tema tablosu boşaltılıyor ve temalar yeniden tanıtılıyor
" TRUNCATE TABLE `phpbb_themes`; ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('1', 'xand', 'xand', 'xand.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', NULL, NULL); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('2', 'emexci', 'emexci_emexci', 'emexci_emexci.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('3', 'emexci', 'emexci_ndesign', 'emexci_ndesign.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('4', 'emexci', 'emexci_cback', 'emexci_cback.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('5', 'emexci', 'emexci_plus', 'emexci_plus.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('6', 'emexci', 'emexci_silver', 'emexci_silver.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('7', 'emexci', 'emexci_smartblue', 'emexci_smartblue.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('8', 'emexci', 'emexci_alexis', 'emexci_alexis.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('9', 'emexci', 'emexci_yakusha_f4', 'emexci_yakusha_f4.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', '0', '0'); ",
" INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('10', 'emexci', 'emexci', 'emexci.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', NULL, NULL); ",

" TRUNCATE TABLE `phpbb_themes_name`; ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('1', 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('4', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('6', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('7', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('8', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('9', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",
" INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''); ",

//---------- mod listesi girilyor
" TRUNCATE TABLE `phpbb_hacks_list`; ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('1', 'Şehir Açılır Kutuda', 'Kullanıcı profilinde bulunan ve profil değişikliği ile kayıt sırasında doldurulabilen şehir/nereli girdi kutusunu, içinde şehirlerin yer aldığı açılır (drop-down) bir kutu ile değiştirir.', 'ALEXIS', '', 'http://www.canver.net', '3.0.0', 'No', '', '0', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('2', 'Meslek Açılır Kutuda', 'Kullanıcı profilinde bulunan ve profil değişikliği ile kayıt sırasında doldurulabilen meslek girdi kutusunu, içinde mesleklerin yer aldığı açılır (drop-down) bir kutu ile değiştirir.', 'ALEXIS', '', 'http://www.canver.net', '2.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('3', 'Toplam üye sayısı link', 'index.php sayfasının altında bulunan istatiktik kutusunda yer alan toplam üye sayısını üye listesine gidecek şekilde linkler.', 'ALEXIS', '', 'http://www.canver.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('4', 'Forum yönetim geliştirme', 'Yönetim panelindeki forum yönetim kısmında, sil, değiştir, düzenle vb. linkleri resimler ile değiştirdim ;)', 'ALEXIS', '', 'http://www.canver.net', '1.0.0a', 'no', '', '', '0'); ",
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
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('15', 'Highlight Clean', 'Highlight özelliği için bir düzeltme içerir. (Yayınlanmamış sürümdür)', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.3', 'No', '', '', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('16', 'Bantron Eklentileri', 'Bantron ile banlanan üyeye, otomatik olarak, önceden ayarlanmış olan banlı rütbesini atar, renk gruplarından da aynı işlemi gerçekleştirir. Eğer üye üye listesinden banlanmışsa, yine aynı işlemi yapar. :)', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.1', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('17', 'İstatistik bilgilerine bilgi ekle', 'Panele arama tablosu ve mesaj tablosu büyüklüğünü de ekler', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('18', 'Date and backup type in backup filename', 'his MOD automatically adds the current date and backup type to the filename of database backup files', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('19', 'Logged In control on acp', 'Profil görüntüleme, üye listesi, kimler online sayfalarını misafirlerin görüp göremeyeceğini panelden ayarlamaya yarar', 'yakusha', 'yakusha@tnn.net', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",
" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('20', 'Yöneticiler daima isim değiştirebilir', 'Yöneticiler hesap ayarlarından (profillerinden) kendi isimlerini daima değiştirebilirler', 'ALEXIS', '', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",

" INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('21', 'pafiledb icon adları', 'pafiledb modunda dosya yüklerken seçmemiz istenen iconlar adlarını icon dosyası adından alır. Mod bu addaki uzantıyı temizler ve icona title olarak yazar.', 'ALEXIS', '', 'http://www.canver.net', '1.0.0', 'No', '', '', '0'); ",

#-[+]---- son bakım işlemleri ----
" UPDATE phpbb_config SET `config_name` = 'default_style', `config_value` = '1' WHERE `config_name` = 'default_style'; ",
" UPDATE phpbb_config SET `config_name` = 'default_lang', `config_value` = 'turkish' WHERE `config_name` = 'default_lang';",
" UPDATE phpbb_users SET `user_style` = 'NULL' WHERE `user_id` > '1';",

" UPDATE phpbb_config SET `config_name` = 'yakusha_ver', `config_value` = 'yakusha f-7.001' WHERE `config_name` = 'yakusha_ver';",
" INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_automat',1); ",

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