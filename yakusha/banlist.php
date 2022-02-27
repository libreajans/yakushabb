<?php
/***************************************************************************
* banlist.php
***************************************************************************/

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_BANLIST);
init_userprefs($userdata);

$start = ( isset($HTTP_GET_VARS['start']) ) ? intval($HTTP_GET_VARS['start']) : 0;
$start = ($start < 0) ? 0 : $start;

// Generate Page
$page_title = $lang['Banlist'];
$redirect_page = '<input type="hidden" name="redirect" value="'.append_sid("banlist.php").'">';
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'banlist_body.tpl')
);


$order_by = "b.ban_id DESC LIMIT $start, " . $board_config['topics_per_page'];
$sql = "SELECT b.*, u.user_id, u.username
	FROM " . BANLIST_TABLE . " b, " . USERS_TABLE . " u
	WHERE u.user_id = b.ban_userid
	AND b.ban_userid <> 0
	ORDER BY $order_by";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not select current user_id ban list', '', __LINE__, __FILE__, $sql);
}

$user_list = $db->sql_fetchrowset($result);

if( count($user_list) == 0 )
{
	message_die(GENERAL_MESSAGE, $lang['No_bans_exist'], '', '', '');
}

for($i = 0; $i < count($user_list); $i++)
{
	$row_class = ( !($i % 2) ) ? $theme['td_class1'] : $theme['td_class2'];
	if (isset($user_list[$i]['ban_pub_reason']) and ($user_list[$i]['ban_pub_reason'] != NULL))
	{
		$ban_reason = $user_list[$i]['ban_pub_reason'];
	}

	$ban_reason = ( $ban_reason ) ? $ban_reason : $user_list[$i]['ban_priv_reason'];

	$template->assign_block_vars('banrow',array (
		'ROW_CLASS' => $row_class,
		'U_VIEWPROFILE' => append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $user_list[$i]['user_id']),
		'USERNAME' => $user_list[$i]['username'],
		'BAN_TIME' => create_date($board_config['default_dateformat'], $user_list[$i]['ban_time'], $board_config['board_timezone']),
		'BAN_REASON' => $ban_reason, ));
}//end for

//
// Pagination
//
if ( $board_config['topics_per_page'] < 10 )
{
	$sql = "SELECT count(*) AS total
		FROM " . BANLIST_TABLE . "
		WHERE ban_userid <> 0";
	
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Error getting total users', '', __LINE__, __FILE__, $sql);
	}

	if ( $total = $db->sql_fetchrow($result) )
	{
		$total_members = $total['total'];
		$pagination = generate_pagination("banlist.$phpEx?mode=$mode&amp;order=$sort_order", $total_members, $board_config['topics_per_page'], $start). '&nbsp;';
	}
}//end if
else
{
	$pagination = '&nbsp;';
	$total_members = 10;
}

$template->assign_vars(array(
	'PAGINATION' => $pagination,
	'PAGE_NUMBER' => sprintf($lang['Page_of'], ( floor( $start / $board_config['topics_per_page'] ) + 1 ), ceil( $total_members / $board_config['topics_per_page'] )),
	'L_GOTO_PAGE' => $lang['Goto_page'],
	'L_BANLIST' => $lang['Banlist'],
	'L_BAN_TIME' => $lang['Ban_time'],
	'L_BAN_EX_TIME' => $lang['Ban_ex_time'],
	'L_BAN_REASON' => $lang['Ban_reason']));

$template->pparse('body');

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>