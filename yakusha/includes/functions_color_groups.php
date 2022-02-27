<?php
/***************************************************************************
* $RCSfile: functions_color_groups.php,v $
***************************************************************************/
if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

define('RGB_COLOR_LIST', 'aqua,aquamarine,black,blue,brown,crimson,darkblue,darkgreen,darkorange,darkred,darkslategray,deeppink,fuchsia,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;,gray,green,gold,lime,maroon,navy,olive,orangered,pink,purple,red,silver,teal,turquoise,violet,white,yellow');
define('COPYRIGHT_NIVISEC_FORMAT', '<br /><span class="copyright"><center>	%s 	&copy; %s 	<a href="http://www.nivisec.com" class="copyright">Nivisec.com</a>	</center></span>');

if (!function_exists('copyright_nivisec'))
{
	/**
	* @return void
	* @desc Prints a sytlized line of copyright for module
	*/
	function copyright_nivisec($name, $year)
	{
		printf(COPYRIGHT_NIVISEC_FORMAT, $name, $year);
	}
}

if (!function_exists('check_font_color_nivisec'))
{
	/**
	* @return boolean
	* @param item string
	* @desc Checks for a valid color entry in the form of one of default words or #rrggbb.  Assumes $colors is defined already.
	*/
	function check_font_color_nivisec($item)
	{
		global $colors;
		//Find out if it's a valid hex or valid word
		if (!preg_match("/#[0-9,A-F,a-f]{6}/", $item) && !in_array($item, explode(",", RGB_COLOR_LIST)))
		{
			return false;
		}
		//If we get this far, it exists and/or is valid
		return true;
	}
}

if (!function_exists('find_lang_file_nivisec'))
{
	/**
	* @return boolean
	* @param filename string
	* @desc Tries to locate and include the specified language file.  Do not include the .php extension!
	*/
	function find_lang_file_nivisec($filename)
	{
		global $lang, $phpbb_root_path, $board_config, $phpEx;
		
		if (file_exists($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/$filename.$phpEx"))
		{
			include_once($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . "/$filename.$phpEx");
		}
		elseif (file_exists($phpbb_root_path . "language/lang_english/$filename.$phpEx"))
		{
			include_once($phpbb_root_path . "language/lang_english/$filename.$phpEx");
		}
		else
		{
			message_die(GENERAL_ERROR, "Unable to find a suitable language file for $filename!", '');
		}
		return true;
	}
}
if (!function_exists('set_filename_nivisec'))
{
	/**
	* @return boolean
	* @param filename string
	* @param handle string
	* @desc Sets the filename to handle in the $template class.  Saves typing for me :)
	*/
	function set_filename_nivisec($handle, $filename)
	{
		global $template;
		
		$template->set_filenames(array(
		$handle => $filename
		));
		
		return true;
	}
}
if (!function_exists('do_query_nivisec'))
{
	/**
	* @return void
	* @param sql string
	* @param $result_list array
	* @param error string
	* @desc Does $sql query.  If error, prints $error and modifies reference $result_list to be a row set
	*/
	function do_query_nivisec($sql, &$result_list, $error)
	{
		global $db;
		
		if (!$result = $db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, $error, '', __LINE__, __FILE__, $sql);
		}
		$result_list = $db->sql_fetchrowset($result);
	}
}

if (!function_exists('do_fast_query_nivisec'))
{
	/**
	* @return void
	* @param sql string
	* @param error string
	* @desc Does $sql query and doesn't bother with results.  If error, prints $error
	*/
	function do_fast_query_nivisec($sql, $error)
	{
		global $db;
		
		if (!$db->sql_query($sql))
		{
			message_die(GENERAL_ERROR, $error, '', __LINE__, __FILE__, $sql);
		}
	}
}
function get_color_group_order_max()
{
	global $db, $lang;
	
	$sql = 'SELECT max(order_num) as max FROM ' . COLOR_GROUPS_TABLE;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	
	return $row['max'];
}
function get_color_group_order_min()
{
	global $db, $lang;
	
	$sql = 'SELECT MIN(order_num) as min FROM ' . COLOR_GROUPS_TABLE;
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	
	return $row['min'];
}
/**
* @return void
* @param new string
* @param orig string
* @param type int
* @desc Updates user levels of type based on the difference between new and orig string lists
*/
function color_groups_update_group_id($group_list, $user_list, $group_id)
{
	global $lang, $db, $status_message;
	/* Debugging for this function */
	$debug = false;
	
	$sql = array();
	
	// Set all old user's and groups to "NO COLOR GROUP" to take care of any deletions //
	$sql[] = 'UPDATE ' . USERS_TABLE . "
		SET user_color_group = 0
		WHERE user_color_group = $group_id";
	$sql[] = 'UPDATE ' . GROUPS_TABLE . "
		SET group_color_group = 0
		WHERE group_color_group = $group_id";
	// Set all new list items to have the color group, if we were given a list //
	if (!empty($user_list))
	{
		$sql[] = 'UPDATE ' . USERS_TABLE . "
		SET user_color_group = $group_id
		WHERE user_id IN ($user_list)";
	}
	if (!empty($group_list))
	{
		$sql[] = 'UPDATE ' . GROUPS_TABLE . "
		SET group_color_group = $group_id
		WHERE group_id IN ($group_list)";
	}
	
	// DO the actual SQL commands now //
	foreach($sql as $command)
	{
		if (!$db->sql_query($command))
		{
			message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
		}
	}
	
	$status_message .= $lang['Updated_Group'];
}

function color_groups_setup_list()
{
	global $lang, $template, $db;
	static $list;

	if (empty($list))
	{
		$sql = 'SELECT * FROM ' . COLOR_GROUPS_TABLE . '
		WHERE hidden = 0
		ORDER BY order_num ASC';
		if (!$result = $db->sql_query($sql)) message_die(GENERAL_ERROR, $lang['Error_Group_Table'], '', __LINE__, __FILE__, $sql);
		$list = '';
		while ($row = $db->sql_fetchrow($result))
		{
			$list .= ' # <span style="font-weight:bold;color:' . stripslashes($row['group_color']) . '">' . stripslashes($row['group_name']) . '</span>';
		}
	}

	$template->assign_var('COLOR_GROUPS_LIST', $list);
}

function color_group_colorize_name($user_id, $no_profile = false)
{
	global $board_config, $phpEx, $db, $phpbb_root_path;
	
	static $cacheUsers;
	
	// First see if the user is Anon
	if ($user_id != ANONYMOUS)
	{
		if (!isset($cacheUsers[$user_id]))
		{
			// Get the user info and see if they are assigned a color_group //
			$sql = 'SELECT u.user_color_group, u.username, c.* FROM ' . USERS_TABLE . ' u, ' . COLOR_GROUPS_TABLE . " c
			WHERE u.user_id = $user_id
			AND u.user_color_group = c.group_id";
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			if (!isset($row['username']))
			{
				//If there was a problem before, we don't want a blank username!
				$sql = 'SELECT username FROM ' . USERS_TABLE . "
					WHERE user_id = $user_id";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
			}
			$cacheUsers[$user_id]['username'] = $row['username'];

			if (isset($row['group_color']))
			{
				// WE found the highest level color, head out now //
				$cacheUsers[$user_id]['group_color'] = stripslashes($row['group_color']);
			}
			else
			{
				// Now start looking for user group memberships //
				$sql = 'SELECT c.* FROM ' . USER_GROUP_TABLE . ' ug, ' . USERS_TABLE . ' u, ' . COLOR_GROUPS_TABLE . ' c, ' . GROUPS_TABLE . ' g
				WHERE ug.user_id = ' . $user_id . '
				AND u.user_id = ug.user_id
				AND ug.group_id = g.group_id
				AND g.group_color_group = c.group_id
				AND g.group_single_user = 0
				ORDER BY c.order_num ASC LIMIT 1';
				//print $sql;
				$result = $db->sql_query($sql);
				$curr = 10000000000000;
				$style_color = '';
				while ($row = $db->sql_fetchrow($result))
				{
					// If our new group in the list is a higher order number, it's color takes precedence //
					if ($row['order_num'] < $curr)
					{
						$curr = $row['order_num'];
						$cacheUsers[$user_id]['group_color'] = stripslashes($row['group_color']);
					}
				}
			}
		}
		

		$style_color = 'style="font-weight:bold;color:' . @$cacheUsers[$user_id]['group_color'] . '"';
		$username = $cacheUsers[$user_id]['username'];
		// Make the profile link or no and return it //
		if ($no_profile)
		{
			$user_link = "<span class='colorize_name' $style_color>$username</span>";
		}
		else
		{
			$user_link = '<a href="' . append_sid($phpbb_root_path."profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id") . '"' . $style_color .'>' . $username . '</a>';
		}
		return($user_link);
	}
	else
	{
		return false;
	}
}


?>