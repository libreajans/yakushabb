<?php
/***************************************************************************
 * index.php
 ***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_ARCHIVE);
init_userprefs($userdata);
// End session management

$viewcat = ( !empty($HTTP_GET_VARS[POST_CAT_URL]) ) ? $HTTP_GET_VARS[POST_CAT_URL] : -1;

// Start page proper
$sql = "SELECT c.cat_id, c.cat_title, c.cat_order
	FROM " . CATEGORIES_TABLE . " c 
	ORDER BY c.cat_order";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}

$category_rows = array();
while ($row = $db->sql_fetchrow($result))
{
	$category_rows[] = $row;
}
$db->sql_freeresult($result);

if( ( $total_categories = count($category_rows) ) )
{
	//
	// Define appropriate SQL
	//
	$sql = "SELECT f.*, p.post_time, p.post_username, u.username, u.user_id
		FROM (( " . FORUMS_TABLE . " f
		LEFT JOIN " . POSTS_TABLE . " p ON p.post_id = f.forum_last_post_id )
		LEFT JOIN " . USERS_TABLE . " u ON u.user_id = p.poster_id )
		ORDER BY f.cat_id, f.forum_order";
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
	}

	$forum_data = array();
	while( $row = $db->sql_fetchrow($result) )
	{
		$forum_data[] = $row;
	}
	$db->sql_freeresult($result);

	if ( !($total_forums = count($forum_data)) )
	{
		message_die(GENERAL_MESSAGE, $lang['No_forums']);
	}

	// Find which forums are visible for this user
	$is_auth_ary = array();
	$is_auth_ary = auth(AUTH_VIEW, AUTH_LIST_ALL, $userdata, $forum_data);

	$page_title = sprintf($lang['Index'], $board_config['sitename']);
	include($phpbb_root_path . 'includes/page_header_p.'.$phpEx);

	$template->set_filenames(array('body' => 'index_body_p.tpl'));

	// Let's decide which categories we should display
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
		if (isset($display_categories[$cat_id]) && $display_categories[$cat_id])
		{
			$template->assign_block_vars('catrow', array(
				'CAT_ID' => $cat_id,
				'CAT_DESC' => $category_rows[$i]['cat_title'],
				'U_VIEWCAT' => append_sid("index.$phpEx?" . POST_CAT_URL . "=$cat_id"))
			);

			if ( $viewcat == $cat_id || $viewcat == -1 )
			{
				for($j = 0; $j < $total_forums; $j++)
				{
					if ( $forum_data[$j]['cat_id'] == $cat_id )
					{
						$forum_id = $forum_data[$j]['forum_id'];

						if ( $is_auth_ary[$forum_id]['auth_view'] )
						{
							$template->assign_block_vars('catrow.forumrow',	array(
								'FORUM_NAME' => $forum_data[$j]['forum_name'],
								'FORUM_DESC' => $forum_data[$j]['forum_desc'],
								'U_VIEWFORUM' => ($board_config['basit_seo_open']) ? append_sid("viewforum_p.$phpEx?" . POST_FORUM_URL . "=$forum_id").'-'. format_url($forum_data[$j]['forum_name']) : append_sid("viewforum_p.$phpEx?" . POST_FORUM_URL . "=$forum_id")
								)
							);
						}
					}
				}
			}
		}
	} // for ... categories
}// if ... total_categories
else
{
	message_die(GENERAL_MESSAGE, $lang['No_forums']);
}

// Generate the page
$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail_p.'.$phpEx);

?>