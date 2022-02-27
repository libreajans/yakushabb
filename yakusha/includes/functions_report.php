<?php
/***************************************************************************
* functions_report.php 
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

function report_notify($cat_id, $info, $text)
{
	global $board_config, $phpEx, $db, $phpbb_root_path, $userdata;
	
	$cat_id = intval($cat_id);

	if ($board_config['report_notify'] == 2)
	{
		$sql = 'SELECT user_id, user_email, user_lang
			FROM ' . USERS_TABLE . '
			WHERE user_level = ' . ADMIN . '
				AND user_id <> ' . $userdata['user_id'];	
	}
	else if ($board_config['report_notify'] == 1)
	{
		switch ($cat_id)
		{
			case REPORT_POST_ID:
				$sql = 'SELECT DISTINCT u.user_id, u.user_email, u.user_lang
					FROM ' . USERS_TABLE . ' u, ' . REPORT_CAT_TABLE . ' c, ' . POSTS_TABLE . ' p, 
						' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug
					WHERE 
						(
							u.user_level = ' . MOD . '
							AND p.post_id = ' . str_replace("'", "''", $info) . "
							AND aa.forum_id = p.forum_id
							AND ug.user_id = u.user_id
							AND aa.group_id = ug.group_id
							AND aa.auth_mod = 1
							AND c.cat_id = $cat_id
							AND c.cat_auth = 0
						)
						OR u.user_level = " . ADMIN . '
						AND u.user_id <> ' . $userdata['user_id'];
				break;
			case REPORT_TOPIC_ID:
				$sql = 'SELECT DISTINCT u.user_id, u.user_email, u.user_lang
					FROM ' . USERS_TABLE . ' u, ' . REPORT_CAT_TABLE . ' c, ' . TOPICS_TABLE . ' t, 
						' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug
					WHERE 
						(
							u.user_level = ' . MOD . '
							AND t.topic_id = ' . str_replace("'", "''", $info) . "
							AND aa.forum_id = t.forum_id
							AND ug.user_id = u.user_id
							AND aa.group_id = ug.group_id
							AND aa.auth_mod = 1
							AND c.cat_id = $cat_id
							AND c.cat_auth = 0
						)
						OR u.user_level = " . ADMIN . '
						AND u.user_id <> ' . $userdata['user_id'];
				break;
			default:
				$sql = 'SELECT DISTINCT u.user_id, u.user_email, u.user_lang
					FROM ' . USERS_TABLE . ' u, ' . REPORT_CAT_TABLE . ' c
					WHERE 
						(
							u.user_level = ' . MOD . "
							AND c.cat_id = $cat_id
							AND c.cat_auth = 0
						)
						OR u.user_level = " . ADMIN . '
						AND u.user_id <> ' . $userdata['user_id'];
				break;
		}
	}
	else
	{
		return;
	}

	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not obtain list of moderators/admins', '', __LINE__, __FILE__, $sql);
	}

	$bcc_list_ary = array();
	if ($row = $db->sql_fetchrow($result))
	{
		// Sixty second limit
		@set_time_limit(60);

		do
		{
			if ($row['user_email'] != '')
			{
				$bcc_list_ary[$row['user_lang']][] = $row['user_email'];
			}
		}
		while ($row = $db->sql_fetchrow($result));

		//
		// Let's do some checking to make sure that mass mail functions
		// are working in win32 versions of php.
		//
		if (preg_match('/[c-z]:\\\.*/i', getenv('PATH')) && !$board_config['smtp_delivery'])
		{
			$ini_val = (@phpversion() >= '4.0.0') ? 'ini_get' : 'get_cfg_var';

			// We are running on windows, force delivery to use our smtp functions
			// since php's are broken by default
			$board_config['smtp_delivery'] = 1;
			$board_config['smtp_host'] = @$ini_val('SMTP');
		}

		if (sizeof($bcc_list_ary))
		{
			include_once($phpbb_root_path . 'includes/emailer.'.$phpEx);
			$emailer = new emailer($board_config['smtp_delivery']);
		
			$server_name = trim($board_config['server_name']);
			$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
			$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) . '/' : '/';
			$script_path = preg_replace('/^\/?(.*?)\/?$/', '\1/', trim($board_config['script_path']));
			$server_full = $server_protocol . $server_name . $server_port . $script_path;
			
			switch ($cat_id)
			{
				case REPORT_POST_ID:
					$info = "{$server_full}viewtopic.$phpEx?" . POST_POST_URL . "=$info#$info";
					break;
				case REPORT_TOPIC_ID:
					$info = "{$server_full}viewtopic.$phpEx?" . POST_TOPIC_URL . "=$info";
					break;
				case REPORT_USER_ID:
					$info = "{$server_full}profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$info";
					break;	
			}

			$emailer->from($board_config['board_email']);
			$emailer->replyto($board_config['board_email']);

			@reset($bcc_list_ary);
			foreach ($bcc_list_ary as $user_lang => $bcc_list)
			{
				$emailer->use_template('report_notify', $user_lang);

				foreach ($bcc_list as $bcc)
				{
					$emailer->bcc($bcc);
				}

				// The Report_notification lang string below will be used
				// if for some reason the mail template subject cannot be read
				// ... note it will not necessarily be in the posters own language!
				$emailer->set_subject($lang['Report_notification']);

				// This is a nasty kludge to remove the username var ... till (if?)
				// translators update their templates
				$emailer->msg = preg_replace('#[ ]?{USERNAME}#', '', $emailer->msg);

				$emailer->assign_vars(array(
					'EMAIL_SIG' => (!empty($board_config['board_email_sig'])) ? str_replace('<br />', "\n", "-- \n" . $board_config['board_email_sig']) : '',
					'SITENAME' => $board_config['sitename'],
					'REPORT_INFO' => (!empty($info)) ? $info : '-',
					'REPORT_TEXT' => (!empty($text)) ? $text : '-',
					
					'U_REPORT_PAGE' => "{$server_full}report.$phpEx?" . POST_CAT_URL . "=$cat_id")
				);

				$emailer->send();
				$emailer->reset();
			}
		}
	}
	$db->sql_freeresult($result);
}

function report_auth($mode, $id)
{
	global $db, $userdata;

	// Administrators
	if ($userdata['user_level'] == ADMIN)
	{
		return true;
	}
	
	$id = intval($id);

	// Moderators
	$return = false;
	switch ($mode)
	{
		case 'report':
			$sql = 'SELECT r.report_info, r.cat_id FROM ' . REPORT_TABLE . ' r, ' . REPORT_CAT_TABLE . " c
				WHERE r.cat_id = c.cat_id AND c.cat_auth = 0 AND r.report_id = $id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not get report info', '', __LINE__, __FILE__, $sql);
			}
			if ($db->sql_numrows($result))
			{
				$row = $db->sql_fetchrow($result);
				switch ($row['cat_id'])
				{
					case REPORT_POST_ID:
						$post_id = $row['report_info'];
						break;
					case REPORT_TOPIC_ID:
						$topic_id = $row['report_info'];
						break;
					default:
						$return = true;
				}
			}
			$db->sql_freeresult($result);
			break;
		case 'cat':
			$sql = 'SELECT COUNT(cat_id) AS count FROM ' . REPORT_CAT_TABLE . "
				WHERE cat_auth = 0 AND cat_id = $id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not get cat info', '', __LINE__, __FILE__, $sql);
			}
			$count = $db->sql_fetchfield('count', 0, $result);
			$db->sql_freeresult($result);
			if ($count)
			{
				$return = true;
			}
			break;
		case 'post':
			$post_id = $id;
			break;
		case 'topic':
			$topic_id = $id;
			break;
	}

  if (isset($post_id) && is_numeric($post_id) && !$return)
  {
		$sql = 'SELECT COUNT(post_id) AS count
			FROM ' . POSTS_TABLE . ' p, ' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug
			WHERE p.forum_id = aa.forum_id
				AND aa.group_id = ug.group_id
				AND aa.auth_mod = 1
				AND ug.user_id = ' . $userdata['user_id'] . "
				AND p.post_id = $post_id";
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not get moderator info', '', __LINE__, __FILE__, $sql);
		}
		$count = $db->sql_fetchfield('count', 0, $result);
		if ($count)
		{
			$return = true;
		}
		$db->sql_freeresult($result);
	}
  else if (isset($topic_id) && is_numeric($topic_id) && !$return)
  {
		$sql = 'SELECT COUNT(topic_id) AS count
			FROM ' . TOPICS_TABLE . ' t, ' . AUTH_ACCESS_TABLE . ' aa, ' . USER_GROUP_TABLE . ' ug
			WHERE t.forum_id = aa.forum_id
				AND aa.group_id = ug.group_id
				AND aa.auth_mod = 1
				AND ug.user_id = ' . $userdata['user_id'] . "
				AND t.topic_id = $topic_id";
		if (!($result = $db->sql_query($sql)))
		{
			message_die(GENERAL_ERROR, 'Could not get moderator info', '', __LINE__, __FILE__, $sql);
		}
		$count = $db->sql_fetchfield('count', 0, $result);
		if ($count)
		{
			$return = true;
		}
		$db->sql_freeresult($result);
	}

	return $return;
}

function report_count($mode = '')
{
	global $db, $userdata;

	$sql_add = ($userdata['user_level'] == MOD) ? ', ' . REPORT_CAT_TABLE . ' c' : '';
	switch ($mode)
	{
		case 'notcleared':
			$sql = 'SELECT r.cat_id, r.report_info FROM ' . REPORT_TABLE . " r $sql_add
				WHERE report_status = " . REPORT_NOT_CLEARED;
			$sql .= ($userdata['user_level'] == MOD) ? ' AND r.cat_id = c.cat_id AND c.cat_auth = 0' : '';
			break;
		case 'process':
			$sql = 'SELECT r.cat_id, r.report_info FROM ' . REPORT_TABLE . " r $sql_add
				WHERE report_status = " . REPORT_IN_PROCESS;
			$sql .= ($userdata['user_level'] == MOD) ? ' AND r.cat_id = c.cat_id AND c.cat_auth = 0' : '';
			break;
		case 'cleared':
			$sql = 'SELECT r.cat_id, r.report_info FROM ' . REPORT_TABLE . " r $sql_add
				WHERE report_status = " . REPORT_CLEARED;
			$sql .= ($userdata['user_level'] == MOD) ? ' AND r.cat_id = c.cat_id AND c.cat_auth = 0' : '';
			break;
		default:
			$sql = 'SELECT r.cat_id, r.report_info FROM ' . REPORT_TABLE . " r $sql_add";
			$sql .= ($userdata['user_level'] == MOD) ? ' WHERE r.cat_id = c.cat_id AND c.cat_auth = 0' : '';
			break;
	}

	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not get report count', '', __LINE__, __FILE__, $sql);
	}
	$count = 0;
	while ($row = $db->sql_fetchrow($result))
	{
		switch ($row['cat_id'])
		{
			case REPORT_POST_ID:
				$report_auth = report_auth('post', $row['report_info']);
				break;
			case REPORT_TOPIC_ID:
				$report_auth = report_auth('topic', $row['report_info']);
				break;
			default:
				$report_auth = true;
				break;
		}

		if ($report_auth)
		{
			$count++;
		}
	}
	$db->sql_freeresult($result);

	return $count;
}

function report_prepare_errors($error_msg)
{
	global $phpbb_root_path;

	switch (count($error_msg))
	{
		case 0:
			return false;
			break;
		case 1:
			$msg = $error_msg[0];
			break;
		default:
			$msg = implode('<br /><img src="' . $phpbb_root_path . 'images/spacer.gif" height="5" width="1" alt="" /><br />', $error_msg);
			break;
	}

	return $msg;
}

function insert_report($cat_id, $report_info, $report_text)
{
	global $userdata, $db;
	
	$cat_id = intval($cat_id);
	$report_info = str_replace("'", "''", trim($report_info));
	$report_text = str_replace("'", "''", trim($report_text));	

	$sql = 'INSERT INTO ' . REPORT_TABLE . " (cat_id, report_status, report_date, report_user_id, report_info, report_text)
		VALUES($cat_id, " . REPORT_NOT_CLEARED . ', ' . time() . ', ' . $userdata['user_id'] . ", '$report_info', '$report_text')";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not insert report', '', __LINE__, __FILE__, $sql);
	}

	return $db->sql_nextid();
}

function insert_report_cat($cat_name, $cat_explain, $cat_type = REPORT_NORMAL, $cat_auth = 0)
{
	global $db;

	$cat_name = str_replace("'", "''", trim($cat_name));
	$cat_explain = str_replace("'", "''", trim($cat_explain));
	$cat_type = intval($cat_type);
	$cat_auth = intval($cat_auth);

	$sql = 'INSERT INTO ' . REPORT_CAT_TABLE . " (cat_name, cat_explain, cat_type, cat_auth)
		VALUES ('$cat_name', '$cat_explain', $cat_type, $cat_auth)";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not insert category', '', __LINE__, __FILE__, $sql);
	}

	return $db->sql_nextid();
}

function update_report_cat($cat_id, $cat_name, $cat_explain, $cat_type, $cat_auth)
{
	global $db;

	$cat_id = intval($cat_id);
	$cat_name = str_replace("'", "''", trim($cat_name));
	$cat_explain = str_replace("'", "''", trim($cat_explain));
	$cat_type = intval($cat_type);
	$cat_auth = intval($cat_auth);

	$sql  = 'UPDATE ' . REPORT_CAT_TABLE . "
		SET
			cat_name = '$cat_name',
			cat_explain = '$cat_explain',
			cat_type = $cat_type,
			cat_auth = $cat_auth
		WHERE cat_id = $cat_id";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not update category', '', __LINE__, __FILE__, $sql);
	}

	return true;
}

function delete_report_cat($mode, $cat_id, $new_cat_id = -1)
{
	global $db;

	$cat_id = intval($cat_id);
	switch ($mode)
	{
		case 'delete':
			$sql = 'DELETE FROM ' . REPORT_TABLE . " WHERE cat_id = $cat_id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not delete reports', '', __LINE__, __FILE__, $sql);
			}
			break;
		case 'move':
			$new_cat_id = intval($new_cat_id);
			$sql = 'UPDATE ' . REPORT_TABLE . " SET cat_id = $new_cat_id
				WHERE cat_id = $cat_id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not move reports', '', __LINE__, __FILE__, $sql);
			}
			break;
	}

	$sql = 'DELETE FROM ' . REPORT_CAT_TABLE . " WHERE cat_id = $cat_id";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not delete category', '', __LINE__, __FILE__, $sql);
	}

	return true;
}

function change_report_status($mode, $id)
{
	global $db;

	$id = intval($id);
	switch ($mode)
	{
		case 'clear':
			$sql = 'UPDATE ' . REPORT_TABLE . '
				SET report_status = ' . REPORT_CLEARED . "
				WHERE report_id = $id";
			break;
		case 'process':
			$sql = 'UPDATE ' . REPORT_TABLE . '
				SET report_status = ' . REPORT_IN_PROCESS . "
				WHERE report_id = $id";
			break;
		case 'clearpost':
			$sql = 'UPDATE ' . REPORT_TABLE . '
				SET report_status = ' . REPORT_CLEARED . '
				WHERE cat_id = ' . REPORT_POST_ID . " AND report_info = $id";
			break;
		case 'cleartopic':
			$sql = 'UPDATE ' . REPORT_TABLE . '
				SET report_status = ' . REPORT_CLEARED . '
				WHERE cat_id = ' . REPORT_TOPIC_ID . " AND report_info = $id";
			break;
		case 'unclear':
			$sql = 'UPDATE ' . REPORT_TABLE . ' SET
				report_status = ' . REPORT_NOT_CLEARED . "
				WHERE report_id = $id";
			break;
	}
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not change report status', '', __LINE__, __FILE__, $sql);
	}

	return true;
}

function delete_report($mode, $id)
{
	global $db;

	$id = intval($id);
	switch ($mode)
	{
		case 'report':
			$sql = 'DELETE FROM ' . REPORT_TABLE . "
				WHERE report_id = $id";
			break;
		case 'cat':
			$sql = 'DELETE FROM ' . REPORT_TABLE . "
				WHERE cat_id = $id";
			break;
	}
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not delete report(s)', '', __LINE__, __FILE__, $sql);
	}

	return true;
}

function get_report_status($mode, $id, $post_ids = false)
{
	global $db;

	$id = intval($id);
	switch ($mode)
	{
		case 'topic_posts':
			if (is_array($post_ids))
			{
				$post_id_list = '';
				$reported_info = array(
					-1 => REPORT_CLEARED
				);
				foreach ($post_ids as $post_id)
				{
					$post_id = intval($post_id);
					$reported_info[$post_id] = REPORT_CLEARED;
					$post_id_list .= ($post_id_list != '') ? ", $post_id" : $post_id;
				}
			
				$sql = 'SELECT cat_id, report_status, report_info FROM ' . REPORT_TABLE . '
					WHERE 
						(cat_id = ' . REPORT_TOPIC_ID . " AND report_info = $id)
							OR (cat_id = " . REPORT_POST_ID . " AND report_info IN($post_id_list))
						AND report_status <> " . REPORT_CLEARED . '
					ORDER BY report_status DESC';
				unset($post_id_list);
				if (!($result = $db->sql_query($sql)))
				{
					message_die(GENERAL_ERROR, 'Could not get reported info', '', __LINE__, __FILE__, $sql);
				}
				while ($row = $db->sql_fetchrow($result))
				{
					if ($row['cat_id'] == REPORT_TOPIC_ID)
					{
						$reported_info[-1] = $row['report_status'];
					}
					else
					{
						$reported_info[$row['report_info']] = $row['report_status'];
					}
				}
				$db->sql_freeresult($result);
				
				return $reported_info;
			}
			else
			{
				return false;
			}
			break;
			
		case 'topic':
			$sql = 'SELECT report_status FROM ' . REPORT_TABLE . '
				WHERE cat_id = ' . REPORT_TOPIC_ID . " AND report_info = $id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not get reported info', '', __LINE__, __FILE__, $sql);
			}
			$report_status = ($db->sql_numrows($result)) ? $db->sql_fetchfield('report_status', 0, $result) : REPORT_CLEARED;
			$db->sql_freeresult($result);
			
			return $report_status;
			break;
			
		case 'post':
			$sql = 'SELECT report_status FROM ' . REPORT_TABLE . '
				WHERE cat_id = ' . REPORT_POST_ID . " AND report_info = $id";
			if (!($result = $db->sql_query($sql)))
			{
				message_die(GENERAL_ERROR, 'Could not get reported info', '', __LINE__, __FILE__, $sql);
			}
			$report_status = ($db->sql_numrows($result)) ? $db->sql_fetchfield('report_status', 0, $result) : REPORT_CLEARED;
			$db->sql_freeresult($result);
			
			return $report_status;
			break;
	}
}

function get_topic_title($mode, $id)
{
	global $db;

	$id = intval($id);
	switch ($mode)
	{
		case 'post':
			$sql = 'SELECT t.topic_title, pt.post_subject
				FROM ' . POSTS_TABLE . ' p, ' . POSTS_TEXT_TABLE . ' pt, ' . TOPICS_TABLE . " t
				WHERE p.topic_id = t.topic_id AND pt.post_id = p.post_id AND p.post_id = $id";
			break;
		case 'topic':
			$sql = 'SELECT topic_title FROM ' . TOPICS_TABLE . "
				WHERE topic_id = $id";
			break;
	}
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not get topic title', '', __LINE__, __FILE__, $sql);
	}
	if (!$db->sql_numrows($result))
	{
		return false;
	}
	else
	{
		$row = $db->sql_fetchrow($result);
		$topic_title = (isset($row['post_subject']) && !empty($row['post_subject'])) ? $row['post_subject'] : $row['topic_title'];
	}
	$db->sql_freeresult($result);

	return $topic_title;
}

function get_username($user_id)
{
	global $db;

	$user_id = intval($user_id);
	$sql = 'SELECT username FROM ' . USERS_TABLE . "
		WHERE user_id = $user_id";
	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not get username', '', __LINE__, __FILE__, $sql);
	}
	if (!$db->sql_numrows($result))
	{
		return false;
	}
	else
	{
		$username = $db->sql_fetchfield('username', 0, $result);
	}
	$db->sql_freeresult($result);

	return $username;
}

function obtain_report_cats($mode, $id = -1)
{
	global $db, $phpEx, $phpbb_root_path, $lang;
	
	include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

	$id = intval($id);
	switch ($mode)
	{
		case 'cat':
			$sql = 'SELECT c.*, COUNT(r.report_id) AS report_count FROM ' . REPORT_CAT_TABLE . ' c
				LEFT JOIN ' . REPORT_TABLE . " r ON r.cat_id = c.cat_id
				WHERE c.cat_id = $id
				GROUP BY c.cat_id";
			break;
		case 'normal':
			$sql_add = ($id > -1) ? " AND c.cat_id <> $id" : '';
			$sql = 'SELECT c.*, COUNT(r.report_id) AS report_count FROM ' . REPORT_CAT_TABLE . ' c
				LEFT JOIN ' . REPORT_TABLE . " r ON r.cat_id = c.cat_id
				WHERE c.cat_type = " . REPORT_NORMAL . $sql_add . '
				GROUP BY c.cat_id';
			break;
		case 'ext':
			$sql_add = ($id > -1) ? " AND c.cat_id <> $id" : '';
			$sql = 'SELECT c.*, COUNT(r.report_id) AS report_count FROM ' . REPORT_CAT_TABLE . ' c
				LEFT JOIN ' . REPORT_TABLE . " r ON r.cat_id = c.cat_id
				WHERE c.cat_type = " . REPORT_EXT . $sql_add . '
				GROUP BY c.cat_id';
			break;
		default:
			$sql_add = ($id > -1) ? " WHERE c.cat_id <> $id" : '';
			$sql = 'SELECT c.*, COUNT(r.report_id) AS report_count FROM ' . REPORT_CAT_TABLE . ' c
				LEFT JOIN ' . REPORT_TABLE . " r ON r.cat_id = c.cat_id$sql_add
				GROUP BY c.cat_id";
			break;
	}

	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not get categories', '', __LINE__, __FILE__, $sql);
	}
	if (!$db->sql_numrows($result))
	{
		return false;
	}
	
	$rows = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$row['cat_name'] = (isset($lang[$row['cat_name']])) ? $lang[$row['cat_name']] : htmlspecialchars($row['cat_name']);
		$row['cat_explain'] = (isset($lang[$row['cat_explain']])) ? $lang[$row['cat_explain']] : (($row['cat_explain'] != '') ? nl2br(make_clickable(htmlspecialchars($row['cat_explain']))) : '-');

		$rows[$row['cat_id']] = $row;
	}
	$db->sql_freeresult($result);

	return ($mode == 'cat') ? $rows[$id] : $rows;
}

/*
	array
	(
		[cats] = array
		(
			[cat_id],
			[cat_name],
			[cat_explain],
			[report_count] = array
			(
				[-1],
				[0],
				[1],
				[2]
			),
			[reports] = array
			(
				[report_id],
				[report_status],
				[report_date],
				[report_user_id],
				[report_username],
				[report_info],
				[report_text]
			)
		),
		[all] = array
		(
			[report_count] = array
			(
				[-1],
				[0],
				[1],
				[2]
			)
		)
	)
*/
function obtain_reports($mode, $auth_check = true, $id = -1)
{
	global $userdata, $db, $lang, $phpEx, $phpbb_root_path;
	
	include_once($phpbb_root_path . 'includes/bbcode.'.$phpEx);

	switch ($mode)
	{
		// get data for a single report
		case 'report':
			$id = intval($id);

			$sql_add = ($userdata['user_level'] == MOD) ? 'AND c.cat_auth = 0' : '';
			$sql = 'SELECT c.*, r.*, u.username
				FROM ' . REPORT_TABLE . ' r, ' . REPORT_CAT_TABLE . ' c
				LEFT JOIN ' . USERS_TABLE . " u ON u.user_id = r.report_user_id
				WHERE r.cat_id = c.cat_id AND r.report_id = $id $sql_add";
			break;
		// get data for a category
		case 'cat':
			$id = intval($id);		

			$sql_add = ($userdata['user_level'] == MOD) ? 'AND c.cat_auth = 0' : '';
			$sql = 'SELECT c.*, r.*, u.username, c.cat_id AS cat_id
				FROM ' . REPORT_CAT_TABLE . ' c
				LEFT JOIN ' . REPORT_TABLE . ' r ON c.cat_id = r.cat_id
				LEFT JOIN ' . USERS_TABLE . " u ON u.user_id = r.report_user_id
				WHERE c.cat_id = $id $sql_add
				ORDER BY r.report_status ASC, r.report_date DESC";
			break;
		// get all reports
		default:
			$sql_add = ($userdata['user_level'] == MOD) ? 'WHERE c.cat_auth = 0' : '';
			$sql = 'SELECT c.*, r.*, u.username, c.cat_id AS cat_id
				FROM ' . REPORT_CAT_TABLE . ' c
				LEFT JOIN ' . REPORT_TABLE . ' r ON c.cat_id = r.cat_id
				LEFT JOIN ' . USERS_TABLE . " u ON u.user_id = r.report_user_id $sql_add
				ORDER BY c.cat_id ASC, r.report_status ASC, r.report_date DESC";
			break;
	}

	if (!($result = $db->sql_query($sql)))
	{
		message_die(GENERAL_ERROR, 'Could not get reports', '', __LINE__, __FILE__, $sql);
	}
	$rows = $db->sql_fetchrowset($result);
	$db->sql_freeresult($result);

	if (!count($rows))
	{
		return false;
	}

	$report_data = array();
	$report_count = array();

	$report_count[-1] = array(
		-1 => 0,
		REPORT_NOT_CLEARED => 0,
		REPORT_IN_PROCESS => 0,
		REPORT_CLEARED => 0
	);
	foreach ($rows as $row)
	{
		$cat_id = $row['cat_id'];

		if (!isset($report_count[$cat_id]))
		{
			$report_count[$cat_id] = array(
				-1 => 0,
				REPORT_NOT_CLEARED => 0,
				REPORT_IN_PROCESS => 0,
				REPORT_CLEARED => 0
			);
		}

		if (isset($row['report_id']))
		{
			// show report in list?
			if ($auth_check)
			{
				switch ($cat_id)
				{
					case REPORT_POST_ID:
						$report_auth = report_auth('post', $row['report_info']);
						break;
					case REPORT_TOPIC_ID:
						$report_auth = report_auth('topic', $row['report_info']);
						break;
					default:
						$report_auth = true;
						break;
				}
			}
			else
			{
				$report_auth = true;
			}

			if ($report_auth)
			{
				$report = array(
					'report_id' => $row['report_id'],
					'report_status' => $row['report_status'],
					'report_date' => $row['report_date'],
					'report_user_id' => $row['report_user_id'],
					'report_username' => $row['username'],
					'report_info' => (!empty($row['report_info'])) ? make_clickable(htmlspecialchars($row['report_info'])) : '-',
					'report_text' => (!empty($row['report_text'])) ? nl2br(make_clickable(htmlspecialchars($row['report_text']))) : '-'
				);

				$report_count[$cat_id][$row['report_status']]++;
				$report_count[$cat_id][-1]++;
				$report_count[-1][$row['report_status']]++;

				switch ($cat_id)
				{
					case REPORT_POST_ID:
						if (is_numeric($report['report_info']))
						{
							$report['topic_title'] = get_topic_title('post', $report['report_info']);
						}
						break;
					case REPORT_TOPIC_ID:
						if (is_numeric($report['report_info']))
						{
							$report['topic_title'] = get_topic_title('topic', $report['report_info']);
						}
						break;
					case REPORT_USER_ID:
						if (is_numeric($report['report_info']))
						{
							$report['username'] = get_username($report['report_info']);
						}
						break;
				}
			}
		}
		else if ($mode == 'report')
		{
			return false;
		}
		
		$report_data['cats'][$cat_id]['cat_id'] = $cat_id;
		$report_data['cats'][$cat_id]['cat_name'] = (isset($lang[$row['cat_name']])) ? $lang[$row['cat_name']] : htmlspecialchars($row['cat_name']);
		$report_data['cats'][$cat_id]['cat_explain'] = (isset($lang[$row['cat_explain']])) ? $lang[$row['cat_explain']] : (($row['cat_explain'] != '') ? nl2br(make_clickable(htmlspecialchars($row['cat_explain']))) : '-');
		$report_data['cats'][$cat_id]['report_count'] = $report_count;
		if (isset($report))
		{
			$report_data['cats'][$cat_id]['reports'][] = $report;
		}
		unset($report);
	}

	$cat_ids = array_keys($report_data['cats']);
	foreach ($cat_ids as $cat_id)
	{
		$report_data['cats'][$cat_id]['report_count'] = $report_count[$cat_id];
	}
	unset($cat_ids);

	$report_count[-1][-1] = $report_count[-1][REPORT_NOT_CLEARED] + $report_count[-1][REPORT_IN_PROCESS] + $report_count[-1][REPORT_CLEARED];
	$report_data['all']['report_count'] = $report_count[-1];

	return $report_data;
}

?>