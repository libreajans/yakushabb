<?php
/***************************************************************************
* modcp.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_admin.'.$phpEx);

// Obtain initial var settings
if ( isset($HTTP_GET_VARS[POST_FORUM_URL]) || isset($HTTP_POST_VARS[POST_FORUM_URL]) )
{
	$forum_id = (isset($HTTP_POST_VARS[POST_FORUM_URL])) ? intval($HTTP_POST_VARS[POST_FORUM_URL]) : intval($HTTP_GET_VARS[POST_FORUM_URL]);
}
else
{
	$forum_id = '';
}

if ( isset($HTTP_GET_VARS[POST_POST_URL]) || isset($HTTP_POST_VARS[POST_POST_URL]) )
{
	$post_id = (isset($HTTP_POST_VARS[POST_POST_URL])) ? intval($HTTP_POST_VARS[POST_POST_URL]) : intval($HTTP_GET_VARS[POST_POST_URL]);
}
else
{
	$post_id = '';
}

if ( isset($HTTP_GET_VARS[POST_TOPIC_URL]) || isset($HTTP_POST_VARS[POST_TOPIC_URL]) )
{
	$topic_id = (isset($HTTP_POST_VARS[POST_TOPIC_URL])) ? intval($HTTP_POST_VARS[POST_TOPIC_URL]) : intval($HTTP_GET_VARS[POST_TOPIC_URL]);
}
else
{
	$topic_id = '';
}

$confirm = ( $HTTP_POST_VARS['confirm'] ) ? TRUE : 0;
$confirm_recycle = TRUE;

// Continue var definitions
$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;
$viewall = ( isset($HTTP_GET_VARS['viewall']) ) ? intval($HTTP_GET_VARS['viewall']) : 0;
$delete = ( isset($HTTP_POST_VARS['delete']) ) ? TRUE : FALSE;
$move = ( isset($HTTP_POST_VARS['move']) ) ? TRUE : FALSE;
$lock = ( isset($HTTP_POST_VARS['lock']) ) ? TRUE : FALSE;
$unlock = ( isset($HTTP_POST_VARS['unlock']) ) ? TRUE : FALSE;
$merge = ( isset($HTTP_POST_VARS['merge']) ) ? TRUE : FALSE;
$sticky = ( isset($HTTP_POST_VARS['sticky']) ) ? TRUE : FALSE;
$announce = ( isset($HTTP_POST_VARS['announce']) ) ? TRUE : FALSE;
$normalise = ( isset($HTTP_POST_VARS['normalise']) ) ? TRUE : FALSE;
$recycle = ( isset($HTTP_POST_VARS['recycle']) ) ? TRUE : FALSE;


if ( isset($HTTP_POST_VARS['mode']) || isset($HTTP_GET_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? $HTTP_POST_VARS['mode'] : $HTTP_GET_VARS['mode'];
	$mode = htmlspecialchars($mode);
}
else
{
	if ( $delete )
	{
		$mode = 'delete';
	}
	else if ( $move )
	{
		$mode = 'move';
	}
	else if ( $lock )
	{
		$mode = 'lock';
	}
	else if ( $unlock )
	{
		$mode = 'unlock';
	}
	else if ( $merge )
	{
		$mode = 'merge';
	}
	else if ( $sticky )
	{
		$mode = 'sticky';
	}
	else if ( $announce )
	{
		$mode = 'announce';
	}
	else if ( $normalise )
	{
		$mode = 'normalise';
	}
	else if ( $recycle )
	{
		$mode = 'recycle';
	}
	else
	{
		$mode = '';
	}
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

//
// Obtain relevant data
//
if ( !empty($topic_id) )
{
	$sql = "SELECT f.forum_id, f.forum_name, f.forum_topics
		FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f
		WHERE t.topic_id = " . $topic_id . "
			AND f.forum_id = t.forum_id";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
	}

	$topic_row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);
	
	if (!$topic_row)
	{
		message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
	}

	$forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];
	$forum_id = $topic_row['forum_id'];
	$forum_name = $topic_row['forum_name'];
}
else if ( !empty($forum_id) )
{
	$sql = "SELECT forum_name, forum_topics
		FROM " . FORUMS_TABLE . "
		WHERE forum_id = " . $forum_id;

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_MESSAGE, 'Forum_not_exist');
	}
	$topic_row = $db->sql_fetchrow($result);

	if (!$topic_row)
	{
		message_die(GENERAL_MESSAGE, 'Forum_not_exist');
	}

	$forum_topics = ( $topic_row['forum_topics'] == 0 ) ? 1 : $topic_row['forum_topics'];
	$forum_name = $topic_row['forum_name'];
}
else
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

// Start session management
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);

// session id check
if ($sid == '' || $sid != $userdata['session_id'])
{
	message_die(GENERAL_ERROR, 'Invalid_session');
}

// Check if user did or did not confirm
// If they did not, forward them to the last page they were on
if ( isset($HTTP_POST_VARS['cancel']) )
{
	if ( $topic_id )
	{
		$redirect = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id";
	}
	else if ( $forum_id )
	{
		$redirect = "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id";
	}
	else
	{
		$redirect = "index.$phpEx";
	}
	redirect(append_sid($redirect, true));
}

// Start auth check
$is_auth = auth(AUTH_ALL, $forum_id, $userdata);

if ( !$is_auth['auth_mod'] )
{
	message_die(GENERAL_MESSAGE, $lang['Not_Moderator'], $lang['Not_Authorised']);
}

// Do major work ...
switch( $mode )
{
	case 'delete':
		if (!$is_auth['auth_delete'])
		{
			message_die(GENERAL_MESSAGE, sprintf($lang['Sorry_auth_delete'], $is_auth['auth_delete_type']));
		}

		if ($board_config['admin_message_save_from_mods'])
		{
			if( $userdata['user_level'] != ADMIN )
			{
				$topics_sql = ( isset($HTTP_POST_VARS['topic_id_list']) ) ? implode(',', $HTTP_POST_VARS['topic_id_list']) : $topic_id;
				$sql = "SELECT t.topic_id
					FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u
					WHERE u.user_id = t.topic_poster
						AND u.user_level = " . ADMIN . "
						AND t.topic_id IN ($topics_sql)";
				if( !$result = $db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not retrieve topics list', '', __LINE__, __FILE__, $sql);
				}
				
				if( $db->sql_numrows($result) > 0 )
				{
				message_die(GENERAL_MESSAGE, $lang['Not_auth_edit_delete_admin']);
				}
			}
		}
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		if ( $confirm )
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}
			include($phpbb_root_path . 'includes/functions_search.'.$phpEx);

			$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ? $HTTP_POST_VARS['topic_id_list'] : array($topic_id);

			$topic_id_sql = '';
			for($i = 0; $i < count($topics); $i++)
			{
				$topic_id_sql .= ( ( $topic_id_sql != '' ) ? ', ' : '' ) . intval($topics[$i]);
			}

			$sql = "SELECT topic_id
				FROM " . TOPICS_TABLE . "
				WHERE topic_id IN ($topic_id_sql)
					AND forum_id = $forum_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic id information', '', __LINE__, __FILE__, $sql);
			}

			$topic_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				$topic_id_sql .= (($topic_id_sql != '') ? ', ' : '') . intval($row['topic_id']);
			}
			$db->sql_freeresult($result);

			if ( $topic_id_sql == '')
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$sql = "SELECT poster_id, COUNT(post_id) AS posts
				FROM " . POSTS_TABLE . "
				WHERE topic_id IN ($topic_id_sql)
					GROUP BY poster_id";

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get poster id information', '', __LINE__, __FILE__, $sql);
			}

			$count_sql = array();
			while ( $row = $db->sql_fetchrow($result) )
			{
				$count_sql[] = "UPDATE " . USERS_TABLE . "
				SET user_posts = user_posts - " . $row['posts'] . "
				WHERE user_id = " . $row['poster_id'];
			}
			$db->sql_freeresult($result);

			if ( sizeof($count_sql) )
			{
				for($i = 0; $i < sizeof($count_sql); $i++)
				{
					if ( !$db->sql_query($count_sql[$i]) )
					{
					message_die(GENERAL_ERROR, 'Could not update user post count information', '', __LINE__, __FILE__, $sql);
					}
				}
			}

			$sql = "SELECT post_id
				FROM " . POSTS_TABLE . "
				WHERE topic_id IN ($topic_id_sql)";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);
			}

			$post_id_sql = '';
			while ( $row = $db->sql_fetchrow($result) )
			{
				$post_id_sql .= ( ( $post_id_sql != '' ) ? ', ' : '' ) . intval($row['post_id']);
			}
			$db->sql_freeresult($result);

			$sql = "SELECT vote_id
				FROM " . VOTE_DESC_TABLE . "
				WHERE topic_id IN ($topic_id_sql)";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get vote id information', '', __LINE__, __FILE__, $sql);
			}

			$vote_id_sql = '';
			while ( $row = $db->sql_fetchrow($result) )
			{
				$vote_id_sql .= ( ( $vote_id_sql != '' ) ? ', ' : '' ) . $row['vote_id'];
			}
			$db->sql_freeresult($result);

			// Got all required info so go ahead and start deleting everything
			$sql = "DELETE
				FROM " . TOPICS_TABLE . "
				WHERE topic_id IN ($topic_id_sql)
					OR topic_moved_id IN ($topic_id_sql)";
			if ( !$db->sql_query($sql, BEGIN_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete topics', '', __LINE__, __FILE__, $sql);
			}

			if ( $post_id_sql != '' )
			{
				$sql = "DELETE
					FROM " . POSTS_TABLE . "
					WHERE post_id IN ($post_id_sql)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete posts', '', __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE
					FROM " . POSTS_TEXT_TABLE . "
					WHERE post_id IN ($post_id_sql)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete posts text', '', __LINE__, __FILE__, $sql);
				}

				remove_search_post($post_id_sql);
				delete_attachment(explode(', ', $post_id_sql));
			}
			
			if ( $vote_id_sql != '' )
			{
				$sql = "DELETE
					FROM " . VOTE_DESC_TABLE . "
					WHERE vote_id IN ($vote_id_sql)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete vote descriptions', '', __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE
					FROM " . VOTE_RESULTS_TABLE . "
					WHERE vote_id IN ($vote_id_sql)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete vote results', '', __LINE__, __FILE__, $sql);
				}

				$sql = "DELETE
					FROM " . VOTE_USERS_TABLE . "
					WHERE vote_id IN ($vote_id_sql)";
				if ( !$db->sql_query($sql) )
				{
					message_die(GENERAL_ERROR, 'Could not delete vote users', '', __LINE__, __FILE__, $sql);
				}
			}

			$sql = "DELETE
				FROM " . TOPICS_WATCH_TABLE . "
				WHERE topic_id IN ($topic_id_sql)";
			if ( !$db->sql_query($sql, END_TRANSACTION) )
			{
				message_die(GENERAL_ERROR, 'Could not delete watched post list', '', __LINE__, __FILE__, $sql);
			}

			sync('forum', $forum_id);

			if ( !empty($topic_id) )
			{
				$redirect_page = "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
				$l_redirect = sprintf($lang['Click_return_forum'], '<a href="' . $redirect_page . '">', '</a>');
			}
			else
			{
				$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
				$l_redirect = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="1;url=' . $redirect_page . '">')
			);

			message_die(GENERAL_MESSAGE, $lang['Topics_Removed'] . '<br /><br />' . $l_redirect);
		}//if confirm
		else
		{
			// Not confirmed, show confirmation message
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				$topics = $HTTP_POST_VARS['topic_id_list'];
				for($i = 0; $i < count($topics); $i++)
				{
					$hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
				}
			}
			else
			{
				$hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
			}

			// Set template files
			$template->set_filenames(array(
				'confirm' => 'confirm_body.tpl')
			);

			// Begin Simple Subforums MOD
			$all_forums = array();
			make_jumpbox_ref('modcp.'.$phpEx, $forum_id, $all_forums);
			
			$parent_id = 0;
			for( $i = 0; $i < count($all_forums); $i++ )
			{
				if( $all_forums[$i]['forum_id'] == $forum_id )
				{
					$parent_id = $all_forums[$i]['forum_parent'];
				}
			}

			if( $parent_id )
			{
				for( $i = 0; $i < count($all_forums); $i++)
				{
					if( $all_forums[$i]['forum_id'] == $parent_id )
					{
						$template->assign_vars(array(
							'PARENT_FORUM'	=> 1,
							'U_VIEW_PARENT_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
							'PARENT_FORUM_NAME' => $all_forums[$i]['forum_name']));
					}
				}
			}
			// End Simple Subforums MOD

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Confirm'],
				'MESSAGE_TEXT' => $lang['Confirm_delete_topic'],
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],
				'S_CONFIRM_ACTION' => append_sid("modcp.$phpEx"),
				'S_HIDDEN_FIELDS' => $hidden_fields));
			
			$template->pparse('confirm');
			
			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}//else confirm
		break;
		
	case 'move':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		if ( $confirm )
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$new_forum_id = intval($HTTP_POST_VARS['new_forum']);
			$old_forum_id = $forum_id;

			$sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . '
				WHERE forum_id = ' . $new_forum_id;
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql);
			}

			if (!$db->sql_fetchrow($result))
			{
				message_die(GENERAL_MESSAGE, 'New forum does not exist');
			}

			$db->sql_freeresult($result);

			if ( $new_forum_id != $old_forum_id )
			{
				$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?	$HTTP_POST_VARS['topic_id_list'] : array($topic_id);
				$topic_list = '';
				for($i = 0; $i < count($topics); $i++)
				{
					$topic_list .= ( ( $topic_list != '' ) ? ', ' : '' ) . intval($topics[$i]);
				}

				$sql = "SELECT *
					FROM " . TOPICS_TABLE . "
					WHERE topic_id IN ($topic_list)
						AND forum_id = $old_forum_id
						AND topic_status <> " . TOPIC_MOVED;
				if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
				{
					message_die(GENERAL_ERROR, 'Could not select from topic table', '', __LINE__, __FILE__, $sql);
				}

				$row = $db->sql_fetchrowset($result);
				$db->sql_freeresult($result);

				for($i = 0; $i < count($row); $i++)
				{
					$topic_id = $row[$i]['topic_id'];

					if ( isset($HTTP_POST_VARS['move_leave_shadow']) )
					{
						// Insert topic in the old forum that indicates that the forum has moved.
						$sql = "INSERT INTO " . TOPICS_TABLE . " (forum_id, topic_title, topic_poster, topic_time, topic_status, topic_type, topic_vote, topic_views, topic_replies, topic_first_post_id, topic_last_post_id, topic_moved_id)
						VALUES ($old_forum_id, '" . addslashes(str_replace("\'", "''", $row[$i]['topic_title'])) . "', '" . str_replace("\'", "''", $row[$i]['topic_poster']) . "', " . $row[$i]['topic_time'] . ", " . TOPIC_MOVED . ", " . POST_NORMAL . ", " . $row[$i]['topic_vote'] . ", " . $row[$i]['topic_views'] . ", " . $row[$i]['topic_replies'] . ", " . $row[$i]['topic_first_post_id'] . ", " . $row[$i]['topic_last_post_id'] . ", $topic_id)";
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not insert shadow topic', '', __LINE__, __FILE__, $sql);
						}
					}

					$sql = "UPDATE " . TOPICS_TABLE . "
						SET forum_id = $new_forum_id
						WHERE topic_id = $topic_id";
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update old topic', '', __LINE__, __FILE__, $sql);
					}

					$sql = "UPDATE " . POSTS_TABLE . "
						SET forum_id = $new_forum_id
						WHERE topic_id = $topic_id";
					if ( !$db->sql_query($sql) )
					{
						message_die(GENERAL_ERROR, 'Could not update post topic ids', '', __LINE__, __FILE__, $sql);
					}
				}

				// Sync the forum indexes
				sync('forum', $new_forum_id);
				sync('forum', $old_forum_id);

				$message = $lang['Topics_Moved'] . '<br /><br />';
			}
			else
			{
				$message = $lang['No_Topics_Moved'] . '<br /><br />';
			}

			if ( !empty($topic_id) )
			{
				$redirect_page = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
			}
			else
			{
				$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
			}

			$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$old_forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="1;url=' . $redirect_page . '">')
			);

			message_die(GENERAL_MESSAGE, $message);
		}//if confirm
		else
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
			message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				$topics = $HTTP_POST_VARS['topic_id_list'];

				for($i = 0; $i < count($topics); $i++)
				{
				$hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
				}
			}
			else
			{
				$hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
			}

			// Set template files
			$template->set_filenames(array(
				'movetopic' => 'modcp_move.tpl')
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Confirm'],
				'MESSAGE_TEXT' => $lang['Confirm_move_topic'],

				'L_MOVE_TO_FORUM' => $lang['Move_to_forum'],
				'L_LEAVESHADOW' => $lang['Leave_shadow_topic'],
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],

				'S_FORUM_SELECT' => make_forum_select('new_forum', $forum_id),
				'S_MODCP_ACTION' => append_sid("modcp.$phpEx"),
				'S_HIDDEN_FIELDS' => $hidden_fields));

			$template->pparse('movetopic');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		} // else confirm sonu
		break;

	case 'lock':
		if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['None_selected']);
		}

		$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?	$HTTP_POST_VARS['topic_id_list'] : array($topic_id);

		$topic_id_sql = '';
		for($i = 0; $i < count($topics); $i++)
		{
			$topic_id_sql .= ( ( $topic_id_sql != '' ) ? ', ' : '' ) . intval($topics[$i]);
		}

		$sql = "UPDATE " . TOPICS_TABLE . "
			SET topic_status = " . TOPIC_LOCKED . "
			WHERE topic_id IN ($topic_id_sql)
				AND forum_id = $forum_id
				AND topic_moved_id = 0";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
		}

		if ( !empty($topic_id) )
		{
			$redirect_page = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'];
			$message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
		}
		else
		{
			$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
			$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
		}

		$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="1;url=' . $redirect_page . '">')
		);

		message_die(GENERAL_MESSAGE, $lang['Topics_Locked'] . '<br /><br />' . $message);

		break;

	case 'unlock':
		if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['None_selected']);
		}

		$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?	$HTTP_POST_VARS['topic_id_list'] : array($topic_id);

		$topic_id_sql = '';
		for($i = 0; $i < count($topics); $i++)
		{
			$topic_id_sql .= ( ( $topic_id_sql != "") ? ', ' : '' ) . intval($topics[$i]);
		}

		$sql = "UPDATE " . TOPICS_TABLE . "
			SET topic_status = " . TOPIC_UNLOCKED . "
			WHERE topic_id IN ($topic_id_sql)
				AND forum_id = $forum_id
				AND topic_moved_id = 0";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
		}

		if ( !empty($topic_id) )
		{
			$redirect_page = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'];
			$message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
		}
		else
		{
			$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
			$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
		}

		$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="1;url=' . $redirect_page . '">')
		);

		message_die(GENERAL_MESSAGE, $lang['Topics_Unlocked'] . '<br /><br />' . $message);

		break;

		// MOD MODCP EXTENSION BEGIN
	case 'sticky':
	case 'announce':
	case 'normalise':

		if ($mode == 'sticky' && !$is_auth['auth_sticky'])
		{
			$message = sprintf($lang['Sorry_auth_sticky'], $is_auth['auth_sticky_type']);
			message_die(GENERAL_MESSAGE, $message);
		}

		if ($mode == 'announce' && !$is_auth['auth_announce'])
		{
			$message = sprintf($lang['Sorry_auth_announce'], $is_auth['auth_announce_type']);
			message_die(GENERAL_MESSAGE, $message);
		}

		if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
		{
			message_die(GENERAL_MESSAGE, $lang['None_selected']);
		}

		$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?	$HTTP_POST_VARS['topic_id_list'] : array($topic_id);

		$topic_id_sql = '';
		for($i = 0; $i < count($topics); $i++)
		{
			$topic_id_sql .= ( ( $topic_id_sql != "") ? ', ' : '' ) . $topics[$i];
		}

		$topic_type = ($mode == 'sticky') ? POST_STICKY : (($mode == 'announce') ? POST_ANNOUNCE : POST_NORMAL);
		$sql = "UPDATE " . TOPICS_TABLE . "
			SET topic_type = " . $topic_type . "
			WHERE topic_id IN ($topic_id_sql)
				AND topic_moved_id = 0";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not update topics table', '', __LINE__, __FILE__, $sql);
		}

		if ( !empty($topic_id) )
		{
			$redirect_page = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id");
			$message = sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
		}
		else
		{
			$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&sid=" . $userdata['session_id'];
			$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
		}

		$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a>');

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="1;url=' . $redirect_page . '">')
		);

		if ($mode == 'sticky')
		{
			$message = $lang['Topics_Stickyd'] . '<br /><br />' . $message;
		}
		else if ($mode == 'announce')
		{
			$message = $lang['Topics_Announced'] . '<br /><br />' . $message;
		}
		else if ($mode == 'normalise')
		{
			$message = $lang['Topics_Normalised'] . '<br /><br />' . $message;
		}

		message_die(GENERAL_MESSAGE, $message);
		break;
		// MOD MODCP EXTENSION END


	case 'merge':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		
		if ( $confirm )
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}
			
			$new_topic_id = $HTTP_POST_VARS['new_topic'];
			$topic_id_list = isset($HTTP_POST_VARS['topic_id_list']) ? $HTTP_POST_VARS['topic_id_list'] : array($topic_id);
			
			for ($i=0; $i < count($topic_id_list); $i++)
			{
				$old_topic_id = $topic_id_list[$i];
				
				if ( $new_topic_id != $old_topic_id )
				{
					$sql = "UPDATE " . POSTS_TABLE . "
					SET topic_id = $new_topic_id
					WHERE topic_id = $topic_id_list[$i]";
	
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not update posts', '', __LINE__, __FILE__, $sql);
					}
	
					$sql = "DELETE FROM " . TOPICS_TABLE . " WHERE topic_id = $topic_id_list[$i]";
	
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not update posts', '', __LINE__, __FILE__, $sql);
					}
	
					$sql = "DELETE FROM	" . TOPICS_WATCH_TABLE . " WHERE topic_id = $topic_id_list[$i]";
	
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not update posts', '', __LINE__, __FILE__, $sql);
					}
	
					// Sync the forum indexes
					sync('forum', $forum_id);
					sync('topic', $new_topic_id);
	
					$message = $lang['Topics_Merged'] . '<br /><br />';
				}
				else
				{
					$message = $lang['No_Topics_Merged'] . '<br /><br />';
				}
			}//end for

			if ( !empty($topic_id) )
			{
				$redirect_page = "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$new_topic_id&amp;sid=" . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_topic'], '<a href="' . $redirect_page . '">', '</a>');
			}
			else
			{
				$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
				$message .= sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
			}

			$message = $message . '<br \><br \>' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$old_forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="1;url=' . $redirect_page . '">')
			);

			message_die(GENERAL_MESSAGE, $message);
		}// end confirm
		else
		{
			if ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) )
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="mode" value="' . $mode . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />';

			if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				$topics = $HTTP_POST_VARS['topic_id_list'];
	
				for($i = 0; $i < count($topics); $i++)
				{
					$hidden_fields .= '<input type="hidden" name="topic_id_list[]" value="' . intval($topics[$i]) . '" />';
				}
			}
			else
			{
				$hidden_fields .= '<input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" />';
			}

			// Set template files
			$template->set_filenames(array(
				'mergetopic' => 'modcp_merge.tpl')
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Confirm'],
				'MESSAGE_TEXT' => $lang['Confirm_move_topic'],
				'L_MERGE_TOPIC' => $lang['Merge_topic'],
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],
				'S_TOPIC_SELECT' => make_topic_select('new_topic', $forum_id),
				'S_MODCP_ACTION' => append_sid("modcp.$phpEx"),
				'S_HIDDEN_FIELDS' => $hidden_fields));

			$template->pparse('mergetopic');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}//end else

		break;

	case 'split':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$post_id_sql = '';

		if (isset($HTTP_POST_VARS['split_type_all']) || isset($HTTP_POST_VARS['split_type_beyond']))
		{
			$posts = $HTTP_POST_VARS['post_id_list'];
			
			for ($i = 0; $i < count($posts); $i++)
			{
				$post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($posts[$i]);
			}
		}

		if ($post_id_sql != '')
		{
			$sql = "SELECT post_id
				FROM " . POSTS_TABLE . "
				WHERE post_id IN ($post_id_sql)
					AND forum_id = $forum_id";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get post id information', '', __LINE__, __FILE__, $sql);
			}

			$post_id_sql = '';
			while ($row = $db->sql_fetchrow($result))
			{
				$post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($row['post_id']);
			}
			$db->sql_freeresult($result);

			if ($post_id_sql == '')
			{
				message_die(GENERAL_MESSAGE, $lang['None_selected']);
			}

			$sql = "SELECT post_id, poster_id, topic_id, post_time
				FROM " . POSTS_TABLE . "
				WHERE post_id IN ($post_id_sql)
				ORDER BY post_time ASC";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not get post information', '', __LINE__, __FILE__, $sql);
			}

			if ($row = $db->sql_fetchrow($result))
			{
				$first_poster = $row['poster_id'];
				$topic_id = $row['topic_id'];
				$post_time = $row['post_time'];
	
				$user_id_sql = '';
				$post_id_sql = '';
	
				do
				{
					$user_id_sql .= (($user_id_sql != '') ? ', ' : '') . intval($row['poster_id']);
					$post_id_sql .= (($post_id_sql != '') ? ', ' : '') . intval($row['post_id']);;
				}
				while ($row = $db->sql_fetchrow($result));

				$post_subject = trim(htmlspecialchars($HTTP_POST_VARS['subject']));
				if (empty($post_subject))
				{
					message_die(GENERAL_MESSAGE, $lang['Empty_subject']);
				}

				$new_forum_id = intval($HTTP_POST_VARS['new_forum_id']);
				$topic_time = time();

				$sql = 'SELECT forum_id FROM ' . FORUMS_TABLE . ' WHERE forum_id = ' . $new_forum_id;
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not select from forums table', '', __LINE__, __FILE__, $sql);
				}

				if (!$db->sql_fetchrow($result))
				{
				message_die(GENERAL_MESSAGE, 'New forum does not exist');
				}

				$db->sql_freeresult($result);

				$sql	= "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type)
					VALUES ('" . str_replace("\'", "''", $post_subject) . "', $first_poster, " . $topic_time . ", $new_forum_id, " . TOPIC_UNLOCKED . ", " . POST_NORMAL . ")";
				if (!($db->sql_query($sql, BEGIN_TRANSACTION)))
				{
					message_die(GENERAL_ERROR, 'Could not insert new topic', '', __LINE__, __FILE__, $sql);
				}

				$new_topic_id = $db->sql_nextid();

				// Update topic watch table, switch users whose posts
				// have moved, over to watching the new topic
				$sql = "UPDATE " . TOPICS_WATCH_TABLE . "
					SET topic_id = $new_topic_id
					WHERE topic_id = $topic_id
						AND user_id IN ($user_id_sql)";
				if (!$db->sql_query($sql))
				{
					message_die(GENERAL_ERROR, 'Could not update topics watch table', '', __LINE__, __FILE__, $sql);
				}

				$sql_where = (!empty($HTTP_POST_VARS['split_type_beyond'])) ? " post_time >= $post_time AND topic_id = $topic_id" : "post_id IN ($post_id_sql)";

				$sql =	"UPDATE " . POSTS_TABLE . "
					SET topic_id = $new_topic_id, forum_id = $new_forum_id
					WHERE $sql_where";
				if (!$db->sql_query($sql, END_TRANSACTION))
				{
					message_die(GENERAL_ERROR, 'Could not update posts table', '', __LINE__, __FILE__, $sql);
				}

				sync('topic', $new_topic_id);
				sync('topic', $topic_id);
				sync('forum', $new_forum_id);
				sync('forum', $forum_id);

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="1;url=' . "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'] . '">')
				);

				$message = $lang['Topic_split'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . "viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');
				message_die(GENERAL_MESSAGE, $message);
			}
		}
		else
		{
			// Set template files
			$template->set_filenames(array(
				'split_body' => 'modcp_split.tpl')
			);

			$sql = "SELECT u.username, p.*, pt.post_text, pt.bbcode_uid, pt.post_subject, p.post_username
				FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
				WHERE p.topic_id = $topic_id
					AND p.poster_id = u.user_id
					AND p.post_id = pt.post_id
						ORDER BY p.post_time ASC";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not get topic/post information', '', __LINE__, __FILE__, $sql);
			}

			$s_hidden_fields = '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" /><input type="hidden" name="' . POST_TOPIC_URL . '" value="' . $topic_id . '" /><input type="hidden" name="mode" value="split" />';

			if( ( $total_posts = $db->sql_numrows($result) ) > 0 )
			{

				$postrow = $db->sql_fetchrowset($result);
				$template->assign_vars(array(
				'L_SPLIT_TOPIC' => $lang['Split_Topic'],
				'L_SPLIT_TOPIC_EXPLAIN' => $lang['Split_Topic_explain'],
				'L_AUTHOR' => $lang['Author'],
				'L_MESSAGE' => $lang['Message'],
				'L_SELECT' => $lang['Select'],
				'L_SPLIT_SUBJECT' => $lang['Split_title'],
				'L_SPLIT_FORUM' => $lang['Split_forum'],
				'L_POSTED' => $lang['Posted'],
				'L_SPLIT_POSTS' => $lang['Split_posts'],
				'L_SUBMIT' => $lang['Submit'],
				'L_SPLIT_AFTER' => $lang['Split_after'],
				'L_POST_SUBJECT' => $lang['Post_subject'],
				'L_MARK_ALL' => $lang['Mark_all'],
				'L_UNMARK_ALL' => $lang['Unmark_all'],
				'L_POST' => $lang['Post'],
				'FORUM_NAME' => $forum_name,
				'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
				'S_SPLIT_ACTION' => append_sid("modcp.$phpEx"),
				'S_HIDDEN_FIELDS' => $s_hidden_fields,
				'S_FORUM_SELECT' => make_forum_select("new_forum_id", false, $forum_id)));

			// Define censored word matches
			$orig_word = array();
			$replacement_word = array();
			obtain_word_list($orig_word, $replacement_word);

			for($i = 0; $i < $total_posts; $i++)
			{
				$post_id = $postrow[$i]['post_id'];
				$poster_id = $postrow[$i]['poster_id'];
				$poster = $postrow[$i]['username'];
				$poster = color_group_colorize_name($postrow[$i]['poster_id'], true);

				$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);
				
				$bbcode_uid = $postrow[$i]['bbcode_uid'];
				$message = $postrow[$i]['post_text'];
				$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : $topic_title;
				
				//
				// If the board has HTML off but the post has HTML
				// on then we process it, else leave it alone
				//
				if ( !$board_config['allow_html'] )
				{
					if ( $postrow[$i]['enable_html'] )
					{
						$message = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\\2&gt;', $message);
					}
				}

				if ( $bbcode_uid != '' )
				{
					$message = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $message);
				}

				if ( count($orig_word) )
				{
					$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);
					$message = preg_replace($orig_word, $replacement_word, $message);
				}

				$message = make_clickable($message);

				if ( $board_config['allow_smilies'] && $postrow[$i]['enable_smilies'] )
				{
					$message = smilies_pass($message);
				}

				$message = str_replace("\n", '<br />', $message);

				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				$checkbox = ( $i > 0 ) ? '<input type="checkbox" name="post_id_list[]" value="' . $post_id . '" />' : '&nbsp;';

				$template->assign_block_vars('postrow', array(
					'ROW_COLOR' => '#' . $row_color,
					'ROW_CLASS' => $row_class,
					'POSTER_NAME' => $poster,
					'POST_DATE' => $post_date,
					'POST_SUBJECT' => $post_subject,
					'MESSAGE' => $message,
					'POST_ID' => $post_id,
					'S_SPLIT_CHECKBOX' => $checkbox));
				}//end for
			
			$template->pparse('split_body');
			}
		}//end else
		break;
		
		case 'ip':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);
		
		$rdns_ip_num = ( isset($HTTP_GET_VARS['rdns']) ) ? $HTTP_GET_VARS['rdns'] : "";
		
		if ( !$post_id )
		{
			message_die(GENERAL_MESSAGE, $lang['No_such_post']);
		}

		// Set template files
		$template->set_filenames(array(
			'viewip' => 'modcp_viewip.tpl')
		);

		// Look up relevent data for this post
		$sql = "SELECT poster_ip, poster_id
			FROM " . POSTS_TABLE . "
			WHERE post_id = $post_id
				AND forum_id = $forum_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get poster IP information', '', __LINE__, __FILE__, $sql);
		}

		if ( !($post_row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_MESSAGE, $lang['No_such_post']);
		}

		$ip_this_post = decode_ip($post_row['poster_ip']);
		$ip_this_post = ( $rdns_ip_num == $ip_this_post ) ? htmlspecialchars(gethostbyaddr($ip_this_post)) : $ip_this_post;

		$poster_id = $post_row['poster_id'];

		$template->assign_vars(array(
			'L_IP_INFO' => $lang['IP_info'],
			'L_THIS_POST_IP' => $lang['This_posts_IP'],
			'L_OTHER_IPS' => $lang['Other_IP_this_user'],
			'L_OTHER_USERS' => $lang['Users_this_IP'],
			'L_LOOKUP_IP' => $lang['Lookup_IP'],
			'L_SEARCH' => $lang['Search'],
			'SEARCH_IMG' => $images['icon_search'],
			'IP' => $ip_this_post,
			'U_LOOKUP_IP' => "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=$post_id&amp;" . POST_TOPIC_URL . "=$topic_id&amp;rdns=$ip_this_post&amp;sid=" . $userdata['session_id']));

		//
		// Get other IP's this user has posted under
		//
		$sql = "SELECT poster_ip, COUNT(*) AS postings
			FROM " . POSTS_TABLE . "
			WHERE poster_id = $poster_id
				GROUP BY poster_ip
					ORDER BY " . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . " DESC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get IP information for this user', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;
			do
			{

				if ( $row['poster_ip'] == $post_row['poster_ip'] )
				{
					$template->assign_vars(array(
						'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ))
					);
					continue;
				}

			$ip = decode_ip($row['poster_ip']);
			$ip = ( $rdns_ip_num == $row['poster_ip'] || $rdns_ip_num == 'all') ? htmlspecialchars(gethostbyaddr($ip)) : $ip;

			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

				if ( $poster_id != ANONYMOUS )
				{
					$template->assign_block_vars('iprow', array(
					'ROW_COLOR' => '#' . $row_color,
					'ROW_CLASS' => $row_class,
					'IP' => $ip,
					'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
					
					'U_LOOKUP_IP' => "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=$post_id&amp;" . POST_TOPIC_URL . "=$topic_id&amp;rdns=" . $row['poster_ip'] . "&amp;sid=" . $userdata['session_id'])
					);
				}
	
			$i++;
			}
			while ( $row = $db->sql_fetchrow($result) );
		}

		// Get other users who've posted under this IP
		$sql = "SELECT u.user_id, u.username, COUNT(*) as postings
			FROM " . USERS_TABLE ." u, " . POSTS_TABLE . " p
			WHERE p.poster_id = u.user_id
				AND p.poster_ip = '" . $post_row['poster_ip'] . "'
					GROUP BY u.user_id, u.username
						ORDER BY " . (( SQL_LAYER == 'msaccess' ) ? 'COUNT(*)' : 'postings' ) . " DESC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not get posters information based on IP', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$i = 0;

			do
			{
				$id = $row['user_id'];
				$username = ( $id == ANONYMOUS ) ? $lang['Guest'] : $row['username'];
				
				$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
				$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
				
				$template->assign_block_vars('userrow', array(
					'ROW_COLOR' => '#' . $row_color,
					'ROW_CLASS' => $row_class,
					'USERNAME' => $username,
					'POSTS' => $row['postings'] . ' ' . ( ( $row['postings'] == 1 ) ? $lang['Post'] : $lang['Posts'] ),
					'L_SEARCH_POSTS' => sprintf($lang['Search_user_posts'], $username),
	
					'U_PROFILE' => ($id == ANONYMOUS) ? "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=" . $post_id . "&amp;" . POST_TOPIC_URL . "=" . $topic_id . "&amp;sid=" . $userdata['session_id'] : append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$id"),
					'U_SEARCHPOSTS' => append_sid("search.$phpEx?search_author=" . (($id == ANONYMOUS) ? 'Anonymous' : urlencode($username)) . "&amp;showresults=topics"))
				);

				$i++;
			}
			while ( $row = $db->sql_fetchrow($result) );
		}//end result

		$template->pparse('viewip');

		break;


	case 'recycle':
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		if ( $confirm_recycle )
		{

			if ( ( $board_config['bin_forum'] == 0 ) || ( empty($HTTP_POST_VARS['topic_id_list']) && empty($topic_id) ) )
			{
				$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
				$message = sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');
				$message = $message . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
				);

				message_die(GENERAL_MESSAGE, $lang['None_selected'] . '<br /><br />' . $message);
			}
			else if ( isset($HTTP_POST_VARS['topic_id_list']) )
			{
				// Define bin forum
				$new_forum_id = intval($board_config['bin_forum']);
				$old_forum_id = $forum_id;

				if ( $new_forum_id != $old_forum_id )
				{
					$topics = ( isset($HTTP_POST_VARS['topic_id_list']) ) ?	$HTTP_POST_VARS['topic_id_list'] : array($topic_id);
		
					$topic_list = '';
					for($i = 0; $i < count($topics); $i++)
					{
						$topic_list .= ( ( $topic_list != '' ) ? ', ' : '' ) . intval($topics[$i]);
					}
	
					$sql = "SELECT *
						FROM " . TOPICS_TABLE . "
						WHERE topic_id IN ($topic_list)
							AND forum_id = $old_forum_id
							AND topic_status <> " . TOPIC_MOVED;
					if ( !($result = $db->sql_query($sql, BEGIN_TRANSACTION)) )
					{
						message_die(GENERAL_ERROR, 'Could not select from topic table', '', __LINE__, __FILE__, $sql);
					}
	
					$row = $db->sql_fetchrowset($result);
					$db->sql_freeresult($result);
	
					for($i = 0; $i < count($row); $i++)
					{
						$topic_id = $row[$i]['topic_id'];
		
						if ( isset($HTTP_POST_VARS['move_leave_shadow']) )
						{
							// Insert topic in the old forum that indicates that the forum has moved.
							$sql = "INSERT INTO " . TOPICS_TABLE . " (forum_id, topic_title, topic_poster, topic_time, topic_status, topic_type, topic_vote, topic_views, topic_replies, topic_first_post_id, topic_last_post_id, topic_moved_id)
							VALUES ($old_forum_id, '" . addslashes(str_replace("\'", "''", $row[$i]['topic_title'])) . "', '" . str_replace("\'", "''", $row[$i]['topic_poster']) . "', " . $row[$i]['topic_time'] . ", " . TOPIC_MOVED . ", " . POST_NORMAL . ", " . $row[$i]['topic_vote'] . ", " . $row[$i]['topic_views'] . ", " . $row[$i]['topic_replies'] . ", " . $row[$i]['topic_first_post_id'] . ", " . $row[$i]['topic_last_post_id'] . ", $topic_id)";
							if ( !$db->sql_query($sql) )
							{
								message_die(GENERAL_ERROR, 'Could not insert shadow topic', '', __LINE__, __FILE__, $sql);
							}
						}
		
						$sql = "UPDATE " . TOPICS_TABLE . "
							SET forum_id = $new_forum_id
							WHERE topic_id = $topic_id";
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not update old topic', '', __LINE__, __FILE__, $sql);
						}
		
						$sql = "UPDATE " . POSTS_TABLE . "
							SET forum_id = $new_forum_id
							WHERE topic_id = $topic_id";
						if ( !$db->sql_query($sql) )
						{
							message_die(GENERAL_ERROR, 'Could not update post topic ids', '', __LINE__, __FILE__, $sql);
						}
					}//end for
	
					// Sync the forum indexes
					sync('forum', $new_forum_id);
					sync('forum', $old_forum_id);
					
					$message = $lang['Topics_Moved_bin'];
				}
				else
				{
					$message = $lang['No_Topics_Moved'];
				}

				$redirect_page = "modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'];
				$message .= '<br /><br />' . sprintf($lang['Click_return_modcp'], '<a href="' . $redirect_page . '">', '</a>');

				$message = $message . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . "viewforum.$phpEx?" . POST_FORUM_URL . "=$old_forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');

				$template->assign_vars(array(
					'META' => '<meta http-equiv="refresh" content="3;url=' . $redirect_page . '">')
				);

				message_die(GENERAL_MESSAGE, $message);
			}
		}
		include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		break;
		// End add - Bin Mod		

	default:
		$page_title = $lang['Mod_CP'];
		include($phpbb_root_path . 'includes/page_header.'.$phpEx);

		$template->assign_vars(array(
			'FORUM_NAME' => $forum_name,
			'L_MOD_CP' => $lang['Mod_CP'],
			'L_MOD_CP_EXPLAIN' => $lang['Mod_CP_explain'],
			'L_SELECT' => $lang['Select'],
			'L_DELETE' => $lang['Delete'],
			'L_MOVE' => $lang['Move'],
			'L_LOCK' => $lang['Lock'],
			'L_UNLOCK' => $lang['Unlock'],
			'L_STICKY' => $lang['Sticky'],
			'L_ANNOUNCE' => $lang['Announce'],
			'L_NORMALISE' => $lang['Normalise'],
			'L_RECYCLE' => $lang['Bin_recycle'],
			'L_MARK_ALL' => $lang['Mark_all'],
			'L_UNMARK_ALL' => $lang['Unmark_all'],
			'L_MERGE' => $lang['Merge'],
			'L_TOPICS' => $lang['Topics'],
			'L_REPLIES' => $lang['Replies'],
			'L_LASTPOST' => $lang['Last_Post'],
			'L_SELECT' => $lang['Select'],
			'U_VIEW_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
			'S_HIDDEN_FIELDS' => '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" /><input type="hidden" name="' . POST_FORUM_URL . '" value="' . $forum_id . '" />',
			'S_MODCP_ACTION' => append_sid("modcp.$phpEx"))
			);

		if ($is_auth['auth_delete'])
		{
			$template->assign_block_vars('switch_auth_delete', array());
		}

		if ($is_auth['auth_sticky'])
		{
			$template->assign_block_vars('switch_auth_sticky', array());
		}

		if ($is_auth['auth_announce'])
		{
			$template->assign_block_vars('switch_auth_announce', array());
		}

		$template->set_filenames(array(
			'body' => 'modcp_body.tpl')
		);
		// Begin Simple Subforums MOD
		$all_forums = array();
		make_jumpbox_ref('modcp.'.$phpEx, $forum_id, $all_forums);

		$parent_id = 0;
		for( $i = 0; $i < count($all_forums); $i++ )
		{
			if( $all_forums[$i]['forum_id'] == $forum_id )
			{
				$parent_id = $all_forums[$i]['forum_parent'];
			}
		}

		if( $parent_id )
		{
			for( $i = 0; $i < count($all_forums); $i++)
			{
				if( $all_forums[$i]['forum_id'] == $parent_id )
				{
					$template->assign_vars(array(
						'PARENT_FORUM'	=> 1,
						'U_VIEW_PARENT_FORUM' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
						'PARENT_FORUM_NAME' => $all_forums[$i]['forum_name'],
						));
				}//end if
			}//end for
		} // end patern id
		// End Simple Subforums MOD
		
		
		
		//
		// Define censored word matches
		//
		$orig_word = array();
		$replacement_word = array();
		obtain_word_list($orig_word, $replacement_word);
		
		$sql = "SELECT t.*, u.username, u.user_id, p.post_time, p.post_username
			FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p
			WHERE t.forum_id = $forum_id
				AND t.topic_poster = u.user_id
				AND p.post_id = t.topic_last_post_id
			ORDER BY t.topic_type DESC, p.post_time DESC";
		$sql .=	($viewall == 1) ? '' : " LIMIT $start, " . $board_config['topics_per_page'] ;

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
		}

		while ( $row = $db->sql_fetchrow($result) )
		{
			$topic_title = '';

			if ( $row['topic_status'] == TOPIC_LOCKED )
			{
				$folder_img = $images['folder_locked'];
				$folder_alt = $lang['Topic_locked'];
			}
			else
			{
				if ( $row['topic_type'] == POST_ANNOUNCE )
				{
					$folder_img = $images['folder_announce'];
					$folder_alt = $lang['Topic_Announcement'];
				}
				else if ( $row['topic_type'] == POST_STICKY )
				{
					$folder_img = $images['folder_sticky'];
					$folder_alt = $lang['Topic_Sticky'];
				}
				else
				{
					$folder_img = $images['folder'];
					$folder_alt = $lang['No_new_posts'];
				}
			}

			$topic_id = $row['topic_id'];
			$topic_type = $row['topic_type'];
			$topic_status = $row['topic_status'];

			if ( $topic_type == POST_ANNOUNCE )
			{
				$topic_type = $lang['Topic_Announcement'] . ' ';
			}
			else if ( $topic_type == POST_STICKY )
			{
				$topic_type = $lang['Topic_Sticky'] . ' ';
			}
			else if ( $topic_status == TOPIC_MOVED )
			{
				$topic_type = $lang['Topic_Moved'] . ' ';
			}
			else
			{
				$topic_type = '';
			}

			if ( $row['topic_vote'] )
			{
				$topic_type .= $lang['Topic_Poll'] . ' ';
			}

			$topic_title = $row['topic_title'];
			if ( count($orig_word) )
			{
				$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
			}

			$u_view_topic = "modcp.$phpEx?mode=split&amp;" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'];
			$topic_replies = $row['topic_replies'];

			$last_post_time = create_date($board_config['default_dateformat'], $row['post_time'], $board_config['board_timezone']);

			$poster = ( $row['user_id'] == ANONYMOUS ) ? ( ($row['post_username'] != '' ) ? $row['post_username'] : $lang['Guest'] ) : color_group_colorize_name($row['user_id'], true);

			$template->assign_block_vars('topicrow', array(
				'U_VIEW_TOPIC' => $u_view_topic,
				'TOPIC_FOLDER_IMG' => $folder_img,
				'TOPIC_TYPE' => $topic_type,
				'USERNAME' => $poster,
				'TOPIC_TITLE' => $topic_title,
				'REPLIES' => $topic_replies,
				'LAST_POST_TIME' => $last_post_time,
				'TOPIC_ID' => $topic_id,
				'TOPIC_ATTACHMENT_IMG' => topic_attachment_image($row['topic_attachment']),
				'L_TOPIC_FOLDER_ALT' => $folder_alt)
			);
		} // end while


		$page_number = ( $total_topics != '0' ) ? sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_topics / $board_config['topics_per_page'] )) : '';
		if ( $viewall == 1 )
		{
			$pagination = '<a href="' . append_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id']) . '">' . $lang['Show_pages'] . '</a>';
			$page_number = '';
			$l_goto_page = '';
		}
		else if ( $forum_topics > $board_config['topics_per_page'] )
		{
			$pagination = generate_pagination("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'], $forum_topics, $board_config['topics_per_page'], $start) . ' | ' . '<a href="' . append_sid("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] ."&amp;viewall=1") . '">' . $lang['View_all'] . '</a>';
		}
		else
		{
			$pagination = generate_pagination("modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'], $forum_topics, $board_config['topics_per_page'], $start);
		}

		$template->assign_vars(array(
			'PAGINATION' => $pagination,
			'PAGE_NUMBER' => $page_number,
			'L_GOTO_PAGE' => $lang['Goto_page'])
		);

		$template->pparse('body');

		break;
}//end mode d?ng?s?

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>