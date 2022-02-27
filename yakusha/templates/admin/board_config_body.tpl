<h1>{L_CONFIGURATION_TITLE}</h1>

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<tr>
<th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
</tr>
<tr>
<td width="60%" class="row1">{L_SERVER_NAME}</td>
<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="server_name" value="{SERVER_NAME}" /></td>
</tr>
<tr>
<td class="row1">{L_SERVER_PORT}<br /><span class="gensmall">{L_SERVER_PORT_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" maxlength="5" size="5" name="server_port" value="{SERVER_PORT}" /></td>
</tr>
<tr>
<td class="row1">{L_SCRIPT_PATH}<br /><span class="gensmall">{L_SCRIPT_PATH_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" maxlength="255" name="script_path" value="{SCRIPT_PATH}" /></td>
</tr>
<tr> 
<td class="row1">{L_VERSION}</td> 
<td class="row2"><input class="post" type="text" name="version" size="5" maxlength="5" value="{VERSION}" /></td> 
</tr>
<tr>
<td class="row1">{L_SITE_NAME}<br /><span class="gensmall">{L_SITE_NAME_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="sitename" value="{SITENAME}" /></td>
</tr>
<tr>
<td class="row1">{L_SITE_DESCRIPTION}</td>
<td class="row2"><input class="post" type="text" size="40" maxlength="255" name="site_desc" value="{SITE_DESCRIPTION}" /></td>
</tr>
<tr>
<td class="row1">
<span class="genmed">{L_SITE_KEYWORDS}</span><br />
<span class="gensmall">{L_SITE_KEYWORDS_EXPLAIN}</span><br />
</td>
<td class="row2">
<script language="JavaScript" type="text/javascript">
<!--
// backported from underhill signatureCounter mods
function signatureCounter(field, countfield, maxlimit)
{
	if (field.value.length > maxlimit)
	{
		field.value = field.value.substring(0, maxlimit);
	}
	else
	{ 
		countfield.value = maxlimit - field.value.length;
	}
}
//-->
</script>
<textarea name="site_keywords" rows="5" cols="40"  wrap="virtual" onKeyDown="signatureCounter(this.form.site_keywords, this.form.signatureLen, 255);" onKeyUp="signatureCounter(this.form.site_keywords, this.form.signatureLen, 255);">{SITE_KEYWORDS}</textarea>
<input class="post" readonly="readonly" type="text" name="signatureLen" size="3" maxlength="3" style="text-align:center;" value="{255}" /> {KEYWORDS_LEN} </td>
</tr>
<tr>
<td class="row1">{L_DISABLE_BOARD}<br /><span class="gensmall">{L_DISABLE_BOARD_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="board_disable" value="1" {S_DISABLE_BOARD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="board_disable" value="0" {S_DISABLE_BOARD_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_DISABLE_BOARD_MSG}<br /><span class="gensmall">{L_DISABLE_BOARD_MSG_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" maxlength="255" size="40" name="board_disable_msg" value="{DISABLE_BOARD_MSG}" /></td></td>
</tr>
<tr>
<td class="row1">{L_REGISTRATION_STATUS}<br /><span class="gensmall">{L_REGISTRATION_STATUS_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="registration_status" value="1" {S_REGISTRATION_STATUS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="registration_status" value="0" {S_REGISTRATION_STATUS_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_REGISTRATION_CLOSED}<br /><span class="gensmall">{L_REGISTRATION_CLOSED_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="40" maxlength="255" name="registration_closed" value="{REGISTRATION_CLOSED}" /></td>
</tr>
<tr>
<td class="row1">{L_ACCT_ACTIVATION}</td>
<td class="row2"><input type="radio" name="require_activation" value="{ACTIVATION_NONE}" {ACTIVATION_NONE_CHECKED} />{L_NONE}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_USER}" {ACTIVATION_USER_CHECKED} />{L_USER}&nbsp; &nbsp;<input type="radio" name="require_activation" value="{ACTIVATION_ADMIN}" {ACTIVATION_ADMIN_CHECKED} />{L_ADMIN}</td>
</tr>
<tr>
<td class="row1">{L_LIVE_EMAIL_VALIDATION_TITLE}</td>
<td class="row2"><input type="radio" name="live_email_validation" value="1" {LIVE_EMAIL_VALIDATION_YES} /> {L_YES}&nbsp; &nbsp;<input type="radio" name="live_email_validation" value="0" {LIVE_EMAIL_VALIDATION_NO} />{L_NO}</td>
</tr>
<tr>
<td class="row1">{L_VISUAL_CONFIRM}<br /><span class="gensmall">{L_VISUAL_CONFIRM_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="enable_confirm" value="1" {CONFIRM_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="enable_confirm" value="0" {CONFIRM_DISABLE} />{L_NO}</td>
</tr>

<tr>
<td class="row1">{L_ENABLE_GZIP}</td>
<td class="row2"><input type="radio" name="gzip_compress" value="1" {GZIP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="gzip_compress" value="0" {GZIP_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ENABLE_PRUNE}</td>
<td class="row2"><input type="radio" name="prune_enable" value="1" {PRUNE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="prune_enable" value="0" {PRUNE_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ALLOW_AUTOLOGIN}<br /><span class="gensmall">{L_ALLOW_AUTOLOGIN_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="allow_autologin" value="1" {ALLOW_AUTOLOGIN_YES} />{L_YES}&nbsp; &nbsp;<input type="radio" name="allow_autologin" value="0" {ALLOW_AUTOLOGIN_NO} />{L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ALLOW_NAME_CHANGE}</td>
<td class="row2"><input type="radio" name="allow_namechange" value="1" {NAMECHANGE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_namechange" value="0" {NAMECHANGE_NO} /> {L_NO}</td>
</tr>
<tr>
<th class="thHead" colspan="2">-- Selects --</th>
</tr>
<tr>
<td class="row1">{L_ALLOW_MODS_BAN}</td>
<td class="row2"><input type="radio" name="allow_mods_ban" value="1" {ALLOW_MODS_BAN_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_mods_ban" value="0" {ALLOW_MODS_BAN_NO} /> {L_NO}</td>
</tr>

<tr>
<td class="row1">{L_HIDE_LINKS}</td>
<td class="row2"><input type="radio" name="hide_links" value="1" {HIDE_LINKS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="hide_links" value="0" {HIDE_LINKS_NO} /> {L_NO}</td>
</tr>

<tr>
<td class="row1">{L_SHOW_SEARCH_BOTS}</td>
<td class="row2"><input type="radio" name="show_search_bots" value="1" {SHOW_SEARCH_BOTS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="show_search_bots" value="0" {SHOW_SEARCH_BOTS_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_TOPIC_PAGE_ON_TOP}</td>
<td class="row2"><input type="radio" name="topic_page_on_top" value="1" {TOPIC_PAGE_ON_TOP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="topic_page_on_top" value="0" {TOPIC_PAGE_ON_TOP_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_SHOW_USER_ONLINE_TODAY}</td>
<td class="row2"><input type="radio" name="show_user_online_today" value="1" {SHOW_USER_ONLINE_TODAY_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="show_user_online_today" value="0" {SHOW_USER_ONLINE_TODAY_NO} />{L_NO}
</td>
</tr>
<tr>
<td class="row1">{L_ADMIN_MESSAGE_SAVE_FROM_MODS}</td>
<td class="row2"><input type="radio" name="admin_message_save_from_mods" value="1" {ADMIN_MESSAGE_SAVE_FROM_MODS_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="admin_message_save_from_mods" value="0" {ADMIN_MESSAGE_SAVE_FROM_MODS_NO} />{L_NO}
</td>
</tr>
<tr>
<td class="row1">{L_ALLOW_AUTOMAT} <br /><span class="gensmall">{L_ALLOW_AUTOMAT_DESC}</span></td>
<td class="row2"><input type="radio" name="allow_automat" value="1" {ALLOW_AUTOMAT_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_automat" value="0" {ALLOW_AUTOMAT_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_BASIT_SEO_OPEN}</td>
<td class="row2"><input type="radio" name="basit_seo_open" value="1" {BASIT_SEO_OPEN_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="basit_seo_open" value="0" {BASIT_SEO_OPEN_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_SHOW_MOD_LIST}</td>
<td class="row2"><input type="radio" name="show_mod_list" value="1" {SHOW_MOD_LIST_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="show_mod_list" value="0" {SHOW_MOD_LIST_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ICON_MOD_OPEN}</td>
<td class="row2"><input type="radio" name="icon_mod_open" value="1" {ICON_MOD_OPEN_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="icon_mod_open" value="0" {ICON_MOD_OPEN_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_LOGIN_FOR_PROFILE}</td>
<td class="row2"><input type="radio" name="allow_login_for_profile" value="1" {LOGIN_FOR_PROFILE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_login_for_profile" value="0" {LOGIN_FOR_PROFILE_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_LOGIN_FOR_MEMBERLIST}</td>
<td class="row2"><input type="radio" name="allow_login_for_memberlist" value="1" {LOGIN_FOR_MEMBERLIST_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_login_for_memberlist" value="0" {LOGIN_FOR_MEMBERLIST_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_LOGIN_FOR_WHOISONLINE}</td>
<td class="row2"><input type="radio" name="allow_login_for_whoisonline" value="1" {LOGIN_FOR_WHOISONLINE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_login_for_whoisonline" value="0" {LOGIN_FOR_WHOISONLINE_NO} /> {L_NO}</td>
</tr>
<tr>
<th class="thHead" colspan="2">-- inputs --</th>
<tr>
<td class="row1">{L_FORUM_WIDTH}<br /><span class="gensmall">{L_FORUM_WIDTH_EXPLAIN}</span></td>
<td class="row2">
<input class="post" type="text" size="6" maxlength="4" name="forum_width" value="{FORUM_WIDTH}" /></td>
</tr>
<tr>
<td class="row1">{L_AUTOLOGIN_TIME} <br /><span class="gensmall">{L_AUTOLOGIN_TIME_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="max_autologin_time" value="{AUTOLOGIN_TIME}" /></td>
</tr>
<tr>
<td class="row1">{L_FLOOD_INTERVAL} <br /><span class="gensmall">{L_FLOOD_INTERVAL_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="flood_interval" value="{FLOOD_INTERVAL}" /></td>
</tr>
<tr>
<td class="row1">{L_TOPIC_FLOOD_INTERVAL} <br /><span class="gensmall">{L_TOPIC_FLOOD_INTERVAL_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="topic_flood_interval" value="{TOPIC_FLOOD_INTERVAL}" /></td>
</tr>
<tr>
<td class="row1">{L_SEARCH_FLOOD_INTERVAL} <br /><span class="gensmall">{L_SEARCH_FLOOD_INTERVAL_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="search_flood_interval" value="{SEARCH_FLOOD_INTERVAL}" /></td>
</tr>
<tr>
<td class="row1">{L_MAX_LOGIN_ATTEMPTS}<br /><span class="gensmall">{L_MAX_LOGIN_ATTEMPTS_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="max_login_attempts" value="{MAX_LOGIN_ATTEMPTS}" /></td>
</tr>
<tr>
<td class="row1">{L_LOGIN_RESET_TIME}<br /><span class="gensmall">{L_LOGIN_RESET_TIME_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="login_reset_time" value="{LOGIN_RESET_TIME}" /></td>
</tr>
<tr>
<td class="row1">{L_TOPICS_PER_PAGE}</td>
<td class="row2"><input class="post" type="text" name="topics_per_page" size="3" maxlength="4" value="{TOPICS_PER_PAGE}" /></td>
</tr>
<tr>
<td class="row1">{L_POSTS_PER_PAGE}</td>
<td class="row2"><input class="post" type="text" name="posts_per_page" size="3" maxlength="4" value="{POSTS_PER_PAGE}" /></td>
</tr>
<tr>
<td class="row1">{L_HOT_THRESHOLD}</td>
<td class="row2"><input class="post" type="text" name="hot_threshold" size="3" maxlength="4" value="{HOT_TOPIC}" /></td>
</tr>
<tr>
<td class="row1">
<span class="genmed">{L_BIN_FORUM}</span><br />
<span class="gensmall">{L_BIN_FORUM_EXPLAIN}</span><br />
</td>
<td class="row2"><input type="text" class="post" name="bin_forum" size="4" maxlength="4" value="{BIN_FORUM}" /></td>
</tr>
<tr>
<td class="row1">
<span class="genmed">{L_BANTRON_BAN_RANK}</span><br />
<span class="gensmall">{L_BANTRON_BAN_RANK_EXPLAIN}</span><br />
</td>
<td class="row2"><input type="text" class="post" name="Bantron_ban_rank" size="4" maxlength="4" value="{BANTRON_BAN_RANK}" /></td>
</tr>
<tr>
<td class="row1">
<span class="genmed">{L_BANTRON_BAN_COLOR}</span><br />
<span class="gensmall">{L_BANTRON_BAN_COLOR_EXPLAIN}</span><br />
</td>
<td class="row2"><input type="text" class="post" name="Bantron_ban_color" size="4" maxlength="4" value="{BANTRON_BAN_COLOR}" /></td>
</tr>
<tr>
<td class="row1">
<span class="genmed">{L_RSS_COUNT}</span><br />
<span class="gensmall">{L_RSS_COUNT_EXPLAIN}</span><br />
</td>
<td class="row2"><input type="text" class="post" name="Rss_count" size="4" maxlength="4" value="{RSS_COUNT}" /></td>
</tr>
<th colspan="2">---</th>
<tr>
<td class="row1">{L_DEFAULT_STYLE}</td>
<td class="row2">{STYLE_SELECT}</td>
</tr>
<tr>
<td class="row1">{L_OVERRIDE_STYLE}<br /><span class="gensmall">{L_OVERRIDE_STYLE_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="override_user_style" value="1" {OVERRIDE_STYLE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="override_user_style" value="0" {OVERRIDE_STYLE_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_DEFAULT_LANGUAGE}</td>
<td class="row2">{LANG_SELECT}</td>
</tr>
<tr>
<td class="row1">{L_DATE_FORMAT}</td>
<td class="row2"><span class="gensmall">{DEFAULT_DATEFORMAT}</span></td>
</tr>
<tr>
<td class="row1">{L_SYSTEM_TIMEZONE}</td>
<td class="row2">{TIMEZONE_SELECT}</td>
</tr>
<tr>
<th class="thHead" colspan="2">{L_COOKIE_SETTINGS}</th>
</tr>
<tr>
<td class="row2" colspan="2"><span class="gensmall">{L_COOKIE_SETTINGS_EXPLAIN}</span></td>
</tr>
<tr>
<td class="row1">{L_COOKIE_DOMAIN}</td>
<td class="row2"><input class="post" type="text" maxlength="255" name="cookie_domain" value="{COOKIE_DOMAIN}" /></td>
</tr>
<tr>
<td class="row1">{L_COOKIE_NAME}</td>
<td class="row2"><input class="post" type="text" maxlength="16" name="cookie_name" value="{COOKIE_NAME}" /></td>
</tr>
<tr>
<td class="row1">{L_COOKIE_PATH}</td>
<td class="row2"><input class="post" type="text" maxlength="255" name="cookie_path" value="{COOKIE_PATH}" /></td>
</tr>
<tr>
<td class="row1">{L_COOKIE_SECURE}<br /><span class="gensmall">{L_COOKIE_SECURE_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="cookie_secure" value="0" {S_COOKIE_SECURE_DISABLED} />{L_DISABLED}&nbsp; &nbsp;<input type="radio" name="cookie_secure" value="1" {S_COOKIE_SECURE_ENABLED} />{L_ENABLED}</td>
</tr>
<tr>
<td class="row1">{L_SESSION_LENGTH}</td>
<td class="row2"><input class="post" type="text" maxlength="5" size="5" name="session_length" value="{SESSION_LENGTH}" /></td>
</tr>
<tr>
<th class="thHead" colspan="2">{L_PRIVATE_MESSAGING}</th>
</tr>
<tr>
<td class="row1">{L_BOARD_EMAIL_FORM}<br /><span class="gensmall">{L_BOARD_EMAIL_FORM_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="board_email_form" value="1" {BOARD_EMAIL_FORM_ENABLE} /> {L_ENABLED}&nbsp;&nbsp;<input type="radio" name="board_email_form" value="0" {BOARD_EMAIL_FORM_DISABLE} /> {L_DISABLED}</td>
</tr>
<tr>
<td class="row1">{L_DISABLE_PRIVATE_MESSAGING}</td>
<td class="row2"><input type="radio" name="privmsg_disable" value="0" {S_PRIVMSG_ENABLED} />{L_ENABLED}&nbsp; &nbsp;<input type="radio" name="privmsg_disable" value="1" {S_PRIVMSG_DISABLED} />{L_DISABLED}</td>
</tr>
<tr>
<td class="row1">{L_INBOX_LIMIT}</td>
<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_inbox_privmsgs" value="{INBOX_LIMIT}" /></td>
</tr>
<tr>
<td class="row1">{L_SENTBOX_LIMIT}</td>
<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_sentbox_privmsgs" value="{SENTBOX_LIMIT}" /></td>
</tr>
<tr>
<td class="row1">{L_SAVEBOX_LIMIT}</td>
<td class="row2"><input class="post" type="text" maxlength="4" size="4" name="max_savebox_privmsgs" value="{SAVEBOX_LIMIT}" /></td>
</tr>
<tr>
<th class="thHead" colspan="2">{L_ABILITIES_SETTINGS}</th>
</tr>
<tr>
<td class="row1">{L_MAX_POLL_OPTIONS}</td>
<td class="row2"><input class="post" type="text" name="max_poll_options" size="4" maxlength="4" value="{MAX_POLL_OPTIONS}" /></td>
</tr>
<tr>
<td class="row1">{L_ALLOW_HTML}</td>
<td class="row2"><input type="radio" name="allow_html" value="1" {HTML_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_html" value="0" {HTML_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ALLOWED_TAGS}<br /><span class="gensmall">{L_ALLOWED_TAGS_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="30" maxlength="255" name="allow_html_tags" value="{HTML_TAGS}" /></td>
</tr>
<tr>
<td class="row1">{L_ALLOW_BBCODE}</td>
<td class="row2"><input type="radio" name="allow_bbcode" value="1" {BBCODE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_bbcode" value="0" {BBCODE_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ALLOW_SMILIES}</td>
<td class="row2"><input type="radio" name="allow_smilies" value="1" {SMILE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_smilies" value="0" {SMILE_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_SMILIES_PATH} <br /><span class="gensmall">{L_SMILIES_PATH_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="smilies_path" value="{SMILIES_PATH}" /></td>
</tr>
<tr>
<td class="row1">{L_ALLOW_SIG}</td>
<td class="row2"><input type="radio" name="allow_sig" value="1" {SIG_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_sig" value="0" {SIG_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_MAX_SIG_LENGTH}<br /><span class="gensmall">{L_MAX_SIG_LENGTH_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="5" maxlength="4" name="max_sig_chars" value="{SIG_SIZE}" /></td>
</tr>
<tr>
<td class="row1">{L_MAX_SIG_IMAGES_LIMIT} <br />
<span class="gensmall">{L_MAX_SIG_IMAGES_LIMIT_EXPLAIN}</span>
</td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="sig_images_max_limit" value="{SIG_IMAGES_MAX_LIMIT}" /></td>
</tr>
<tr>
<td class="row1">{L_MAX_SIG_IMAGES_SIZE} <br />
<span class="gensmall">{L_MAX_SIG_IMAGES_SIZE_EXPLAIN}</span>
</td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="sig_images_max_height" value="{SIG_IMAGES_MAX_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="sig_images_max_width" value="{SIG_IMAGES_MAX_WIDTH}" /></td>
</tr>

<tr>
<th class="thHead" colspan="2">{L_AVATAR_SETTINGS}</th>
</tr>
<tr>
<td class="row1">{L_ALLOW_LOCAL}</td>
<td class="row2"><input type="radio" name="allow_avatar_local" value="1" {AVATARS_LOCAL_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_local" value="0" {AVATARS_LOCAL_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ALLOW_REMOTE} <br /><span class="gensmall">{L_ALLOW_REMOTE_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="allow_avatar_remote" value="1" {AVATARS_REMOTE_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_remote" value="0" {AVATARS_REMOTE_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_ALLOW_UPLOAD}</td>
<td class="row2"><input type="radio" name="allow_avatar_upload" value="1" {AVATARS_UPLOAD_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="allow_avatar_upload" value="0" {AVATARS_UPLOAD_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_MAX_FILESIZE}<br /><span class="gensmall">{L_MAX_FILESIZE_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="8" maxlength="10" name="avatar_filesize" value="{AVATAR_FILESIZE}" /> Bytes</td>
</tr>
<tr>
<td class="row1">{L_MAX_AVATAR_SIZE} <br />
<span class="gensmall">{L_MAX_AVATAR_SIZE_EXPLAIN}</span>
</td>
<td class="row2"><input class="post" type="text" size="3" maxlength="4" name="avatar_max_height" value="{AVATAR_MAX_HEIGHT}" /> x <input class="post" type="text" size="3" maxlength="4" name="avatar_max_width" value="{AVATAR_MAX_WIDTH}"></td>
</tr>
<tr>
<td class="row1">{L_AVATAR_STORAGE_PATH} <br /><span class="gensmall">{L_AVATAR_STORAGE_PATH_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="avatar_path" value="{AVATAR_PATH}" /></td>
</tr>
<tr>
<td class="row1">{L_AVATAR_GALLERY_PATH} <br /><span class="gensmall">{L_AVATAR_GALLERY_PATH_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" size="20" maxlength="255" name="avatar_gallery_path" value="{AVATAR_GALLERY_PATH}" /></td>
</tr>
<tr>
<td class="row1">{L_DEFAULT_AVATAR} <br /><span class="gensmall">{L_DEFAULT_AVATAR_EXPLAIN}</span></td>
<td class="row2">
      &nbsp;<input type="radio" name="default_avatar_set" value="0" {DEFAULT_AVATAR_GUESTS} /> {L_DEFAULT_AVATAR_GUESTS} &nbsp;
       <br />&nbsp;<input class="post" type="text" name="default_avatar_guests_url" maxlength="255" size="40" value="{DEFAULT_AVATAR_GUESTS_URL}" /><br />
      &nbsp;<input type="radio" name="default_avatar_set" value="1" {DEFAULT_AVATAR_USERS} /> {L_DEFAULT_AVATAR_USERS} &nbsp;
        <br />&nbsp;<input class="post" type="text" name="default_avatar_users_url" maxlength="255" size="40" value="{DEFAULT_AVATAR_USERS_URL}" /><br />
      &nbsp;<input type="radio" name="default_avatar_set" value="2" {DEFAULT_AVATAR_BOTH} /> {L_DEFAULT_AVATAR_BOTH}<br />
      &nbsp;<input type="radio" name="default_avatar_set" value="3" {DEFAULT_AVATAR_NONE} /> {L_DEFAULT_AVATAR_NONE}</td>
</tr>
<!-- Start Edit Notes MOD -->
<tr>
<th class="thHead" colspan="2">{L_EDIT_NOTES_SETTINGS}</th>
</tr>
<tr>
<td class="row1" valign="top">{L_EDIT_NOTES_ENABLE}<br /><span class="gensmall">{L_EDIT_NOTES_ENABLE_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="edit_notes_enable" value="1" {EDIT_NOTES_ENABLE} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="edit_notes_enable" value="0" {EDIT_NOTES_DISABLE} /> {L_NO}</td>
</tr>
<tr>
<td class="row1" valign="top">{L_MAX_EDIT_NOTES}<br /><span class="gensmall">{L_MAX_EDIT_NOTES_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" name="max_edit_notes" value="{MAX_EDIT_NOTES}" size="2" maxlength="2" /></td>
</tr>
<tr>
<td class="row1" valign="top">{L_EDIT_NOTES_PERMISSIONS}<br /><span class="gensmall">{L_EDIT_NOTES_PERMISSIONS_EXPLAIN}</span></td>
<td class="row2" nowrap="nowrap">
<input type="radio" name="edit_notes_permissions" value="3" {EDIT_NOTES_ADMIN} />{L_EDIT_NOTES_ADMIN}<br />
<input type="radio" name="edit_notes_permissions" value="2" {EDIT_NOTES_STAFF} />{L_EDIT_NOTES_STAFF}<br />
<input type="radio" name="edit_notes_permissions" value="1" {EDIT_NOTES_REG} />{L_EDIT_NOTES_REG}<br />
<input type="radio" name="edit_notes_permissions" value="0" {EDIT_NOTES_ALL} />{L_EDIT_NOTES_ALL}
</td>
</tr>
<!-- End Edit Notes MOD -->
<tr>
<th class="thHead" colspan="2">{L_EMAIL_SETTINGS}</th>
</tr>
<tr>
<td class="row1">{L_ADMIN_EMAIL}</td>
<td class="row2"><input class="post" type="text" size="25" maxlength="100" name="board_email" value="{EMAIL_FROM}" /></td>
</tr>
<tr>
<td class="row1">{L_EMAIL_SIG}<br /><span class="gensmall">{L_EMAIL_SIG_EXPLAIN}</span></td>
<td class="row2"><textarea name="board_email_sig" rows="5" cols="40">{EMAIL_SIG}</textarea></td>
</tr>
<tr>
<td class="row1">{L_USE_SMTP}<br /><span class="gensmall">{L_USE_SMTP_EXPLAIN}</span></td>
<td class="row2"><input type="radio" name="smtp_delivery" value="1" {SMTP_YES} /> {L_YES}&nbsp;&nbsp;<input type="radio" name="smtp_delivery" value="0" {SMTP_NO} /> {L_NO}</td>
</tr>
<tr>
<td class="row1">{L_SMTP_SERVER}</td>
<td class="row2"><input class="post" type="text" name="smtp_host" value="{SMTP_HOST}" size="25" maxlength="50" /></td>
</tr>
<tr>
<td class="row1">{L_SMTP_USERNAME}<br /><span class="gensmall">{L_SMTP_USERNAME_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="text" name="smtp_username" value="{SMTP_USERNAME}" size="25" maxlength="255" /></td>
</tr>
<tr>
<td class="row1">{L_SMTP_PASSWORD}<br /><span class="gensmall">{L_SMTP_PASSWORD_EXPLAIN}</span></td>
<td class="row2"><input class="post" type="password" name="smtp_password" value="{SMTP_PASSWORD}" size="25" maxlength="255" /></td>
</tr>

<tr>
<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" />
</td>
</tr>
</table></form>

<br clear="all" />