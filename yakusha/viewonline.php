<?php
/***************************************************************************
* viewonline.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_VIEWONLINE);
init_userprefs($userdata);

//---[+]--- Logged In control on acp --------
if ( !$userdata['session_logged_in'] && $board_config['allow_login_for_whoisonline'])
{
	redirect(append_sid("login.$phpEx?redirect=viewonline.$phpEx", true));
}
//---[-]--- Logged In control on acp --------

// Output page header and load viewonline template
$page_title = $lang['Who_is_Online'];
$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("viewonline.php").'">';
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'viewonline_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
	'L_WHOSONLINE' => $lang['Who_is_Online'],
	'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
	'L_USERNAME' => $lang['Username'],
	'L_FORUM_LOCATION' => $lang['Forum_Location'],
	'L_LAST_UPDATE' => $lang['Last_updated'])
);

// Forum info
$sql = "SELECT forum_name, forum_id
	FROM " . FORUMS_TABLE;
	if ( $result = $db->sql_query($sql) )
	{
		while( $row = $db->sql_fetchrow($result) )
		{
			$forum_data[$row['forum_id']] = $row['forum_name'];
		}
	}
	else
	{
		message_die(GENERAL_ERROR, 'Could not obtain user/online forums information', '', __LINE__, __FILE__, $sql);
	}

// Get auth data
$is_auth_ary = array();
$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);

// Get user list
$sql = "SELECT u.user_id, u.username, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_time, s.session_page, s.session_ip
	FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
	WHERE u.user_id = s.session_user_id
		AND s.session_time >= ".( time() - 300 ) . "
	ORDER BY u.username ASC, s.session_ip ASC";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain regd user/online information', '', __LINE__, __FILE__, $sql);
}

$guest_users = 0;
$registered_users = 0;
$hidden_users = 0;

$reg_counter = 0;
$guest_counter = 0;
$prev_user = 0;
$prev_ip = '';

while ( $row = $db->sql_fetchrow($result) )
{
	$view_online = false;

	if ( $row['session_logged_in'] ) 
	{
		$user_id = $row['user_id'];

		if ( $user_id != $prev_user )
		{
			include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);
			$username = color_group_colorize_name($user_id, false);

			if ( !$row['user_allow_viewonline'] )
			{
				$view_online = ( $userdata['user_level'] == ADMIN ) ? true : false;
				$hidden_users++;

				$username = '<i>' . $username . '</i>';
			}
			else
			{
				$view_online = true;
				$registered_users++;
			}

			$which_counter = 'reg_counter';
			$which_row = 'reg_user_row';
			$prev_user = $user_id;
		}
	}
	else
	{
		if ( $row['session_ip'] != $prev_ip )
		{
			$username = $lang['Guest'];
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
					$username = 'Google';
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
					$username = 'MSN';
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
					$username = 'Yahoo';
				}
			}//End Show Search Bot
			$view_online = true;
			$guest_users++;
	
			$which_counter = 'guest_counter';
			$which_row = 'guest_user_row';
		}
	}

	$prev_ip = $row['session_ip'];

	if ( $view_online )
	{
		if ( $row['session_page'] < 1 || !$is_auth_ary[$row['session_page']]['auth_view'] )
		{
			switch( $row['session_page'] )
			{
				case PAGE_INDEX:
					$location = $lang['Forum_index'];
					$location_url = "index.$phpEx";
					break;
				case PAGE_POSTING:
					$location = $lang['Posting_message'];
					$location_url = "index.$phpEx";
					break;
				case PAGE_LOGIN:
					$location = $lang['Logging_on'];
					$location_url = "index.$phpEx";
					break;
				case PAGE_SEARCH:
					$location = $lang['Searching_forums'];
					$location_url = "search.$phpEx";
					break;
				case PAGE_PROFILE:
					$location = $lang['Viewing_profile'];
					$location_url = "index.$phpEx";
					break;
				case PAGE_VIEWONLINE:
					$location = $lang['Viewing_online'];
					$location_url = "viewonline.$phpEx";
					break;
				case PAGE_VIEWMEMBERS:
					$location = $lang['Viewing_member_list'];
					$location_url = "memberlist.$phpEx";
					break;
				case PAGE_PRIVMSGS:
					$location = $lang['Viewing_priv_msgs'];
					$location_url = "privmsg.$phpEx";
					break;
				case PAGE_RECENT:
					$location = $lang['Recent_topics'];
					$location_url = "recent.$phpEx";
					break;
				case PAGE_FAQ:
					$location = $lang['Viewing_FAQ'];
					$location_url = "faq.$phpEx";
					break;
				case PAGE_RSS:
					$location = $lang['Viewing_rss'];
					$location_url = "rss.$phpEx";
					break;
				case PAGE_FAV:
					$location = $lang['Viewing_fav'];
					$location_url = "favorites.$phpEx";
					break;
				case PAGE_GSM:
					$location = $lang['Viewing_gsm'];
					$location_url = "google_sitemap.$phpEx";
					break;
				case PAGE_LH:
					$location = $lang['Viewing_login_history'];
					$location_url = "ct_login_history.php.$phpEx";
					break;
				case PAGE_UU:
					$location = $lang['Viewing_uu'];
					$location_url = "ctracker_login.php.$phpEx";
					break;
				case PAGE_CONTACT:
					$location = $lang['Viewing_contact'];
					$location_url = "contact.$phpEx";
					break;
				case PAGE_FILES:
					$location = $lang['Viewing_files'];
					$location_url = "download.php.$phpEx";
					break;
				case PAGE_MODLIST:
					$location = $lang['Viewing_modlist'];
					$location_url = "modlist.$phpEx";
					break;
				case PAGE_PORTAL:
					$location = $lang['Viewing_portal'];
					$location_url = "portal.$phpEx";
					break;
				case PAGE_RC:
					$location = $lang['Viewing_rc'];
					$location_url = "remove_cookies.$phpEx";
					break;
				case PAGE_REPORT:
					$location = $lang['Viewing_report'];
					$location_url = "report.$phpEx";
					break;
				case PAGE_STAFF:
					$location = $lang['Viewing_staff'];
					$location_url = "staff.$phpEx";
					break;
				case PAGE_URLLIST:
					$location = $lang['Viewing_urllist'];
					$location_url = "urllist.$phpEx";
					break;
				case PAGE_SINGLE_POST:
					$location = $lang['Viewing_single_post'];
					$location_url = "viewpost.$phpEx";
					break;
				case PAGE_WT:
					$location = $lang['Viewing_wt'];
					$location_url = "watched_topics.$phpEx";
					break;
				case PAGE_ATTACH_RULES:
					$location = $lang['Viewing_attach_rules'];
					$location_url = "attach_rules.$phpEx";
					break;
				case PAGE_ATTACH:
					$location = $lang['Viewing_attach'];
					$location_url = "attachments.$phpEx";
					break;
				case PAGE_BANLIST:
					$location = $lang['Viewing_banlist'];
					$location_url = "banlist.$phpEx";
					break;
				case PAGE_RULES:
					$location = $lang['Viewing_RULES'];
					$location_url = "rules.$phpEx";
					break;
				case PAGE_POLL_OVERVIEW:
					$location = $lang['poll_overview'];
					$location_url = "anket.$phpEx";
					break;
				default:
					$location = $lang['Forum_index'];
					$location_url = "index.$phpEx";
			}
		}
		else
		{
			$location_url = append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $row['session_page']);
			$location = $forum_data[$row['session_page']];
		}

		$row_color = ( $$which_counter % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( $$which_counter % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

		$template->assign_block_vars("$which_row", array(
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'USERNAME' => $username,
			'LASTUPDATE' => create_date('H:i', $row['session_time'], $board_config['board_timezone']),
			'FORUM_LOCATION' => $location,
			'L_WHOSONLINE' => $lang['Who_is_Online'],
			'U_FORUM_LOCATION' => append_sid($location_url))
		);

		$$which_counter++;
	}
}

//-- [+] MOD: Light Statistic --------------------------------------------
$l_r_user_s = $lang['Reg_users_online'];
$l_h_user_s = $lang['Hidden_users_online'];
$l_g_user_s = $lang['Guest_users_online'];
//-- [-] MOD: Light Statistic --------------------------------------------

$template->assign_vars(array(
	'TOTAL_REGISTERED_USERS_ONLINE' => sprintf($l_r_user_s, $registered_users) . sprintf($l_h_user_s, $hidden_users), 
	'TOTAL_GUEST_USERS_ONLINE' => sprintf($l_g_user_s, $guest_users))
);

if ( $registered_users + $hidden_users == 0 )
{
	$template->assign_vars(array(
		'L_NO_REGISTERED_USERS_BROWSING' => $lang['No_users_browsing'])
	);
}

if ( $guest_users == 0 )
{
	$template->assign_vars(array(
		'L_NO_GUESTS_BROWSING' => $lang['No_users_browsing'])
	);
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>