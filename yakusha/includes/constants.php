<?php
/***************************************************************************
* constants.php
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

// Debug Level
//define('DEBUG', 1); // Debugging on
define('DEBUG', 1); // Debugging off


// User Levels <- Do not change the values of USER or ADMIN
define('DELETED', -1);
define('ANONYMOUS', -1);

define('USER', 0);
define('ADMIN', 1);
define('MOD', 2);

// User related
define('USER_ACTIVATION_NONE', 0);
define('USER_ACTIVATION_SELF', 1);
define('USER_ACTIVATION_ADMIN', 2);

define('USER_AVATAR_NONE', 0);
define('USER_AVATAR_UPLOAD', 1);
define('USER_AVATAR_REMOTE', 2);
define('USER_AVATAR_GALLERY', 3);

// Group settings
define('GROUP_OPEN', 0);
define('GROUP_CLOSED', 1);
define('GROUP_HIDDEN', 2);

// Forum state
define('FORUM_UNLOCKED', 0);
define('FORUM_LOCKED', 1);

// Topic status
define('TOPIC_UNLOCKED', 0);
define('TOPIC_LOCKED', 1);
define('TOPIC_MOVED', 2);
define('TOPIC_WATCH_NOTIFIED', 1);
define('TOPIC_WATCH_UN_NOTIFIED', 0);

// Topic types
define('POST_NORMAL', 0);
define('POST_STICKY', 1);
define('POST_ANNOUNCE', 2);
define('POST_GLOBAL_ANNOUNCE', 3);

// SQL codes
define('BEGIN_TRANSACTION', 1);
define('END_TRANSACTION', 2);

// Error codes
define('GENERAL_MESSAGE', 200);
define('GENERAL_ERROR', 202);
define('CRITICAL_MESSAGE', 203);
define('CRITICAL_ERROR', 204);

// Private messaging
define('PRIVMSGS_READ_MAIL', 0);
define('PRIVMSGS_NEW_MAIL', 1);
define('PRIVMSGS_SENT_MAIL', 2);
define('PRIVMSGS_SAVED_IN_MAIL', 3);
define('PRIVMSGS_SAVED_OUT_MAIL', 4);
define('PRIVMSGS_UNREAD_MAIL', 5);
define('PRIVMSGS_REPLY_MAIL', 6);

// URL PARAMETERS
define('POST_TOPIC_URL', 't');
define('POST_CAT_URL', 'c');
define('POST_FORUM_URL', 'f');
define('POST_USERS_URL', 'u');
define('POST_POST_URL', 'p');
define('POST_GROUPS_URL', 'g');

// Session parameters
define('SESSION_METHOD_COOKIE', 100);
define('SESSION_METHOD_GET', 101);

// Auth settings
define('AUTH_LIST_ALL', 0);
define('AUTH_ALL', 0);

define('AUTH_REG', 1);
define('AUTH_ACL', 2);
define('AUTH_MOD', 3);
define('AUTH_ADMIN', 5);

define('AUTH_VIEW', 1);
define('AUTH_READ', 2);
define('AUTH_POST', 3);
define('AUTH_REPLY', 4);
define('AUTH_EDIT', 5);
define('AUTH_DELETE', 6);
define('AUTH_ANNOUNCE', 7);
define('AUTH_STICKY', 8);
define('AUTH_POLLCREATE', 9);
define('AUTH_VOTE', 10);
define('AUTH_ATTACH', 11);


//pm replied, son konular, anketler
define('PRIVMSGS_REPLY_MAIL', 6);

//Search Titles Only 1.0.0
@define(SEARCH_ENTIRE_MESSAGE, 0);
@define(SEARCH_MESSAGE_ONLY, 1);
@define(SEARCH_TITLE_ONLY, 2);

//START Inline Banner Ad
define('ALL', 1);

// BEGIN Advanced_Report_Hack
// Report category types
define('REPORT_NORMAL', 0);
define('REPORT_EXT', 1);
// Report status
define('REPORT_NOT_CLEARED', 0);
define('REPORT_IN_PROCESS', 1);
define('REPORT_CLEARED', 2);
// Special categories
define('REPORT_POST_ID', 1);
define('REPORT_TOPIC_ID', 2);
define('REPORT_USER_ID', 3);
// END Advanced_Report_Hack

// Table names
define('CONFIRM_TABLE', $table_prefix.'confirm');
define('AUTH_ACCESS_TABLE', $table_prefix.'auth_access');
define('BANLIST_TABLE', $table_prefix.'banlist');
define('CATEGORIES_TABLE', $table_prefix.'categories');
define('CONFIG_TABLE', $table_prefix.'config');
define('DISALLOW_TABLE', $table_prefix.'disallow');
define('FORUMS_TABLE', $table_prefix.'forums');
define('GROUPS_TABLE', $table_prefix.'groups');
define('POSTS_TABLE', $table_prefix.'posts');
define('POSTS_TEXT_TABLE', $table_prefix.'posts_text');
define('PRIVMSGS_TABLE', $table_prefix.'privmsgs');
define('PRIVMSGS_TEXT_TABLE', $table_prefix.'privmsgs_text');
define('PRIVMSGS_IGNORE_TABLE', $table_prefix.'privmsgs_ignore');
define('PRUNE_TABLE', $table_prefix.'forum_prune');
define('RANKS_TABLE', $table_prefix.'ranks');
define('SEARCH_TABLE', $table_prefix.'search_results');
define('SEARCH_WORD_TABLE', $table_prefix.'search_wordlist');
define('SEARCH_MATCH_TABLE', $table_prefix.'search_wordmatch');
define('SESSIONS_TABLE', $table_prefix.'sessions');
define('SESSIONS_KEYS_TABLE', $table_prefix.'sessions_keys');
define('SMILIES_TABLE', $table_prefix.'smilies');
define('THEMES_TABLE', $table_prefix.'themes');
define('THEMES_NAME_TABLE', $table_prefix.'themes_name');
define('TOPICS_TABLE', $table_prefix.'topics');
define('TOPICS_WATCH_TABLE', $table_prefix.'topics_watch');
define('USER_GROUP_TABLE', $table_prefix.'user_group');
define('USERS_TABLE', $table_prefix.'users');
define('WORDS_TABLE', $table_prefix.'words');
define('VOTE_DESC_TABLE', $table_prefix.'vote_desc');
define('VOTE_RESULTS_TABLE', $table_prefix.'vote_results');
define('VOTE_USERS_TABLE', $table_prefix.'vote_voters');
define('RULES_TABLE', $table_prefix.'rules');
define('COLOR_GROUPS_TABLE', $table_prefix.'color_groups');
define('EDIT_NOTES_TABLE', $table_prefix . 'edit_notes');
define('HACKS_LIST_TABLE', $table_prefix.'hacks_list');
define('ADS_TABLE', $table_prefix.'inline_ads');
define('REPORT_CAT_TABLE', $table_prefix.'report_cat');
define('REPORT_TABLE', $table_prefix.'report');
define('FAVORITES_TABLE', $table_prefix.'favorites');
define('CTRACKER_CONFIG', $table_prefix . 'ctracker_config');
define('CTRACKER_IPBLOCKER', $table_prefix . 'ctracker_ipblocker');
define('CTRACKER_LOGINHISTORY', $table_prefix . 'ctracker_loginhistory');
define('CTRACKER_FILECHK', $table_prefix . 'ctracker_filechk');
define('CTRACKER_FILESCANNER', $table_prefix . 'ctracker_filescanner');
define('CTRACKER_BACKUP', $table_prefix . 'ctracker_backup');
define('CAPTCHA_CONFIG_TABLE', $table_prefix.'captcha_config');
define('PORTAL_TABLE', $table_prefix.'portal');
//arama tablosu yeniden oluþturucu
define('SEARCH_REBUILD_TABLE', $table_prefix.'search_rebuild');
//attach mod tablolarý, attachmod/includse/constanst.php den aktarma
define('ATTACH_CONFIG_TABLE', $table_prefix . 'attachments_config');
define('EXTENSION_GROUPS_TABLE', $table_prefix . 'extension_groups');
define('EXTENSIONS_TABLE', $table_prefix . 'extensions');
define('FORBIDDEN_EXTENSIONS_TABLE', $table_prefix . 'forbidden_extensions');
define('ATTACHMENTS_DESC_TABLE', $table_prefix . 'attachments_desc');
define('ATTACHMENTS_TABLE', $table_prefix . 'attachments');
define('QUOTA_TABLE', $table_prefix . 'attach_quota');
define('QUOTA_LIMITS_TABLE', $table_prefix . 'quota_limits');
define('ADMIN_MODULE_TABLE', $table_prefix.'admin_nav_module');
// Automatic DB backup Mod
define('BACKUP_TABLE', $table_prefix.'backup');

define('PAGE_INDEX', 1800); // ana sayfa
define('PAGE_LOGIN', -1801); // oturum açýyor
define('PAGE_SEARCH', -1802); // arama yapýyor
define('PAGE_REGISTER', -1803); // kayýt oluyor
define('PAGE_PROFILE', -1804); // profil
define('PAGE_VIEWMEMBERS', -1805); // üye listesi
define('PAGE_VIEWONLINE', -1806); // kimler online
define('PAGE_POLL_OVERVIEW', -1807); // anketler
define('PAGE_FAQ', -1808); // yardým
define('PAGE_POSTING', -1809); // mesaj gönderiyor
define('PAGE_PRIVMSGS', -1810); // özel mesajlar
define('PAGE_GROUPCP', -1811); // gruplar
define('PAGE_RULES', -1812); // kurallar
define('PAGE_RECENT', -1813); // son konular
define('PAGE_TOPIC_OFFSET', 1814); // !!!! böyle bir sayfa bulunamadý
define('PAGE_RSS', 1815); // rss
define('PAGE_FAV', 1816); // favorites
define('PAGE_GSM', 1817); // google sitemap
define('PAGE_LH', 1818); // login hist
define('PAGE_UU', 1819); // unlucking username
define('PAGE_CONTACT', 1820); // contact menu
define('PAGE_FILES', 1821); // downloads - files
define('PAGE_MODLIST', 1822); // mod listesi

define('PAGE_PORTAL', 1824); // portal
define('PAGE_RC', 1825); // remove çerezler
define('PAGE_REPORT', 1826); // report sayfasý
define('PAGE_STAFF', 1827); // page staff
define('PAGE_SINGLE_POST', 1828); // single post
define('PAGE_WT', 1829); // Wached Topic
define('PAGE_ATTACH_RULES', 1830); // attach rules
define('PAGE_ATTACH', 1831); // attachment
define('PAGE_BANLIST', 1832); // banlist
define('PAGE_ARCHIVE', 1833); // pda

?>