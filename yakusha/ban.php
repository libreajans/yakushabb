<?php
/***************************************************************************
* bin.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);


// Obtain initial var settings
if ( isset($HTTP_GET_VARS[POST_USERS_URL]) || isset($HTTP_POST_VARS[POST_USERS_URL]) )
{
	$user_id = (isset($HTTP_POST_VARS[POST_USERS_URL])) ? intval($HTTP_POST_VARS[POST_USERS_URL]) : intval($HTTP_GET_VARS[POST_USERS_URL]);
}
else
{
	$user_id = '';
}

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
	$sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
	$sid = '';
}

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = (isset($HTTP_POST_VARS['mode'])) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	//$mode = htmlspecialchars(trim($HTTP_POST_VARS['mode']));
}
else
{
	$mode = '';
}

// Start session management
$userdata = session_pagestart($user_ip, $user_id);
init_userprefs($userdata);

//---[+]--- Logged In control on acp --------
if ( !$board_config['allow_mods_ban'])
{
	message_die(GENERAL_ERROR, $lang['ban_options_is_closed']);
}
//---[-]--- Logged In control on acp --------

// session id check
if ($sid == '' || $sid != $userdata['session_id'])
{
	message_die(GENERAL_ERROR, 'Invalid_session');
}

// page generating
$page_title = $lang['Ban_CP'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

if (!$userdata['user_level'] == MOD or !$userdata['user_level'] == ADMIN ) 
{
	message_die(GENERAL_ERROR, $lang['User_not_moderator']);
}

// Obtain relevant data
if ( !empty($user_id) && !empty($mode))
{
	$profile_turn = "<a href=profile.php?mode=viewprofile&u=" . $user_id . ">" . $lang['Turn_user_profile'] ."</a>";
	$sql = "SELECT * FROM " . USERS_TABLE . "
		WHERE user_id = " . $user_id;
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'User information not selected');
	}
	$user_row = $db->sql_fetchrow($result);

	if (!user_row)
	{
		message_die(GENERAL_MESSAGE, $lang['User_not_found']);
	}
	
	if ($mode == ban && !empty($user_id))
	{
		if ($user_row['user_level'] == USER )
		{
			$sql = "INSERT INTO " . BANLIST_TABLE . " (ban_userid)
				VALUES ($user_id)";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not insert banlist information', '', __LINE__, __FILE__, $sql);
			}
			else
			{
				message_die(GENERAL_MESSAGE, $lang['User_banned'].'<br /><br />'.$profile_turn);
			}
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['User_is_a_admin_or_mod'].'<br /><br />'.$profile_turn);
		}
		
	}
	
	if ($mode == unban && !empty($user_id))
	{
		$sql = "DELETE FROM " . BANLIST_TABLE . " WHERE (ban_userid = $user_id)";
		if ( !$db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not detele banlist information', '', __LINE__, __FILE__, $sql);
		}
		else
		{
			message_die(GENERAL_MESSAGE, $lang['User_unbanned'] .'<br /><br />'. $profile_turn);
		}
	}
}
else
{
	message_die(GENERAL_MESSAGE, 'User id or mode incorrect');
}
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>