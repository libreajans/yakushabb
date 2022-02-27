<?php
/***************************************************************************
* admin_board.php
***************************************************************************/
// CTracker_Ignore: File Checked By Human

define('IN_PHPBB', true);

if( !empty($setmodules) )
{
$file = basename(__FILE__);
$module['General']['Configuration'] = $file;
return;
}

//
// Let's set the root dir for phpBB
//
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignorepvar = array('board_disable_msg','site_keywords','registration_closed','board_email_sig');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

//
// Pull all config data
//
$sql = "SELECT *
FROM " . CONFIG_TABLE;
if(!$result = $db->sql_query($sql))
{
message_die(CRITICAL_ERROR, "Could not query config information in admin_board", "", __LINE__, __FILE__, $sql);
}
else
{

// CrackerTracker v5.x
if ( isset($HTTP_POST_VARS['submit']) && $ctracker_config->settings['detect_misconfiguration'] == 1 )
{
// Let's detect some things of misconfiguration
if ( $HTTP_POST_VARS['server_port'] == '21' )
{
// FTP Port Misstake
message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_1']);
}

if ( $HTTP_POST_VARS['session_length'] < '100' )
{
// Session Length Error
message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_2']);
}

if ( !preg_match('/\\A\/$|\\A\/.*\/$/', $HTTP_POST_VARS['script_path']) )
{
// Skript Path Error
message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_3']);
}

if ( preg_match('/\/$/', $HTTP_POST_VARS['server_name']) )
{
// Server Name Error
message_die(GENERAL_MESSAGE, $lang['ctracker_gmb_pu_4']);
}
}

if ( isset($HTTP_POST_VARS['submit']) && $ctracker_config->settings['auto_recovery'] == 1 )
{
define('CTRACKER_ACP', true);
include_once($phpbb_root_path . 'ctracker/classes/class_ct_adminfunctions.' . $phpEx);
$backup_system = new ct_adminfunctions();
$backup_system->recover_configuration();
unset($backup_system);
}
// CrackerTracker v5.x

while( $row = $db->sql_fetchrow($result) )
{
$config_name = $row['config_name'];
$config_value = $row['config_value'];
$default_config[$config_name] = isset($HTTP_POST_VARS['submit']) ? str_replace("'", "\'", $config_value) : $config_value;

$new[$config_name] = ( isset($HTTP_POST_VARS[$config_name]) ) ? $HTTP_POST_VARS[$config_name] : $default_config[$config_name];

if ($config_name == 'cookie_name')
{
$new['cookie_name'] = str_replace('.', '_', $new['cookie_name']);
}

// Attempt to prevent a common mistake with this value,
// http:// is the protocol and not part of the server name
if ($config_name == 'server_name')
{
$new['server_name'] = str_replace('http://', '', $new['server_name']);
}

// Attempt to prevent a mistake with this value.
if ($config_name == 'avatar_path')
{
	$new['avatar_path'] = trim($new['avatar_path']);
	if (strstr($new['avatar_path'], "\0") || !is_dir($phpbb_root_path . $new['avatar_path']) || !is_writable($phpbb_root_path . $new['avatar_path']))
	{
		$new['avatar_path'] = $default_config['avatar_path'];
	}
}

$new['max_edit_notes'] = preg_replace("#[^0-9]{1,2}#", '5', $new['max_edit_notes']);

if( isset($HTTP_POST_VARS['submit']) )
{
$sql = "UPDATE " . CONFIG_TABLE . " SET
config_value = '" . str_replace("\'", "''", $new[$config_name]) . "'
WHERE config_name = '$config_name'";
if( !$db->sql_query($sql) )
{
message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
}
}
}

if( isset($HTTP_POST_VARS['submit']) )
{
$message = $lang['Config_updated'] . "<br /><br />" . sprintf($lang['Click_return_config'], "<a href=\"" . append_sid("admin_board.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");

message_die(GENERAL_MESSAGE, $message);
}
}

$style_select = style_select2($new['default_style'], 'default_style', "../templates");
$lang_select = language_select($new['default_lang'], 'default_lang', "language");
$timezone_select = tz_select($new['board_timezone'], 'board_timezone');

$disable_board_yes = ( $new['board_disable'] ) ? "checked=\"checked\"" : "";
$disable_board_no = ( !$new['board_disable'] ) ? "checked=\"checked\"" : "";


// BEGIN Disable Registration MOD
$registration_status_yes = ( $new['registration_status'] ) ? "checked=\"checked\"" : "";
$registration_status_no = ( !$new['registration_status'] ) ? "checked=\"checked\"" : "";
// END Disable Registration MOD

// Default avatar MOD, By Manipe (Begin)
$default_avatar_guests = ($new['default_avatar_set'] == '0') ? "checked=\"checked\"" : "";
$default_avatar_users = ($new['default_avatar_set'] == '1') ? "checked=\"checked\"" : "";
$default_avatar_both = ($new['default_avatar_set'] == '2') ? "checked=\"checked\"" : "";
$default_avatar_none = ($new['default_avatar_set'] == '3') ? "checked=\"checked\"" : "";
// Default avatar MOD, By Manipe (End)

// +MOD: Live Email Validate (LEV)
$live_email_validation_yes = ( $new['live_email_validation'] ) ? "checked=\"checked\"" : "";
$live_email_validation_no = ( !$new['live_email_validation'] ) ? "checked=\"checked\"" : "";
// -MOD: Live Email Validate (LEV)

$cookie_secure_yes = ( $new['cookie_secure'] ) ? "checked=\"checked\"" : "";
$cookie_secure_no = ( !$new['cookie_secure'] ) ? "checked=\"checked\"" : "";

$html_tags = $new['allow_html_tags'];

$override_user_style_yes = ( $new['override_user_style'] ) ? "checked=\"checked\"" : "";
$override_user_style_no = ( !$new['override_user_style'] ) ? "checked=\"checked\"" : "";

$html_yes = ( $new['allow_html'] ) ? "checked=\"checked\"" : "";
$html_no = ( !$new['allow_html'] ) ? "checked=\"checked\"" : "";

$bbcode_yes = ( $new['allow_bbcode'] ) ? "checked=\"checked\"" : "";
$bbcode_no = ( !$new['allow_bbcode'] ) ? "checked=\"checked\"" : "";

$activation_none = ( $new['require_activation'] == USER_ACTIVATION_NONE ) ? "checked=\"checked\"" : "";
$activation_user = ( $new['require_activation'] == USER_ACTIVATION_SELF ) ? "checked=\"checked\"" : "";
$activation_admin = ( $new['require_activation'] == USER_ACTIVATION_ADMIN ) ? "checked=\"checked\"" : "";

$confirm_yes = ($new['enable_confirm']) ? 'checked="checked"' : '';
$confirm_no = (!$new['enable_confirm']) ? 'checked="checked"' : '';

$allow_autologin_yes = ($new['allow_autologin']) ? 'checked="checked"' : '';
$allow_autologin_no = (!$new['allow_autologin']) ? 'checked="checked"' : '';

$board_email_form_yes = ( $new['board_email_form'] ) ? "checked=\"checked\"" : "";
$board_email_form_no = ( !$new['board_email_form'] ) ? "checked=\"checked\"" : "";

$gzip_yes = ( $new['gzip_compress'] ) ? "checked=\"checked\"" : "";
$gzip_no = ( !$new['gzip_compress'] ) ? "checked=\"checked\"" : "";

$privmsg_on = ( !$new['privmsg_disable'] ) ? "checked=\"checked\"" : "";
$privmsg_off = ( $new['privmsg_disable'] ) ? "checked=\"checked\"" : "";

$prune_yes = ( $new['prune_enable'] ) ? "checked=\"checked\"" : "";
$prune_no = ( !$new['prune_enable'] ) ? "checked=\"checked\"" : "";

$smile_yes = ( $new['allow_smilies'] ) ? "checked=\"checked\"" : "";
$smile_no = ( !$new['allow_smilies'] ) ? "checked=\"checked\"" : "";

$sig_yes = ( $new['allow_sig'] ) ? "checked=\"checked\"" : "";
$sig_no = ( !$new['allow_sig'] ) ? "checked=\"checked\"" : "";

$namechange_yes = ( $new['allow_namechange'] ) ? "checked=\"checked\"" : "";
$namechange_no = ( !$new['allow_namechange'] ) ? "checked=\"checked\"" : "";

$allow_mods_ban_yes = ( $new['allow_mods_ban'] ) ? "checked=\"checked\"" : "";
$allow_mods_ban_no = ( !$new['allow_mods_ban'] ) ? "checked=\"checked\"" : "";

$hide_links_yes = ( $new['hide_links'] ) ? "checked=\"checked\"" : "";
$hide_links_no = ( !$new['hide_links'] ) ? "checked=\"checked\"" : "";

$show_search_bots_yes = ( $new['show_search_bots'] ) ? "checked=\"checked\"" : "";
$show_search_bots_no = ( !$new['show_search_bots'] ) ? "checked=\"checked\"" : "";

$topic_page_on_top_yes = ( $new['topic_page_on_top'] ) ? "checked=\"checked\"" : "";
$topic_page_on_top_no = ( !$new['topic_page_on_top'] ) ? "checked=\"checked\"" : "";

$show_user_online_today_yes = ( $new['show_user_online_today'] ) ? "checked=\"checked\"" : "";
$show_user_online_today_no = ( !$new['show_user_online_today'] ) ? "checked=\"checked\"" : "";

$admin_message_save_from_mods_yes = ( $new['admin_message_save_from_mods'] ) ? "checked=\"checked\"" : "";
$admin_message_save_from_mods_no = ( !$new['admin_message_save_from_mods'] ) ? "checked=\"checked\"" : "";

$icon_mod_open_yes = ( $new['icon_mod_open'] ) ? "checked=\"checked\"" : "";
$icon_mod_open_no = ( !$new['icon_mod_open'] ) ? "checked=\"checked\"" : "";

$basit_seo_open_yes = ( $new['basit_seo_open'] ) ? "checked=\"checked\"" : "";
$basit_seo_open_no = ( !$new['basit_seo_open'] ) ? "checked=\"checked\"" : "";

$show_mod_list_yes = ( $new['show_mod_list'] ) ? "checked=\"checked\"" : "";
$show_mod_list_no = ( !$new['show_mod_list'] ) ? "checked=\"checked\"" : "";

$allow_automat_yes = ( $new['allow_automat'] ) ? "checked=\"checked\"" : "";
$allow_automat_no = ( !$new['allow_automat'] ) ? "checked=\"checked\"" : "";

$login_for_profile_yes = ( $new['allow_login_for_profile'] ) ? "checked=\"checked\"" : "";
$login_for_profile_no = ( !$new['allow_login_for_profile'] ) ? "checked=\"checked\"" : "";
$login_for_memberlist_yes = ( $new['allow_login_for_memberlist'] ) ? "checked=\"checked\"" : "";
$login_for_memberlist_no = ( !$new['allow_login_for_memberlist'] ) ? "checked=\"checked\"" : "";
$login_for_whoisonline_yes = ( $new['allow_login_for_whoisonline'] ) ? "checked=\"checked\"" : "";
$login_for_whoisonline_no = ( !$new['allow_login_for_whoisonline'] ) ? "checked=\"checked\"" : "";

$avatars_local_yes = ( $new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_local_no = ( !$new['allow_avatar_local'] ) ? "checked=\"checked\"" : "";
$avatars_remote_yes = ( $new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_remote_no = ( !$new['allow_avatar_remote'] ) ? "checked=\"checked\"" : "";
$avatars_upload_yes = ( $new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";
$avatars_upload_no = ( !$new['allow_avatar_upload'] ) ? "checked=\"checked\"" : "";

$smtp_yes = ( $new['smtp_delivery'] ) ? "checked=\"checked\"" : "";
$smtp_no = ( !$new['smtp_delivery'] ) ? "checked=\"checked\"" : "";

// Start Edit Notes MOD
$edit_notes_enable = ( $new['edit_notes_enable'] ) ? 'checked="checked"' : '';
$edit_notes_disable = ( !$new['edit_notes_enable'] ) ? 'checked="checked"' : '';

$max_edit_notes = ( !$new['max_edit_notes'] ) ? '5' : $new['max_edit_notes'];

$edit_notes_admin = ( $new['edit_notes_permissions'] == 3 ) ? 'checked="checked"' : '';
$edit_notes_staff = ($new['edit_notes_permissions'] == 2 ) ? 'checked="checked"' : '';
$edit_notes_reg = ( $new['edit_notes_permissions'] == 1 ) ? 'checked="checked"' : '';
$edit_notes_all = ( $new['edit_notes_permissions'] == 0 ) ? 'checked="checked"' : '';
// End Edit Notes MOD

$template->set_filenames(array(
"body" => "admin/board_config_body.tpl")
);

//
// Escape any quotes in the site description for proper display in the text
// box on the admin page 
//
$new['site_desc'] = str_replace('"', '&quot;', $new['site_desc']);
$new['sitename'] = str_replace('"', '&quot;', strip_tags($new['sitename']));
$new['registration_closed'] = str_replace('"', '&quot;', $new['registration_closed']);
$template->assign_vars(array(
"S_CONFIG_ACTION" => append_sid("admin_board.$phpEx"),

"L_YES" => $lang['Yes'],
"L_NO" => $lang['No'],

"L_SHOW_MOD_LIST" => $lang['show_mod_list'],
"SHOW_MOD_LIST_YES" => $show_mod_list_yes,
"SHOW_MOD_LIST_NO" => $show_mod_list_no,

// Default Avatar MOD, By Manipe (Begin)
"L_DEFAULT_AVATAR" => $lang['Default_avatar'],
"L_DEFAULT_AVATAR_EXPLAIN" => $lang['Default_avatar_explain'],
"L_DEFAULT_AVATAR_GUESTS" => $lang['Default_avatar_guests'],
"L_DEFAULT_AVATAR_USERS" => $lang['Default_avatar_users'],
"L_DEFAULT_AVATAR_BOTH" => $lang['Default_avatar_both'],
"L_DEFAULT_AVATAR_NONE" => $lang['Default_avatar_none'],
// Default Avatar MOD, By Manipe (End)
"L_CONFIGURATION_TITLE" => $lang['General_Config'],
"L_CONFIGURATION_EXPLAIN" => $lang['Config_explain'],
"L_GENERAL_SETTINGS" => $lang['General_settings'],
"L_SERVER_NAME" => $lang['Server_name'], 
"L_SERVER_NAME_EXPLAIN" => $lang['Server_name_explain'], 
"L_SERVER_PORT" => $lang['Server_port'], 
"L_SERVER_PORT_EXPLAIN" => $lang['Server_port_explain'], 
"L_SCRIPT_PATH" => $lang['Script_path'], 
"L_SCRIPT_PATH_EXPLAIN" => $lang['Script_path_explain'], 
"L_VERSION" => $lang['Version'],
"L_SITE_NAME" => $lang['Site_name'],
"L_SITE_DESCRIPTION" => $lang['Site_desc'],
"L_DISABLE_BOARD" => $lang['Board_disable'], 
"L_DISABLE_BOARD_EXPLAIN" => $lang['Board_disable_explain'],
"L_DISABLE_BOARD_MSG" => $lang['Board_disable_msg'], 
"L_DISABLE_BOARD_MSG_EXPLAIN" => $lang['Board_disable_msg_explain'],
"L_REGISTRATION_STATUS" => $lang['registration_status'],
"L_REGISTRATION_STATUS_EXPLAIN" => $lang['registration_status_explain'],
"L_REGISTRATION_CLOSED" => $lang['registration_closed'],
"L_REGISTRATION_CLOSED_EXPLAIN" => $lang['registration_closed_explain'],
"L_ACCT_ACTIVATION" => $lang['Acct_activation'],
"L_NONE" => $lang['Acc_None'],
"L_USER" => $lang['Acc_User'], 
"L_ADMIN" => $lang['Acc_Admin'], 
"L_VISUAL_CONFIRM" => $lang['Visual_confirm'], 
"L_VISUAL_CONFIRM_EXPLAIN" => $lang['Visual_confirm_explain'], 
"L_ALLOW_AUTOLOGIN" => $lang['Allow_autologin'],
"L_ALLOW_AUTOLOGIN_EXPLAIN" => $lang['Allow_autologin_explain'],
"L_AUTOLOGIN_TIME" => $lang['Autologin_time'],
"L_AUTOLOGIN_TIME_EXPLAIN" => $lang['Autologin_time_explain'],
"L_LIVE_EMAIL_VALIDATION_TITLE" => $lang['Live_email_validation_title'],
"L_COOKIE_SETTINGS_EXPLAIN" => $lang['Cookie_settings_explain'],
"L_COOKIE_DOMAIN" => $lang['Cookie_domain'],
"L_COOKIE_NAME" => $lang['Cookie_name'], 
"L_COOKIE_PATH" => $lang['Cookie_path'], 
"L_COOKIE_SECURE" => $lang['Cookie_secure'], 
"L_COOKIE_SECURE_EXPLAIN" => $lang['Cookie_secure_explain'], 
"L_SESSION_LENGTH" => $lang['Session_length'], 
"L_PRIVATE_MESSAGING" => $lang['Private_Messaging'], 
"L_INBOX_LIMIT" => $lang['Inbox_limits'], 
"L_SENTBOX_LIMIT" => $lang['Sentbox_limits'], 
"L_SAVEBOX_LIMIT" => $lang['Savebox_limits'], 
"L_DISABLE_PRIVATE_MESSAGING" => $lang['Disable_privmsg'], 
"L_ENABLED" => $lang['Enabled'], 
"L_DISABLED" => $lang['Disabled'], 
"L_ABILITIES_SETTINGS" => $lang['Abilities_settings'],
"L_MAX_POLL_OPTIONS" => $lang['Max_poll_options'],
"L_FLOOD_INTERVAL" => $lang['Flood_Interval'],
"L_FLOOD_INTERVAL_EXPLAIN" => $lang['Flood_Interval_explain'],
"L_TOPIC_FLOOD_INTERVAL" => $lang['Topic_Flood_Interval'],
"L_TOPIC_FLOOD_INTERVAL_EXPLAIN" => $lang['Topic_Flood_Interval_explain'],
"L_SEARCH_FLOOD_INTERVAL" => $lang['Search_Flood_Interval'],
"L_SEARCH_FLOOD_INTERVAL_EXPLAIN" => $lang['Search_Flood_Interval_explain'], 


'L_MAX_LOGIN_ATTEMPTS'=> $lang['Max_login_attempts'],
'L_MAX_LOGIN_ATTEMPTS_EXPLAIN'=> $lang['Max_login_attempts_explain'],
'L_LOGIN_RESET_TIME'=> $lang['Login_reset_time'],
'L_LOGIN_RESET_TIME_EXPLAIN'=> $lang['Login_reset_time_explain'],
'MAX_LOGIN_ATTEMPTS'=> $new['max_login_attempts'],
'LOGIN_RESET_TIME'=> $new['login_reset_time'],

"L_BOARD_EMAIL_FORM" => $lang['Board_email_form'], 
"L_BOARD_EMAIL_FORM_EXPLAIN" => $lang['Board_email_form_explain'],
"L_TOPICS_PER_PAGE" => $lang['Topics_per_page'],
"L_POSTS_PER_PAGE" => $lang['Posts_per_page'],
"L_HOT_THRESHOLD" => $lang['Hot_threshold'],
"L_DEFAULT_STYLE" => $lang['Default_style'],
"L_OVERRIDE_STYLE" => $lang['Override_style'],
"L_OVERRIDE_STYLE_EXPLAIN" => $lang['Override_style_explain'],
"L_FORUM_WIDTH" => $lang['Forum_width'],
"L_FORUM_WIDTH_EXPLAIN" => $lang['Forum_width_explain'],
"L_DEFAULT_LANGUAGE" => $lang['Default_language'],
"L_DATE_FORMAT" => $lang['Date_format'],
"L_SYSTEM_TIMEZONE" => $lang['System_timezone'],
"L_ENABLE_GZIP" => $lang['Enable_gzip'],
"L_ENABLE_PRUNE" => $lang['Enable_prune'],
"L_ALLOW_HTML" => $lang['Allow_HTML'],
"L_ALLOW_BBCODE" => $lang['Allow_BBCode'],
"L_ALLOWED_TAGS" => $lang['Allowed_tags'],
"L_ALLOWED_TAGS_EXPLAIN" => $lang['Allowed_tags_explain'],
"L_ALLOW_SMILIES" => $lang['Allow_smilies'],
"L_SMILIES_PATH" => $lang['Smilies_path'],
"L_SMILIES_PATH_EXPLAIN" => $lang['Smilies_path_explain'],
"L_ALLOW_SIG" => $lang['Allow_sig'],
"L_MAX_SIG_LENGTH" => $lang['Max_sig_length'],
"L_MAX_SIG_LENGTH_EXPLAIN" => $lang['Max_sig_length_explain'],
"L_ALLOW_MODS_BAN" => $lang['allow_mods_ban'],
"L_HIDE_LINKS" => $lang['hide_links'],
"L_SHOW_SEARCH_BOTS" => $lang['show_search_bots'],
"L_TOPIC_PAGE_ON_TOP" => $lang['topic_page_on_top'],
"L_SHOW_USER_ONLINE_TODAY" => $lang['show_user_online_today'],
"L_ADMIN_MESSAGE_SAVE_FROM_MODS" => $lang['admin_message_save_from_mods'],
"L_ICON_MOD_OPEN" => $lang['Icon_mod_open'],
"L_BASIT_SEO_OPEN" => $lang['Basit_seo_open'],
"L_ALLOW_AUTOMAT" => $lang['Allow_automat'],
"L_ALLOW_AUTOMAT_DESC" => $lang['Allow_automat_desc'],
"L_LOGIN_FOR_PROFILE" => $lang['Login_for_profile'],
"L_LOGIN_FOR_MEMBERLIST" => $lang['Login_for_memberlist'],
"L_LOGIN_FOR_WHOISONLINE" => $lang['Login_for_whoisonline'],
"L_MAX_SIG_IMAGES_LIMIT" => $lang['Max_sig_images_limit'],
"L_MAX_SIG_IMAGES_SIZE" => $lang['Max_sig_images_size'],
"L_MAX_SIG_IMAGES_SIZE_EXPLAIN" => $lang['Max_sig_images_explain'],
"L_ALLOW_NAME_CHANGE" => $lang['Allow_name_change'],

"L_AVATAR_SETTINGS" => $lang['Avatar_settings'],
"L_ALLOW_LOCAL" => $lang['Allow_local'],
"L_ALLOW_REMOTE" => $lang['Allow_remote'],
"L_ALLOW_REMOTE_EXPLAIN" => $lang['Allow_remote_explain'],
"L_ALLOW_UPLOAD" => $lang['Allow_upload'],
"L_MAX_FILESIZE" => $lang['Max_filesize'],
"L_MAX_FILESIZE_EXPLAIN" => $lang['Max_filesize_explain'],
"L_MAX_AVATAR_SIZE" => $lang['Max_avatar_size'],
"L_MAX_AVATAR_SIZE_EXPLAIN" => $lang['Max_avatar_size_explain'],
"L_AVATAR_STORAGE_PATH" => $lang['Avatar_storage_path'],
"L_AVATAR_STORAGE_PATH_EXPLAIN" => $lang['Avatar_storage_path_explain'],
"L_AVATAR_GALLERY_PATH" => $lang['Avatar_gallery_path'],
"L_AVATAR_GALLERY_PATH_EXPLAIN" => $lang['Avatar_gallery_path_explain'],
"L_COPPA_SETTINGS" => $lang['COPPA_settings'],
"L_COPPA_FAX" => $lang['COPPA_fax'],
"L_COPPA_MAIL" => $lang['COPPA_mail'],
"L_COPPA_MAIL_EXPLAIN" => $lang['COPPA_mail_explain'],
"L_EMAIL_SETTINGS" => $lang['Email_settings'],
"L_ADMIN_EMAIL" => $lang['Admin_email'],
"L_EMAIL_SIG" => $lang['Email_sig'],
"L_EMAIL_SIG_EXPLAIN" => $lang['Email_sig_explain'],
"L_USE_SMTP" => $lang['Use_SMTP'],
"L_USE_SMTP_EXPLAIN" => $lang['Use_SMTP_explain'],
"L_SMTP_SERVER" => $lang['SMTP_server'], 
"L_SMTP_USERNAME" => $lang['SMTP_username'], 
"L_SMTP_USERNAME_EXPLAIN" => $lang['SMTP_username_explain'], 
"L_SMTP_PASSWORD" => $lang['SMTP_password'], 
"L_SMTP_PASSWORD_EXPLAIN" => $lang['SMTP_password_explain'],
// Start Edit Notes MOD
'L_EDIT_NOTES_SETTINGS' => $lang['Edit_notes_settings'],
'L_EDIT_NOTES_SETTINGS_EXPLAIN' => $lang['Edit_notes_settings'],
'L_EDIT_NOTES_ENABLE' => $lang['Edit_notes_enable'],
'L_EDIT_NOTES_ENABLE_EXPLAIN' => $lang['Edit_notes_enable_explain'],
'L_MAX_EDIT_NOTES' => $lang['Max_edit_notes'],
'L_MAX_EDIT_NOTES_EXPLAIN' => $lang['Max_edit_notes_explain'],
'L_EDIT_NOTES_PERMISSIONS' => $lang['Edit_notes_permissions'],
'L_EDIT_NOTES_PERMISSIONS_EXPLAIN' => $lang['Edit_notes_permissions_explain'],
'L_EDIT_NOTES_ADMIN' => $lang['Edit_notes_admin'],
'L_EDIT_NOTES_STAFF' => $lang['Edit_notes_staff'],
'L_EDIT_NOTES_REG' => $lang['Edit_notes_reg'],
'L_EDIT_NOTES_ALL' => $lang['Edit_notes_all'],
// End Edit Notes MOD
"L_SUBMIT" => $lang['Submit'],
"L_RESET" => $lang['Reset'],

	// ---[+]---- site meta keywords ----
	"L_SITE_KEYWORDS" => $lang['Site_keywords'],
	"L_SITE_KEYWORDS_EXPLAIN" => $lang['Site_keywords_explain'],
	"SITE_KEYWORDS" => $new['site_keywords'],
	"KEYWORDS_LEN" => $lang['keyword_len_explain'],
	// ---[-]---- site meta keywords ----

// --- [+]---- BANTRON EXTRA + RSS ----
"L_BANTRON_BAN_RANK" => $lang['Bantron_ban_rank'],
"L_BANTRON_BAN_RANK_EXPLAIN" => $lang['Bantron_ban_rank_explain'],
"BANTRON_BAN_RANK" => $new['Bantron_ban_rank'],
"L_BANTRON_BAN_COLOR" => $lang['Bantron_ban_color'],
"L_BANTRON_BAN_COLOR_EXPLAIN" => $lang['Bantron_ban_color_explain'],
"BANTRON_BAN_COLOR" => $new['Bantron_ban_color'],
"L_RSS_COUNT" => $lang['Rss_count'],
"L_RSS_COUNT_EXPLAIN" => $lang['Rss_count_explain'],
"RSS_COUNT" => $new['Rss_count'],
// --- [-]---- BANTRON EXTRA + RSS ----

// Start add - Bin Mod
"L_BIN_FORUM" => $lang['Bin_forum'],
"L_BIN_FORUM_EXPLAIN" => $lang['Bin_forum_explain'],
"BIN_FORUM" => $new['bin_forum'],
// End add - Bin Mod

"SERVER_NAME" => $new['server_name'], 
"SCRIPT_PATH" => $new['script_path'], 
"SERVER_PORT" => $new['server_port'], 
"VERSION" => $new['version'],
"SITENAME" => $new['sitename'],
"SITE_DESCRIPTION" => $new['site_desc'], 
"S_DISABLE_BOARD_YES" => $disable_board_yes,
"S_DISABLE_BOARD_NO" => $disable_board_no,
// Default avatar MOD, By Manipe (Begin)
"DEFAULT_AVATAR_GUESTS_URL" => $new['default_avatar_guests_url'],
"DEFAULT_AVATAR_USERS_URL" => $new['default_avatar_users_url'],
"DEFAULT_AVATAR_GUESTS" => $default_avatar_guests,
"DEFAULT_AVATAR_USERS" => $default_avatar_users,
"DEFAULT_AVATAR_BOTH" => $default_avatar_both,
"DEFAULT_AVATAR_NONE" => $default_avatar_none,
// Default avatar MOD, By Manipe (End)
"DISABLE_BOARD_MSG" => $new['board_disable_msg'],
"S_REGISTRATION_STATUS_YES" => $registration_status_yes,
"S_REGISTRATION_STATUS_NO" => $registration_status_no,
"REGISTRATION_CLOSED" => $new['registration_closed'],
"ACTIVATION_NONE" => USER_ACTIVATION_NONE,
"ACTIVATION_NONE_CHECKED" => $activation_none,
"ACTIVATION_USER" => USER_ACTIVATION_SELF, 
"ACTIVATION_USER_CHECKED" => $activation_user,
"ACTIVATION_ADMIN" => USER_ACTIVATION_ADMIN, 
"ACTIVATION_ADMIN_CHECKED" => $activation_admin, 
"CONFIRM_ENABLE" => $confirm_yes,
"CONFIRM_DISABLE" => $confirm_no,
'ALLOW_AUTOLOGIN_YES' => $allow_autologin_yes,
'ALLOW_AUTOLOGIN_NO' => $allow_autologin_no,
'AUTOLOGIN_TIME' => (int) $new['max_autologin_time'],
"BOARD_EMAIL_FORM_ENABLE" => $board_email_form_yes, 
"BOARD_EMAIL_FORM_DISABLE" => $board_email_form_no, 
"MAX_POLL_OPTIONS" => $new['max_poll_options'], 
"FLOOD_INTERVAL" => $new['flood_interval'],
"SEARCH_FLOOD_INTERVAL" => $new['search_flood_interval'],
"FORUM_WIDTH" => $new['forum_width'],
"TOPIC_FLOOD_INTERVAL" => $new['topic_flood_interval'],
"TOPICS_PER_PAGE" => $new['topics_per_page'],
"POSTS_PER_PAGE" => $new['posts_per_page'],
"HOT_TOPIC" => $new['hot_threshold'],
"STYLE_SELECT" => $style_select,
"OVERRIDE_STYLE_YES" => $override_user_style_yes,
"OVERRIDE_STYLE_NO" => $override_user_style_no,
"LANG_SELECT" => $lang_select,
"L_DATE_FORMAT_EXPLAIN" => $lang['Date_format_explain'],
"DEFAULT_DATEFORMAT" => admin_date_format_select($new['default_dateformat'], $timezone_select),
"TIMEZONE_SELECT" => $timezone_select,
"S_PRIVMSG_ENABLED" => $privmsg_on,
"S_PRIVMSG_DISABLED" => $privmsg_off, 
"INBOX_LIMIT" => $new['max_inbox_privmsgs'], 
"SENTBOX_LIMIT" => $new['max_sentbox_privmsgs'],
"SAVEBOX_LIMIT" => $new['max_savebox_privmsgs'],
"COOKIE_DOMAIN" => $new['cookie_domain'], 
"COOKIE_NAME" => $new['cookie_name'], 
"COOKIE_PATH" => $new['cookie_path'], 
"SESSION_LENGTH" => $new['session_length'],
"LIVE_EMAIL_VALIDATION_YES" => $live_email_validation_yes,
"LIVE_EMAIL_VALIDATION_NO" => $live_email_validation_no,
"S_COOKIE_SECURE_ENABLED" => $cookie_secure_yes,
"S_COOKIE_SECURE_DISABLED" => $cookie_secure_no, 
"GZIP_YES" => $gzip_yes,
"GZIP_NO" => $gzip_no,
"PRUNE_YES" => $prune_yes,
"PRUNE_NO" => $prune_no,
"HTML_TAGS" => $html_tags, 
"HTML_YES" => $html_yes,
"HTML_NO" => $html_no,
"BBCODE_YES" => $bbcode_yes,
"BBCODE_NO" => $bbcode_no,
"SMILE_YES" => $smile_yes,
"SMILE_NO" => $smile_no,
"SIG_YES" => $sig_yes,
"SIG_NO" => $sig_no,
"SIG_SIZE" => $new['max_sig_chars'],
"SIG_IMAGES_MAX_LIMIT" => $new['sig_images_max_limit'],
"SIG_IMAGES_MAX_HEIGHT" => $new['sig_images_max_height'],
"SIG_IMAGES_MAX_WIDTH" => $new['sig_images_max_width'],
"SHOW_USER_ONLINE_TODAY_YES" => $show_user_online_today_yes,
"SHOW_USER_ONLINE_TODAY_NO" => $show_user_online_today_no,
"NAMECHANGE_YES" => $namechange_yes,
"NAMECHANGE_NO" => $namechange_no,
"ALLOW_MODS_BAN_YES" => $allow_mods_ban_yes,
"ALLOW_MODS_BAN_NO" => $allow_mods_ban_no,
"HIDE_LINKS_YES" => $hide_links_yes,
"HIDE_LINKS_NO" => $hide_links_no,
"SHOW_SEARCH_BOTS_YES" => $show_search_bots_yes,
"SHOW_SEARCH_BOTS_NO" => $show_search_bots_no,
"TOPIC_PAGE_ON_TOP_YES" => $topic_page_on_top_yes,
"TOPIC_PAGE_ON_TOP_NO" => $topic_page_on_top_no,
"ADMIN_MESSAGE_SAVE_FROM_MODS_YES" => $admin_message_save_from_mods_yes,
"ADMIN_MESSAGE_SAVE_FROM_MODS_NO" => $admin_message_save_from_mods_no,
"ICON_MOD_OPEN_YES" => $icon_mod_open_yes,
"ICON_MOD_OPEN_NO" => $icon_mod_open_no,
"BASIT_SEO_OPEN_YES" => $basit_seo_open_yes,
"BASIT_SEO_OPEN_NO" => $basit_seo_open_no,
"ALLOW_AUTOMAT_YES" => $allow_automat_yes,
"ALLOW_AUTOMAT_NO" => $allow_automat_no,
"LOGIN_FOR_PROFILE_YES" => $login_for_profile_yes,
"LOGIN_FOR_PROFILE_NO" => $login_for_profile_no,
"LOGIN_FOR_MEMBERLIST_YES" => $login_for_memberlist_yes,
"LOGIN_FOR_MEMBERLIST_NO" => $login_for_memberlist_no,
"LOGIN_FOR_WHOISONLINE_YES" => $login_for_whoisonline_yes,
"LOGIN_FOR_WHOISONLINE_NO" => $login_for_whoisonline_no,

"AVATARS_LOCAL_YES" => $avatars_local_yes,
"AVATARS_LOCAL_NO" => $avatars_local_no,
"AVATARS_REMOTE_YES" => $avatars_remote_yes,
"AVATARS_REMOTE_NO" => $avatars_remote_no,
"AVATARS_UPLOAD_YES" => $avatars_upload_yes,
"AVATARS_UPLOAD_NO" => $avatars_upload_no,
"AVATAR_FILESIZE" => $new['avatar_filesize'],
"AVATAR_MAX_HEIGHT" => $new['avatar_max_height'],
"AVATAR_MAX_WIDTH" => $new['avatar_max_width'],
"AVATAR_PATH" => $new['avatar_path'], 
"AVATAR_GALLERY_PATH" => $new['avatar_gallery_path'], 
"SMILIES_PATH" => $new['smilies_path'], 
"INBOX_PRIVMSGS" => $new['max_inbox_privmsgs'], 
"SENTBOX_PRIVMSGS" => $new['max_sentbox_privmsgs'], 
"SAVEBOX_PRIVMSGS" => $new['max_savebox_privmsgs'], 
"EMAIL_FROM" => $new['board_email'],
"EMAIL_SIG" => $new['board_email_sig'],
"SMTP_YES" => $smtp_yes,
"SMTP_NO" => $smtp_no,
"SMTP_HOST" => $new['smtp_host'],
"SMTP_USERNAME" => $new['smtp_username'],
"SMTP_PASSWORD" => $new['smtp_password'],
// Start Edit Notes MOD
'EDIT_NOTES_ENABLE' => $edit_notes_enable,
'EDIT_NOTES_DISABLE' => $edit_notes_disable,
'MAX_EDIT_NOTES' => $max_edit_notes,
'EDIT_NOTES_ADMIN' => $edit_notes_admin,
'EDIT_NOTES_STAFF' => $edit_notes_staff,
'EDIT_NOTES_REG' => $edit_notes_reg,
'EDIT_NOTES_ALL' => $edit_notes_all,
// End Edit Notes MOD
"COPPA_MAIL" => $new['coppa_mail'],
"COPPA_FAX" => $new['coppa_fax'])
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>