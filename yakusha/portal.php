<?php
/***************************************************************************
* portal.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/fetchposts.'.$phpEx);
include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_PORTAL);
init_userprefs($userdata);

$total_posts = get_db_stat('postcount');
$total_topics = get_db_stat('topiccount');
$newest_userdata = get_db_stat('newestuser');
$total_users = get_db_stat('usercount');
$newest_user = $newest_userdata['username'];
$newest_uid = $newest_userdata['user_id'];
$total_posters = get_db_stat('total_posters');

$l_total_post_s = $lang['Posted_articles_total_portal'];
$l_total_user_s = $lang['Registered_users_total_portal'];

// Read Portal Configuration from DB
$CFG = array();
$sql = "SELECT * FROM " . PORTAL_TABLE;

if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$CFG[$row['portal_name']] = $row['portal_value'];
}

// Recent Topics
$sql = "SELECT * FROM ". FORUMS_TABLE . " ORDER BY forum_id";
if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
}
$forum_data = array();
while( $row = $db->sql_fetchrow($result) )
{
	$forum_data[] = $row;
}

$is_auth_ary = array();
$is_auth_ary = auth(AUTH_ALL, AUTH_LIST_ALL, $userdata, $forum_data);

if( $CFG['exceptional_forums'] == '' )
{
	$except_forum_id = '\'start\'';
}
else
{
	$except_forum_id = $CFG['exceptional_forums'];
}

for ($i = 0; $i < count($forum_data); $i++)
{
	if ((!$is_auth_ary[$forum_data[$i]['forum_id']]['auth_read']) or (!$is_auth_ary[$forum_data[$i]['forum_id']]['auth_view']))
	{
		if ($except_forum_id == '\'start\'')
		{
			$except_forum_id = $forum_data[$i]['forum_id'];
		}
		else
		{
			$except_forum_id .= ',' . $forum_data[$i]['forum_id'];
		}
	}
}
$sql = "SELECT t.topic_id, t.topic_title, t.topic_last_post_id, t.forum_id, p.post_id, p.poster_id, p.post_time, u.user_id, u.username
		FROM " . TOPICS_TABLE . " AS t, " . POSTS_TABLE . " AS p, " . USERS_TABLE . " AS u
		WHERE t.forum_id NOT IN (" . $except_forum_id . ")
			AND t.topic_status <> 2
			AND p.post_id = t.topic_last_post_id
			AND p.poster_id = u.user_id
		ORDER BY p.post_id DESC
		LIMIT " . $CFG['number_recent_topics'];
if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, 'Could not query recent topics information', '', __LINE__, __FILE__, $sql);
}
$number_recent_topics = $db->sql_numrows($result);
$recent_topic_row = array();
while ($row = $db->sql_fetchrow($result))
{
	$recent_topic_row[] = $row;
}
for ($i = 0; $i < $number_recent_topics; $i++)
{
	// define censored word matches
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);

	// censor text and title
	if (count($orig_word))
	{
		$recent_topic_row[$i]['topic_title'] = preg_replace($orig_word, $replacement_word, $recent_topic_row[$i]['topic_title']);
	}
	$recent_topic_row[$i]['topic_title'] = nl2br($recent_topic_row[$i]['topic_title']);

	$template->assign_block_vars('recent_topic_row', array(
		'U_TITLE' => append_sid("viewtopic.$phpEx?" . POST_POST_URL . '=' . $recent_topic_row[$i]['post_id']) . '#' .$recent_topic_row[$i]['post_id'],
		'L_TITLE' => $recent_topic_row[$i]['topic_title'],
		'U_POSTER' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $recent_topic_row[$i]['user_id']),
		'S_POSTER' => $recent_topic_row[$i]['username'],
		'S_POSTTIME' => create_date($board_config['default_dateformat'], $recent_topic_row[$i]['post_time'], $board_config['board_timezone'])
		)
	);
}
//
// END - Recent Topics
//

if( $userdata['session_logged_in'] )
{
	$sql = "SELECT COUNT(post_id) as total
			FROM " . POSTS_TABLE . "
			WHERE post_time >= " . $userdata['user_lastvisit'];
	$result = $db->sql_query($sql);
	if( $result )
	{
		$row = $db->sql_fetchrow($result);
		$lang['Search_new'] = $lang['Search_new'] . "&nbsp;(" . $row['total'] . ")";
	}
}

//
// Start output of page
//
define('SHOW_ONLINE', true);
//$page_title = $lang['Home'];
$page_title = $board_config['sitename'] .' :: '. $board_config['site_desc'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(	'body' => 'portal_body.tpl'));

//  ezPortal Canli Istatistik
$today_registered_users = 0;
$yesterday_registered_users = 0;

$today_time = time();
$yesterday_time = $today_time - 86400;

$day = create_date('d', $yesterday_time, $userdata['user_timezone']);
$month = create_date('m', $yesterday_time, $userdata['user_timezone']);
$year = create_date('Y', $yesterday_time, $userdata['user_timezone']);

$y_day_from = strtotime($year.'-'.$month.'-'.$day.' 00:00:00');

$day = create_date('d', $today_time, $userdata['user_timezone']);
$month = create_date('m', $today_time, $userdata['user_timezone']);
$year = create_date('Y', $today_time, $userdata['user_timezone']);

$t_day_from = strtotime($year.'-'.$month.'-'.$day.' 00:00:00');

$sql = "SELECT count(distinct user_id) as total_users 
	FROM " . USERS_TABLE . "
	WHERE user_regdate >= $y_day_from
		AND user_regdate < $t_day_from
		AND user_id <> " . ANONYMOUS;
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not get yesterday registered users', '', __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$yesterday_registered_users = $row['total_users'];
}

$db->sql_freeresult($result);

$sql = "SELECT count(distinct user_id) as total_users 
	FROM " . USERS_TABLE . "
	WHERE user_regdate >= $t_day_from
		AND user_id <> " . ANONYMOUS;
if ( !$result = $db->sql_query($sql) )
{
message_die(GENERAL_ERROR, 'Could not get today registered users', '', __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$today_registered_users = $row['total_users'];
}

$db->sql_freeresult($result);

$visit_counter = $board_config['visit_counter'];

if( $userdata['session_start'] >= (time() - 1) )
{
$sql = "UPDATE " . CONFIG_TABLE . "
	SET config_value = '" . ($visit_counter + 1) . "'
	WHERE config_name = 'visit_counter'";
if( !($result = $db->sql_query($sql)) )
{
	//message_die(GENERAL_ERROR, 'Could not update counter information', '', __LINE__, __FILE__, $sql);
}
$visit_counter++;
}
$members_img = '<img src="images/live_statistics/icon_profile.gif" alt="' . $lang['Live_Members'] . '" title="' . $lang['Live_Members'] . '" /></a>';
$group_img = '<img src="images/live_statistics/icon_group.gif" alt="' . $lang['Live_Online_Now'] . '" title="' . $lang['Live_Online_Now'] . '" /></a>';
$regged_img = '<img src="images/live_statistics/icon_regged.gif" alt="' . $lang['Live_Online_Members'] . '" title="' . $lang['Live_Online_Members'] . '" /></a>';
$hits_img = '<img src="images/live_statistics/icon_hits.gif" alt="' . $lang['Live_Stats'] . '" title="' . $lang['Live_Stats'] . '" /></a>';

$moderator_img = '<img src="images/live_statistics/ur-moderator.gif" alt="' . $lang['Live_Latest'] . '" title="' . $lang['Live_Latest'] . '" /></a>';
$author_img = '<img src="images/live_statistics/ur-author.gif" alt="' . $lang['Live_New_Today'] . '" title="' . $lang['Live_New_Today'] . '" /></a>';
$admin_img = '<img src="images/live_statistics/ur-admin.gif" alt="' . $lang['Live_New_Yesterday'] . '" title="' . $lang['Live_New_Yesterday'] . '" /></a>';
$member_img = '<img src="images/live_statistics/ur-member.gif" alt="' . $lang['Live_Overall'] . '" title="' . $lang['Live_Overall'] . '" /></a>';
$posters_img = '<img src="images/live_statistics/ur-posters.gif" alt="' . $lang['Live_Total_Posters'] . '" title="' . $lang['Live_Total_Posters'] . '" /></a>';

$members_2_img = '<img src="images/live_statistics/ur-members.gif" alt="' . $lang['Live_Members'] . '" title="' . $lang['Live_Members'] . '" /></a>';
$guest_img = '<img src="images/live_statistics/ur-guest.gif" alt="' . $lang['Live_Guests'] . '" title="' . $lang['Live_Guests'] . '" /></a>';
$hidden_img = '<img src="images/live_statistics/ur-hidden.gif" alt="' . $lang['Live_Hidden'] . '" title="' . $lang['Live_Hidden'] . '" /></a>';
//  ezPortal Canli Istatistik

//-- [+] MOD: Kullanýcý Menüsü ------------------------------------------
//-- add
//
if( $userdata['session_logged_in'] ) 
{
	$user_private_message = $userdata['user_new_privmsg'];
	$unread_private_message = ( $userdata['user_new_privmsg'] + $userdata['user_unread_privmsg'] );
	$user_watched_topics = get_db_stat('userwatched');
	$total_user_topics = get_db_stat('usertopics');
	$total_user_replies = ( $userdata['user_posts'] - $total_user_topics );
	$total_new_posts = get_db_stat('newposttotal');
	$total_new_topics = get_db_stat('newtopictotal');
	$total_new_replies = ( $total_new_posts - $total_new_topics );
	$new_announcement_posts = get_db_stat('newannouncementtotal');
	$total_announcement_posts = get_db_stat('announcementtotal');
	$new_sticky_posts = get_db_stat('newstickytotal');
	$total_sticky_posts = get_db_stat('stickytotal');
}

// User Rank Portal Mod 
$sql = "SELECT * FROM " . RANKS_TABLE . " ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) ) 
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
} 

while ( $row = $db->sql_fetchrow($result) ) 
{ 
	$ranksrow[] = $row;
} 
$db->sql_freeresult($result); 
 
$poster_rank_ind = ''; 
$rank_image_ind = ''; 
if ( $userdata['user_rank'] ) 
{ 
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $userdata['user_rank'] == $ranksrow[$i]['rank_id'] && $ranksrow[$i]['rank_special'] )
		{
			$poster_rank_ind = $ranksrow[$i]['rank_title'];
			$rank_image_ind = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}
else
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $userdata['user_posts'] >= $ranksrow[$i]['rank_min'] && !$ranksrow[$i]['rank_special'] )
		{
			$poster_rank_ind = $ranksrow[$i]['rank_title'];
			$rank_image_ind = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}
//
// END - User Rank Portal Mod
//

// Check For Anonymous User
$avatar_img = '';
if ( $userdata['user_avatar_type'] && $userdata['user_allowavatar'] )
{
	switch( $userdata['user_avatar_type'] )
	{
		case USER_AVATAR_UPLOAD:
			$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $userdata['user_avatar'] . '" alt="" border="0" />' : '';
			break;
		case USER_AVATAR_REMOTE:
			if ( $board_config['allow_avatar_remote'] )
			{
			$avatar_url = $userdata['user_avatar'];

			$avatar_status = check_avatar($avatar_url);
			if ($avatar_status === FALSE)
			{
				$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="images/avatar_yok.gif" alt="" border="0" />' : '';
			}
			else if ($avatar_status === TRUE)
			{
				if ( ($userdata['user_avatar_height'] && $userdata['user_avatar_height'] > 0) &&
					($userdata['user_avatar_width'] && $userdata['user_avatar_width'] > 0) )
				{
					$avatar_img = '<img src="' . $avatar_url . '" height="' . $userdata['user_avatar_height'] . '" width="' . $userdata['user_avatar_width'] . '" alt="" border="0" />';
				}
				else // No width/height in the user's profile
				{
					$avatar_img = '<img src="' . $avatar_url . '" alt="" border="0" />';
				}
			}
			}
			else // remote avatars not allowed
			$avatar_img = '';
			break;
		case USER_AVATAR_GALLERY:
			$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $userdata['user_avatar'] . '" alt="" border="0" />' : '';
			break;
	}
}


$name_link = color_group_colorize_name($userdata['user_id'], false);
//-- [-] MOD: Kullanýcý Menüsü ------------------------------------------

//
// Staff Block
//
$sql = "SELECT * FROM " . USERS_TABLE."
    WHERE user_level > " . USER . "
    ORDER BY user_level";
if ( !($results = $db->sql_query($sql)) )
{
    message_die(GENERAL_ERROR, 'Could not get staff information', '', __LINE__, __FILE__, $sql);
}
while($db_select = $db->sql_fetchrow($results))
{

	if ( $db_select['user_allow_viewonline'] == 0) 
	{ 
	if ($userdata['user_level'] == ADMIN OR $userdata['user_level'] == MOD)	
	{
		$online_status = $lang['SB_Hidden'] . '<img src="images/icon_hidden.gif" border="0">'; 
	} 
	else
	{
		$online_status = $lang['SB_Hidden'] . '<img src="images/icon_offline.gif" border="0">'; 
	}
	} 
	else if ( $db_select['user_session_time'] >= ( time() - 300 )) 
	{ 
		$online_status = $lang['SB_Online'] . '<img src="images/icon_online.gif" border="0">'; 
	} 
	else 
	{ 
		$online_status = $lang['SB_Offline'] . '<img src="images/icon_offline.gif" border="0">'; 
	}

	//$u_name = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$db_select[user_id]");
	$l_name = $db_select[username];
	$template->assign_block_vars('staff', array(
		'USER_URL' => color_group_colorize_name($db_select['user_id'], false),
		'ONLINE_STATUS' => $online_status
		)
	);
}

// En Aktif Üyeler
$total_poster = '10'; // görüntülenecek üye sayisi
// sadece üyeleri göstersin isterseniz
// WHERE user_id <> " . ANONYMOUS . " AND user_level = 0
$sql = "SELECT username, user_id,  user_posts
        FROM " . USERS_TABLE . "
        WHERE user_id <> " . ANONYMOUS . "
        ORDER BY user_posts DESC LIMIT $total_poster";
if( !($result = $db->sql_query($sql)) )
{
        message_die(GENERAL_ERROR, 'Could not query users', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
        $i = 0;
        do
        {
                $username = $row['username'];
                $user_id = $row['user_id'];
                $posts = ( $row['user_posts'] ) ? $row['user_posts'] : 0;
                $template->assign_block_vars('topposter', array(
                        'USERNAME' => $username,
                        'POSTS' => $posts,
                        'U_VIEWPOSTER' => color_group_colorize_name($user_id, false)
						)
                );
                $i++;
        }
        while ( $row = $db->sql_fetchrow($result) );
}
//--- [ - ] ---- En Aktif Üyeler


$template->assign_vars(array(
	'WELCOME_TEXT' => $CFG['welcome_text'],
	'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),
	'TOTAL_USERS' => sprintf($l_total_user_s, $total_users),
	'TOTAL_TOPICS' => sprintf($lang['total_topics'], $total_topics),
	'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),

	//  ezPortal Canli Istatistik
	'NEWEST_USER' => sprintf($lang['Newest_user_portal'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'),
	'TOTAL_POSTERS' => sprintf( $lang['Total_posters'], $total_posters),
	'TOTAL_TOPICS' => sprintf($lang['Total_topics'], $total_topics),
	'TODAY_USERS' => $today_registered_users,
	'TOTAL_HIDDEN_USERS' => $logged_hidden_online,
	'YESTERDAY_USERS' => $yesterday_registered_users,
	'GUESTS_ONLINE' => $guests_online,
	'REGGED_ONLINE' => $logged_visible_online,
	'LOGGED_IN_USER_LIST_P' => $online_userlistp,
	'VISIT_COUNTER_P' => sprintf($lang['Visit_counter_portal'], $visit_counter),
	//  ezPortal Canli Istatistik

	'WACHED_TOTAL' => $wached_total,
	'POSTS_PER_DAY' => $posts_per_day,
	'POSTS_PER_USER' => $posts_per_user,
	'TOPICS_PER_DAY' => $topics_per_day,
	'NEW_USER' => sprintf($lang['New_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'),
	'USERS_PER_DAY' => $users_per_day,
	'TOTAL_TOPICCOUNT' => $total_topics,
	'L_TOTAL_TOPICCOUNT' => $lang['Total_topiccount'],
	'L_WACHED_TOTAL' => $lang['Wached_total'],
	'L_POSTS_PER_DAY' => $lang['Posts_per_day'],
	'L_TOPICS_PER_DAY' => $lang['Topics_per_day'],
	'L_USERS_PER_DAY' => $lang['Users_per_day'],
	'L_POSTS_PER_USER' => $lang['Posts_per_user'],

	'L_FORUM' => $lang['Forum'],
	'L_BOARD_NAVIGATION' => $lang['Board_navigation'],
	'L_STATISTICS' => $lang['Statistics'],
	'L_ANNOUNCEMENT' => $lang['Post_Announcement'],
	'L_POSTED' => $lang['Posted'],
	'L_COMMENTS' => $lang['Comments'],
	'L_VIEW_COMMENTS' => $lang['View_comments'],
	'L_POST_COMMENT' => $lang['Post_your_comment'],
	'L_VIEW_COMPLETE_LIST' => $lang['View_complete_list'],
	'L_POLL' => $lang['Poll'],
	'L_VOTE_BUTTON' => $lang['Vote'],
	// Top Poster
	'L_TOP_POSTER' => $lang['Top_poster'],

	//  ezPortal Canli Istatistik
	// Staff Block
	'SB_WEBMASTER' => $lang['SB_Webmaster'],
	'SB_NAME' => $lang['SB_Name'],
	'SB_LEVEL' => $lang['SB_Level'],
	'SB_STATUS' => $lang['SB_Status'],

	'L_LIVE_STATISTICS' => $lang['Live_Statistics'],
	'L_MEMBERS' => $lang['Live_Members'],
	'L_LATEST' => $lang['Live_Latest'],
	'L_NEW_TODAY' => $lang['Live_New_Today'],
	'L_NEW_YESTERDAY' => $lang['Live_New_Yesterday'],
	'L_MEMBERS_OVERALL' => $lang['Live_Overall'],
	'L_ONLINE_NOW' => $lang['Live_Online_Now'],
	'L_GUESTS' => $lang['Live_Guests'],
	'L_HIDDEN' => $lang['Live_Hidden'],
	'L_STATS' => $lang['Live_Stats'],
	'L_USER_RECORD' => $lang['Live_User_Record'],
	'L_TOTAL_TOPICS' => $lang['Live_Total_Topics'],
	'L_TOTAL_POSTS' => $lang['Live_Total_Posts'],
	'L_TOTAL_POSTERS' => $lang['Live_Total_Posters'],
	'L_VISIT_COUNTER' => $lang['Live_Visit_Counter'],
	'L_ONLINE_MEMBERS' => $lang['Live_Online_Members'],
	//  ezPortal Canli Istatistik
	
	//-- [+] MOD: Kullanýcý Menüsü ------------------------------------------
	'RANK_NAME_IND' => $poster_rank_ind,
	'RANK_IMG_IND' => $rank_image_ind,

	'L_NAME_WELCOME' => $lang['Welcome'],
	'U_NAME_LINK' => $name_link,
	'AVATAR_IMG' => $avatar_img,

	//  ezPortal Canli Istatistik
	'MEMBERS_IMG' => $members_img,
	'GROUP_IMG' => $group_img,
	'REGGED_IMG' => $regged_img,
	'HITS_IMG' => $hits_img,
	'MODERATOR_IMG' => $moderator_img,
	'AUTHOR_IMG' => $author_img,
	'ADMIN_IMG' => $admin_img,
	'MEMBER_IMG' => $member_img,
	'POSTERS_IMG' => $posters_img,
	'MEMBERS_2_IMG' => $members_2_img,
	'GUEST_IMG' => $guest_img,
	'HIDDEN_IMG' => $hidden_img,
	//  ezPortal Canli Istatistik

	'S_USER_PRIVATE_MESSAGE' => $user_private_message,
	'S_UNREAD_PRIVATE_MESSAGE' => $unread_private_message,

	'S_USER_WATCHED_TOPICS' => $user_watched_topics,
	'S_USER_POSTS' => $userdata['user_posts'],
	'S_TOTAL_USER_TOPICS' => $total_user_topics,
	'S_TOTAL_USER_REPLIES' => $total_user_replies,
	'S_USER_UNANSWERED_POSTS' => $user_unanswered_posts,

	'S_TOTAL_NEW_POSTS' => $total_new_posts,
	'S_TOTAL_NEW_TOPICS' => $total_new_topics,
	'S_TOTAL_NEW_REPLIES' => $total_new_replies,
	'S_TOTAL_UNANSWERED_POSTS' => $total_unanswered_posts,
	'S_TOTAL_ANNOUNCEMENT_POSTS' => $total_announcement_posts,
	'S_NEW_ANNOUNCEMENT_POSTS' => $new_announcement_posts,
	'S_TOTAL_STICKY_POSTS' => $total_sticky_posts,
	'S_NEW_STICKY_POSTS' => $new_sticky_posts,

	'U_USER_WATCHED_TOPICS' => append_sid('search.'.$phpEx.'?search_id=watched'),
	'U_USER_POSTS' => append_sid('search.'.$phpEx.'?search_id=egosearch'),
	'U_TOTAL_USER_TOPICS' => append_sid('search.'.$phpEx.'?search_id=egotopics'),
	'U_TOTAL_USER_REPLIES' => append_sid('search.'.$phpEx.'?search_id=egoreplies'),
	'U_USER_UNANSWERED_POSTS' => append_sid('search.'.$phpEx.'?search_id=egounanswered'),

	'U_TOTAL_NEW_POSTS' => append_sid('search.'.$phpEx.'?search_id=newposts'),
	'U_TOTAL_NEW_TOPICS' => append_sid('search.'.$phpEx.'?search_id=newtopics'),
	'U_TOTAL_NEW_REPLIES' => append_sid('search.'.$phpEx.'?search_id=newreplies'),
	'U_TOTAL_ANNOUNCEMENT_POSTS' => append_sid('search.'.$phpEx.'?search_id=announce'),
	'U_NEW_ANNOUNCEMENT_POSTS' => append_sid('search.'.$phpEx.'?search_id=newannounce'),
	'U_TOTAL_STICKY_POSTS' => append_sid('search.'.$phpEx.'?search_id=sticky'),
	'U_NEW_STICKY_POSTS' => append_sid('search.'.$phpEx.'?search_id=newsticky'),

	'L_FMB_MENU' => $lang['FMB_menu'],
	'L_FMB_NEW' => $lang['FMB_new'],
	'L_FMB_UNREAD' => $lang['FMB_unread'],
	'L_FMB_SELF' => $lang['FMB_self'],

	'L_FMB_NEWPOSTS' => $lang['FMB_newposts'],
	'L_FMB_TOPIC' => $lang['FMB_topic'],
	'L_FMB_TOPICS' => $lang['FMB_topics'],
	'L_FMB_REPLIES' => $lang['FMB_replies'],
	'L_FMB_ANNOUNCE' => $lang['FMB_announce'],
	'L_FMB_STICKY' => $lang['FMB_sticky'],
	'L_FMB_TOP' => $lang['FMB_top'],

	'L_FMB_WATCHED' => $lang['FMB_watched'],
	//-- [-] MOD: Kullanýcý Menüsü ---------

	// Welcome Avatar
	'L_NAME_WELCOME' => $lang['Welcome'],
	'U_NAME_LINK' => $name_link,
	'AVATAR_IMG' => $avatar_img)
);

//
// Fetch Posts from Announcements Forum
//
if(!isset($HTTP_GET_VARS['article']))
{
	$template->assign_block_vars('welcome_text', array());

	$fetchposts = phpbb_fetch_posts($CFG['news_forum'], $CFG['number_of_news'], $CFG['news_length']);

	for ($i = 0; $i < count($fetchposts); $i++)
	{
		if( $fetchposts[$i]['striped'] == 1 )
		{
			$open_bracket = '[ ';
			$close_bracket = ' ]';
			$read_full = $lang['Read_Full'];
		}
		else
		{
			$open_bracket = '';
			$close_bracket = '';
			$read_full = '';
		}

		$topic_id = $fetchposts[$i]['topic_id'];
		$topic_title = $fetchposts[$i]['topic_title'];
		$template->assign_block_vars('fetchpost_row', array(
			'TITLE' => $fetchposts[$i]['topic_title'],
			'POSTER' => $fetchposts[$i]['username'],
			'TIME' => $fetchposts[$i]['topic_time'],
			'TEXT' => $fetchposts[$i]['post_text'],
			'REPLIES' => $fetchposts[$i]['topic_replies'],
			'U_VIEW_COMMENTS' => ($board_config['basit_seo_open']) ? append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id" .'-'. format_url($topic_title)) : append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
			'U_POST_COMMENT' => append_sid('posting.' . $phpEx . '?mode=reply&amp;t=' . $fetchposts[$i]['topic_id']),
			'U_READ_FULL' => append_sid('portal.' . $phpEx . '?article=' . $i),
			'L_READ_FULL' => $read_full,
			'OPEN' => $open_bracket,
			'CLOSE' => $close_bracket)
		);
	}
}
else
{
	$fetchposts = phpbb_fetch_posts($CFG['news_forum'], $CFG['number_of_news'], 0);

	$i = intval($HTTP_GET_VARS['article']);

	$template->assign_block_vars('fetchpost_row', array(
		'TITLE' => $fetchposts[$i]['topic_title'],
		'POSTER' => $fetchposts[$i]['username'],
		'TIME' => $fetchposts[$i]['topic_time'],
		'TEXT' => $fetchposts[$i]['post_text'],
		'REPLIES' => $fetchposts[$i]['topic_replies'],
		'U_VIEW_COMMENTS' => append_sid('viewtopic.' . $phpEx . '?t=' . $fetchposts[$i]['topic_id']),
		'U_POST_COMMENT' => append_sid('posting.' . $phpEx . '?mode=reply&amp;t=' . $fetchposts[$i]['topic_id'])
		)
	);
}
// END: Fetch Announcements

// Fetch Poll
$fetchpoll = phpbb_fetch_poll($CFG['poll_forum']);

if (!empty($fetchpoll))
{
	$template->assign_vars(array(		
		'S_POLL_QUESTION' => $fetchpoll['vote_text'],
		'S_POLL_ACTION' => append_sid('posting.'.$phpEx.'?'.POST_TOPIC_URL.'='.$fetchpoll['topic_id']),
		'S_TOPIC_ID' => $fetchpoll['topic_id'],
		'L_SUBMIT_VOTE' => $lang['Submit_vote'],
		'L_LOGIN_TO_VOTE' => $lang['Login_to_vote']		
		)
	);

	for ($i = 0; $i < count($fetchpoll['options']); $i++)
	{
		$template->assign_block_vars('poll_option_row', array(
			'OPTION_ID' => $fetchpoll['options'][$i]['vote_option_id'],
			'OPTION_TEXT' => $fetchpoll['options'][$i]['vote_option_text'],
			'VOTE_RESULT' => $fetchpoll['options'][$i]['vote_result'],
			)
		);
	}	
}
else
{
	$template->assign_vars(array(		
		'S_POLL_QUESTION' => $lang['No_poll'],
		'DISABLED' => 'disabled="disabled"'
		)
	);
}

//
// Generate the page
//
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>