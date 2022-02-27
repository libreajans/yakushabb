<?php
// ############         Edit below         ########################################################################
$last_post_length = '30';		// post title length
$last_post_limit = '5';		// post limit

// optional part
$exclude_users = '';		// enter user´s ID to exclude any user (separate them with a comma)
$special_users = '';		// enter user´s ID if you want to a further area (separate them with a comma)
$exclude_special_users = '';	// enter user´s ID if you added a further area and want to exlude user from a certain area (separate them with a comma)
// ############         Edit above         ########################################################################

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path .'extension.inc');
include($phpbb_root_path .'common.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_STAFF);
init_userprefs($userdata);

if( isset($HTTP_GET_VARS['mode']) || isset($HTTP_POST_VARS['mode']) )
{
	$mode = ( isset($HTTP_POST_VARS['mode']) ) ? htmlspecialchars($HTTP_POST_VARS['mode']) : htmlspecialchars($HTTP_GET_VARS['mode']);
}
else
{
	$mode = '';
}

$page_title = $lang['Staff'];
$gen_simple_header = ( $mode == 'view_profile' ) ? TRUE : '';
include('includes/page_header.'.$phpEx);

if( $mode != 'view_profile' )
{
	$template->assign_block_vars('switch_list_staff', array());
	$template->set_filenames(array('body' => 'staff_body.tpl'));
	$template->assign_vars(array(
		'L_USERNAME' => $lang['Username'],
		'L_PAGENAME' => $lang['Staff'],
		'L_FORUMS' => $lang['Staff_forums'],
		'L_LOCATION' => $lang['Location'],
		'L_CONTACT' => $lang['Contact_2'],
		'L_MESSENGER' => $lang['Staff_messenger'],
		'L_WWW' => $lang['Website'],
	));

	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forums);

	$sql_forums = "SELECT ug.user_id, f.forum_id, f.forum_name
		           FROM ". AUTH_ACCESS_TABLE ." aa, ". USER_GROUP_TABLE ." ug, ". FORUMS_TABLE ." f
		           WHERE aa.auth_mod = ". TRUE ." AND ug.group_id = aa.group_id AND f.forum_id = aa.forum_id
		           ORDER BY f.forum_order";
	if( !$result_forums = $db->sql_query($sql_forums) )
	{
		message_die(GENERAL_ERROR, 'could not query forums.', '', __LINE__, __FILE__, $sql_forums);
	}
	while( $row = $db->sql_fetchrow($result_forums) )
	{
		$display_forums = ( $is_auth_ary[$row['forum_id']]['auth_view'] ) ? true : false;
		if( $display_forums )
		{
			$forum_id = $row['forum_id'];
			$staff2[$row['user_id']][$row['forum_id']] = '&nbsp;<a href="'. append_sid("viewforum.$phpEx?f=$forum_id") .'" class="gen">'. $row['forum_name'] .'</a>';
		}
	}
	$db->sql_freeresult($result_forums);

	$sql_ranks = "SELECT * FROM ". RANKS_TABLE ." ORDER BY rank_special, rank_min";
	if( !($results_ranks = $db->sql_query($sql_ranks)) )
	{
		message_die(GENERAL_ERROR, 'could not obtain ranks information.', '', __LINE__, __FILE__, $sql_ranks);
	}
	$ranksrow = array();
	while( $row = $db->sql_fetchrow($results_ranks) )
	{
		$ranksrow[] = $row;
	}
	$db->sql_freeresult($result_ranks);

	$level_cat = $lang['Staff_level'];
	for( $i = 0; $i < 2 ; $i++ )
	{
		$user_level = $level_cat[$i];

		$template->assign_block_vars('switch_list_staff.user_level', array('USER_LEVEL' => $user_level));

		if( $level_cat['0'] )
		{
			$where = 'user_level = '. ADMIN;
		}
		else if( $level_cat['1'] )
		{
			$where = 'user_level = '. MOD;
		}
		$level_cat[$i] = '';

		$sql_exclude_users = ( !empty($exclude_users) ) ? ' AND user_id NOT IN ('. $exclude_users .')' : '';
		$sql_user = "SELECT * FROM ". USERS_TABLE ." WHERE $where $sql_exclude_users ORDER BY user_regdate";
		if( !($result_user = $db->sql_query($sql_user)) )
		{
			message_die(GENERAL_ERROR, 'could not obtain user information.', '', __LINE__, __FILE__, $sql_user);
		}
		if( $staff = $db->sql_fetchrow($result_user) )
		{
			$k = 0;
			do
			{
				$user_id = $staff['user_id'];
				$user_status = ( $staff['user_session_time'] >= (time() - 60) ) ? (( $row['user_allow_viewonline'] ) ? $lang['Staff_online'] : (( $userdata['user_level'] == ADMIN || $userdata['user_id'] == $user_id ) ? '<i>'. $lang['Staff_online'] .'</i>' : '')) : '';

				$rank = '';
				$rank_image = '';
				if( $staff['user_rank'] )
				{
					for( $j = 0; $j < count($ranksrow); $j++ )
					{
						if( $staff['user_rank'] == $ranksrow[$j]['rank_id'] && $ranksrow[$j]['rank_special'] )
						{
							$rank = $ranksrow[$j]['rank_title'];
							$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="'. $ranksrow[$j]['rank_image'] .'" alt="'. $rank .'" title="'. $rank .'" border="0" />' : '';
						}
					}
				}
				else
				{
					for( $j = 0; $j < count($ranksrow); $j++ )
					{
						if( $staff['user_posts'] >= $ranksrow[$j]['rank_min'] && !$ranksrow[$j]['rank_special'] )
						{
							$rank = $ranksrow[$j]['rank_title'];
							$rank_image = ( $ranksrow[$j]['rank_image'] ) ? '<img src="'. $ranksrow[$j]['rank_image'] .'" alt="'. $rank .'" title="'. $rank .'" border="0" />' : '';
						}
					}
				}

/*				$avatar = '';
				if( $staff['user_avatar'] )
				{
					switch( $staff['user_avatar_type'] )
					{
						case USER_AVATAR_UPLOAD:
							$avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="'. $board_config['avatar_path'] .'/'. $staff['user_avatar'] .'" border="0" />' : '';
							break;
						case USER_AVATAR_REMOTE:
							$avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="'. $staff['user_avatar'] .'" border="0" />' : '';
							break;
						case USER_AVATAR_GALLERY:
							$avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="'. $board_config['avatar_gallery_path'] .'/'. $staff['user_avatar'] .'" border="0" />' : '';
							break;
					}
				}
*/

				$poster_avatar = '';
				if ( $staff['user_avatar_type'] && $poster_id != ANONYMOUS && $staff['user_allowavatar'] )
				{
					switch( $staff['user_avatar_type'] )
					{
						case USER_AVATAR_UPLOAD:
							$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $staff['user_avatar'] . '" alt="" border="0" />' : '';
							break;
						case USER_AVATAR_REMOTE:
							if ( $board_config['allow_avatar_remote'] )
							{
								$avatar_url = $staff['user_avatar'];
				
								$avatar_status = check_avatar($avatar_url);
								if ($avatar_status === FALSE)
								{
									$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="images/avatar_yok.gif" alt="" border="0" />' : '';
								}
								else if ($avatar_status === TRUE)
								{
									if ( ($staff['user_avatar_height'] && $staff['user_avatar_height'] > 0) &&
											($staff['user_avatar_width'] && $staff['user_avatar_width'] > 0) )
									{
										$poster_avatar = '<img src="' . $avatar_url  . '" height="' . $staff['user_avatar_height'] . '" width="' . $staff['user_avatar_width'] . '" alt="" border="0" />';
									}
									else  // No width/height in the user's profile
									{
										$poster_avatar = '<img src="' . $avatar_url  . '" alt="" border="0" />';
									}
								}
							}
							else  // remote avatars not allowed
							$poster_avatar = '';
							break;
						case USER_AVATAR_GALLERY:
							$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $staff['user_avatar'] . '" alt="" border="0" />' : '';
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


				$forums = '';
				if( !empty($staff2[$staff['user_id']]) )
				{
					asort($staff2[$staff['user_id']]);
					$forums = implode('<br />',$staff2[$staff['user_id']]);
				}

				$pmto = append_sid("privmsg.$phpEx?mode=post&amp;". POST_USERS_URL ."=$user_id");
				$pm = '<a href="'. $pmto .'"><img src="'. $images['icon_pm'] .'" alt="'. $lang['Send_private_message'] .'" title="'. $lang['Send_private_message'] .'" border="0" /></a>';

				if( !empty($staff['user_viewemail']) || $userdata['user_level'] == ADMIN )
				{
					$mailto = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;". POST_USERS_URL ."=$user_id") : 'mailto:'. $staff['user_email'];
					$mail = ( $staff['user_email'] ) ? '<a href="'. $mailto .'"><img src="'. $images['icon_email'] .'" alt="'. $lang['Send_email'] .'" title="'. $lang['Send_email'] .'" border="0" /></a>' : '';
				}
				else
				{
					$mailto = '';
					$mail = '';
				}

				$msn = ( $staff['user_msnm'] ) ? '<a href="mailto:'. $staff['user_msnm'] .'"><img src="'. $images['icon_msnm'] .'" alt="'. $lang['MSNM'] .'" title="'. $lang['MSNM'] .'" border="0" /></a>' : '';
				$yim = ( $staff['user_yim'] ) ? '<a href="http://edit.yahoo.com/config/send_webmesg?.target='. $staff['user_yim'] .'&amp;.src=pg"><img src="'. $images['icon_yim'] .'" alt="'. $lang['YIM'] .'" title="'. $lang['YIM'] .'" border="0" /></a>' : '';
				$aim = ( $staff['user_aim'] ) ? '<a href="aim:goim?screenname='. $staff['user_aim'] .'&amp;message=Hello+Are+you+there?"><img src="'. $images['icon_aim'] .'" alt="'. $lang['AIM'] .'" title="'. $lang['AIM'] .'" border="0" /></a>' : '';
				$icq = ( $staff['user_icq'] ) ? '<a href="http://wwp.icq.com/scripts/search.dll?to='. $staff['user_icq'] .'"><img src="'. $images['icon_icq'] .'" alt="'. $lang['ICQ'] .'" title="'. $lang['ICQ'] .'" border="0" /></a>' : '';
				$www = ( $staff['user_website'] ) ? '<a href="'. $staff['user_website'] .'" target="_userwww"><img src="'. $images['icon_www'] .'" alt="'. $lang['Visit_website'] .'" title="'. $lang['Visit_website'] .'" border="0" /></a>' : '';

				$template->assign_block_vars('switch_list_staff.user_level.staff', array(
					'ROW_CLASS' => ( !($k % 2) ) ? $theme['td_class1'] : $theme['td_class2'],
					'USER_STATUS' => $user_status,
					'U_PROFILE' => color_group_colorize_name($user_id, false),
					'RANK' => $rank,
					'RANK_IMAGE' => $rank_image,
					'AVATAR' => $poster_avatar,
					'LOCATION' => $staff['user_from'],
					'FORUMS' => $forums,
					'PM' => $pm,
					'EMAIL' => $mail,
					'MSN' => $msn,
					'YIM' => $yim,
					'AIM' => $aim,
					'ICQ' => $icq,
					'WWW' => $www,
				));
				$k++;
			}
			while( $staff = $db->sql_fetchrow($result_user) );
			$db->sql_freeresult($result_user);
		}
	}
}

$template->pparse('body');
include('includes/page_tail.'.$phpEx);

?>