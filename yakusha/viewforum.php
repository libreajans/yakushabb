<?php
/***************************************************************************
* viewforum.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_color_groups.'. $phpEx);
include_once($phpbb_root_path . 'includes/functions_topics_list.'. $phpEx);


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
$viewall = ( isset($HTTP_GET_VARS['viewall']) ) ? intval($HTTP_GET_VARS['viewall']) : 0;

if ( isset($HTTP_GET_VARS['mark']) || isset($HTTP_POST_VARS['mark']) )
{
	$mark_read = (isset($HTTP_POST_VARS['mark'])) ? $HTTP_POST_VARS['mark'] : $HTTP_GET_VARS['mark'];
}
else
{
	$mark_read = '';
}

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

// If the query doesn't return any rows this isn't a valid forum. Inform the user.
if ( !($forum_row = $db->sql_fetchrow($result)) )
{
	message_die(GENERAL_MESSAGE, 'Forum_not_exist');
}

// Start session management
$userdata = session_pagestart($user_ip, $forum_id);
init_userprefs($userdata);

// Start auth check
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_row);

if ( !$is_auth['auth_view'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = POST_FORUM_URL . "=$forum_id" . ( ( isset($start) ) ? "&start=$start" : '' );
		redirect(append_sid("login.$phpEx?redirect=viewforum.$phpEx&$redirect", true));
	}

	// The user is not authed to read this forum ...
	$message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

	message_die(GENERAL_MESSAGE, $message);
}

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
		if( $forum_row['forum_password'] != '' )
		{
			password_check('forum', $forum_id, $HTTP_POST_VARS['password'], $redirect);
		}
	}

	$passdata = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass']) ) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_fpass'])) : '';
	if( $forum_row['forum_password'] != '' && ($passdata[$forum_id] != md5($forum_row['forum_password'])) )
	{
		password_box('forum', $redirect);
	}
}

// Handle marking posts
if ( $mark_read == 'topics' )
{
	$mark_list = ( isset($HTTP_GET_VARS['mark_list']) ) ? explode(',', $HTTP_GET_VARS['mark_list']) : array($forum_id);
	$old_forum_id = $forum_id;

	if ( $userdata['session_logged_in'] )
	{
		$sql = "SELECT MAX(post_time) AS last_post
			FROM " . POSTS_TABLE . "
			WHERE forum_id = $forum_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
		}

		if ( $row = $db->sql_fetchrow($result) )
		{
			$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : array();
			$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : array();

			if ( ( count($tracking_forums) + count($tracking_topics) ) >= 150 && empty($tracking_forums[$forum_id]) )
			{
				asort($tracking_forums);
				unset($tracking_forums[key($tracking_forums)]);
			}

			if ( $row['last_post'] > $userdata['user_lastvisit'] )
			{
				$tracking_forums[$forum_id] = time();
				
				$set_cookie = true;
				if( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) )
				{
					$HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f'] = serialize($tracking_forums);
				}
			}
		}// end $row = $db->sql_fetchrow($result)

		// Begin Simple Subforums MOD
		if( $set_cookie )
		{
			setcookie($board_config['cookie_name'] . '_f', serialize($tracking_forums), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
		}
		$forum_id = $old_forum_id;
		// End Simple Subforums MOD
	
		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="1;url=' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">')
		);
	} // end login control
	
	$message = $lang['Topics_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_forum'], '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id") . '">', '</a> ');
	message_die(GENERAL_MESSAGE, $message);
}
// End handle marking posts

$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) : '';
$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) : '';

// Do the forum Prune
if ( $is_auth['auth_mod'] && $board_config['prune_enable'] )
{
	if ( $forum_row['prune_next'] < time() && $forum_row['prune_enable'] )
	{
		include($phpbb_root_path . 'includes/prune.'.$phpEx);
		require($phpbb_root_path . 'includes/functions_admin.'.$phpEx);
		auto_prune($forum_id);
	}
}
// End of forum prune

//--[+]-- yetkililer bilgisi çekiliyor -------------
$sql = "SELECT u.user_id, u.username
	FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
	WHERE aa.forum_id = $forum_id
		AND aa.auth_mod = " . TRUE . "
		AND g.group_single_user = 1
		AND ug.group_id = aa.group_id
		AND g.group_id = aa.group_id
		AND u.user_id = ug.user_id
	GROUP BY u.user_id, u.username
	ORDER BY u.user_id";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
}


$moderators = array();
while( $row = $db->sql_fetchrow($result) )
{
	$moderators[] = color_group_colorize_name($row['user_id'],false);
}
$db->sql_freeresult($result);

$sql = "SELECT g.group_id, g.group_name
	FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
	WHERE aa.forum_id = $forum_id
		AND aa.auth_mod = " . TRUE . "
		AND g.group_single_user = 0
		AND g.group_type <> ". GROUP_HIDDEN ."
		AND ug.group_id = aa.group_id
		AND g.group_id = aa.group_id
	GROUP BY g.group_id, g.group_name
	ORDER BY g.group_id";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
}

while( $row = $db->sql_fetchrow($result) )
{
	$moderators[] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
}

$l_moderators = ( count($moderators) > 1 ) ? $lang['Moderators'] : $lang['Moderator'];
$forum_moderators = ( count($moderators) ) ? implode(', ', $moderators) : $lang['None'];
unset($moderators);
//--[-]-- yetkililer bilgisi çekiliyor -------------

//----- [+]------ topic order mod -------------
$previous_days = array(0, 1, 7, 14, 30, 90, 180, 364);
$previous_days_text = array($lang['All_Topics'], $lang['1_Day'], $lang['7_Days'], $lang['2_Weeks'], $lang['1_Month'], $lang['3_Months'], $lang['6_Months'], $lang['1_Year']);

$select_topic_days = '<select name="topicdays">';
for($i = 0; $i < count($previous_days); $i++)
{
	$selected = ($topic_days == $previous_days[$i]) ? ' selected="selected"' : '';
	$select_topic_days .= '<option value="' . $previous_days[$i] . '"' . $selected . '>' . $previous_days_text[$i] . '</option>';
}
$select_topic_days .= '</select>';

if ( isset($HTTP_POST_VARS['order']) )
{
	$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if ( isset($HTTP_GET_VARS['order']) )
{
	$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = 'DESC';
}

if ( isset($HTTP_POST_VARS['mode']) )
{
	$mode = htmlspecialchars(trim($HTTP_POST_VARS['mode']));
}
else if ( isset($HTTP_GET_VARS['mode']) )
{
	$mode = htmlspecialchars(trim($HTTP_GET_VARS['mode']));
}
else
{
	$mode = 'default';
}
$mode_types_text = array($lang['Post_Normal'], $lang['Topics'],$lang['Date'],$lang['Replies'],$lang['Author'],$lang['Views']);
$mode_types = array('default', 'topics', 'time', 'replies', 'author', 'views');

switch($mode)
{
	case 'topics':
		$order_by = "t.topic_title $sort_order";
		break;
		
	case 'replies':
		$order_by = "t.topic_replies $sort_order";
		break;
		
	case 'author':
		$order_by = "u.username $sort_order, p.post_username $sort_order";
		break;
		
	case 'views':
		$order_by = "t.topic_views $sort_order";
		break;
		
	case 'time':
		$order_by = "t.topic_id $sort_order";
		break;
		
	default:
		$order_by = "t.topic_last_post_id $sort_order";
		break;
}

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ($mode == $mode_types[$i]) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i].'"'. $selected. '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == "ASC")
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= "</select>";
//----- [-]------ topic order mod -------------


// Generate a 'Show topics in previous x days' select box. If the topicsdays var is sent
// then get it's value, find the number of topics with dates newer than it (to properly
// handle pagination) and alter the main query
if ( !empty($HTTP_POST_VARS['topicdays']) || !empty($HTTP_GET_VARS['topicdays']) )
{
	$topic_days = ( !empty($HTTP_POST_VARS['topicdays']) ) ? intval($HTTP_POST_VARS['topicdays']) : intval($HTTP_GET_VARS['topicdays']);
	$min_topic_time = time() - ($topic_days * 86400);
	
	$sql = "SELECT COUNT(t.topic_id) AS forum_topics
		FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
		WHERE t.forum_id = $forum_id
			AND p.post_id = t.topic_last_post_id
			AND p.post_time >= $min_topic_time";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain limited topics count information', '', __LINE__, __FILE__, $sql);
	}
	$row = $db->sql_fetchrow($result);
	$db->sql_freeresult($result);

	$topics_count = ( $row['forum_topics'] ) ? $row['forum_topics'] : 1;
	$limit_topics_time = "AND p.post_time >= $min_topic_time";

	if ( !empty($HTTP_POST_VARS['topicdays']) )
	{
		$start = 0;
	}
}
else
{
	$topics_count = ( $forum_row['forum_topics'] ) ? $forum_row['forum_topics'] : 1;
	$limit_topics_time = '';
	$topic_days = 0;
}

// All announcement data, this keeps announcements on each viewforum page ...
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_time, p.post_username
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . USERS_TABLE . " u2
	WHERE t.forum_id = $forum_id
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_last_post_id
		AND p.poster_id = u2.user_id
		AND t.topic_type = " . POST_ANNOUNCE . "
	ORDER BY $order_by ";
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

$board_config['topics_per_page'] = ( $viewall == 1 ) ? $topics_count : $board_config['topics_per_page'];

// Grab all the basic data (all topics except announcements) for this forum
$sql = "SELECT t.*, u.username, u.user_id, u2.username as user2, u2.user_id as id2, p.post_username, p2.post_username AS post_username2, p2.post_time
	FROM " . TOPICS_TABLE . " t, " . USERS_TABLE . " u, " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2, " . USERS_TABLE . " u2
	WHERE t.forum_id = $forum_id
		AND t.topic_poster = u.user_id
		AND p.post_id = t.topic_first_post_id
		AND p2.post_id = t.topic_last_post_id
		AND u2.user_id = p2.poster_id
		AND t.topic_type <> " . POST_ANNOUNCE . "
	$limit_topics_time
	ORDER BY t.topic_type DESC, $order_by
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
$total_topics += $total_announcements;

// Define censored word matches
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

// Post URL generation for templating vars
$template->assign_vars(array(
	'L_DISPLAY_TOPICS' => $lang['Display_topics'],
	'U_POST_NEW_TOPIC' => append_sid("posting.$phpEx?mode=newtopic&amp;" . POST_FORUM_URL . "=$forum_id"),
	'S_SELECT_TOPIC_DAYS' => $select_topic_days,
	'S_POST_DAYS_ACTION' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_id . "&amp;start=$start"))
);

// User authorisation levels output
$s_auth_can = ( ( $is_auth['auth_post'] ) ? $lang['Rules_post_can'] : $lang['Rules_post_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_reply'] ) ? $lang['Rules_reply_can'] : $lang['Rules_reply_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_edit'] ) ? $lang['Rules_edit_can'] : $lang['Rules_edit_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_delete'] ) ? $lang['Rules_delete_can'] : $lang['Rules_delete_cannot'] ) . '<br />';
$s_auth_can .= ( ( $is_auth['auth_vote'] ) ? $lang['Rules_vote_can'] : $lang['Rules_vote_cannot'] ) . '<br />';
attach_build_auth_levels($is_auth, $s_auth_can);

if ( $is_auth['auth_mod'] )
{
	$s_auth_can .= sprintf($lang['Rules_moderate'], "<a href=\"modcp.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;start=" . $start . "&amp;sid=" . $userdata['session_id'] . '">', '</a>');
}

// Mozilla navigation bar
$nav_links['up'] = array(
	'url' => append_sid('index.'.$phpEx),
	'title' => sprintf($lang['Forum_Index'], $board_config['sitename'])
);

// Dump out the page header and load viewforum template
define('SHOW_ONLINE', true);
$page_title = $forum_row['forum_name'];
//---[-]---login form yönlendirmeleri
//kýsa fakat üç kontrol yapýyor, $mark'ý ayrýþtýrýyor, forum keylerin olup olmadýðýna bakýyor
//varsa forum keylerini yoksa forum açýklamasýný kullanýyor
if(isset($HTTP_GET_VARS[POST_FORUM_URL]) and !$mark)
{
	$keywords = trim($forum_row['forum_keywords']) != '' ? $forum_row['forum_keywords'] : str_replace(" ", ", ", $forum_row['forum_desc']);
}
$rss_url = "rss.".$phpEx."?".POST_FORUM_URL."=".$HTTP_GET_VARS[POST_FORUM_URL];
$l_rss = $board_config['sitename'] ." ".$lang['rss_forum'];
$redirect_page = '<input type="hidden" name="redirect" value="' . append_sid("viewforum.php?f=" . $forum_id . "&amp;topicdays=" . $topic_days . "&amp;mode=" . $mode . "&order=" . $sort_order . "&amp;viewall=". $viewall ).'">';
//---[-]---login form yönlendirmeleri
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

//tema deðiþimi burdan yapýlýyor
$template->set_filenames(array('body' => ($board_config['icon_mod_open']) ? 'viewforum_body.tpl' : 'viewforum_body_.tpl' ));

// Begin Simple Subforums MOD
$all_forums = array();
make_jumpbox_ref('viewforum.'.$phpEx, $forum_id, $all_forums);
// End Simple Subforums MOD


// özel ban by emrag
$sql = "SELECT user_can_post FROM " . USERS_TABLE . " WHERE user_id =" . $userdata['user_id'];
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_MESSAGE, 'Could not obtain user_can_post data');
}
$row = $db->sql_fetchrow($result);
$user_can_post = $row['user_can_post'];

if (!$user_can_post)
{
	$post_info['forum_status'] = FORUM_LOCKED;
}

if(!$user_can_post)
{
	$post_img_replace_with = $images['ban'];
	$l_post_new_topic_replace_with = $lang['Ban'];
}
else
{
	$post_img_replace_with = ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $images['post_locked'] : $images['post_new'];
	$l_post_new_topic_replace_with = ( $forum_row['forum_status'] == FORUM_LOCKED ) ? $lang['Forum_locked'] : $lang['Post_new_topic'];
}
// end özel ban by emrag

$template->assign_vars(array(
	'FORUM_ID' => $forum_id,
	'FORUM_NAME' => $forum_row['forum_name'],
	'FORUM_ICON_IMG' => ($forum_row['forum_icon']) ? '<img src="' . $phpbb_root_path . $forum_row['forum_icon'] . '" alt="'.$forum_row['forum_name'].'" title="'.$forum_row['forum_name'].'" />&nbsp;' : '', // Forum Icon Mod
	'FORUM_DESC' => $forum_row['forum_desc'],
	'MODERATORS' => $forum_moderators,
	'POST_IMG' => $post_img_replace_with,
	'FOLDER_IMG' => $images['folder'],
	'FOLDER_NEW_IMG' => $images['folder_new'],
	'FOLDER_HOT_IMG' => $images['folder_hot'],
	'FOLDER_HOT_NEW_IMG' => $images['folder_hot_new'],
	'FOLDER_LOCKED_IMG' => $images['folder_locked'],
	'FOLDER_LOCKED_NEW_IMG' => $images['folder_locked_new'],
	'FOLDER_STICKY_IMG' => $images['folder_sticky'],
	'FOLDER_STICKY_NEW_IMG' => $images['folder_sticky_new'],
	'FOLDER_ANNOUNCE_IMG' => $images['folder_announce'],
	'FOLDER_ANNOUNCE_NEW_IMG' => $images['folder_announce_new'],
	
	'L_SEARCH_IN_FORUM' => $lang['search_in_forum'],
	'L_TOPICS' => $lang['Topics'],
	'L_REPLIES' => $lang['Replies'],
	'L_VIEWS' => $lang['Views'],
	'L_POSTS' => $lang['Posts'],
	'L_LASTPOST' => $lang['Last_Post'],
	'L_MODERATOR' => $l_moderators,
	'L_MARK_TOPICS_READ' => $lang['Mark_all_topics'],
	'L_POST_NEW_TOPIC' => $l_post_new_topic_replace_with,
	'L_NO_NEW_POSTS' => $lang['No_new_posts'],
	'L_NEW_POSTS' => $lang['New_posts'],
	'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'],
	'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'],
	'L_NO_NEW_POSTS_HOT' => $lang['No_new_posts_hot'],
	'L_NEW_POSTS_HOT' => $lang['New_posts_hot'],
	'L_ANNOUNCEMENT' => $lang['Post_Announcement'],
	'L_STICKY' => $lang['Post_Sticky'],
	'L_POSTED' => $lang['Posted'],
	'L_JOINED' => $lang['Joined'],
	'L_AUTHOR' => $lang['Author'],
	// BEGIN Topics Order Hack
	'L_ORDER' => $lang['Order'],
	'L_SUBMIT' => $lang['Sort'],
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	
	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_DAYS_SELECT' => $select_topic_days,
	// END Topics Order Hack
	'S_AUTH_LIST' => $s_auth_can,
	//---[+]----  basit seo modu
	'U_ARCHIVE' => ($board_config['basit_seo_open']) ? append_sid("viewforum_p.$phpEx?" . POST_FORUM_URL ."=$forum_id" .'-'. format_url($forum_row['forum_name'])) : append_sid("viewforum_p.$phpEx?" . POST_FORUM_URL ."=$forum_id"),
	'U_VIEW_FORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id" .'-'. format_url($forum_row['forum_name'])) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id"),
	//---[-]---- basit seo modu
	'U_MARK_READ' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;mark=topics"))
);

// Begin Simple Subforums MOD
if( $forum_row['forum_parent'] )
{
	$parent_id = $forum_row['forum_parent'];
	for( $i = 0; $i < count($all_forums); $i++ )
	{
		if( $all_forums[$i]['forum_id'] == $parent_id )
		{
			$template->assign_vars(array(
			'PARENT_FORUM' => 1,
			'PARENT_FORUM_NAME' => $all_forums[$i]['forum_name'],
			//---[+]--basit seo modu
			'U_VIEW_PARENT_FORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id'] .'-'. format_url($all_forums[$i]['forum_name'])) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL .'=' . $all_forums[$i]['forum_id']),
			//---[-]--basit seo modu
			));
		}
	}
}
else
{
	$sub_list = array();
	for( $i = 0; $i < count($all_forums); $i++ )
	{
		if( $all_forums[$i]['forum_parent'] == $forum_id )
		{
			$sub_list[] = $all_forums[$i]['forum_id'];
		}
	}
	if( count($sub_list) )
	{
		$sub_list[] = $forum_id;
		$template->vars['U_MARK_READ'] .= '&amp;mark_list=' . implode(',', $sub_list);
	}
}
// assign additional variables for subforums mod
$template->assign_vars(array(
	'NUM_TOPICS' => $forum_row['forum_topics'],
	'CAN_POST' => $is_auth['auth_post'] ? 1 : 0,
	'L_FORUM' => $lang['Forum'])
);
// End Simple Subforums MOD

// End header

// Okay, lets dump out the page ...

// adjust the item id
for ($i=0; $i < count($topic_rowset); $i++)
{
	$topic_rowset[$i]['topic_id'] = POST_TOPIC_URL . $topic_rowset[$i]['topic_id'];
}

// set the bottom sort option
$footer = $lang['Display_topics'] . ':&nbsp;' . $select_topic_days . '&nbsp;' . ( !empty($s_display_order) ? $s_display_order : '') . '<input type="submit" class="liteoption" value="' . $lang['Go'] . '" name="submit" />';

// send the list
$allow_split_type = true;
$display_nav_tree = false;
topic_list('TOPICS_LIST_BOX', 'topics_list_box', $topic_rowset, '', $allow_split_type, $display_nav_tree, $footer);

$topics_count -= $total_announcements;

$page_number = sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $topics_count / $board_config['topics_per_page'] ));
$l_goto_page = $lang['Goto_page'];

if ( $viewall == 1 )
{
	$pagination = '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . $forum_id."&amp;topicdays=$topic_days&amp;mode=$mode&amp;order=$sort_order") . '">' . $lang['Show_pages'] . '</a>';
	$page_number = '';
	$l_goto_page = '';
}
else if ( $topics_count > $board_config['topics_per_page'] )
{
	$pagination = generate_pagination("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;topicdays=$topic_days&amp;mode=$mode&amp;order=$sort_order", $topics_count, $board_config['topics_per_page'], $start) . ' | ' . '<a href="' . append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=" . "$forum_id&amp;topicdays=$topic_days&amp;mode=$mode&amp;order=$sort_order&amp;viewall=1") . '">' . $lang['View_all'] . '</a>';
}
else
{
	$pagination = generate_pagination("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id&amp;topicdays=$topic_days&amp;mode=$mode&amp;order=$sort_order", $topics_count, $board_config['topics_per_page'], $start);
}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => $page_number,
	'L_GOTO_PAGE' => $l_goto_page)
);


// Begin Simple Subforums MOD
$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
	FROM (( " . FORUMS_TABLE . " f
	LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
	LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
	WHERE f.forum_parent = '{$forum_id}'
	ORDER BY f.cat_id, f.forum_order";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query subforums information', '', __LINE__, __FILE__, $sql);
}

$subforum_data = array();
while( $row = $db->sql_fetchrow($result) )
{
	$subforum_data[] = $row;
}
$db->sql_freeresult($result);

if ( ($total_forums = count($subforum_data)) > 0 )
{
	// Find which forums are visible for this user
	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $subforum_data);
	
	$display_forums = false;
	for( $j = 0; $j < $total_forums; $j++ )
	{
		if ( $is_auth_ary[$subforum_data[$j]['forum_id']]['auth_view'] )
		{
			$display_forums = true;
		}
	}

	if( !$display_forums )
	{
		$total_forums = 0;
	}
}

if( $total_forums )
{
	$template->assign_var('HAS_SUBFORUMS', 1);
	$template->assign_block_vars('catrow', array(
		'CAT_ID' => $forum_id,
		'CAT_DESC' => $forum_row['forum_name'],
		'U_VIEWCAT' => append_sid("viewforum.$phpEx?" . POST_FORUM_URL ."=$forum_id"))
	);

	// Obtain a list of topic ids which contain
	// posts made since user last visited
	if ( $userdata['session_logged_in'] )
	{
		$sql = "SELECT t.forum_id, t.topic_id, p.post_time
			FROM " . TOPICS_TABLE . " t, " . POSTS_TABLE . " p
			WHERE p.post_id = t.topic_last_post_id
			AND p.post_time > " . $userdata['user_lastvisit'] . "
			AND t.topic_moved_id = 0";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query new topic information', '', __LINE__, __FILE__, $sql);
		}

		$new_topic_data = array();
		while( $topic_data = $db->sql_fetchrow($result) )
		{
			$new_topic_data[$topic_data['forum_id']][$topic_data['topic_id']] = $topic_data['post_time'];
		}
		$db->sql_freeresult($result);
	}

	// Obtain list of moderators of each forum
	// First users, then groups ... broken into two queries
	if ( $board_config['show_mod_list'])
	{
		$subforum_moderators = array();
		$sql = "SELECT aa.forum_id, u.user_id, u.username
			FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g, " . USERS_TABLE . " u
			WHERE aa.auth_mod = " . TRUE . "
				AND g.group_single_user = 1
				AND ug.group_id = aa.group_id
				AND g.group_id = aa.group_id
				AND u.user_id = ug.user_id
			GROUP BY u.user_id, u.username, aa.forum_id
			ORDER BY aa.forum_id, u.user_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
		}

		while( $row = $db->sql_fetchrow($result) )
		{
			$subforum_moderators[$row['forum_id']][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . $row['username'] . '</a>';
		}
		$db->sql_freeresult($result);

		$sql = "SELECT aa.forum_id, g.group_id, g.group_name
			FROM " . AUTH_ACCESS_TABLE . " aa, " . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g
			WHERE aa.auth_mod = " . TRUE . "
				AND g.group_single_user = 0
				AND g.group_type <> " . GROUP_HIDDEN . "
				AND ug.group_id = aa.group_id
				AND g.group_id = aa.group_id
			GROUP BY g.group_id, g.group_name, aa.forum_id
			ORDER BY aa.forum_id, g.group_id";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query forum moderator information', '', __LINE__, __FILE__, $sql);
		}

		while( $row = $db->sql_fetchrow($result) )
		{
			$subforum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
		}
		$db->sql_freeresult($result);
	}

	// show subforums
	for( $j = 0; $j < $total_forums; $j++ )
	{
		$subforum_id = $subforum_data[$j]['forum_id'];
		
		if ( $is_auth_ary[$subforum_id]['auth_view'] )
		{
			$unread_topics = false;
			if ( $subforum_data[$j]['forum_status'] == FORUM_LOCKED )
			{
				$folder_image = $images['forum_locked'];
				$folder_alt = $lang['Forum_locked'];
			}
			else
			{
				if ( $userdata['session_logged_in'] )
				{
					if ( !empty($new_topic_data[$subforum_id]) )
					{
						$subforum_last_post_time = 0;

						while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$subforum_id]) )
						{
							if ( empty($tracking_topics[$check_topic_id]) )
							{
								$unread_topics = true;
								$subforum_last_post_time = max($check_post_time, $subforum_last_post_time);
							}
							else
							{
								if ( $tracking_topics[$check_topic_id] < $check_post_time )
								{
									$unread_topics = true;
									$subforum_last_post_time = max($check_post_time, $subforum_last_post_time);
								}
							}
						}

						if ( !empty($tracking_forums[$subforum_id]) )
						{
							if ( $tracking_forums[$subforum_id] > $subforum_last_post_time )
							{
								$unread_topics = false;
							}
						}

						if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
						{
							if ( $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'] > $subforum_last_post_time )
							{
								$unread_topics = false;
							}
						}
					}
				}
				
				$folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum'];
				$folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts'];
			}
			
			$posts = $subforum_data[$j]['forum_posts'];
			$topics = $subforum_data[$j]['forum_topics'];
			
			if ( $subforum_data[$j]['forum_last_post_id'] )
			{
				$last_post_time = create_date($board_config['default_dateformat'], $subforum_data[$j]['post_time'], $board_config['board_timezone']);
				$last_post = '<a href="' . append_sid("viewtopic.$phpEx?"	. POST_POST_URL . '=' . $subforum_data[$j]['forum_last_post_id']) . '#' . $subforum_data[$j]['forum_last_post_id'] . '">'. $last_post_time .'</a><br>&nbsp;';
				$last_post .= ($subforum_data[$j]['user_id'] == ANONYMOUS ) ? (($subforum_data[$j]['post_username'] != '' ) ? $subforum_data[$j]['post_username'] : $lang['Guest'] ) : color_group_colorize_name($subforum_data[$j]['user_id'],true);
			}
			else
			{
				$last_post = $lang['No_Posts'];
			}
			
			if ( count($subforum_moderators[$subforum_id]) > 0 )
			{
				$l_moderators = ( count($subforum_moderators[$subforum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
				$moderator_list = implode(', ', $subforum_moderators[$subforum_id]);
			}
			else
			{
				$l_moderators = '<!--';
				$moderator_list = '-->';
			}
			$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
			$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	
			$template->assign_block_vars('catrow.forumrow', array(
				'ROW_COLOR' => '#' . $row_color,
				'ROW_CLASS' => $row_class,
				'FORUM_FOLDER_IMG' => $folder_image,
				'FORUM_NAME' => $subforum_data[$j]['forum_name'],
				'FORUM_DESC' => $subforum_data[$j]['forum_desc'],
				'FORUM_ICON_IMG' => ($subforum_data[$j]['forum_icon']) ? '<img src="' . $phpbb_root_path . $subforum_data[$j]['forum_icon'] . '" alt="'.$subforum_data[$j]['forum_name'].'" title="'.$subforum_data[$j]['forum_name'].'" />&nbsp;' : '', // Forum Icon Mod
				'POSTS' => $subforum_data[$j]['forum_posts'],
				'TOPICS' => $subforum_data[$j]['forum_topics'],
				'LAST_POST' => $last_post,
				'MODERATORS' => $moderator_list,
				'ID' => $subforum_data[$j]['forum_id'],
				'UNREAD' => intval($unread_topics),
				'LAST_POST_TIME' => $last_post_time,
				'L_MODERATOR' => $l_moderators,
				'L_FORUM_FOLDER_ALT' => $folder_alt,
				
				//---[+]---basit seo modu
				'U_VIEWFORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$subforum_id" .'-'. format_url($subforum_data[$j]['forum_name'])) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$subforum_id"),
				)
			);
		}
	}//end for
}
// End Simple Subforums MOD

$template->pparse('body');

// Page footer
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>