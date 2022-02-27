<?php
/***************************************************************************
* page_header.php
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define('HEADER_INC', TRUE);

//---[+]---gzip_compression
$do_gzip_compress = FALSE;
if ( $board_config['gzip_compress'] )
{
	$phpver = phpversion();

	$useragent = (isset($_SERVER["HTTP_USER_AGENT"]) ) ? $_SERVER["HTTP_USER_AGENT"] : $HTTP_USER_AGENT;

	if ( $phpver >= '4.0.4pl1' && ( strstr($useragent,'compatible') || strstr($useragent,'Gecko') ) )
	{
		if ( extension_loaded('zlib') )
		{
			if (headers_sent() != TRUE) 
			{ 
				// Here we updated the gzip function.
				// With this method we can get the server up
				// to 10% faster
				$gz_possible = isset($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING']) && eregi('gzip, deflate',$HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING']);
				if ($gz_possible)
				{
					ob_start('ob_gzhandler'); 
				}
			}
		}
	}
	else if ( $phpver > '4.0' )
	{
		if ( strstr($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING'], 'gzip') )
		{
			if ( extension_loaded('zlib') )
			{
				$do_gzip_compress = TRUE;
				ob_start();
				ob_implicit_flush(0);

				header('Content-Encoding: gzip');
			}
		}
	}
}
//---[-]---gzip_compression


// Parse and show the overall header.
$template->set_filenames(array(
	'overall_header' => ( empty($gen_simple_header) ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['real_default_lang']. '/lang_main.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang']. '/lang_main.'.$phpEx);

//---[+]--- tema kutusu ----------------
$sql = "SELECT themes_id, style_name FROM " . THEMES_TABLE . " ORDER BY style_name";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, 'Could not query database for theme info');
}

$select_theme = "<select onChange=\"this.form.submit();\" name=\"theme\">\n";
$select_theme .= '<optgroup label="Style Select Box">';
while( $row = $db->sql_fetchrow($result) )
{
	$selected = ($row['themes_id'] == $theme['themes_id']) ? " selected=\"selected\"" : "";
	$select_theme .= "<option value=\"" . $row['themes_id'] . "\"$selected>-- " . ucwords($row['style_name']) . "</option>";
}
$select_theme .= "</select>\n";
$select_theme .= "</optgroup>\n";
$hidden_fields = '';

if ( isset($HTTP_GET_VARS) )
{
	while ( list($name,$value) = each($HTTP_GET_VARS) )
	{
		if ( $name != "theme" && $name != "language")
		{
			$hidden_fields .= '<input type="hidden" name="' . $name . '" value="' . $value . '" />';
		}
	}
}
if ( !empty($SID) )
{
	$hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
}

$template->assign_vars(array(
	'S_THEMEBOX_SELECT' => trim($hidden_fields . $select_theme))
);

//temadan düþme hatalarý için genel deðiþken
$theme_id = ( isset($HTTP_GET_VARS['theme']) ) ? $HTTP_GET_VARS['theme'] : $HTTP_POST_VARS['theme'];
$theme_input = "<input type=\"hidden\" name=\"theme\" value=\"" . $theme_id . "\">";

if ( $userdata['session_logged_in'] )
{
	// ---[+]--- number of new posts -------
	$sql = "SELECT COUNT(post_id) as total
		FROM " . POSTS_TABLE . "
		WHERE post_time >= " . $userdata['user_lastvisit'];
	$result = $db->sql_query($sql);
	if( $result )
	{
		$row = $db->sql_fetchrow($result);
		$lang['Search_new'] = $lang['Search_new'] . ": " . $row['total'];
	}
	// ---[-]--- number of new posts -------

	$u_login_logout = 'login.'.$phpEx.'?logout=true&amp;sid=' . $userdata['session_id']. '" onclick="return logout_question();';
	$l_login_logout = $lang['Logout'] . ' [ ' . $userdata['username'] . ' ]';
}
else
{
	$smart_redirect = strrchr($HTTP_SERVER_VARS['PHP_SELF'], '/');
	$smart_redirect = substr($smart_redirect, 1, strlen($smart_redirect));

	if( ($smart_redirect == ('profile.'.$phpEx)) || ($smart_redirect == ('login.'.$phpEx)) )
	{
		$smart_redirect = '';
	}

	if( isset($HTTP_GET_VARS) && !empty($smart_redirect) )
	{
		$smart_get_keys = array_keys($HTTP_GET_VARS);

		for ($i = 0; $i < count($HTTP_GET_VARS); $i++)
		{
			if ($smart_get_keys[$i] != 'sid')
			{
				$smart_redirect .= '&' . $smart_get_keys[$i] . '=' . $HTTP_GET_VARS[$smart_get_keys[$i]];
			}
		}
	}

	$u_login_logout = 'login.' . $phpEx;
	$u_login_logout .= (!empty($smart_redirect)) ? '?redirect=' . $smart_redirect : '';
	$u_login_logout = htmlspecialchars($u_login_logout);
	$l_login_logout = $lang['Login'];
}

$s_last_visit = ( $userdata['session_logged_in'] ) ? create_date($board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone']) : '';

// Get basic (usernames + totals) online
// situation
$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';
$l_online_users = '';


if (defined('SHOW_ONLINE'))
{
	$user_forum_sql = ( !empty($forum_id) ) ? "AND s.session_page = " . intval($forum_id) : '';
	$sql = "SELECT u.username, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
		FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
		WHERE u.user_id = s.session_user_id
			AND s.session_time >= ".( time() - 300 ) . "
		$user_forum_sql
		ORDER BY u.username ASC, s.session_ip ASC";
	if( !($result = $db->sql_query($sql)) )
	{
	message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
	}
	
	$userlist_ary = array();
	$userlist_visible = array();
	
	$prev_user_id = 0;
	$prev_user_ip = $prev_session_ip = '';
	
	while( $row = $db->sql_fetchrow($result) )
	{
		// User is logged in and therefor not a guest
		if ( $row['session_logged_in'] )
		{
			// Skip multiple sessions for one user
			if ( $row['user_id'] != $prev_user_id )
			{
				if ( $row['user_allow_viewonline'] )
				{
					$logged_visible_online++;
        				$user_online_link = color_group_colorize_name($row['user_id'], false);
				}
				else
				{
					$logged_hidden_online++;
        				$user_online_link = '<i>'.color_group_colorize_name($row['user_id'], false).'</i>';
				}

				if ( $row['user_allow_viewonline'] || ($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD ))
				{
					$online_userlist .= ( $online_userlist != '' ) ? ', ' . $user_online_link : $user_online_link;
					$online_userlistp .= ( $online_userlistp != '' ) ? ', ' . $user_online_link : $user_online_link;
				}
			}
			$prev_user_id = $row['user_id'];
		}
		else
		{
			// Skip multiple sessions for one user
			if ( $row['session_ip'] != $prev_session_ip )
			{
				$guests_online++;
				//MOD Show Search Bot
				if ($board_config['show_search_bots'])
				{	
					$tmp_list = explode(".", decode_ip($row['session_ip']));
					if 
					(
						// number is -> ip adress count...
						//verifred from -> http://www.iplists.com/google.txt
						//172
						($tmp_list[0] == "64" && $tmp_list[1] == "68")  ||
						//63
						($tmp_list[0] == "64" && $tmp_list[1] == "233" && $tmp_list[2] == "173") ||
						//26
						($tmp_list[0] == "216" && $tmp_list[1] == "239") ||
						//11
						($tmp_list[0] == "66" && $tmp_list[1] == "249")
					)
					{ //Google
						$online_userlist .= ( $online_userlist != '' ) ? ', ' . '<span style="color:#' . $theme['body_link'] . '">Google</span>' : '<span style="color:#' . $theme['body_link'] . '">Google</span>';
					}
					if 
					( 
						// verifred from -> http://www.iplists.com/nw/msn.txt
						//107
						($tmp_list[0] == "65" && $tmp_list[1] == "54") ||
						//11
						($tmp_list[0] == "131" && $tmp_list[1] == "107") || 
						//10
						($tmp_list[0] == "65" && $tmp_list[1] == "55") ||
						//9
						($tmp_list[0] == "207" && $tmp_list[1] == "46") ||
						//8
						($tmp_list[0] == "63" && $tmp_list[1] == "194" && $tmp_list[2] == "155") || 
						//8
						($tmp_list[0] == "202" && $tmp_list[1] == "96" && $tmp_list[2] == "51") ||
						//7
						($tmp_list[0] == "207" && $tmp_list[1] == "68") 
					)
					{ //MSN
						$online_userlist .= ( $online_userlist != '' ) ? ', ' . '<span style="color:#' . $theme['body_link'] . '">MSN</span>' : '<span style="color:#' . $theme['body_link'] . '">MSN</span>';
					}
					if 
					( 
						// verifred from -> http://www.iplists.com/inktomi.txt
						//126
						($tmp_list[0] == "68" && $tmp_list[1] == "142") ||
						//36
						($tmp_list[0] == "72" && $tmp_list[1] == "30") ||
						//26*
						($tmp_list[0] == "66" && $tmp_list[1] == "196") ||
						//25
						($tmp_list[0] == "216" && $tmp_list[1] == "32" && $tmp_list[2] == "237") ||
						//20
						($tmp_list[0] == "66" && $tmp_list[1] == "94" && $tmp_list[2] == "230") ||
						//20
						($tmp_list[0] == "74" && $tmp_list[1] == "6" && $tmp_list[2] == "131") ||
						//19
						($tmp_list[0] == "216" && $tmp_list[1] == "109" && $tmp_list[2] == "126") ||
						//17
						($tmp_list[0] == "66" && $tmp_list[1] == "163" && $tmp_list[2] == "170") ||
						//16
						($tmp_list[0] == "216" && $tmp_list[1] == "239" && $tmp_list[2] == "193") ||
						//16
						($tmp_list[0] == "209" && $tmp_list[1] == "191") ||
						//13
						($tmp_list[0] == "202" && $tmp_list[1] == "160") ||
						//13
						($tmp_list[0] == "209" && $tmp_list[1] == "131") ||
						//12
						($tmp_list[0] == "66" && $tmp_list[1] == "218") ||
						//10
						($tmp_list[0] == "202" && $tmp_list[1] == "212" && $tmp_list[2] == "5") 
					) 
					{ //Yahoo
						$online_userlist .= ( $online_userlist != '' ) ? ', ' . '<span style="color:#' . $theme['body_link'] . '">Yahoo</span>' : '<span style="color:#' . $theme['body_link'] . '">Yahoo</span>';
					}
					
				}
				//End Show Search Bot
			}
		}
	
		$prev_session_ip = $row['session_ip'];
	}
	$db->sql_freeresult($result);
	
	if ( empty($online_userlist) )
	{
		$online_userlist = $lang['None'];
	}
	// türkphpbb ezPortal Canli Istatistik
	if ( empty($online_userlistp) )
	{
		$online_userlistp = $lang['None'];
	}
	$online_userlistp = ( ( isset($forum_id) ) ? $lang['Browsing_forum'] : $lang['Registered_users_portal'] ) . ' ' . $online_userlistp;
	// türkphpbb ezPortal Canli Istatistik

	$online_userlist = ( ( isset($forum_id) ) ? $lang['Browsing_forum'] : ":" ) . ' ' . $online_userlist;
	$total_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;
	
	if ( $total_online_users > $board_config['record_online_users'])
	{
		$board_config['record_online_users'] = $total_online_users;
		$board_config['record_online_date'] = time();
	
		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '$total_online_users'
			WHERE config_name = 'record_online_users'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
		}
	
		$sql = "UPDATE " . CONFIG_TABLE . "
			SET config_value = '" . $board_config['record_online_date'] . "'
			WHERE config_name = 'record_online_date'";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
		}
	}
	
	//-- [+] Light Statistic --------------------------------------------
	$l_online_users = sprintf( $lang['Online_users_total'], $total_online_users);
	
	if ( $logged_visible_online != 0 )
	{
		$l_online_users .= sprintf( $lang['Reg_users_total'], $logged_visible_online);
	}
	
	if ( $logged_hidden_online != 0 )
	{
		$l_online_users .= sprintf( $lang['Hidden_users_total'], $logged_hidden_online);
	}
	
	if ( $guests_online != 0 )
	{
		$l_online_users .= sprintf( $lang['Guest_users_total'], $guests_online);
	}
	//-- [-] Light Statistic --------------------------------------------

}

//---[ + ]  -----yeni pm var mý yok mu sorgusu--------------
// okunmamýþ mesajlarýn sayýlarýný gösterecek þekilde modifiye edilmiþtir
if ( ($userdata['session_logged_in']) && (empty($gen_simple_header)) )
{
	if ( $userdata['user_new_privmsg'] )
	{
		$l_message_new = ( $userdata['user_new_privmsg'] == 1 ) ? $lang['New_pm'] : $lang['New_pms'];
		$l_privmsgs_text = sprintf($l_message_new, $userdata['user_new_privmsg']);

		if ( $userdata['user_last_privmsg'] > $userdata['user_lastvisit'] )
		{
			$sql = "UPDATE " . USERS_TABLE . "
				SET user_last_privmsg = " . $userdata['user_lastvisit'] . "
				WHERE user_id = " . $userdata['user_id'];
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update private message new/read time for user', '', __LINE__, __FILE__, $sql);
			}

			$s_privmsg_new = 1;
			$icon_pm = $images['pm_new_msg'];
		}
		else
		{
			$s_privmsg_new = 0;
			$icon_pm = $images['pm_new_msg'];
		}
	}
	else
	{
		if ( $userdata['user_unread_privmsg'] )
		{
			$l_message_unread = ( $userdata['user_unread_privmsg'] == 1 ) ? $lang['Unread_pm'] : $lang['Unread_pms'];
			$l_privmsgs_text = sprintf($l_message_unread, $userdata['user_unread_privmsg']);
			$s_privmsg_new = 0;
		}
		else
		{
			$l_privmsgs_text = $lang['No_unread_pm'];
			$s_privmsg_new = 0;
		}
	}
}
else
{
	$icon_pm = $images['pm_no_new_msg'];
	$l_privmsgs_text = $lang['Login_check_pm'];
	$l_privmsgs_text_unread = '';
	$s_privmsg_new = 0;
}
//---[ - ]  -----yeni pm var mý yok mu sorgusu--------------

//---[+]--- Advanced_Report_Hack--------
$report_info = '';
if (($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD) && $board_config['report_list'] == 0 && empty($gen_simple_header))
{
	include_once($phpbb_root_path . 'includes/functions_report.'.$phpEx);
	$report_count = report_count('notcleared');

	switch ($report_count)
	{
		case 0:
		$report_info = $lang['No_new_reports'];
		break;

		case 1:
		$report_info = $lang['New_report'];
		break;

		default:
		$report_info = sprintf($lang['New_reports'], $report_count);
	}
}
//---[-]--- Advanced_Report_Hack--------

//--[+]-- Generate HTML required for Mozilla Navigation bar
if (!isset($nav_links))
{
	$nav_links = array();
}

$nav_links_html = '';
$nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";
while( list($nav_item, $nav_array) = @each($nav_links) )
{
	if ( !empty($nav_array['url']) )
	{
		$nav_links_html .= sprintf($nav_link_proto, $nav_item, append_sid($nav_array['url']), $nav_array['title']);
	}
	else
	{
		// We have a nested array, used for items like <link rel='chapter'> that can occur more than once.
		while( list(,$nested_array) = each($nav_array) )
		{
			$nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
		}
	}
}
//--[-]-- Generate HTML required for Mozilla Navigation bar


//--[+]-- cback ctracker-----------------------

// CrackerTracker IP Range Scanner
if ( $HTTP_GET_VARS['marknow'] == 'ipfeature' && $userdata['session_logged_in'] )
{
	// Mark IP Feature Read
	$userdata['ct_last_ip'] = $userdata['ct_last_used_ip'];
	$sql = 'UPDATE ' . USERS_TABLE . ' SET ct_last_ip = ct_last_used_ip WHERE user_id=' . $userdata['user_id'];

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, $lang['ctracker_error_updating_userdata'], '', __LINE__, __FILE__, $sql);
	}

	if ( !empty($HTTP_SERVER_VARS['HTTP_REFERER']) )
	{
		preg_match('#/([^/]*?)$#', $HTTP_SERVER_VARS['HTTP_REFERER'], $backlink);
		redirect($backlink[1]);
	}
}

if ( $ctracker_config->settings['login_ip_check'] == 1 && $userdata['ct_enable_ip_warn'] == 1 && $userdata['session_logged_in'] )
{
	include_once($phpbb_root_path . '/ctracker/classes/class_ct_userfunctions.' . $phpEx);
	$ctracker_user = new ct_userfunctions();
	$check_ip_range = $ctracker_user->check_ip_range();

	if ( $check_ip_range != 'allclear' )
	{
		$template->assign_block_vars('ctracker_message', array(
			'ROW_COLOR' => 'FFDFDF',
			'ICON_GLOB' => $images['ctracker_note'],
			'L_MESSAGE_TEXT' => $check_ip_range,
			'L_MARK_MESSAGE' => $lang['ctracker_gmb_markip'],
			'U_MARK_MESSAGE' => append_sid('index.' . $phpEx . '?marknow=ipfeature'))
		);
	}
}

// CrackerTracker Global Message Function

if ( $HTTP_GET_VARS['marknow'] == 'globmsg' && $userdata['session_logged_in'] )
{
	// Mark Global Message as read
	$userdata['ct_global_msg_read'] = 0;
	$sql = 'UPDATE ' . USERS_TABLE . ' SET ct_global_msg_read = 0 WHERE user_id=' . $userdata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, $lang['ctracker_error_updating_userdata'], '', __LINE__, __FILE__, $sql);
	}

	if ( !empty($HTTP_SERVER_VARS['HTTP_REFERER']) )
	{
		preg_match('#/([^/]*?)$#', $HTTP_SERVER_VARS['HTTP_REFERER'], $backlink);
		redirect($backlink[1]);
	}
}

if ( $userdata['ct_global_msg_read'] == 1 && $userdata['session_logged_in'] && $ctracker_config->settings['global_message'] != '' )
{
	// Output Global Message
	$global_message_output = '';

	if ( $ctracker_config->settings['global_message_type'] == 1 )
	{
		$global_message_output = $ctracker_config->settings['global_message'];
	}
	else
	{
		$global_message_output = sprintf($lang['ctracker_gmb_link'], $ctracker_config->settings['global_message'], $ctracker_config->settings['global_message']);
	}

	$template->assign_block_vars('ctracker_message', array(
		'ROW_COLOR' => 'E1FFDF',
		'ICON_GLOB' => $images['ctracker_note'],
		'L_MESSAGE_TEXT' => $global_message_output,
		'L_MARK_MESSAGE' => $lang['ctracker_gmb_mark'],
		'U_MARK_MESSAGE' => append_sid('index.' . $phpEx . '?marknow=globmsg'))
	);
}

(($ctracker_config->settings['login_history'] == 1 || $ctracker_config->settings['login_ip_check'] == 1) && $userdata['session_logged_in'])? $template->assign_block_vars('login_sec_link', array()): null;

// CrackerTracker Password Expirement Check
if ( $userdata['session_logged_in'] && $ctracker_config->settings['pw_control'] == 1 )
{
	if ( time() > $userdata['ct_last_pw_reset'] )
	{
		$template->assign_block_vars('ctracker_message', array(
			'ROW_COLOR' => 'FFDFDF',
			'ICON_GLOB' => $images['ctracker_note'],
			'L_MESSAGE_TEXT' => sprintf($lang['ctracker_info_pw_expired'], $ctracker_config->settings['pw_validity']),
			'L_MARK_MESSAGE' => '',
			'U_MARK_MESSAGE' => '')
		);
	}
}

// CrackerTracker Debug Mode Check
if ( CT_DEBUG_MODE === true && $userdata['user_level'] == ADMIN )
{
	$template->assign_block_vars('ctracker_message', array(
		'ROW_COLOR' => 'FFDFDF',
		'ICON_GLOB' => $images['ctracker_note'],
		'L_MESSAGE_TEXT' => $lang['ctracker_dbg_mode'],
		'L_MARK_MESSAGE' => '',
		'U_MARK_MESSAGE' => '')
	);
}
//--[-]-- cback ctracker-----------------------

// site kapalý + site yolu + time zone
$closed = ($board_config['board_disable_msg'] != "") ? $board_config['board_disable_msg'] : $lang['Board_disable'];
$site_way = trim($board_config['server_name']).'/'.preg_replace('/^\/?(.*?)\/?$/', "\\1", trim($board_config['script_path']));
$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];

// eðer site keyword belirlenmemiþse site açýklamasýný parçala ve etiket diye getir
if (trim($board_config['site_keywords']) == '')
{
	$board_config['site_keywords'] = str_replace(' ', ', ',  $board_config['site_desc']);
}
$template->assign_vars(array(
	'SITENAME' => $board_config['sitename'],
	'SITE_DESCRIPTION' => $board_config['site_desc'],
	'L_USERSITES' => $lang['usersites'],
	'U_USERSITES' => append_sid('usersites.'.$phpEx),
	
	'L_RANKING' => $lang['Ranking'],
	'U_RANKING' => append_sid('ranking.'.$phpEx),

	'FORUM_WIDTH' => $board_config['forum_width'],
	'SITE_KEYWORDS' => ($keywords) ? $keywords : $board_config['site_keywords'],
	'L_SITE_WORDS' => $lang['Site_words'],
	'SITE_WAY' => $site_way,
	'PAGE_TITLE' => $page_title,
	'LAST_VISIT_DATE' => sprintf($lang['You_last_visit'], $s_last_visit),
	'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])),
	'TOTAL_USERS_ONLINE' => $l_online_users,
	'LOGGED_IN_USER_LIST' => $online_userlist,
	'RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
	'PRIVATE_MESSAGE_INFO' => $l_privmsgs_text,
	'PRIVATE_MESSAGE_INFO_UNREAD' => $l_privmsgs_text_unread,
	'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,

	'L_RMW_IMAGE_TITLE' => $lang['rmw_image_title'],

	'LANGUAGE_SELECT' => language_select2($board_config['default_lang'], 'language'),
	'L_ALL_MESS' => $lang['All_message'],
	'L_MES_TEXT' => $lang['Message_text'],
	'L_MES_TOPICS' => $lang['Message_topic'],
	'L_ALL_SITE' => $lang['All_site'],
	'L_SEARCH_MT' => $lang['Search_motor'],
	'L_YAZAR' => $lang['Yazar'],

	'PRIVMSG_IMG' => $icon_pm,
	'L_USERNAME' => $lang['Username'],
	'L_PASSWORD' => $lang['Password'],
	'L_LOGIN_LOGOUT' => $l_login_logout,
	'L_LOGOUT_QUESTION' => $lang['Logout_Question'],
	'L_LOGIN' => $lang['Login'],
	'L_LOG_ME_IN' => $lang['Log_me_in'],
	'L_AUTO_LOGIN' => $lang['Log_me_in'],
	'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
	'L_REGISTER' => $lang['Register'],
	'L_PROFILE' => $lang['Profile'],
	'L_SEARCH' => $lang['Search'],
	'L_PRIVATEMSGS' => $lang['Private_Messages'],
	'L_PRIVATEMSG_NEW' => ($userdata['user_new_privmsg'] == 1) ? $lang['You_new_pm'] : $lang['You_new_pms'],
	'L_CLOSE_WINDOW' => $lang['Close_window'],
	'L_MESSAGE' => sprintf($lang['Click_view_privmsg'], '<a href="' . append_sid("privmsg.".$phpEx."?folder=inbox") . '">', '</a>'),
	'L_WHO_IS_ONLINE' => $lang['Who_is_Online'],
	'L_MEMBERLIST' => $lang['Memberlist'],
	'L_USERGROUPS' => $lang['Usergroups'],
	'L_SEARCH_NEW' => $lang['Search_new'],
	'L_SEARCH_SELF' => $lang['Search_your_posts'] . ': '. $userdata['user_posts'],

	'L_ATTACH' => $lang['Attachments'],
	'L_ANKET' => $lang['poll_overview'],
	'L_ARCHIVE' => $lang['archive'],
	'L_MODLIST' => $lang['Hacks_List'],
	'L_ILETISIM' => $lang['iletiþim'],
	'L_WATCH' => $lang['Watched_Topics'],
	'L_STAFF' => $lang['Staff'],
	'L_FAV' => $lang['Favorites'],
	'L_COOKIE_LINK' => $lang['Remove_cookies'],

	//son konular modu
	'L_RSS' => ($l_rss) ? $l_rss : $board_config['sitename'] ." ".$lang['rss_latest'],
	'U_RSS' => ($rss_url) ? $rss_url : "rss.".$phpEx,
	'THEME_INPUT' => $theme_input,
	'L_REPORT_INFO' => $report_info,

	'L_LOGIN_SEC' => $lang['ctracker_gmb_loginlink'],
	'L_RECENT' => $lang['Recent_topics'],

	'L_LOGIN_PLEASE' => $lang['Login_please'],
	'L_RULES' => $lang['Forum_Rules'],
	'L_ARAMA' => $lang['Arama'],
	'L_ARA' => $lang['Ara'],

	'L_BANLIST' => $lang['Banlist'],
	'L_REPORT' => $lang['Reportlist_title'],

	'U_COOKIE_LINK' => append_sid('remove_cookies.'.$phpEx),
	'U_ATTACH' => append_sid('attachments.'.$phpEx),
	'U_ANKET' => append_sid('anket.'.$phpEx),
	'U_ARCHIVE' => append_sid('index_p.'.$phpEx),
	'U_MODLIST' => append_sid('modlist.'.$phpEx),
	'U_ILETISIM' => append_sid('contact.'.$phpEx),
	'U_WATCH' => append_sid('watched_topics.'.$phpEx),
	'U_STAFF' => append_sid('staff.'.$phpEx),
	'U_FAV' => append_sid('favorites.'.$phpEx),


	'L_BOARD_DISABLE' => $closed,
	'U_SEARCH_SELF' => append_sid('search.'.$phpEx.'?search_id=egosearch'),
	'U_SEARCH_NEW' => append_sid('search.'.$phpEx.'?search_id=newposts'),
	'U_INDEX' => append_sid('index.'.$phpEx),
	'U_REGISTER' => append_sid('profile.'.$phpEx.'?mode=register'),
	'U_PROFILE' => append_sid('profile.'.$phpEx.'?mode=editprofile'),
	'U_PRIVATEMSGS' => append_sid('privmsg.'.$phpEx.'?folder=inbox'),
	'U_PRIVATEMSGS_POPUP' => append_sid('privmsg.'.$phpEx.'?mode=newpm'),
	'U_SEARCH' => append_sid('search.'.$phpEx),
	'U_SIGLIST' => append_sid('siglist.'.$phpEx),
	'U_MEMBERLIST' => append_sid('memberlist.'.$phpEx),
	'U_MODCP' => append_sid('modcp.'.$phpEx),
	'U_VIEWONLINE' => append_sid('viewonline.'.$phpEx),
	'U_LOGIN_LOGOUT' => append_sid($u_login_logout),
	'U_GROUP_CP' => append_sid('groupcp.'.$phpEx),
	'U_FAQ' => append_sid('faq.'.$phpEx),
	'U_RULES' => append_sid('rules.'.$phpEx),

	'U_LOGIN_SEC' => append_sid('ct_login_history.' . $phpEx),
	'U_PORTAL' => append_sid('portal.' . $phpEx),
	'U_REPORT_INFO' => append_sid('report.'.$phpEx),
	'U_RECENT' => append_sid('recent.'.$phpEx),
	'U_BANLIST' => append_sid('banlist.'.$phpEx),
	'U_REPORT' => append_sid('report.'.$phpEx),
	'S_LOGIN_ACTION' => append_sid('login.'.$phpEx),


	'S_REDIRECT_PAGE' => $redirect_page,
	'S_CONTENT_DIRECTION' => $lang['DIRECTION'],
	'S_CONTENT_ENCODING' => $lang['ENCODING'],
	'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
	'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
	'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone),

	'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
	'T_BODY_BACKGROUND' => $theme['body_background'],
	'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
	'T_BODY_TEXT' => '#'.$theme['body_text'],
	'T_BODY_LINK' => '#'.$theme['body_link'],
	'T_BODY_VLINK' => '#'.$theme['body_vlink'],
	'T_BODY_ALINK' => '#'.$theme['body_alink'],
	'T_BODY_HLINK' => '#'.$theme['body_hlink'],
	'T_TR_COLOR1' => '#'.$theme['tr_color1'],
	'T_TR_COLOR2' => '#'.$theme['tr_color2'],
	'T_TR_COLOR3' => '#'.$theme['tr_color3'],
	'T_TR_CLASS1' => $theme['tr_class1'],
	'T_TR_CLASS2' => $theme['tr_class2'],
	'T_TR_CLASS3' => $theme['tr_class3'],
	'T_TH_COLOR1' => '#'.$theme['th_color1'],
	'T_TH_COLOR2' => '#'.$theme['th_color2'],
	'T_TH_COLOR3' => '#'.$theme['th_color3'],
	'T_TH_CLASS1' => $theme['th_class1'],
	'T_TH_CLASS2' => $theme['th_class2'],
	'T_TH_CLASS3' => $theme['th_class3'],
	'T_TD_COLOR1' => '#'.$theme['td_color1'],
	'T_TD_COLOR2' => '#'.$theme['td_color2'],
	'T_TD_COLOR3' => '#'.$theme['td_color3'],
	'T_TD_CLASS1' => $theme['td_class1'],
	'T_TD_CLASS2' => $theme['td_class2'],
	'T_TD_CLASS3' => $theme['td_class3'],
	'T_FONTFACE1' => $theme['fontface1'],
	'T_FONTFACE2' => $theme['fontface2'],
	'T_FONTFACE3' => $theme['fontface3'],
	'T_FONTSIZE1' => $theme['fontsize1'],
	'T_FONTSIZE2' => $theme['fontsize2'],
	'T_FONTSIZE3' => $theme['fontsize3'],
	'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
	'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
	'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
	'T_SPAN_CLASS1' => $theme['span_class1'],
	'T_SPAN_CLASS2' => $theme['span_class2'],
	'T_SPAN_CLASS3' => $theme['span_class3'],

	'NAV_LINKS' => $nav_links_html)
);

// Login box?
if ( !$userdata['session_logged_in'] )
{
	$template->assign_block_vars('switch_user_logged_out', array());
	// Allow autologin?
	if (!isset($board_config['allow_autologin']) || $board_config['allow_autologin'] )
	{
		$template->assign_block_vars('switch_allow_autologin', array());
		$template->assign_block_vars('switch_user_logged_out.switch_allow_autologin', array());
	}
}
else
{
	$template->assign_block_vars('switch_user_logged_in', array());
	if ( !empty($userdata['user_popup_pm']) && $s_privmsg_new != 0 )
	{
		$template->assign_block_vars('switch_enable_pm_popup', array());
	}
}
// Add no-cache control for cookies if they are set
//$c_no_cache = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) || isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_data'])) ? 'no-cache="set-cookie", ' : '';

// Work around for "current" Apache 2 + PHP module which seems to not
// cope with private cache control setting
if (!empty($HTTP_SERVER_VARS['SERVER_SOFTWARE']) && strstr($HTTP_SERVER_VARS['SERVER_SOFTWARE'], 'Apache/2'))
{
	@header ('Cache-Control: no-cache, pre-check=0, post-check=0');
}
else
{
	@header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
}
@header ('Expires: 0');
@header ('Pragma: no-cache');

if ( $board_config['board_disable'] && ($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD))
{
	$template->assign_block_vars('switch_admin_disable_board', array());
}

$template->pparse('overall_header');
if (($userdata['user_level'] == USER) and $board_config['board_disable'])
{
	message_die(GENERAL_MESSAGE, $closed);
}

?>