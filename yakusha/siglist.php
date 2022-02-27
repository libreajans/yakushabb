<?php
/***************************************************************************
 * siglist.php
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/functions_color_groups.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_MEMBERLIST);
init_userprefs($userdata);
// End session management

//---[+]--- Logged In control on acp --------
if ( !$userdata['session_logged_in'] && $board_config['allow_login_for_memberlist'])
{
	redirect(append_sid("login.$phpEx?redirect=usersites.$phpEx", true));
}
//---[-]--- Logged In control on acp --------

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

if ( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
	$mode = 'username';
}

if(isset($HTTP_POST_VARS['order']))
{
	$sort_order = ($HTTP_POST_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else if(isset($HTTP_GET_VARS['order']))
{
	$sort_order = ($HTTP_GET_VARS['order'] == 'ASC') ? 'ASC' : 'DESC';
}
else
{
	$sort_order = 'ASC';
}

// siglist sorting
$mode_types_text = array($lang['Sort_Username'], $lang['Sort_Joined'], $lang['Sort_Posts']);
$mode_types = array('username', 'joined', 'posts');

$select_sort_mode = '<select name="mode">';
for($i = 0; $i < count($mode_types_text); $i++)
{
	$selected = ( $mode == $mode_types[$i] ) ? ' selected="selected"' : '';
	$select_sort_mode .= '<option value="' . $mode_types[$i] . '"' . $selected . '>' . $mode_types_text[$i] . '</option>';
}
$select_sort_mode .= '</select>';

$select_sort_order = '<select name="order">';
if($sort_order == 'ASC')
{
	$select_sort_order .= '<option value="ASC" selected="selected">' . $lang['Sort_Ascending'] . '</option><option value="DESC">' . $lang['Sort_Descending'] . '</option>';
}
else
{
	$select_sort_order .= '<option value="ASC">' . $lang['Sort_Ascending'] . '</option><option value="DESC" selected="selected">' . $lang['Sort_Descending'] . '</option>';
}
$select_sort_order .= '</select>';

//
// Generate page
//
$page_title = $lang['siglist'];
$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("siglist.php").'">';
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'siglist_body.tpl')
);
make_jumpbox('viewforum.'.$phpEx);

$template->assign_vars(array(
	'L_SELECT_SORT_METHOD' => $lang['Select_sort_method'],
	'L_ORDER' => $lang['Order'],
	'L_SORT' => $lang['Sort'],
	'L_SUBMIT' => $lang['Sort'],
	'L_POSTS' => $lang['Posts'], 

	'L_SIGNATURE' => $lang['signature'], 
	'SIG_MOD_WRITE' => 'Siglist by<a href="http://www.canver.net" target="_blank">canver.net</a>',

	'S_MODE_SELECT' => $select_sort_mode,
	'S_ORDER_SELECT' => $select_sort_order,
	'S_MODE_ACTION' => append_sid("siglist.$phpEx"))
);

switch( $mode )
{
	case 'joined':
		$order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'username':
		$order_by = "username $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	case 'posts':
		$order_by = "user_posts $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
	default:
		$order_by = "user_regdate $sort_order LIMIT $start, " . $board_config['topics_per_page'];
		break;
}

// [+] select user rank
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
// [-] select user rank

// [+] select user info
$sql = "SELECT username, user_id, user_active, user_regdate, user_posts, user_sig, user_sig_bbcode_uid, user_allowhtml, user_allowsmile, user_avatar, user_avatar_type, user_allowavatar, user_rank
	FROM " . USERS_TABLE . "
	WHERE user_id <> " . ANONYMOUS . "
	AND user_sig <> ''
	AND user_active = 1
	ORDER BY $order_by";
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

		$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($username) . "&amp;showresults=posts");
		$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $username) . '</a>';

		$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
		$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];

		// Generate ranks, set them to empty string initially.
		$poster_rank = '';
		$rank_image = '';
		if ( $row['user_id'] == ANONYMOUS )
		{
		}
		else if ( $row['user_rank'] )
		{
			for($j = 0; $j < count($ranksrow); $j++)
			{
				if ( $row['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
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
				if ( $row['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
				{
					$poster_rank = $ranksrow[$j]['rank_title'];
					$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="' . $ranksrow[$j]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
				}
			}
		}
	
		// Handle anon users posting with usernames
		if ( $poster_id == ANONYMOUS && $row['post_username'] != '' )
		{
			$poster = $row['post_username'];
			$poster_rank = $lang['Guest'];
		}

		// [+] user signature
		$user_sig = ( $row['user_sig'] != '' && $board_config['allow_sig'] ) ? $row['user_sig'] : '';
		$user_sig_bbcode_uid = $row['user_sig_bbcode_uid'];
		
		//
		// If the board has HTML off but the post has HTML
		// on then we process it, else leave it alone
		//
		if ( !$board_config['allow_html'] || !$row['user_allowhtml'])
		{
			if ( $user_sig != '' )
			{
				$user_sig = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $user_sig);
			}
	
			if ( $row['enable_html'] )
			{
				$message = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $message);
			}
		}
	
		//
		// Parse message and/or sig for BBCode if reqd
		//
		if ($user_sig != '' && $user_sig_bbcode_uid != '')
		{
			$user_sig = ($board_config['allow_bbcode']) ? bbencode_second_pass($user_sig, $user_sig_bbcode_uid) : preg_replace("/\:$user_sig_bbcode_uid/si", '', $user_sig);
		}
		
		if ( $user_sig != '' )
		{
			$user_sig = make_clickable($user_sig);
		}
		
		// Parse smilies
		if ( $board_config['allow_smilies'] && $row['user_allowsmile'] && $user_sig != '')
		{
				$user_sig = smilies_pass($user_sig);
		}
		
		// Replace naughty words
		if (count($orig_word) && $user_sig != '')
		{
				$user_sig = str_replace('\"', '"', substr(@preg_replace('#(\>(((?>([^><]+|(?R)))*)\<))#se', "@preg_replace(\$orig_word, \$replacement_word, '\\0')", '>' . $user_sig . '<'), 1, -1));
		}
	
		// Replace newlines (we use this rather than nl2br because
		// till recently it wasn't XHTML compliant)
		if ( $user_sig != '' )
		{
			$user_sig = str_replace("\n", "\n<br />\n", $user_sig);
		}
		// [-] user signature

		$template->assign_block_vars('sigrow', array(
			'ROW_NUMBER' => $i + ( $start + 1 ),
			'ROW_COLOR' => '#' . $row_color,
			'ROW_CLASS' => $row_class,
			'USERNAME' => color_group_colorize_name($user_id, false),
			'POSTS' => $posts,
			'POSTER_RANK' => $poster_rank,
			'RANK_IMAGE' => $rank_image,
			'AVATAR_IMG' => $poster_avatar,
			'U_SEARCH_USER_POSTS' => append_sid("search.$phpEx?search_author=" . urlencode($username) . "&showresults=posts"),
            'SIGNATURE' => $user_sig,
			'PROFILE' => $profile, 
			'SEARCH' => $search,
			'U_VIEWPROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$user_id"))
		);
		
		$i++;
	}
	while ( $row = $db->sql_fetchrow($result) );
	$db->sql_freeresult($result);
}
// [+] select user info

if ( $mode != 'topten' || $board_config['topics_per_page'] < 10 )
{
	$sql = "SELECT count(*) AS total
		FROM " . USERS_TABLE . "
		WHERE user_id <> " . ANONYMOUS . "
		AND user_active = 1
		AND user_sig <> ''";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_fetchrow($result) )
	{
		$total_members = $total['total'];

		$pagination = generate_pagination("siglist.$phpEx?mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
	}
	$db->sql_freeresult($result);
}
else
{
	$pagination = '&nbsp;';
	$total_members = 10;
}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )), 
	'L_GOTO_PAGE' => $lang['Goto_page'])
);

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>