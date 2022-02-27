<?php
/***************************************************************************
* viewtopic.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
define('CT_SECLEVEL', 'MEDIUM');
$ct_ignoregvar = array('');

include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_color_groups.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_report.'.$phpEx);

// Start initial var setup

$topic_id = $post_id = 0;
if ( isset($HTTP_GET_VARS[POST_TOPIC_URL]) )
{
	$topic_id = intval($HTTP_GET_VARS[POST_TOPIC_URL]);
}
else if ( isset($HTTP_GET_VARS['topic']) )
{
	$topic_id = intval($HTTP_GET_VARS['topic']);
}

if ( isset($HTTP_GET_VARS[POST_POST_URL]))
{
	$post_id = intval($HTTP_GET_VARS[POST_POST_URL]);
}

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;
$viewall = ( isset($HTTP_GET_VARS['viewall']) ) ? intval($HTTP_GET_VARS['viewall']) : 0;

if (!$topic_id && !$post_id)
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

// Find topic id if user requested a newer
// or older topic
if ( isset($HTTP_GET_VARS['view']) && empty($HTTP_GET_VARS[POST_POST_URL]) )
{
	if ( $HTTP_GET_VARS['view'] == 'newest' )
	{
		if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) || isset($HTTP_GET_VARS['sid']) )
		{
			$session_id = isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) ? $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid'] : $HTTP_GET_VARS['sid'];

			if (!preg_match('/^[A-Za-z0-9]*$/', $session_id))
			{
				$session_id = '';
			}

			if ( $session_id )
			{
				$sql = "SELECT p.post_id
					FROM " . POSTS_TABLE . " p, " . SESSIONS_TABLE . " s, " . USERS_TABLE . " u
					WHERE s.session_id = '$session_id'
						AND u.user_id = s.session_user_id
						AND p.topic_id = $topic_id
						AND p.post_time >= u.user_lastvisit
					ORDER BY p.post_time ASC
					LIMIT 1";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain newer/older topic information', '', __LINE__, __FILE__, $sql);
				}

				if ( !($row = $db->sql_fetchrow($result)) )
				{
					message_die(GENERAL_MESSAGE, 'No_new_posts_last_visit');
				}

				$post_id = $row['post_id'];

				if (isset($HTTP_GET_VARS['sid']))
				{
					redirect("viewtopic.$phpEx?sid=$session_id&" . POST_POST_URL . "=$post_id#$post_id");
				}
				else
				{
					redirect("viewtopic.$phpEx?" . POST_POST_URL . "=$post_id#$post_id");
				}
			}
		}

		redirect(append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id", true));
	}
	else if ( $HTTP_GET_VARS['view'] == 'next' || $HTTP_GET_VARS['view'] == 'previous' )
	{
		$sql_condition = ( $HTTP_GET_VARS['view'] == 'next' ) ? '>' : '<';
		$sql_ordering = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'ASC' : 'DESC';

		$sql = "SELECT t.topic_id
			FROM " . TOPICS_TABLE . " t, " . TOPICS_TABLE . " t2
			WHERE t2.topic_id = $topic_id
				AND t.forum_id = t2.forum_id
				AND t.topic_moved_id = 0
				AND t.topic_last_post_id $sql_condition t2.topic_last_post_id
			ORDER BY t.topic_last_post_id $sql_ordering
			LIMIT 1";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain newer/older topic information", '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$topic_id = intval($row['topic_id']);
		}
		else
		{
			$message = ( $HTTP_GET_VARS['view'] == 'next' ) ? 'No_newer_topics' : 'No_older_topics';
			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
$join_sql_table = (!$post_id) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 ";
$join_sql = (!$post_id) ? "t.topic_id = $topic_id" : "p.post_id = $post_id AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= $post_id";
$count_sql = (!$post_id) ? '' : ", COUNT(p2.post_id) AS prev_posts";
$order_sql = (!$post_id) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments ORDER BY p.post_id ASC";

$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_views, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_password, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments" . $count_sql . "
	FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $join_sql_table . "
	WHERE $join_sql
		AND f.forum_id = t.forum_id
	$order_sql";
	attach_setup_viewtopic_auth($order_sql, $sql);

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
}

if ( !($forum_topic_data = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = intval($forum_topic_data['forum_id']);
$db->sql_freeresult($result);

// Start session management
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
// End session management

// Start auth check
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_topic_data);

if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
{
	$message = ( !$is_auth['auth_view'] ) ? $lang['Topic_post_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
	message_die(GENERAL_MESSAGE, $message);
}
// End auth check

$forum_name = $forum_topic_data['forum_name'];
$topic_title = $forum_topic_data['topic_title'];
$topic_id = intval($forum_topic_data['topic_id']);
$topic_time = $forum_topic_data['topic_time'];

// Password check
if( !$is_auth['auth_mod'] && $userdata['user_level'] != ADMIN )
{
	$redirect = str_replace("&amp;", "&", preg_replace('#.*?([a-z]+?\.' . $phpEx . '.*?)$#i', '\1', htmlspecialchars($HTTP_SERVER_VARS['REQUEST_URI'])));

	if( $HTTP_POST_VARS['cancel'] )
	{
		redirect(append_sid("index.$phpEx"));
	}
	else if( $HTTP_POST_VARS['pass_login'] )
	{
		if( $forum_topic_data['forum_password'] != '' )
		{
			password_check('forum', $forum_id, $HTTP_POST_VARS['password'], $redirect);
		}
	}

	if( $forum_topic_data['forum_password'] != '' )
	{
		$passdata = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass'])) : '';
		if( $passdata[$forum_id] != md5($forum_topic_data['forum_password']) )
		{
			password_box('forum', $redirect);
		}
	}
}
// END: Password check

if ($post_id)
{
	$start = floor(($forum_topic_data['prev_posts'] - 1) / intval($board_config['posts_per_page'])) * intval($board_config['posts_per_page']);
}

// Is user watching this thread?
if( $userdata['session_logged_in'] )
{
	$can_watch_topic = TRUE;

	$sql = "SELECT notify_status
		FROM " . TOPICS_WATCH_TABLE . "
		WHERE topic_id = $topic_id
			AND user_id = " . $userdata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain topic watch information", '', __LINE__, __FILE__, $sql);
	}

	if ( $row = $db->sql_fetchrow($result) )
	{
		if ( isset($HTTP_GET_VARS['unwatch']) )
		{
			if ( $HTTP_GET_VARS['unwatch'] == 'topic' )
			{
				$is_watching_topic = 0;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "DELETE $sql_priority FROM " . TOPICS_WATCH_TABLE . "
					WHERE topic_id = $topic_id
						AND user_id = " . $userdata['user_id'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not delete topic watch information", '', __LINE__, __FILE__, $sql);
				}
				$db->sql_freeresult($result);
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="1;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
			);

			$message = $lang['No_longer_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = TRUE;

			if ( $row['notify_status'] )
			{
				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "UPDATE $sql_priority " . TOPICS_WATCH_TABLE . "
					SET notify_status = 0
					WHERE topic_id = $topic_id
						AND user_id = " . $userdata['user_id'];
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not update topic watch information", '', __LINE__, __FILE__, $sql);
				}
				$db->sql_freeresult($result);
			}
		}
	}
	else
	{
		if ( isset($HTTP_GET_VARS['watch']) )
		{
			if ( $HTTP_GET_VARS['watch'] == 'topic' )
			{
				$is_watching_topic = TRUE;

				$sql_priority = (SQL_LAYER == "mysql") ? "LOW_PRIORITY" : '';
				$sql = "INSERT $sql_priority INTO " . TOPICS_WATCH_TABLE . " (user_id, topic_id, notify_status)
					VALUES (" . $userdata['user_id'] . ", $topic_id, 0)";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, "Could not insert topic watch information", '', __LINE__, __FILE__, $sql);
				}
				$db->sql_freeresult($result);
			}

			$template->assign_vars(array(
				'META' => '<meta http-equiv="refresh" content="1;url=' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">')
			);

			$message = $lang['You_are_watching'] . '<br /><br />' . sprintf($lang['Click_return_topic'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;start=$start") . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
		else
		{
			$is_watching_topic = 0;
		}
	}
}
else
{
	if ( isset($HTTP_GET_VARS['unwatch']) )
	{
		if ( $HTTP_GET_VARS['unwatch'] == 'topic' )
		{
			redirect(append_sid("login.$phpEx?redirect=viewtopic.$phpEx&" . POST_TOPIC_URL . "=$topic_id&unwatch=topic", true));
		}
	}
	else
	{
		$can_watch_topic = 0;
		$is_watching_topic = 0;
	}
}

// Generate a 'Show posts in previous x days' select box. If the postdays var is POSTed
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Posts'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

if( !empty($HTTP_POST_VARS['postdays']) || !empty($HTTP_GET_VARS['postdays']) )
{
	$post_days = ( !empty($HTTP_POST_VARS['postdays']) ) ? intval($HTTP_POST_VARS['postdays']) : intval($HTTP_GET_VARS['postdays']);
	$min_post_time = time() - (intval($post_days) * 86400);

	$sql = "SELECT COUNT(p.post_id) AS num_posts
		FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
		WHERE t.topic_id = $topic_id
			AND p.topic_id = t.topic_id
			AND p.post_time >= $min_post_time";
	if ( !($result = $db->sql_query($sql)) )
	{
	message_die(GENERAL_ERROR, "Could not obtain limited topics count information", '', __LINE__, __FILE__, $sql);
	}
	$db->sql_freeresult($result);

	$total_replies = ( $row = $db->sql_fetchrow($result) ) ? intval($row['num_posts']) : 0;

	$limit_posts_time = "AND p.post_time >= $min_post_time ";

	if ( !empty($HTTP_POST_VARS['postdays']))
	{
	$start = 0;
	}
}
else
{
	$total_replies = intval($forum_topic_data['topic_replies']) + 1;

	$limit_posts_time = '';
	$post_days = 0;
}

$select_post_days = '<select name="postdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($post_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_post_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_post_days .= '</select>';

// Decide how to order the post display
if ( !empty($HTTP_POST_VARS['postorder']) || !empty($HTTP_GET_VARS['postorder']) )
{
	$post_order = (!empty($HTTP_POST_VARS['postorder'])) ? htmlspecialchars($HTTP_POST_VARS['postorder']) : htmlspecialchars($HTTP_GET_VARS['postorder']);
	$post_time_order = ($post_order == "asc") ? "ASC" : "DESC";
}
else
{
	$post_order = 'asc';
	$post_time_order = 'ASC';
}

$select_post_order = '<select name="postorder">';
if ( $post_time_order == 'ASC' )
{
	$select_post_order .= '<option value="asc" selected="selected">' . $lang['Oldest_First'] . '</option><option value="desc">' . $lang['Newest_First'] . '</option>';
}
else
{
	$select_post_order .= '<option value="asc">' . $lang['Oldest_First'] . '</option><option value="desc" selected="selected">' . $lang['Newest_First'] . '</option>';
}
$select_post_order .= '</select>';

$board_config['posts_per_page'] = ( $viewall == 1 ) ? $total_replies : $board_config['posts_per_page'];

// Go ahead and pull all data for this topic
$sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsig, u.user_allowsmile, u.ct_miserable_user, u.user_allow_viewonline, u.user_session_time, u.user_avatar_width, u.user_avatar_height, p.*, pt.post_text, pt.post_subject, pt.bbcode_uid
	FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
	WHERE p.topic_id = $topic_id
	$limit_posts_time
		AND pt.post_id = p.post_id
		AND u.user_id = p.poster_id
	ORDER BY p.post_time $post_time_order
	LIMIT $start, ".$board_config['posts_per_page'];
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain post/user information.", '', __LINE__, __FILE__, $sql);
}

$postrow = array();
if ($row = $db->sql_fetchrow($result))
{
	do
	{
		$postrow[] = $row;
	}
	while ($row = $db->sql_fetchrow($result));
	$db->sql_freeresult($result);

	$total_posts = count($postrow);
	$mark_time = intval($postrow[$total_posts-1]['post_time']);
}
else
{
	include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	sync('topic', $topic_id);

	message_die(GENERAL_MESSAGE, $lang['No_posts_topic']);
}

$resync = FALSE;
if ($forum_topic_data['topic_replies'] + 1 < $start + count($postrow))
{
	$resync = TRUE;
}
elseif ($start + $board_config['posts_per_page'] > $forum_topic_data['topic_replies'])
{
	$row_id = intval($forum_topic_data['topic_replies']) % intval($board_config['posts_per_page']);
	if ($postrow[$row_id]['post_id'] != $forum_topic_data['topic_last_post_id'] || $start + count($postrow) < $forum_topic_data['topic_replies'])
	{
		$resync = TRUE;
	}
}
elseif (count($postrow) < $board_config['posts_per_page'])
{
	$resync = TRUE;
}

if ($resync)
{
	include($phpbb_root_path . 'includes/functions_admin.' . $phpEx);
	sync('topic', $topic_id);

	$result = $db->sql_query('SELECT COUNT(post_id) AS total FROM ' . POSTS_TABLE . ' WHERE topic_id = ' . $topic_id);
	$row = $db->sql_fetchrow($result);
	$total_replies = $row['total'];
}

$sql = "SELECT * FROM " . RANKS_TABLE . " ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain ranks information.", '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

// Define censored word matches
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

// Censor topic title
if ( count($orig_word) )
{
	$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}

// Was a highlight request part of the URI?
$highlight_match = $highlight = '';
if (isset($HTTP_GET_VARS['highlight']))
{
	// Split words and phrases
	$words = explode(' ', trim(htmlspecialchars($HTTP_GET_VARS['highlight'])));

	for($i = 0; $i < sizeof($words); $i++)
	{
		if (trim($words[$i]) != '')
		{
			$highlight_match .= (($highlight_match != '') ? '|' : '') . str_replace('*', '\w*', preg_quote($words[$i], '#'));
		}
	}
	unset($words);

	$highlight = urlencode($HTTP_GET_VARS['highlight']);
	$highlight_match = phpbb_rtrim($highlight_match, "\\");
}

// Post, reply and other URL generation for
// templating vars
$new_topic_url = append_sid("posting.$phpEx?mode=newtopic&amp;" . POST_FORUM_URL . "=$forum_id");
$reply_topic_url = append_sid("posting.$phpEx?mode=reply&amp;" . POST_TOPIC_URL . "=$topic_id");
$view_forum_url = ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id" .'-'. format_url($forum_name)) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id");
$view_prev_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=previous");
$view_next_topic_url = append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;view=next");

// Mozilla navigation bar
$nav_links['prev'] = array(
	'url' => $view_prev_topic_url,
	'title' => $lang['View_previous_topic']
);

$nav_links['next'] = array(
	'url' => $view_next_topic_url,
	'title' => $lang['View_next_topic']
);

$nav_links['up'] = array(
	'url' => $view_forum_url,
	'title' => $forum_name
);

// özel ban by emrag
$sql = "SELECT user_can_post FROM " . USERS_TABLE . " WHERE user_id = ".$userdata['user_id'];
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_MESSAGE, 'Could not obtain user_can_post data');
}
$row = $db->sql_fetchrow($result);

if (!$row['user_can_post'])
{
	$post_info['forum_status'] = FORUM_LOCKED;
}
// özel ban by emrag

if(!$row['user_can_post'])
{
	$reply_img = $images['ban'];
	$reply_alt = $lang['Ban'];
	$post_img = $images['ban'];
	$post_alt = $lang['Ban'];
}
else
{
	$reply_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $images['reply_locked'] : $images['reply_new'];
	$reply_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED || $forum_topic_data['topic_status'] == TOPIC_LOCKED ) ? $lang['Topic_locked1'] : $lang['Reply_to_topic'];
	$post_img = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
	$post_alt = ( $forum_topic_data['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'];
}

// Set a cookie for this topic
if ( $userdata['session_logged_in'] )
{
	$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();
	$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();

	if ( !empty($tracking_topics[$topic_id]) && !empty($tracking_forums[$forum_id]) )
	{
		$topic_last_read = ( $tracking_topics[$topic_id] > $tracking_forums[$forum_id] ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
	}
	else if ( !empty($tracking_topics[$topic_id]) || !empty($tracking_forums[$forum_id]) )
	{
		$topic_last_read = ( !empty($tracking_topics[$topic_id]) ) ? $tracking_topics[$topic_id] : $tracking_forums[$forum_id];
	}
	else
	{
		$topic_last_read = $userdata['user_lastvisit'];
	}

	if ( count($tracking_topics) >= 150 && empty($tracking_topics[$topic_id]) )
	{
		asort($tracking_topics);
		unset($tracking_topics[key($tracking_topics)]);
	}

	$tracking_topics[$topic_id] = time();
	@setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
}

// Load templates
$template->set_filenames(array('body' => ($board_config['topic_page_on_top']) ? 'viewtopic_body.tpl' : 'viewtopic_body_.tpl' ));
// Begin Simple Subforums MOD
$all_forums = array();
make_jumpbox_ref('viewforum.'.$phpEx, $forum_id, $all_forums);

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
	for( $i = 0; $i < count($all_forums); $i++ )
	{
		if( $all_forums[$i]['forum_id'] == $parent_id )
		{
			$template->assign_vars(array(
				'PARENT_FORUM' => 1,
				'PARENT_FORUM_NAME' => $all_forums[$i]['forum_name'],
				'U_VIEW_PARENT_FORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id'] .'-'. format_url($all_forums[$i]['forum_name'])) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
				)
			);
		}
	}
}
// End Simple Subforums MOD

// Output page header
$page_title = $topic_title;

//--------[+]---- meta tags--------------
if(isset($HTTP_GET_VARS[POST_TOPIC_URL]) && !$mode)
{
	$sql = "SELECT w.word_text
		FROM " . TOPICS_TABLE . " t, " . SEARCH_MATCH_TABLE . " m, " . SEARCH_WORD_TABLE . " w
		WHERE t.topic_first_post_id = m.post_id
			AND m.word_id = w.word_id
			AND t.topic_id = " . intval($HTTP_GET_VARS[POST_TOPIC_URL]). "
		ORDER BY rand()
		LIMIT 20";
	if( ($result = $db->sql_query($sql)) )
	{
		$keywords = '';
		while ( $meta_row = $db->sql_fetchrow($result) )
		{
			//sonradi virgülü ayýrmak için böyle garip bir sorgu yapýyoruz...
			// eðer kelime boþ deðilse kelimeyi al, deðilse ,virgül koy kelimeyi al		
			$keywords .= ($keywords == '') ? $meta_row['word_text'] : ', ' . $meta_row['word_text'];
		}

		//eðer topicde kelimeler yoksa! ki bu çeþitli þekillerde olabilir, 
		// o zaman ilgili mesajý etiketler haline getir
		if (trim($keywords) == '')
		{
			$keywords = str_replace(" ", ", ", $topic_title);
		}
	}
}

if(isset($HTTP_GET_VARS[POST_POST_URL]) && !$mode)
{
	$sql = "SELECT w.word_text
		FROM " . SEARCH_MATCH_TABLE . " m, " . SEARCH_WORD_TABLE . " w
		WHERE m.word_id = w.word_id
			AND m.post_id = " . intval($HTTP_GET_VARS[POST_POST_URL]) . "
		ORDER BY rand()
		LIMIT 20";
	if( ($result = $db->sql_query($sql)) )
	{
		$keywords = '';
		while ( $meta_row = $db->sql_fetchrow($result) )
		{
			//sonradi virgülü ayýrmak için böyle garip bir sorgu yapýyoruz...
			// eðer kelime boþ deðilse kelimeyi al, deðilse ,virgül koy kelimeyi al		
			$keywords .= ($keywords == '') ? $meta_row['word_text'] : ', ' . $meta_row['word_text'];
		}
	}
}
//--------[-]---- meta tags---------------------

//---yakusha
if ($HTTP_GET_VARS[POST_TOPIC_URL])
{
	$rss_url = "rss." . $phpEx . "?" . POST_TOPIC_URL . "=" . $HTTP_GET_VARS[POST_TOPIC_URL];
	$l_rss = $board_config['sitename']." ".$lang['rss_topic'];
}

if ($HTTP_GET_VARS[POST_POST_URL])
{
	$rss_url = "rss." . $phpEx . "?" . POST_POST_URL . "=" . $HTTP_GET_VARS[POST_POST_URL];
	$l_rss = $board_config['sitename']." ".$lang['rss_topic'];
}

$redirect_page = '<input type="hidden" name="redirect" value="' . append_sid("viewtopic.php?t=" . $topic_id . "&amp;postdays=" . $post_days . "&amp;&postorder=" . $post_order . "&amp;viewall=". $viewall."&amp;start=". $start ).'">';
//---yakusha
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//
// User authorisation levels output
//
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
attach_build_auth_levels($is_auth, $s_auth_can);
$topic_mod = '';

if ( $is_auth['auth_mod'] )
{
	$s_auth_can .= sprintf($lang['Rules_moderate'], "<a href=\"modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;sid=" . $userdata['session_id'] . '">', '</a>');
	$topic_mod .= ( $is_auth['auth_delete'] ) ? "<a title=\" $lang[Delete_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=delete&amp;sid=" . $userdata['session_id'] . '">'.$lang['Delete_topic_sort'].'</a>&nbsp;' : "";
	$topic_mod .= "<a title=\" $lang[Move_bin] \" href=\"bin.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;sid=" . $userdata['session_id'] . '">'.$lang['Move_bin_sort'].'</a>&nbsp;';
	$topic_mod .= "<a title=\" $lang[Move_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=move&amp;sid=" . $userdata['session_id'] . '">'.$lang['Move_topic_sort'].'</a>&nbsp;';
	$topic_mod .= ( $forum_topic_data['topic_status'] == TOPIC_UNLOCKED ) ? "<a title=\" $lang[Lock_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=lock&amp;sid=" . $userdata['session_id'] . '">'.$lang['Lock_topic_sort'].'</a>&nbsp;' : "<a title=\" $lang[Unlock_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=unlock&amp;sid=" . $userdata['session_id'] . '">'.$lang['Unlock_topic_sort'].'</a>&nbsp;';
	$topic_mod .= "<a title=\" $lang[Split_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=split&amp;sid=" . $userdata['session_id'] . '">'.$lang['Split_topic_sort'].'</a>&nbsp;';
	$topic_mod .= "<a title=\" $lang[Merge_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=merge&amp;sid=" . $userdata['session_id'] . '">'.$lang['Merge_topic_sort'].'</a>&nbsp;';
	$normal_button = "<a title=\" $lang[Normal_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=normalise&amp;sid=" . $userdata['session_id'] . '">'.$lang['Normal_topic_sort'].'</a>&nbsp;';
	$sticky_button = ( $is_auth['auth_sticky'] ) ? "<a title=\" $lang[Sticky_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=sticky&amp;sid=" . $userdata['session_id'] . '">'.$lang['Sticky_topic_sort'].'</a>&nbsp;' : "";
	$announce_button = ( $is_auth['auth_announce'] ) ? "<a title=\" $lang[Announce_topic] \" href=\"modcp.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;mode=announce&amp;sid=" . $userdata['session_id'] . '">'. $lang['Announce_topic_sort'].'</a>&nbsp;' : "";
	switch( $forum_topic_data['topic_type'] )
	{
		case POST_NORMAL:
			$topic_mod .= $sticky_button . $announce_button;
		break;
		case POST_STICKY:
			$topic_mod .= $announce_button . $normal_button;
		break;
		case POST_ANNOUNCE:
			$topic_mod .= $sticky_button . $normal_button;
		break;
	}
}

//
// Topic watch information
//
$s_watching_topic = '';
if ( $can_watch_topic )
{
	if ( $is_watching_topic )
	{
		$s_watching_topic = "<a href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;unwatch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '">' . $lang['Stop_watching_topic'] . '</a>';
	}
	else
	{
		$s_watching_topic = "<a href=\"viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;watch=topic&amp;start=$start&amp;sid=" . $userdata['session_id'] . '">' . $lang['Start_watching_topic'] . '</a>';
	}
}

// If we've got a hightlight set pass it on to pagination,
// I get annoyed when I lose my highlight after the first page.
$highlight = ($highlight) ? '&amp;highlight='.$highlight : '';

$temp_link = '';
if ($viewall == 1)
{
	$temp_link = append_sid("viewtopic.$phpEx?t=$topic_id".$highlight);
	$pagination = "<a href=\"$temp_link\">$lang[Show_pages]</a>";
}
elseif ($total_replies > $board_config['posts_per_page'])
{
	$temp_link = append_sid("viewtopic.$phpEx?t=$topic_id"."$highlight&amp;viewall=1");
	$pagination = generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order" . "$highlight", $total_replies, $board_config['posts_per_page'], $start). " | " . "<a href=\"$temp_link\">$lang[View_all]</a>";
}
else
{
	$pagination = generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order" . "$highlight", $total_replies, $board_config['posts_per_page'], $start);
}

// BEGIN Advanced_Report_Hack
$s_report_topic = '';
if ($userdata['session_logged_in'])
{
	for ($i = 0; $i < $total_posts; $i++)
	{
		$post_ids[] = $postrow[$i]['post_id'];
	}
	$reported_info = get_report_status('topic_posts', $topic_id, $post_ids);
	unset($post_ids);

	if (($userdata['user_level'] == ADMIN || $is_auth['auth_mod']) && $reported_info[-1] == REPORT_NOT_CLEARED && $board_config['report_list'] == 0)
	{
		$report_url = append_sid("report.$phpEx?mode=cleartopic&amp;id=$topic_id");
		$report_title = $lang['Mark_cleared'];
	}
	else if ($reported_info[-1] == REPORT_NOT_CLEARED)
	{
		$report_url = '';
		$report_title = $lang['Topic_already_reported'];
	}
	else
	{
		$report_url = append_sid("report.$phpEx?mode=reporttopic&amp;id=$topic_id");
		$report_title = $lang['Report_topic'];
	}

	$s_report_topic = (!empty($report_url)) ? '<a href="' . $report_url . '" class="genmed">' . $report_title . '</a>' : $report_title;
}
// END Advanced_Report_Hack


// Send vars to template
$template->assign_vars(array(
	'FORUM_ID' => $forum_id,
	'FORUM_NAME' => $forum_name,
	'TOPIC_ID' => $topic_id,
	'TOPIC_TITLE' => $topic_title,
	'TOPIC_REPLIES' => $forum_topic_data['topic_replies'],
	'TOPIC_VIEWS' => $forum_topic_data['topic_views'] + 1,
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / intval($board_config['posts_per_page']) ) + 1 ), ceil( $total_replies / intval($board_config['posts_per_page']) )),

	'POST_IMG' => $post_img,
	'REPLY_IMG' => $reply_img,

	// My Quick Reply mod
	'QUICK_REPLY_IMG' => $images['quick_reply'],
	'L_QUICK_REPLY' => $lang['Quick_Reply'],
	// My Quick Reply mod

	'U_FAV' => append_sid("favorites.$phpEx?t=" . $topic_id . "&mode=add"),
	'L_FAV' => $lang['add_fav'],

	'L_MESAJ_TITLE' => $lang['View_single_post'],
	'L_MESAJ' => $lang['Post'],
	'L_REPLIES' => $lang['Replies'],
	'L_VIEWS' => $lang['Views'],
	'L_AUTHOR' => $lang['Author'],
	'L_VIEW_SINGLE' => $lang['View_single_post'],
	'L_TOPIC' => $lang['Topic'],
	'L_MESSAGE' => $lang['Message'],
	'L_POSTED' => $lang['Posted'],
	'L_POST_SUBJECT' => $lang['Post_subject'],
	'L_VIEW_NEXT_TOPIC' => $lang['View_next_topic'],
	'L_VIEW_PREVIOUS_TOPIC' => $lang['View_previous_topic'],
	'L_POST_NEW_TOPIC' => $post_alt,
	'L_POST_REPLY_TOPIC' => $reply_alt,
	'L_BACK_TO_TOP' => '<a href="#top"><img src="' . $images['icon_top'] . '" alt="' . $lang['Back_to_top'] . '" title="' . $lang['Back_to_top'] . '" border="0" /></a>',
	'L_DISPLAY_POSTS' => $lang['Display_posts'],
	'L_LOCK_TOPIC' => $lang['Lock_topic'],
	'L_UNLOCK_TOPIC' => $lang['Unlock_topic'],
	'L_MOVE_TOPIC' => $lang['Move_topic'],
	'L_SPLIT_TOPIC' => $lang['Split_topic'],
	'L_DELETE_TOPIC' => $lang['Delete_topic'],
	'L_GOTO_PAGE' => $lang['Goto_page'],
	// Topic Search MOD
	'L_ADD_IMAGE' => $lang['Add_image_to_post'],
	'L_SEARCH_TOPIC' => $lang['Search_topic'],
	// End Topic Search MOD

	'S_TOPIC_LINK' => POST_TOPIC_URL,
	'S_SELECT_POST_DAYS' => $select_post_days,
	'S_SELECT_POST_ORDER' => $select_post_order,
	'S_POST_DAYS_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $topic_id . "&amp;start=$start"),
	'S_AUTH_LIST' => $s_auth_can,
	'S_TOPIC_ADMIN' => $topic_mod,
	'S_WATCH_TOPIC' => $s_watching_topic,
	'S_REPORT_TOPIC' => $s_report_topic,

	'U_ARCHIVE' => ($board_config['basit_seo_open']) ? append_sid("viewtopic_p.$phpEx?" . POST_TOPIC_URL . "=$topic_id" .'-'. format_url($topic_title)) : append_sid("viewtopic_p.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
	'U_VIEW_TOPIC' => ($board_config['basit_seo_open']) ? append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id" .'-'. format_url($topic_title)) : append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
	'U_VIEW_FORUM' => $view_forum_url,
	'U_VIEW_OLDER_TOPIC' => $view_prev_topic_url,
	'U_VIEW_NEWER_TOPIC' => $view_next_topic_url,
	'U_POST_NEW_TOPIC' => $new_topic_url,
	'U_TOPIC_SEARCH' => append_sid('search.' . $phpEx . '?mode=results'),
	'U_POST_REPLY_TOPIC' => $reply_topic_url)
);

//
// Does this topic contain a poll?
//
if ( !empty($forum_topic_data['topic_vote']) )
{
	$s_hidden_fields = '';

	$sql = "SELECT vd.vote_id, vd.vote_text, vd.vote_start, vd.vote_length, vr.vote_option_id, vr.vote_option_text, vr.vote_result
		FROM " . VOTE_DESC_TABLE . " vd, " . VOTE_RESULTS_TABLE . " vr
		WHERE vd.topic_id = $topic_id
			AND vr.vote_id = vd.vote_id
		ORDER BY vr.vote_option_id ASC";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Could not obtain vote data for this topic", '', __LINE__, __FILE__, $sql);
	}

	if ( $vote_info = $db->sql_fetchrowset($result) )
	{
		$db->sql_freeresult($result);
		$vote_options = count($vote_info);

		$vote_id = $vote_info[0]['vote_id'];
		$vote_title = $vote_info[0]['vote_text'];

		$sql = "SELECT vote_id
			FROM " . VOTE_USERS_TABLE . "
			WHERE vote_id = $vote_id
			AND vote_user_id = " . intval($userdata['user_id']);
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, "Could not obtain user vote data for this topic", '', __LINE__, __FILE__, $sql);
		}

		$user_voted = ( $row = $db->sql_fetchrow($result) ) ? TRUE : 0;
		$db->sql_freeresult($result);

		if ( isset($HTTP_GET_VARS['vote']) || isset($HTTP_POST_VARS['vote']) )
		{
			$view_result = ( ( ( isset($HTTP_GET_VARS['vote']) ) ? $HTTP_GET_VARS['vote'] : $HTTP_POST_VARS['vote'] ) == 'viewresult' ) ? TRUE : 0;
		}
		else
		{
			$view_result = 0;
		}

		$poll_expired = ( $vote_info[0]['vote_length'] ) ? ( ( $vote_info[0]['vote_start'] + $vote_info[0]['vote_length'] < time() ) ? TRUE : 0 ) : 0;

		if ( $user_voted || $view_result || $poll_expired || !$is_auth['auth_vote'] || $forum_topic_data['topic_status'] == TOPIC_LOCKED )
		{
			$template->set_filenames(array('pollbox' => 'viewtopic_poll_result.tpl'));

			$vote_results_sum = 0;

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_results_sum += $vote_info[$i]['vote_result'];
			}

			$vote_graphic = 0;
			$vote_graphic_max = count($images['voting_graphic']);

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_percent = ( $vote_results_sum > 0 ) ? $vote_info[$i]['vote_result'] / $vote_results_sum : 0;
				$vote_graphic_length = round($vote_percent * $board_config['vote_graphic_length']);

				$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
				$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

				if ( count($orig_word) )
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}

				$template->assign_block_vars("poll_option", array(
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'],
					'POLL_OPTION_RESULT' => $vote_info[$i]['vote_result'],
					'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),

					'POLL_OPTION_IMG' => $vote_graphic_img,
					'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
				);
			}

			$template->assign_vars(array(
				'L_TOTAL_VOTES' => $lang['Total_votes'],
				'TOTAL_VOTES' => $vote_results_sum)
			);

		}
		else
		{
			$template->set_filenames(array('pollbox' => 'viewtopic_poll_ballot.tpl'));

			for($i = 0; $i < $vote_options; $i++)
			{
				if ( count($orig_word) )
				{
					$vote_info[$i]['vote_option_text'] = preg_replace($orig_word, $replacement_word, $vote_info[$i]['vote_option_text']);
				}

				$template->assign_block_vars("poll_option", array(
					'POLL_OPTION_ID' => $vote_info[$i]['vote_option_id'],
					'POLL_OPTION_CAPTION' => $vote_info[$i]['vote_option_text'])
				);
			}

			$template->assign_vars(array(
				'L_SUBMIT_VOTE' => $lang['Submit_vote'],
				'L_VIEW_RESULTS' => $lang['View_results'],
				'U_VIEW_RESULTS' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;vote=viewresult"))
			);

			$s_hidden_fields = '<input type="hidden" name="topic_id" value="' . $topic_id . '" /><input type="hidden" name="mode" value="vote" />';
		}

		if ( count($orig_word) )
		{
			$vote_title = preg_replace($orig_word, $replacement_word, $vote_title);
		}

		$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $userdata['session_id'] . '" />';

		$template->assign_vars(array(
			'POLL_QUESTION' => $vote_title,
			'S_HIDDEN_FIELDS' => $s_hidden_fields,
			'S_POLL_ACTION' => append_sid("posting.$phpEx?mode=vote&amp;" . POST_TOPIC_URL . "=$topic_id"))
		);

		$template->assign_var_from_handle('POLL_DISPLAY', 'pollbox');
	}
}

init_display_post_attachments($forum_topic_data['topic_attachment']);

// Update the topic view counter
$sql = "UPDATE " . TOPICS_TABLE . " SET topic_views = topic_views + 1 WHERE topic_id = $topic_id";
if ( !$db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not update topic views.", '', __LINE__, __FILE__, $sql);
}


//
// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
//
for($i = 0; $i < $total_posts; $i++)
{
$post_number = $i+$start;
$post_number = $post_number+1;

$poster_id = $postrow[$i]['user_id'];
//$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $postrow[$i]['username'];
$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);
$poster_posts = ( $poster_id != ANONYMOUS ) ? $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] : '';
$poster_from = ( $postrow[$i]['user_from'] && $poster_id != ANONYMOUS ) ? $lang['Location'] . ': ' . $postrow[$i]['user_from'] : '';
$poster_joined = ( $poster_id != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date('d F Y', $postrow[$i]['user_regdate'], $board_config['board_timezone']) : '';

	$poster_avatar = '';
	if ( $postrow[$i]['user_avatar_type'] && $poster_id != ANONYMOUS && $postrow[$i]['user_allowavatar'] )
	{
		switch( $postrow[$i]['user_avatar_type'] )
		{
			case USER_AVATAR_UPLOAD:
				$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				if ( $board_config['allow_avatar_remote'] )
				{
					$avatar_url = $postrow[$i]['user_avatar'];

					$avatar_status = check_avatar($avatar_url);
					if ($avatar_status === FALSE)
					{
						$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="images/avatar_yok.gif" alt="" border="0" />' : '';
					}
					else if ($avatar_status === TRUE)
					{
						if ( ($postrow[$i]['user_avatar_height'] && $postrow[$i]['user_avatar_height'] > 0) &&
								($postrow[$i]['user_avatar_width'] && $postrow[$i]['user_avatar_width'] > 0) )
						{
							$poster_avatar = '<img src="' . $avatar_url . '" height="' . $postrow[$i]['user_avatar_height'] . '" width="' . $postrow[$i]['user_avatar_width'] . '" alt="" border="0" />';
						}
						else // No width/height in the user's profile
						{
							$poster_avatar = '<img src="' . $avatar_url . '" alt="" border="0" />';
						}
					}
				}
				else // remote avatars not allowed
				$poster_avatar = '';
				break;
			case USER_AVATAR_GALLERY:
				$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $postrow[$i]['user_avatar'] . '" alt="" border="0" />' : '';
				break;
		}
	}

	// Default avatar MOD, By Manipe (Begin)
	if ((!$poster_avatar) && ($board_config['default_avatar_set'] != 3))
	{
		if (($board_config['default_avatar_set'] == 0) && ($poster_id == -1) && ($board_config['default_avatar_guests_url']))
		{
			$poster_avatar = '<img src="' . $board_config['default_avatar_guests_url'] . '" alt="" border="0" />';
		}
		else if (($board_config['default_avatar_set'] == 1) && ($poster_id != -1) && ($board_config['default_avatar_users_url']) )
		{
			$poster_avatar = '<img src="' . $board_config['default_avatar_users_url'] . '" alt="" border="0" />';
		}
		else if ($board_config['default_avatar_set'] == 2)
		{
			if (($poster_id == -1) && ($board_config['default_avatar_guests_url']))
			{
				$poster_avatar = '<img src="' . $board_config['default_avatar_guests_url'] . '" alt="" border="0" />';
			}
			else if (($poster_id != -1) && ($board_config['default_avatar_users_url']))
			{
				$poster_avatar = '<img src="' . $board_config['default_avatar_users_url'] . '" alt="" border="0" />';
			}
		}
	}
	// Default avatar MOD, By Manipe (End)

//
// Define the little post icon
//
if ( $userdata['session_logged_in'] && $postrow[$i]['post_time'] > $userdata['user_lastvisit'] && $postrow[$i]['post_time'] > $topic_last_read )
{
	$mini_post_img = $images['icon_minipost_new'];
	$mini_post_alt = $lang['New_post'];
}
else
{
	$mini_post_img = $images['icon_minipost'];
	$mini_post_alt = $lang['Post'];
}

$mini_post_url = append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $postrow[$i]['post_id']) . '#' . $postrow[$i]['post_id'];
$mini_single_post_url = append_sid("viewpost.$phpEx?" . POST_POST_URL . '=' . $postrow[$i]['post_id']);

// Generate ranks, set them to empty string initially.
$poster_rank = '';
$rank_image = '';
if ( $poster_id == ANONYMOUS )
{
}
else if ( $postrow[$i]['user_rank'] )
{
	for($j = 0; $j < count($ranksrow); $j++)
	{
		if ( $postrow[$i]['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
		{
			$poster_rank = $ranksrow[$j]['rank_title'];
			$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}
else
{
	for($j = 0; $j < count($ranksrow); $j++)
	{
		if ( $postrow[$i]['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
		{
			$poster_rank = $ranksrow[$j]['rank_title'];
			$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}

// Handle anon users posting with usernames
if ( $poster_id == ANONYMOUS && $postrow[$i]['post_username'] != '' )
{
	$poster_rank = $lang['Guest'];
}

$temp_url = '';

if ( $userdata['session_logged_in'] && $board_config['allow_login_for_profile'])
{
	$temp_url = append_sid("profile.$phpEx?mode=viewprofile&" . POST_USERS_URL . "=$poster_id");
	$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
}
else
{
	$profile_img = '';
}

if ( $poster_id != ANONYMOUS && $userdata['session_logged_in'] )
{
	$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$poster_id");
	// Begin Disable_PM_Link mod
	if ( empty($board_config['privmsg_disable']) )
	{
		$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';
	}
	else
	{
		$pm_img = '';
		$pm = '';
	}

	if ( !empty($postrow[$i]['user_viewemail']) || $userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD )
	{
		$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $poster_id) : 'mailto:' . $postrow[$i]['user_email'];

		$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
		$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
	}
	else
	{
		$email_img = '';
		$email = '';
	}

	$www_img = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" ' . add_nofollow($postrow[$i]['user_website']) . ' target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
	$www = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" ' . add_nofollow($postrow[$i]['user_website']) . ' target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

	if ( !empty($postrow[$i]['user_icq']) )
	{
		$icq_status_img = '<a href="http://wwp.icq.com/' . $postrow[$i]['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $postrow[$i]['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
		$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
		$icq = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $postrow[$i]['user_icq'] . '">' . $lang['ICQ'] . '</a>';
	}
	else
	{
		$icq_status_img = '';
		$icq_img = '';
		$icq = '';
	}

	$aim_img = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '';
	$aim = ( $postrow[$i]['user_aim'] ) ? '<a href="aim:goim?screenname=' . $postrow[$i]['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '';

	$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
	$msn_img = ( $postrow[$i]['user_msnm'] ) ? '<a href="' . $temp_url . '"><img src="' . $images['icon_msnm'] . '" alt="' . $lang['MSNM'] . '" title="' . $lang['MSNM'] . '" border="0" /></a>' : '';
	$msn = ( $postrow[$i]['user_msnm'] ) ? '<a href="' . $temp_url . '">' . $lang['MSNM'] . '</a>' : '';

	$yim_img = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
	$yim = ( $postrow[$i]['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $postrow[$i]['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';
}
else
{
	$profile_url = '';
	$pm_img = '';
	$pm = '';
	$email_img = '';
	$email = '';
	$www_img = '';
	$www = '';
	$icq_status_img = '';
	$icq_img = '';
	$icq = '';
	$aim_img = '';
	$aim = '';
	$msn_img = '';
	$msn = '';
	$yim_img = '';
	$yim = '';
}

if ( $poster_id != ANONYMOUS && $userdata['session_logged_in'] )
{
	$temp_url = append_sid("posting.$phpEx?mode=quote&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
	$quote_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_quote'] . '" alt="' . $lang['Reply_with_quote'] . '" title="' . $lang['Reply_with_quote'] . '" border="0" /></a>';
	$quote = '<a href="' . $temp_url . '">' . $lang['Reply_with_quote'] . '</a>';
}

// start : mod Search User's Posts at Viewtopic by maxJackal
if ( $poster_id != ANONYMOUS )
{
	$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($postrow[$i]['username']));
	$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . $lang['Search_u_posts'] . '" title="' . $lang['Search_u_posts'] . '" border="0" /></a>';
	$search = '<a href="' . $temp_url . '" title="' . $lang['Search_u_posts'] . '">' . $lang['Posts'] . ': ' . $postrow[$i]['user_posts'] . '</a>';
}
else
{
	$search_img = '';
	$search = '';
}
// end : mod Search User's Posts at Viewtopic by maxJackal

if ( ( $userdata['user_id'] == $poster_id && $is_auth['auth_edit'] ) || $is_auth['auth_mod'] )
{
	$temp_url = append_sid("posting.$phpEx?mode=editpost&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id']);
	$edit_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_edit'] . '" alt="' . $lang['Edit_delete_post'] . '" title="' . $lang['Edit_delete_post'] . '" border="0" /></a>';
	$edit = '<a href="' . $temp_url . '">' . $lang['Edit_delete_post'] . '</a>';
}
else
{
	$edit_img = '';
	$edit = '';
}

if ( $is_auth['auth_mod'] )
{
	$temp_url = "modcp.$phpEx?mode=ip&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;" . POST_TOPIC_URL . "=" . $topic_id . "&amp;sid=" . $userdata['session_id'];
	$ip_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_ip'] . '" alt="' . $lang['View_IP'] . '" title="' . $lang['View_IP'] . '" border="0" /></a>';
	$ip = '<a href="' . $temp_url . '">' . $lang['View_IP'] . '</a>';

	$temp_url = "posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;sid=" . $userdata['session_id'];
	$delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
	$delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
}
else
{
	$ip_img = '';
	$ip = '';

	if ( $userdata['user_id'] == $poster_id && $is_auth['auth_delete'] && $forum_topic_data['topic_last_post_id'] == $postrow[$i]['post_id'] )
	{
		$temp_url = "posting.$phpEx?mode=delete&amp;" . POST_POST_URL . "=" . $postrow[$i]['post_id'] . "&amp;sid=" . $userdata['session_id'];
		$delpost_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_delpost'] . '" alt="' . $lang['Delete_post'] . '" title="' . $lang['Delete_post'] . '" border="0" /></a>';
		$delpost = '<a href="' . $temp_url . '">' . $lang['Delete_post'] . '</a>';
	}
	else
	{
		$delpost_img = '';
		$delpost = '';
	}
}

// BEGIN Advanced_Report_Hack
$s_report_post_img = '';
if ($userdata['session_logged_in'])
{
	if (($userdata['user_level'] == ADMIN || $is_auth['auth_mod']) && $reported_info[$postrow[$i]['post_id']] == REPORT_NOT_CLEARED && $board_config['report_list'] == 0)
	{
		$report_url = append_sid("report.$phpEx?mode=clearpost&amp;id=" . $postrow[$i]['post_id']);
		$report_img = $images['icon_reportpost_clear'];
		$report_title = $lang['Mark_cleared'];
	}
	else if ($reported_info[$postrow[$i]['post_id']] == REPORT_NOT_CLEARED)
	{
		$report_url = '';
		$report_img = $images['icon_reportpost_clear'];
		$report_title = $lang['Post_already_reported'];
	}
	else
	{
		$report_url = append_sid("report.$phpEx?mode=reportpost&amp;id=" . $postrow[$i]['post_id']);
		$report_img = $images['icon_reportpost'];
		$report_title = $lang['Report_post'];
	}

	if (!empty($report_img))
	{
		if (!empty($report_url))
		{
			$s_report_post_img = '<a href="' . $report_url . '"><img src="' . $report_img . '" alt="' . $report_title . '" title="' . $report_title . '" border="0" /></a>';
		}
		else
		{
			$s_report_post_img = '<img src="' . $report_img . '" alt="' . $report_title . '" title="' . $report_title . '" border="0" />';
		}
	}
}
// END Advanced_Report_Hack

$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : $lang['Re'] . ': ' . $topic_title;
// CBACK WebSite Censor Mod
if ( count($orig_word) )
{
	$message = preg_replace($orig_word, $replacement_word, $message);
}


// CrackerTracker v5.x
if ( $postrow[$i]['ct_miserable_user'] == 1 && $poster_id != $userdata['user_id'] && $userdata['user_level'] == 0)
{
	$message = $lang['ctracker_message_dialog_title'] . '<br /><br />' . $lang['ctracker_ipb_deleted'];
}
else
{
	$message = $postrow[$i]['post_text'];
	if ( $postrow[$i]['ct_miserable_user'] == 1 && $userdata['user_level'] == ADMIN )
	{
		$message .= '<br /><br />' . $lang['ctracker_mu_success'];
	}
}
// CrackerTracker v5.x

$bbcode_uid = $postrow[$i]['bbcode_uid'];

$user_sig = '';
if ( $poster_id != ANONYMOUS && $postrow[$i]['user_allowsig'] )
{
	$user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] && $userdata['session_logged_in']) ? $postrow[$i]['user_sig'] : '';
	$user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid'];
}
// Note! The order used for parsing the message _is_ important, moving things around could break any
// output

// If the board has HTML off but the post has HTML
// on then we process it, else leave it alone
if ( !$board_config['allow_html'] || !$userdata['user_allowhtml'])
{
	if ( $user_sig != '' )
	{
		$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
	}

	if ( $postrow[$i]['enable_html'] )
	{
		$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
	}
}

// Parse message and/or sig for BBCode if reqd
if ($user_sig != '' && $user_sig_bbcode_uid != '')
{
	$user_sig = ($board_config['allow_bbcode']) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace("/\:$user_sig_bbcode_uid/si", '', $user_sig);
}

if ($bbcode_uid != '')
{
	$message = ($board_config['allow_bbcode']) ? bbencode_second_pass($message, $bbcode_uid) : preg_replace("/\:$bbcode_uid/si", '', $message);
}

if ( $user_sig != '' )
{
	$user_sig = make_clickable($user_sig);
}
$message = make_clickable($message);

//
// Parse smilies
//
if ( $board_config['allow_smilies'] )
{
	if ( $postrow[$i]['user_allowsmile'] && $user_sig != '' )
	{
		$user_sig = smilies_pass($user_sig);
	}

	if ( $postrow[$i]['enable_smilies'] )
	{
		$message = smilies_pass($message);
	}
}

// Highlight active words (primarily for search)
if ($highlight_match)
{
	// This was shamelessly 'borrowed' from volker at multiartstudio dot de
	// This has been back-ported from 3.0 CVS
	$message = preg_replace('#(?!<.*)(?<!\w)(' . $highlight_match . ')(?!\w|[^<>]*>)#i', '<b style="color:#'.$theme['fontcolor3'].'">\1</b>', $message);
}

// Replace naughty words
if (count($orig_word))
{
	$post_subject = preg_replace($orig_word, $replacement_word, $post_subject);

	if ($user_sig != '')
	{
		$user_sig = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $user_sig . '<'), 1, -1));
	}

	$message = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $message . '<'), 1, -1));
}

//
// Replace newlines (we use this rather than nl2br because
// till recently it wasn't XHTML compliant)
//
if ( $user_sig != '' )
{
	$user_sig = '<br /><img title="" src="images/imza.gif"><br />' . str_replace("\n", "\n<br />\n", $user_sig);
}

$message = str_replace("\n", "\n<br />\n", $message);

// Again this will be handled by the templating
// code at some point
$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

//START Inline Banner Ad
$inline_ad_code = '';
$display_ad = ($i == $board_config['ad_after_post'] - 1) || (($board_config['ad_every_post'] != 0) && ($i + 1) % $board_config['ad_every_post'] == 0);
//This if statement should keep server processing down a bit
if ($display_ad)
{
	$display_ad = ($board_config['ad_who'] == ALL) || ($board_config['ad_who'] == ANONYMOUS && $userdata['user_id'] == ANONYMOUS) || ($board_config['ad_who'] == USER && $userdata['user_id'] != ANONYMOUS);
	$ad_no_forums = explode(",", $board_config['ad_no_forums']);
	for ($a=0; $a < count($ad_no_forums); $a++)
	{
		if ($forum_id == $ad_no_forums[$a])
		{
			$display_ad = false;
			break;
		}
	}
	if ($board_config['ad_no_groups'] != '')
	{
		$ad_no_groups = explode(",", $board_config['ad_no_groups']);
		$sql = "SELECT 1 FROM " . USER_GROUP_TABLE . "
			WHERE user_id=" . $userdata['user_id'] . " AND (group_id=0";
		for ($a=0; $a < count($ad_no_groups); $a++)
		{
			$sql .= " OR group_id=" . $ad_no_groups[$a];
		}
		$sql .= ")";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query ad information', '', __LINE__, __FILE__, $sql);
		}
		if ($row = $db->sql_fetchrow($result))
		{
			$display_ad = false;
		}
	}
	if ($userdata['user_id'] != ANONYMOUS && ($board_config['ad_post_threshold'] != '') && ($userdata['user_posts'] >= $board_config['ad_post_threshold']))
	{
		$display_ad = false;
	}
}
//check once more, for server performance

if ($display_ad)
{
	$sql = "SELECT a.ad_code FROM " . ADS_TABLE . " a";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query ad information', '', __LINE__, __FILE__, $sql);
	}
	$adRow = array();
	$adRow = $db->sql_fetchrowset($result);
	srand((double)microtime()*1000000);
	$adindex = rand(1, $db->sql_numrows($result)) - 1;
	$db->sql_freeresult($result);
	$inline_ad_code = $adRow[$adindex]['ad_code'];
}
//END Inline Banner Ad

//User Online Hack
//By AJ Quick (http://www.ajquick.com/)
//time()-60 sets the Refresh Time. If you want to be similar to the "Who is Online" view on First Page set time()-300

if ($postrow[$i]['poster_id'] != -1)
{
	if($postrow[$i]['user_session_time'] >= (time()-60))
	{
		if($postrow[$i]['user_allow_viewonline'] or ($userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD))
		{
			$status = '<a title="'. $lang['Who_is_Online']. '" href="'. append_sid("viewonline.".$phpEx). '"><img src="' . $images['online'] . '" /></a>';
		}
		else
		{
			$status = '<a title="'. $lang['Who_is_Online']. '" href="'. append_sid("viewonline.".$phpEx). '"><img src="' . $images['offline'] . '"/></a>';
		}
	}
	else
	{
		$status = '<a title="'. $lang['Who_is_Online']. '" href="'. append_sid("viewonline.".$phpEx). '"><img src="' . $images['offline'] . '"/></a>';
	}
}//User Online Hack end


$template->assign_block_vars('postrow', array(
	'ROW_COLOR' => '#' . $row_color,
	'POST_NUMBER' => $post_number,
	'ROW_CLASS' => $row_class,
	'POSTER_NAME' => ($poster_id == ANONYMOUS ) ? (($postrow[$i]['post_username'] != '' ) ? $postrow[$i]['post_username'] : $lang['Guest'] ) : color_group_colorize_name($poster_id, false),
	'POSTER_RANK' => $poster_rank,
	'RANK_IMAGE' => $rank_image,
	'POSTER_JOINED' => $poster_joined,
	'POSTER_STATUS' => $status,
	'POSTER_POSTS' => $poster_posts,
	'POSTER_FROM' => $poster_from,
	'POSTER_AVATAR' => $poster_avatar,
	'POST_DATE' => $post_date,
	'POST_SUBJECT' => $post_subject,
	'MESSAGE' => $message,
	'SIGNATURE' => $user_sig,
	'EDITED_MESSAGE' => $l_edited_by,

	'MINI_POST_IMG' => $mini_post_img,
	'PROFILE_URL' => $profile_url,
	'PROFILE_IMG' => $profile_img,
	'SEARCH_IMG' => $search_img,
	'SEARCH' => $search,
	'PM_IMG' => $pm_img,
	'PM' => $pm,
	'EMAIL_IMG' => $email_img,
	'EMAIL' => $email,
	'WWW_IMG' => $www_img,
	'WWW' => $www,
	'ICQ_STATUS_IMG' => $icq_status_img,
	'ICQ_IMG' => $icq_img,
	'ICQ' => $icq,
	'AIM_IMG' => $aim_img,
	'AIM' => $aim,
	'MSN_IMG' => $msn_img,
	'MSN' => $msn,
	'YIM_IMG' => $yim_img,
	'YIM' => $yim,
	'EDIT_IMG' => $edit_img,
	'EDIT' => $edit,
	'QUOTE_IMG' => $quote_img,
	'QUOTE' => $quote,
	'IP_IMG' => $ip_img,
	'IP' => $ip,
	'DELETE_IMG' => $delpost_img,
	'DELETE' => $delpost,
	'REPORT_IMG' => $s_report_post_img,
	'INLINE_AD' => $inline_ad_code,

	'L_MINI_POST_ALT' => $mini_post_alt,

	'U_MINI_SINGLE_POST' => $mini_single_post_url,
	'U_MINI_POST' => $mini_post_url,
	'U_POST_ID' => $postrow[$i]['post_id']
	)
);
display_post_attachments($postrow[$i]['post_id'], $postrow[$i]['post_attachment']);

//START Inline Banner Ad
if ($display_ad)
{
	if (!$board_config['ad_old_style'] && $display_ad)
	{
		$template->assign_block_vars('postrow.switch_ad',array());
	}
	else
	{
		$template->assign_block_vars('postrow.switch_ad_style2',array());
	}
}
//END Inline Banner Ad

// Start Edit Notes MOD
if ( $board_config['edit_notes_enable'] )
{
	$mode = ( isset($HTTP_GET_VARS['mode']) ) ? htmlspecialchars($HTTP_GET_VARS['mode']) : htmlspecialchars($HTTP_POST_VARS['mode']);
	$sid = ( isset($HTTP_GET_VARS['sid']) ) ? htmlspecialchars($HTTP_GET_VARS['sid']) : htmlspecialchars($HTTP_POST_VARS['sid']);
	$u_post_id = ( isset($HTTP_GET_VARS[POST_POST_URL]) ) ? intval($HTTP_GET_VARS[POST_POST_URL]) : intval($HTTP_POST_VARS[POST_POST_URL]);
	$u_topic_id = ( isset($HTTP_GET_VARS[POST_TOPIC_URL]) ) ? intval($HTTP_GET_VARS[POST_TOPIC_URL]) : intval($HTTP_POST_VARS[POST_TOPIC_URL]);
	$u_edit_note_id = ( isset($HTTP_GET_VARS['edit_note_id']) ) ? intval($HTTP_GET_VARS['edit_note_id']) : intval($HTTP_POST_VARS['edit_note_id']);

	$confirm = isset($HTTP_POST_VARS['confirm']) ? true : false;
	$cancel = isset($HTTP_POST_VARS['cancel']) ? true : false;

	// Are we trying to delete a note?
	if ( $mode == 'deletenote' && $sid && $u_edit_note_id && $u_post_id)
	{
		// To delete a note requires a session ID. No SID or invalid one? Die to prevent session hijacking.
		if ( $sid == '' || $sid != $userdata['session_id'] )
		{
			message_die(GENERAL_ERROR, 'Invalid_session');
		}

		$sql = 'SELECT user_id FROM ' . EDIT_NOTES_TABLE . " WHERE edit_note_id = $u_edit_note_id";

		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not look up user ID for this edit note', '', __LINE__, __FILE__, $sql);
		}

		if ( !($row = $db->sql_fetchrow($result)) )
		{
			message_die(GENERAL_ERROR, 'Could not retrieve user ID for this edit note', '', __LINE__, __FILE__, $sql);
		}

		$user_id = $row['user_id'];

		// Auth check. Is the user deleting the note the author or a mod/admin?
		if ( $is_auth['auth_delete'] != 1 || ( $is_auth['auth_mod'] == 0 && $user_id != $userdata['user_id'] ) )
		{
			message_die(GENERAL_ERROR, $lang['Not_Authorised']);
		}

		// Was cancel pressed when deleting a note?
		if ( $cancel )
		{
			redirect(append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$u_post_id", true) . "#$u_post_id");
		}

		// Confirm edit note deletion
		if ( !$confirm )
		{
			$s_hidden_fields = '<input type="hidden" name="' . POST_POST_URL . '" value="' . $u_post_id . '" />';
			$s_hidden_fields .= '<input type="hidden" name="mode" value="deletenote" />';
			$s_hidden_fields .= '<input type="hidden" name="sid" value="' . $sid . '" />';
			$s_hidden_fields .= '<input type="hidden" name="edit_note_id" value="' . $u_edit_note_id . '" />';
			$l_confirm = $lang['Confirm_delete_edit_note'];

			$template->set_filenames(array('confirm_body' => 'confirm_body.tpl'));

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Information'],
				'MESSAGE_TEXT' => $l_confirm,
				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],
				'S_CONFIRM_ACTION' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$u_topic_id"),
				'S_HIDDEN_FIELDS' => $s_hidden_fields
				)
			);

			$template->pparse('confirm_body');
			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}

		// Actually delete the note
		if ( $confirm )
		{
			$sql = 'DELETE FROM ' . EDIT_NOTES_TABLE . " WHERE edit_note_id = $u_edit_note_id LIMIT 1";

			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Could not delete this edit note', '', __LINE__, __FILE__, $sql);
			}

			$message = $lang['Edit_note_deleted'];
			$message .= '<br /><br />' . sprintf($lang['Click_view_message'], '<a href="' . append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$u_post_id") . "#$u_post_id" . '">', '</a>');
			message_die(GENERAL_MESSAGE, $message);
		}
	}

	// Core code. Pull all edit notes for this post.
	$max_edit_notes = $board_config['max_edit_notes'];
	$sql = 'SELECT * FROM ' . EDIT_NOTES_TABLE . ' WHERE post_id = ' . $postrow[$i]['post_id'] . ' ORDER BY edit_note_time DESC LIMIT ' . $max_edit_notes;

	if ( !($result = $db->sql_query($sql)) )
	{
		//message_die(GENERAL_ERROR, 'Could not look up edit notes for this post', '', __LINE__, __FILE__, $sql);
	}

	if ( $db->sql_numrows($result) )
	{
		$template->assign_block_vars('postrow.post_edit_notes', array() );
	}

	while ( $row = $db->sql_fetchrow($result) )
	{
		$edit_note_id = $row['edit_note_id'];
		$user_id = $row['user_id'];
		$note = htmlspecialchars($row['note']);

		// Replace censored words
		if ( count($orig_word) )
		{
			$note = preg_replace($orig_word, $replacement_word, $note);
		}

		$time = create_date(' d:h:Y H:i', $row['edit_note_time'], $board_config['board_timezone']);

		// Match up user IDs with usernames
		if ( $user_id != ANONYMOUS )
		{
			$u_user_profile = color_group_colorize_name($user_id, false);
		}
		else
		{
			$u_user_profile = $lang['Guest'];
		}
		$u_delete_note = ( $is_auth['auth_mod'] || $user_id == $userdata['user_id'] ) ? ' [ <a href="'."viewtopic.$phpEx?mode=deletenote&amp;" . POST_POST_URL . '=' . $postrow[$i]['post_id'] . "&amp;" . POST_TOPIC_URL . "=$topic_id&amp;edit_note_id=$edit_note_id&amp;sid=" . $userdata['session_id'] . '">' . $lang['Delete_note'] . '</a> ]' : '';

		$template->assign_block_vars('postrow.post_edit_notes.edit_notes_loop', array(
			'L_EDITED_BY' => sprintf($lang['Edited_by'], $u_user_profile, $time),
			'NOTE' => $note,
			'U_DELETE_NOTE' => $u_delete_note
			)
		);
	}
}
// End Edit Notes MOD


}

//
// My Quick Reply Mod
//
if (($userdata['session_logged_in'] && $is_auth['auth_reply'] && ($forum_topic_data['forum_status'] != FORUM_LOCKED) && ($forum_topic_data['topic_status'] != TOPIC_LOCKED)) || ($is_auth['auth_mod'])) 
{

	$template->assign_block_vars('switch_my_quick_reply',array() );

	if ($can_watch_topic and $is_watching_topic) 
	{
		$notify_user = 1;
	}
	else {
		$notify_user = $userdata['user_notify'];
	}

	$bbcode_uid = $postrow[$total_posts - 1]['bbcode_uid'];
	$last_poster = $postrow[$total_posts - 1]['username'];
	$last_msg = $postrow[$total_posts - 1]['post_text'];
	$last_msg = str_replace(":1:$bbcode_uid", "", $last_msg);
	$last_msg = str_replace(":u:$bbcode_uid", "", $last_msg);
	$last_msg = str_replace(":o:$bbcode_uid", "", $last_msg);
	$last_msg = str_replace(":$bbcode_uid", "", $last_msg);
	$last_msg = str_replace("'", "&#39;", $last_msg);
	$last_msg = "[QUOTE=\"$last_poster\"]" . $last_msg . "[/QUOTE]";

	$smilies_link = append_sid("posting.$phpEx?mode=smilies");

	$template->assign_vars(array(
		'MQR_EMPTY_MESSAGE' => $lang['Empty_message'],
		'MQR_FORM_ACTION' => append_sid("posting.$phpEx"),
		'MQR_LANG_OPTIONS' => $lang['Options'],
		'MQR_LANG_QUICK_REPLY' => $lang['Quick_Reply'],
		'MQR_LANG_SHOW_SMILIES' => $lang['Show_Smilies'],
		'MQR_QUOTE_LAST_POST' => $lang['Quote_Last_Post'],
		'MQR_ATTACH_SIG' => $lang['QR_Attach_Sig'],
		'MQR_SESSION_ID' => $userdata['session_id'],
		'MQR_TOPIC_ID' => $topic_id,
		'MQR_NOTIFY_USER' => $notify_user,
		'MQR_LAST_MSG' => $last_msg,
		'MQR_SMILIES_URL' => $smilies_link,
		'MQR_LANG_PREVIEW' => $lang['Preview'],
		'MQR_LANG_SUBMIT' => $lang['Submit'])
	);
}
// My Quick Reply Mod

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>