#--rules men
DROP TABLE  phpbb_rules;
CREATE TABLE phpbb_rules (
date int(11) NOT NULL default '0',
rules text NOT NULL,
pm_subject varchar(255) NOT NULL default '',
pm_message text
) TYPE=MyISAM;

#--color group
DROP TABLE  phpbb_color_groups;
CREATE TABLE phpbb_color_groups(
	group_id mediumint(8) unsigned NOT NULL auto_increment,
	group_name varchar(255) NOT NULL,
	group_color varchar(50) NOT NULL,
	hidden tinyint(1) NOT NULL,
	order_num mediumint(9) NOT NULL, 
	PRIMARY KEY (group_id), 
	UNIQUE group_name (group_name)
);

#--edit notes
DROP TABLE  phpbb_edit_notes;
CREATE TABLE phpbb_edit_notes (
edit_note_id MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
topic_id MEDIUMINT(8) UNSIGNED NOT NULL,
post_id MEDIUMINT(8) UNSIGNED NOT NULL,
user_id MEDIUMINT(8) UNSIGNED NOT NULL,
note VARCHAR(255) NOT NULL,
ip varchar(8) NOT NULL,
edit_note_time INT(11) NOT NULL,
PRIMARY KEY (edit_note_id)
);

#--cback
DROP TABLE  phpbb_ct_filter;
CREATE TABLE phpbb_ct_filter (
id mediumint(8) unsigned NOT NULL auto_increment,
list varchar(250),
PRIMARY KEY (`id`)) TYPE=MyISAM;

DROP TABLE  phpbb_ct_viskey;
CREATE TABLE phpbb_ct_viskey (
confirm_id char(32) NOT NULL default '',
session_id char(32) NOT NULL default '',
code char(6) NOT NULL default '',
PRIMARY KEY  (session_id,confirm_id))
TYPE=MyISAM;

DROP TABLE  phpbb_ctrack;
CREATE TABLE phpbb_ctrack (
name varchar(50),
value varchar(100))
TYPE=MyISAM;



DROP TABLE  phpbb_hacks_list;
CREATE TABLE `phpbb_hacks_list`
(
`hack_id` mediumint(8) unsigned NOT NULL auto_increment,
`hack_name` varchar(255) NOT NULL default '',
`hack_desc` varchar(255) NOT NULL default '',
`hack_author` varchar(255) NOT NULL default '',
`hack_author_email` varchar(255) NOT NULL default '',
`hack_author_website` tinytext NOT NULL,
`hack_version` varchar(32) NOT NULL default '',
`hack_hide` enum('Yes','No') NOT NULL default 'No',
`hack_download_url` tinytext NOT NULL,
`hack_file` varchar(255) NOT NULL default '',
`hack_file_mtime` int(10) unsigned NOT NULL default '0',
PRIMARY KEY (`hack_id`),
UNIQUE KEY `hack_name` (`hack_name`),
KEY `hack_file` (`hack_file`),
KEY `hack_hide` (`hack_hide`) );

#-- arama tablosu yeniden oluþturuluyor
#-- yeni bir ddos korumasý getirildiði için
DROP TABLE  phpbb_search_results;
CREATE TABLE phpbb_search_results (
  search_id int(11) UNSIGNED NOT NULL default '0',
  session_id char(32) NOT NULL default '',
  search_time int(11) DEFAULT '0' NOT NULL,
  search_array text NOT NULL,
  PRIMARY KEY  (search_id),
  KEY session_id (session_id)
);

#--jr için db girdisi
DROP TABLE  phpbb_jr_admin_users;
CREATE TABLE `phpbb_jr_admin_users` (
  `user_id` mediumint(9) NOT NULL default '0',
  `user_jr_admin` longtext NOT NULL,
  `start_date` int(10) unsigned NOT NULL default '0',
  `update_date` int(10) unsigned NOT NULL default '0',
  `admin_notes` text NOT NULL,
  `notes_view` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) TYPE=MyISAM;

##-- acp menü için girdi
DROP TABLE phpbb_admin_nav_module;
CREATE TABLE phpbb_admin_nav_module (
  `user_id` mediumint(8) NOT NULL default '0',
  `modulname` varchar(200) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE phpbb_portal (
	portal_name varchar(255) NOT NULL,
	portal_value TEXT NOT NULL,
	PRIMARY KEY (portal_name)
);

CREATE TABLE `phpbb_backup` (
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
);
