<?php
/***************************************************************************
* functions.php
***************************************************************************/
// CTracker_Ignore: File Checked By Human

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}


function get_db_stat($mode)
{
	global $db, $userdata;
	
	switch( $mode )
	{
		case 'usercount':
			if ($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD)
			{
				$sql = "SELECT COUNT(user_id) AS total
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS;
			}
			else
			{
				$sql = "SELECT COUNT(user_id) AS total
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS. " AND user_active = 1";
			}
			break;

		case 'newestuser':
			if ($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD)
			{
				$sql = "SELECT user_id, username
				FROM " . USERS_TABLE . "
				WHERE user_id <> " . ANONYMOUS . "
				ORDER BY user_regdate DESC
				LIMIT 1";
			}
			else
			{
				$sql = "SELECT user_id, username, user_regdate
					FROM " . USERS_TABLE . "
					WHERE user_id <> " . ANONYMOUS . " AND user_active = 1
						ORDER BY user_id DESC
					LIMIT 1";
			}
			break;

		case 'postcount':
		case 'topiccount':
			$sql = "SELECT SUM(forum_topics) AS topic_total, SUM(forum_posts) AS post_total 
				FROM " . FORUMS_TABLE;
			break;
		// türkphpbb ezPortal Canli Istatistik
		case 'total_posters': 
			$sql = "SELECT COUNT(user_id) AS posters 
				FROM " . USERS_TABLE . " 
				WHERE user_id <> " . ANONYMOUS . " AND user_posts > 0"; 
		break;
		// türkphpbb ezPortal Canli Istatistik
		case 'wached_total':
			$sql = "SELECT COUNT(topic_id) AS wached_total
			FROM " . TOPICS_WATCH_TABLE;
			break;

		case 'userwatched':
			$sql = "SELECT COUNT(topic_id) AS user_watched
			FROM " . TOPICS_WATCH_TABLE . "
			WHERE user_id = " . $userdata['user_id'];
			break;

		case 'usertopics':
			$sql = "SELECT COUNT(topic_id) AS user_topics
			FROM " . TOPICS_TABLE . "
			WHERE topic_poster = " . $userdata['user_id'];
			break;

		case 'newposttotal':
			$sql = "SELECT COUNT(post_id) AS newpost_total
			FROM " . POSTS_TABLE . "
			WHERE post_time > " . $userdata['user_lastvisit'];
			break;

		case 'newtopictotal':
			$sql = "SELECT COUNT(distinct p.post_id) AS newtopic_total
			FROM " . POSTS_TABLE . " p, " . TOPICS_TABLE . " t
			WHERE p.post_time > " . $userdata['user_lastvisit'] . "
			AND p.post_id = t.topic_first_post_id";
			break;

		case 'newannouncementtotal':
			$sql = "SELECT COUNT(distinct t.topic_id) AS newannouncement_total
			FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
			WHERE t.topic_type = 2
			AND p.post_time > " . $userdata['user_lastvisit'] . "
			AND p.post_id = t.topic_first_post_id";
			break;

		case 'announcementtotal':
			$sql = "SELECT COUNT(distinct t.topic_id) AS announcement_total
			FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
			WHERE t.topic_type = 2
			AND p.post_id = t.topic_first_post_id";
			break;

		case 'newstickytotal':
			$sql = "SELECT COUNT(distinct t.topic_id) AS newsticky_total
			FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
			WHERE t.topic_type = 1
			AND p.post_time > " . $userdata['user_lastvisit'] . "
			AND p.post_id = t.topic_first_post_id";
			break;

		case 'stickytotal':
			$sql = "SELECT COUNT(distinct t.topic_id) AS sticky_total
			FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
			WHERE t.topic_type = 1
			AND p.post_id = t.topic_first_post_id";
			break;
	}

	if ( !($result = $db->sql_query($sql)) )
	{
		return false;
	}
	
	$row = $db->sql_fetchrow($result);
//sql cache artýðý
	$db -> sql_freeresult($result);
	
	switch ( $mode )
	{
		case 'usercount':
		return $row['total'];
		break;
		
		case 'newestuser':
		return $row;
		break;
		
		case 'postcount':
		return $row['post_total'];
		break;
		
		case 'topiccount':
		return $row['topic_total'];
		break;

		// türkphpbb ezPortal Canli Istatistik
		case 'total_posters': 
		return $row['posters']; 
		break;
		// türkphpbb ezPortal Canli Istatistik

		case 'wached_total':
		return $row['wached_total'];
		break;

		case 'userwatched':
		return $row['user_watched'];
		break;

		case 'usertopics':
		return $row['user_topics'];
		break;

		case 'newposttotal':
		return $row['newpost_total'];
		break;

		case 'newtopictotal':
		return $row['newtopic_total'];
		break;

		case 'newannouncementtotal':
		return $row['newannouncement_total'];
		break;

		case 'announcementtotal':
		return $row['announcement_total'];
		break;

		case 'newstickytotal':
		return $row['newsticky_total'];
		break;

		case 'stickytotal':
		return $row['sticky_total'];
		break;
	}

	return false;
}

// added at phpBB 2.0.11 to properly format the username
function phpbb_clean_username($username)
{
	$username = substr(htmlspecialchars(str_replace("\'", "'", trim($username))), 0, 25);
	$username = phpbb_rtrim($username, "\\");
	$username = str_replace("'", "\'", $username);
	
	return $username;
}

/**
* This function is a wrapper for ltrim, as charlist is only supported in php >= 4.1.0
* Added in phpBB 2.0.18
*/
function phpbb_ltrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return ltrim($str);
	}

	$php_version = explode('.', PHP_VERSION);

	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{0} == $charlist)
		{
		$str = substr($str, 1);
		}
	}
	else
	{
		$str = ltrim($str, $charlist);
	}
	
	return $str;
}

/**
* Our own generator of random values
* This uses a constantly changing value as the base for generating the values
* The board wide setting is updated once per page if this code is called
* With thanks to Anthrax101 for the inspiration on this one
* Added in phpBB 2.0.20
*/
function dss_rand()
{
	global $db, $board_config, $dss_seeded;

	$val = $board_config['rand_seed'] . microtime();
	$val = md5($val);
	$board_config['rand_seed'] = md5($board_config['rand_seed'] . $val . 'a');

	if($dss_seeded !== true)
	{
		$sql = "UPDATE " . CONFIG_TABLE . " SET
			config_value = '" . $board_config['rand_seed'] . "'
			WHERE config_name = 'rand_seed'";

		if( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, "Unable to reseed PRNG", "", __LINE__, __FILE__, $sql);
		}

		$dss_seeded = true;
	}

	return substr($val, 4, 16);
}


// added at phpBB 2.0.12 to fix a bug in PHP 4.3.10 (only supporting charlist in php >= 4.1.0)
function phpbb_rtrim($str, $charlist = false)
{
	if ($charlist === false)
	{
		return rtrim($str);
	}

	$php_version = explode('.', PHP_VERSION);

	// php version < 4.1.0
	if ((int) $php_version[0] < 4 || ((int) $php_version[0] == 4 && (int) $php_version[1] < 1))
	{
		while ($str{strlen($str)-1} == $charlist)
		{
			$str = substr($str, 0, strlen($str)-1);
		}
	}
	else
	{
		$str = rtrim($str, $charlist);
	}

	return $str;
}

// Get Userdata, $user can be username or user_id. If force_str is true, the username will be forced.
function get_userdata($user, $force_str = false)
{
	global $db;
	
	if (!is_numeric($user) || $force_str)
	{
		$user = phpbb_clean_username($user);
	}
	else
	{
		$user = intval($user);
	}

	$sql = "SELECT * FROM " . USERS_TABLE . " WHERE ";
	$sql .= ( ( is_integer($user) ) ? "user_id = $user" : "username = '" .	str_replace("\'", "''", $user) . "'" ) . " AND user_id <> " . ANONYMOUS;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Tried obtaining data for a non-existent user', '', __LINE__, __FILE__, $sql);
	}

	return ( $row = $db->sql_fetchrow($result) ) ? $row : false;
}

function make_jumpbox($action, $match_forum_id = 0)
{
	$list = array();
	return make_jumpbox_ref($action, $match_forum_id, $list);
}

function make_jumpbox_ref($action, $match_forum_id, &$forums_list)
{

	global $template, $userdata, $lang, $db, $nav_links, $phpEx, $SID;

	$is_auth = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata);

	$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
		FROM " . CATEGORIES_TABLE . " c, " . FORUMS_TABLE . " f
		WHERE f.cat_id = c.cat_id
		GROUP BY c.cat_id, c.cat_title, c.cat_order
		ORDER BY c.cat_order";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't obtain category list.", "", __LINE__, __FILE__, $sql);
	}
	
	$category_rows = array();
	while ( $row = $db->sql_fetchrow($result) )
	{
		$category_rows[] = $row;
	}
	$db->sql_freeresult($result);

	if ( $total_categories = count($category_rows) )
	{
		$sql = "SELECT *
			FROM " . FORUMS_TABLE . "
			ORDER BY cat_id, forum_order";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
		}

		$boxstring = '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"><option value="-1">' . $lang['Select_forum'] . '</option>';

		$forum_rows = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$forum_rows[] = $row;
			// Begin Simple Subforums MOD
			$forums_list[] = $row;
			// End Simple Subforums MOD
		}

		if ( $total_forums = count($forum_rows) )
		{
			for($i = 0; $i < $total_categories; $i++)
			{
				$boxstring_forums = '';
				for($j = 0; $j < $total_forums; $j++)
				{
					if (  !$forum_rows[$j]['forum_parent'] && $forum_rows[$j]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$j]['auth_view'] <= AUTH_REG )
					{

						// Begin Simple Subforums MOD
						$id = $forum_rows[$j]['forum_id'];
						// End Simple Subforums MOD
						$selected = ( $forum_rows[$j]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';
						$boxstring_forums .=  '<option value="' . $forum_rows[$j]['forum_id'] . '"' . $selected . '>' . $forum_rows[$j]['forum_name'] . '</option>';

						//
						// Add an array to $nav_links for the Mozilla navigation bar.
						// 'chapter' and 'forum' can create multiple items, therefore we are using a nested array.
						//
						$nav_links['chapter forum'][$forum_rows[$j]['forum_id']] = array (
							'url' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$j]['forum_id']),
							'title' => $forum_rows[$j]['forum_name']
						);
						// Begin Simple Subforums MOD
						for( $k = 0; $k < $total_forums; $k++ )
						{
							if ( $forum_rows[$k]['forum_parent'] == $id && $forum_rows[$k]['cat_id'] == $category_rows[$i]['cat_id'] && $forum_rows[$k]['auth_view'] <= AUTH_REG )
							{
								$selected = ( $forum_rows[$k]['forum_id'] == $match_forum_id ) ? 'selected="selected"' : '';
								$boxstring_forums .=  '<option value="' . $forum_rows[$k]['forum_id'] . '"' . $selected . '>-- ' . $forum_rows[$k]['forum_name'] . '</option>';

								//
								// Add an array to $nav_links for the Mozilla navigation bar.
								// 'chapter' and 'forum' can create multiple items, therefore we are using a nested array.
								//
								$nav_links['chapter forum'][$forum_rows[$k]['forum_id']] = array (
									'url' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_rows[$k]['forum_id']),
									'title' => $forum_rows[$k]['forum_name']
								);
								
							}
						}
						// End Simple Subforums MOD
						
								
					}
				}

				if ( $boxstring_forums != '' )
				{
                                  $boxstring .= '<optgroup label="' . $category_rows[$i]['cat_title'] . '">';
                                  $boxstring .= $boxstring_forums;
                                  $boxstring .= '</optgroup>';
				}
			}
		}

		$boxstring .= '</select>';
	}
	else
	{
		$boxstring .= '<select name="' . POST_FORUM_URL . '" onchange="if(this.options[this.selectedIndex].value != -1){ forms[\'jumpbox\'].submit() }"></select>';
	}

	// Let the jumpbox work again in sites having additional session id checks.
//	if ( !empty($SID) )
//	{
		$boxstring .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';
//	}

	$template->set_filenames(array(
		'jumpbox' => 'jumpbox.tpl')
	);
	$template->assign_vars(array(
		'L_GO' => $lang['Go'],
		'L_JUMP_TO' => $lang['Jump_to'],
		'L_SELECT_FORUM' => $lang['Select_forum'],

		'S_JUMPBOX_SELECT' => $boxstring,
		'S_JUMPBOX_ACTION' => append_sid($action))
	);
	$template->assign_var_from_handle('JUMPBOX', 'jumpbox');

	return;
}

//
// Initialise user settings on page load
function init_userprefs($userdata)
{
	global $board_config, $theme, $images;
	global $template, $lang, $phpEx, $phpbb_root_path;
	global $nav_links;

	//-- mod : mods settings ---------------------------------------------------------------------------
	global $db, $mods, $list_yes_no, $userdata;
	include_once($phpbb_root_path . 'includes/mods_settings/mod_split_topic_type.' . $phpEx);
	//-- profile cp --------------------------------------------------------------------------

	if ( $userdata['user_id'] != ANONYMOUS )
	{
		if ( !empty($userdata['user_lang']))
		{
			$default_lang = phpbb_ltrim(basename(phpbb_rtrim($userdata['user_lang'])), "'");
		}

		if ( !empty($userdata['user_dateformat']) )
		{
			$board_config['default_dateformat'] = $userdata['user_dateformat'];
		}

		if ( isset($userdata['user_timezone']) )
		{
			$board_config['board_timezone'] = $userdata['user_timezone'];
		}
	}
	else
	{
		$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
	}

	if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
	{
		if ( $userdata['user_id'] != ANONYMOUS )
		{
			// For logged in users, try the board default language next
			$default_lang = phpbb_ltrim(basename(phpbb_rtrim($board_config['default_lang'])), "'");
		}
		else
		{
			// For guests it means the default language is not present, try english
			// This is a long shot since it means serious errors in the setup to reach here,
			// but english is part of a new install so it's worth us trying
			$default_lang = 'english';
		}

		if ( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $default_lang . '/lang_main.'.$phpEx)) )
		{
			message_die(CRITICAL_ERROR, 'Geçerli dil dosyasý bulunamadý');
		}
	}

	// If we've had to change the value in any way then let's write it back to the database
	// before we go any further since it means there is something wrong with it
	if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . USERS_TABLE . "
		SET user_lang = '" . $default_lang . "'
		WHERE user_lang = '" . $userdata['user_lang'] . "'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}

		$userdata['user_lang'] = $default_lang;
	}
	elseif ( $userdata['user_id'] === ANONYMOUS && $board_config['default_lang'] !== $default_lang )
	{
		$sql = 'UPDATE ' . CONFIG_TABLE . "
		SET config_value = '" . $default_lang . "'
		WHERE config_name = 'default_lang'";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(CRITICAL_ERROR, 'Could not update user language info');
		}
	}

	$board_config['default_lang'] = $default_lang;

	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.' . $phpEx);
	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_cback_ctracker.' . $phpEx);
	include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_captcha.' . $phpEx);
	
	if ( defined('IN_ADMIN') )
	{
		if( !file_exists(@phpbb_realpath($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.'.$phpEx)) )
		{
			$board_config['default_lang'] = 'english';
		}

		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);
	}

	@include($phpbb_root_path . './includes/lang_extend_mac.' . $phpEx);

	include_attach_lang();

   //
   // Mozilla navigation bar
   // Default items that should be valid on all pages.
   // Defined here to correctly assign the Language Variables
   // and be able to change the variables within code.
   //
   $nav_links['top'] = array (
      'url' => append_sid($phpbb_root_path . 'index.' . $phpEx),
      'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
   );
   $nav_links['search'] = array (
      'url' => append_sid($phpbb_root_path . 'search.' . $phpEx),
      'title' => $lang['Search']
   );
   $nav_links['help'] = array (
      'url' => append_sid($phpbb_root_path . 'faq.' . $phpEx),
      'title' => $lang['FAQ']
   );
   $nav_links['author'] = array (
      'url' => append_sid($phpbb_root_path . 'memberlist.' . $phpEx),
      'title' => $lang['Memberlist']
   );
	// Set up style
	if ( !$board_config['override_user_style'] )
	{
		if ( $userdata['user_id'] != ANONYMOUS && $userdata['user_style'] > 0 )
		{
			if ( $theme = setup_style($userdata['user_style']) )
			{
				return;
			}
		}
		// BEGIN theme selection box hack
		global $url_theme;
		if ( $url_theme > 0 )
		{
			if ( $theme = setup_style($url_theme) )
			{
				return;
			}
		}
		// END theme selection box hack
	}

	$theme = setup_style($board_config['default_style']);
	return;
}

function setup_style($style)
{
	global $db, $board_config, $template, $images, $phpbb_root_path;

	$sql = 'SELECT * FROM ' . THEMES_TABLE . ' WHERE themes_id = ' . (int) $style;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(CRITICAL_ERROR, 'Could not query database for theme info');
	}

	if ( !($row = $db->sql_fetchrow($result)) )
	{
		// We are trying to setup a style which does not exist in the database
		// Try to fallback to the board default (if the user had a custom style)
		// and then any users using this style to the default if it succeeds
		if ( $style != $board_config['default_style'])
		{
			$sql = 'SELECT * FROM ' . THEMES_TABLE . ' WHERE themes_id = ' . (int) $board_config['default_style'];
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(CRITICAL_ERROR, 'Could not query database for theme info');
			}
			$db->sql_freeresult($result);

			if ( $row = $db->sql_fetchrow($result) )
			{
				$db->sql_freeresult($result);

				$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_style = ' . (int) $board_config['default_style'] . "
				WHERE user_style = $style";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(CRITICAL_ERROR, 'Could not update user theme info');
				}
				$db->sql_freeresult($result);
			}
			else
			{
				message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
			}
		}
		else
		{
			message_die(CRITICAL_ERROR, "Could not get theme data for themes_id [$style]");
		}
	}
	
	$template_path = 'templates/' ;
	$template_name = $row['template_name'] ;
	
	$template = new Template($phpbb_root_path . $template_path . $template_name);
	
	// Global Admin Template - Begin Code Alteration
	if ( defined('IN_ADMIN') )
	{
		$template->set_rootdir($phpbb_root_path . $template_path .'.');
	}
	// Global Admin Template - End Code Alteration

	if ( $template )
	{
		$current_template_path = $template_path . $template_name;
		@include($phpbb_root_path . $template_path . $template_name . '/' . $template_name . '.cfg');
		
		if ( !defined('TEMPLATE_CONFIG') )
		{
			//---[+]-- terminatatör uykuda -----
			/*$sql = "UPDATE " . USERS_TABLE . " SET user_style = NULL WHERE user_id > 1";
			if ( !($result = $db->sql_query($sql)) )
			{
			message_die(CRITICAL_ERROR, 'Bütün üye temalarý sýfýrlanamadý');
			}
			*///---[-]-- terminatatör-----
			message_die(CRITICAL_ERROR, "Could not open $template_name template config file", '', __LINE__, __FILE__);
		}

		$img_lang = ( file_exists(@phpbb_realpath($phpbb_root_path . $current_template_path . '/images/lang_' . $board_config['default_lang'])) ) ? $board_config['default_lang'] : 'english';

		while( list($key, $value) = @each($images) )
		{
			if ( !is_array($value) )
			{
				$images[$key] = str_replace('{LANG}', 'lang_' . $img_lang, $value);
			}
		}
	}
	return $row;
}

function encode_ip($dotquad_ip)
{
	$ip_sep = explode('.', $dotquad_ip);
	return sprintf('%02x%02x%02x%02x', $ip_sep[0], $ip_sep[1], $ip_sep[2], $ip_sep[3]);
}

function decode_ip($int_ip)
{
	$hexipbang = explode('.', chunk_split($int_ip, 2, '.'));
	return hexdec($hexipbang[0]). '.' . hexdec($hexipbang[1]) . '.' . hexdec($hexipbang[2]) . '.' . hexdec($hexipbang[3]);
}

// Create date/time from format and timezone
function create_date($format, $gmepoch, $tz)
{
	global $board_config, $lang;
	static $translate;

	if ( empty($translate) && $board_config['default_lang'] != 'english' )
	{
		@reset($lang['datetime']);
		while ( list($match, $replace) = @each($lang['datetime']) )
		{
			$translate[$match] = $replace;
		}
	}

	return ( !empty($translate) ) ? strtr(@gmdate($format, $gmepoch + (3600 * $tz)), $translate) : @gmdate($format, $gmepoch + (3600 * $tz));
}

// Pagination routine, generates
// page number sequence
function generate_pagination($base_url, $num_items, $per_page, $start_item, $add_prevnext_text = TRUE)
{
	global $lang;

	$begin_end = 3;
	$from_middle = 1;

	$total_pages = ceil($num_items/$per_page);

	if ( $total_pages == 1 )
	{
		return '';
	}

	// Start Fix Wrong Pagination Number MOD
	if ( !( $num_items > 0 ) )
	{
		return '';
	}
	// End Fix Wrong Pagination Number MOD

	$on_page = floor($start_item / $per_page) + 1;

	$page_string = '';
	if ( $total_pages > ((2*($begin_end + $from_middle)) + 2) )
	{
		$init_page_max = ( $total_pages > $begin_end ) ? $begin_end : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
			if ( $i <	$init_page_max )
			{
				$page_string .= ", ";
			}
		}

		if ( $total_pages > $begin_end )	
		{
			if ( $on_page > 1	&& $on_page < $total_pages )
			{
				$page_string .= ( $on_page > ($begin_end + $from_middle + 1) ) ? ' ... ' : ', ';
				$init_page_min = ( $on_page > ($begin_end + $from_middle) ) ? $on_page : ($begin_end + $from_middle + 1);
				$init_page_max = ( $on_page < $total_pages - ($begin_end + $from_middle) ) ? $on_page : $total_pages - ($begin_end + $from_middle);

				for($i = $init_page_min - $from_middle; $i < $init_page_max + ($from_middle + 1); $i++)
				{
					$page_string .= ($i == $on_page) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
					if ( $i <	$init_page_max + $from_middle )
					{
						$page_string .= ', ';
					}
				}
	
				//		$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
				$page_string .= ( $on_page < $total_pages - ($begin_end + $from_middle) ) ? ' ... ' : ', ';
			}
			else
			{
				$page_string .= ' ... ';
			}

			for($i = $total_pages - ($begin_end - 1); $i < $total_pages + 1; $i++)
			{
				$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>'	: '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
				if( $i <	$total_pages )
				{
					$page_string .= ", ";
				}
			}
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<b>' . $i . '</b>' : '<a href="' . append_sid($base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) ) . '">' . $i . '</a>';
			if ( $i <	$total_pages )
			{
				$page_string .= ', ';
			}
		}
	}
	
	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
		{
		$page_string = ' <a href="' . append_sid($base_url . "&amp;start=" . ( ( $on_page - 2 ) * $per_page ) ) . '">' . $lang['Previous'] . '</a>&nbsp;&nbsp;' . $page_string;
		}
		
		if ( $on_page < $total_pages )
		{
		$page_string .= '&nbsp;&nbsp;<a href="' . append_sid($base_url . "&amp;start=" . ( $on_page * $per_page ) ) . '">' . $lang['Next'] . '</a>';
		}
	}

	$page_string = $lang['Goto_page'] . ' ' . $page_string;

	return $page_string;
}


// This does exactly what preg_quote() does in PHP 4-ish
// If you just need the 1-parameter preg_quote call, then don't bother using this.
function phpbb_preg_quote($str, $delimiter)
{
	$text = preg_quote($str);
	$text = str_replace($delimiter, '\\' . $delimiter, $text);
	
	return $text;
}

//
// Obtain list of naughty words and build preg style replacement arrays for use by the
// calling script, note that the vars are passed as references this just makes it easier
// to return both sets of arrays
//
function obtain_word_list(&$orig_word, &$replacement_word)
{
	global $db;
	
	//
	// Define censored word matches
	//
	$sql = "SELECT word, replacement FROM	" . WORDS_TABLE;
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not get censored words from database', '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		do
		{
			$orig_word[] = '#\b(' . str_replace('\*', '\w*?', preg_quote($row['word'], '#')) . ')\b#i';
			$replacement_word[] = $row['replacement'];
		}
		while ( $row = $db->sql_fetchrow($result) );
	}

	return true;
}

function message_die($msg_code, $msg_text = '', $msg_title = '', $err_line = '', $err_file = '', $sql = '')
{
	global $db, $template, $board_config, $theme, $lang, $phpEx, $phpbb_root_path, $nav_links, $gen_simple_header, $images;
	global $userdata, $user_ip, $session_length;
	global $starttime;

	//+MOD: Fix message_die for multiple errors MOD
	static $msg_history;
	if( !isset($msg_history) )
	{
		$msg_history = array();
	}
	$msg_history[] = array(
		'msg_code' => $msg_code,
		'msg_text' => $msg_text,
		'msg_title' => $msg_title,
		'err_line' => $err_line,
		'err_file' => $err_file,
		'sql'	=> $sql
	);
	//-MOD: Fix message_die for multiple errors MOD

	if(defined('HAS_DIED'))
	{
		//+MOD: Fix message_die for multiple errors MOD

		// This message is printed at the end of the report.
		// Of course, you can change it to suit your own needs. ;-)
		$custom_error_message = 'Please, contact the %swebmaster%s. Thank you.';
		if ( !empty($board_config) && !empty($board_config['board_email']) )
		{
			$custom_error_message = sprintf($custom_error_message, '<a href="mailto:' . $board_config['board_email'] . '">', '</a>');
		}
		else
		{
			$custom_error_message = sprintf($custom_error_message, '', '');
		}
		echo "<html>\n<body>\n<b>Critical Error!</b><br />\nmessage_die() was called multiple times.<br />&nbsp;<hr />";
		for( $i = 0; $i < count($msg_history); $i++ )
		{
			echo '<b>Error #' . ($i+1) . "</b>\n<br />\n";
			if( !empty($msg_history[$i]['msg_title']) )
			{
				echo '<b>' . $msg_history[$i]['msg_title'] . "</b>\n<br />\n";
			}
			echo $msg_history[$i]['msg_text'] . "\n<br /><br />\n";

			if( !empty($msg_history[$i]['err_line']) )
			{
				echo '<b>Line :</b> ' . $msg_history[$i]['err_line'] . '<br /><b>File :</b> ' . $msg_history[$i]['err_file'] . "</b>\n<br />\n";
			}

			if( !empty($msg_history[$i]['sql']) )
			{
				echo '<b>SQL :</b> ' . $msg_history[$i]['sql'] . "\n<br />\n";
			}
			echo "&nbsp;<hr />\n";
		}
		echo $custom_error_message . '<hr /><br clear="all">';
		die("</body>\n</html>");
		//-MOD: Fix message_die for multiple errors MOD
	}

	define('HAS_DIED', 1);
	
	
	$sql_store = $sql;
	
	// Get SQL error if we are debugging. Do this as soon as possible to prevent
	// subsequent queries from overwriting the status of sql_error()
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		$sql_error = $db->sql_error();

		$debug_text = '';

		if ( $sql_error['message'] != '' )
		{
			$debug_text .= '<br /><br />SQL Error : ' . $sql_error['code'] . ' ' . $sql_error['message'];
		}

		if ( $sql_store != '' )
		{
			$debug_text .= "<br /><br />$sql_store";
		}

		if ( $err_line != '' && $err_file != '' )
		{
			$debug_text .= '<br /><br />Line : ' . $err_line . '<br />File : ' . basename($err_file);
		}
	}

	if( empty($userdata) && ( $msg_code == GENERAL_MESSAGE || $msg_code == GENERAL_ERROR ) )
	{
		$userdata = session_pagestart($user_ip, PAGE_INDEX);
		init_userprefs($userdata);
	}

	// If the header hasn't been output then do it
	if ( !defined('HEADER_INC') && $msg_code != CRITICAL_ERROR )
	{
		if ( empty($lang) )
		{
			if ( !empty($board_config['default_lang']) )
			{
				include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_main.'.$phpEx);
			}
			else
			{
				include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);
			}
			include($phpbb_root_path . './includes/lang_extend_mac.' . $phpEx);
		}

		if ( empty($template) || empty($theme) )
		{
			$theme = setup_style($board_config['default_style']);
		}

		// Load the Page Header
		if ( !defined('IN_ADMIN') )
		{
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'admin/page_header_admin.'.$phpEx);
		}
	}

	switch($msg_code)
	{
		case GENERAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Information'];
			}
			break;

		case CRITICAL_MESSAGE:
			if ( $msg_title == '' )
			{
				$msg_title = $lang['Critical_Information'];
			}
			break;

		case GENERAL_ERROR:
			if ( $msg_text == '' )
			{
				$msg_text = $lang['An_error_occured'];
			}

			if ( $msg_title == '' )
			{
				$msg_title = $lang['General_Error'];
			}
			break;

		case CRITICAL_ERROR:

			// Critical errors mean we cannot rely on _ANY_ DB information being
			// available so we're going to dump out a simple echo'd statement
			include($phpbb_root_path . 'language/lang_english/lang_main.'.$phpEx);

			if ( $msg_text == '' )
			{
				$msg_text = $lang['A_critical_error'];
			}

			if ( $msg_title == '' )
			{
				$msg_title = 'phpBB : <b>' . $lang['Critical_Error'] . '</b>';
			}
			break;
	}

	// Add on DEBUG info if we've enabled debug mode and this is an error. This
	// prevents debug info being output for general messages should DEBUG be
	// set TRUE by accident (preventing confusion for the end user!)
	if ( DEBUG && ( $msg_code == GENERAL_ERROR || $msg_code == CRITICAL_ERROR ) )
	{
		if ( $debug_text != '' )
		{
			$msg_text = $msg_text . '<br /><br /><b><u>DEBUG MODE</u></b>' . $debug_text;
		}
	}

	if ( $msg_code != CRITICAL_ERROR )
	{
		if ( !empty($lang[$msg_text]) )
		{
			$msg_text = $lang[$msg_text];
		}

		if ( !defined('IN_ADMIN') )
		{
			$template->set_filenames(array(
				'message_body' => 'message_body.tpl')
			);
		}
		else
		{
			$template->set_filenames(array(
				'message_body' => 'admin/admin_message_body.tpl')
			);
		}

		$template->assign_vars(array(
			'MESSAGE_TITLE' => $msg_title,
			'MESSAGE_TEXT' => $msg_text)
		);
		$template->pparse('message_body');

		if ( !defined('IN_ADMIN') )
		{
			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		else
		{
			include($phpbb_root_path . 'admin/page_footer_admin.'.$phpEx);
		}
	}
	else
	{
		echo "<html>\n<body>\n" . $msg_title . "\n<br /><br />\n" . $msg_text . "</body>\n</html>";
	}

	exit;
}

// This function is for compatibility with PHP 4.x's realpath()
// function.	In later versions of PHP, it needs to be called
// to do checks with some functions.	Older versions of PHP don't
// seem to need this, so we'll just return the original value.
// dougk_ff7 <October 5, 2002>
function phpbb_realpath($path)
{
	global $phpbb_root_path, $phpEx;
	
	return (!@function_exists('realpath') || !@realpath($phpbb_root_path . 'includes/functions.'.$phpEx)) ? $path : @realpath($path);
}

function redirect($url)
{
	global $db, $board_config;

	if (!empty($db))
	{
		$db->sql_close();
	}

	if (strstr(urldecode($url), "\n") || strstr(urldecode($url), "\r") || strstr(urldecode($url), ';url'))
	{
		message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
	}
	
	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));
	$script_name = ($script_name == '') ? $script_name : '/' . $script_name;
	$url = preg_replace('#^\/?(.*?)\/?$#', '/\1', trim($url));
	$url = str_replace('&amp;', '&', $url);
	
	// Redirect via an HTML form for PITA webservers
	if (@preg_match('/Microsoft|WebSTAR|Xitami/', getenv('SERVER_SOFTWARE')))
	{
		@header('Refresh: 0; URL=' . $server_protocol . $server_name . $server_port . $script_name . $url);
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><meta http-equiv="refresh" content="0; url=' . $server_protocol . $server_name . $server_port . $script_name . $url . '"><title>Redirect</title></head><body><div align="center">If your browser does not support meta redirection please click <a href="' . $server_protocol . $server_name . $server_port . $script_name . $url . '">HERE</a> to be redirected</div></body></html>';
		exit;
	}
	// Behave as per HTTP/1.1 spec for others
	@header('Location: ' . $server_protocol . $server_name . $server_port . $script_name . $url);
	exit;
}


//--[+]-- real_avatar_resize ------
function redim($img,$tx,$ty,$imgtype)
{
	$image_dim = getimagesize($img);
	$bits=getimagesize($img);
	$type=$bits[2];

	if($image_dim[0] > $image_dim[1])
	{ // x est plus grand que y
		$new_x = $tx;
		$new_y = $image_dim[1]/($image_dim[0]/$tx);
	}
	else
	{
		if($image_dim[0] < $image_dim[1])
		{ // y est plus grand que x
			$new_y = $ty;
			$new_x = $image_dim[0]/($image_dim[1]/$ty);
		}
		else
		{ // x == y
			$new_x = $tx;
			$new_y = $tx;
		}
	}
	
	$truecolor = false;
	
	switch( $type ) {
		case 1: # GIF
		$src_image = imagecreatefromgif( $img );
		break;

		case 2: # JPG
		$src_image = imagecreatefromjpeg( $img );
		$truecolor = true;
		break;

		case 3: # PNG
		$src_image = imagecreatefrompng( $img );
		$truecolor = ( $bits['bits'] > 8 );
		break;

		case 15: # WBMP for WML
		$src_image = imagecreatefromwbmp( $img );
		break;

		case 16: # XBM
		$src_image = imagecreatefromxbm( $img );
		break;

		default:
		return 'Image type not supported';
		break;
	}

	if ( $truecolor ) 
	{
		$dst_image = imagecreatetruecolor( $new_x, $new_y );
	} else 
	{
		$dst_image = imagecreate( $new_x, $new_y );
	}

	imagecopyresampled( $dst_image, $src_image, 0,0,0,0,$new_x,$new_y,$image_dim[0],$image_dim[1] );

	$chaine = substr($img,0,-4);//enléve les 4 derniers caractères ( ".JPG" )
	$chaine.="_mini.jpg";

	switch( $type ) {
		case 1:	# GIF
		case 3:	# PNG
		case 15: # WBMP
		case 16: # XBM
			imagepng( $dst_image, $chaine );
		break;
		case 2:	# JPEG
			imageinterlace( $dst_image );
			imagejpeg( $dst_image, $chaine, 95 );
		break;
		default:
		break;
	}

	imagedestroy( $dst_image );
	imagedestroy( $src_image );
}
//--[-]-- real_avatar_resize ------

// Password-protected topics/forums
function password_check ($mode, $id, $password, $redirect)
{
	global $db, $template, $theme, $board_config, $lang, $phpEx, $phpbb_root_path, $gen_simple_header;
	global $userdata;
	global $HTTP_COOKIE_VARS;
	
	$cookie_name = $board_config['cookie_name'];
	$cookie_path = $board_config['cookie_path'];
	$cookie_domain = $board_config['cookie_domain'];
	$cookie_secure = $board_config['cookie_secure'];
	
	$sql = "SELECT forum_password AS password FROM " . FORUMS_TABLE . " WHERE forum_id = $id";
	$passdata = ( isset($HTTP_COOKIE_VARS[$cookie_name . '_fpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$cookie_name . '_fpass'])) : '';
	$savename = $cookie_name . '_fpass';
	
	if( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not retrieve password', '', __LINE__, __FILE__, $sql);
	}

	$row = $db->sql_fetchrow($result);
	if( $password != $row['password'] )
	{
		$message = ( $mode == 'topic' ) ? $lang['Incorrect_topic_password'] : $lang['Incorrect_forum_password'];
		message_die(GENERAL_MESSAGE, $message);
	}

	$passdata[$id] = md5($password);
	setcookie($savename, serialize($passdata), 0, $cookie_path, $cookie_domain, $cookie_secure);

	$template->assign_vars(array(
		'META' => '<meta http-equiv="refresh" content="1; url="' . $redirect . '" />')
	);

	$message = $lang['Password_login_success'] . '<br /><br />' . sprintf($lang['Click_return_page'], '<a href="' . $redirect . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

function password_box ($mode, $s_form_action)
{
	global $db, $template, $theme, $board_config, $lang, $phpEx, $phpbb_root_path, $gen_simple_header;
	global $userdata;

	$l_enter_password = ( $mode == 'topic' ) ? $lang['Enter_topic_password'] : $lang['Enter_forum_password'];

	$page_title = $l_enter_password;
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	$template->set_filenames(array(
		'body' => 'password_body.tpl')
	);

	$template->assign_vars(array(
		'L_ENTER_PASSWORD' => $l_enter_password,
		'L_SUBMIT' => $lang['Submit'],
		'L_CANCEL' => $lang['Cancel'],

		'S_FORM_ACTION' => $s_form_action)
	);

	$template->pparse('body');
	include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
}

function add_nofollow($url)
{
	global $board_config;

	if ( preg_match('#^([\w]+?://)?'.trim($board_config['server_name']).'.*$#i',$url) )
	{
		return '';
	}
	return 'rel="nofollow"';
}

function check_avatar($addr)
{
	$to = 0.3;
	preg_match('/^http:\/\/([^\/]*)(.*)$/i', trim($addr), $m);
	$host = $m[1];
	$target = $m[2];
	if (trim($target) == '')
	{
		$target = '/';
	}

	$fp = @fsockopen ($host, 80, $errno, $errstr, $to);

	$res = '';
	if (!$fp)
	{
		return (FALSE);
	}
	else
	{
		@fclose ($fp);
		if (@fclose(@fopen("$addr", "r")))
		{
			return (TRUE);
		}
		else
		{
			return (FALSE);
		}
	}
}

function format_url($url)
{
	$url = trim($url);
	$url = strtolower($url);
	
	$find = array('<b>', '</b>');
	$url = str_replace ($find, '', $url);
	
	$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
	
	$find = array(' ', '&quot;', '&amp;', '&', '\r\n', '\n', '/', '\\', '+', '<', '>');
	$url = str_replace ($find, '-', $url);
	
	$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
	$url = str_replace ($find, 'e', $url);
	
	$find = array('í', 'ý', 'ì', 'î', 'ï', 'I', 'Ý', 'Í', 'Ì', 'Î', 'Ï');
	$url = str_replace ($find, 'i', $url);
	
	$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
	$url = str_replace ($find, 'o', $url);
	
	$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
	$url = str_replace ($find, 'a', $url);
	
	$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
	$url = str_replace ($find, 'u', $url);
	
	$find = array('ç', 'Ç');
	$url = str_replace ($find, 'c', $url);
	
	$find = array('þ', 'Þ');
	$url = str_replace ($find, 's', $url);
	
	$find = array('ð', 'Ð');
	$url = str_replace ($find, 'g', $url);
	
	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	
	$repl = array('', '-', '');
	
	$url = preg_replace ($find, $repl, $url);
	$url = str_replace ('--', '-', $url);

 	$url = $url.'.html';

	return $url;
}

?>