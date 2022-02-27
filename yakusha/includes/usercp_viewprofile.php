<?php
/***************************************************************************
* usercp_viewprofile.php
***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

if ( empty($HTTP_GET_VARS[POST_USERS_URL]) || $HTTP_GET_VARS[POST_USERS_URL] == ANONYMOUS )
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}
$profiledata = get_userdata($HTTP_GET_VARS[POST_USERS_URL]);

if (!$profiledata)
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}

$sql = "SELECT *
	FROM " . RANKS_TABLE . "
	ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

//
// Output page header and profile_view template
//
$template->set_filenames(array(
	'body' => 'profile_view_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

// Calculate the number of days this user has been a member ($memberdays)
// Then calculate their posts per day
$regdate = $profiledata['user_regdate'];
$memberdays = max(1, round( ( time() - $regdate ) / 86400 ));
$posts_per_day = $profiledata['user_posts'] / $memberdays;
$last_visit_time = (!empty($profiledata['user_lastvisit'])) ? create_date($lang['DATE_FORMAT'], $profiledata['user_lastvisit'], $board_config['board_timezone']) : $lang['Never'];

// Get the users percentage of total posts
if ( $profiledata['user_posts'] != 0  )
{
	$total_posts = get_db_stat('postcount');
	$percentage = ( $total_posts ) ? min(100, ($profiledata['user_posts'] / $total_posts) * 100) : 0;
}
else
{
	$percentage = 0;
}

$sql = "SELECT COUNT(topic_id) AS topics
	FROM ". TOPICS_TABLE ."
	WHERE topic_poster = '". $profiledata['user_id'] ."'";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, "Could not count topics", '', __LINE__, __FILE__, $sql);
}
$topics = $db->sql_fetchrow($result);
$poster_topics = ( $topics['topics'] == 0 ) ? $lang['None'] : $topics['topics'];

$topics_per_day = $topics['topics'] / $memberdays;
if ( $topics['topics'] != 0 )
{
	$total_topics = get_db_stat('topiccount');
	$topic_perc = ( $total_topics ) ? min(100, ($topics['topics'] / $total_topics) * 100) : 0;
}
else
{
	$topic_perc = 0;
}

$avatar_img = '';
if ( $profiledata['user_avatar_type'] && $poster_id != ANONYMOUS && $profiledata['user_allowavatar'] )
{
	switch( $profiledata['user_avatar_type'] )
	{
		case USER_AVATAR_UPLOAD:
			$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			break;
		case USER_AVATAR_REMOTE:
			if ( $board_config['allow_avatar_remote'] )
			{
				$avatar_url = $profiledata['user_avatar'];

				$avatar_status = check_avatar($avatar_url);
				if ($avatar_status === FALSE)
				{
					$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="images/avatar_yok.gif" alt="" border="0" />' : '';
				}
				else if ($avatar_status === TRUE)
				{
					if ( ($profiledata['user_avatar_height'] && $profiledata['user_avatar_height'] > 0) &&
							($profiledata['user_avatar_width'] && $profiledata['user_avatar_width'] > 0) )
					{
						$avatar_img = '<img src="' . $avatar_url  . '" height="' . $profiledata['user_avatar_height'] . '" width="' . $profiledata['user_avatar_width'] . '" alt="" border="0" />';
					}
					else  // No width/height in the user's profile
					{
						$avatar_img = '<img src="' . $avatar_url  . '" alt="" border="0" />';
					}
				}
			}
			else  // remote avatars not allowed
			$avatar_img = '';
			break;
		case USER_AVATAR_GALLERY:
			$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			break;
	}
}

// Default avatar MOD, By Manipe (Begin)
if ((!$avatar_img) && ($board_config['default_avatar_set'] != 3))
{
	if (($board_config['default_avatar_set'] == 0) && ($poster_id == -1) && ($board_config['default_avatar_guests_url']))
	{
		$avatar_img = '<img src="' . $board_config['default_avatar_guests_url'] . '" alt="" border="0" />';
	}
	else if (($board_config['default_avatar_set'] == 1) && ($poster_id != -1) && ($board_config['default_avatar_users_url']) )
	{
		$avatar_img = '<img src="' . $board_config['default_avatar_users_url'] . '" alt="" border="0" />';
	}
	else if ($board_config['default_avatar_set'] == 2)
	{
		if (($poster_id == -1) && ($board_config['default_avatar_guests_url']))
		{
			$avatar_img = '<img src="' . $board_config['default_avatar_guests_url'] . '" alt="" border="0" />';
		}
		else if (($poster_id != -1) && ($board_config['default_avatar_users_url']))
		{
			$avatar_img = '<img src="' . $board_config['default_avatar_users_url'] . '" alt="" border="0" />';
		}
	}
}
// Default avatar MOD, By Manipe (End)

$poster_rank = '';
$rank_image = '';
if ( $profiledata['user_rank'] )
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_rank'] == $ranksrow[$i]['rank_id'] && $ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}
else
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_posts'] >= $ranksrow[$i]['rank_min'] && !$ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}

$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=" . $profiledata['user_id']);
$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

if ( !empty($profiledata['user_viewemail']) || $userdata['user_level'] == ADMIN  || $userdata['user_level'] == MOD )
{
	$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $profiledata['user_id']) : 'mailto:' . $profiledata['user_email'];
	$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
	$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
}
else
{
	$email_img = '&nbsp;';
	$email = '&nbsp;';
}

// CBACK WebSite Censor Mod
$orig_word = array();
$replacement_word = array();
obtain_word_list($orig_word, $replacement_word);

$webcensored = $profiledata['user_website'];

if ( count($orig_word) )
{
	$webcensored = preg_replace($orig_word, $replacement_word, $webcensored);
}

$www_img = ( $webcensored ) ? '<a href="' . $webcensored . '"'. add_nofollow($webcensored) .' target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
$www = ( $webcensored ) ? '<a href="' . $webcensored . '"'. add_nofollow($webcensored) .' target="_userwww">' . $webcensored . '</a>' : '';

if ( !empty($profiledata['user_icq']) )
{
	$icq_status_img = '<a href="http://wwp.icq.com/' . $profiledata['user_icq'] . '#pager"><img src="http://web.icq.com/whitepages/online?icq=' . $profiledata['user_icq'] . '&img=5" width="18" height="18" border="0" /></a>';
	$icq_img = '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '"><img src="' . $images['icon_icq'] . '" alt="' . $lang['ICQ'] . '" title="' . $lang['ICQ'] . '" border="0" /></a>';
	$icq =  '<a href="http://wwp.icq.com/scripts/search.dll?to=' . $profiledata['user_icq'] . '">' . $lang['ICQ'] . '</a>';
}
else
{
	$icq_status_img = '&nbsp;';
	$icq_img = '&nbsp;';
	$icq = '&nbsp;';
}

$aim_img = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?"><img src="' . $images['icon_aim'] . '" alt="' . $lang['AIM'] . '" title="' . $lang['AIM'] . '" border="0" /></a>' : '&nbsp;';
$aim = ( $profiledata['user_aim'] ) ? '<a href="aim:goim?screenname=' . $profiledata['user_aim'] . '&amp;message=Hello+Are+you+there?">' . $lang['AIM'] . '</a>' : '&nbsp;';

$msn_img = ( $profiledata['user_msnm'] ) ? $profiledata['user_msnm'] : '&nbsp;';
$msn = $msn_img;

$yim_img = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg"><img src="' . $images['icon_yim'] . '" alt="' . $lang['YIM'] . '" title="' . $lang['YIM'] . '" border="0" /></a>' : '';
$yim = ( $profiledata['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target=' . $profiledata['user_yim'] . '&amp;.src=pg">' . $lang['YIM'] . '</a>' : '';

$groupdata = array();
$sql = "SELECT g.group_id, g.group_name, g.group_type
	FROM " . GROUPS_TABLE . " g, " . USER_GROUP_TABLE . " ug
	WHERE ug.user_id = {$profiledata['user_id']}
		AND g.group_id = ug.group_id 
		AND g.group_single_user <> " . TRUE . "
	ORDER BY g.group_name, g.group_id";
if ( !$result = $db->sql_query($sql) )
{
	message_die(GENERAL_ERROR, 'Could not group membership information', '', __LINE__, __FILE__, $sql);
}
while($row = $db->sql_fetchrow($result))
{
	$groupdata[] = $row;
}
$db->sql_freeresult($result);
$group_options = '';
for($i = 0; $i < sizeof($groupdata); $i++)
{
	if($groupdata[$i]['group_type'] != GROUP_HIDDEN || $userdata['user_id'] == $profiledata['user_id'] || $userdata['user_level'] != USER )
	{
		$group_options .= '<option value="' . $groupdata[$i]['group_id'] . '">' . $groupdata[$i]['group_name'] . '</option>';
	}
}
if(!$group_options)
{
		$group_options .= '<option value="">' . $lang['no_group_membership'] . '</option>';
}
$group_dropdown = '<select name="' . POST_GROUPS_URL . '">' . $group_options . '</select>';
unset($group_options);
unset($groupdata);

// BEGIN Advanced_Report_Hack
$s_report_user = '';
if ($userdata['user_id'] != ANONYMOUS)
{
	$temp_url = append_sid("report.$phpEx?mode=reportuser&amp;id=" . $profiledata['user_id']);
	$s_report_user = '<a href="' . $temp_url . '" class="gen">' . $lang['Report_user'] . '</a>';
}
// END Advanced_Report_Hack

$user_sig = '';
if ( $profiledata['user_attachsig'] && $board_config['allow_sig'] )
{
    include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
    $user_sig = $profiledata['user_sig'];
    $user_sig_bbcode_uid = $profiledata['user_sig_bbcode_uid'];
	if ( $user_sig != '' )
    {
        if ( !$board_config['allow_html'] && $profiledata['user_allowhtml'] )
       	{
       		$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
       	}
    	if ( $board_config['allow_bbcode'] && $user_sig_bbcode_uid != '' )
   		{
   			$user_sig = ( $board_config['allow_bbcode'] ) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $user_sig);
   		}
   		$user_sig = make_clickable($user_sig);

        if (!$userdata['user_allowswearywords'])
        {
            $orig_word = array();
            $replacement_word = array();
            obtain_word_list($orig_word, $replacement_word);
            $user_sig = preg_replace($orig_word, $replacement_word, $user_sig);
        }
        if ( $profiledata['user_allowsmile'] )
        {
            $user_sig = smilies_pass($user_sig);
        }
        $user_sig = str_replace("\n", "\n<br />\n", $user_sig);
    }
    $template->assign_block_vars('switch_user_sig_block', array());
}

//
// Generate page
//
$page_title = ucfirst(sprintf($lang['About_user'], $profiledata['username']));
$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("profile.php?mode=viewprofile&amp;u=$profiledata[user_id]").'">';
include($phpbb_root_path . 'includes/page_header.'.$phpEx);
display_upload_attach_box_limits($profiledata['user_id']);

if (function_exists('get_html_translation_table'))
{
	$u_search_author = urlencode(strtr($profiledata['username'], array_flip(get_html_translation_table(HTML_ENTITIES))));
}
else
{
	$u_search_author = urlencode(str_replace(array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;'), array('&', "'", '"', '<', '>'), $profiledata['username']));
}

$template->assign_vars(array(
	'USERNAME' => color_group_colorize_name($profiledata['user_id'],true),
	'JOINED' => create_date($lang['DATE_FORMAT'], $profiledata['user_regdate'], $board_config['board_timezone']),
	'POSTER_RANK' => $poster_rank,
	'RANK_IMAGE' => $rank_image,
	'POSTS_PER_DAY' => $posts_per_day,
	'POSTS' => $profiledata['user_posts'],
	'PERCENTAGE' => $percentage . '%',
	'POST_DAY_STATS' => sprintf($lang['User_post_day_stats'], $posts_per_day),
	'POST_PERCENT_STATS' => sprintf($lang['User_post_pct_stats'], $percentage),

	'L_TOTAL_TOPICS' => $lang['Total_topics_user'],
	'TOPIC_PERC' => $topic_perc . '%',
	'TOPICS' => $poster_topics,
	'TOPICS_DAY_STATS' => sprintf($lang['User_topic_day_stats'], $topics_per_day),
	'TOPICS_PERCENT_STATS' => sprintf($lang['User_topic_pct_stats'], $topic_perc),
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

	'LOCATION' => ( $profiledata['user_from'] ) ? $profiledata['user_from'] : '&nbsp;',
	'OCCUPATION' => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : '&nbsp;',
	'INTERESTS' => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : '&nbsp;',
	'USER_SIG' => $user_sig,

	'AVATAR_IMG' => $avatar_img,

	'L_SIGNATURE' => $lang['Signature'],
	'L_WIEWPROFILE' => $lang['Profile'],
	'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], color_group_colorize_name($profiledata['user_id'],true)),
	'L_ABOUT_USER' => ucfirst(sprintf($lang['About_user'], $profiledata['username'])),
	'L_AVATAR' => $lang['Avatar'],
	'L_LAST_VISITED' => $lang['Last_Visited'],
	'LAST_VISIT_TIME' => $last_visit_time,
	'L_POSTER_RANK' => $lang['Poster_rank'],
	'L_JOINED' => $lang['Joined'],
	'L_TOTAL_POSTS' => $lang['Total_posts'],
	'U_SEARCH_USER' => append_sid("search.$phpEx?search_author=" . $u_search_author),
	'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], $profiledata['username']),
	'L_SEARCH_USER_TOPICS' => sprintf($lang['Search_user_topics'], $profiledata['username']),
	'U_SEARCH_USER_TOPICS' => append_sid("search.$phpEx?search_id=usertopics&amp;user_id=" . $profiledata['user_id']),
	'L_CONTACT' => $lang['Contact'],
	'L_EMAIL_ADDRESS' => $lang['Email_address'],
	'L_EMAIL' => $lang['Email'],
	'L_PM' => $lang['Private_Message'],
	'L_ICQ_NUMBER' => $lang['ICQ'],
	'L_YAHOO' => $lang['YIM'],
	'L_AIM' => $lang['AIM'],
	'L_MESSENGER' => $lang['MSNM'],
	'L_WEBSITE' => $lang['Website'],
	'L_LOCATION' => $lang['Location'],
	'L_OCCUPATION' => $lang['Occupation'],
	'L_INTERESTS' => $lang['Interests'],
	'L_GROUP_MEMBERSHIP' => $lang['Group_membership'],
	'L_GROUP_GO' => $lang['Go'],
	'GROUP_DROPDOWN' => $group_dropdown,

	'S_REPORT_USER' => $s_report_user,
	'S_PROFILE_ACTION' => append_sid("profile.$phpEx"))
);

//ortak kullaným için bir üst satýra çýkarttým
$sql = 'SELECT ban_userid   
	FROM ' . BANLIST_TABLE . ' 
	WHERE ban_userid = ' . $profiledata['user_id'];

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not look up banned status', '', __LINE__, __FILE__, $sql);
}

if ( $row = $db->sql_fetchrow($result) )
{
	$banned_username = $row['ban_userid'];
}

$db->sql_freeresult($result);
	
// Start Quick Administrator User Options and Information MOD
if ( $userdata['user_level'] == ADMIN )
{
	$template->assign_block_vars('switch_user_admin', array());


	$sql = 'SELECT ban_email  
		FROM ' . BANLIST_TABLE . ' 
		WHERE ban_email = "' . $profiledata['user_email'] . '"';

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not look up banned status', '', __LINE__, __FILE__, $sql);
	}
	
	if ( $row = $db->sql_fetchrow($result) )
	{
		$banned_email = $row['ban_email'];
	}

	$db->sql_freeresult($result);
	
	if ( $userdata['session_admin'] )
	{
		$u_edit_profile = "admin/admin_users.$phpEx?" . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=edit&amp;returntoprofile=1&amp;sid=' . $userdata['session_id'];
		$u_edit_permissions = "admin/admin_ug_auth.$phpEx?" . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=user&amp;returntoprofile=1&amp;sid=' . $userdata['session_id'];
	}
	
	else
	{
		$u_edit_profile = append_sid("login.$phpEx?redirect=admin/admin_users.$phpEx&amp;" . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=edit&amp;returntoprofile=1&amp;admin=1');
		$u_edit_permissions = append_sid("login.$phpEx?redirect=admin/admin_ug_auth.$phpEx&amp;" . POST_USERS_URL . '=' . $profiledata['user_id'] . '&amp;mode=user&amp;returntoprofile=1&amp;admin=1');
	}
	
	$template->assign_vars(array(
		'L_QUICK_ADMIN_OPTIONS' => $lang['Quick_admin_options'],
		'L_ADMIN_EDIT_PROFILE' => $lang['Admin_edit_profile'],
		'L_ADMIN_EDIT_PERMISSIONS' => $lang['Admin_edit_permissions'],
		'L_USER_ACTIVE_INACTIVE' => ( $profiledata['user_active'] ) ? $lang['User_active'] : $lang['User_not_active'],
		'L_BANNED_USERNAME' => ( $banned_username ) ? $lang['Username_banned'] : $lang['Username_not_banned'],
		'L_BANNED_EMAIL' => ( $banned_email ) ? sprintf($lang['User_email_banned'], $profiledata['user_email']) : $lang['User_email_not_banned'],
	
		'U_ADMIN_EDIT_PROFILE' => $u_edit_profile,
		'U_ADMIN_EDIT_PERMISSIONS' => $u_edit_permissions,
	));
}
// End Quick Administrator User Options and Information MOD

// allow mods ban permission
if ( ($userdata['user_level'] == MOD || $userdata['user_level'] == ADMIN) && ($profiledata['user_level'] == USER ) && $profiledata['user_id'] > 1 && $board_config['allow_mods_ban'])
{
	$template->assign_vars(array('U_MOD_BAN_USER' => ( $banned_username ) ? "<a href=ban.php?mode=unban&amp;" . POST_USERS_URL . "=" . $profiledata['user_id'] . "&amp;sid=" . $userdata['session_id']. "><font color=\"red\"><b>". $lang['Unban_this_user'] ."</b></font></a>" : "<a href=ban.php?mode=ban&amp;" . POST_USERS_URL . "=" . $profiledata['user_id'] . "&amp;sid=" . $userdata['session_id']. "><font color=\"red\"><b>". $lang['Ban_this_user'] ."</b></font></a></a>"));
}
// allow mods ban permission

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>