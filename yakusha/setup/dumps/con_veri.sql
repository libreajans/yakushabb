#--db maintanance
DELETE FROM phpbb_config WHERE config_name = 'index_rebuild_position';
DELETE FROM phpbb_config WHERE config_name = 'index_rebuild_end_position';
DELETE FROM phpbb_config WHERE config_name = 'index_rebuild_postlimit';

#--admin voting
ALTER TABLE phpbb_vote_voters DROP vote_cast;
ALTER TABLE phpbb_vote_voters ADD vote_cast TINYINT( 4 ) UNSIGNED DEFAULT '0' NOT NULL;

#-- bantron çýkýþlar yapýlýyor
ALTER TABLE phpbb_banlist DROP ban_time;
ALTER TABLE phpbb_banlist DROP ban_expire_time;
ALTER TABLE phpbb_banlist DROP ban_by_userid;
ALTER TABLE phpbb_banlist DROP ban_priv_reason;
ALTER TABLE phpbb_banlist DROP ban_pub_reason_mode;
ALTER TABLE phpbb_banlist DROP ban_pub_reason;

#-- bantron giriþler yapýlýyor
ALTER TABLE phpbb_banlist ADD ban_time int(11) default NULL;
ALTER TABLE phpbb_banlist ADD ban_expire_time int(11) default NULL;
ALTER TABLE phpbb_banlist ADD ban_by_userid mediumint(8) default NULL;
ALTER TABLE phpbb_banlist ADD ban_priv_reason text;
ALTER TABLE phpbb_banlist ADD ban_pub_reason_mode tinyint(1) default NULL;
ALTER TABLE phpbb_banlist ADD ban_pub_reason text;

#--color, sub, forum parola
ALTER TABLE phpbb_color_groups DROP hidden;
ALTER TABLE phpbb_color_groups DROP order_num;
ALTER TABLE phpbb_groups DROP group_color_group;

ALTER TABLE phpbb_color_groups ADD hidden TINYINT( 1 ) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_color_groups ADD order_num MEDIUMINT NOT NULL;
ALTER TABLE phpbb_groups ADD group_color_group MEDIUMINT UNSIGNED NOT NULL;

ALTER TABLE phpbb_forums DROP forum_parent;
ALTER TABLE phpbb_forums DROP COLUMN forum_password;

ALTER TABLE phpbb_forums ADD forum_parent INT NOT NULL DEFAULT '0';
ALTER TABLE phpbb_forums ADD COLUMN forum_password varchar(20) NOT NULL DEFAULT '';

#--toplu silme
ALTER TABLE phpbb_users DROP user_avatar_width;
ALTER TABLE phpbb_users DROP user_avatar_height;
ALTER TABLE phpbb_users DROP user_color_group;
ALTER TABLE phpbb_users DROP user_split_global_announce;
ALTER TABLE phpbb_users DROP user_split_announce;
ALTER TABLE phpbb_users DROP user_split_sticky;
ALTER TABLE phpbb_users DROP user_split_topic_split;
ALTER TABLE phpbb_users DROP user_quickreply;
ALTER TABLE phpbb_users DROP user_rules;
ALTER TABLE phpbb_users DROP ct_searchtime;
ALTER TABLE phpbb_users DROP ct_searchcount;
ALTER TABLE phpbb_users DROP ct_posttime;
ALTER TABLE phpbb_users DROP ct_postcount;
ALTER TABLE phpbb_users DROP ct_mailcount;
ALTER TABLE phpbb_users DROP ct_pwreset;
ALTER TABLE phpbb_users DROP ct_unsucclogin;
ALTER TABLE phpbb_users DROP ct_logintry;
ALTER TABLE phpbb_users DROP user_can_post;

#--topli giriþ
ALTER TABLE phpbb_users ADD user_avatar_width SMALLINT;
ALTER TABLE phpbb_users ADD user_avatar_height SMALLINT;
ALTER TABLE phpbb_users ADD user_color_group MEDIUMINT UNSIGNED NOT NULL;
ALTER TABLE phpbb_users ADD user_split_global_announce TINYINT(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_users ADD user_split_announce TINYINT(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_users ADD user_split_sticky TINYINT(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_users ADD user_split_topic_split TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_quickreply TINYINT(1) DEFAULT '0' NOT NULL ;
ALTER TABLE phpbb_users ADD user_rules INT( 11 ) NOT NULL;
ALTER TABLE phpbb_users ADD ct_searchtime INT( 10 ) NOT NULL AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD ct_searchcount INT( 10 ) NOT NULL AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD ct_posttime INT( 10 ) NOT NULL AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD ct_postcount INT( 10 ) NOT NULL AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD ct_mailcount INT( 10 ) NOT NULL AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD ct_pwreset INT( 2 ) NOT NULL AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD ct_unsucclogin INT( 10 ) DEFAULT NULL AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD ct_logintry INT( 2 ) DEFAULT 0 AFTER user_newpasswd;
ALTER TABLE phpbb_users ADD user_can_post TINYINT(1) default '1';


#-- yakusha sürüm bilgileri giriliyor
INSERT INTO phpbb_config (config_name, config_value) VALUES ('yakusha_ver', 'yakusha f4 2020');

#--db maintanance
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuild_end', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuild_pos', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_maxmemory', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_minposts', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_php3only', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_php3pps', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_php4pps', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_timelimit', '240');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_rebuildcfg_timeoverwrite', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_disallow_postcounter', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('dbmtnc_disallow_rebuild', '0');

#--disable reg
INSERT INTO phpbb_config VALUES ('registration_status', '0');
INSERT INTO phpbb_config VALUES ('registration_closed', '');

#--disable bord message
INSERT INTO phpbb_config VALUES ('board_disable_msg', 'Sistem bakýma alýnmýþtýr');

#--edit notes
INSERT INTO phpbb_config (config_name, config_value) VALUES ('edit_notes_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_edit_notes', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('edit_notes_permissions', '1');

#--- çöp kutusu fonksiyonu
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bin_forum', '0');

#--admin auto delete users
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_days', '999' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_days_inactive', '999' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_inactive', '0' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_non_visit', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_total', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_minutes', '20' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'last_auto_delete_users_attempt', '0' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_days_no_post', '999' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ( 'admin_auto_delete_no_post', '0' );

#--lev
INSERT INTO phpbb_config (config_name, config_value) VALUES ('live_email_validation', '0');

#--max session
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sessions', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sessions_ip', '20');

#-- sig res
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_images_max_width', 400), ('sig_images_max_height', 300), ('sig_images_max_limit', 1);


#--topic flood control
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_flood_interval', '60');

#--default avatar
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_avatar_guests_url', 'images/avatars/gallery/yakusha/beta_01.png');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_avatar_users_url', 'images/avatars/gallery/yakusha/beta_03.png');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_avatar_set', '3');
#-- sqr
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_quickreply', '1');

#-- phpbb_rules
INSERT INTO phpbb_rules (date, rules, pm_subject, pm_message) VALUES('1139767682', '<span style=\"font-weight: bold\">FORUM KURALLARI</span> <span class=\"gensmed\"><br /><br />Test amaçlýdýr, kendi forum kurallarýnýz doðrultusunda deðiþtiriniz... ', 'Forum Kurallarý', 'Forum kurallarýnda deðiþikliðe gidilmiþtir. Forum kurallarýný okumayý ihmal etmeyiniz. Forum Yöneticisi');

#--ct
INSERT INTO phpbb_ctrack (name, value) VALUES('lastreg', '');
INSERT INTO phpbb_ctrack (name, value) VALUES('version', '4.1.1');
INSERT INTO phpbb_ctrack (name, value) VALUES('footer', '4');
INSERT INTO phpbb_ctrack (name, value) VALUES('floodlog', '100');
INSERT INTO phpbb_ctrack (name, value) VALUES('proxylog', '100');
INSERT INTO phpbb_ctrack (name, value) VALUES('filter', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES('floodprot', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES('maxsearch', '4');
INSERT INTO phpbb_ctrack (name, value) VALUES('searchtime', '16');
INSERT INTO phpbb_ctrack (name, value) VALUES('regblock', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES('regtime', '60');
INSERT INTO phpbb_ctrack (name, value) VALUES('autoban', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES('posttimespan', '200');
INSERT INTO phpbb_ctrack (name, value) VALUES('postintime', '10');
INSERT INTO phpbb_ctrack (name, value) VALUES('lastreg_ip', '');
INSERT INTO phpbb_ctrack (name, value) VALUES('mailfeature', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES('pwreset', '1');
INSERT INTO phpbb_ctrack (name, value) VALUES('loginfeature', '1');

INSERT INTO phpbb_ct_filter (id, list) VALUES('1', 'WebStripper');
INSERT INTO phpbb_ct_filter (id, list) VALUES('2', 'NetMechanic');
INSERT INTO phpbb_ct_filter (id, list) VALUES('3', 'CherryPicker');
INSERT INTO phpbb_ct_filter (id, list) VALUES('4', 'EmailCollector');
INSERT INTO phpbb_ct_filter (id, list) VALUES('5', 'EmailSiphon');
INSERT INTO phpbb_ct_filter (id, list) VALUES('6', 'WebBandit');
INSERT INTO phpbb_ct_filter (id, list) VALUES('7', 'EmailWolf');
INSERT INTO phpbb_ct_filter (id, list) VALUES('8', 'ExtractorPro');
INSERT INTO phpbb_ct_filter (id, list) VALUES('9', 'SiteSnagger');
INSERT INTO phpbb_ct_filter (id, list) VALUES('10', 'CheeseBot');
INSERT INTO phpbb_ct_filter (id, list) VALUES('12', 'Website Quester');
INSERT INTO phpbb_ct_filter (id, list) VALUES('13', 'WebZip');
INSERT INTO phpbb_ct_filter (id, list) VALUES('14', 'moget/2.1');
INSERT INTO phpbb_ct_filter (id, list) VALUES('15', 'WebSauger');
INSERT INTO phpbb_ct_filter (id, list) VALUES('16', 'WebCopier');
INSERT INTO phpbb_ct_filter (id, list) VALUES('17', 'WWW-Collector-E');
INSERT INTO phpbb_ct_filter (id, list) VALUES('18', 'InfoNaviRobot');
INSERT INTO phpbb_ct_filter (id, list) VALUES('19', 'Harvest/1.5');
INSERT INTO phpbb_ct_filter (id, list) VALUES('20', 'Bullseye/1.0');
INSERT INTO phpbb_ct_filter (id, list) VALUES('21', 'lwp-trivial/1.34');
INSERT INTO phpbb_ct_filter (id, list) VALUES('22', 'lwp-trivial');
INSERT INTO phpbb_ct_filter (id, list) VALUES('23', 'LinkWalker');
INSERT INTO phpbb_ct_filter (id, list) VALUES('24', 'LinkextractorPro');
INSERT INTO phpbb_ct_filter (id, list) VALUES('25', 'Offline Explorer');
INSERT INTO phpbb_ct_filter (id, list) VALUES('26', 'BlowFish/1.0');
INSERT INTO phpbb_ct_filter (id, list) VALUES('27', 'WebEnhancer');
INSERT INTO phpbb_ct_filter (id, list) VALUES('28', 'TightTwatBot');
INSERT INTO phpbb_ct_filter (id, list) VALUES('29', 'LinkScan/8.1a Unix');
INSERT INTO phpbb_ct_filter (id, list) VALUES('30', 'WebDownloader');
INSERT INTO phpbb_ct_filter (id, list) VALUES('31', 'lwp-trivial/1.33');
INSERT INTO phpbb_ct_filter (id, list) VALUES('32', 'lwp-trivial/1.38');
INSERT INTO phpbb_ct_filter (id, list) VALUES('33', 'BruteForce');
INSERT INTO phpbb_ct_filter (id, list) VALUES('34', 'lwp');

##-- modlist giriliyor

CREATE TABLE `phpbb_ctracker_filechk` (
`filepath` text,
`hash` varchar(32) default NULL
) TYPE=MyISAM;

CREATE TABLE `phpbb_ctracker_filescanner` (
`id` smallint(5) NOT NULL,
`filepath` text,
`safety` smallint(1) NOT NULL default '0',
PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE `phpbb_ctracker_ipblocker` (
`id` mediumint(8) unsigned NOT NULL,
`ct_blocker_value` varchar(250) default NULL,
PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=33 ;

CREATE TABLE `phpbb_ctracker_config` (
`ct_config_name` varchar(255) NOT NULL,
`ct_config_value` varchar(255) NOT NULL,
PRIMARY KEY  (`ct_config_name`)
) TYPE=MyISAM;

CREATE TABLE `phpbb_ctracker_loginhistory` (
`ct_user_id` int(10) default NULL,
`ct_login_ip` varchar(16) default NULL,
`ct_login_time` int(11) NOT NULL default '0'
) TYPE=MyISAM;

ALTER TABLE `phpbb_users` ADD `ct_search_time` INT( 11 ) NULL DEFAULT 1 AFTER `user_newpasswd`;
ALTER TABLE `phpbb_users` ADD `ct_search_count` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_search_time`;
ALTER TABLE `phpbb_users` ADD `ct_last_mail` INT( 11 ) NULL DEFAULT 1 AFTER `ct_search_count`;
ALTER TABLE `phpbb_users` ADD `ct_last_post` INT( 11 ) NULL DEFAULT 1 AFTER `ct_last_mail`;
ALTER TABLE `phpbb_users` ADD `ct_post_counter` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_last_post`;
ALTER TABLE `phpbb_users` ADD `ct_last_pw_reset` INT( 11 ) NULL DEFAULT 1 AFTER `ct_post_counter`;
ALTER TABLE `phpbb_users` ADD `ct_enable_ip_warn` TINYINT( 1 ) NULL DEFAULT 1 AFTER `ct_last_pw_reset`;
ALTER TABLE `phpbb_users` ADD `ct_last_used_ip` VARCHAR( 16 ) NULL DEFAULT '0.0.0.0' AFTER `ct_enable_ip_warn`;
ALTER TABLE `phpbb_users` ADD `ct_last_ip` VARCHAR( 16 ) NULL DEFAULT '0.0.0.0' AFTER `ct_last_used_ip`;
ALTER TABLE `phpbb_users` ADD `ct_login_count` MEDIUMINT( 8 ) NULL DEFAULT 1 AFTER `ct_last_used_ip`;
ALTER TABLE `phpbb_users` ADD `ct_login_vconfirm` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_login_count`;
ALTER TABLE `phpbb_users` ADD `ct_last_pw_change` INT( 11 ) NULL DEFAULT 1 AFTER `ct_login_vconfirm`;
ALTER TABLE `phpbb_users` ADD `ct_global_msg_read` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_last_pw_change`;
ALTER TABLE `phpbb_users` ADD `ct_miserable_user` TINYINT( 1 ) NULL DEFAULT 0 AFTER `ct_global_msg_read`;


INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('ipblock_enabled', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('ipblock_logsize', '100');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('auto_recovery', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('vconfirm_guest', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('autoban_mails', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('detect_misconfiguration', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_time_guest', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_time_user', '20');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_count_guest', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_count_user', '4');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('massmail_protection', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_protection', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_blocktime', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_lastip', '0.0.0.0');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pwreset_time', '20');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('massmail_time', '20');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_time', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_postcount', '4');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spammer_blockmode', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('loginfeature', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_reset_feature', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_last_reg', '1155944976');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_history', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_history_count', '10');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('login_ip_check', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_validity', '30');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex_min', '4');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex_mode', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_control', '0');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('pw_complex', '0');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('last_file_scan', '1156000091');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('last_checksum_scan', '1156000082');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logsize_logins', '100');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logsize_spammer', '100');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('reg_ip_scan', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('global_message', 'Hello world!');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('global_message_type', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('logincount', '2');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('search_feature_enabled', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spam_attack_boost', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('spam_keyword_det', '1');
INSERT INTO `phpbb_ctracker_config` (`ct_config_name`, `ct_config_value`) VALUES ('footer_layout', '3');


INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (1, '*WebStripper*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (2, '*NetMechanic*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (3, '*CherryPicker*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (4, '*EmailCollector*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (5, '*EmailSiphon*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (6, '*WebBandit*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (7, '*EmailWolf*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (8, '*ExtractorPro*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (9, '*SiteSnagger*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (10, '*CheeseBot*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (11, '*ia_archiver*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (12, '*Website Quester*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (13, '*WebZip*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (14, '*moget*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (15, '*WebSauger*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (16, '*WebCopier*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (17, '*WWW-Collector*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (18, '*InfoNaviRobot*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (19, '*Harvest*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (20, '*Bullseye*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (21, '*LinkWalker*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (22, '*LinkextractorPro*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (23, '*Proxy*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (24, '*BlowFish*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (25, '*WebEnhancer*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (26, '*TightTwatBot*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (27, '*LinkScan*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (28, '*WebDownloader*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (29, 'lwp');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (30, '*BruteForce*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (31, 'lwp-*');
INSERT INTO `phpbb_ctracker_ipblocker` (`id`, `ct_blocker_value`) VALUES (32, '*anonym*');

#--forum ikon---
ALTER TABLE `phpbb_forums` ADD `forum_keywords` TEXT NOT NULL;
INSERT INTO phpbb_config (config_name, config_value) VALUES ('site_keywords','site açýklamasý, 255 karakter, sýnýrý, vardýr.'); 

ALTER TABLE phpbb_search_results MODIFY COLUMN search_array MEDIUMTEXT NOT NULL;

#--ikon mod kontrolü
INSERT INTO phpbb_config (config_name, config_value) VALUES ('icon_mod_open', '1');

#---- basit seo kontrülo
INSERT INTO phpbb_config (config_name, config_value) VALUES ('basit_seo_open', '1');

#--- admin mesajlarýný bölüm yetkililerinin editlemesinden koru...
INSERT INTO phpbb_config (config_name, config_value) VALUES ('admin_message_save_from_mods', '1');

#--- yönetim kontrollü forum geniþliði
INSERT INTO phpbb_config (config_name, config_value) VALUES ('forum_width', '830');

#--- günün ziyaretçileri
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_user_online_today', '1');

#--- basit topic deðiþimi
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_page_on_top', '1');

#--- arama motorlarýný görüntüle
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_search_bots', '1');

#--- canlý istatistik
INSERT INTO phpbb_config (config_name, config_value) VALUES ('visit_counter', '1000');

#--- notify when message moving
ALTER TABLE phpbb_users DROP user_topic_moved_mail;
ALTER TABLE phpbb_users DROP user_topic_moved_pm;
ALTER TABLE phpbb_users DROP user_topic_moved_pm_notify;

#--- linkleri misafirlerden gizle, disable baþlýyor
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hide_links', '0');

INSERT INTO `phpbb_backup` VALUES (0, 1, 'youremail@domain.ext, yourotheremail@anotherdomain.ext', 1, 'ftp.server.com', 'ftp_username', 'ftp_password', '/backups', '1', '-1', '0    0    *    *    *', '120', 'full', 0, 0, 'phpbb_ignore_me, separate_tables_with_a_comma_and_space, ignored, ignore_me_too', 1143162120, 0);