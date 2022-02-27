<?php
/***************************************************************************
* index.php
***************************************************************************/

// Start Variables
define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include_once($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);
color_groups_setup_list();

$viewcat = ( !empty($HTTP_GET_VARS[POST_CAT_URL]) ) ? $HTTP_GET_VARS[POST_CAT_URL] : -1;

if( isset($HTTP_GET_VARS['mark']) || isset($HTTP_POST_VARS['mark']) )
{
	$mark_read = ( isset($HTTP_POST_VARS['mark']) ) ? $HTTP_POST_VARS['mark'] : $HTTP_GET_VARS['mark'];
}
else
{
	$mark_read = '';
}

// Handle marking posts
if( $mark_read == 'forums' )
{
	if( $userdata['session_logged_in'] )
	{
		setcookie($board_config['cookie_name'] . '_f_all', time(), 0, $board_config['cookie_path'], $board_config['cookie_domain'], $board_config['cookie_secure']);
	}

	$template->assign_vars(array(
		"META" => '<meta http-equiv="refresh" content="1;url='	.append_sid("index.$phpEx") . '">')
	);

	$message = $lang['Forums_marked_read'] . '<br /><br />' . sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a> ');
	message_die(GENERAL_MESSAGE, $message);
}
// End handle marking posts

$tracking_topics = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_t']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_t"]) : array();
$tracking_forums = ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f']) ) ? unserialize($HTTP_COOKIE_VARS[$board_config['cookie_name'] . "_f"]) : array();

// If you don't use these stats on your index you may want to consider
// removing them

$total_posts = get_db_stat('postcount');
$total_users = get_db_stat('usercount');
$total_topics = get_db_stat('topiccount');
$newest_userdata = get_db_stat('newestuser');
$wached_total = get_db_stat('wached_total');
$newest_user = $newest_userdata['username'];
$newest_uid = $newest_userdata['user_id'];

//-- [+] MOD: Light Statistic --------------------------------------------
$l_total_post_s = $lang['Posted_articles_total'];
$l_total_user_s = $lang['Registered_users_total'];
//-- [-] MOD: Light Statistic --------------------------------------------

// Start page proper
$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
	FROM " . CATEGORIES_TABLE . " c
	ORDER BY c.cat_order";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}

$category_rows = array();
while ($row = $db->sql_fetchrow($result))
{
	$category_rows[] = $row;
}
$db->sql_freeresult($result);

$subforums_list = array();

if( ( $total_categories = count($category_rows) ) )
{
	$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id, t.topic_title, t.topic_last_post_id " .
		" FROM ((( " . FORUMS_TABLE . " f " .
		" LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )" .
		" LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id ) " .
		" LEFT JOIN " . TOPICS_TABLE . " t ON t.topic_last_post_id = p.post_id ) " .
		" ORDER BY f.cat_id, f.forum_order";

	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_data = array();
	$topic_last_ary = array();
	$i=0;

	while( $row = $db->sql_fetchrow($result) )
	{
		if (!in_array($row['topic_last_post_id'], $topic_last_ary) || $row['topic_last_post_id']==0) 
		{
			$topic_last_ary[i]=$row['topic_last_post_id'];
			$i++;
			$forum_data[] = $row;
		}
	}
	unset($topic_last_ary);

	if ( !($total_forums = count($forum_data)) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_forums']);
	}

	//--- [ + ] ----- USERS ONLINE TODAY -----------
	if ($board_config['show_user_online_today'])
	{
		$uot_this_timestamp_array = getdate();
		$uot_when_from = mktime ( 0 , 0 , 0 , $uot_this_timestamp_array[mon] , $uot_this_timestamp_array[mday] , $uot_this_timestamp_array[year] );

		$sql =  "SELECT count(*) cnt
			FROM ".USERS_TABLE." u
			WHERE u.user_session_time >= ". ($uot_when_from) . "
			ORDER BY u.username ASC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain regd user/online information', '', __LINE__, __FILE__, $sql);
		}

		$row = $db->sql_fetchrow($result);
		$uot_count = $row['cnt'];

		$sql =  "SELECT u.user_id, u.user_allow_viewonline, u.user_level, user_session_time
			FROM ".USERS_TABLE." u
			WHERE u.user_session_time >= ". $uot_when_from . "
			ORDER BY IF(u.user_level=1,3,user_level) DESC, u.user_session_time ASC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain regd user/online information', '', __LINE__, __FILE__, $sql);
		}

		$users_online_today=array();

		while ( $row = $db->sql_fetchrow($result) )
		{
			//false yaparsanýz tarih gösterme fonksiyonu bozulur...
			$uot_username = color_group_colorize_name($row['user_id'], true);

			if ( !$row['user_allow_viewonline'] )
			{
				$view_online = ( $userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD) ? true : false;
				$uot_username = '<em>'. $uot_username .'</em>';
			}
			else
			{
				$view_online = true;
			}

			// üç deðeri birleþtiriyoruz: üye linkini, son giriþ tarihini, linksiz renki üye adýný 
			if($row['user_id'] > 0)
			{
				$uot_username = sprintf('<a href="profile.php?mode=viewprofile&u=%d" title="%s">%s</a>' , $row['user_id'] , create_date('H:i', $row['user_session_time'] , $board_config['board_timezone']) , $uot_username);
			}

			//þekillenmiþ isimler diziye geçiriliyor.
			if($view_online)
			{
				array_push($users_online_today,$uot_username);
			}
		}
		//emin deðilim fakat doðru yer burasý!
		$db->sql_freeresult($result);

		if(count($users_online_today)==0)
		{
			array_push($users_online_today,$lang['UOT_none']);
		}

		$template->assign_block_vars('online', array(
			'UOT_TITLE' => $lang['UOT_title'],
			'UOT_COUNT' => $uot_count,
			'UOT_LIST' => implode(", ",$users_online_today)
			)
		);
	}
	//--- [ - ] ----- USERS ONLINE TODAY -----------

	// Filter topic_title not allowed to read
	if ( !($userdata['user_level'] == ADMIN && $userdata['session_logged_in']) ) 
	{
		$auth_read_all = array();
		$auth_read_all = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);
		$auth_data = '';

		for($i=0; $i<count($forum_data); $i++)
		{
			if (!$auth_read_all[$forum_data[$i]['forum_id']]['auth_view'])
			{
				$forum_data[$i]['topic_title']='';
			}
		}//end for
	}

	// Define censored word matches
	$orig_word = array();
	$replacement_word = array();
	obtain_word_list($orig_word, $replacement_word);
	
	// Obtain a list of topic ids which contain
	// posts made since user last visited
	if ($userdata['session_logged_in'])
	{
		// 60 days limit
		if ($userdata['user_lastvisit'] < (time() - 5184000))
		{
			$userdata['user_lastvisit'] = time() - 5184000;
		}

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


	#--[+]----- modlar ekleniyor -------------------------------
	if ( $board_config['show_mod_list'])
	{
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
		
		$forum_moderators = array();
		while( $row = $db->sql_fetchrow($result) )
		{
			$forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '">' . $row['username'] . '</a>';
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
			$forum_moderators[$row['forum_id']][] = '<a href="' . append_sid("groupcp.$phpEx?" . POST_GROUPS_URL . "=" . $row['group_id']) . '">' . $row['group_name'] . '</a>';
		}
		$db->sql_freeresult($result);
	}
	#--[-]----- modlar ekleniyor -------------------------------

	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);

	// Start output of page
	define('SHOW_ONLINE', true);
	$page_title = sprintf($lang['Index'], $board_config['sitename']);
	$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("index.php").'">';
	include($phpbb_root_path . 'includes/page_header.'.$phpEx);

	//tema deðiþimi burdan yapýlýyor
	$template->set_filenames(array('body' => ($board_config['icon_mod_open']) ? 'index_body.tpl' : 'index_body_.tpl' ));

	$template->assign_vars(array(
		'NEW_USER' => sprintf($lang['New_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=$newest_uid") . '">', $newest_user, '</a>'),
		'L_TOTAL_TOPICCOUNT' => $lang['Total_topiccount'],
		'L_WACHED_TOTAL' => $lang['Wached_total'],

		'TOTAL_POSTS' => sprintf($l_total_post_s, $total_posts),
		'TOTAL_TOPICCOUNT' => $total_topics,
		'WACHED_TOTAL' => $wached_total,
		'TOTAL_USERS' => sprintf($l_total_user_s, '<a title="'. $lang['Memberlist'] .'" href="' . append_sid("memberlist.$phpEx") . '">', $total_users, '</a>'),

		'FORUM_IMG' => $images['forum'],
		'FORUM_NEW_IMG' => $images['forum_new'],
		'FORUM_LOCKED_IMG' => $images['forum_locked'],

		'L_INFOS' => $lang['Infos'],
		'L_FORUM' => $lang['Forum'],
		'L_SUBFORUMS' => $lang['Subforums'],
		'L_TOPICS' => $lang['Topics'],
		'L_REPLIES' => $lang['Replies'],
		'L_VIEWS' => $lang['Views'],
		'L_POSTS' => $lang['Posts'],
		'L_LASTPOST' => $lang['Last_Post'],
		'L_NO_NEW_POSTS' => $lang['No_new_posts'],
		'L_NEW_POSTS' => $lang['New_posts'],
		'L_NO_NEW_POSTS_LOCKED' => $lang['No_new_posts_locked'],
		'L_NEW_POSTS_LOCKED' => $lang['New_posts_locked'],
		'L_ONLINE_EXPLAIN' => $lang['Online_explain'],
		'L_MODER' => $lang['Moder'],

		'L_MODERATOR' => $lang['Moderators'],
		'L_FORUM_LOCKED' => $lang['Forum_is_locked'],
		'L_MARK_FORUMS_READ' => $lang['Mark_all_forums'],
		'U_MARK_READ' => append_sid("index.$phpEx?mark=forums"))
	);
	
	//
	// Let's decide which categories we should display
	//
	$display_categories = array();
	
	for ($i = 0; $i < $total_forums; $i++ )
	{
		if ($is_auth_ary[$forum_data[$i]['forum_id']]['auth_view'])
		{
			$display_categories[$forum_data[$i]['cat_id']] = true;
		}
	}

	// Okay, let's build the index
	for($i = 0; $i < $total_categories; $i++)
	{
		$cat_id = $category_rows[$i]['cat_id'];

		// Yes, we should, so first dump out the category
		// title, then, if appropriate the forum list
		if (isset($display_categories[$cat_id]) && $display_categories[$cat_id] && ( $viewcat == $cat_id || $viewcat == -1 ))
		{
			$template->assign_block_vars('catrow', array(
				'CAT_ID' => $cat_id,
				'CAT_DESC' => $category_rows[$i]['cat_title'],
				'U_VIEWCAT' => append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"))	);

			if ( $viewcat == $cat_id || $viewcat == -1 )
			{
				for($j = 0; $j < $total_forums; $j++)
				{
					if ( $forum_data[$j]['cat_id'] == $cat_id)
					{
						$forum_id = $forum_data[$j]['forum_id'];
	
						if ( $is_auth_ary[$forum_id]['auth_view'] )
						{
							if ( $forum_data[$j]['forum_status'] == FORUM_LOCKED )
							{
								$folder_image = $images['forum_locked'];
								$folder_alt = $lang['Forum_locked'];
								$unread_topics = false;
								$folder_images = array(
									'default' => $folder_image,
									'new'	=> $images['forum_locked'],
									'sub'	=> ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
									'subnew' => ( isset($images['forums_locked']) ) ? $images['forums_locked'] : $images['forum_locked'],
									'subalt' => $lang['Forum_locked'],
									'subaltnew' => $lang['Forum_locked']);
							}
							else
							{
								$unread_topics = false;
								if ( $userdata['session_logged_in'] )
								{
									if ( !empty($new_topic_data[$forum_id]) )
									{
										$forum_last_post_time = 0;
	
										while( list($check_topic_id, $check_post_time) = @each($new_topic_data[$forum_id]) )
										{
											if ( empty($tracking_topics[$check_topic_id]) )
											{
												$unread_topics = true;
												$forum_last_post_time = max($check_post_time, $forum_last_post_time);
											}
											else
											{
												if ( $tracking_topics[$check_topic_id] < $check_post_time )
												{
													$unread_topics = true;
													$forum_last_post_time = max($check_post_time, $forum_last_post_time);
												}
											}
										}// end while
	
										if ( !empty($tracking_forums[$forum_id]) )
										{
											if ( $tracking_forums[$forum_id] > $forum_last_post_time )
											{
												$unread_topics = false;
											}
										}
	
										if ( isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all']) )
										{
											if ( $HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_f_all'] > $forum_last_post_time )
											{
												$unread_topics = false;
											}
										}
									}// end !empty($new_topic_data[$forum_id])
								}// end if session_logged_in
	
								$folder_image = ( $unread_topics ) ? $images['forum_new'] : $images['forum'];
								$folder_alt = ( $unread_topics ) ? $lang['New_posts'] : $lang['No_new_posts'];
								$folder_images = array(
									'default' => $folder_image,
									'new'	=> $images['forum_new'],
									'sub'	=> ( isset($images['forums']) ) ? $images['forums'] : $images['forum'],
									'subnew' => ( isset($images['forums_new']) ) ? $images['forums_new'] : $images['forum_new'],
									'subalt' => $lang['No_new_posts'],
									'subaltnew' => $lang['New_posts']);
	
							}//end else
	
							$posts = $forum_data[$j]['forum_posts'];
							$topics = $forum_data[$j]['forum_topics'];
							$icon = $forum_data[$j]['forum_icon']; // Forum Icon Mod
	
							if ( $forum_data[$j]['forum_last_post_id'] )
							{
								$topic_title = $forum_data[$j]['topic_title'];
	
								//
								// Censor topic title
								//
								if ( count($orig_word) )
								{
									$topic_title = preg_replace($orig_word, $replacement_word, $topic_title);
								}
	
								$last_post_time = create_date($board_config['default_dateformat'], $forum_data[$j]['post_time'], $board_config['board_timezone']);
								$last_post = '<a href="' . append_sid("viewtopic.$phpEx?"	. POST_POST_URL . '=' . $forum_data[$j]['forum_last_post_id']) . '#' . $forum_data[$j]['forum_last_post_id'] . '" title="' . $topic_title . '">' . $topic_title . '</a><br>';
								$last_post .= $last_post_time . '&nbsp;<a href="' . append_sid("viewtopic.$phpEx?"	. POST_POST_URL . '=' . $forum_data[$j]['forum_last_post_id']) . '#' . $forum_data[$j]['forum_last_post_id'] . '"></a><br>' . $lang['by'] . '&nbsp;';
								$last_post .= ( $forum_data[$j]['user_id'] == ANONYMOUS ) ? ( ($forum_data[$j]['post_username'] != '' ) ? $forum_data[$j]['post_username'] . ' ' : $lang['Guest'] . ' ' ) : color_group_colorize_name($forum_data[$j]['user_id'], true);
								$last_post_sub = '<a href="' . append_sid("viewtopic.$phpEx?"	. POST_POST_URL . '=' . $forum_data[$j]['forum_last_post_id']) . '#' . $forum_data[$j]['forum_last_post_id'] . '"><img src="' . ($unread_topics ? $images['icon_newest_reply'] : $images['icon_latest_reply']) . '" border="0" alt="' . $lang['View_latest_post'] . '" title="' . $lang['View_latest_post'] . '" /></a>';
								$last_post_time = $forum_data[$j]['post_time'];
							}
							else
							{
								$last_post = $lang['No_Posts'];
								$last_post_time = 0;
								$last_post_sub = '<img src="' . $images['icon_minipost'] . '" border="0" alt="' . $lang['No_Posts'] . '" title="' . $lang['No_Posts'] . '" />';
							}
	
							if ( count($forum_moderators[$forum_id]) > 0 )
							{
								$l_moderators = ( count($forum_moderators[$forum_id]) == 1 ) ? $lang['Moderator'] : $lang['Moderators'];
								$moderator_list = implode(', ', $forum_moderators[$forum_id]);
							}
							else
							{
								$l_moderators = '';
								$moderator_list = '';
							}
	
							$row_color = ( !($i % 2) ) ? $theme['td_color1'] : $theme['td_color2'];
							$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	
							$template->assign_block_vars('catrow.forumrow', array(
								'ROW_COLOR' => '#' . $row_color,
								'ROW_CLASS' => $row_class,
								'FORUM_FOLDER_IMG' => $folder_image,
								'FORUM_ICON_IMG' => ($icon) ? '<img src="' . $phpbb_root_path . $icon . '" alt="'.$forum_data[$j]['forum_name'].'" title="'.$forum_data[$j]['forum_name'].'" />' : '', // Forum Icon Mod
								'FORUM_NAME' => $forum_data[$j]['forum_name'],
								'FORUM_DESC' => $forum_data[$j]['forum_desc'],
								'POSTS' => $forum_data[$j]['forum_posts'],
								'TOPICS' => $forum_data[$j]['forum_topics'],
								'LAST_POST' => $last_post,
								'L_FORUM_FOLDER_ALT' => $folder_alt,
	
								'FORUM_FOLDERS' => serialize($folder_images),
								'HAS_SUBFORUMS' => 0,
								'PARENT' => $forum_data[$j]['forum_parent'],
								'ID' => $forum_data[$j]['forum_id'],
								'UNREAD' => intval($unread_topics),
								'TOTAL_UNREAD' => intval($unread_topics),
								'TOTAL_POSTS' => $forum_data[$j]['forum_posts'],
								'TOTAL_TOPICS' => $forum_data[$j]['forum_topics'],
								'LAST_POST_FORUM' => $last_post,
								'LAST_POST_TIME' => $last_post_time,
								'LAST_POST_TIME_FORUM' => $last_post_time,
	
								'MODERATORS' => $moderator_list,
								'L_MODERATOR' => $l_moderators,
	
								'U_VIEWFORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id").'-'. format_url($forum_data[$j]['forum_name']) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL . "=$forum_id"),
								)
							);

							if( $forum_data[$j]['forum_parent'] )
							{
								$subforums_list[] = array(
								'forum_data' => $forum_data[$j],
								'folder_image' => $folder_image,
								'last_post' => $last_post,
								'last_post_sub' => $last_post_sub,
								'unread_topics' => $unread_topics,
								'folder_alt' => $folder_alt,
								'last_post_time'=> $last_post_time,
								'desc'	=> $forum_data[$j]['forum_desc']);
							} // if forum patern
						} // if auth view
					} // end $forum_data[$j]['cat_id'] == $cat_id
				} // // end for
			} // $viewcat == $cat_id || $viewcat == -1
		} // $viewcat == $cat_id || $viewcat == -1
	} // for categories
}// if ... total_categories
else
{
	message_die(GENERAL_MESSAGE, $lang['No_forums']);
}

// Begin Simple Subforums MOD
unset($data);
unset($item);
unset($cat_item);
unset($row_item);
for( $i = 0; $i < count($subforums_list); $i++ )
{
	$forum_data = $subforums_list[$i]['forum_data'];
	$parent_id = $forum_data['forum_parent'];

	// Find parent item
	if( isset($template->_tpldata['catrow.']) )
	{
		$data = &$template->_tpldata['catrow.'];
		$count = count($data);
		for( $j = 0; $j < $count; $j++)
		{
			$cat_item = &$data[$j];
			$row_item = &$cat_item['forumrow.'];
			$count2 = count($row_item);
			for( $k = 0; $k < $count2; $k++)
			{
				if( $row_item[$k]['ID'] == $parent_id )
				{
					$item = &$row_item[$k];
					break;
				}
			}
			
			if( isset($item) )
			{
				break;
			}
		}//end for
	} // end isset($template->_tpldata['catrow.'])

	if( isset($item) )
	{
		if( isset($item['sub.']) )
		{
			$num = count($item['sub.']);
			$data = &$item['sub.'];
		}
		else
		{
			$num = 0;
			$item[] = 'sub.';
			$data = &$item['sub.'];
		}

		// Append new entry
		$data[] = array(
			'NUM' => $num,
			'FORUM_FOLDER_IMG' => $subforums_list[$i]['folder_image'],
			'FORUM_NAME' => $forum_data['forum_name'],
			'FORUM_DESC' => $forum_data['forum_desc'],
			'FORUM_DESC_HTML' => htmlspecialchars(preg_replace('@<[\/\!]*?[^<>]*?>@si', '', $forum_data['forum_desc'])),
			'POSTS' => $forum_data['forum_posts'],
			'TOPICS' => $forum_data['forum_topics'],
			'LAST_POST' => $subforums_list[$i]['last_post'],
			'LAST_POST_SUB' => $subforums_list[$i]['last_post_sub'],
			'LAST_TOPIC' => $forum_data['topic_title'],
			'PARENT' => $forum_data['forum_parent'],
			'ID' => $forum_data['forum_id'],
			'UNREAD' => intval($subforums_list[$i]['unread_topics']),
			'L_FORUM_FOLDER_ALT' => $subforums_list[$i]['folder_alt'],
			//-[+]--basit seo modu ---
			'U_VIEWFORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_data['forum_id'] .'-'. format_url($forum_data['forum_name'])) : append_sid("viewforum.$phpEx?" . POST_FORUM_URL . '=' . $forum_data['forum_id'])
			//-[-]-- basit seo modu ---
		);

		$item['HAS_SUBFORUMS'] ++;
		$item['TOTAL_UNREAD'] += intval($subforums_list[$i]['unread_topics']);
		$images = unserialize($item['FORUM_FOLDERS']);
		$item['FORUM_FOLDER_IMG'] = $item['TOTAL_UNREAD'] ? $images['subnew'] : $images['sub'];
		$item['L_FORUM_FOLDER_ALT'] = $item['TOTAL_UNREAD'] ? $images['subaltnew'] : $images['subalt'];

		if( $item['LAST_POST_TIME'] < $subforums_list[$i]['last_post_time'] )
		{
			$item['LAST_POST'] = $subforums_list[$i]['last_post'];
			$item['LAST_POST_TIME'] = $subforums_list[$i]['last_post_time'];
		}

		if( !$item['LAST_POST_TIME_FORUM'] )
		{
			$item['LAST_POST_FORUM'] = $item['LAST_POST'];
		}

		// Add topics/posts
		$item['TOTAL_POSTS'] += $forum_data['forum_posts'];
		$item['TOTAL_TOPICS'] += $forum_data['forum_topics'];
	}

	unset($item);
	unset($data);
	unset($cat_item);
	unset($row_item);
}//end for

// Generate the page
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>