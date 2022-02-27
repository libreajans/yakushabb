#
# phpBB Backup Script
# Dump of tables for yakusha_f4
#
# DATE :  01-April-2006 12:56:55 GMT
#
#
# TABLE: phpbb_auth_access 
#
DROP TABLE  phpbb_auth_access;
CREATE TABLE phpbb_auth_access(
	group_id mediumint(8) NOT NULL,
	forum_id smallint(5) unsigned NOT NULL,
	auth_view tinyint(1) NOT NULL,
	auth_read tinyint(1) NOT NULL,
	auth_post tinyint(1) NOT NULL,
	auth_reply tinyint(1) NOT NULL,
	auth_edit tinyint(1) NOT NULL,
	auth_delete tinyint(1) NOT NULL,
	auth_sticky tinyint(1) NOT NULL,
	auth_announce tinyint(1) NOT NULL,
	auth_vote tinyint(1) NOT NULL,
	auth_pollcreate tinyint(1) NOT NULL,
	auth_attachments tinyint(1) NOT NULL,
	auth_mod tinyint(1) NOT NULL, 
	KEY group_id (group_id), 
	KEY forum_id (forum_id)
);
#
# TABLE: phpbb_banlist 
#
DROP TABLE  phpbb_banlist;
CREATE TABLE phpbb_banlist(
	ban_id mediumint(8) unsigned NOT NULL auto_increment,
	ban_userid mediumint(8) NOT NULL,
	ban_ip varchar(8) NOT NULL,
	ban_email varchar(255),
	ban_time int(11),
	ban_expire_time int(11),
	ban_by_userid mediumint(8),
	ban_priv_reason text,
	ban_pub_reason_mode tinyint(1),
	ban_pub_reason text, 
	PRIMARY KEY (ban_id), 
	KEY ban_ip_user_id (ban_ip, ban_userid)
);
#
# TABLE: phpbb_categories 
#
DROP TABLE  phpbb_categories;
CREATE TABLE phpbb_categories(
	cat_id mediumint(8) unsigned NOT NULL auto_increment,
	cat_title varchar(100),
	cat_order mediumint(8) unsigned NOT NULL, 
	PRIMARY KEY (cat_id), 
	KEY cat_order (cat_order)
);
#
# TABLE: phpbb_color_groups 
#
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
#
# TABLE: phpbb_config 
#
DROP TABLE  phpbb_config;
CREATE TABLE phpbb_config(
	config_name varchar(255) NOT NULL,
	config_value varchar(255) NOT NULL, 
	PRIMARY KEY (config_name)
);
#
# TABLE: phpbb_confirm 
#
DROP TABLE  phpbb_confirm;
CREATE TABLE phpbb_confirm(
	confirm_id char(32) NOT NULL,
	session_id char(32) NOT NULL,
	code char(6) NOT NULL, 
	PRIMARY KEY (session_id, confirm_id)
);
#
# TABLE: phpbb_disallow 
#
DROP TABLE  phpbb_disallow;
CREATE TABLE phpbb_disallow(
	disallow_id mediumint(8) unsigned NOT NULL auto_increment,
	disallow_username varchar(25) NOT NULL, 
	PRIMARY KEY (disallow_id)
);
#
# TABLE: phpbb_edit_notes 
#
DROP TABLE  phpbb_edit_notes;
CREATE TABLE phpbb_edit_notes(
	edit_note_id mediumint(8) unsigned NOT NULL auto_increment,
	topic_id mediumint(8) unsigned NOT NULL,
	post_id mediumint(8) unsigned NOT NULL,
	user_id mediumint(8) unsigned NOT NULL,
	note varchar(255) NOT NULL,
	ip varchar(8) NOT NULL,
	edit_note_time int(11) NOT NULL, 
	PRIMARY KEY (edit_note_id)
);
#
# TABLE: phpbb_forum_prune 
#
DROP TABLE  phpbb_forum_prune;
CREATE TABLE phpbb_forum_prune(
	prune_id mediumint(8) unsigned NOT NULL auto_increment,
	forum_id smallint(5) unsigned NOT NULL,
	prune_days smallint(5) unsigned NOT NULL,
	prune_freq smallint(5) unsigned NOT NULL, 
	PRIMARY KEY (prune_id), 
	KEY forum_id (forum_id)
);
#
# TABLE: phpbb_forums 
#
DROP TABLE  phpbb_forums;
CREATE TABLE phpbb_forums(
	forum_id smallint(5) unsigned NOT NULL,
	cat_id mediumint(8) unsigned NOT NULL,
	forum_name varchar(150),
	forum_desc text,
	forum_status tinyint(4) NOT NULL,
	forum_order mediumint(8) unsigned DEFAULT '1' NOT NULL,
	forum_posts mediumint(8) unsigned NOT NULL,
	forum_topics mediumint(8) unsigned NOT NULL,
	forum_last_post_id mediumint(8) unsigned NOT NULL,
	prune_next int(11),
	prune_enable tinyint(1) NOT NULL,
	auth_view tinyint(2) NOT NULL,
	auth_read tinyint(2) NOT NULL,
	auth_post tinyint(2) NOT NULL,
	auth_reply tinyint(2) NOT NULL,
	auth_edit tinyint(2) NOT NULL,
	auth_delete tinyint(2) NOT NULL,
	auth_sticky tinyint(2) NOT NULL,
	auth_announce tinyint(2) NOT NULL,
	auth_vote tinyint(2) NOT NULL,
	auth_pollcreate tinyint(2) NOT NULL,
	auth_attachments tinyint(2) NOT NULL,
	forum_password varchar(20) NOT NULL,
	forum_parent int(11) NOT NULL, 
	PRIMARY KEY (forum_id), 
	KEY forums_order (forum_order), 
	KEY cat_id (cat_id), 
	KEY forum_last_post_id (forum_last_post_id)
);
#
# TABLE: phpbb_groups 
#
DROP TABLE  phpbb_groups;
CREATE TABLE phpbb_groups(
	group_id mediumint(8) NOT NULL auto_increment,
	group_type tinyint(4) DEFAULT '1' NOT NULL,
	group_name varchar(40) NOT NULL,
	group_description varchar(255) NOT NULL,
	group_moderator mediumint(8) NOT NULL,
	group_single_user tinyint(1) DEFAULT '1' NOT NULL,
	group_color_group mediumint(8) unsigned NOT NULL, 
	PRIMARY KEY (group_id), 
	KEY group_single_user (group_single_user)
);
#
# TABLE: phpbb_posts 
#
DROP TABLE  phpbb_posts;
CREATE TABLE phpbb_posts(
	post_id mediumint(8) unsigned NOT NULL auto_increment,
	topic_id mediumint(8) unsigned NOT NULL,
	forum_id smallint(5) unsigned NOT NULL,
	poster_id mediumint(8) NOT NULL,
	post_time int(11) NOT NULL,
	poster_ip varchar(8) NOT NULL,
	post_username varchar(25),
	enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
	enable_html tinyint(1) NOT NULL,
	enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
	enable_sig tinyint(1) DEFAULT '1' NOT NULL,
	post_edit_time int(11),
	post_edit_count smallint(5) unsigned NOT NULL, 
	PRIMARY KEY (post_id), 
	KEY forum_id (forum_id), 
	KEY topic_id (topic_id), 
	KEY poster_id (poster_id), 
	KEY post_time (post_time)
);
#
# TABLE: phpbb_posts_text 
#
DROP TABLE  phpbb_posts_text;
CREATE TABLE phpbb_posts_text(
	post_id mediumint(8) unsigned NOT NULL,
	bbcode_uid varchar(10) NOT NULL,
	post_subject varchar(60),
	post_text text, 
	PRIMARY KEY (post_id)
);
#
# TABLE: phpbb_privmsgs 
#
DROP TABLE  phpbb_privmsgs;
CREATE TABLE phpbb_privmsgs(
	privmsgs_id mediumint(8) unsigned NOT NULL auto_increment,
	privmsgs_type tinyint(4) NOT NULL,
	privmsgs_subject varchar(255) NOT NULL,
	privmsgs_from_userid mediumint(8) NOT NULL,
	privmsgs_to_userid mediumint(8) NOT NULL,
	privmsgs_date int(11) NOT NULL,
	privmsgs_ip varchar(8) NOT NULL,
	privmsgs_enable_bbcode tinyint(1) DEFAULT '1' NOT NULL,
	privmsgs_enable_html tinyint(1) NOT NULL,
	privmsgs_enable_smilies tinyint(1) DEFAULT '1' NOT NULL,
	privmsgs_attach_sig tinyint(1) DEFAULT '1' NOT NULL, 
	PRIMARY KEY (privmsgs_id), 
	KEY privmsgs_from_userid (privmsgs_from_userid), 
	KEY privmsgs_to_userid (privmsgs_to_userid)
);
#
# TABLE: phpbb_privmsgs_text 
#
DROP TABLE  phpbb_privmsgs_text;
CREATE TABLE phpbb_privmsgs_text(
	privmsgs_text_id mediumint(8) unsigned NOT NULL,
	privmsgs_bbcode_uid varchar(10) NOT NULL,
	privmsgs_text text, 
	PRIMARY KEY (privmsgs_text_id)
);
#
# TABLE: phpbb_ranks 
#
DROP TABLE  phpbb_ranks;
CREATE TABLE phpbb_ranks(
	rank_id smallint(5) unsigned NOT NULL auto_increment,
	rank_title varchar(50) NOT NULL,
	rank_min mediumint(8) NOT NULL,
	rank_special tinyint(1),
	rank_image varchar(255), 
	PRIMARY KEY (rank_id)
);
#
# TABLE: phpbb_rules 
#
DROP TABLE  phpbb_rules;
CREATE TABLE phpbb_rules(
	date int(11) NOT NULL,
	rules text NOT NULL,
	pm_subject varchar(255) NOT NULL,
	pm_message text
);
#
# TABLE: phpbb_search_results 
#
DROP TABLE  phpbb_search_results;
CREATE TABLE phpbb_search_results (
  search_id int(11) UNSIGNED NOT NULL default '0',
  session_id char(32) NOT NULL default '',
  search_time int(11) DEFAULT '0' NOT NULL,
  search_array text NOT NULL,
  PRIMARY KEY  (search_id),
  KEY session_id (session_id)
);

#
# TABLE: phpbb_search_wordlist 
#
DROP TABLE  phpbb_search_wordlist;
CREATE TABLE phpbb_search_wordlist(
	word_text varchar(50) binary NOT NULL,
	word_id mediumint(8) unsigned NOT NULL auto_increment,
	word_common tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (word_text), 
	KEY word_id (word_id)
);
#
# TABLE: phpbb_search_wordmatch 
#
DROP TABLE  phpbb_search_wordmatch;
CREATE TABLE phpbb_search_wordmatch(
	post_id mediumint(8) unsigned NOT NULL,
	word_id mediumint(8) unsigned NOT NULL,
	title_match tinyint(1) NOT NULL, 
	KEY post_id (post_id), 
	KEY word_id (word_id)
);
#
# TABLE: phpbb_sessions 
#
DROP TABLE  phpbb_sessions;
CREATE TABLE phpbb_sessions(
	session_id char(32) NOT NULL,
	session_user_id mediumint(8) NOT NULL,
	session_start int(11) NOT NULL,
	session_time int(11) NOT NULL,
	session_ip char(8) NOT NULL,
	session_page int(11) NOT NULL,
	session_logged_in tinyint(1) NOT NULL,
	session_admin tinyint(2) NOT NULL, 
	PRIMARY KEY (session_id), 
	KEY session_user_id (session_user_id), 
	KEY session_id_ip_user_id (session_id, session_ip, session_user_id)
);
#
# TABLE: phpbb_sessions_keys 
#
DROP TABLE  phpbb_sessions_keys;
CREATE TABLE phpbb_sessions_keys(
	key_id varchar(32) NOT NULL,
	user_id mediumint(8) NOT NULL,
	last_ip varchar(8) NOT NULL,
	last_login int(11) NOT NULL, 
	PRIMARY KEY (key_id, user_id), 
	KEY last_login (last_login)
);
#
# TABLE: phpbb_smilies 
#
DROP TABLE  phpbb_smilies;
CREATE TABLE phpbb_smilies(
	smilies_id smallint(5) unsigned NOT NULL auto_increment,
	code varchar(50),
	smile_url varchar(100),
	emoticon varchar(75), 
	PRIMARY KEY (smilies_id)
);
#
# TABLE: phpbb_themes 
#
DROP TABLE  phpbb_themes;
CREATE TABLE phpbb_themes(
	themes_id mediumint(8) unsigned NOT NULL auto_increment,
	template_name varchar(30) NOT NULL,
	style_name varchar(30) NOT NULL,
	head_stylesheet varchar(100),
	body_background varchar(100),
	body_bgcolor varchar(6),
	body_text varchar(6),
	body_link varchar(6),
	body_vlink varchar(6),
	body_alink varchar(6),
	body_hlink varchar(6),
	tr_color1 varchar(6),
	tr_color2 varchar(6),
	tr_color3 varchar(6),
	tr_class1 varchar(25),
	tr_class2 varchar(25),
	tr_class3 varchar(25),
	th_color1 varchar(6),
	th_color2 varchar(6),
	th_color3 varchar(6),
	th_class1 varchar(25),
	th_class2 varchar(25),
	th_class3 varchar(25),
	td_color1 varchar(6),
	td_color2 varchar(6),
	td_color3 varchar(6),
	td_class1 varchar(25),
	td_class2 varchar(25),
	td_class3 varchar(25),
	fontface1 varchar(50),
	fontface2 varchar(50),
	fontface3 varchar(50),
	fontsize1 tinyint(4),
	fontsize2 tinyint(4),
	fontsize3 tinyint(4),
	fontcolor1 varchar(6),
	fontcolor2 varchar(6),
	fontcolor3 varchar(6),
	span_class1 varchar(25),
	span_class2 varchar(25),
	span_class3 varchar(25),
	img_size_poll smallint(5) unsigned,
	img_size_privmsg smallint(5) unsigned, 
	PRIMARY KEY (themes_id)
);
#
# TABLE: phpbb_themes_name 
#
DROP TABLE  phpbb_themes_name;
CREATE TABLE phpbb_themes_name(
	themes_id smallint(5) unsigned NOT NULL,
	tr_color1_name char(50),
	tr_color2_name char(50),
	tr_color3_name char(50),
	tr_class1_name char(50),
	tr_class2_name char(50),
	tr_class3_name char(50),
	th_color1_name char(50),
	th_color2_name char(50),
	th_color3_name char(50),
	th_class1_name char(50),
	th_class2_name char(50),
	th_class3_name char(50),
	td_color1_name char(50),
	td_color2_name char(50),
	td_color3_name char(50),
	td_class1_name char(50),
	td_class2_name char(50),
	td_class3_name char(50),
	fontface1_name char(50),
	fontface2_name char(50),
	fontface3_name char(50),
	fontsize1_name char(50),
	fontsize2_name char(50),
	fontsize3_name char(50),
	fontcolor1_name char(50),
	fontcolor2_name char(50),
	fontcolor3_name char(50),
	span_class1_name char(50),
	span_class2_name char(50),
	span_class3_name char(50), 
	PRIMARY KEY (themes_id)
);
#
# TABLE: phpbb_topics 
#
DROP TABLE  phpbb_topics;
CREATE TABLE phpbb_topics(
	topic_id mediumint(8) unsigned NOT NULL auto_increment,
	forum_id smallint(8) unsigned NOT NULL,
	topic_title char(60) NOT NULL,
	topic_poster mediumint(8) NOT NULL,
	topic_time int(11) NOT NULL,
	topic_views mediumint(8) unsigned NOT NULL,
	topic_replies mediumint(8) unsigned NOT NULL,
	topic_status tinyint(3) NOT NULL,
	topic_vote tinyint(1) NOT NULL,
	topic_type tinyint(3) NOT NULL,
	topic_first_post_id mediumint(8) unsigned NOT NULL,
	topic_last_post_id mediumint(8) unsigned NOT NULL,
	topic_moved_id mediumint(8) unsigned NOT NULL, 
	PRIMARY KEY (topic_id), 
	KEY forum_id (forum_id), 
	KEY topic_moved_id (topic_moved_id), 
	KEY topic_status (topic_status), 
	KEY topic_type (topic_type)
);
#
# TABLE: phpbb_topics_watch 
#
DROP TABLE  phpbb_topics_watch;
CREATE TABLE phpbb_topics_watch(
	topic_id mediumint(8) unsigned NOT NULL,
	user_id mediumint(8) NOT NULL,
	notify_status tinyint(1) NOT NULL, 
	KEY topic_id (topic_id), 
	KEY user_id (user_id), 
	KEY notify_status (notify_status)
);
#
# TABLE: phpbb_user_group 
#
DROP TABLE  phpbb_user_group;
CREATE TABLE phpbb_user_group(
	group_id mediumint(8) NOT NULL,
	user_id mediumint(8) NOT NULL,
	user_pending tinyint(1), 
	KEY group_id (group_id), 
	KEY user_id (user_id)
);
#
# TABLE: phpbb_users 
#
DROP TABLE  phpbb_users;
CREATE TABLE phpbb_users(
	user_id mediumint(8) NOT NULL,
	user_active tinyint(1) DEFAULT '1',
	username varchar(25) NOT NULL,
	user_password varchar(32) NOT NULL,
	user_session_time int(11) NOT NULL,
	user_session_page smallint(5) NOT NULL,
	user_lastvisit int(11) NOT NULL,
	user_regdate int(11) NOT NULL,
	user_level tinyint(4),
	user_posts mediumint(8) unsigned NOT NULL,
	user_timezone decimal(5,2) DEFAULT '0.00' NOT NULL,
	user_style tinyint(4),
	user_lang varchar(255),
	user_dateformat varchar(14) DEFAULT 'd M Y H:i' NOT NULL,
	user_new_privmsg smallint(5) unsigned NOT NULL,
	user_unread_privmsg smallint(5) unsigned NOT NULL,
	user_last_privmsg int(11) NOT NULL,
	user_login_tries smallint(5) unsigned NOT NULL,
	user_last_login_try int(11) NOT NULL,
	user_emailtime int(11),
	user_viewemail tinyint(1),
	user_attachsig tinyint(1),
	user_allowhtml tinyint(1) DEFAULT '1',
	user_allowbbcode tinyint(1) DEFAULT '1',
	user_allowsmile tinyint(1) DEFAULT '1',
	user_allowavatar tinyint(1) DEFAULT '1' NOT NULL,
	user_allow_pm tinyint(1) DEFAULT '1' NOT NULL,
	user_allow_viewonline tinyint(1) DEFAULT '1' NOT NULL,
	user_notify tinyint(1) DEFAULT '1' NOT NULL,
	user_notify_pm tinyint(1) NOT NULL,
	user_popup_pm tinyint(1) NOT NULL,
	user_rank int(11),
	user_avatar varchar(100),
	user_avatar_type tinyint(4) NOT NULL,
	user_email varchar(255),
	user_icq varchar(15),
	user_website varchar(100),
	user_sig text,
	user_sig_bbcode_uid varchar(10),
	user_aim varchar(255),
	user_yim varchar(255),
	user_msnm varchar(255),
	user_occ varchar(100),
	user_interests varchar(255),
	user_from varchar(255),
	user_actkey varchar(32),
	user_newpasswd varchar(32),
	ct_logintry int(2),
	ct_unsucclogin int(10),
	ct_pwreset int(2) NOT NULL,
	ct_mailcount int(10) NOT NULL,
	ct_postcount int(10) NOT NULL,
	ct_posttime int(10) NOT NULL,
	ct_searchcount int(10) NOT NULL,
	ct_searchtime int(10) NOT NULL,
	user_rules int(11),
	user_quickreply tinyint(1) DEFAULT '1' NOT NULL,
	user_avatar_width smallint(6),
	user_avatar_height smallint(6),
	user_color_group mediumint(8) unsigned NOT NULL,
	user_can_post tinyint(1) DEFAULT '1',
	user_split_announce tinyint(1) NOT NULL,
	user_split_sticky tinyint(1) NOT NULL,
	user_split_topic_split tinyint(1) NOT NULL, 
	PRIMARY KEY (user_id), 
	KEY user_session_time (user_session_time)
);
#
# TABLE: phpbb_vote_desc 
#
DROP TABLE  phpbb_vote_desc;
CREATE TABLE phpbb_vote_desc(
	vote_id mediumint(8) unsigned NOT NULL auto_increment,
	topic_id mediumint(8) unsigned NOT NULL,
	vote_text text NOT NULL,
	vote_start int(11) NOT NULL,
	vote_length int(11) NOT NULL, 
	PRIMARY KEY (vote_id), 
	KEY topic_id (topic_id)
);
#
# TABLE: phpbb_vote_results 
#
DROP TABLE  phpbb_vote_results;
CREATE TABLE phpbb_vote_results(
	vote_id mediumint(8) unsigned NOT NULL,
	vote_option_id tinyint(4) unsigned NOT NULL,
	vote_option_text varchar(255) NOT NULL,
	vote_result int(11) NOT NULL, 
	KEY vote_option_id (vote_option_id), 
	KEY vote_id (vote_id)
);
#
# TABLE: phpbb_vote_voters 
#
DROP TABLE  phpbb_vote_voters;
CREATE TABLE phpbb_vote_voters(
	vote_id mediumint(8) unsigned NOT NULL,
	vote_user_id mediumint(8) NOT NULL,
	vote_user_ip char(8) NOT NULL,
	vote_cast tinyint(4) unsigned NOT NULL, 
	KEY vote_id (vote_id), 
	KEY vote_user_id (vote_user_id), 
	KEY vote_user_ip (vote_user_ip)
);
#
# TABLE: phpbb_words 
#
DROP TABLE phpbb_words;
CREATE TABLE phpbb_words(
	word_id mediumint(8) unsigned NOT NULL auto_increment,
	word char(100) NOT NULL,
	replacement char(100) NOT NULL, 
	PRIMARY KEY (word_id)
);

#--modlar için tablo
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

##--jr admin için db girdisi
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

##-- ctracker5 için girdi

DROP TABLE phpbb_ctracker_filechk;
CREATE TABLE `phpbb_ctracker_filechk` (
`filepath` text,
`hash` varchar(32) default NULL
) TYPE=MyISAM;

DROP TABLE phpbb_ctracker_filescanner;
CREATE TABLE `phpbb_ctracker_filescanner` (
  `id` smallint(5) NOT NULL,
  `filepath` text,
  `safety` smallint(1) NOT NULL default '0',
PRIMARY KEY  (`id`)
) TYPE=MyISAM;

DROP TABLE phpbb_ctracker_ipblocker;
CREATE TABLE `phpbb_ctracker_ipblocker` (
  `id` mediumint(8) unsigned NOT NULL,
  `ct_blocker_value` varchar(250) default NULL,
PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=33 ;

DROP TABLE phpbb_ctracker_config;
CREATE TABLE `phpbb_ctracker_config` (
  `ct_config_name` varchar(255) NOT NULL,
  `ct_config_value` varchar(255) NOT NULL,
PRIMARY KEY  (`ct_config_name`)
) TYPE=MyISAM;

DROP TABLE phpbb_ctracker_loginhistory;
CREATE TABLE `phpbb_ctracker_loginhistory` (
  `ct_user_id` int(10) default NULL,
  `ct_login_ip` varchar(16) default NULL,
  `ct_login_time` int(11) NOT NULL default '0'
) TYPE=MyISAM;

DROP TABLE phpbb_attachments_config;
CREATE TABLE phpbb_attachments_config (
  config_name varchar(255) NOT NULL,
  config_value varchar(255) NOT NULL,
  PRIMARY KEY (config_name)
);

DROP TABLE phpbb_forbidden_extensions;
CREATE TABLE phpbb_forbidden_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  extension varchar(100) NOT NULL,
  PRIMARY KEY (ext_id)
);

DROP TABLE phpbb_extension_groups;
CREATE TABLE phpbb_extension_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name char(20) NOT NULL,
  cat_id tinyint(2) DEFAULT '0' NOT NULL,
  allow_group tinyint(1) DEFAULT '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED DEFAULT '1' NOT NULL,
  upload_icon varchar(100) DEFAULT '',
  max_filesize int(20) DEFAULT '0' NOT NULL,
  forum_permissions varchar(255) default '' NOT NULL,
  PRIMARY KEY group_id (group_id)
);

DROP TABLE phpbb_extensions;
CREATE TABLE phpbb_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  extension varchar(100) NOT NULL,
  comment varchar(100),
  PRIMARY KEY ext_id (ext_id)
);

DROP TABLE phpbb_attachments_desc;
CREATE TABLE phpbb_attachments_desc (
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
);

##-- attach mod ekleniyor
DROP TABLE phpbb_attachments;
CREATE TABLE phpbb_attachments (
  attach_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  privmsgs_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  user_id_1 mediumint(8) NOT NULL,
  user_id_2 mediumint(8) NOT NULL,
  KEY attach_id_post_id (attach_id, post_id),
  KEY attach_id_privmsgs_id (attach_id, privmsgs_id),
  KEY post_id (post_id),
  KEY privmsgs_id (privmsgs_id)
);

DROP TABLE phpbb_quota_limits;
CREATE TABLE phpbb_quota_limits (
  quota_limit_id mediumint(8) unsigned NOT NULL auto_increment,
  quota_desc varchar(20) NOT NULL default '',
  quota_limit bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (quota_limit_id)
);

DROP TABLE phpbb_attach_quota;
CREATE TABLE phpbb_attach_quota (
  user_id mediumint(8) unsigned NOT NULL default '0',
  group_id mediumint(8) unsigned NOT NULL default '0',
  quota_type smallint(2) NOT NULL default '0',
  quota_limit_id mediumint(8) unsigned NOT NULL default '0',
  KEY quota_type (quota_type)
);

##-- arama tablosu onarma

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
  PRIMARY KEY  (`rebuild_session_id`),
  KEY `end_post_id` (`end_post_id`)
);

#-- favorites

CREATE TABLE `phpbb_favorites` (
`fav_id` int(11) NOT NULL auto_increment,
`user_id` int(11) NOT NULL default '0',
`topic_id` int(11) NOT NULL default '0',
PRIMARY KEY (`fav_id`));

#-- satýr içi reklam
CREATE TABLE phpbb_inline_ads (
ad_id TINYINT( 5 ) NOT NULL auto_increment,
ad_code TEXT NOT NULL ,
ad_name CHAR( 25 ) NOT NULL,
PRIMARY KEY (ad_id)
);

#-- report post

CREATE TABLE phpbb_report_cat (
  cat_id mediumint(8) NOT NULL auto_increment,
  cat_name varchar(100) NOT NULL default '',
  cat_type tinyint(1) NOT NULL default '0',
  cat_auth tinyint(1) NOT NULL default '0',
  cat_explain text NOT NULL,
  PRIMARY KEY (cat_id)
);

CREATE TABLE phpbb_report (
  report_id mediumint(8) NOT NULL auto_increment,
  cat_id mediumint(8) NOT NULL,
  report_status tinyint(1) NOT NULL default '0',
  report_date int(11) NOT NULL default '0',
  report_user_id mediumint(8) NOT NULL default '0',
  report_info varchar(100) NOT NULL default '',
  report_text text NOT NULL,
  PRIMARY KEY (report_id),
  KEY cat_id (cat_id)
);

#-- captha
CREATE TABLE `phpbb_captcha_config` (
  `config_name` varchar(255) NOT NULL default '',
  `config_value` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`config_name`)
);

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