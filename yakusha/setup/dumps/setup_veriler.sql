#
# phpBB Backup Script
# Dump of tables for yakusha_f4
#
# DATE :  01-April-2006 12:57:19 GMT
#

INSERT INTO phpbb_config (config_name, config_value) VALUES('version', '.0.22');
INSERT INTO phpbb_config (config_name, config_value) VALUES('yakusha_ver', '');

#-- 2020 -> 2021
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_min_chars', '3');

# -- phpbb_categories
INSERT INTO phpbb_categories (cat_id, cat_title, cat_order) VALUES('1', 'Test Kategorisi', '10');

#-- phpbb_config
INSERT INTO phpbb_config (config_name, config_value) VALUES('config_id', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('board_disable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('sitename', 'Yakusha');
INSERT INTO phpbb_config (config_name, config_value) VALUES('site_desc', 'Türk iþi phpBB');
INSERT INTO phpbb_config (config_name, config_value) VALUES('cookie_name', '7y74pycw2mysql');
INSERT INTO phpbb_config (config_name, config_value) VALUES('cookie_path', '/');
INSERT INTO phpbb_config (config_name, config_value) VALUES('cookie_domain', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('cookie_secure', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('session_length', '3600');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_html', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_html_tags', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_bbcode', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_smilies', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_sig', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_namechange', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_theme_create', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_avatar_local', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_avatar_remote', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_avatar_upload', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('enable_confirm', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_autologin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_autologin_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES('override_user_style', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('posts_per_page', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES('topics_per_page', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES('hot_threshold', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_poll_options', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_sig_chars', '255');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_inbox_privmsgs', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_sentbox_privmsgs', '25');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_savebox_privmsgs', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES('board_email_sig', 'Ýlginiz için teþekkürler');
INSERT INTO phpbb_config (config_name, config_value) VALUES('board_email', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('smtp_delivery', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('smtp_host', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('smtp_username', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('smtp_password', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('sendmail_fix', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('require_activation', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES('flood_interval', '60');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_login_attempts', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES('login_reset_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES('board_email_form', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('avatar_filesize', '9876543');
INSERT INTO phpbb_config (config_name, config_value) VALUES('avatar_max_width', '97');
INSERT INTO phpbb_config (config_name, config_value) VALUES('avatar_max_height', '97');
INSERT INTO phpbb_config (config_name, config_value) VALUES('avatar_path', 'images/avatars');
INSERT INTO phpbb_config (config_name, config_value) VALUES('avatar_gallery_path', 'images/avatars/gallery');
INSERT INTO phpbb_config (config_name, config_value) VALUES('smilies_path', 'images/smiles');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_style', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_dateformat', 'd F Y H:i');
INSERT INTO phpbb_config (config_name, config_value) VALUES('board_timezone', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES('prune_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('privmsg_disable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('gzip_compress', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('coppa_fax', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('coppa_mail', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('record_online_users', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('record_online_date', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('server_name', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('server_port', '80');
INSERT INTO phpbb_config (config_name, config_value) VALUES('script_path', '/');
INSERT INTO phpbb_config (config_name, config_value) VALUES('board_startdate', '1143896053');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_lang', 'turkish');
INSERT INTO phpbb_config (config_name, config_value) VALUES('allow_quickreply', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('registration_status', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('registration_closed', '<br><br>Forumumuz þimdilik yeni üye kaydýna kapalýdýr. Lütfen daha sonra tekrar deneyiniz.');
INSERT INTO phpbb_config (config_name, config_value) VALUES('board_disable_msg', '<br><br>Forumumuz þimdilik kapalýdýr. Lütfen daha sonra tekrar deneyiniz.');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_sessions', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_sessions_ip', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES('topic_flood_interval', '60');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_avatar_guests_url', 'images/avatars/gallery/yakusha/beta_01.png');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_avatar_users_url', 'images/avatars/gallery/yakusha/beta_03.png');
INSERT INTO phpbb_config (config_name, config_value) VALUES('default_avatar_set', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuild_end', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuild_pos', '-1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuildcfg_maxmemory', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuildcfg_minposts', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuildcfg_php3only', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuildcfg_php3pps', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuildcfg_php4pps', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuildcfg_timelimit', '240');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_rebuildcfg_timeoverwrite', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_disallow_postcounter', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('dbmtnc_disallow_rebuild', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('live_email_validation', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('sig_images_max_width', '500');
INSERT INTO phpbb_config (config_name, config_value) VALUES('sig_images_max_height', '300');
INSERT INTO phpbb_config (config_name, config_value) VALUES('sig_images_max_limit', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_days', '150');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_days_inactive', '150');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_inactive', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_non_visit', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_total', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_minutes', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES('last_auto_delete_users_attempt', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_days_no_post', '150');
INSERT INTO phpbb_config (config_name, config_value) VALUES('admin_auto_delete_no_post', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('edit_notes_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('max_edit_notes', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES('edit_notes_permissions', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_global_announce', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_global_announce_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_announce', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_announce_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_sticky', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_sticky_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_topic_split', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('split_topic_split_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_auto_compile', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_auto_recompile', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_use_cache', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_php', 'php');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_def_template', 'subSilver');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_check_switches', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_warn_includes', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_add_comments', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_ftp_host', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_ftp_login', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_ftp_path', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_downloads_count', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_downloads_default', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_shownav', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_template_time', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES('xs_version', '8');

#-- phpbb_forums
INSERT INTO `phpbb_forums` VALUES (1, 1, 'Test Forumu', 'Test Forumudur', 0, 10, 1, 1, 1, NULL, 0, 0, 0, 1, 1, 1, 1, 3, 3, 1, 1, 3, '', 0, 0, NULL);
INSERT INTO `phpbb_forums` VALUES (2, 1, 'Çöp Kutusu', 'Çöp içerikli yazýlarýn toplanma alanýdýr.', 0, 20, 0, 0, 0, NULL, 0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 0, '', 0, 0, NULL);
INSERT INTO `phpbb_forums` VALUES (3, 1, 'Haberler', 'Site Haberleri', 0, 30, 0, 0, 0, NULL, 0, 0, 0, 1, 1, 1, 1, 3, 3, 1, 1, 3, '', 0, 0, NULL);

#-- phpbb_groups
INSERT INTO phpbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user, group_color_group) VALUES('1', '1', 'Anonymous', 'Personal User', '0', '1', '0');
INSERT INTO phpbb_groups (group_id, group_type, group_name, group_description, group_moderator, group_single_user, group_color_group) VALUES('2', '1', 'Admin', 'Personal User', '0', '1', '0');

#-- phpbb_posts
INSERT INTO phpbb_posts (post_id, topic_id, forum_id, poster_id, post_time, poster_ip, post_username, enable_bbcode, enable_html, enable_smilies, enable_sig, post_edit_time, post_edit_count) VALUES('1', '1', '1', '2', '1143896051', '7F000001', '', '1', '0', '1', '0', NULL, '0');

#-- phpbb_posts_text
INSERT INTO phpbb_posts_text (post_id, bbcode_uid, post_subject, post_text) VALUES('1', '627f7f7da8', 'Hoþgeldiniz', 'Forum kurulum iþlemi baþarýyla tamamlanmýþtýr... Yönetim panelini ziyaret ederek forum ayarlarýnýzý tamamlamayý ihmal etmeyin...  Bizden tavsiye, Kafanýzý duvarlara vurmak istemiyorsanýz ayarlarýnýzý doðru yapýlandýrýnýz. www.phpbb.com & www.canver.net  siteleri vasýtasýyla phpBB güncellemelerini ve www.yakusha.net vasýtasýyla yakusha premod güncellemelerini takip etmeyi ihmal etmeyiniz...  kolay gelsin  8)');

#-- phpbb_privmsgs
#-- phpbb_privmsgs_text

#-- phpbb_rules
INSERT INTO phpbb_rules (date, rules, pm_subject, pm_message) VALUES('1139767682', '<span style=\"font-weight: bold\">FORUM KURALLARI</span> <span class=\"gensmed\"><br /><br />Test amaçlýdýr, kendi forum kurallarýnýz doðrultusunda deðiþtiriniz... ', 'Forum Kurallarý', 'Forum kurallarýnda deðiþikliðe gidilmiþtir. Forum kurallarýný okumayý ihmal etmeyiniz. Forum Yöneticisi');

#-- phpbb_search_wordlist
#-- phpbb_search_wordmatch
#-- phpbb_sessions

#-- phpbb_smilies
INSERT INTO `phpbb_smilies` VALUES (1, ':happy:', 'icon_happy.gif', 'happy');
INSERT INTO `phpbb_smilies` VALUES (2, ':)', 'icon_smile.gif', 'gülümseme');
INSERT INTO `phpbb_smilies` VALUES (3, ':-)', 'icon_smile.gif', 'gülümseme');
INSERT INTO `phpbb_smilies` VALUES (4, ':smile:', 'icon_smile.gif', 'gülümseme');
INSERT INTO `phpbb_smilies` VALUES (5, ':D', 'icon_biggrin.gif', 'çok mutlu');
INSERT INTO `phpbb_smilies` VALUES (6, ':-D', 'icon_biggrin.gif', 'çok mutlu');
INSERT INTO `phpbb_smilies` VALUES (7, ':grin:', 'icon_biggrin.gif', 'çok mutlu');
INSERT INTO `phpbb_smilies` VALUES (8, ':sleep:', 'icon_sleep.gif', 'uyku');
INSERT INTO `phpbb_smilies` VALUES (9, ':scared:', 'icon_scared.gif', 'scared');
INSERT INTO `phpbb_smilies` VALUES (10, ':(', 'icon_sad.gif', 'üzgün');
INSERT INTO `phpbb_smilies` VALUES (11, ':-(', 'icon_sad.gif', 'üzgün');
INSERT INTO `phpbb_smilies` VALUES (12, ':sad:', 'icon_sad.gif', 'üzgün');
INSERT INTO `phpbb_smilies` VALUES (13, ':x', 'icon_mad.gif', 'kýzgýn');
INSERT INTO `phpbb_smilies` VALUES (14, ':-x', 'icon_mad.gif', 'kýzgýn');
INSERT INTO `phpbb_smilies` VALUES (15, ':mad:', 'icon_mad.gif', 'kýzgýn');
INSERT INTO `phpbb_smilies` VALUES (16, ':o', 'icon_surprised.gif', 'süpriz');
INSERT INTO `phpbb_smilies` VALUES (17, ':-o', 'icon_surprised.gif', 'süpriz');
INSERT INTO `phpbb_smilies` VALUES (18, ':eek:', 'icon_surprised.gif', 'süpriz');
INSERT INTO `phpbb_smilies` VALUES (19, ':shock:', 'icon_eek.gif', 'þok olmuþ');
INSERT INTO `phpbb_smilies` VALUES (20, ':?', 'icon_confused.gif', 'þaþkýn');
INSERT INTO `phpbb_smilies` VALUES (21, ':-?', 'icon_confused.gif', 'þaþkýn');
INSERT INTO `phpbb_smilies` VALUES (22, ':???:', 'icon_confused.gif', 'þaþkýn');
INSERT INTO `phpbb_smilies` VALUES (23, '8)', 'icon_cool.gif', 'Cool');
INSERT INTO `phpbb_smilies` VALUES (24, '8-)', 'icon_cool.gif', 'Cool');
INSERT INTO `phpbb_smilies` VALUES (25, ':cool:', 'icon_cool.gif', 'Cool');
INSERT INTO `phpbb_smilies` VALUES (26, ':lol:', 'icon_lol.gif', 'çýlgýn');
INSERT INTO `phpbb_smilies` VALUES (27, ':oops:', 'icon_redface.gif', 'yüz kýzarmasý');
INSERT INTO `phpbb_smilies` VALUES (28, ':cry:', 'icon_cry.gif', 'aðlýyor');
INSERT INTO `phpbb_smilies` VALUES (29, ':evil:', 'icon_evil.gif', 'evil');
INSERT INTO `phpbb_smilies` VALUES (30, ':twisted:', 'icon_twisted.gif', 'twisted');
INSERT INTO `phpbb_smilies` VALUES (31, ':-1:', 'icon_-1.gif', '-1');
INSERT INTO `phpbb_smilies` VALUES (32, ':+1:', 'icon_+1.gif', '+1');
INSERT INTO `phpbb_smilies` VALUES (33, ':roll:', 'icon_rolleyes.gif', 'dönen gözler');
INSERT INTO `phpbb_smilies` VALUES (34, ':wink:', 'icon_wink.gif', 'göz kýrpma');
INSERT INTO `phpbb_smilies` VALUES (35, ';)', 'icon_wink.gif', 'göz kýrpma');
INSERT INTO `phpbb_smilies` VALUES (36, ';-)', 'icon_wink.gif', 'göz kýrpma');
INSERT INTO `phpbb_smilies` VALUES (37, ':|', 'icon_neutral.gif', 'doðal');
INSERT INTO `phpbb_smilies` VALUES (38, ':-|', 'icon_neutral.gif', 'doðal');
INSERT INTO `phpbb_smilies` VALUES (39, ':dogal:', 'icon_neutral.gif', 'doðal');
INSERT INTO `phpbb_smilies` VALUES (40, ':yesil:', 'icon_mrgreen.gif', 'bay yeþil');
INSERT INTO `phpbb_smilies` VALUES (41, ':!:', 'icon_exclaim.gif', 'ünlem');
INSERT INTO `phpbb_smilies` VALUES (42, ':?:', 'icon_question.gif', 'soru');
INSERT INTO `phpbb_smilies` VALUES (43, ':idea:', 'icon_idea.gif', 'düþünce');
INSERT INTO `phpbb_smilies` VALUES (44, ':arrow:', 'icon_arrow.gif', 'ok iþareti');
INSERT INTO `phpbb_smilies` VALUES (45, ':arrow:', 'arrow.gif', 'arrow');
INSERT INTO `phpbb_smilies` VALUES (46, ':arrowed:', 'arrowed.gif', 'arrowed');
INSERT INTO `phpbb_smilies` VALUES (47, ':phpbb:', 'bb.gif', 'phpBB');
INSERT INTO `phpbb_smilies` VALUES (48, ':bulletblue:', 'bulletblue.gif', 'bulletblue');
INSERT INTO `phpbb_smilies` VALUES (49, ':file:', 'file.gif', 'file');
INSERT INTO `phpbb_smilies` VALUES (50, ':folder:', 'folder.gif', 'folder');
INSERT INTO `phpbb_smilies` VALUES (51, ':medal:', 'gold.gif', 'medal');
INSERT INTO `phpbb_smilies` VALUES (52, ':ipucu:', 'ipucu.gif', 'ipucu');
INSERT INTO `phpbb_smilies` VALUES (53, ':li:', 'li.gif', 'madde imi');
INSERT INTO `phpbb_smilies` VALUES (54, ':link:', 'link.gif', 'link');
INSERT INTO `phpbb_smilies` VALUES (55, ':lock:', 'lock.gif', 'kilitli');
INSERT INTO `phpbb_smilies` VALUES (56, ':login:', 'login.gif', 'login');
INSERT INTO `phpbb_smilies` VALUES (57, ':nav:', 'nav.gif', 'nav');
INSERT INTO `phpbb_smilies` VALUES (58, ':nm:', 'nm.gif', 'yeni mesajlar');
INSERT INTO `phpbb_smilies` VALUES (59, ':online:', 'online.gif', 'online');
INSERT INTO `phpbb_smilies` VALUES (60, ':offline:', 'offline.gif', 'ofline');
INSERT INTO `phpbb_smilies` VALUES (61, ':open:', 'open.gif', 'open');
INSERT INTO `phpbb_smilies` VALUES (62, ':pm:', 'pm.gif', 'pm');
INSERT INTO `phpbb_smilies` VALUES (63, ':re-pm:', 're-pm.gif', 're-pm');
INSERT INTO `phpbb_smilies` VALUES (64, ':search:', 'search.gif', 'search');
INSERT INTO `phpbb_smilies` VALUES (65, ':sm:', 'sm.gif', 'kendi mesajlarýnýz');
INSERT INTO `phpbb_smilies` VALUES (66, ':surum:', 'surum.gif', 'sürüm');
INSERT INTO `phpbb_smilies` VALUES (67, ':warred:', 'warred.gif', 'warred');
INSERT INTO `phpbb_smilies` VALUES (68, ':waryel:', 'waryel.gif', 'waryel');
INSERT INTO `phpbb_smilies` VALUES (69, ':yorum:', 'yorum.gif', 'yorum');
INSERT INTO `phpbb_smilies` VALUES (70, ':asc:', 'asc_order.png', 'azalan');
INSERT INTO `phpbb_smilies` VALUES (71, ':desc:', 'desc_order.png', 'artan');
INSERT INTO `phpbb_smilies` VALUES (72, ':cross:', 'cross.png', 'cross');
INSERT INTO `phpbb_smilies` VALUES (73, ':info:', 'info.png', 'info');
INSERT INTO `phpbb_smilies` VALUES (74, ':modul:', 'modul.png', 'modül');
INSERT INTO `phpbb_smilies` VALUES (75, ':proje:', 'project.png', 'proje');
INSERT INTO `phpbb_smilies` VALUES (76, ':ok:', 'tick.png', 'okey');
INSERT INTO `phpbb_smilies` VALUES (77, ':tr:', 'tr.png', 'türkiye');
INSERT INTO `phpbb_smilies` VALUES (78, ':warn:', 'warning.png', 'warning');
INSERT INTO `phpbb_smilies` VALUES (79, ':pn:', 'minipost_new.gif', 'post new');
INSERT INTO `phpbb_smilies` VALUES (80, ':p:', 'minipost.gif', 'post');
INSERT INTO `phpbb_smilies` VALUES (81, ':saved:', 'saved.gif', 'saved');
INSERT INTO `phpbb_smilies` VALUES (82, ':attach:', 'clip.gif', 'attach');
INSERT INTO `phpbb_smilies` VALUES (83, ':saveded:', 'savedd.gif', 'saved');
INSERT INTO `phpbb_smilies` VALUES (84, ':mektup:', 'mektup.gif', 'mektup');
INSERT INTO `phpbb_smilies` VALUES (85, ':ban:', 'icon_ban.gif', 'ban');
INSERT INTO `phpbb_smilies` VALUES (86, ':offtopic:', 'icon_offtopic.gif', 'konu dýþý');
INSERT INTO `phpbb_smilies` VALUES (87, ':oops:', 'icon_unsure.gif', 'oops');
INSERT INTO `phpbb_smilies` VALUES (88, ':pls:', 'icon_pls.gif', 'lütfen');
INSERT INTO `phpbb_smilies` VALUES (89, ':love:', 'icon_wub.gif', 'aþk');
INSERT INTO `phpbb_smilies` VALUES (90, ':P', 'icon_razz.gif', 'alaycý');
INSERT INTO `phpbb_smilies` VALUES (91, ':-P', 'icon_razz.gif', 'alaycý');
INSERT INTO `phpbb_smilies` VALUES (92, ':razz:', 'icon_razz.gif', 'alaycý');
INSERT INTO `phpbb_smilies` VALUES (93, ':++:', 'icon_++.gif', '++');
INSERT INTO `phpbb_smilies` VALUES (94, ':alkis:', 'icon_alkis.gif', 'alkýþlar');
INSERT INTO `phpbb_smilies` VALUES (95, ':duvar:', 'icon_wall.gif', 'duvara kafa');
INSERT INTO `phpbb_smilies` VALUES (96, ':hayir:', 'icon_nayir.gif', 'hayýr dostum');
INSERT INTO `phpbb_smilies` VALUES (97, ':inndir:', 'inndir.gif', 'indir');
INSERT INTO `phpbb_smilies` VALUES (98, ':save:', 'save.gif', 'kaydet');
INSERT INTO `phpbb_smilies` VALUES (99, ':dload:', 'dload.gif', 'dload');
INSERT INTO `phpbb_smilies` VALUES (100, ':flame:', 'flame.gif', ':flame:');

# -- phpbb_topics
INSERT INTO phpbb_topics (topic_id, forum_id, topic_title, topic_poster, topic_time, topic_views, topic_replies, topic_status, topic_vote, topic_type, topic_first_post_id, topic_last_post_id, topic_moved_id) VALUES('1', '1', 'Hoþgeldiniz', '2', '1143896051', '0', '0', '0', '0', '0', '1', '1', '0');

#-- phpbb_user_group
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES('1', '-1', '0');
INSERT INTO phpbb_user_group (group_id, user_id, user_pending) VALUES('2', '2', '0');

#-- üyeler
INSERT INTO phpbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_from, user_actkey, user_newpasswd, ct_logintry, ct_unsucclogin, ct_pwreset, ct_mailcount, ct_postcount, ct_posttime, ct_searchcount, ct_searchtime, user_rules, user_quickreply, user_avatar_width, user_avatar_height, user_color_group, user_can_post, user_split_announce, user_split_sticky, user_split_topic_split) VALUES('-1', '0', 'Anonymous', '', '1143896051', '0', '1143896051', '1143896051', '0', '0', '2.00', NULL, '', '', '0', '0', '0', '0', '0', NULL, '0', '0', '1', '1', '1', '1', '0', '1', '0', '1', '0', NULL, '', '0', '', '', '', '', NULL, '', '', '', '', '', NULL, '', '', '0', NULL, '0', '0', '0', '0', '0', '0', '0', '0', NULL, NULL, '0', '1', '0', '0', '0');
####--user name: yakusha, user pass: yakusha
INSERT INTO phpbb_users (user_id, user_active, username, user_password, user_session_time, user_session_page, user_lastvisit, user_regdate, user_level, user_posts, user_timezone, user_style, user_lang, user_dateformat, user_new_privmsg, user_unread_privmsg, user_last_privmsg, user_login_tries, user_last_login_try, user_emailtime, user_viewemail, user_attachsig, user_allowhtml, user_allowbbcode, user_allowsmile, user_allowavatar, user_allow_pm, user_allow_viewonline, user_notify, user_notify_pm, user_popup_pm, user_rank, user_avatar, user_avatar_type, user_email, user_icq, user_website, user_sig, user_sig_bbcode_uid, user_aim, user_yim, user_msnm, user_occ, user_interests, user_from, user_actkey, user_newpasswd, ct_logintry, ct_unsucclogin, ct_pwreset, ct_mailcount, ct_postcount, ct_posttime, ct_searchcount, ct_searchtime, user_rules, user_quickreply, user_avatar_width, user_avatar_height, user_color_group, user_can_post, user_split_announce, user_split_sticky, user_split_topic_split) VALUES('2', '1', 'yakusha', 'a893ff885fb55610360f9c121a4a0855', '1143896184', '0', '1143896051', '1143896051', '1', '1', '2.00', '1', '', 'd F Y H:i', '0', '0', '0', '0', '0', NULL, '0', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '1', 'yakusha/yakusha-f4+.png', '3', 'yakusha@yakusha.net', '', '', '', '', '', '', '', '', '', '', '', '', '0', NULL, '0', '0', '0', '0', '0', '0', '0', '1', NULL, NULL, '1', '1', '0', '0', '0');

#-- çöp kutusu fonksiyonu
INSERT INTO phpbb_config (config_name, config_value) VALUES ('bin_forum', '2');

#-- 2019 to 2020
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_flood_interval', '15');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rand_seed', '0');

##-- bantron ekleri + rss
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Bantron_ban_rank', '9');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Bantron_ban_color', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('Rss_count', '15');


##-- bantron ile üye ban sistemi baþý
TRUNCATE TABLE  phpbb_ranks;
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('1', 'Forum Yöneticisi', '-1', '1', 'images/ranks/admin.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('2', 'Bölüm Yetkilisi', '-1', '1', 'images/ranks/mod.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('3', 'Vip Üye', '-1', '1', 'images/ranks/vip.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('4', 'Onursal Üye', '-1', '1', 'images/ranks/onursal.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('5', 'Yeni Üye', '-1', '1', 'images/ranks/uye.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('6', 'Aktif üye', '-1', '1', 'images/ranks/aktif.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('7', 'Süpermod', '-1', '1', 'images/ranks/supermod.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('8', 'Destekleyen', '-1', '1', 'images/ranks/destek.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('9', 'Banlandý', '-1', '1', 'images/ranks/ban.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('10', 'Kayýtlý Üye', '10', '0', 'images/ranks/yildiz0.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('11', 'Kayýtlý Üye', '30', '0', 'images/ranks/yildiz1.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('12', 'Kayýtlý Üye', '50', '0', 'images/ranks/yildiz2.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('13', 'Kayýtlý Üye', '70', '0', 'images/ranks/yildiz3.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('14', 'Kayýtlý Üye', '90', '0', 'images/ranks/yildiz4.gif');
INSERT INTO phpbb_ranks (rank_id, rank_title, rank_min, rank_special, rank_image) VALUES('15', 'Kayýtlý Üye', '111', '0', 'images/ranks/yildiz5.gif');

TRUNCATE TABLE  phpbb_color_groups;
INSERT INTO phpbb_color_groups (group_id, group_name, group_color, hidden, order_num) VALUES('1', 'Forum Yöneticisi', '#FFA34F', '0', '1');
INSERT INTO phpbb_color_groups (group_id, group_name, group_color, hidden, order_num) VALUES('2', 'Bölüm Yetkilisi', '#006600', '0', '2');
INSERT INTO phpbb_color_groups (group_id, group_name, group_color, hidden, order_num) VALUES('3', 'V.I.P Üye', 'red', '0', '3');
INSERT INTO phpbb_color_groups (group_id, group_name, group_color, hidden, order_num) VALUES('4', 'Onursal Üye', 'teal', '0', '4');
INSERT INTO phpbb_color_groups (group_id, group_name, group_color, hidden, order_num) VALUES('5', 'Banlandý', 'maroon', '0', '5');
INSERT INTO phpbb_color_groups (group_id, group_name, group_color, hidden, order_num) VALUES('6', 'Bot', 'gray', '0', '6');
##-- bantron ile ban sistemi sonu

#-- tema tablosu boþaltýlýyor ve temalar yeniden tanýtýlýyor
TRUNCATE TABLE `phpbb_themes`;
INSERT INTO phpbb_themes (themes_id, template_name, style_name, head_stylesheet, body_background, body_bgcolor, body_text, body_link, body_vlink, body_alink, body_hlink, tr_color1, tr_color2, tr_color3, tr_class1, tr_class2, tr_class3, th_color1, th_color2, th_color3, th_class1, th_class2, th_class3, td_color1, td_color2, td_color3, td_class1, td_class2, td_class3, fontface1, fontface2, fontface3, fontsize1, fontsize2, fontsize3, fontcolor1, fontcolor2, fontcolor3, span_class1, span_class2, span_class3, img_size_poll, img_size_privmsg) VALUES('1', 'xand', 'xand', 'xand.css', '', 'E5E5E5', '000000', '006699', '5493B4', '', 'DD6900', 'EFEFEF', 'DEE3E7', 'D1D7DC', '', '', '', '98AAB1', '006699', 'FFFFFF', 'cellpic1.gif', 'cellpic3.gif', 'cellpic2.jpg', 'FAFAFA', 'FFFFFF', '', 'row1', 'row2', '', 'Verdana, Arial, Helvetica, sans-serif', 'Trebuchet MS', 'Courier, \'Courier New\', sans-serif', '10', '11', '12', '444444', '006600', 'FFA34F', '', '', '', NULL, NULL);

TRUNCATE TABLE `phpbb_themes_name`;
INSERT INTO phpbb_themes_name (themes_id, tr_color1_name, tr_color2_name, tr_color3_name, tr_class1_name, tr_class2_name, tr_class3_name, th_color1_name, th_color2_name, th_color3_name, th_class1_name, th_class2_name, th_class3_name, td_color1_name, td_color2_name, td_color3_name, td_class1_name, td_class2_name, td_class3_name, fontface1_name, fontface2_name, fontface3_name, fontsize1_name, fontsize2_name, fontsize3_name, fontcolor1_name, fontcolor2_name, fontcolor3_name, span_class1_name, span_class2_name, span_class3_name) VALUES('1', 'The lightest row colour', 'The medium row color', 'The darkest row colour', '', '', '', 'Border round the whole page', 'Outer table border', 'Inner table border', 'Silver gradient picture', 'Blue gradient picture', 'Fade-out gradient on index', 'Background for quote boxes', 'All white areas', '', 'Background for topic posts', '2nd background for topic posts', '', 'Main fonts', 'Additional topic title font', 'Form fonts', 'Smallest font size', 'Medium font size', 'Normal font size (post body etc)', 'Quote & copyright text', 'Code text colour', 'Main table header text colour', '', '', '');

#-- oturumlar ve outo loginler temizleniyor
DELETE FROM  phpbb_sessions;
DELETE FROM  phpbb_sessions_keys;


#--attach ekleniyor ---

ALTER TABLE phpbb_forums ADD auth_download TINYINT(2) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_auth_access ADD auth_download TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_posts ADD post_attachment TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_attachment TINYINT(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_privmsgs ADD privmsgs_attachment TINYINT(1) DEFAULT '0' NOT NULL;

# -- attachments_config
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_dir','files');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_img','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('topic_icon','images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('display_order','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize','262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_quota','52428800');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize_pm','262144');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments','3');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments_pm','1');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('disable_mod','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_pm_attach','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_topic_review','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_ftp_upload','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('show_apcp','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attach_version','2.4.3');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_upload_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_pm_quota', '0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_server','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('download_path','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_user','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pass','');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pasv_mode','1');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_display_inlined','1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_width','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_height','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_create_thumbnail','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_min_thumb_filesize','12000');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_imagick', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('use_gd2','0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('wma_autoplay','0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('flash_autoplay','0');

# -- forbidden_extensions
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (1,'php');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (2,'php3');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (3,'php4');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (4,'phtml');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (5,'pl');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (6,'asp');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (7,'cgi');

# -- extension_groups
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (1,'Images',1,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (2,'Archives',0,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (3,'Plain Text',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (4,'Documents',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (5,'Real Media',0,0,2,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (6,'Streams',2,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (7,'Flash Files',3,0,1,'',0,'');

# -- extensions
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (1, 1,'gif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (2, 1,'png', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (3, 1,'jpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (4, 1,'jpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (5, 1,'tif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (6, 1,'tga', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (7, 2,'gtar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (8, 2,'gz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (9, 2,'tar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (10, 2,'zip', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (11, 2,'rar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (12, 2,'ace', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (13, 3,'txt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (14, 3,'c', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (15, 3,'h', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (16, 3,'cpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (17, 3,'hpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (18, 3,'diz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (19, 4,'xls', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (20, 4,'doc', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (21, 4,'dot', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (22, 4,'pdf', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (23, 4,'ai', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (24, 4,'ps', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (25, 4,'ppt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (26, 5,'rm', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (27, 6,'wma', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (28, 7,'swf', '');

# -- default quota limits
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (1, 'Low', 262144);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (2, 'Medium', 2097152);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (3, 'High', 5242880);
#-- attach mod sonu ---

#-- loged in control
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_login_for_profile',1);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_login_for_memberlist',1);
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_login_for_whoisonline',1);

#-- fake delete
#-- otomatik üye sil, üyeyi silmez, silinmiþ diye iþaretler
ALTER TABLE `phpbb_users` ADD `user_fake_delete` TINYINT( 1 ) DEFAULT '0' NOT NULL ;

#-- uyarý: hýzlý cevap kaldýrýlýyor, sorgu iç içe girdiðinden böyle siliniyor
ALTER TABLE phpbb_users DROP user_quickreply;
DELETE FROM phpbb_config WHERE config_name = 'allow_quickreply';

TRUNCATE TABLE `phpbb_hacks_list`;
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('1', 'Þehir Açýlýr Kutuda', 'Kullanýcý profilinde bulunan ve profil deðiþikliði ile kayýt sýrasýnda doldurulabilen þehir/nereli girdi kutusunu, içinde þehirlerin yer aldýðý açýlýr (drop-down) bir kutu ile deðiþtirir.', 'ALEXIS', '', 'http://www.canver.net', '3.0.0', 'No', '', '0', '0'); 
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('2', 'Meslek Açýlýr Kutuda', 'Kullanýcý profilinde bulunan ve profil deðiþikliði ile kayýt sýrasýnda doldurulabilen meslek girdi kutusunu, içinde mesleklerin yer aldýðý açýlýr (drop-down) bir kutu ile deðiþtirir.', 'ALEXIS', '', 'http://www.canver.net', '2.0.0', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('3', 'Toplam üye sayýsý link', 'index.php sayfasýnýn altýnda bulunan istatiktik kutusunda yer alan toplam üye sayýsýný üye listesine gidecek þekilde linkler.', 'ALEXIS', '', 'http://www.canver.net', '1.0.1', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('4', 'Forum yönetim geliþtirme', 'Yönetim panelindeki forum yönetim kýsmýnda, sil, deðiþtir, düzenle vb. linkleri resimler ile deðiþtirir ;)', 'ALEXIS', '', 'http://www.canver.net', '1.0.0a', 'no', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('5', 'Display Total Replies And Views In Viewtopic', 'Bu eklenti wiewtopic.php de toplam cevabý ve gösterimi gösterir', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.1', 'No', '', '0', '0');

INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('6', 'Display forum desciription in viewforum', 'Bu eklenti wiewforum.php de forum açýklamasýný gösterir', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.0', 'No', '', '0', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('7', 'Special ban system', 'Üyelerin, mesaj gönderip gönderemeyeceðine yöneticilerin karar verebilmelerine imkan tanýr.', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.0', 'No', '', '0', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('8', 'Multi-page topics, forums or searchs in one page', 'Çoklu sonuçlarý tek sayfada gösterir, topic, forum ve search sayfalarýnda..', 'emrag', 'emrah987@hotmail.com', 'http://www.canver.net', '1.0.5', 'No', '', '', '1144334662');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('9', 'My bbcode box lt', 'BBcode butonlarýný Microsoft Office 2003 tarzý buton seti þekline dönüþtürür ve yeni bbcode özellikleri ekler. Advancad bbcode box modunun daha da küçültülmüþ, orta halli bir türevidir. Çoklu dil özelliklerini kaldýracak þekilde yapýlandýrýlmýþtýr.', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '2.0.0', 'No', '', '0', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('10', 'Yakusha Modlist', 'Modlarýn listesinin oluþturulmasýna ve mod bilgilerinin düzenlenmesine imkan tanýr. Nivisec - Admin hack list 1.2.0 modunun geliþtirilmiþ bir türevidir.', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.0', 'No', '', '0', '0');

INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('11', 'Lock / Unlock Topic with Post', 'Mesajdan ilgili baþlýðý kilitlemeye veya kilidi açmaya yarar.', 'Yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.2', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('12', 'Light Statictik', 'Ýstatistik bilgisi verileri için fazladan yapýlan if döngüsü karmaþasýný düzeltir.', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('13', 'Clean BBcode', 'Oluþturduðumuz bir bbcode listesiyle açýkta kalan geçersiz biçim kodlarýný temizler', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.2', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('14', 'Highlight Clean', 'Highlight özelliði için bir düzeltme içerir. (Yayýnlanmamýþ sürümdür)', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.4', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('15', 'Bantron Eklentileri', 'Bantron ile banlanan üyeye, otomatik olarak, önceden ayarlanmýþ olan banlý rütbesini atar, renk gruplarýndan da ayný iþlemi gerçekleþtirir. Eðer üye üye listesinden banlanmýþsa, yine ayný iþlemi yapar. :)', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0');

INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('16', 'Ýstatistik bilgilerine bilgi ekle', 'Panele arama tablosu ve mesaj tablosu büyüklüðünü de ekler', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.0', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('17', 'Date and backup type in backup filename', 'his MOD automatically adds the current date and backup type to the filename of database backup files', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.0', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('18', 'Logged In control on acp', 'Profil görüntüleme, üye listesi, kimler online sayfalarýný misafirlerin görüp göremeyeceðini panelden ayarlamaya yarar', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.0', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('19', 'Moderate list open / close', 'Bölüm yetkilisi bilgilerinin ana sayfada görünüp görünmemesini yönetim panelinden kontrol etmeye izin verir', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('20', 'Otomatik bakým - Version cache eklentisi', 'Version cache moduyla birlikte çalýþýr, yönetim panelinden aç kapa özelliði vardýr. 24 saatte bir bütün tablolarý optimize ve repair eder! Admin paneline giriþte bu sorgulamayý yapar. ', 'yakusha', 'yakusha@tnn.net', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0');

INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('21', 'Bölüm yetkilileri kontrolü ', 'Ana sayfada, bölüm yetkilisi bilgilerinin görünüp görünemeyeceðini yönetim panelinden kontrol etmeye izin veren basit bir özellik ekler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('22', 'Easy Meta tag Control', 'Metalarý tek noktada toplar ve her dosyanýn ihtiyacý olan metalar tek noktadan çekilir', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', '1.0.1', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('23', 'Yönetim paneli istatistik sayfasý', 'Yönetim paneli ana sayfasýndaki istatistikler için yeni bir sayfa oluþturur ve bir çok yeni istatistik ve teknik bilgi ekler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', 'Alfa 0.1.0', 'No', '', '', '0');
INSERT INTO phpbb_hacks_list (hack_id, hack_name, hack_desc, hack_author, hack_author_email, hack_author_website, hack_version, hack_hide, hack_download_url, hack_file, hack_file_mtime) VALUES('24', 'Bantron - Yasaklýlar Sayfasý', 'Bantron moduyla yasaklanan üyelerin yasak geçerlilik sürelerini, yasaklanma zamanlarýný ve yasaklanma sebeplerini listeler', 'yakusha', 'yakushaBB@yahoo.com', 'http://www.yakusha.net', 'Alfa 0.1.0', 'No', '', '', '0');

#------[+]------------------------ f6-002--------------------------------

ALTER TABLE phpbb_posts_text modify post_subject varchar(100);
ALTER TABLE phpbb_topics modify topic_title varchar(100);
ALTER TABLE phpbb_users ADD user_allowsig TINYINT(1) default '1' NOT NULL AFTER user_allowavatar;

ALTER TABLE `phpbb_forums` ADD `forum_icon` VARCHAR( 255 ) default NULL;

INSERT INTO phpbb_inline_ads (ad_id , ad_code, ad_name ) VALUES (1, '<a href=http://www.canver.net><img src=http://www.phpbbliste.com/img/canversoft468_3.gif></a>', 'canversoft');
INSERT INTO phpbb_config ( config_name , config_value ) VALUES ('ad_after_post', '1'), ('ad_post_threshold', ''), ('ad_every_post', ''), ('ad_who', '1'), ('ad_no_forums', ''), ('ad_no_groups', ''), ('ad_old_style', '1');

INSERT INTO phpbb_report_cat (cat_id, cat_name, cat_type, cat_auth, cat_explain) VALUES (1, 'Mesaj Raporla', 1, 0, '');
INSERT INTO phpbb_report_cat (cat_id, cat_name, cat_type, cat_auth, cat_explain) VALUES (2, 'Konu Raporla', 1, 0, '');
INSERT INTO phpbb_report_cat (cat_id, cat_name, cat_type, cat_auth, cat_explain) VALUES (3, 'Kullanýcý Raporla', 1, 0, '');

INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_color_not_cleared', '#A8371D');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_color_in_process', '#1B75BE');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_color_cleared', '#297F3F');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_list', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_notify', '0');


#------[+]------------------------ f7-001--------------------------------

ALTER TABLE `phpbb_users` DROP `ct_logintry`;
ALTER TABLE `phpbb_users` DROP `ct_unsucclogin`;
ALTER TABLE `phpbb_users` DROP `ct_pwreset`;
ALTER TABLE `phpbb_users` DROP `ct_mailcount`;
ALTER TABLE `phpbb_users` DROP `ct_postcount`;
ALTER TABLE `phpbb_users` DROP `ct_posttime`;
ALTER TABLE `phpbb_users` DROP `ct_searchcount`;
ALTER TABLE `phpbb_users` DROP `ct_searchtime`;

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


INSERT INTO `phpbb_captcha_config` VALUES ('width', '320');
INSERT INTO `phpbb_captcha_config` VALUES ('height', '60');
INSERT INTO `phpbb_captcha_config` VALUES ('background_color', '#E5ECF9');
INSERT INTO `phpbb_captcha_config` VALUES ('jpeg', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('jpeg_quality', '50');
INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('pre_letters_great', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('font', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('chess', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('ellipses', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('arcs', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('lines', '1');
INSERT INTO `phpbb_captcha_config` VALUES ('image', '0');
INSERT INTO `phpbb_captcha_config` VALUES ('gammacorrect', '0.8');
INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_x', '15');
INSERT INTO `phpbb_captcha_config` VALUES ('foreground_lattice_y', '15');
INSERT INTO `phpbb_captcha_config` VALUES ('lattice_color', '#FFFFFF');

ALTER TABLE `phpbb_confirm` CHANGE `code` `code` CHAR(10) NOT NULL;
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_automat',0);

#-- 2.8.1-----
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_mod_list',0);

INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'welcome_text', 'Buraya mesajýnýzý yazabilirsiniz....<br /><br />Mesajý deðiþtirmek için yönetici panelinden portal kýsmýna giriniz. <b>HTML</b> komutlarý kullanabilirsiniz.<br /><br />Daha fazla bilgi ve sorular için lütfen destek sitemizi (www.yakusha.net) ziyaret ediniz.');
INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'number_of_news', '5');
INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'news_length', '200');
INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'news_forum ', '1');
INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'poll_forum ', '1');
INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'number_recent_topics', '10');
INSERT INTO `phpbb_portal` ( portal_name , portal_value ) VALUES ( 'number_recent_news', '15');

#-- avatar boyutu yeniden ayarlanýyor
UPDATE `phpbb_config` SET `config_value` = '97' WHERE `config_name` = 'avatar_max_width';
UPDATE `phpbb_config` SET `config_value` = '97' WHERE `config_name` = 'avatar_max_height';

#-- 2.8.2-----
UPDATE `phpbb_config` SET `config_value` = '.0.22' WHERE `config_name` = 'version';

#--forum ikon---
ALTER TABLE `phpbb_forums` ADD `forum_keywords` TEXT NOT NULL;
INSERT INTO phpbb_config (config_name, config_value) VALUES ('site_keywords','site açýklamasý, 255 karakter, sýnýrý, vardýr.'); 

#--- max session kaldýrýlýyor
DELETE FROM phpbb_config WHERE config_name = 'max_sessions';
DELETE FROM phpbb_config WHERE config_name = 'max_sessions_ip';

#--- junior admin kaldýrýlýyor
DROP TABLE phpbb_jr_admin_users;
#--- 2021-2022 sql
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

#--- avatar büyüklüðü yenileniyor
UPDATE `phpbb_config` SET `config_value` = '6144' WHERE `config_name` = 'avatar_filesize';

#--- canlý istatistik
INSERT INTO phpbb_config (config_name, config_value) VALUES ('visit_counter', '1000');

#--- notify when message moving
ALTER TABLE phpbb_users DROP user_topic_moved_mail;
ALTER TABLE phpbb_users DROP user_topic_moved_pm;
ALTER TABLE phpbb_users DROP user_topic_moved_pm_notify;

#--- linkleri misafirlerden gizle, disable baþlýyor
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hide_links', '0');

#-- otomatik yedek
INSERT INTO `phpbb_backup` VALUES (0, 1, 'youremail@domain.ext, yourotheremail@anotherdomain.ext', 1, 'ftp.server.com', 'ftp_username', 'ftp_password', '/backups', '1', '-1', '0    0    *    *    *', '120', 'full', 0, 0, 'phpbb_ignore_me, separate_tables_with_a_comma_and_space, ignored, ignore_me_too', 1143162120, 0);
#-- ban yetkisi
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_mods_ban', '0');