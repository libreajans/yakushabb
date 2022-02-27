<?php
/***************************************************************************
 * viewforum_p.php
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start initial var setup
if ( isset($HTTP_GET_VARS[POST_FORUM_URL]) || isset($HTTP_POST_VARS[POST_FORUM_URL]) )
{
	$forum_id = ( isset($HTTP_GET_VARS[POST_FORUM_URL]) ) ? intval($HTTP_GET_VARS[POST_FORUM_URL]) : intval($HTTP_POST_VARS[POST_FORUM_URL]);
}
else if ( isset($HTTP_GET_VARS['forum']))
{
	$forum_id = intval($HTTP_GET_VARS['forum']);
}
else
{
	$forum_id = '';
}

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

// Check if the user has actually sent a forum ID with his/her request
// If not give them a nice error page.
if ( !empty($forum_id) )
{
	$sql = "SELECT *
		FROM " . FORUMS_TABLE . "
		WHERE forum_id = $forum_id";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
	}
}
else
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

// If the query doesn't return any rows this isn't a valid forum. Inform
// the user.
if ( !($forum_row = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

// Start session management
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);
// End session management

// Start auth check
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if ( !$is_auth['auth_view'] )
{
	// The user is not authed to read this forum ...
	$message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);
	message_die(GENERAL_MESSAGE, $message);
}
// End of auth check

// All announcement data, this keeps announcements
// on each viewforum_p page ...
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2
	WHERE t.forum_id = $forum_id 
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_last_post_id
		AND p.poster_id = u2.user_id
		AND t.topic_type = " . POST_ANNOUNCE . " 
	ORDER BY t.topic_last_post_id DESC ";
if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$topic_rowset = array();
$total_announcements = 0;
while( $row = $db->sql_fetchrow($result) )
{
	$topic_rowset[] = $row;
	$total_announcements++;
}

$db->sql_freeresult($result);

// Grab all the basic data (all topics except announcements)
// for this forum

$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time 
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2
	WHERE t.forum_id = $forum_id
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_first_post_id
		AND p2.post_id = t.topic_last_post_id
		AND u2.user_id = p2.poster_id 
		AND t.topic_type <> " . POST_ANNOUNCE . " 
		$limit_topics_time
	ORDER BY t.topic_type DESC, t.topic_last_post_id DESC 
	LIMIT $start, ".$board_config['topics_per_page'];
if ( !($result = $db->sql_query($sql)) )
{
   message_die(GENERAL_ERROR, 'Could not obtain topic information', '', __LINE__, __FILE__, $sql);
}

$total_topics = 0;
while( $row = $db->sql_fetchrow($result) )
{
	$topic_rowset[] = $row;
	$total_topics++;
}
$db->sql_freeresult($result);

// Total topics ...
//döngüde kullanýlýyor, silinmemesi lazým...
$total_topics += $total_announcements;

// Define censored word matches
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

// Post URL generation for templating vars
$template->assign_vars(array(
	'S_POST_DAYS_ACTION' => append_sid("viewforum_p.$phpEx?" . POST_FORUM_URL . "=" . $forum_id . "&amp;start=$start"))
);

// Dump out the page header and load viewforum_p template
define('SHOW_ONLINE', true);
$page_title = $forum_row['forum_name'];
//----[ + ] -------- forum keyleri --------------
if(isset($HTTP_GET_VARS[POST_FORUM_URL]) and !$mark)
{
	$keywords = trim($forum_row['forum_keywords']) != '' ? $forum_row['forum_keywords'] : str_replace(" ", ", ", $forum_row['forum_desc']);
}
//----[ - ] -------- forum keyleri --------------
include($phpbb_root_path . 'includes/page_header_p.'.$phpEx);
$template->set_filenames(array('body' => 'viewforum_body_p.tpl'));

$template->assign_vars(array(
	'FORUM_ID' => $forum_id,
	'FORUM_NAME' => $forum_row['forum_name'],
	'FORUM_DESC' => $forum_row['forum_desc'],
	'U_VIEW_FORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id" .'-'. format_url($forum_row['forum_name'])) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id")
	)
);
// End header

// Okay, lets dump out the page ...
if( $total_topics )
{
	for($i = 0; $i < $total_topics; $i++)
	{
		$topic_id = $topic_rowset[$i]['topic_id'];

		$topic_title = ( count($orig_word) ) ? preg_replace($orig_word, $replacement_word, $topic_rowset[$i]['topic_title']) : $topic_rowset[$i]['topic_title'];
		$topic_type = $topic_rowset[$i]['topic_type'];

		if( $topic_type == POST_ANNOUNCE )
		{
			$topic_type = $lang['Topic_Announcement'] . ' ';
		}
		else if( $topic_type == POST_STICKY )
		{
			$topic_type = $lang['Topic_Sticky'] . ' ';
		}
		else
		{
			$topic_type = '';		
		}

		if( $topic_rowset[$i]['topic_vote'] )
		{
			$topic_type .= $lang['Topic_Poll'] . ' ';
		}
		
		if( $topic_rowset[$i]['topic_status'] == TOPIC_MOVED )
		{
			$topic_type = $lang['Topic_Moved'] . ' ';
			$topic_id = $topic_rowset[$i]['topic_moved_id'];
		}

		$view_topic_url = ($board_config['basit_seo_open']) ? append_sid("viewtopic_p.$phpEx?" . POST_TOPIC_URL . "=$topic_id-" . (format_url($topic_title))) : append_sid("viewtopic_p.$phpEx?" . POST_TOPIC_URL . "=$topic_id");
		$template->assign_block_vars('topicrow', array(
			'TOPIC_ID' => $topic_id,
			'TOPIC_TITLE' => $topic_title,
			'TOPIC_TYPE' => $topic_type,
			'U_VIEW_TOPIC' => $view_topic_url)
		);
	}

	$topics_count -= $total_announcements;
}
else
{
	$no_topics_msg = ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['No_topics_post_one'];
	$template->assign_vars(array('L_NO_TOPICS' => $no_topics_msg));
	$template->assign_block_vars('switch_no_topics', array() );
}

// Parse the page and print
$template->pparse('body');
// Page footer
include($phpbb_root_path . 'includes/page_tail_p.'.$phpEx);

?>