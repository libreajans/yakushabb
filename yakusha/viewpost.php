<?php
/***************************************************************************
* viewpost.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_color_groups.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_report.'.$phpEx);


// Start initial var setup
if ( isset($HTTP_GET_VARS[POST_POST_URL]))
{
	$post_id = intval($HTTP_GET_VARS[POST_POST_URL]);
}

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

if (!$post_id)
{
	message_die(GENERAL_MESSAGE, 'No_posts_topic');
}

// This rather complex gaggle of code handles querying for topics but
// also allows for direct linking to a post (and the calculation of which
// page the post is on and the correct display of viewtopic)
$join_sql_table = (!$post_id) ? '' : ", " . POSTS_TABLE . " p, " . POSTS_TABLE . " p2 ";
$join_sql = (!$post_id) ? "t.topic_id = $topic_id" : "p.post_id = $post_id AND t.topic_id = p.topic_id AND p2.topic_id = p.topic_id AND p2.post_id <= $post_id";
$count_sql = (!$post_id) ? '' : ", COUNT(p2.post_id) AS prev_posts";

$order_sql = (!$post_id) ? '' : "GROUP BY p.post_id, t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments ORDER BY p.post_id ASC";

$sql = "SELECT t.topic_id, t.topic_title, t.topic_status, t.topic_replies, t.topic_time, t.topic_type, t.topic_vote, t.topic_last_post_id, f.forum_name, f.forum_status, f.forum_id, f.auth_view, f.auth_read, f.auth_post, f.auth_reply, f.auth_edit, f.auth_delete, f.auth_sticky, f.auth_announce, f.auth_pollcreate, f.auth_vote, f.auth_attachments" . $count_sql . "
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
$userdata = session_pagestart($user_ip, PAGE_VIEWPOST);
init_userprefs($userdata);

// Start auth check
$is_auth = array();
$is_auth = auth(AUTH_ALL, $forum_id, $userdata, $forum_topic_data);

if( !$is_auth['auth_view'] || !$is_auth['auth_read'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = ($post_id) ? POST_POST_URL . "=$post_id" : POST_TOPIC_URL . "=$topic_id";
		$redirect .= ($start) ? "&start=$start" : '';
		redirect(append_sid("login.$phpEx?redirect=viewtopic.$phpEx&$redirect", true));
	}

	$message = ( !$is_auth['auth_view'] ) ? $lang['Topic_post_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

	message_die(GENERAL_MESSAGE, $message);
}
// End auth check

$forum_name = $forum_topic_data['forum_name'];
$topic_title = $forum_topic_data['topic_title'];
$topic_id = intval($forum_topic_data['topic_id']);
$topic_time = $forum_topic_data['topic_time'];

if ($post_id)
{
	$start = floor(($forum_topic_data['prev_posts'] - 1) / intval($board_config['posts_per_page'])) * intval($board_config['posts_per_page']);
}


// Go ahead and pull all data for this topic
$sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, u.ct_miserable_user, p.*, pt.post_text, pt.post_subject, pt.bbcode_uid
	FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
	WHERE pt.post_id = p.post_id
		AND u.user_id = p.poster_id
		AND $post_id = p.post_id
	ORDER BY p.post_time $post_time_order";
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
}
else
{
	message_die(GENERAL_MESSAGE, $lang['No_posts_topic']);
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
$view_forum_url = append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id");


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

	setcookie($board_config['cookie_name'] . '_t', serialize($tracking_topics), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
}

// Load templates
$template->set_filenames(array('body' => 'viewpost_body.tpl'));

// Output page header
$gen_simple_header = FALSE;
$redirect_page = '<input type="hidden" name="redirect" value="' . append_sid("viewpost.php?p=" . $post_id).'">';
$page_title = $topic_title;
//---[ + ] ------- meta tags---------------------
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
//---[ - ] ------- meta tags---------------------
if ($HTTP_GET_VARS[POST_POST_URL])
{
	$rss_url = "rss." . $phpEx . "?" . POST_POST_URL . "=" . $HTTP_GET_VARS[POST_POST_URL];
	$l_rss = $board_config['sitename']." ".$lang['rss_topic'];
}
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

// If we've got a hightlight set pass it on to pagination,
// I get annoyed when I lose my highlight after the first page.
$pagination = ( $highlight != '' ) ? generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order&amp;highlight=$highlight", $total_replies, $board_config['posts_per_page'], $start) : generate_pagination("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id&amp;postdays=$post_days&amp;postorder=$post_order", $total_replies, $board_config['posts_per_page'], $start);

// Send vars to template
$template->assign_vars(array(
	'TOPIC_ID' => $topic_id,
	'TOPIC_TITLE' => $topic_title,
	'TURN_TO_POST' => $lang['Turn_to_post'],
	'REPLY_IMG' => $reply_img,

	'L_VIEW_SINGLE' => $lang['View_single_post'],
	'L_TOPIC' => $lang['Topic'],
	'L_AUTHOR' => $lang['Author'],
	'L_MESSAGE' => $lang['Message'],
	'L_POSTED' => $lang['Posted'],
	'L_POST_SUBJECT' => $lang['Post_subject'],
	'L_POST_NEW_TOPIC' => $post_alt,
	'L_POST_REPLY_TOPIC' => $reply_alt,

	'S_TOPIC_LINK' => POST_TOPIC_URL,
	'S_AUTH_LIST' => $s_auth_can,
	'S_TOPIC_ADMIN' => $topic_mod,

	'U_ARCHIVE' =>  append_sid("viewtopic_p.$phpEx?" . POST_POST_URL . "=$post_id#$post_id"),
	'U_VIEW_TOPIC' => ($board_config['basit_seo_open']) ? append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . "=$topic_id" .'-'. format_url($topic_title)) : append_sid("viewtopic_p.$phpEx?" . POST_TOPIC_URL . "=$topic_id"),
	'U_VIEW_POST' => append_sid("viewtopic.$phpEx?" . POST_POST_URL . "=$post_id#$post_id"),
	'U_POST_REPLY_TOPIC' => $reply_topic_url)
);

// Does this topic contain a poll?
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
			$template->set_filenames(array(
				'pollbox' => 'viewtopic_poll_result.tpl')
			);

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
			$template->set_filenames(array(
				'pollbox' => 'viewtopic_poll_ballot.tpl')
			);

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

// Okay, let's do the loop, yeah come on baby let's do the loop
// and it goes like this ...
for($i = 0; $i < 1; $i++)
{

	$poster_id = $postrow[$i]['user_id'];
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


	// Define the little post icon
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

	if ( $poster_id != ANONYMOUS && $userdata['session_logged_in'] )
	{
		$temp_url = append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$poster_id");
		$profile_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_profile'] . '" alt="' . $lang['Read_profile'] . '" title="' . $lang['Read_profile'] . '" border="0" /></a>';
		$profile = '<a href="' . $temp_url . '">' . $lang['Read_profile'] . '</a>';

		$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=$poster_id");
		$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
		$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';

		if ( !empty($postrow[$i]['user_viewemail']) || $is_auth['auth_mod'] )
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

		$www_img = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '';
		$www = ( $postrow[$i]['user_website'] ) ? '<a href="' . $postrow[$i]['user_website'] . '" target="_userwww">' . $lang['Visit_website'] . '</a>' : '';

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
		$profile_img = '';
		$profile = '';
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

	$user_sig = ( $postrow[$i]['enable_sig'] && $postrow[$i]['user_sig'] != '' && $board_config['allow_sig'] ) ? $postrow[$i]['user_sig'] : '';
	$user_sig_bbcode_uid = $postrow[$i]['user_sig_bbcode_uid'];

	// Note! The order used for parsing the message _is_ important, moving things around could break any output

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

	// Parse smilies
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

	// Replace newlines (we use this rather than nl2br because
	// till recently it wasn't XHTML compliant)
	if ( $user_sig != '' )
	{
		$user_sig = '<br /><br /><img title="" src="images/imza.gif"><br />' . str_replace("\n", "\n<br />\n", $user_sig);
	}

	$message = str_replace("\n", "\n<br />\n", $message);

	// Editing information
	if ( $postrow[$i]['post_edit_count'] )
	{
		$l_edit_time_total = ( $postrow[$i]['post_edit_count'] == 1 ) ? $lang['Edited_time_total'] : $lang['Edited_times_total'];

		$l_edited_by = '<br /><br />' . sprintf($l_edit_time_total, $poster, create_date($board_config['default_dateformat'], $postrow[$i]['post_edit_time'], $board_config['board_timezone']), $postrow[$i]['post_edit_count']);
	}
	else
	{
		$l_edited_by = '';
	}

	// Again this will be handled by the templating
	// code at some point
	$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

	$template->assign_block_vars('postrow', array(
		'ROW_COLOR' => '#' . $row_color,
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
		'PROFILE_IMG' => $profile_img,
		'PROFILE' => $profile,
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
		'L_MINI_POST_ALT' => $mini_post_alt,

		'U_MINI_POST' => $mini_post_url,
		'U_POST_ID' => $postrow[$i]['post_id'])
	);
}

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>