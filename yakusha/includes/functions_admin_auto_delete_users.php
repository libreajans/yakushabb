<?php
/***************************************************************************
* functions_admin_auto_delete_users.php
***************************************************************************/
if (!defined('IN_PHPBB'))
{
	die('Hacking attempt');
}

/* Setting this to true will print out some debug information I use */
define('DEBUG_THIS_MOD', false);
/* This is fake delete, it won't actually delete the user but mark it as deleted... Made for my demo board :) 
You'll need to run the following sql command to get it working, otherwise it will give an error:
ALTER TABLE `phpbb_users` ADD `user_fake_delete` TINYINT( 1 ) DEFAULT '0' NOT NULL ;
*/
define('FAKE_DELETE', false);

if (!function_exists('auto_delete_specific_user'))
{
	function auto_delete_specific_user($user_id, $username)
	{
		/* This code taken directly from the phpBB Admin Module pretty much */
		global $db, $board_config;
		
		// Update the deletion count
		$new_total = intval($board_config['admin_auto_delete_total']) + 1;
		$sql = 'UPDATE ' . CONFIG_TABLE . "
				SET config_value = '$new_total'
				WHERE config_name = 'admin_auto_delete_total'";
		$db->sql_query($sql);
		$board_config['admin_auto_delete_total'] = $new_total;
		
		if (FAKE_DELETE)
		{
			$sql = 'UPDATE ' . USERS_TABLE . "
					SET user_fake_delete = 1
					WHERE user_id = $user_id";
			if(!$db->sql_query($sql))
			{
				message_die(GENERAL_ERROR, 'Could not fake delete this user', '', __LINE__, __FILE__, $sql);
			}
		}
		else
		{
			$sql = "SELECT g.group_id
				FROM " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g  
				WHERE ug.user_id = $user_id 
					AND g.group_id = ug.group_id 
					AND g.group_single_user = 1";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not obtain group information for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$row = $db->sql_fetchrow($result);
			
			$sql = "UPDATE " . POSTS_TABLE . "
				SET poster_id = " . DELETED . ", post_username = '$username' 
				WHERE poster_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update posts for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "UPDATE " . TOPICS_TABLE . "
				SET topic_poster = " . DELETED . " 
				WHERE topic_poster = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update topics for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "UPDATE " . VOTE_USERS_TABLE . "
				SET vote_user_id = " . DELETED . "
				WHERE vote_user_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not update votes for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "SELECT group_id
				FROM " . GROUPS_TABLE . "
				WHERE group_moderator = $user_id";
			if( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select groups where user was moderator', '', __LINE__, __FILE__, $sql);
			}
			
			while ( $row_group = $db->sql_fetchrow($result) )
			{
				$group_moderator[] = $row_group['group_id'];
			}
			
			if ( count($group_moderator) )
			{
				// Find the first admin we can in the database
				$sql = 'SELECT user_id FROM ' . USERS_TABLE . '
					WHERE user_level = ' . ADMIN . '
					ORDER BY user_id ASC
					LIMIT 1';
				if(!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
				}
				$arow = $db->sql_fetchrow($result);
				
				$update_moderator_id = implode(', ', $group_moderator);
				
				$sql = "UPDATE " . GROUPS_TABLE . "
					SET group_moderator = " . $arow['user_id'] . "
					WHERE group_moderator IN ($update_moderator_id)";
				if( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not update group moderators', '', __LINE__, __FILE__, $sql);
				}
			}
			
			$sql = "DELETE FROM " . USERS_TABLE . "
				WHERE user_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . USER_GROUP_TABLE . "
				WHERE user_id = $user_id";
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from user_group table', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . GROUPS_TABLE . "
				WHERE group_id = " . $row['group_id'];
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . AUTH_ACCESS_TABLE . "
				WHERE group_id = " . $row['group_id'];
			if( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete group for this user', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . TOPICS_WATCH_TABLE . "
				WHERE user_id = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from topic watch table', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "DELETE FROM " . BANLIST_TABLE . "
				WHERE ban_userid = $user_id";
			if ( !$db->sql_query($sql) )
			{
				message_die(GENERAL_ERROR, 'Could not delete user from banlist table', '', __LINE__, __FILE__, $sql);
			}
			
			$sql = "SELECT privmsgs_id
				FROM " . PRIVMSGS_TABLE . "
				WHERE privmsgs_from_userid = $user_id 
					OR privmsgs_to_userid = $user_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select all users private messages', '', __LINE__, __FILE__, $sql);
			}
			
			// This little bit of code directly from the private messaging section.
			while ( $row_privmsgs = $db->sql_fetchrow($result) )
			{
				$mark_list[] = $row_privmsgs['privmsgs_id'];
			}
			
			if ( count($mark_list) )
			{
				$delete_sql_id = implode(', ', $mark_list);
				
				$delete_text_sql = "DELETE FROM " . PRIVMSGS_TEXT_TABLE . "
					WHERE privmsgs_text_id IN ($delete_sql_id)";
				$delete_sql = "DELETE FROM " . PRIVMSGS_TABLE . "
					WHERE privmsgs_id IN ($delete_sql_id)";
				
				if ( !$db->sql_query($delete_sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message info', '', __LINE__, __FILE__, $delete_sql);
				}
				
				if ( !$db->sql_query($delete_text_sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete private message text', '', __LINE__, __FILE__, $delete_text_sql);
				}
			}
		}
	}
}

if (!function_exists('auto_delete_users'))
{
	function auto_delete_users()
	{
		global $db, $board_config;
		
		$fake_delete_sql = (FAKE_DELETE) ? 'AND user_fake_delete <> 1' : '';
		
		/* Check if we are ready to search again */
		if (time() > $board_config['last_auto_delete_users_attempt'] + (60 * $board_config['admin_auto_delete_minutes']))
		{
			/* Update the board_config last attempt */
			$sql = 'UPDATE ' . CONFIG_TABLE . "
			   SET config_value = '" . time() . "'
			   WHERE config_name = 'last_auto_delete_users_attempt'";
			$db->sql_query($sql);
			if (DEBUG_THIS_MOD)
			{
				print $sql . '<br>';
			}
			/* Find our specified deletion day UNIX_TIME */
			/* 86400 Seconds Per Day */
			if ($board_config['admin_auto_delete_days_inactive'] < 120 ) 
			{
				// bir güvenlik güncellemesi, hata bile olsa 120 günü doldurmamýþ üyeler silinemez...
				$board_config['admin_auto_delete_days_inactive'] = 120;
			}


			if ($board_config['admin_auto_delete_days_no_post'] < 30 ) 
			{
				// bir güvenlik güncellemesi, hata bile olsa 30 gündür forumu ziyaret etmemiþ üyeler, mesaj yazmamýþsalar bile silinemez...
				$board_config['admin_auto_delete_days_no_post'] = 30;
			}
			$deletion_time_inactive = $board_config['admin_auto_delete_days_inactive'] * 86400;
			$deletion_time = $board_config['admin_auto_delete_days'] * 86400;
			$deletion_time_no_post = $board_config['admin_auto_delete_days_no_post'] * 86400;
			
			if ($board_config['admin_auto_delete_inactive'])
			{
				/* Find In-Active Users */
				$sql = 'SELECT user_id, username, user_regdate, user_posts FROM ' . USERS_TABLE . '
		   			WHERE user_id <> ' . ANONYMOUS . "
					AND user_posts = 0
					$fake_delete_sql
					HAVING (user_regdate + $deletion_time_no_post) < " . time();
				if (DEBUG_THIS_MOD)
				{
					print $sql . '<br>';
				}
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Auto_Delete'], '', __LINE__, __FILE__, $sql);
				}
				while ($row = $db->sql_fetchrow($result))
				{
					auto_delete_specific_user($row['user_id'], $row['username']);
				}
			}
			
			if ($board_config['admin_auto_delete_no_post'])
			{
				/* Find In-Active Users */
				$sql = 'SELECT user_id, username, user_regdate, user_posts FROM ' . USERS_TABLE . '
		   			WHERE user_id <> ' . ANONYMOUS . "
					AND user_posts = 0
					$fake_delete_sql
					HAVING (user_regdate + $deletion_time_no_post) < " . time();
				if (DEBUG_THIS_MOD)
				{
					print $sql . '<br>';
				}
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Auto_Delete'], '', __LINE__, __FILE__, $sql);
				}
				while ($row = $db->sql_fetchrow($result))
				{
					auto_delete_specific_user($row['user_id'], $row['username']);
				}
			}
			
			if ($board_config['admin_auto_delete_non_visit'])
			{
				/* Find Non-Visiting Users */
				$sql = 'SELECT user_id, username, user_lastvisit FROM ' . USERS_TABLE . '
		   			WHERE user_id <> ' . ANONYMOUS . "
					$fake_delete_sql
					HAVING (user_lastvisit + $deletion_time) < " . time();
				if (DEBUG_THIS_MOD)
				{
					print $sql . '<br>';
				}
				if (!$result = $db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, $lang['Error_Auto_Delete'], '', __LINE__, __FILE__, $sql);
				}
				while ($row = $db->sql_fetchrow($result))
				{
					auto_delete_specific_user($row['user_id'], $row['username']);
				}
			}
		}
	}
}

if (!function_exists('load_auto_delete_emailer_info'))
{
	function load_auto_delete_emailer_info()
	{
		global $template, $lang, $board_config, $phpbb_root_path, $phpEx;
		
		include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin_auto_delete_users.' . $phpEx);
		
		$template->assign_var('DELETION_INFO_NON_VISITING', sprintf($lang['Deletion_of_Non_Visiting'], $board_config['admin_auto_delete_days']));
		$template->assign_var('DELETION_INFO_INACTIVE', sprintf($lang['Deletion_of_Inactive'], $board_config['admin_auto_delete_days_inactive']));
		$template->assign_var('DELETION_INFO_NON_POSTING', sprintf($lang['Deletion_of_Non_Posting'], $board_config['admin_auto_delete_no_post']));
	}
}
?>