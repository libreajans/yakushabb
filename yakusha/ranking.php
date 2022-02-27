<?php
/***************************************************************************
 * ranks.php
 ***************************************************************************/

// global pgm options
$auth_rank_only_logged = true; // true will required to be logged to have access, false guest are welcome
$spe_rank_max_users = -1; // number of displayed members in the memberlist : -1=all, 0=none, value=number
$std_rank_max_users = 10; // number of displayed members in the memberlist : -1=all, 0=none, value=number

// check for inclusion
if ( isset($check_access) ) return;

// start the prog
define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.' . $phpEx);
include_once($phpbb_root_path.'includes/functions_color_groups.'.$phpEx);


// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

// only registered members have access if desired
if ( $auth_rank_only_logged && !$userdata['session_logged_in'] )
{
	redirect(append_sid('login.' . $phpEx . '?redirect=ranking.' . $phpEx, true));
	exit;
}

// special ranks
$spe_ranks = array();
$sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special = 1 ORDER BY rank_title";
if ( !($result = $db->sql_query($sql)) ) 
{
	message_die(GENERAL_ERROR, 'Couldn\'t read special ranks', '', __LINE__, __FILE__, $sql);
}
while ($row = $db->sql_fetchrow($result) ) $spe_ranks[] = $row;

for ($i=0; $i < count($spe_ranks); $i++ )
{
	$rank = $spe_ranks[$i]['rank_id'];
	$rank_title = $spe_ranks[$i]['rank_title'];
	$spe_ranks[$i]['user_number'] = 0;
	$spe_ranks[$i]['users_list'] = '';

	// base sql request
	$sql_base = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND user_rank = $rank ORDER BY username";

	// get the number of users having this rank
	$sql = $sql_base;
	if ( !($result = $db->sql_query($sql)) ) 
	{
		message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
	}
	$spe_ranks[$i]['user_number'] = $db->sql_numrows($result);

	// get the user list
	if ( $spe_rank_max_users != 0 )
	{
		$sql = $sql_base;
		if ( $spe_rank_max_users > 0 ) $sql .= " LIMIT 0, " . ($spe_rank_max_users + 1);
		if ( !($result = $db->sql_query($sql)) ) 
		{
			message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
		}
		$j = 0;
		while ( $row = $db->sql_fetchrow($result) )
		{
			$j++;
			if ( ($spe_rank_max_users <= 0) || ( $j <= $spe_rank_max_users ) )
			{
				$spe_ranks[$i]['users_list'] .= ($spe_ranks[$i]['users_list'] == '') ? '' : ', ';
				$spe_ranks[$i]['users_list'] .= color_group_colorize_name($row['user_id'] , false);
			}
			else
			{
				$spe_ranks[$i]['users_list'] .= ($spe_ranks[$i]['users_list'] == '') ? '' : ', ';
				$spe_ranks[$i]['users_list'] .= '...';
			}
		}
	}
	if ($spe_ranks[$i]['user_number'] > 0) $spe_ranks[$i]['users_list'] = '(' . $spe_ranks[$i]['user_number'] . ') ' . $spe_ranks[$i]['users_list'];
}

//
// standard ranks
$ranks = array();
$sql = "SELECT * FROM " . RANKS_TABLE . " WHERE rank_special <> 1 ORDER BY rank_min";
if ( !($result = $db->sql_query($sql)) ) message_die(GENERAL_ERROR, 'Couldn\'t read standard ranks', '', __LINE__, __FILE__, $sql);
while ($row = $db->sql_fetchrow($result) ) $ranks[] = $row;

$rank_max = 99999999;
for ($i=count($ranks)-1; $i >=0; $i--)
{
	$ranks[$i]['rank_max'] = $rank_max;
	$rank_title = $ranks[$i]['rank_title'];
	$rank_min = $ranks[$i]['rank_min'];
	
	// count users
	$sql_base = "SELECT * FROM " . USERS_TABLE . " WHERE user_active = 1 AND (user_rank = 0 OR user_rank IS NULL) AND user_posts >= $rank_min" . (($rank_max < 99999999)  ? " AND user_posts < $rank_max" : "" );

	// get the number of users having this rank
	$sql = $sql_base;
	if ( !($result = $db->sql_query($sql)) ) 
	{
		message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
	}
	$ranks[$i]['user_number'] = $db->sql_numrows($result);

	// get the user list
	if ( $std_rank_max_users != 0 )
	{
		$sql = $sql_base;
		if ( $std_rank_max_users > 0 ) $sql .= " LIMIT 0, " . ($std_rank_max_users + 1);
		if ( !($result = $db->sql_query($sql)) ) 
		{ 
			message_die(GENERAL_ERROR, 'Couldn\'t read users', '', __LINE__, __FILE__, $sql);
		}
		$j = 0;
		while ( $row = $db->sql_fetchrow($result) )
		{
			$j++;
			if ( ($std_rank_max_users <= 0) || ( $j <= $std_rank_max_users ) )
			{
				$ranks[$i]['users_list'] .= ($ranks[$i]['users_list'] == '') ? '' : ', ';
				$ranks[$i]['users_list'] .= color_group_colorize_name($row['user_id'] ,false);
			}
			else
			{
				$ranks[$i]['users_list'] .= ($ranks[$i]['users_list'] == '') ? '' : ', ';
				$ranks[$i]['users_list'] .= '...';
			}
		}
	}

	// store the next limit
	$rank_max = $ranks[$i]['rank_min'];

	// number of user beyond userlist
	if ($ranks[$i]['user_number'] > 0) $ranks[$i]['users_list'] = '(' . $ranks[$i]['user_number'] . ') ' . $ranks[$i]['users_list'];
}

//
// set the page title and include the page header
//
$page_title = $lang['Ranks'];
include ($phpbb_root_path . 'includes/page_header.'.$phpEx);
//
// template setting
//
$template->set_filenames(array(	'body' => 'ranking.tpl'));

// constants
$template->assign_vars(array(
	'L_SPECIAL_RANKS' => $lang['Special_ranks'],
	'L_USERS_LIST' => $lang['Memberlist'],
	'L_RANKS' => $lang['Ranks'],
	'L_MINI' => $lang['Rank_minimum'],
	'L_TOTAL_USERS' => $lang['Total_users'],
	'SPAN_USERLIST_STD' => ($std_rank_max_users != 0) ? 2 : 1,
	'S_HIDDEN_FIELDS' => '',
	)
);

// standard ranks
if ($std_rank_max_users != 0)
{
	$template->assign_block_vars('std_userlist', array());
}
else 
{
	$template->assign_block_vars('no_std_userlist', array());
}

for ($i=0; $i < count($ranks); $i++)
{
	$template->assign_block_vars('ranks', array(
		'RANK_TITLE' => $ranks[$i]['rank_title'],
		'RANK_IMAGE' => ($ranks[$i]['rank_image'] == '') ? '' : '<img src="' . $ranks[$i]['rank_image'] . '" border=0 align="center">',
		'RANK_MINI'  => $ranks[$i]['rank_min'],
		'RANK_TOTAL' => $ranks[$i]['user_number'],
		)
	);
	if ($std_rank_max_users != 0)
	{
		$template->assign_block_vars('ranks.userlist', array(
			'USERS_LIST' => $ranks[$i]['users_list'],
			)
		);
	}
	else 
	{
		$template->assign_block_vars('ranks.no_userlist', array());
	}
}

// special ranks
if ($spe_rank_max_users != 0)
{
	$template->assign_block_vars('spe_userlist', array());
}
else 
{
	$template->assign_block_vars('no_spe_userlist', array());
}

for ($i=0; $i < count($spe_ranks); $i++)
{
	$template->assign_block_vars('spe_ranks', array(
		'RANK_TITLE' => $spe_ranks[$i]['rank_title'],
		'RANK_IMAGE' => ($spe_ranks[$i]['rank_image'] == '') ? '' : '<img src="' . $spe_ranks[$i]['rank_image'] . '" border=0 align="center">',
		)
	);
	if ($spe_rank_max_users != 0)
	{
		$template->assign_block_vars('spe_ranks.userlist', array(
			'USERS_LIST' => $spe_ranks[$i]['users_list'],
			)
		);
	}
	else
	{
		$template->assign_block_vars('spe_ranks.no_userlist', array(
			'RANK_TOTAL' => $spe_ranks[$i]['user_number'],
			)
		);
	}
}

//
// page footer
//
$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>