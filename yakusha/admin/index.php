<?php
/***************************************************************************
* (admin) index.php
***************************************************************************/

define('IN_PHPBB', 1);

// Load default header
$no_page_header = TRUE;
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);

// ---------------
// Begin functions
//
function inarray($needle, $haystack)
{
	for($i = 0; $i < sizeof($haystack); $i++ )
	{
		if( $haystack[$i] == $needle )
		{
			return true;
		}
	}
	return false;
}
//
// End functions
// -------------

//
// Generate relevant output
//
if( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'left' )
{
	$admin_id = $userdata['user_id'];

	$open_close_modul = ( $HTTP_POST_VARS['oc'] ) ? $HTTP_POST_VARS['oc'] : $HTTP_GET_VARS['oc'];
	$open_close = ( $HTTP_POST_VARS['open_close'] ) ? $HTTP_POST_VARS['open_close'] : $HTTP_GET_VARS['open_close']; 

	if ( $open_close_modul != '') 
	{
		if ( $open_close == 1 )
		{
			$sql = "INSERT INTO " . ADMIN_MODULE_TABLE . " (user_id, modulname) VALUES ($admin_id, '$open_close_modul')";
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not set open status', '', __LINE__, __FILE__, $sql);
			}
		}
		else
		{
			$sql = "DELETE FROM " . ADMIN_MODULE_TABLE . "
				WHERE user_id = $admin_id
				AND modulname = '$open_close_modul'";
			if(!$result = $db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not set close status', '', __LINE__, __FILE__, $sql);
			}
		}
	}

	$cache_data_file = $phpbb_root_path.'cache/jr_admin.dat';

	if (@is_file($cache_data_file))
	{
		if (date('YzH',time()) - date('YzH',@filemtime($cache_data_file)) >= 1)
		{
			@unlink($cache_data_file);
		}
	}
	
	if (file_exists($phpbb_root_path.'cache/jr_admin.dat'))
	{
		//Read all the modules from cache file
		include($phpbb_root_path.'cache/jr_admin.dat');
	}
	else
	{	
		$dir = @opendir(".");

		$setmodules = 1;
		while( $file = @readdir($dir) )
		{
			if( preg_match("/^admin_.*?\." . $phpEx . "$/", $file) )
			{
				include($file);
			}
		}

		@closedir($dir);

		unset($setmodules);

		@unlink ($cache_data_file);
		$data = "<?php\n";
		foreach ($module as $cat => $item_array)
		{
			foreach($item_array as $module_name => $filename)
			{
				$data .= '$module[\''.$cat.'\'][\''.$module_name.'\'] = \''.$filename."';\n";
			}
		}
		$data .= "\n?>";
		$data = str_replace('sid='.$userdata['session_id'], '', $data);
		$data = str_replace('&amp', '', $data);
		$fp = fopen( $cache_data_file, "w" );
		fwrite($fp, $data);
		fclose($fp);

		unset($module);
		include($phpbb_root_path.'cache/jr_admin.dat');
	}
	
	
	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array(
		"body" => "admin/index_navigate.tpl")
	);

	$template->assign_vars(array(
		"U_FORUM_INDEX" => append_sid("../index.$phpEx"),
		"U_ADMIN_INDEX" => append_sid("index.$phpEx?pane=right"),
		"U_ADMIN_STAT" => append_sid("admin_stat.$phpEx"),

		"L_FORUM_INDEX" => $lang['Main_index'],
		"L_ADMIN_INDEX" => $lang['Admin_Index'],
		"L_PREVIEW_FORUM" => $lang['Preview_forum'])
	);

	ksort($module);

	// Read saved modules for admin	
	$admin_nav_modul = array();

	$sql = "SELECT modulname FROM " . ADMIN_MODULE_TABLE . "
		WHERE user_id = " . $userdata['user_id'] . "
		ORDER BY modulname";
	if($result = @$db->sql_query($sql))
	{
		while ( $row = $db->sql_fetchrow($result) )
		{
			$admin_nav_modul[] = $row['modulname'];
		}
	}
	
	while( list($cat, $action_array) = each($module) )
	{
		$admin_category_title = $cat; 

		$cat = ( !empty($lang[$cat]) ) ? $lang[$cat] : preg_replace("/_/", " ", $cat);

		if ( in_array($admin_category_title, $admin_nav_modul) )
		{
			$sign = '-';
			$oc_status = 0;
		}
		else
		{
			$sign = '+';
			$oc_status = 1;
		}

		$admin_category = '<a href="'.append_sid("index.$phpEx?pane=left&amp;oc=$admin_category_title&amp;open_close=$oc_status").'" class="mainmenu">'.$sign.'&nbsp;&nbsp;'.$cat.'</a>'; 

		$template->assign_block_vars("catrow", array( 
			'ADMIN_CATEGORY' => $admin_category 
		)); 

		ksort($action_array);

		$row_count = 0;

		if ( $oc_status == 0 )
		{
			while( list($action, $file) = each($action_array) )
			{
				$row_color = ( !($row_count%2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($row_count%2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$action = ( !empty($lang[$action]) ) ? $lang[$action] : preg_replace("/_/", " ", $action);

				$template->assign_block_vars("catrow.modulerow", array(
					"ROW_COLOR" => "#" . $row_color,
					"ROW_CLASS" => $row_class,

					"ADMIN_MODULE" => $action,
					"U_ADMIN_MODULE" => append_sid($file))
				);
				$row_count++;
			}
		}
	}

	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);
}
elseif( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'top' )
{

	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array("body" => "admin/index_top.tpl"));

	$template->assign_vars(array(
		"U_FORUM_INDEX" => append_sid("../index.$phpEx"),
		"L_FORUM_INDEX" => $lang['Main_index'],
		// Admin Session Logout
		"U_ADMIN_LOGOUT" => append_sid("$phpbb_root_path/login.$phpEx?logout=true&admin_session_logout=true"),
		"L_ADMIN_LOGOUT" => $lang['Admin_session_logout'])		
	);

	$template->pparse("body");
}
elseif( isset($HTTP_GET_VARS['pane']) && $HTTP_GET_VARS['pane'] == 'right' )
{

	include('./page_header_admin.'.$phpEx);

	$template->set_filenames(array("body" => "admin/index_body.tpl"));

	$template->assign_vars(array(
		"L_WELCOME" => $lang['Welcome_phpBB'],
		"L_ADMIN_INTRO" => $lang['Admin_intro'],
		"L_USERNAME" => $lang['Username'],
		"L_LOCATION" => $lang['Location'],
		"L_LAST_UPDATE" => $lang['Last_updated'],
		"L_IP_ADDRESS" => $lang['IP_Address'],
		"L_VALUE" => $lang['Value'],
		"L_FORUM_LOCATION" => $lang['Forum_Location'],
		"L_STARTED" => $lang['Login'])
	);

	//
	// Get users online information.
	//
	$sql = "SELECT u.user_id, u.username, u.user_session_time, u.user_session_page, s.session_logged_in, s.session_ip, s.session_start
		FROM " . USERS_TABLE . " u, " . SESSIONS_TABLE . " s
		WHERE s.session_logged_in = " . TRUE . "
			AND u.user_id = s.session_user_id
			AND u.user_id <> " . ANONYMOUS . "
			AND s.session_time >= " . ( time() - 300 ) . "
		ORDER BY u.user_session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not obtain regd user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_reg = $db->sql_fetchrowset($result);

	$sql = "SELECT session_page, session_logged_in, session_time, session_ip, session_start
		FROM " . SESSIONS_TABLE . "
		WHERE session_logged_in = 0
			AND session_time >= " . ( time() - 300 ) . "
		ORDER BY session_time DESC";
	if(!$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, "Could not obtain guest user/online information.", "", __LINE__, __FILE__, $sql);
	}
	$onlinerow_guest = $db->sql_fetchrowset($result);

	$sql = "SELECT forum_name, forum_id
		FROM " . FORUMS_TABLE;
	if($forums_result = $db->sql_query($sql))
	{
		while($forumsrow = $db->sql_fetchrow($forums_result))
		{
			$forum_data[$forumsrow['forum_id']] = $forumsrow['forum_name'];
		}
	}
	else
	{
		message_die(GENERAL_ERROR, "Could not obtain user/online forums information.", "", __LINE__, __FILE__, $sql);
	}

	$reg_userid_ary = array();

	if( count($onlinerow_reg) )
	{
		$registered_users = 0;

		for($i = 0; $i < count($onlinerow_reg); $i++)
		{
			if( !inarray($onlinerow_reg[$i]['user_id'], $reg_userid_ary) )
			{
				$reg_userid_ary[] = $onlinerow_reg[$i]['user_id'];

				$username = $onlinerow_reg[$i]['username'];

				if( $onlinerow_reg[$i]['user_allow_viewonline'] || $userdata['user_level'] == ADMIN )
				{
					$registered_users++;
					$hidden = FALSE;
				}
				else
				{
					$hidden_users++;
					$hidden = TRUE;
				}

				if( $onlinerow_reg[$i]['user_session_page'] < 1 )
				{
					switch($onlinerow_reg[$i]['user_session_page'])
					{
						case PAGE_INDEX:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_POSTING:
							$location = $lang['Posting_message'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_LOGIN:
							$location = $lang['Logging_on'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_SEARCH:
							$location = $lang['Searching_forums'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PROFILE:
							$location = $lang['Viewing_profile'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWONLINE:
							$location = $lang['Viewing_online'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_VIEWMEMBERS:
							$location = $lang['Viewing_member_list'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_PRIVMSGS:
							$location = $lang['Viewing_priv_msgs'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_FAQ:
							$location = $lang['Viewing_FAQ'];
							$location_url = "index.$phpEx?pane=right";
							break;
						case PAGE_RSS:
							$location = $lang['Viewing_rss'];
							$location_url = "rss.$phpEx?pane=right";
							break;
						case PAGE_FAV:
							$location = $lang['Viewing_fav'];
							$location_url = "favorites.$phpEx?pane=right";
							break;
						case PAGE_GSM:
							$location = $lang['Viewing_gsm'];
							$location_url = "google_sitemap.$phpEx?pane=right";
							break;
						case PAGE_LH:
							$location = $lang['Viewing_login_history'];
							$location_url = "ct_login_history.php.$phpEx?pane=right";
							break;
						case PAGE_UU:
							$location = $lang['Viewing_uu'];
							$location_url = "ctracker_login.php.$phpEx?pane=right";
							break;
						case PAGE_CONTACT:
							$location = $lang['Viewing_contact'];
							$location_url = "contact.$phpEx?pane=right";
							break;
						case PAGE_FILES:
							$location = $lang['Viewing_files'];
							$location_url = "download.php.$phpEx?pane=right";
							break;
						case PAGE_MODLIST:
							$location = $lang['Viewing_modlist'];
							$location_url = "modlist.$phpEx?pane=right";
							break;
						case PAGE_PORTAL:
							$location = $lang['Viewing_portal'];
							$location_url = "portal.$phpEx?pane=right";
							break;
						case PAGE_RC:
							$location = $lang['Viewing_rc'];
							$location_url = "remove_cookies.$phpEx?pane=right";
							break;
						case PAGE_REPORT:
							$location = $lang['Viewing_report'];
							$location_url = "report.$phpEx?pane=right";
							break;
						case PAGE_STAFF:
							$location = $lang['Viewing_staff'];
							$location_url = "staff.$phpEx?pane=right";
							break;
						case PAGE_URLLIST:
							$location = $lang['Viewing_urllist'];
							$location_url = "urllist.$phpEx?pane=right";
							break;
						case PAGE_SINGLE_POST:
							$location = $lang['Viewing_single_post'];
							$location_url = "viewpost.$phpEx?pane=right";
							break;
						case PAGE_WT:
							$location = $lang['Viewing_wt'];
							$location_url = "watched_topics.$phpEx?pane=right";
							break;
						case PAGE_ATTACH_RULES:
							$location = $lang['Viewing_attach_rules'];
							$location_url = "attach_rules.$phpEx?pane=right";
							break;
						case PAGE_ATTACH:
							$location = $lang['Viewing_attach'];
							$location_url = "attachments.$phpEx?pane=right";
							break;
						case PAGE_BANLIST:
							$location = $lang['Viewing_banlist'];
							$location_url = "banlist.$phpEx?pane=right";
							break;
						case PAGE_RECENT:
							$location = $lang['Recent_topics'];
							$location_url = "recent.$phpEx?pane=right";
							break;
						case PAGE_RULES:
							$location = $lang['Viewing_RULES'];
							$location_url = "rules.$phpEx?pane=right";
							break;
						case PAGE_POLL_OVERVIEW:
							$location = $lang['poll_overview'];
							$location_url = "anket.$phpEx?pane=right";
							break;
						default:
							$location = $lang['Forum_index'];
							$location_url = "index.$phpEx?pane=right";
					}
				}
				else
				{
					$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_reg[$i]['user_session_page']);
					$location = $forum_data[$onlinerow_reg[$i]['user_session_page']];
				}

				$row_color = ( $registered_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( $registered_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

				$reg_ip = decode_ip($onlinerow_reg[$i]['session_ip']);

				$template->assign_block_vars("reg_user_row", array(
					"ROW_COLOR" => "#" . $row_color,
					"ROW_CLASS" => $row_class,
					"USERNAME" => $username,
					"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['session_start'], $board_config['board_timezone']),
					"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_reg[$i]['user_session_time'], $board_config['board_timezone']),
					"FORUM_LOCATION" => $location,
					"IP_ADDRESS" => $reg_ip,

					"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$reg_ip",
					"U_USER_PROFILE" => append_sid("admin_users.$phpEx?mode=edit&amp;" . POST_USERS_URL . "=" . $onlinerow_reg[$i]['user_id']),
					"U_FORUM_LOCATION" => append_sid($location_url))
				);
			}
		}

	}
	else
	{
		$template->assign_vars(array("L_NO_REGISTERED_USERS_BROWSING" => $lang['No_users_browsing']));
	}

	//
	// Guest users
	//
	if( count($onlinerow_guest) )
	{
		$guest_users = 0;

		for($i = 0; $i < count($onlinerow_guest); $i++)
		{
			$guest_userip_ary[] = $onlinerow_guest[$i]['session_ip'];
			$guest_users++;

			if( $onlinerow_guest[$i]['session_page'] < 1 )
			{
				switch( $onlinerow_guest[$i]['session_page'] )
				{
					case PAGE_INDEX:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_POSTING:
						$location = $lang['Posting_message'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_LOGIN:
						$location = $lang['Logging_on'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_SEARCH:
						$location = $lang['Searching_forums'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PROFILE:
						$location = $lang['Viewing_profile'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWONLINE:
						$location = $lang['Viewing_online'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_VIEWMEMBERS:
						$location = $lang['Viewing_member_list'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_PRIVMSGS:
						$location = $lang['Viewing_priv_msgs'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_FAQ:
						$location = $lang['Viewing_FAQ'];
						$location_url = "index.$phpEx?pane=right";
						break;
					case PAGE_RSS:
						$location = $lang['Viewing_rss'];
						$location_url = "rss.$phpEx?pane=right";
						break;
					case PAGE_FAV:
						$location = $lang['Viewing_fav'];
						$location_url = "favorites.$phpEx?pane=right";
						break;
					case PAGE_GSM:
						$location = $lang['Viewing_gsm'];
						$location_url = "google_sitemap.$phpEx?pane=right";
						break;
					case PAGE_LH:
						$location = $lang['Viewing_login_history'];
						$location_url = "ct_login_history.php.$phpEx?pane=right";
						break;
					case PAGE_UU:
						$location = $lang['Viewing_uu'];
						$location_url = "ctracker_login.php.$phpEx?pane=right";
						break;
					case PAGE_CONTACT:
						$location = $lang['Viewing_contact'];
						$location_url = "contact.$phpEx?pane=right";
						break;
					case PAGE_FILES:
						$location = $lang['Viewing_files'];
						$location_url = "download.php.$phpEx?pane=right";
						break;
					case PAGE_MODLIST:
						$location = $lang['Viewing_modlist'];
						$location_url = "modlist.$phpEx?pane=right";
						break;
					case PAGE_PORTAL:
						$location = $lang['Viewing_portal'];
						$location_url = "portal.$phpEx?pane=right";
						break;
					case PAGE_RC:
						$location = $lang['Viewing_rc'];
						$location_url = "remove_cookies.$phpEx?pane=right";
						break;
					case PAGE_REPORT:
						$location = $lang['Viewing_report'];
						$location_url = "report.$phpEx?pane=right";
						break;
					case PAGE_STAFF:
						$location = $lang['Viewing_staff'];
						$location_url = "staff.$phpEx?pane=right";
						break;
					case PAGE_URLLIST:
						$location = $lang['Viewing_urllist'];
						$location_url = "urllist.$phpEx?pane=right";
						break;
					case PAGE_SINGLE_POST:
						$location = $lang['Viewing_single_post'];
						$location_url = "viewpost.$phpEx?pane=right";
						break;
					case PAGE_WT:
						$location = $lang['Viewing_wt'];
						$location_url = "watched_topics.$phpEx?pane=right";
						break;
					case PAGE_ATTACH_RULES:
						$location = $lang['Viewing_attach_rules'];
						$location_url = "attach_rules.$phpEx?pane=right";
						break;
					case PAGE_ATTACH:
						$location = $lang['Viewing_attach'];
						$location_url = "attachments.$phpEx?pane=right";
						break;
					case PAGE_BANLIST:
						$location = $lang['Viewing_banlist'];
						$location_url = "banlist.$phpEx?pane=right";
						break;
					case PAGE_RECENT:
						$location = $lang['Recent_topics'];
						$location_url = "recent.$phpEx?pane=right";
						break;
					case PAGE_RULES:
						$location = $lang['Viewing_RULES'];
						$location_url = "rules.$phpEx?pane=right";
						break;
					case PAGE_POLL_OVERVIEW:
						$location = $lang['poll_overview'];
						$location_url = "anket.$phpEx?pane=right";
						break;
					default:
						$location = $lang['Forum_index'];
						$location_url = "index.$phpEx?pane=right";
				}
			}
			else
			{
			$location_url = append_sid("admin_forums.$phpEx?mode=editforum&amp;" . POST_FORUM_URL . "=" . $onlinerow_guest[$i]['session_page']);
			$location = $forum_data[$onlinerow_guest[$i]['session_page']];
			}

			$row_color = ( $guest_users % 2 ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( $guest_users % 2 ) ? $theme['td_class1'] : $theme['td_class2'];

			$guest_ip = decode_ip($onlinerow_guest[$i]['session_ip']);

			//MOD Show Search Bot 
			if ($board_config['show_search_bots'])
			{	
				$name_guest = $lang['Guest']; 
				$tmp_list = explode(".", $guest_ip); 
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
				$name_guest = 'Google';
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
					$name_guest = 'MSN';
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
					$name_guest = 'Yahoo';
				}
				
			}//End Show Search Bot

			$template->assign_block_vars("guest_user_row", array(
				"ROW_COLOR" => "#" . $row_color,
				"ROW_CLASS" => $row_class,
				"USERNAME" => $lang['Guest'],
				"USERNAME" => $name_guest,
				"STARTED" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_start'], $board_config['board_timezone']),
				"LASTUPDATE" => create_date($board_config['default_dateformat'], $onlinerow_guest[$i]['session_time'], $board_config['board_timezone']),
				"FORUM_LOCATION" => $location,
				"IP_ADDRESS" => $guest_ip,

				"U_WHOIS_IP" => "http://network-tools.com/default.asp?host=$guest_ip",
				"U_FORUM_LOCATION" => append_sid($location_url))
			);
		}
	}
	else
	{
		$template->assign_vars(array("L_NO_GUESTS_BROWSING" => $lang['No_users_browsing']));
	}


	// Check for new version
	$current_version = explode('.', '2' . $board_config['version']);
	$minor_revision = (int) $current_version[2];

	$errno = 0;
	$errstr = $version_info = '';

	// Version cache mod start
	// Change following two variables if you need to:
	$cache_update = 86400; // 24 hours cache timeout. change it to whatever you want
	$cache_file = '../cache/phpbb_update_' . $board_config['default_lang'] . $board_config['version'] . '.php'; // file where to store cache

	$do_update = true;
	if(@file_exists($cache_file))
	{
		$last_update = 0;
		$version_info = '';
		@include($cache_file);
		if($last_update && !empty($version_info) && $last_update > (time() - $cache_update))
		{
			$do_update = false;
		}
		else
		{
			$version_info = '';
		}
	}

	if($do_update)
	{
		//---[+]--- auto repair -------
		if ( $board_config['allow_automat']) 
		{
			$tablequery = "show tables like '".$table_prefix."%'";
			$tablelist = mysql_query($tablequery);

			//echo "<p align='center'><b>Database Ýþlemleri</b><ul>";
			while ($tar = mysql_fetch_array($tablelist))
			{
				$tablename = $tar[0];

				$sql = "REPAIR table $tablename";
				if(!$result = mysql_query ($sql) ) 
				{ 
					//echo '<br />[ - ] '.$sql;
				}
				else
				{
					//echo '<br />[ + ] '.$sql;
				}

				$sql = "OPTIMIZE table $tablename";
				if(!$result = mysql_query ($sql) ) 
				{ 
					//echo '<br />[ - ] '.$sql;
				}
				else
				{
					//echo '<br />[ + ] '.$sql;
				}
			}
		}
		//---[-]--- auto repair -------

		if ($fsock = @fsockopen('www.phpbb.com', 80, $errno, $errstr, 10))
		{
			@fputs($fsock, "GET /updatecheck/20x.txt HTTP/1.1\r\n");
			@fputs($fsock, "HOST: www.phpbb.com\r\n");
			@fputs($fsock, "Connection: close\r\n\r\n");

			$get_info = false;
			while (!@feof($fsock))
			{
				if ($get_info)
				{
					$version_info .= @fread($fsock, 1024);
				}
				else
				{
					if (@fgets($fsock, 1024) == "\r\n")
					{
						$get_info = true;
					}
				}
			}
			@fclose($fsock);

			$version_info = explode("\n", $version_info);
			$latest_head_revision = (int) $version_info[0];
			$latest_minor_revision = (int) $version_info[2];
			$latest_version = (int) $version_info[0] . '.' . (int) $version_info[1] . '.' . (int) $version_info[2];

			if ($latest_head_revision == 2 && $minor_revision == $latest_minor_revision)
			{
				$version_info = '<p style="color:green">' . $lang['Version_up_to_date'] . '</p>';
			}
			else
			{
				$version_info = '<p style="color:red">' . $lang['Version_not_up_to_date'];
				$version_info .= '<br />' . sprintf($lang['Latest_version_info'], $latest_version) . ' ' . sprintf($lang['Current_version_info'], '2' . $board_config['version']) . '</p>';
			}
		}
		else
		{
			if ($errstr)
			{
				$version_info = '<p style="color:red">' . sprintf($lang['Connect_socket_error'], $errstr) . '</p>';
			}
			else
			{
				$version_info = '<p>' . $lang['Socket_functions_disabled'] . '</p>';
			}
		}

		$version_info .= '<p>' . $lang['Mailing_list_subscribe_reminder'] . '</p>';
		// Version cache mod start
		if(@$f = fopen($cache_file, 'w'))
		{
			$search = array('\\', '\'');
			$replace = array('\\\\', '\\\'');
			fwrite($f, '<' . '?php $last_update = ' . time() . '; $version_info = \'' . str_replace($search, $replace, $version_info) . '\'; ?' . '>');
			fclose($f);
			@chmod($cache_file, 0777);
		}
	}
	// Version cache mod end


	$template->assign_vars(array(
		'VERSION_INFO' => $version_info,
		'L_VERSION_INFORMATION' => $lang['Version_information'])
	);

	$template->pparse("body");

	include('./page_footer_admin.'.$phpEx);
}
else
{
	// Generate frameset
	$template->set_filenames(array("body" => "admin/index_frameset.tpl"));

	$template->assign_vars(array(
		'ADMIN_PANEL' => $lang['Admin_panel'],
		'SITENAME' => $board_config['sitename'],
		'S_FRAME_TOP' => append_sid("index.$phpEx?pane=top"),
		'S_FRAME_NAV' => append_sid("index.$phpEx?pane=left"),
		'S_FRAME_MAIN' => append_sid("index.$phpEx?pane=right"))
	);

	@header ("Expires: " . gmdate("D, d M Y H:i:s", time()) . " GMT");
	@header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

	$template->pparse("body");

	$db->sql_close();
	exit;

}


?>