<?php
/***************************************************************************
 * viewtopic.php
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

if ( !$userdata['session_logged_in'] and $board_config['hide_links'])
{
	//message_die(GENERAL_MESSAGE, 'Sadece giriþ yapmýþ üyeler arþiv özelliðini kullanabilir');
}

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

if (!$topic_id && !$post_id)
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic_p)

$join_sql_table = (!$post_id) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 ";
$join_sql = (!$post_id) ? "t.topic_id = $topic_id" : "p.post_id = $post_id AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= $post_id";
$count_sql = (!$post_id) ? '' : ", COUNT(p2.post_id) AS prev_posts";
$order_sql = (!$post_id) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments ORDER BY p.post_id ASC";

$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.forum_password, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments" . $count_sql . "
	FROM " . TOPICS_TABLE . " t, " . FORUMS_TABLE . " f" . $join_sql_table . "
	WHERE $join_sql
		AND f.forum_id = t.forum_id
		$order_sql";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not obtain topic information", '', __LINE__, __FILE__, $sql);
}

if ( !($forum_topic_data = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Topic_post_not_exist');
}

$forum_id = intval($forum_topic_data['forum_id']);

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
	if( $forum_topic_data['forum_password'] != '' )
	{
		message_die(general_message, 'Pasword Protected Forum!!!');
	}
}
// END: Password check

//sorgu optimize edildi, gereksiz bilgiler çekilmiyor.
$sql = "SELECT u.username, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
	FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
	WHERE p.topic_id = $topic_id
		AND pt.post_id = p.post_id
		AND u.user_id = p.poster_id
	ORDER BY p.post_time ASC";
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
}
else 
{ 
   include($phpbb_root_path . 'includes/functions_admin.' . $phpEx); 
   sync('topic', $topic_id); 

   message_die(GENERAL_MESSAGE, $lang['No_posts_topic']); 
} 

// Define censored word matches
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

// Censor topic title
if ( count($orig_word) )
{
	$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
}

// Load templates
$template->set_filenames(array(	'body' => 'viewtopic_body_p.tpl'));

// Output page header
$page_title = $topic_title;
include($phpbb_root_path . 'includes/page_header_p.'.$phpEx);

$view_forum_url = ($board_config['basit_seo_open']) ? append_sid("viewforum_p.$phpEx?" . POST_FORUM_URL . "=$forum_id" .'-'. format_url($forum_name)) : append_sid("viewforum_p.$phpEx?" . POST_FORUM_URL . "=$forum_id");
// Send vars to template
$template->assign_vars(array(
    'FORUM_NAME' => $forum_name,
    'TOPIC_ID' => $topic_id,
    'TOPIC_TITLE' => $topic_title,
	'U_VIEW_TOPIC' => ($board_config['basit_seo_open']) ? append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id" .'-'. format_url($topic_title)) : append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
	'U_VIEW_FORUM' => $view_forum_url
	)
);

// Update the topic view counter
$sql = "UPDATE " . TOPICS_TABLE . "
	SET topic_views = topic_views + 1
	WHERE topic_id = $topic_id";
if ( !$db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, "Could not update topic views.", '', __LINE__, __FILE__, $sql);
}

// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
for($i = 0; $i < $total_posts; $i++)
{
	$poster_id = $postrow[$i]['user_id'];
	$poster = ( $poster_id == ANONYMOUS ) ? $lang['Guest'] : $postrow[$i]['username'];
	$post_date = create_date($board_config['default_dateformat'], $postrow[$i]['post_time'], $board_config['board_timezone']);

	if ( $poster_id == ANONYMOUS && $postrow[$i]['post_username'] != '' )
	{
		$poster = $postrow[$i]['post_username'];
	}

	$post_subject = ( $postrow[$i]['post_subject'] != '' ) ? $postrow[$i]['post_subject'] : '';

	$message = $postrow[$i]['post_text'];
	$bbcode_uid = $postrow[$i]['bbcode_uid'];

	if ($bbcode_uid != '')
	{
		if ( !$userdata['session_logged_in'] and $board_config['hide_links'] )
		{
			$replacer .= $lang['Links_Allowed_For_Registered_Only'];
			$replacer .= sprintf($lang['Get_Registered'], "<a href=\"" . append_sid('profile.' . $phpEx . '?mode=register') . "\">", "</a>");
			$replacer .= sprintf($lang['Enter_Forum'], "<a href=\"" . append_sid($u_login_logout) . "\">", "</a>");
		}
			$message = strip_tags($message);
			$message = preg_replace("/\[.*?:$bbcode_uid:?.*?\]/si", '', $message);
			$message = preg_replace('/\[url\]|\[\/url\]/si', '', $message);

		if ( !$userdata['session_logged_in'] and $board_config['hide_links'] )
		{
			$message = preg_replace("#(^|[\n ])([\w]+?://[^ \"\n\r\t<]*)#is", $replacer, $message);
			$message = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#is", $replacer, $message);
			$message = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", $replacer, $message);
		}
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
	$message = str_replace("\n", "\n<br />\n", $message);

	// Again this will be handled by the templating
	// code at some point

	$template->assign_block_vars('postrow', array(
		'ROW_COLOR' => '#' . $row_color,
		'POSTER_NAME' => $poster,
		'POST_DATE' => $post_date,
		'POST_SUBJECT' => $post_subject,
		'MESSAGE' => $message,
		'U_POST_ID' => $postrow[$i]['post_id']
		)
	);
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail_p.'.$phpEx);

?>